@extends('admins.layouts.admin')
@section('title')
  Blog
@stop
@section('css')
  <link rel="stylesheet" href="/vendor/dataTables/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.3.0/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
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
           {!! Form::open(["action"=>"Admin\BlogController@store", "id"=>"sortData"]) !!}
              <div class="row">
                <div class="col-lg-3">
                  <div class="form-group">
                    <label>Sort by Category</label>
                    {{Form::select("cat_id", $category, null,
                      ["data-provide"=>"selectpicker", "data-live-search"=>"true", "class"=>"form-control", "id"=>"cat_id", "placeholder"=>"chose category.."]
                    )}}
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label>Sort by Author</label>
                    {{Form::select("id", $admin, null,
                      ["data-provide"=>"selectpicker", "data-live-search"=>"true", "class"=>"form-control", "id"=>"id", "placeholder"=>"chose author.."]
                    )}}
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-label btn-danger form-control" style=" color:#fff; ">
                      <label><i class="fa fa-search"></i></label>
                      Search
                    </button>
                  </div>
                </div>
              </div>
           {!! Form::close() !!}

           <div class="table-responsive">
             {{Form::hidden("_token", csrf_token())}}
             <table class="table table-striped table-bordered" id="dataBlog">
               <thead>
                 <tr>
                   <th>Title</th>
                   <th>Poster</th>
                   <th>Blog Main Idea</th>
                   <th>Category</th>
                   <th>Last Update</th>
                   <th>Created By</th>
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

  <div class="modal modal-right fade" data-backdrop="false" id="modal-fill" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div style="background-color: #e65959;" class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card card-body article">
            <header style="padding-top: 0px !important; padding-bottom: 0px !important;" class="text-center py-40">
              {{-- <div class="gap-items-2 mb-30">
                <span class="badge badge-pill badge-bold badge-secondary">Travel</span>
                <span class="badge badge-pill badge-bold badge-secondary">Beach</span>
              </div> --}}
              <div class="title"></div>
              <div style="display: inline-flex;" class="pull-right authorcat"></div>
              <hr class="w-50px">
              <div class="pull-right file"></div>
            </header>
            <figure class="figure img-thumbnail bg-lighter my-30">
            </figure>
            <div class="container-article">
            </div>
          </div>
        </div>
        <div style="background-color: #e65959;" class="modal-footer">
          <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
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

  var blogTable =  $("#dataBlog").DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url : '{{url("/admin03061993/blog-datatable")}}',
        data: function(d){
          d.cat_id = $("#cat_id").val();
          d.id = $("#id").val();
        }
      },
      columns : [
        { "data": "blog_title" },
        {
          "data": "blog_image_poster",
          "render" : function(data, type, row, meta){
            return "<img src='/img/poster_blog/thumb/"+data+"'/>";
          }
        },
        { "data": "blog_meta_desc" },
        { "data": "category_name" },
        { "data": "updated_at" },
        { "data": "name" },
        {
          "data": "blog_id",
          "render": function(data, type, row, meta){
            var buttonEdit = "<a href='/admin03061993/blog/"+data+"/edit' class='btn btn-info'><i class='fa fa-wrench'></i></a>";
            var buttonDraft = "<button type='button' data-id='"+data+"' data-name='"+row['name']+"' id='draft' class='btn btn-danger'><i class='fa fa-close'></i></button>";
            var buttonShow = "<button type='button' data-toggle='modal' data-target='#modal-fill' data-id='"+data+"' data-name='"+row['name']+"' id='show' class='btn btn-primary'><i class='fa fa-search-plus'></i></button>";
            return buttonEdit+" "+buttonShow+" "+buttonDraft;
          }
        },
      ]
    })

    $("#sortData").on("submit", function(e){
      e.preventDefault();
      blogTable.draw();
    })

    $("#modal-fill").on("show.bs.modal", function(e){
      var id = $(e.relatedTarget).data("id");
      var ini = $(this);
      var result;

      ini.find('.modal-body .card-body header .title h1').remove();
      ini.find('.modal-body .card-body header .authorcat p').remove();
      ini.find('.modal-body .card-body header .file a').remove();
      ini.find('.modal-body .card-body figure img').remove();
      ini.find('.modal-body .card-body .container-article div').remove();

      $.ajax({
        url: '{{url("/admin03061993/blog")}}/'+id,
        type: 'GET',
        dataType: 'JSON',
      })
      .done(function(data) {
        result = true;
      })
      .fail(function() {
        result = false;
      })
      .always(function(data) {
        if(result){
          ini.find('.modal-body .card-body header .title').append("<h1>"+data.blog_title+"</h1>");
          ini.find('.modal-body .card-body header .authorcat').append("<p> <b>Created By</b> : "+data.author.name+"</p> &nbsp;&nbsp;&nbsp; <p> <b>Category : </b>"+data.category.category_name+"</p>");
          if(data.blog_pdf_file_embed != null)
          {
            ini.find('.modal-body .card-body header .file').append("<a href='#' style='color:#fff;' class='btn btn-primary'><i class='fa fa-download'></i></a>");
          }
          ini.find('.modal-body .card-body figure').append('<img src="/img/poster_blog/original/'+data.blog_image_poster+'" class="figure-img img-fluid" alt="...">');
          ini.find('.modal-body .card-body .container-article').append("<div>"+data.blog_content+"</div>");

        }else{

        }
      });

    })

  </script>
@stop
