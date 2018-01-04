@extends('admins.layouts.admin')
@section('title')
  Category
@stop
@section('css')
  <link rel="stylesheet" href="/vendor/dataTables/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.3.0/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
@stop
@section('content')
  <div class="main-content">
    <div class="card">
      <h4 class="card-title">Category</h4>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <button onclick="window.location.href='/admin03061993/category/create'" class="btn btn-label btn-danger" style="margin-bottom:10px;">
              <label><i class="fa fa-plus"></i></label>
              Add Category
           </button>
           {{Form::hidden("_token", csrf_token())}}
           <table class="table table-striped table-bordered">
             <thead>
               <tr>
                 <th>Name</th>
                 <th>Image</th>
                 <th>Last Update</th>
                 <th>Manage</th>
               </tr>
             </thead>
             <tbody>
               @foreach ($category as $data)
                 <tr>
                   <td>{{$data["category_name"]}}</td>
                   <td><img src="/img/category_image/thumb/{{$data["category_image"]}}"></td>
                   <td>{{$data["updated_at"]}}</td>
                   <td>
                     <a style="margin-right:10px;" href="/admin03061993/category/{{$data["cat_id"]}}/edit" class="btn btn-info"><i class="fa fa-wrench"></i></a>
                     <button type="button" data-id="{{$data->cat_id}}" data-name="{{$data->category_name}}" id="delete" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                   </td>
                 </tr>
                 @foreach ($data->child as $child)
                   <tr style="background-color: #4ed2c5; color: #fff;">
                     <td class="text-center" style="border: none !important;">{{$child["category_name"]}}</td>
                     <td class="text-center" style="border: none !important;"><img src="/img/category_image/thumb/{{$child["category_image"]}}"></td>
                     <td class="text-center" style="border: none !important;">{{$child["updated_at"]}}</td>
                     <td class="text-right" style="border: none !important;">
                       <a style="margin-right:10px;" href="/admin03061993/category/{{$child["cat_id"]}}/edit" class="btn btn-info"><i class="fa fa-wrench"></i></a>
                       <button type="button" data-id="{{$child->cat_id}}" data-name="{{$child->category_name}}" id="delete" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                     </td>
                   </tr>
                 @endforeach
               @endforeach
             </tbody>
           </table>
             {{-- {{ $category->links("admins.inc.pagination", ) }} --}}
             @include('admins.inc.pagination', ['paginator' => $category])
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
    $(document).on("click", "#delete", function(e){
      e.preventDefault();
      var id = $(this).data("id");
      var name = $(this).data("name");
      var token = $("input[name=_token]").val();
      var url = "category/"+id;
      ajaxDeleteWithSweetAlert(url, name, token);
    })
  </script>
@stop
