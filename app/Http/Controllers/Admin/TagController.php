<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\http\Requests\TagRequest;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use App\Tag;
use Session;
use DB;

class TagController extends Controller
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
        return view("admins.tag.show");
    }

    public function tagDatatable(Request $req)
    {
      $tag = DB::table("tags")
             ->select(["tag_id", "tag_name", "updated_at"]);
      $datatables = Datatables::of($tag)
      ->editColumn('updated_at', function ($data) {
          return $data->updated_at ? with(new Carbon($data->updated_at))->format('d/m/Y H:i') : '';
      })
      ->filterColumn('updated_at', function ($query, $keyword) {
          $query->whereRaw("DATE_FORMAT(updated_at,'%d/%m/%Y') like ?", ["%$keyword%"]);
      });
      return $datatables->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admins.tag.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        $tag = new Tag;
        $tag->tag_name = $request->tag_name;
        $tag->save();
        Session::flash("flash_message", "Data has been saved.");
        return redirect("/admin03061993/tag");
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
        $tag = Tag::find($id);
        return view("admins.tag.create", compact("tag"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $id)
    {
        $tag = Tag::find($id);
        $tag->tag_name = $request->tag_name;
        $tag->save();
        Session::flash("flash_message", "Data has been saved.");
        return redirect("/admin03061993/tag");
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
        $tag = Tag::find($id);
        $result["success"] = ($tag->delete()) ? true : false;
        return $result;
    }
}
