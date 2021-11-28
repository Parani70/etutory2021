<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>E Tutory.lk | HOME</title>
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
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Template Main CSS File -->
  <link href="{{URL::asset('dist/homeassets/css/style.css')}}" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::asset('dist/css/adminlte.min.css')}}">
     <!-- Favicon -->
     <link rel="icon" type="image/png" href="{{URL::asset('dist/img/favicon.png')}}" />
  <!-- =======================================================
  * Template Name: Tempo - v2.0.0
  * Template URL: https://bootstrapmade.com/tempo-free-onepage-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="index.html"><img src="{{URL::asset('dist/img/logo.png')}}" alt=""></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="{{url('/')}}">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Courses</a></li>
          <li><a href="#contact">Promotions</a></li>
          <li><a href="{{url('/loginpage')}}">Login</a></li>
          <li><a href="{{url('/registernewstudent')}}">Register</a></li>


        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div class="row">
        <div class="col-md-6">
          <h3>Welcome to <strong>Online LMS</strong></h3>
          <h1>An Online Exam System</h1>

          <a href="#about" class="btn-get-started scrollto">Get Started</a>
        </div>
        <div class="col-md-6">
          <div class="loginhomebox">
            <div class="card">
              <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('login') }}" method="post">
                  @csrf
                  <div class="input-group mb-3">
                 
                    <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title">
          <h2>About</h2>
          <h3>Learn More <span>About Us</span></h3>
          <p>We engaged in enhancing the academic knowledge of the students and facilitating the online lerning using the state of the art technology.</p>
        </div>
        <?php
        $n = 0;
        ?>
        <div class="aboutushome row content">
          <div class="col-lg-12">
            <p>
              During the Pandemic of COVUD19, we identified and recognized the power of online learning and would like to harness and pioneer the industry as trend setters.
              We are committed to provide a better environment for learning and to make this facility equally available at an affordable cost in the every nook and corner of the country and we are committed to continue to improve our service using the up to date cutting edge technology.

            </p>
            <p>
            In our education system, students are mostly evaluated through public competitive exams and that evaluation system demands the performance of the students in a controlled environment. Unless the students are adopted to the examination conditions, however much talented and knowledgeable the students are, they may not be able to exhibit the best performance during the examination.  Our organization is providing simulated examinations conditions very similar to the public exams so that students can practice and familiarize themselves and adopt to the examinations conditions so that they would perform the best at the public exams.
            </p>
            <p>Our system would also help the students to identify their week area within a particular subject and report the same to the student to provide an early opportunity to improve the knowledge and skills on those areas to perform. In addition to the above, our system also would assist the student to master each chapter of the subject.</p>
           
          </div>
          <div class="col-lg-12 pt-4 pt-lg-0">
            
         
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container">

        <div class="section-title">
          <h2>Exams</h2>
          <h3>Our Best <span>Exams</span></h3>
         <!-- <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>-->
        </div>

        <div class="row">
          @if(count($dataset['examdata']) > 0)
          @foreach($dataset['examdata']->all() as $exam)
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning">
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{$exam->coursename}}</span>
                @php
                $examgrade = $exam->gradeid;
                $examsubject = $exam->subjectid;
                $pricethis =0;
                foreach($dataset['pricingdata']->all() as $price){
                if($price->gradeid == $exam->gradeid & $price->subjectid == $exam->subjectid){
                $pricethis = $price->price;
                }
                }
                @endphp
                <span class="info-box-number">LKR {{ number_format($pricethis,2)}}</span>


                <span class="progress-description">
                  Grade : {{$exam->gradename}}
                </span>
                <span class="progress-description">
                  Subject : {{$exam->subjectname}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          @endforeach
          @endif

        </div>
        <!--<div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="box">
              <h3>Cource 01</h3>
              <h4><sup>$</sup>0<span> / month</span></h4>

              <p>commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nul</p>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Buy Now</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
            <div class="box recommended">
              <span class="recommended-badge">Recommended</span>
              <h3>Cource 02</h3>
              <h4><sup>$</sup>19<span> / month</span></h4>
              <p>commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nul</p>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Buy Now</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
            <div class="box">
              <h3>Cource 03</h3>
              <h4><sup>$</sup>29<span> / month</span></h4>
              <p>commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nul</p>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Buy Now</a>
              </div>
            </div>
          </div>

        </div>-->

      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= Promotion Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container">

        <div class="section-title">
          <h2>Promotions</h2>
          <h3>Our Best <span>Promotions</span></h3>
          <!--<p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>-->
        </div>
        <div class="row">
          @if(count($dataset['promotiondata']) > 0)
          @foreach($dataset['promotiondata']->all() as $promotion)
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning">
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{$promotion->promoname}}</span>

                <span class="info-box-number">LKR {{ number_format($promotion->price,2)}}</span>


                <span class="progress-description">
                  {{$promotion->promodescription}}
                </span>

              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          @endforeach
          @endif

        </div>
        <!--<div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="box">
              <h3>Promotions 01</h3>
              <h4><sup>$</sup>0<span> / month</span></h4>
              <?php echo ''; ?>
              <p>commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nul</p>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Buy Now</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
            <div class="box recommended">
              <span class="recommended-badge">Recommended</span>
              <h3>Promotions 02</h3>
              <h4><sup>$</sup>19<span> / month</span></h4>
              <p>commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nul</p>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Buy Now</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
            <div class="box">
              <h3>Promotions 03</h3>
              <h4><sup>$</sup>29<span> / month</span></h4>
              <p>commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nul</p>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Buy Now</a>
              </div>
            </div>
          </div>

        </div>-->

      </div>
    </section><!-- End Promotions Section -->


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