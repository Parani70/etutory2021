<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | Paper Correction</title>
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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{URL::asset('dist/img/favicon.png')}}" />
</head>

<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">

    @include('includes.navbar')
    @include('includes.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Paper Correction</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">

            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <dl class="row">
                    <dt class="col-sm-2">Exam Type : </dt>
                    <dd class="col-sm-2">{{$dataset['questiondata'][0]->examtypename}}</dd>
                    <dt class="col-sm-2">Subject : </dt>
                    <dd class="col-sm-2">{{$dataset['questiondata'][0]->subjectname}}</dd>
                    <dt class="col-sm-2">Grade : </dt>
                    <dd class="col-sm-2">{{$dataset['questiondata'][0]->gradename}}</dd>
                  </dl>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <form role="form" action="{{url('/complatepapercorrection') }}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}

              
                <div class="card-body">
                  <dl class="row">
                    <dt class="col-sm-2">Question : </dt>
                    <dd class="col-sm-10">{!!$dataset['questiondata'][0]->questionheader!!}</dd>
                  </dl>
                  <dl class="row">
                    <dt class="col-sm-2">Correction Guidline : </dt>
                    <dd class="col-sm-10">{!!$dataset['questionSubData'][0]->crrectionguid!!}</dd>
                  </dl>
                  <dl class="row">
                    <dt class="col-sm-2">Answer Given : </dt>
                    <dd class="col-sm-10">{!!$dataset['examAnswerData'][0]->answer!!}</dd>
                  </dl>
                  <dl class="row">
                    @if(count($dataset['questionpendata']) > 0)

                      @foreach($dataset['questionpendata']->all() as $penentry)

                      <img src="{{url('storage/answercanvas/'.substr( $penentry->canvas,19))}}" style="border: 1px solid #000;" width="100%" />

                      @endforeach

                    @endif
                  </dl>
                  <dl class="row">
                    <dt class="col-sm-2">Marks Given : </dt>
                    <dd class="col-sm-10"> <input type="number" name="marks" class="col-md-2 form-control" placeholder="Marks"></dd>
                  </dl>
                  <dl class="row">
                    <dt class="col-sm-2">Allocated Marks : </dt>
                    <dd class="col-sm-10">{{$dataset['questiondata'][0]->marksallocated}}</dd>
                  </dl>
                </div>
                <div class="card-footer">
                <input type="hidden"  value="{{$dataset['examseatid']}}" name="examseatid">
                <input type="hidden"  value="{{$dataset['questionid']}}" name="questionid">
                  <div class="row">
                    <div class="col-md-3">      <button type="submit" id="donebutton" class="btn btn-success">Completed</button></div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3">      <button type="button" id="donebutton" class="btn btn-info">Previous</button>
                    <button type="button" id="donebutton" class="btn btn-info">Next</button></div>
                  </div>
                </div>
                </form>
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
  <!-- bs-custom-file-input -->
  <script src="{{URL::asset('/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <!-- AdminLTE App -->
  <script src="{{URL::asset('dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{URL::asset('dist/js/demo.js')}}"></script>
  <script>
      $('.nav-link').removeClass('active');
     
     $('#papercorrectionlink').addClass('active');
  </script>

</body>

</html>