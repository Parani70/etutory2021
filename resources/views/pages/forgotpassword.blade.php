<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>E Tutory.lk | Forgot Password</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{URL::asset('dist/homeassets/img/favicon.png')}}" rel="icon">
  <link href="{{URL::asset('dist/homeassets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{URL::asset('dist/homeassets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{URL::asset('dist/homeassets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
  <link href="{{URL::asset('dist/homeassets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{URL::asset('dist/homeassets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{URL::asset('dist/homeassets/vendor/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{URL::asset('dist/homeassets/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
     <!-- Favicon -->
     <link rel="icon" type="image/png" href="{{URL::asset('dist/img/favicon.png')}}" />

  <!-- Template Main CSS File -->
  <link href="{{URL::asset('dist/homeassets/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Tempo - v2.0.0
  * Template URL: https://bootstrapmade.com/tempo-free-onepage-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <style>
    #forgotpassemail {
      padding: 10px;
    }
  </style>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top "  >
    <div class="container d-flex align-items-center">

    <h1 class="logo mr-auto"><a href="{{url('/')}}"><img src="{{URL::asset('dist/img/logo.png')}}" alt=""></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="{{url('/')}}">Home</a></li>
          <li><a href="{{url('/aboutus')}}">About</a></li>
          <li><a href="#services">Courses</a></li>
          <li><a href="#contact">Promotions</a></li>
          <li><a href="{{url('/dashboard')}}">Dashboard</a></li>
          <li><a href="{{url('/loginpage')}}">Login</a></li>
          <li><a href="{{url('/registernewstudent')}}">Register</a></li>


        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->


  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" style="margin-top: 30px;">

        <div class="section-title">

          <h3><span>Request for new Password</span></h3>


        </div>

        <div class="row content">

          <div class="col-lg-12 pt-8 pt-lg-0">
            <p>
              Please eter your email address to reset the password!
            </p>
            <form role="form" action="{{ url('/sendforgotemail') }}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="form-group">
                <label for="forgotpassemail">Email address</label>
                <input type="email" class="col-md-6 form-control" id="forgotpassemail" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Security Question</label>
                <select class="form-control" name="questionid" id="exampleFormControlSelect1">
                  @if(count($dataset['securityquestions']) > 0)
                    @foreach($dataset['securityquestions']->all() as $secquestion)
                    <option value="{{$secquestion->id}}">{{$secquestion->question}}</option>
                    @endforeach

                  @endif
                  
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Answer</label>
                <input name="answer" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter answer for the security question ">
                @error('answer')
            
            <div class="alert alert-danger" role="alert">
            Please enter the correct answer for the selected security question.
            </div>
            @enderror
              </div>
              <button type="submit" class="btn-learn-more">Reset</a>
            </form>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Pricing Section ======= -->




  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">



    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright <strong><span>Online LMS</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/tempo-free-onepage-bootstrap-theme/ -->
          Designed by <a href="https://google.com/">Hardnet Services</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>