<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | Add Promotion</title>
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
          <!-- Small boxes (Stat box) -->

          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <div class="col-md-8">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add new promotion</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{url('/savepromotion') }}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Promotion Type</label>
                      <select class="form-control select2" name="promotype" id="promotype"  style="width: 100%;">
                        <option value="single">Single Subject</option>
                        <option value="multiple">Multiple Subjects</option>
                        
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Grade</label>
                      <select class="form-control select2" name="grade" id="grade"  style="width: 100%;">
                        
                        @if(count($dataset['gradedata']) > 0)
                        <option value="-- SELECT GRADE --">-- SELECT GRADE --</option>
                          @foreach($dataset['gradedata']->all() as $grade)

                           <option value="{{$grade->id.'-'.$grade->grade}}">{{$grade->grade}}</option>

                          @endforeach

                        @endif
                        
                          
                       
                        
                      </select>
                      @error('grade')

                      <div class="alert alert-danger" role="alert">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Promotion Name</label>
                      <input type="text" class="form-control" name="promoname" placeholder="Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Promotion Description</label>
                      <input type="text" class="form-control" name="promodescription" placeholder="Description">
                    </div>
                    <div class="form-group singlvaluegroup">
                      <label for="exampleInputEmail1">Number of Papers</label>
                      <input type="text" class="form-control col-sm-3" name="papercount" placeholder="Number of Papers">
                    </div>

                    <div class="form-group multivaluegroup" style="display: none;">
                      <label for="exampleInputEmail1">Number of Exams</label>
                      <input type="text" class="form-control col-sm-3" name="examcount" placeholder="Number of Papers">
                    </div>

                    <div class="form-group multivaluegroup" style="display: none;">
                      <label for="exampleInputEmail1">Max Papers per Exam</label>
                      <input type="text" class="form-control col-sm-3" name="maxpapers" placeholder="Number of Papers">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price</label>
                      <input type="text" class="form-control text-right col-sm-3" name="price" placeholder="0.00">
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{url('/promotionsmanager')}}" class="btn btn-danger">Cancel</a>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- /.row (main row) -->
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
  <!-- AdminLTE App -->
  <script src="{{URL::asset('dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{URL::asset('dist/js/demo.js')}}"></script>
  <script>
  $('#promotype').change(function(){
    var propType = $('#promotype').val();
    console.log('got it'+propType);

    if(propType=='single'){
      $('.singlvaluegroup').show();
      $('.multivaluegroup').hide();
    }else{
      $('.singlvaluegroup').hide();
      $('.multivaluegroup').show();
    }

  });
  </script>
</body>

</html>