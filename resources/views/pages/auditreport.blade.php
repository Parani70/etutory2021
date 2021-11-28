<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | Audit Report</title>
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

  <link rel="stylesheet" href="{{URL::asset('dist/css/bootstrap-datepicker.css')}}">
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
                  <h3 class="card-title">Audit Report</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{url('/generateauditreport') }}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="card-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">From Date</label>
                      <input type="text" class="form-control datepicker" name="fromdate" placeholder="From Date" autofocus>
                      @error('fromdate')

                      <div class="alert alert-danger" role="alert">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">To Date</label>
                      <input type="text" class="form-control datepicker" name="todate" placeholder="To Date" autofocus>
                      @error('todate')

                      <div class="alert alert-danger" role="alert">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Action</label>
                      <select name="action" class="form-control select2" style="width: 100%;">
                          <option value="all">All</option>
                          <option value="create_user">Create User</option>
                          <option value="edit_user">Edit User</option>
                          <option value="remove_user">Remove User</option>
                          <option value="create_question">Create Question</option>
                          <option value="edit_question">Edit Question</option>
                          <option value="remove_question">Remove Question</option>
                          <option value="approve_question">Approve Question</option>
                          <option value="reject_question">Reject Question</option>
                          <option value="onhold_question">On Hold Question</option>                      
                          <option value="create_masterdata">Create Master Data</option>
                          <option value="edit_masterdata">Edit Master Data</option>
                          <option value="remove_masterdata">Remove Master Data</option>
                          <option value="create_pricing">Create Pricing</option> 
                          <option value="edit_pricing">Edit Pricing</option>
                          <option value="create_promocode">Create Promo Code</option>
                          <option value="create_promotion">Create Promotion</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Action on</label>
                      <select name="actionon" class="form-control select2" style="width: 100%;">                      
                          @if(count($dataset['userdata']) > 0)

                              @foreach($dataset['userdata']->all() as $userEntry)
                              <option value="{{$userEntry->id}}">{{$userEntry->name}}</option>

                              @endforeach
                          @endif
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Done By</label>
                      <select name="doneby" class="form-control select2" style="width: 100%;">
                      <option value="any">Any User</option>
                        @if(count($dataset['userdata']) > 0)

                          @foreach($dataset['userdata']->all() as $userentry)

                          <option value="{{$userentry->id}}">{{$userentry->id.'-'.$userentry->name}}</option>

                          @endforeach

                       

                        @endif
                        
                      

                      </select>
                    </div>

                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Generate</button>
                   
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
  <script src="{{URL::asset('dist/js/bootstrap-datepicker.js')}}"></script>

  
  <script>
     $('.datepicker').datepicker({
    format: 'dd/mm/yyyy',     
      autoclose: true
  });
  </script>

</body>

</html>