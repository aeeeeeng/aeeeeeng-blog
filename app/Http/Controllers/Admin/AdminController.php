<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\http\Requests\AdminRequest;
use App\Admin;
use Image;
use Session;
use DB;
use Storage;
use Yajra\Datatables\Datatables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->middleware("auth:admin");
    }

    public function index()
    {
        return view("admins.admin.show");
    }

    public function adminDatatable(Request $request)
    {
      $admin = DB::table("admins")
                ->select(["id", "name", "email", "admin_image", "updated_at"]);
      $datatables = Datatables::of($admin);
      return $datatables->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admins.admin.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     private function imageUpload(AdminRequest $request)
     {
         $admin_image = $request->file("admin_image");
         $ext = $admin_image->getClientOriginalExtension();
         if($request->file("admin_image")->isValid()){
           $admin_image_name = date("YmdHis").".".$ext;
           $path_ori = "img/admin_image/original";
           $path_thumb = "img/admin_image/thumb";
           $request->file("admin_image")->move($path_ori, $admin_image_name);
           $img = Image::make($path_ori."/".$admin_image_name)->resize(100, 100, function ($constraint) {
              $constraint->aspectRatio();
          })->save($path_thumb.'/'.$admin_image_name);
           return $admin_image_name;
         }
         return false;
    }

    private function imageDelete(Admin $admin)
    {
      $existOri = Storage::disk("adminOriImage")->exists($admin->admin_image);
      $existThumb = Storage::disk("adminThumbImage")->exists($admin->admin_image);
      if (isset($admin->admin_image) && $existOri && $existThumb) {
        $deleteOri = Storage::disk("adminOriImage")->delete($admin->admin_image);
        $deleteThumb = Storage::disk("adminThumbImage")->delete($admin->admin_image);
        if($deleteOri && $deleteThumb){
          return true;
        }
        return false;
      }
    }

    public function store(AdminRequest $request)
    {
      $admin = new Admin;
      $admin->name = $request->input("name");
      $admin->email = $request->input("email");
      $admin->password = bcrypt($request->input("password"));
      if($request->hasFile("admin_image")){
        $admin->admin_image = $this->imageUpload($request);
      }
      $admin->save();
      Session::flash("flash_message", "Data has been saved.");
      return redirect("/admin03061993/admin");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Admin::find($id);
        return view("admins.admin.create", $admin);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {
      $admin = Admin::find($id);
      $admin->name = $request->input('name');
      $admin->email = $request->input('email');
      if ($request->hasFile("admin_image")) {
        $this->imageDelete($admin);
        $admin->admin_image = $this->imageUpload($request);
      }
      $admin->save();
      Session::flash("flash_message", "Data has been updated.");
      return redirect("/admin03061993/admin");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $result = array();
      $admin = Admin::find($id);
      $out["success"] = ($this->imageDelete($admin) && $admin->delete()) ? true : false;
      return $out;
    }
}
