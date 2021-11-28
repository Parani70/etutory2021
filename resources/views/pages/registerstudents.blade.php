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
  <title>E Tutory.lk Register</title>
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
      .register-box{
        margin-left: auto;
        margin-right: auto;
        display: block;
        margin-top: 10vh;
        
        background-color: #EFEFEF;
      }

      .card{
        padding: 30px;
        width: 1000px;
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

      .login-logo p{
        font-size: 1.1rem;
        font-weight: 500;
      }

      #p1{
        font-size: 1.6rem;
        font-weight: 700;
      }
 
      .btn-primary-front{
        border: #FFCA08 1px solid;
        color: #FFFFFF;
        background-color: #FFCA08;
        font-weight: 700;
      }

      .btn-primary-front:hover{
        border: #000000 1px solid;
        color: #FFFFFF;
        background-color: #000000;
      }

      .btn-danger-front{
        border: #000000 1px solid;
        color: #000000;
        background-color: #FFFFFF;
        font-weight: 700;
      }

      .btn-danger-front:hover{
        border: #000000 1px solid;
        color: #FFFFFF;
        background-color: #000000;
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
      <li ><a href="{{url('/')}}">Home</a></li>
      <li><a href="{{url('/aboutus')}}">About</a></li>
      <li><a href="{{url('/courses')}}">Courses</a></li>
      <li><a href="{{url('/promopage')}}">Promotions</a></li>
      <li ><a href="{{url('/loginpage')}}">Login</a></li>
      <li class="active"><a href="{{url('/registernewstudent')}}">Register</a></li>
    </ul>
  </nav><!-- .nav-menu -->

</div>
</header> 
  <div class="register-box">
    <div class="login-logo">
      <p id="p1">eTutory.lk is the pioneers in the county to offer online dynamic model test papers.</p>
      <p>Currently we offer GCE O/L model papers in Sinhala and Tamil medium.
Soon we will be introducing model papers for Grade 6 to Grade 11, Grade 5 scholarship and London O/L & A/L.
</p>
<p>Register with us to get real experience of a exam environment and get to know the new additions and promotions.</p>
       <h2 id="loginh2">Student Registration From</h2>
      <!-- <a href="{{(url('/'))}}">
      <img src="{{URL::asset('dist/img/logo.png')}}" style="width: 300px; padding: 50px;" alt="">
      </a> -->
    </div>
    <?php echo '';
    while (false) {
    }
    ?>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body">

        

        <form action="{{url('/registerstudent')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Student Name <span style="color: crimson;">*</span></label>
                <input type="text" name="studentname" class="form-control" value="{{old('studentname')}}" placeholder="Full Name">
                @error('studentname')

                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Parent's/ Gurdian's Name: <span style="color: crimson;">*</span></label>
                <input type="text" name="parentname" class="form-control" value="{{old('parentname')}}" placeholder="Parent's/ Gurdian's Full Name">
                @error('parentname')

                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Address<span style="color: crimson;">*</span></label>
                <input type="text" name="address" class="form-control" value="{{old('address')}}" placeholder="Address">
                @error('address')

                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Telephone<span style="color: crimson;">*</span></label>
                <input type="text" name="telephone" class="form-control" value="{{old('telephone')}}" placeholder="Telephone">
                @error('telephone')

                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Mobile No </label>
                <input type="text" name="mobile" class="form-control" value="{{old('mobile')}}" placeholder="Mobile No">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Email<span style="color: crimson;">*</span></label>
                <input type="email" name="email" class="form-control" value="{{old('email')}}"  placeholder="Email">
                @error('email')

                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Language</label>
                <select class="form-control select2" id="language" name="language" style="width: 100%;">

                  <option value="English">English</option>
                  <option value="Sinhala">Sinhala</option>
                  <option value="Tamil">Tamil</option>

                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Payment Method for online Exams</label>
                <select class="form-control select2" id="paymethod" name="paymethod" style="width: 100%;">

                  <option value="Bank Transfer">Bank Transfer</option>
                  <option value="Card">Credit/Debit Card</option>

                </select>
              </div>
            </div>
          </div>
          <hr>
       
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Security Question</label>
                <select name="questionid" class="custom-select">
                  <option selected>Open this and select question</option>
                  @if(count($dataset['securityquestions']))

                  @foreach($dataset['securityquestions']->all() as $sec_question)
                  <option value="{{$sec_question->id}}">{{$sec_question->question}}</option>
                  @endforeach
                  @endif

                </select>
                @error('questionid')

                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Answer <span style="color: crimson;">*</span></label>
                <input type="text" name="answer" class="form-control"   value="{{old('answer')}}"placeholder="Answer">
                @error('answer')

                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Password <span style="color: crimson;">*</span></label>
                <input type="password" name="password" class="form-control" placeholder="Password">
                @error('password')

                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
                @if($dataset['passwordpolicy'][0]->minlength > 0)
                <small class="badge badge-warning">Password minimum length should be {{$dataset['passwordpolicy'][0]->minlength}}</small>
                @endif
                @if($dataset['passwordpolicy'][0]->uppercase == "Y")
                <small class="badge badge-warning">The password should contain an UPPERCASE letter</small>
                @endif
                @if($dataset['passwordpolicy'][0]->lowercase == "Y")
                <small class="badge badge-warning">The password should contain a lowercase letter</small>
                @endif
                @if($dataset['passwordpolicy'][0]->number == "Y")
                <small class="badge badge-warning">The password should contain a number</small>
                @endif
                @if($dataset['passwordpolicy'][0]->symbol == "Y")
                <small class="badge badge-warning">The password should contain a symbol</small>
                @endif
                
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Reconfirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Password">
                @error('password_confirmation')

                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Upload USer Image</label>
                <div class="custom-file">
                  <input type="file" name="userimage" class="custom-file-input" style="height:100%;" id="customFile">
                  <label class="custom-file-label" for="customFile">Upload User Image </label>
                </div>
              </div>
            </div>

          </div>



          <div class="row">

            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary-front btn-block">Register</button>
            </div>
            <div class="col-4">
              <a href="{{url('/')}}" class="btn btn-danger-front btn-block">Close</a>
            </div>
            <!-- /.col -->
          </div>
        </form>


        <!-- /.social-auth-links -->


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