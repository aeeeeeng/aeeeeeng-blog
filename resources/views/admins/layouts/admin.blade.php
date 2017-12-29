<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@section('title') @show</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="/css/core.min.css" rel="stylesheet">
    <link href="/css/app.min.css" rel="stylesheet">
    <link href="/css/style.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/img/apple-touch-icon.png">
    <link rel="icon" href="/img/favicon.png">
    @section('css')

    @show
  </head>

  <body class="sidebar-folded">

    <!-- Preloader -->
    <div class="preloader">
      <div class="spinner-dots">
        <span class="dot1"></span>
        <span class="dot2"></span>
        <span class="dot3"></span>
      </div>
    </div>


    <!-- Sidebar -->
    @include('admins.inc.sidebar')
    <!-- END Sidebar -->


    <!-- Topbar -->
    @include('admins.inc.header')
    <!-- END Topbar -->


    <!-- Main container -->
    <main>
      @yield('content')
      <!--/.main-content -->


      <!-- Footer -->
      @include('admins.inc.footer')
      <!-- END Footer -->

    </main>
    <!-- END Main container -->



    <!-- Global quickview -->
    <div id="qv-global" class="quickview" data-url="/data/quickview-global.html">
      <div class="spinner-linear">
        <div class="line"></div>
      </div>
    </div>
    <!-- END Global quickview -->



    <!-- Scripts -->
    <script src="/js/core.min.js"></script>
    <script src="/js/app.min.js"></script>
    <script src="/js/script.min.js"></script>
  </body>
</html>
