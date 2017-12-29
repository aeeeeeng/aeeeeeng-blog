<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive admin dashboard and web application ui kit. ">
    <meta name="keywords" content="login, signin">

    <title>Login Page 3 &mdash; TheAdmin</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="/css/core.min.css" rel="stylesheet">
    <link href="/css/app.min.css" rel="stylesheet">
    <link href="/css/style.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/img/apple-touch-icon.png">
    <link rel="icon" href="/img/favicon.png">
  </head>

  <body>


    <div class="row no-gutters min-h-fullscreen bg-white">
      <div class="col-md-6 col-lg-7 col-xl-8 d-none d-md-block bg-img" style="" data-overlay="5">

        <div class="row h-100 pl-50">
          <div class="col-md-10 col-lg-8 align-self-end">
            <img src="/img/logo-light-lg.png" alt="...">
            <br><br><br>
            <h4 class="text-white">The admin is the best admin framework available online.</h4>
            <p class="text-white">Credibly transition sticky users after backward-compatible web services. Compellingly strategize team building interfaces.</p>
            <br><br>
          </div>
        </div>

      </div>



      <div class="col-md-6 col-lg-5 col-xl-4 align-self-center">
        <div class="px-80 py-30">
          <h4>Login</h4>
          <p><small>Sign into your account</small></p>
          <br>

          <form class="form-type-material"  method="POST" action="{{ route('admin.login.submit') }}">
            {{ csrf_field() }}
            <div class="form-group">
              <input type="email" class="form-control" id="username" name="email" value="{{ old('email') }}" required autofocus>
              <label for="username">Email</label>
            </div>

            <div class="form-group">
              <input type="password" class="form-control" name="password" id="password">
              <label for="password">Password</label>
            </div>

            <div class="form-group flexbox">
              <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" checked>
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">Remember me</span>
              </label>

              <a class="text-muted hover-danger fs-13" href="#">Forgot password?</a>
            </div>

            <div class="form-group">
              <button class="btn btn-bold btn-block btn-danger" type="submit">Login</button>
            </div>
          </form>

          <div class="divider">Or Sign In With</div>
          <div class="text-center">
            <a class="btn btn-square btn-facebook" href="#"><i class="fa fa-facebook"></i></a>
            <a class="btn btn-square btn-google" href="#"><i class="fa fa-google"></i></a>
            <a class="btn btn-square btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
          </div>

          <hr class="w-30px">

          <p class="text-center text-muted fs-13 mt-20">Don't have an account? <a class="text-danger fw-500" href="#">Sign up</a></p>
        </div>
      </div>
    </div>




    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="/vendor/backstretch/jquery.backstretch.min.js" ></script>
    <script type="text/javascript">
        $(".bg-img").backstretch([
          "/img/login/1.jpg",
          "/img/login/2.jpg",
          "/img/login/3.jpg",
          "/img/login/4.jpg",
          "/img/login/5.jpg",
          "/img/login/6.jpg"
        ], {fade: 750,duration: 3000});
    </script>
    <script src="/js/core.min.js"></script>
    <script src="/js/app.min.js"></script>
    <script src="/js/script.min.js"></script>

  </body>
</html>
