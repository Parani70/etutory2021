<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | Password Policy management</title>
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
  <!-- DataTables -->
  <link rel="stylesheet" href="{{URL::asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  
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
              <h1 class="m-0 text-dark">Password Policy</h1>
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
              <div class="card">
                <div class="card-body">
                  <form role="form" action="{{url('/savepasswordpolicy') }}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="form-group">
                      <label for="exampleInputEmail1">Minimum password length</label>
                      @if(count($dataset['passwordpolicy']) > 0)
                      <input class="col-md-4 form-control" type="number" name="passwordlength" id="exampleInputEmail1" value="{{$dataset['passwordpolicy'][0]->minlength}}" placeholder="Enter Password Length">
                      @else
                      <input class="col-md-4 form-control"  type="number" name="passwordlength" id="exampleInputEmail1" placeholder="Enter Password Length">
                      @endif


                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Minimum Login Attempts</label>
                      @if(count($dataset['passwordpolicy']) > 0)
                      <input class="col-md-4 form-control" type="number" name="minattempts" id="exampleInputEmail1" value="{{$dataset['passwordpolicy'][0]->minattempts}}" placeholder="Enter Password Length">
                      @else
                      <input class="col-md-4 form-control"  type="number" name="minattempts" id="exampleInputEmail1" placeholder="Enter Minimum Login Attempts">
                      @endif


                    </div>
                    <div class="form-check">
                      @if(count($dataset['passwordpolicy']) > 0 )
                      @if(trim($dataset['passwordpolicy'][0]->uppercase) == 'Y')
                      <input class="form-check-input" type="checkbox" name="uppercase"    id="defaultCheck1" checked>
                      @else
                      <input class="form-check-input" type="checkbox" name="uppercase" id="defaultCheck1">
                      
                      @endif

                      @else
                      <input class="form-check-input" type="checkbox" name="uppercase" id="defaultCheck1">
                      @endif

                      <label class="form-check-label" for="defaultCheck1">
                        Require at least one uppercase letter
                      </label>
                    </div>
                    <div class="form-check">
                      @if(count($dataset['passwordpolicy']) > 0 )
                      @if($dataset['passwordpolicy'][0]->lowercase == 'Y')
                      <input class="form-check-input" type="checkbox" name="lowercase" id="defaultCheck1" checked>
                      @else
                      <input class="form-check-input" type="checkbox" name="lowercase" id="defaultCheck1">
                      @endif

                      @else
                      <input class="form-check-input" type="checkbox" name="lowercase" id="defaultCheck1">
                      @endif

                      <label class="form-check-label" for="defaultCheck1">
                        Require at least one lowercase letter
                      </label>
                    </div>
                    <div class="form-check">
                     
                      @if(count($dataset['passwordpolicy']) > 0 )
                      @if($dataset['passwordpolicy'][0]->number == 'Y')
                      <input class="form-check-input" type="checkbox" name="number" id="defaultCheck1" checked>
                      @else
                      <input class="form-check-input" type="checkbox" name="number" id="defaultCheck1">
                      @endif

                      @else
                      <input class="form-check-input" type="checkbox" name="number" id="defaultCheck1">
                      @endif
                      <label class="form-check-label" for="defaultCheck1">
                        Require at least one number
                      </label>
                    </div>
                    <div class="form-check">
                      
                      @if(count($dataset['passwordpolicy']) > 0 )
                      @if($dataset['passwordpolicy'][0]->symbol == 'Y')
                      <input class="form-check-input" type="checkbox" name="symbol" id="defaultCheck1" checked>
                      @else
                      <input class="form-check-input" type="checkbox" name="symbol" id="defaultCheck1">
                      @endif

                      @else
                      <input class="form-check-input" type="checkbox" name="symbol" id="defaultCheck1">
                      @endif
                      <label class="form-check-label" for="defaultCheck1">
                        Require at least one symbol character
                      </label>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary">Save</button>

                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row">

            <div class="col-md-8">
              <div class="card">

                <div class="card-body">
                  <h4>Security Questions</h4>
                  <table id="master-datatable" class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Security Question</th>
                        <th style="width: 40px">Status</th>
                        <th style="width: 40px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($dataset['securityquestionsdata']) > 0 )
                      @foreach($dataset['securityquestionsdata']->all() as $userrole)
                      <tr>
                        <td>{{$userrole->id}}</td>
                        <td>{{$userrole->question}}</td>
                        <td>
                          @if($userrole->status == 'A')
                          <span class="badge bg-success">Active</span>
                          @else
                          <span class="badge bg-secondary">Disabled</span>
                          @endif

                        </td>
                        <td><a href="{{url('/editpolicyquestion/'.$userrole->id)}}" class="btn btn-block btn-outline-primary btn-xs">Edit</a></td>

                      </tr>
                      @endforeach
                      @endif


                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                  <a href="{{url('/addnewsecurityquestion')}}" class="btn btn-primary">Add new Security Question</a>
                </div>
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
  <!-- DataTables -->
  <script src="{{URL::asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{URL::asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{URL::asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{URL::asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  
  <!-- AdminLTE for demo purposes -->
  <script src="{{URL::asset('dist/js/demo.js')}}"></script>
  <script type="text/javascript">
    window.onload = function() {
      $('.nav-link').removeClass('active');
      $('#policynav').addClass('active');
      $('#masternavmain').addClass('active');
      $('#mastermain').addClass('menu-open');

      $('#master-datatable').DataTable({
      "pagingType": "full_numbers",
      "pageLength": 5,
      "searching": true,
      "lengthChange": false,
      "ordering": false
    });

      var responseMessege = "{{@session('response')}}";
      var edit_responseMessege = "{{@session('edit_response')}}";
      var delete_responseMessege = "{{@session('delete_response')}}";

      if (responseMessege != '') {
        $(document).Toasts('create', {
          class: 'bg-info',
          autohide: true,
          delay: 2500,
          title: 'Successful!',

          body: 'New Security Question : <b>' + responseMessege + '</b> saved successfully.'
        })
      }

      if (edit_responseMessege != '') {
        $(document).Toasts('create', {
          class: 'bg-info',
          autohide: true,
          delay: 2500,
          title: 'Updated Successful!',

          body: 'The Security Question : <b>' + edit_responseMessege + '</b> updated successfully.'
        })
      }

      if (delete_responseMessege != '') {
        $(document).Toasts('create', {
          class: 'bg-warning',
          autohide: true,
          delay: 2500,
          title: 'Deletion Successful!',

          body: 'Security Question with ID: <b>' + delete_responseMessege + '</b> removed successfully.'
        })
      }
    }
  </script>
</body>

</html>