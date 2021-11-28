<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | View Purchase Report</title>
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
                  <h3 class="card-title">Purchase Report</h3>
                </div>
                <div class="card-body">
                <h4>From : <b>{{$dataset['fromDateString']}}</b>  To : <b>{{$dataset['toDateValString']}}</b></h4>
                <h4>Total Revenue : <b>{{number_format($dataset['totalRevenueVal'],2)}}</b></h4>
                             
              <br>
                <table class="table table-bordered">
                  <thead>                  
                    <tr>    
                      <th>Date</th>              
                      <th>Medium</th>
                      <th>Exam Type</th>
                      <th>Grade</th>
                      <th>Exam Name</th>
                      <th>Student</th>
                      <th>Pay Type</th>
                      <th>Price</th>
                      <th>Discount</th>
                      <th>Revenue</th>                      
                    </tr>
                  </thead>
                  <tbody>
                    @if($dataset['dateDiffrance'] > 0)
                      @php
                          $dateCount = $dataset['dateDiffrance'] ;
                          $i=1;
                          $theCurrDate = date('Y-m-d', strtotime($dataset['startDate'] . ' -1 day'));
                            $totalPrice =0;
                            $totalDiscount=0;
                            $totalRevenue=0;
                      @endphp 
                      @while($dateCount >= $i)

                        @php
                          $c1=1;
                          $theCurrDate = date('Y-m-d', strtotime($theCurrDate . ' +1 day'));
                          $theCurrDate_Start = $theCurrDate.' 00:00:01';
                          $theCurrDate_End = $theCurrDate.' 23:59:59';
                          $mediumList = array();

                          if($dataset['mediumVal'] == 'All'){
                            $mediumList = ['English','Sinhala','Tamil'];
                          }else{
                            $mediumList = [$dataset['mediumVal']];
                          }

                        @endphp

                        @foreach($mediumList as $theMedium)
                       
                            @php 
                            $c2 =1;
                            $ExamTypeList = array();
                            if($dataset['examTypeVal'] == 'All'){

                              $ExamTypeList = DB::table('studenttransactions')->where([
                                      ['usermedium', '=', $theMedium],
                                      ['status', '=', '1'],                                       
                                      ['created_at', '>=', $theCurrDate_Start],       
                                      ['created_at', '<=', $theCurrDate_End],       
                                      ])->groupBy('examtype')->get();


                            }else{
                              $ExamTypeList = DB::table('studenttransactions')->where([
                                      ['usermedium', '=', $theMedium],
                                      ['status', '=', '1'],                                       
                                      ['examtype', '=', $dataset['examTypeVal']],           
                                      ['created_at', '>=', $theCurrDate_Start],       
                                      ['created_at', '<=', $theCurrDate_End],       
                                      ])->groupBy('examtype')->get();
                            }
                            
                            @endphp 
                      
                          @if(count( $ExamTypeList) > 0 )

                            @foreach($ExamTypeList as $examType)

                              @php 
                                $c3=1;
                                $gradeList = array();
                                if($dataset['gradeVal'] == 'All'){

                                  $gradeList = DB::table('studenttransactions')->where([
                                            ['usermedium', '=', $theMedium],
                                            ['examtype', '=', $examType->examtype],
                                            ['status', '=', '1'],                                       
                                            ['created_at', '>=', $theCurrDate_Start],       
                                            ['created_at', '<=', $theCurrDate_End],       
                                            ])->groupBy('grade')->get();

                                }else{

                                  $explist = explode(' - ',$dataset['gradeVal']);
                                  $gradeName = $explist[1];
                                  $gradeList = DB::table('studenttransactions')->where([
                                            ['usermedium', '=', $theMedium],
                                            ['examtype', '=', $examType->examtype],
                                            ['grade', '=', $gradeName],
                                            ['status', '=', '1'],                                       
                                            ['created_at', '>=', $theCurrDate_Start],       
                                            ['created_at', '<=', $theCurrDate_End],       
                                            ])->groupBy('grade')->get();

                                }

                                

                              @endphp 

                              @if(count($gradeList) > 0)

                                @foreach($gradeList as $grade)

                                  @php 
                        

                                      $productnameList = DB::table('studenttransactions')->where([
                                                    ['usermedium', '=', $theMedium],
                                                    ['examtype', '=', $examType->examtype],
                                                    ['grade', '=', $grade->grade],
                                                    ['status', '=', '1'],                                       
                                                    ['created_at', '>=', $theCurrDate_Start],       
                                                    ['created_at', '<=', $theCurrDate_End],       
                                                    ])->groupBy('productname')->get();

                                  @endphp 

                                  @if(count($productnameList) > 0)

                                    @foreach($productnameList as $product)

                                      @php 

                                      $studentcodeList = array();
                                          if($dataset['studentVal'] == 'All'){
                                            $studentcodeList = DB::table('studenttransactions')->where([
                                                        ['usermedium', '=', $theMedium],
                                                        ['examtype', '=', $examType->examtype],
                                                        ['grade', '=', $grade->grade],
                                                        ['productname', '=', $product->productname],
                                                        ['status', '=', '1'],                                       
                                                        ['created_at', '>=', $theCurrDate_Start],       
                                                        ['created_at', '<=', $theCurrDate_End],       
                                                        ])->groupBy('studentid')->get();
                                          }else{

                                            $explist = explode(' - ',$dataset['studentVal']);
                                            $studentCode = $explist[0];

                                            $studentcodeList = DB::table('studenttransactions')->where([
                                                        ['usermedium', '=', $theMedium],
                                                        ['examtype', '=', $examType->examtype],
                                                        ['grade', '=', $grade->grade],
                                                        ['productname', '=', $product->productname],
                                                        ['studentid', '=',    $studentCode],
                                                        ['status', '=', '1'],                                       
                                                        ['created_at', '>=', $theCurrDate_Start],       
                                                        ['created_at', '<=', $theCurrDate_End],       
                                                        ])->groupBy('studentid')->get();
                                          }
                           

                                      @endphp 

                                      @if(count($studentcodeList) > 0)

                                        @foreach($studentcodeList as $student)

                                          @php 

                                                  $revenueData = DB::table('studenttransactions')->where([
                                                          ['usermedium', '=', $theMedium],
                                                          ['examtype', '=', $examType->examtype],
                                                          ['grade', '=', $grade->grade],
                                                          ['productname', '=', $product->productname],
                                                          ['studentid', '=', $student->studentid],
                                                          ['status', '=', '1'],                                       
                                                          ['created_at', '>=', $theCurrDate_Start],       
                                                          ['created_at', '<=', $theCurrDate_End],       
                                                          ])->get();

                                          @endphp 

                                          @if(count($revenueData) > 0)

                                            @foreach($revenueData as $reventry)

                                                    @php 
                                                      $totalPrice += $reventry->price;
                                                      $totalDiscount += $reventry->discount;
                                             
                                                    @endphp
                                                    <tr>
                                                      @if($c1 == 1)
                                                      <td>{{$theCurrDate}}</td>
                                                      @php 
                                                          $c1++;
                                                      @endphp
                                                      @else
                                                      <td></td>
                                                      @endif

                                                      @if($c2 == 1)
                                                      <td>{{$theMedium}}</td>
                                                      @php 
                                                          $c2++;
                                                      @endphp
                                                      @else
                                                      <td></td>
                                                      @endif

                                                      @if($c3 == 1)
                                                      <td>{{$examType->examtype}}</td>
                                                      @php 
                                                          $c3++;
                                                      @endphp
                                                      @else
                                                      <td></td>
                                                      @endif
                                                     
                                                     
                                                      
                                                      <td>{{$grade->grade}}</td>
                                                      <td>{{$product->productname}}</td>
                                                      <td>{{$student->studentid.' - '.$student->studentname}}</td>
                                                      <td>{{$reventry->paymethod}}</td>
                                                      <td class="text-right">{{number_format($reventry->price,2)}}</td>
                                                      <td class="text-right">{{number_format($reventry->discount,2)}}</td>
                                                      @php
                                                        $revAmount = $reventry->price-$reventry->discount;
                                                      @endphp
                                                      <td class="text-right">{{number_format($revAmount,2) }}</td>
                                            
                                                    </tr>
                                                    @endforeach

                                      @endif

                                        @endforeach

                                      @endif

                                    @endforeach

                                  @endif

                                @endforeach

                              @endif

                            @endforeach
                      
                          @endif
                      
                        @endforeach

                            @php 
                              $i++;
                            @endphp 

                      @endwhile
                      
                    @endif
                    @php 

                      $totalRevenue = $totalPrice-$totalDiscount;
                    @endphp
                    <tr>
                      <td colspan="7">Total</td>
                      <td class="text-right"><b>{{number_format($totalPrice,2)}}</b></td>
                      <td class="text-right"><b>{{number_format($totalDiscount,2)}}</b></td>
                      <td class="text-right"><b>{{number_format($totalRevenue,2)}}</b></td>
                    </tr>
                  </tbody>
                </table>
                </div>
                <div class="card-footer">
                <form role="form" action="{{url('/purchasereportPDF') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden"   value="{{$dataset['startDate']}}" name="startDate">
                <input type="hidden"   value="{{$dataset['fromDateString']}}" name="fromDateString">
                <input type="hidden"   value="{{$dataset['toDateValString']}}" name="toDateValString">
                <input type="hidden"   value="{{$dataset['mediumVal']}}" name="mediumVal">
                <input type="hidden"   value="{{$dataset['examTypeVal']}}" name="examTypeVal">
                <input type="hidden"   value="{{$dataset['gradeVal']}}" name="gradeVal">
                <input type="hidden"   value="{{$dataset['studentVal']}}" name="studentVal">
                <input type="hidden"   value="{{$dataset['totalRevenueVal']}}" name="totalRevenueVal">
                <input type="hidden"   value="{{$dataset['dateDiffrance']}}" name="dateDiffrance">
                
               
                  <button type="submit" class="btn btn-primary">Download PDF</button>
                  <a href="{{url('/revenuereport')}}" class="btn btn-danger">Cancel</a>
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