@extends('admins.layouts.admin')
@section('title')
  Blog
@stop
@section('content')
  <div class="main-content">
    <div class="card">
      <h4 class="card-title">Blog</h4>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <button onclick="window.location.href='/admin03061993/blog/create'" class="btn btn-label btn-danger" style="margin-bottom:10px;">
              <label><i class="fa fa-pencil"></i></label>
              Write Blog
           </button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
