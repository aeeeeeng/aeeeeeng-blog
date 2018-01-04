@extends('admins.layouts.admin')
@section('title')
  Category Management
@stop
@section('content')
  <div class="main-content">
    <div class="card">
      <h4 class="card-title">Category Management</h4>
      <div class="card-body">
        @if (isset($category))
          {!! Form::open(["action"=>["Admin\CategoryController@update", $category->cat_id], "method"=>"post", "files"=>true]) !!}
        @else
          {!! Form::open(["action"=>"Admin\CategoryController@store", "method"=>"post", "files"=>true]) !!}
        @endif
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Name</label>
                {{Form::text("category_name", isset($category->category_name) ? $category->category_name : null, ["class"=>($errors->has("category_name")) ? "form-control is-invalid" : "form-control", "id"=>"category_name", "placeholder"=>"Category Name"])}}
                {!!  ($errors->has('category_name')) ? '<div class="invalid-feedback">'.$errors->first('category_name').'</div>' : '' !!}
              </div>
              @if ($catParent->count() > 0)
                <div class="form-group">
                  <label>Category Parent</label>
                  <select data-provide="selectpicker" data-live-search="true" class="form-control" name="parent_of_category" id="parent_of_category">
                    <option value="">Chose Parent..</option>
                    @foreach ($catParent as $data)
                      <option
                      @if (isset($category))
                        {{($data->cat_id === $category->parent_of_category) ? "selected" : null}}
                      @endif
                       value="{{ $data->cat_id }}">
                       {{ $data->category_name }}
                     </option>
                    @endforeach
                  </select>
                </div>
              @else
                <h2>Sorry.. Parent not found :)</h2>
              @endif
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>&nbsp;</label>
                <div class="file-group file-group-inline form-control" style="border: 0px;">
                  <button class="btn btn-info file-browser" type="button">Upload image</button>
                  <input id="category_image" name="category_image" type="file">
                </div>
                {!!  ($errors->has('category_image')) ? '<div class="invalid-feedback">'.$errors->first('category_image').'</div>' : '' !!}
                <div id="img-display">
                  @if (isset($category->category_image))
                    <img src="/img/category_image/original/{{$category->category_image}}" style="width:132px;">
                  @endif
                </div>
              </div>
              @if (isset($category))
                {{Form::hidden("_method", "PUT")}}
              @endif
              <button type="submit" class="btn btn-label btn-danger pull-right" style="margin-left:10px;">
                <label><i class="fa fa-save"></i></label>
                Save
              </button>
              <a href="/admin03061993/category" class="btn btn-label btn-secondary pull-right">
                <label><i class="fa fa-arrow-left"></i></label>
                Back
              </a>
            </div>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection
@section('js')
  <script type="text/javascript">
  $("#category_image").on("change", function(){
    readURL(this);
  });

  function readURL(input){
    if (input.files && input.files[0]){
    var reader = new FileReader();

    reader.onload = function(e){
      $("#img-display").html("<img src='"+e.target.result+"' style='width:132px;'>");
    }
    reader.readAsDataURL(input.files[0]);
    }
  }
  </script>
@stop
