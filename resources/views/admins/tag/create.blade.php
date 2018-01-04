@extends('admins.layouts.admin')
@section('title')
  Tag Management
@stop
@section('content')
  <div class="main-content">
    <div class="card">
      <h4 class="card-title">Tag Management</h4>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6" style="float:none; margin: 0 auto;">
            @if (isset($tag))
              {!! Form::open(["action"=>["Admin\TagController@update", $tag->tag_id], "method"=>"post"]) !!}
            @else
              {!! Form::open(["action"=>"Admin\TagController@store", "method"=>"post"]) !!}
            @endif
              <div class="form-group">
                <label>Tag Name</label>
                {{Form::text("tag_name", (isset($tag->tag_name) ? $tag->tag_name : null), ["class"=>($errors->has("tag_name")) ? "form-control is-invalid" : "form-control", "id"=>"tag_name"])}}
                {!!  ($errors->has('tag_name')) ? '<div class="invalid-feedback">'.$errors->first('tag_name').'</div>' : '' !!}
              </div>
              @if (isset($tag))
                {{Form::hidden("_method", "PUT")}}
              @endif
              <button type="submit" class="btn btn-label btn-danger pull-right" style="margin-left:10px;">
                <label><i class="fa fa-save"></i></label>
                Save
              </button>
              <a href="/admin03061993/tag" class="btn btn-label btn-secondary pull-right">
                <label><i class="fa fa-arrow-left"></i></label>
                Back
              </a>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
