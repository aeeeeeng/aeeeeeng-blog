@extends('admins.layouts.admin')
@section('title')
  Tags
@stop
@section('css')
  <link rel="stylesheet" href="/vendor/dataTables/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.3.0/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
@stop
@section('content')
  <div class="main-content">
    <div class="card">
      <h4 class="card-title">Tags</h4>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <button onclick="window.location.href='/admin03061993/tag/create'" class="btn btn-label btn-danger" style="margin-bottom:10px;">
              <label><i class="fa fa-plus"></i></label>
              Add Category
           </button>
           <div class="table-responsive">
             {{Form::hidden("_token", csrf_token())}}
             <table class="table table-striped table-bordered" id="catDatatable">
               <thead>
                 <tr>
                   <th>Tag Name</th>
                   <th>Last Change</th>
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
  <script src="/js/function.js" charset="utf-8"></script>
  <script type="text/javascript">
    $("#catDatatable").DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: '{{url("/admin03061993/tag-datatable")}}'
      },
      columns: [
        { "data": "tag_name" },
        { "data": "updated_at" },
        {
          "data": "tag_id",
          render: function(data, type, row, meta){
            var buttonEdit = "<a style='margin-right:10px;' href='/admin03061993/tag/"+data+"/edit' class='btn btn-info'><i class='fa fa-wrench'></i></a>";
            var buttonDel = "<button type='button' data-id='"+data+"' data-name='"+row['tag_name']+"' id='delete' class='btn btn-danger'><i class='fa fa-trash'></i></button>";
            return buttonEdit+buttonDel;
          }
        },
      ]
    })

    $(document).on("click", "#delete", function(e){
      e.preventDefault();
      var id = $(this).data("id");
      var name = $(this).data("name");
      var token = $("input[name=_token]").val();
      var url = 'tag/'+id;
      ajaxDeleteWithSweetAlert(url, name, token);
    })
  </script>
@stop
