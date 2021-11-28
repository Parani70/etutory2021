<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>E Tutory.lk | Promotions</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">
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
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Template Main CSS File -->
  <link href="{{URL::asset('dist/homeassets/css/style.css')}}" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::asset('dist/css/adminlte.min.css')}}">
  <!-- =======================================================
  * Template Name: Tempo - v2.0.0
  * Template URL: https://bootstrapmade.com/tempo-free-onepage-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top2 ">

    <div class="container container-mainnav d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="{{url('/')}}"><img src="{{URL::asset('dist/img/logo.png')}}" alt=""></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
      <ul>
          
           
          <li><a href="{{url('/courses')}}">Buy Model Exams</a></li>
          <li class="active"><a href="{{url('/promopage')}}">Promotions</a></li>
          <li><a href="{{url('/loginpage')}}">Exam Centre</a></li>
          <li><a href="{{url('/loginpage')}}">Login</a></li>
          <li><a href="{{url('/registernewstudent')}}">Register</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <section id="about" class="about">
    <div class="container">

      <div class="section-title">
        <h2>Promotions</h2>
        <h3>Promotions <span>We Offer</span></h3>

      </div>
    </div>
    
    <div class="container">
      <div class="row">

        @if(count($dataset['promodata']) > 0)

        @foreach($dataset['promodata']->all() as $promo)

        <div class="col-md-4">
          <a href="{{url('/loginpage')}}">
            <div class="info-box bg-warning">
              <span class="info-box-icon"><i class="far fa-star"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{$promo->promoname}}</span>
                <span class="info-box-text"><strong>Grade</strong> : {{$promo->gradename}}</span>
                <span class="info-box-number">LKR {{$promo->price}}</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 0%"></div>
                </div>
                <span class="progress-description">
                  {{$promo->promodescription}}
                </span>
                <button type="button" class="mt-2 btn btn-light">Buy Now</button>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
        </div>
        @endforeach

        @endif

      </div>
    </div>
  </section><!-- End About Section -->

  <!-- ======= Footer ======= -->
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

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{URL::asset('dist/homeassets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{URL::asset('dist/homeassets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{URL::asset('dist/homeassets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
  <script src="{{URL::asset('dist/homeassets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{URL::asset('dist/homeassets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{URL::asset('dist/homeassets/vendor/venobox/venobox.min.js')}}"></script>
  <script src="{{URL::asset('dist/homeassets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
  <script src="{{URL::asset('dist/js/jssor.slider-28.0.0.min.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{URL::asset('dist/homeassets/js/main.js')}}"></script>
  <script>
    $('.carousel').carousel()
  </script>

</body>

</html>