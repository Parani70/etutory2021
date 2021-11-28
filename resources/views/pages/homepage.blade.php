<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>E Tutory.lk | HOME</title>
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

  </style>
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
          <li><a href="{{url('/promopage')}}">Promotions</a></li>
          <li><a href="{{url('/loginpage')}}">Exam Centre</a></li>
          <li><a href="{{url('/loginpage')}}">Login</a></li>
          <li><a href="{{url('/registernewstudent')}}">Register</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <div class="row">
    <div class="col-md-3 homeexam-sidebar">
      <h4>Our Offer</h4>
      <div class="card homeexamcard">
        <div class="card-body">
          <h5>Year End Model Exams</h5>
          <hr>
          <p>Curriculum : Local Syllabus</p>
          <p>Grades : Grade 6-11</p>
          <p>Medium : Sinhala / Tamil</p>
          <a href="{{url('/courses')}}" class="btn btn-warning">More Details..</a>
        </div>
      </div>
      <div class="card homeexamcard">
        <div class="card-body">
          <h5>Chapters wise Model Exams</h5>
          <hr>
          <p>Curriculum : Local Syllabus</p>
          <p>Grades : Grade 6-11</p>
          <p>Medium : Sinhala / Tamil</p>
          <a href="{{url('/courses')}}" class="btn btn-warning">More Details..</a>
        </div>
      </div>
      <div class="card homeexamcard">
        <div class="card-body">
      
          <h5>  Scholarship Model Exams</h5>
          <hr>
          <p>Curriculum : Local Syllabus</p>
          <p>Grades : Grade 5</p>
          <p>Medium : Sinhala / Tamil</p>
          <a href="{{url('/courses')}}" class="btn btn-warning">More Details..</a>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="slider-boot">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>

          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div id="sliderone">
                <h1 class="headerof-slider">An Online Exam Centre</h1>
                <p class="text-slider">Practice makes you perfect.</p>
                <p class="text-slider">Prove yourself to yourself, not others.</p>
              </div>
            </div>
            <div class="carousel-item">
              <div id="slidertwo">
                <h1 class="headerof-slider">An Online Exam Centre</h1>
                <p class="text-slider">Register with us, </p>
                <p class="text-slider">login and buy online model exams.</p>

              </div>
            </div>

          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-md-4">
          <div class="card homefeature-card">
            <div class="card-body">
              <h4>Promotions</h4>
              <p>5 Model Paper Promotions</p>
              <h5>Save 30%</h5>
              <hr>
              <p>3 Model Paper Promotions</p>
              <h5>Save 25%</h5>
              <a href="{{url('/promopage')}}" class="btn btn-warning">More Details..</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card homefeature-card2">
            <div class="card-body">
              <h4>How our system works</h4>
              <ul>
                <li>Our online model exams are time bound and dynamic.  Two students will never get the same model exam paper for the same subject and grade.</li>
                <li>Exam validity is 30 days.  From the purchase date, within 30 days you can sit for an exam.</li>
                <li>For the Part I model exam, results will be available immediately available in the history area.</li>
                <li>For Part II papers, results will be emailed to you within 5 working days.</li>
                <li>A detailed email with analysis on your performance will be sent to you after each exam is completed.</li>
              </ul>
              <a href="{{url('/loginpage')}}" class="btn btn-warning">Learn More..</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
        <div class="card homefeature-card">
            <div class="card-body">
              <h2>Try our sample exams</h2>
              <h3 class="mt-5 text-warning">FREE OF CHARGE</h3>
              <a href="{{url('/loginpage')}}" class="mt-4 btn btn-warning">Click here..</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="container loginrow-container-res">

    <div class="row">

      <div class="col-md-6">
        <div class="loginhomebox ">
          <div class="card">
            <div class="card-body login-card-body">
              <p class="login-box-msg">If you are already registered with us, login here, else <a href="{{url('/registernewstudent')}}">Register</a></p>


              <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">

                  <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="input-group mb-3">
                  <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

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
                <!-- <a href="{{url('/registernewstudent')}}" class="text-center">Register a new membership</a>-->
              </p>
            </div>
            <!-- /.login-card-body -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="container-fluid">
    <div class="container">
      <div class="row iconboxrow">
        <div class="col-md-4">
          <div class="row">
            <div class="col-md-4 col-4">
              <i class="homeiconset1 fas fa-graduation-cap"></i>
            </div>
            <div class="col-md-8 col-8 eduiconinfo">
              <h5>Triumph</h5>
              <p>The difference between try and triumph is a little umph. Experience you gain with us will give you that little umph.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="row">
            <div class="col-md-4 col-4">
              <i class="homeiconset1 fas fa-paper-plane "></i>
            </div>
            <div class="col-md-8 col-8 eduiconinfo">
              <h5>Success</h5>
              <p>There are no secrets to success. It is the result of preparation and hard work. You are at the right place to prepare your self. </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="row">
            <div class="col-md-4 col-4">
              <i class="homeiconset1 fa fa-ticket-alt"></i>

            </div>
            <div class="col-md-8 col-8 eduiconinfo">
              <h5>Confidence</h5>
              <p>If you believe in what you're doing, you will be successful in what you do. Boost your self belief with our mock online exams.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->


  <!--
  <div class="container">
    <div class="row coursesblockrow">
      <div class="col-md-3 ourcourses-block1">
        <h4>Our</h4>
        <h4>Courses</h4>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.nisi laborum minus cupiditate. P</p>
        <a href="#" id="btn-courses" class="btn">View Course</a>
      </div>
      <div class="col-md-3 course1-block">
        <div class="row">
          <div class="col">
            <span class="course-datebadge">AUG 12</span>
          </div>
        </div>
        <div class="row course-bottomblock">
          <div class="col-md-10">
            <span class="course-namebadge">Chemical Engineering</span>
            <span class="course-pricebadge">Rs 1999</span>
          </div>
          <div class="col-md-2 d-flex align-items-center">
            <i class=" courses-arrow fa fa-chevron-right " aria-hidden="true"></i>
          </div>

        </div>
      </div>
      <div class="col-md-3 course2-block">
        <div class="row">
          <div class="col">
            <span class="course-datebadge">MAR 02</span>
          </div>
        </div>
        <div class="row course-bottomblock">
          <div class="col-md-10">
            <span class="course-namebadge">Information Systems</span>
            <span class="course-pricebadge">FREE</span>
          </div>
          <div class="col-md-2 d-flex align-items-center">
            <i class=" courses-arrow fa fa-chevron-right " aria-hidden="true"></i>
          </div>

        </div>
      </div>
      <div class="col-md-3 course3-block">
        <div class="row">
          <div class="col">
            <span class="course-datebadge">JUNE 21</span>
          </div>
        </div>
        <div class="row course-bottomblock">
          <div class="col-md-10">
            <span class="course-namebadge">Work Life Balance</span>
            <span class="course-pricebadge">Rs 2299</span>
          </div>
          <div class="col-md-2 d-flex align-items-center">
            <i class=" courses-arrow fa fa-chevron-right " aria-hidden="true"></i>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="container secondmenublock">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link active" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Events</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Courses</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pages</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Shortcode</a>
      </li>
    </ul>
  </div>

  <hr>
  <div class="container">
    <div class="row learnfromblock">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-3">
            <i class="bluciconset fas fa-paper-plane"></i>
          </div>
          <div class="col-md-3">
            <i class=" bluciconset fas fa-sliders-h"></i>

          </div>
          <div class="col-md-3">
            <i class="bluciconset fas fa-graduation-cap"></i>
          </div>
          <div class="col-md-3">
            <i class="bluciconset fa fa-pencil-alt"></i>
          </div>
          <div class="col-md-3">
            <i class="bluciconset fas fa-lightbulb"></i>
          </div>
          <div class="col-md-3">
            <i class="bluciconset fas fa-cloud"></i>
          </div>
          <div class="col-md-3">
            <i class="bluciconset fas fa-flask"></i>
          </div>
          <div class="col-md-3">
            <i class="bluciconset fas fa-map-marker"></i>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <h4>Learn From The Best Lecturers</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum facere eligendi deserunt vero sed mollitia ratione, tem</p>
        <a class="btn  btn-outline-dark" href="#"> <i class="fas fa-graduation-cap"></i> Details</a>
      </div>
    </div>
  </div>-->


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