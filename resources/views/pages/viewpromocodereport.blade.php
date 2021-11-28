<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | View Promo Code Report</title>
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
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Promo Code Report</h3>
                </div>
                <div class="card-body">
                             
              <br>
                <table class="table table-bordered">
                  <thead>                  
                    <tr>    
                      <th>Student</th>              
                      <th>Subject / Package</th>
                      <th>Used On</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    @php

                    $promoBasicData = array();
                      if($dataset['promCode'] == 'All'){
                        $promoBasicData = DB::table('promocodes')->get();
                      }else{
                        $expledlist = explode(' - ',$dataset['promCode']);
                        $promoCodeId = $expledlist[0];
                        $promoBasicData = DB::table('promocodes')->where([
                                      ['id', '=', $promoCodeId],                                      
                                      ])->get();
                      }
                     
                    @endphp

                    @if(count($promoBasicData) > 0)

                        @foreach($promoBasicData as $promoEntry)

                          <tr>
                            <td colspan="3">Promo Code : <b>{{$promoEntry->promocode}}</b></td>
                          </tr>
                          <tr>
                            <td colspan="3">Promotion Type : <b>{{$promoEntry->promotype}}</b></td>
                          </tr>

                          <tr>
                            <td colspan="3">Max Allocation Allowed : <b>{{$promoEntry->maxallowed}}</b></td>
                          </tr>
                          <tr>
                            <td colspan="3">Consumed : <b>{{$promoEntry->totalused}}</b></td>
                          </tr>
                          <tr>
                            @if($promoEntry->status == 'A')
                            <td colspan="3">Status : <b>Active</b></td>
                            @else
                            <td colspan="3">Status : <b>Closed</b></td>
                            @endif
                            
                          </tr>

                          @php 

                          $promoCodeTransData = DB::table('promocodetrans')->where([
                                      ['promocode', '=', $promoEntry->promocode],                                      
                                      ])->get();

                          

                          @endphp

                          @if(count($promoCodeTransData) > 0)

                            @foreach($promoCodeTransData as $promtransentry)

                            <tr>
                              <td>{{$promtransentry->studentid.'-'.$promtransentry->studentname}}</td>
                              <td>{{$promtransentry->productname}}</td>
                              <td>{{$promtransentry->created_at}}</td>
                            </tr>
                            @endforeach

                          @endif

                          
                        @endforeach

                    @endif
                    
                  </tbody>
                </table>
                </div>
                <div class="card-footer">
                <form role="form" action="{{url('/promocodereportPDF') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden"   value="{{$dataset['promCode']}}" name="promCode">
              
               
                  <button type="submit" class="btn btn-primary">Download PDF</button>
                  <a href="{{url('/promocodereport')}}" class="btn btn-danger">Cancel</a>
                </form>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                
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
    $('#subject').change(function() {
      var subjectVal = $('#subject').val();
      var splitlist = subjectVal.split(" - ");
      var subjectId = splitlist[0];
      var subjectName = splitlist[1];
      var gradeVal = $('#grade').val();
      var splitlist = gradeVal.split(" - ");
      var gardeId = splitlist[0];
      var gardeName = splitlist[1];


      $('#category').empty();
      $('#subcategory').empty();
      $('#category').append('     <option value="All">All</option>');
      $('#subcategory').append('     <option value="All">All</option>');

      

      $.get('/getcategoryset/' + gardeId + '^' + subjectId, function(response) {
        // console.log(response);


        var responseSize = response['categorydata'].length;
        var subresponseSize = response['subcategorydata'].length;
        var i = 0;
        while (responseSize > i) {

          $('#category').append('<option value="' + response['categorydata'][i]['id'] + '-' + response['categorydata'][i]['category'] + '">' + response['categorydata'][i]['category'] + '</option>');

          i++;
        }

        var x = 0;
        while (responseSize > x) {

          $('#subcategory').append('<option value="' + response['subcategorydata'][x]['id'] + '-' + response['subcategorydata'][x]['subcategory'] + '">' + response['subcategorydata'][x]['subcategory'] + '</option>');

          x++;
        }


      }).fail(function() {
        alert('No Category and Subcategory configuaration Found for this Grade and Subject pair.');
      });

    });

    $('#category').change(function(){

        var categoryVal = $('#category').val();
        var splitlist = categoryVal.split("-");
       var categoryId = splitlist[0];

       
      $.get('/getsubcategorydata/' + categoryId, function(response) {
        $('#subcategory').empty();
        $('#subcategory').append('     <option value="All">All</option>');
        var responseSize = response.length;
        var i = 0;
        while (responseSize > i) {

          $('#subcategory').append('<option value="' + response[i]['id'] + '-' + response[i]['subcategory'] + '">' + response[i]['subcategory'] + '</option>');

          i++;
        }


      });
    });
  </script>
</body>

</html>