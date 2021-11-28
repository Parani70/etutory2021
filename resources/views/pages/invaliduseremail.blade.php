<!DOCTYPE html>
<html>

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-176918518-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-176918518-1');
  </script>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk Invalid Email</title>
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
    .register-box {
      margin-left: auto;
      margin-right: auto;
      display: block;
      margin-top: 10vh;

      background-color: #EFEFEF;
    }

    .card {
      padding: 30px;
      width: 1000px;
    }

    #loginh2 {
      font-size: 3rem;
      font-family: Arial, Helvetica, sans-serif;
      font-weight: 900;
      margin-bottom: 20px;
      text-align: center;
      color: #FFCA08;
    }

    .login-page2 {
      background-color: #EFEFEF;
    }

    .login-logo p {
      font-size: 1.1rem;
      font-weight: 500;
    }

    #p1 {
      font-size: 1.6rem;
      font-weight: 700;
    }

    .btn-primary-front {
      border: #FFCA08 1px solid;
      color: #FFFFFF;
      background-color: #FFCA08;
      font-weight: 700;
    }

    .btn-primary-front:hover {
      border: #000000 1px solid;
      color: #FFFFFF;
      background-color: #000000;
    }

    .btn-danger-front {
      border: #000000 1px solid;
      color: #000000;
      background-color: #FFFFFF;
      font-weight: 700;
    }

    .btn-danger-front:hover {
      border: #000000 1px solid;
      color: #FFFFFF;
      background-color: #000000;
    }

    .container-1{
      padding: 30px;
      padding-top: 100px;
      padding-bottom: 100px;
    }

    .container-1 h1{
      text-align: center;
      font-size: 2rem;
      font-weight: 800;
      color: #FFCA08;

    }
    .container-1 p{
      text-align: center;
      font-size: 1.2rem;
     
       
      
    }

    .register-btn{
      background-color: #FFCA08;
      color: #fff;
      width: 300px;
      border: #FFCA08;
      font-weight: 800;
      text-align: center;
      display: block;
      margin-left: auto;
      margin-right: auto;
      margin-top: 50px;
    }

    .register-btn:hover{
      background-color: #000;
      color: #fff;
      width: 300px;
      border: #000;
      font-weight: 800;
      text-align: center;
      display: block;
      margin-left: auto;
      margin-right: auto;
      margin-top: 50px;
    }
  </style>
</head>

<body class="hold-transition login-page2 ">
  <header id="header" class="fixed-top2 ">

    <div class="container container-mainnav d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="{{url('/')}}"><img src="{{URL::asset('dist/img/logo.png')}}" alt=""></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="{{url('/')}}">Home</a></li>
          <li><a href="{{url('/aboutus')}}">About</a></li>
          <li><a href="{{url('/courses')}}">Courses</a></li>
          <li><a href="{{url('/promopage')}}">Promotions</a></li>
          <li><a href="{{url('/loginpage')}}">Login</a></li>
          <li class="active"><a href="{{url('/registernewstudent')}}">Register</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header>
  <div class="container-1">
    <div class="row">
    <div class="col-12">
      <h1>email address already exists!</h1>
    </div>
    <div class="col-12">
    <p>The email address: <strong>{{$email}}</strong> already exists.  Please use a different email address</p>

    </div>
    <div class="col-12">
    <a href="{{url('/registernewstudent')}}" class="register-btn btn btn-primary btn-block">Register</a>
    </div>
    </div>
  </div>
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
          <li>
            <h4>Essential Links</h4>
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
  <script>
    $('#addexam').click(function() {
      var exam = $('#exam').val();
      var elist = exam.split("-");
      var examid = elist[0];
      var examname = elist[1];
      $('#examtable').append('<tr>\
        <td>' + examname + '</td>\
      </tr>');
      var entrycount = $('#examentrycount').val();
      entrycount++;
      $('#examentrycount').val(entrycount);
      $('.examentrydata').append('<input type="hidden" id="examentryid' + entrycount + '" value="' + examid + '" name="examentryid' + entrycount + '">\
      <input type="hidden" id="examentryname' + entrycount + '" value="' + examid + '" name="examentryname' + entrycount + '">');

    });
  </script>

</body>

</html>