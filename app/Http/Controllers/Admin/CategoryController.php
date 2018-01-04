<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\http\Requests\CategoryRequest;
use Yajra\Datatables\Datatables;
use App\Category;
use Storage;
use Session;
use Image;
use DB;

class CategoryController extends Controller
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
        $category = Category::with(['child'])->where("parent_of_category", "=", 0)->paginate(1);
        return view("admins.category.show", compact("category"));
        // return $category->get();
    }

    public function categoryDatatable(Request $request)
    {
      $category = DB::table("category")
                  ->select(["cat_id", "category_name", "category_image", "parent_of_category", "updated_at"]);
      $datatables = Datatables::of($category);
      return $datatables->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catParent = Category::where("parent_of_category", "=", 0)->get();
        return view("admins.category.create")->with("catParent", $catParent);
        // return $catParent->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function imageUpload(CategoryRequest $request)
     {
       $cat_image = $request->file("category_image");
       $ext = $cat_image->getClientOriginalExtension();
       if($cat_image->isValid()){
         $cat_image_name = date("YmdHis").".".$ext;
         $path_ori = "img/category_image/original";
         $path_thumb = "img/category_image/thumb";
         $cat_image->move($path_ori, $cat_image_name);
         $img = Image::make($path_ori."/".$cat_image_name)->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path_thumb.'/'.$cat_image_name);
        return $cat_image_name;
       }
       return false;
     }

     private function imageDelete(Category $category)
     {
       $existOri = Storage::disk("categoryOriImage")->exists($category->category_image);
       $existThumb = Storage::disk("categoryThumbImage")->exists($category->category_image);
       if (isset($category->category_image) && $existOri && $existThumb) {
         $deleteOri = Storage::disk("categoryOriImage")->delete($category->category_image);
         $deleteThumb = Storage::disk("categoryThumbImage")->delete($category->category_image);
         if($deleteOri && $deleteThumb){
           return true;
         }
         return false;
       }
     }

    public function store(CategoryRequest $request)
    {
      $category = new Category;
      $category->category_name = $request->input("category_name");
      if($request->hasFile("category_image")){
        $category->category_image = $this->imageUpload($request);
      }
      if ($request->filled ("parent_of_category")) {
        $category->parent_of_category = $request->parent_of_category;
      }
      $category->save();
      Session::flash("flash_message", "Data has been saved.");
      return redirect("/admin03061993/category");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $catParent = Category::where("parent_of_category", "=", 0)->get();
        return view("admins.category.create", compact(["category", "catParent"]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
      $category = Category::find($id);
      $category->category_name = $request->category_name;
      if ($request->hasFile("category_image")) {
        $this->imageDelete($category);
        $category->category_image = $this->imageUpload($request);
      }
      if ($request->filled("parent_of_category")) {
        $category->parent_of_category = $request->parent_of_category;
      } else{
        $category->parent_of_category = 0;
      }
      $category->save();
      Session::flash("flash_message", "Data has been saved.");
      return redirect("/admin03061993/category");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $result = [];
      $category = Category::find($id);
      if ($this->imageDelete($category) && $category->delete()) {
        Category::where("parent_of_category", "=", $id)->update(["parent_of_category" => 0]);
        $result["success"] = true;
      } else {
        $result["success"] = false;
      }
      return $result;
    }
}
