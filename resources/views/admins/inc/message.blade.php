<script type="text/javascript">
$(document).ready(function() {

  toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "3000",
    "hideDuration": "1000",
    "timeOut": "10000",
    "extendedTimeOut": "10000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "show",
    "hideMethod": "hide"
  }

  @if (count($errors) > 0)
    var message = "<div>"+
    @foreach ($errors->all() as $error)
    "- {{$error}}</br>"+
    @endforeach
    "</div>";
    toastr["error"](message, "Error Input");
  @endif


  @if (Session::has("flash_message"))
          var message = "<div>"+
          "{{Session::get("flash_message")}}"+
          "</div>";
          toastr["success"](message, "Success");
  @endif

})

</script>
