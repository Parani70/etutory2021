<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | E Learnig Centre | Payments</title>
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
    @include('includes.sidebarstudent')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Payment Receipt</h1>
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
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    Payment
                  </h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                     
                      @if($dataset['paycredit'] == '0')
                      <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Congratulations!</h5>
                  Successful card payment.
                </div>
                      @else
                      <p>Congratulations! </p>
                      @endif
                      <p>You have successfully reserved Following exams/Packages:</p>
                    </div>
                  </div>
                  <dl class="row">
                    <dt class="col-sm-4">Service Purchased</dt>
                    <dd class="col-sm-8">{{$dataset['examname'].' | '.$dataset['subject'].' for '.$dataset['grade']}}</dd>
                    
                    @if($dataset['discountAmount'] > 0)
                    <dt class="col-sm-4">Amount</dt>
                    <dd class="col-sm-8">{{number_format($dataset['price'],2)}}</dd>
                    <dt class="col-sm-4">Discounted Amount</dt>
                    <dd class="col-sm-8">{{number_format($dataset['discountAmount'],2)}}</dd>
                    <dt class="col-sm-4">Paid Amount</dt>
                    <dd class="col-sm-8">{{number_format($dataset['discountedPrice'],2)}}</dd>
                    @else
                    <dt class="col-sm-4">Paid Amount</dt>
                    <dd class="col-sm-8">{{number_format($dataset['price'],2)}}</dd>
                    @endif
                 
<dd class="col-sm-12"><p>We will validate the payment and send a confirmation.  From the confirmation date, you will have 30 days to login to eTutory and sit for any of the purchased exams at any time.</p></dd>
                   

                  </dl>



                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-3">
                      <form role="form" action="{{url('/emailreceipt') }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" id="examname" value="{{$dataset['examname']}}" name="examname">
                        <input type="hidden" id="subject" value="{{$dataset['subject']}}" name="subject">
                        <input type="hidden" id="grade" value="{{$dataset['grade']}}" name="grade">
                        <input type="hidden" id="price" value="{{$dataset['price']}}" name="price">
                        <input type="hidden" id="email" value="{{$dataset['email']}}" name="email">

                        <button type="submit" name="mailreceipt" class="btn btn-block btn-info col-sm-12"><i class="fas fa-envelope "></i> Email Me</button>
                      </form>


                    </div>
                    <div class="col-md-3">
                    <form role="form" action="{{url('/pdfreceipt') }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" id="examname" value="{{$dataset['examname']}}" name="examname">
                        <input type="hidden" id="subject" value="{{$dataset['subject']}}" name="subject">
                        <input type="hidden" id="grade" value="{{$dataset['grade']}}" name="grade">
                        <input type="hidden" id="price" value="{{$dataset['price']}}" name="price">
                        <input type="hidden" id="discountedPrice" value="{{$dataset['discountedPrice']}}" name="discountedPrice">
                        <input type="hidden" id="discountAmount" value="{{$dataset['discountAmount']}}" name="discountAmount">
                        <input type="hidden" id="email" value="{{$dataset['email']}}" name="email">

                        <button type="submit" class="btn btn-block btn-info col-sm-12"><i class="fas fa-print"></i> Print</button>
                      </form>
                     

                    </div>
                  </div>
                </div>
                </form>
              </div>

            </div>

          </div>
          <!-- /.row -->


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

      $('#paymethod').change(function() {
        var paymethod = $('#paymethod').val();
        if (paymethod == 'bank') {
          $('#uploadbox').show();
        } else {
          $('#uploadbox').hide();
        }
      });
    }
  </script>
</body>

</html>