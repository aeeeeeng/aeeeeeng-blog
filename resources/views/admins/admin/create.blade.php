@extends('admins.layouts.admin')
@section('title')
  Admin Management
@stop
@section('content')
  <div class="main-content">
    <div class="card">
      <h4 class="card-title">Admin Management</h4>
      <div class="card-body">
        
        {!! Form::open(['action'=>'Admin\AdminController@store', 'method'=>'post', "files"=>true]) !!}
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Full Name</label>
                {{Form::text('name', (!empty($name)) ? $name : null, ['class'=>($errors->has('name')) ? "form-control is-invalid" : "form-control" , "id"=>"name" ,'placeholder'=>'Full Name'])}}
                {!!  ($errors->has('name')) ? '<div class="invalid-feedback">'.$errors->first('name').'</div>' : '' !!}
              </div>
              <div class="form-group">
                <label>Email</label>
                {{Form::text('email', (!empty($email)) ? $email : null, ['class'=>($errors->has('email')) ? "form-control is-invalid" : "form-control" , "id"=>"email" ,'placeholder'=>'Email'])}}
                {!!  ($errors->has('email')) ? '<div class="invalid-feedback">'.$errors->first('email').'</div>' : '' !!}
              </div>
              <div class="file-group file-group-inline">
                <button class="btn btn-info file-browser" type="button">Upload image</button>
                <input id="admin_image" name="admin_image" type="file">
              </div>
              <div id="img-display">
                @if (!empty($admin_image))
                  <img src='/img/admin_image/original/{{$admin_image}}' style='width:132px;'/>
                @endif
              </div>
            </div>
            <div class="col-lg-6">
              @if (empty($name))
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" id="password" class="form-control {{ ($errors->has('password')) ? "is-invalid" : "" }}"/>
                  {!!  ($errors->has('email')) ? '<div class="invalid-feedback">'.$errors->first('password').'</div>' : '' !!}
                </div>
                <div class="form-group">
                  <label>Retype Password</label>
                  <input type="password" name="password_confirmation" id="password_confirmation" class="form-control {{ ($errors->has('password')) ? "is-invalid" : "" }}"/>
                </div>
              @endif
              <button type="submit" class="btn btn-label btn-danger pull-right" style="margin-left:10px;">
                <label><i class="fa fa-save"></i></label>
                Save
              </button>
              <button type="button" onclick="window.history.back();" class="btn btn-label btn-secondary pull-right">
                <label><i class="fa fa-arrow-left"></i></label>
                Back
              </button>
            </div>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script type="text/javascript">

  $("#admin_image").on("change", function(){
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
