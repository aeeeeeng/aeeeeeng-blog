@extends('admins.layouts.admin')
@section('title')
  Admin
@stop
@section('css')

  <link rel="stylesheet" href="/vendor/dataTables/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.3.0/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
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
             {{Form::hidden("_token", csrf_token())}}
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.3.0/sweetalert2.min.js" charset="utf-8"></script>
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
            var buttonDel = "<button type='button' data-id='"+data+"' data-name='"+row['name']+"' id='delete' class='btn btn-danger'><i class='fa fa-trash'></i></button>";
            return "<center>"+buttonEdit+buttonDel+"</center>";
          }
        }
      ]
    })

    $(document).on("click", "#delete", function(e){
      e.preventDefault();
      var id = $(this).data("id");
      var name = $(this).data("name");
      var token = $("input[name=_token]").val();
      var result;
      swal({
          title: 'Are you sure to deleted '+name+'??',
          html: $('<div>')
            .addClass('some-class')
            .text('Data will be deleted'),
          animation: false,
          showCancelButton: true,
          customClass: 'animated tada',
          background: '#fff url(//bit.ly/1Nqn9HU)',
        })
      .then((result) => {
          if (result.value) {
            $.ajax({
              url: 'admin/'+id,
              type: 'delete',
              dataType: 'json',
              data: {
                _method : 'delete',
                _token : token
              }
            })
            .done(function(data) {
              result = true;
            })
            .fail(function(data) {
              result = false;
            })
            .always(function(data) {
              if(result){
                if(data.success){
                  swal({
                      title: 'Success',
                      html: $('<div>')
                        .addClass('some-class')
                        .text('Data '+name+' has ben deleted'),
                      animation: false,
                      customClass: 'animated tada'
                    }).then(function(){
                      window.location.reload();
                    })
                } else{
                  swal({
                    title: 'Error',
                    html: $('<div>')
                      .addClass('some-class')
                      .text('Invalid Request'),
                    animation: false,
                    customClass: 'animated tada'
                  })
                }
              } else{
                swal({
                  title: 'Error',
                  html: $('<div>')
                    .addClass('some-class')
                    .text('Internal Server Error'),
                  animation: false,
                  customClass: 'animated tada'
                })
              }
            });
          } else if (result.dismiss === 'cancel') {
            null;
          }
        })
    })
  </script>
@stop
