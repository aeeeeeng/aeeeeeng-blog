@extends('admins.layouts.admin')
@section('title')
  Admin
@stop
@section('css')

  <link rel="stylesheet" href="/vendor/dataTables/css/dataTables.bootstrap4.min.css">
@stop
@section('content')
  <div class="main-content">
    <div class="card">
      <h4 class="card-title">Admin</h4>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <button onclick="window.location.href='/admin03061993/admin/create'" class="btn btn-label btn-danger" style="margin-bottom:10px;">
              <label><i class="fa fa-plus"></i></label>
              Add Admin
           </button>
           <div class="table-responsive">
             <table class="table table-striped table-bordered" id="dataAdmin">
               <thead>
                 <tr>
                   <th>Full Name</th>
                   <th>Email</th>
                   <th>Image</th>
                   <th>Last Update</th>
                   <th>Manage</th>
                 </tr>
               </thead>
               <tbody>
               </tbody>
             </table>
           </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('js')
  <script src="/vendor/datatables/js/jquery.dataTables.min.js" charset="utf-8"></script>
  <script src="/vendor/datatables/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
  <script type="text/javascript">
    $("#dataAdmin").DataTable({
      processing : true,
      serverSide : true,
      ajax: {
       url : '{{url("/admin03061993/admin-datatable")}}'
      },
     columns : [
        { "data": "name" },
        { "data": "email" },
        {
          "data": "admin_image",
          "render": function(data, type, row, meta){
            return "<img src='/img/admin_image/thumb/"+data+"'/>";
          }
        },
        { "data": "updated_at" },
        {
          "data": "id",
          "render": function(data, type, row, meta){
            var buttonEdit = "<a style='margin-right:10px;' href='/admin03061993/admin/"+data+"' class='btn btn-info'><i class='fa fa-wrench'></i></a>";
            var buttonDel = "<button type='button' id='delete' class='btn btn-danger'><i class='fa fa-trash'></i></button>";
            return "<center>"+buttonEdit+buttonDel+"</center>";
          }
        }
      ]
    })
  </script>
@stop
