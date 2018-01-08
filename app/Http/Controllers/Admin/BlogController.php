<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\http\Requests\BlogRequest;
use Yajra\Datatables\Datatables;
use App\Category;
use App\Admin;
use App\Blog;
use Storage;
use Session;
use Image;
use DB;

class BlogController extends Controller
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
        $admin = Admin::all()->pluck("name", "id");
        $category = Category::all()->pluck("category_name", "cat_id");
        return view("admins.blog.show", ["admin"=>$admin, "category"=>$category]);
    }

    public function blogDatatable(Request $request)
    {
      $blog = DB::table("blogs as a")
              ->select(["a.blog_id", "a.blog_title", "a.blog_image_poster", "a.blog_meta_desc", "a.updated_at", "b.category_name", "c.name"])
              ->join("category as b", "a.cat_id", "=", "b.cat_id")
              ->join("admins as c", "a.id", "=", "c.id")
              ->where("a.blog_isdraft", "=", "0");
      $datatables = Datatables::of($blog);
      if($chose_cat = $datatables->request->get("cat_id")){
        $blog->where("a.cat_id", "=", $datatables->request->get("cat_id"));
      }
      if($chose_author = $datatables->request->get("id")){
        $blog->where("a.id", "=", $datatables->request->get("id"));
      }
      return $datatables->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all()->pluck("category_name", "cat_id");
        return view("admins.blog.create", ["category" => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function posterUpload(BlogRequest $request)
    {
      $img = $request->file("blog_image_poster");
      $ext = $img->getClientOriginalExtension();
      if($img->isValid()){
        $img_name = date("YmdHis").".".$ext;
        $path_ori = "img/poster_blog/original";
        $path_thumb = "img/poster_blog/thumb";
        $img->move($path_ori, $img_name);
        Image::make($path_ori."/".$img_name)->resize(100, 100, function($constraint){
          $constraint->aspectRatio();
        })->save($path_thumb."/".$img_name);
        return $img_name;
      }
      return false;
    }

    public function posterDelete()
    {

    }

    public function pdfUpload(BlogRequest $request)
    {
      $pdf = $request->file("blog_pdf_file_embed");
      $ext = $pdf->getClientOriginalExtension();
      if($pdf->isValid()){
        $pdf_name = date("YmdHis").".".$ext;
        $path = "pdf_file";
        $pdf->move($path, $pdf_name);
        return $pdf_name;
      }
      return false;
    }

    public function pdfDelete()
    {

    }

    public function store(BlogRequest $request)
    {
      if(isset($_POST["isdraft"])){
        $blog_isdraft = "1";
      } else{
        $blog_isdraft = "0";
      }
      $blog = new Blog;
      $blog->cat_id = $request->input("cat_id");
      $blog->id = Auth::user()->id;
      $blog->blog_title = $request->input("blog_title");
      $blog->blog_content = $request->input("blog_content");
      if($request->hasFile("blog_image_poster")){
        $blog->blog_image_poster = $this->posterUpload($request);
      }
      if($request->hasFile("blog_pdf_file_embed")){
        $blog->blog_pdf_file_embed = $this->pdfUpload($request);
      }
      if(isset($_POST["blog_video_embed"])){
        $blog->blog_video_embed = $request->input("blog_video_embed");
      }
      $blog->blog_meta_desc = $request->input("blog_meta_desc");
      $blog->blog_meta_key = $request->input("blog_meta_key");
      $blog->blog_isdraft = $blog_isdraft;
      $blog->save();
      Session::flash("flash_message", "Data has been saved.");
      return redirect("/admin03061993/blog");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $blog = Blog::find($id);
      $blog->category = $blog->category;
      $blog->author = $blog->author;
      return $blog;
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
