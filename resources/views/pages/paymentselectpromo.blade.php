<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | E Learnig Centre | Promotion Payments</title>
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
  <!-- Pay Here -->
  <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
  <style>
    #uploadbox {
      margin-top: 20px;
    }

    .card-comments{
      margin-bottom: 20px;
      margin-top: 20px;
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
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">E Learning Centre</h1>
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

                <form role="form" action="{{url('/savepromopayment') }}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="card-header">
                    <h3 class="card-title">
                      <i class="fas fa-edit"></i>
                      Payment
                    </h3>
                  </div>
                  <div class="card-body">

                     

                  <p>Amount to be Paid : <b>{{$dataset['price']}} LKR</b></p>



                    


                    <div class="row">
                      <div class="col-sm-4">
                        <label for="">Payment Method : </label>
                      </div>
                      <div class="col-sm-4">
                        <select class="form-control select2" name="paymethod" id="paymethod" style="width: 100%;">
                          <option value="card">Credit Card</option>
                          <option value="bank">Bank Deposit</option>
                        </select>
                      </div>

                    </div>
                    <div class="row" id="uploadbox" style="display: none;">
                      <div class="col-sm-4">
                        <label for="">Upload Deposit Slip : </label>
                      </div>
                      <div class="col-sm-6">
                        <div class="custom-file">
                          <input type="file" name="depositimage" required="required" class="custom-file-input" style="height:100%;" id="customFile">
                          <label class="custom-file-label" for="customFile">Upload Deposit</label>
                        </div>
                      </div>
                      <div class="card-comments col-sm-12">
                        <div class="card-comment">
                          <!-- User image -->
                        

                          <div class="comment-text">
                            <span class="username">
                              Bank Details
                               
                            </span><!-- /.username -->
                            <span>Bank: Commercial Bank</span><br>
                            <span>Branch: Commercial Bank</span><br>
                            <span>Account: 1000341865</span>
                            
                          </div>
                          <!-- /.comment-text -->
                        </div>
                       
                        <!-- /.card-comment -->
                     
                        <!-- /.card-comment -->
                      </div>
                     
                      <input type="hidden" id="transactionid" value="{{$dataset['promotiontransid']}}" name="transactionid">
                      <input type="hidden" id="studentid" value="{{$dataset['promotiontransid']}}" name="studentid">
              
                       


                    
                      <button type="submit" class="btn btn-block btn-info col-sm-3">Proceed</button>
                    </div>


                </form>

                <div class="cardform">

                  

                  <form role="form" action="{{url('/cardpayproceed') }}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}

                     

                    <input type="hidden"  value="{{$dataset['price']}}" name="cardpayamount">
                    <input type="hidden"  value="{{$dataset['promotiontransid']}}" name="promotransid">
                    <input type="hidden" id="transtype" value="promo" name="transtype">
              
                    

                    <input type="submit" class="btn btn-block btn-info col-sm-3" value="Buy Now">
                  </form>
                  
            



                </div>

              </div>
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
  <script src="{{URL::asset('/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
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

      $(document).ready(function() {
        bsCustomFileInput.init();

      });

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
          $('.cardform').hide();
        } else {
          $('#uploadbox').hide();
          $('.cardform').show();
        }
      });
    }
  </script>

  <script>
    // Called when user completed the payment. It can be a successful payment or failure
    payhere.onCompleted = function onCompleted(orderId) {
      console.log("Payment completed. OrderID:" + orderId);
      //Note: validate the payment and show success or failure page to the customer
    };

    // Called when user closes the payment without completing
    payhere.onDismissed = function onDismissed() {
      //Note: Prompt user to pay again or show an error page
      console.log("Payment dismissed");
    };

    // Called when error happens when initializing payment such as invalid parameters
    payhere.onError = function onError(error) {
      // Note: show an error page
      console.log("Error:" + error);
    };

    // Put the payment variables here
    var payment = {
      "sandbox": true,
      "merchant_id": "1215740", // Replace your Merchant ID
      "return_url": undefined, // Important
      "cancel_url": undefined, // Important
      "notify_url": "https://etutory.lk/getpayment",
      "order_id": "ItemNo12345",
      "items": "Door bell wireles",
      "amount": "1000.00",
      "currency": "LKR",
      "first_name": "Saman",
      "last_name": "Perera",
      "email": "samanp@gmail.com",
      "phone": "0771234567",
      "address": "No.1, Galle Road",
      "city": "Colombo",
      "country": "Sri Lanka",
      "delivery_address": "No. 46, Galle road, Kalutara South",
      "delivery_city": "Kalutara",
      "delivery_country": "Sri Lanka",
      "custom_1": "",
      "custom_2": ""
    };
  </script>
</body>

</html>