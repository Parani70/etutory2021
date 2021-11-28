<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | Exam Centre | Shopping Cart</title>
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
              <h1 class="m-0 text-dark">Shopping Cart</h1>
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
          @if($dataset['noentries'] == 0)
          <div class="row">

            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <h2 class="text-danger">NO SHOPPING CART ENTRIES AVAILABLE!</h2>
                  <a href="{{url('/')}}" class="btn btn-block btn-warning col-sm-4 mt-5">Go Back</a>
                </div>
              </div>
            </div>
          
          </div>
          @else

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                <form role="form" action="{{url('/proceedtoexampay') }}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                  <p class="text-info">You are registered to the following Exams. Please click to proceed.</p>

                  <table id="questions-datatable" class="table">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Product Name</th>
                        <th class="text-right">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $total=0;
                      
                      $i=1;
                      @endphp
                      @foreach($dataset['cartdatasub']->all() as $cartdata)

                      <tr class='clickable-row2' data-href="{{url('/papercorrectionpage/'.$cartdata->id)}}">
                        <td>{{$i}}</td>
                        <td>{{$cartdata->productname}}</td>
                        <td class="text-right">{{number_format($cartdata->price,2)}}</td>



                      </tr>
                      @php
                      $total +=$cartdata->price;
                      $i++;
                      @endphp
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr class='clickable-row2' data-href="{{url('/papercorrectionpage/'.$cartdata->id)}}">

                        <td colspan="2">TOTAL</td>
                        <td class="text-right">{{ number_format($total,2)}}</td>



                      </tr>
                    </tfoot>
                  </table>
                  @if($dataset['msg'] == 'no promocode')
                      <p class="text-danger">Invalid Promo Code entered, Please double check!</p>

                  @endif
                  <label for="exampleInputEmail1">Promo Code</label>
                  <input type="text" class="form-control col-md-5" name="promocode"  placeholder="Enter Promo Code">
                  <br>

                  <input type="hidden" id="proceedType" value="proceesshoppingcart" name="proceedType">
                  <input type="hidden" id="totalShoppingCart" value="{{$total}}" name="totalShoppingCart">
                  <input type="hidden" id="price" value="{{$total}}" name="price">
                  <div class="row">
                  <div class="col-md-3">
                  <button type="submit" class="btn btn-block btn-info col-sm-12">Proceed To Pay</button>
                  </div>
                  <div class="col-md-3">
                  
                  <a href="{{url('/clearshoppingcart')}}" class="btn btn-block btn-warning col-sm-12">Clear Shopping Cart</a>
                  </div>
                  </div>
                 

                </form>
                </div>
              </div>
            </div>
          </div>
          <!-- /.row -->

          @endif
          


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
    }
  </script>
</body>

</html>