<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | E Learnig Centre</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{URL::asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{URL::asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{URL::asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{URL::asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{URL::asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{URL::asset('plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
     <!-- Favicon -->
     <link rel="icon" type="image/png" href="{{URL::asset('dist/img/favicon.png')}}" />
  <style>
    #cartbadge{
      background-color: crimson;
      width: 30px;
      height: 30px;
      padding: 1px;
      text-align: center;
      margin-left: 30px;
      margin-top: -20px;
      border-radius: 100%;
      color: white;
      padding-bottom: 2px;
    
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    @include('includes.navbar')
    @include('includes.sidebarstudent')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-10">
              <h1 class="m-0 text-dark">E Learning Centre</h1>
            </div><!-- /.col -->
            <div class="col-sm-2">
              <a href="{{url('/shoppingcartpage')}}">
              <div class="shoppingcarticonbox">
                <img src="{{URL::asset('dist/homeassets/img/shopping-bag.png')}}" style="height: 40px;"></imge>
                 
                  <div id="cartbadge">{{$dataset['cartentries']}}</div>
                

              
                
              </div>
              </a>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->

          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <h4>Online Exam Centre</h4>
                  <p>You have bought {{$dataset['exampuchasedata']}} exams already. 
                  @if($dataset['exampuchasedata'] != 0 )

                  These will expire in {{$dataset['expiredays']}} days' time. 

                  @endif
                 
                  If you want to sit for the exams now, go to the test center</p>
                  <a href="{{url('/examhome')}}" class="btn btn-block btn-warning col-md-3" >Test Centre</a>
                </div>
              </div>
            </div>
            <!-- <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h4>Online Learning Centre</h4>
                  <div class="alert alert-success alert-dismissible">

                    <h5><i class="icon fas fa-check"></i>Comming Soon
                      !</h5>
                  </div>
                </div>
              </div>
            </div> -->
          </div>
          <!-- /.row -->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    Buy an Exam
                  </h3>
                </div>
                <div class="card-body">
                  <form role="form" action="{{url('/buynewexam') }}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                      <label>Subject</label>
                      <select class="form-control select2" name="subject" id="subject" style="width: 100%;">
                        @if(count($dataset['subjectdata']) > 0)
                        @foreach($dataset['subjectdata']->all() as $subject)

                        <option value="{{$subject->id.'-'.$subject->subject}}">{{$subject->subject}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Exam</label>
                      <select class="form-control select2" name="examlist" id="examlist" style="width: 100%;">
                        @if( count($dataset['coursedata']) > 0 )

                        @foreach($dataset['coursedata']->all() as $course)
                        @php 
                        $pricingdatacheck   = DB::table('exampricing')->where([

                                'examtypeid' => $course->id,
                            ])->count();
                        @endphp
                        @if($pricingdatacheck > 0)
                        <option value="{{$course->id}}">{{$course->coursename}}</option>
                        @endif
                        
                        @endforeach
                        @endif

                      </select>
                    </div>

                    <button type="submit" class="btn  btn-info col-sm-3">Buy Now</button>
                    <button type="submit" name="addtocart" value="addtocart" class="btn  btn-info col-sm-3">Add to Cart</button>

                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    Promotions
                  </h3>
                </div>
                <div class="card-body">
                  <form role="form" action="{{url('/savematchingquestion') }}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}


                  </form>

                  <div class="row">
                    @if(count($dataset['promotiondata']) > 0)

                    @foreach($dataset['promotiondata']->all() as $promo)
                    <div class="col-sm-4">
                      <a href="{{url('/promotionselect/'.$promo->id)}}">
                        <div class="info-box bg-warning">
                          <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text">{{$promo->promoname}}</span>
                            <span class="info-box-text"><strong>Grade</strong> : {{$promo->gradename}}</span>
                            <span class="info-box-number">{{$promo->paperscount}} Papers</span>
                            <span class="info-box-text">{{$promo->price}} LKR</span>
                          </div>
                          <!-- /.info-box-content -->
                        </div>
                      </a>

                      <!-- /.info-box -->
                    </div>
                    @endforeach
                    @endif


                  </div>

                </div>
              </div>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
    &copy; Copyright <strong><span>Metro tech Systems (Pvt) Ltd</span></strong>. All Rights Reserved
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{URL::asset('plugins/jquery/jquery.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{URL::asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- ChartJS -->
  <script src="{{URL::asset('plugins/chart.js/Chart.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{URL::asset('plugins/sparklines/sparkline.js')}}"></script>
  <!-- JQVMap -->

  <!-- jQuery Knob Chart -->
  <script src="{{URL::asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{URL::asset('plugins/moment/moment.min.js')}}"></script>
  <script src="{{URL::asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{URL::asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- Summernote -->
  <script src="{{URL::asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{URL::asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{URL::asset('dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{URL::asset('dist/js/demo.js')}}"></script>
  <script type="text/javascript">
    window.onload = function() {
      var responseMessege = "{{@session('response')}}";
      var edit_responseMessege = "{{@session('edit_response')}}";
      var delete_responseMessege = "{{@session('delete_response')}}";

      if (responseMessege != '') {
        $(document).Toasts('create', {
          class: 'bg-info',
          autohide: true,
          delay: 2500,
          title: 'Successful!',

          body: 'New Grade : <b>' + responseMessege + '</b> saved successfully.'
        })
      }

      if (edit_responseMessege != '') {
        $(document).Toasts('create', {
          class: 'bg-info',
          autohide: true,
          delay: 2500,
          title: 'Updated Successful!',

          body: 'The Grade : <b>' + edit_responseMessege + '</b> updated successfully.'
        })
      }

      if (delete_responseMessege != '') {
        $(document).Toasts('create', {
          class: 'bg-warning',
          autohide: true,
          delay: 2500,
          title: 'Deletion Successful!',

          body: 'Grade with ID: <b>' + delete_responseMessege + '</b> removed successfully.'
        })
      }

      $('#subject').change(function() {
        var subjectval = $('#subject').val();
        console.log(subjectval);
        var splitlist = subjectval.split("-");
        var subjectid = splitlist[0];


        $.get('/getexamdataforsubject/' + subjectid, function(response) {
          $('#examlist').empty();
          var responseSize = response.length;
          var i = 0;
          while (responseSize > i) {

            $('#examlist').append('<option value="' + response[i]['id'] + '">' + response[i]['coursename'] + '</option>');

            i++;
          }


        });
      });
    }
  </script>
</body>

</html>