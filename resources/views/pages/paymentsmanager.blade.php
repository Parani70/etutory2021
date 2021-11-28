<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | Payments Management</title>
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
              <h1 class="m-0 text-dark">Payment Confirmation for offline payments</h1>
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
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-search"></i>
                    Search
                  </h3>
                </div>
                <div class="card-body">
                  <form action="{{url('/searchpayentries')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Purchased Date</label>
                          <input type="text" class="form-control" name="purchasedate" placeholder=" ">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Student Name</label>
                          <input type="text" class="form-control" name="studentname" placeholder=" ">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Purchased Item</label>
                          <input type="text" class="form-control" name="item" placeholder=" ">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Status</label>
                          <select class="col-6 form-control select2" name="status" id="imageposition" style="width: 100%;">
                            <option value='All'>All</option>
                            <option value='1'>Approved</option>
                            <option value='2'>Rejected</option>
                          </select>
                        </div>
                      </div>
                    </div>

                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col">
                      <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <table id="purchased-datatable" class="table table-bordered">
                    <thead>
                      <tr>

                        <th>Purchased Item</th>
                        <th>Purchased Date</th>
                        <th>Student Name</th>
                        <th>Parent Name</th>
                        <th>Payment Slip</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($dataset['examsdata']) > 0)

                      @foreach($dataset['examsdata']->all() as $exampay)

                      <tr>
                        <td>{{$exampay->productname}}</td>
                        <td>{{$exampay->created_at}}</td>
                        <td>{{$exampay->studentname}}</td>
                        <td>{{$exampay->studentname}}</td>
                        <td><a href="{{url('/paymentmangerview/'.$exampay->id)}}" id="id{{$exampay->id}}" class="btn btn-primary">View</a></td>
                      </tr>

                      @endforeach

                      @endif

                      @if(count($dataset['promotiondata']) > 0)

@foreach($dataset['promotiondata']->all() as $promoentry)

<tr>
  <td>{{$promoentry->promoname}}</td>
  <td>{{$promoentry->created_at}}</td>
  <td>{{$promoentry->studentname}}</td>
  <td>{{$promoentry->studentname}}</td>
  <td><a href="{{url('/paymentmangerviewpromo/'.$promoentry->id)}}" id="id{{$promoentry->id}}" class="btn btn-primary">View</a></td>
</tr>

@endforeach

@endif

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-list"></i>
                    Details
                  </h3>
                </div>
                <form role="form" action="{{url('/updatetransactionstate') }}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="card-body">
                    <div class="row">
                      <div class="col"><label>Payment Slip :</label></div>
                      <div class="col-md-12" id="slipbox">

                        @if($dataset['view'] == 'Y' & $dataset['type'] == 'exam')
                        <img src="{{ url('/useruploaded/'.$dataset['transimagedata'][0]->image) }}" class="img-fluid" />
                        <input type="hidden" id="transid" value="{{$dataset['transimagedata'][0]->id}}" name="transid">
                        <input type="hidden" id="transtype" value="exam" name="transtype">

                        @elseif($dataset['view'] == 'Y' & $dataset['type'] == 'promo')
                          
                        <img src="{{ url('/useruploaded/'.$dataset['transimagedata'][0]->payimage) }}" class="img-fluid" />
                        <input type="hidden" id="transid" value="{{$dataset['transimagedata'][0]->id}}" name="transid">
                        <input type="hidden" id="transtype" value="promo" name="transtype">

                        @endif

                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Payment Status</label>
                          <select class="col-6 form-control select2" name="paystate" id="paystate" style="width: 100%;">
                            <option value='Pending'>Pending</option>
                            <option value='Confirmed'>Confirmed</option>
                            <option value='Rejected'>Rejected</option>
                          </select>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
              </div>
              </form>
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
  <!-- DataTables -->
  <script src="{{URL::asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{URL::asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{URL::asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{URL::asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{URL::asset('dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{URL::asset('dist/js/demo.js')}}"></script>
  <script type="text/javascript">
    window.onload = function() {

      $('#purchased-datatable').DataTable({
        "pagingType": "full_numbers",
        "pageLength": 6,
        "searching": false,
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

          body: 'New Level : <b>' + responseMessege + '</b> saved successfully.'
        })
      }

      if (edit_responseMessege != '') {
        $(document).Toasts('create', {
          class: 'bg-info',
          autohide: true,
          delay: 2500,
          title: 'Updated Successful!',

          body: 'The Level : <b>' + edit_responseMessege + '</b> updated successfully.'
        })
      }

      if (delete_responseMessege != '') {
        $(document).Toasts('create', {
          class: 'bg-warning',
          autohide: true,
          delay: 2500,
          title: 'Deletion Successful!',

          body: 'Level with ID: <b>' + delete_responseMessege + '</b> removed successfully.'
        })
      }

      $(document).on('click', '.veiewbutton', function() {
        var thisid = this.id;
        var thisval = $('#' + thisid).val();
        console.log(thisval);

        $.get('/gettransactiondata/' + thisval, function(response) {
          $('#subcategory').empty();
          var responseSize = response.length;
          var i = 0;

          var imagedata = response[0]['image'];
          console.log(imagedata);
          $('#slipbox').empty();
          if (imagedata != 'N') {

            $("#my_image").attr("src", "{{ url('storage/question_images/" + imagedata + "') }}");
          }



        });

      });



    }
  </script>
</body>

</html>