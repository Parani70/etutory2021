<!DOCTYPE html>
<html>

<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-176918518-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-176918518-1');
</script>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::asset('plugins/fontawesome-free/css/all.min.css')}}">
  <link href="{{URL::asset('dist/homeassets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet"> 
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{URL::asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Template Main CSS File -->
    <link href="{{URL::asset('dist/homeassets/css/style.css')}}" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::asset('dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
     <!-- Favicon -->
     <link rel="icon" type="image/png" href="{{URL::asset('dist/img/favicon.png')}}" />
     <style>
      .login-box{
        margin-left: auto;
        margin-right: auto;
        display: block;
        margin-top: 10vh;
        width: 500px;
        background-color: #EFEFEF;
      }

      .card{
        padding: 30px;
        width: 500px;
      }

      #loginh2{
        font-size: 3rem;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: 900;
        margin-bottom: 20px;
        text-align: center;
        color: #FFCA08;
      }

      .login-page2{
        background-color: #EFEFEF;
      }

    
     </style>
</head>

<body class="hold-transition login-page2">
<header id="header" class="fixed-top2 ">

<div class="container container-mainnav d-flex align-items-center">

  <h1 class="logo mr-auto"><a href="{{url('/')}}"><img src="{{URL::asset('dist/img/logo.png')}}" alt=""></a></h1>
  <!-- Uncomment below if you prefer to use an image logo -->
  <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

  <nav class="nav-menu d-none d-lg-block">
  <ul>
          
  
          <li><a href="{{url('/courses')}}">Buy Model Exams</a></li>
          <li><a href="{{url('/promopage')}}">Promotions</a></li>
          <li><a href="{{url('/loginpage')}}">Exam Centre</a></li>
          <li class="active"><a href="{{url('/loginpage')}}">Login</a></li>
          <li><a href="{{url('/registernewstudent')}}">Register</a></li>
        </ul>
  </nav><!-- .nav-menu -->

</div>
</header>
<!-- End Header -->
  
  <div class="login-box">
    <!-- <div class="login-logo">
    <a href="{{url('/')}}"><img src="{{URL::asset('dist/img/logo.png')}}" alt=""></a>
    </div> -->
    <!-- /.login-logo -->
    <h2 id="loginh2">Log In</h2>
    <div class="card">
      <p>eTutory.lk is the pioneers in the county to offer online dynamic model test papers.</p>
      <hr>
      <div class="card-body login-card-body">
        <p class="login-box-msg">If you are already registered with us, login here, else <a href="{{url('/registernewstudent')}}">Register</a></p>

        <form action="{{ route('login') }}" method="post">
        @csrf
          <div class="input-group mb-3">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="row">
            <div class="col-8">

            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Log In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>


        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="{{url('/forgotmypassword')}}">I forgot my password</a>
        </p>
        <p class="mb-0">
        <!--  <a href="{{url('/registernewstudent')}}" class="text-center">Register a new membership</a>-->
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
  <footer id="footer">



<div class="container d-md-flex py-4">

  <div class="mr-md-auto text-center text-md-left">
  <img class="footerimage" src="{{URL::asset('dist/img/footer logo.png')}}" alt="">
    <div class="copyright">
      &copy; Copyright <strong><span>Metro tech Systems (Pvt) Ltd.</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/tempo-free-onepage-bootstrap-theme/ -->
  
    </div>
  </div>
  <div class="mr-md-auto text-center text-md-left">
    <ul class="footer_links">
    <li><h4>Essential Links</h4></li>
    <li><a href="{{url('/aboutus')}}">About Us</a>
          </li>
      <li><a href="{{url('/privacypolicy')}}">Privacy Policy</a>
      </li>
      <li><a href="{{url('/contactus')}}">Contact Us</a>
      </li>
    </ul>
  </div>
  <div class="social-links text-center text-md-right pt-3 pt-md-0">
  <h4>Social Media</h4>
    <a href="https://www.facebook.com/etutory.lk/" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>


  </div>

</div>
</footer><!-- End Footer -->
  <!-- jQuery -->
  <script src="{{URL::asset('plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{URL::asset('dist/js/adminlte.min.js')}}"></script>

</body>

</html>