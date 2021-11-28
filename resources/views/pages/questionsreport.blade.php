<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | Questions Report</title>
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
                  <h3 class="card-title">Questions Report</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{url('/genquestionsreport') }}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Medium</label>
                      <select name="medium" class="form-control select2" style="width: 100%;">
                        <option value="All">All</option>
                        <option value="English">English</option>
                        <option value="Sinhala">Sinhala</option>
                        <option value="Tamil">Tamil</option>

                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Question Status</label>
                      <select name="qstype" class="form-control select2" style="width: 100%;">
                      <option value="All">All</option>
                        <option value="1">Pending For Approval</option>
                        <option value="0">Approved</option>
                        <option value="2">On Hold</option>
                        <option value="4">Rejected</option>
                        <option value="3">Saved</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Exam Type</label>
                      <select name="examtype" class="form-control select2" style="width: 100%;">
                      <option value="All">All</option>
                        @if(count($dataset['examTypeData']) >0)

                        @foreach($dataset['examTypeData']->all() as $examType)

                        <option value="{{ $examType->examtype}}">{{$examType->examtype}}</option>

                        @endforeach

                        @endif

                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Grade</label>
                      <select name="grade" id="grade" class="form-control select2" style="width: 100%;">
                      <option value="All">All</option>
                        @if(count($dataset['gradeData']) >0)

                        @foreach($dataset['gradeData']->all() as $grade)

                        <option value="{{  $grade->id.' - '.$grade->grade}}">{{$grade->grade}}</option>

                        @endforeach

                        @endif

                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Subject</label>
                      <select name="subject" id="subject" class="form-control select2" style="width: 100%;">
                      <option value="All">All</option>
                        @if(count($dataset['subjectData']) >0)

                        @foreach($dataset['subjectData']->all() as $subject)

                        <option value="{{ $subject->id.' - '.$subject->subject}}">{{$subject->subject}}</option>

                        @endforeach

                        @endif


                      </select>
                    </div>
                   
                    <div class="form-group">
                      <label for="exampleInputEmail1">Category</label>
                      <select name="category" id="category" class="form-control select2" style="width: 100%;">
                      <option value="All">All</option>
                      @if(count($dataset['categoryData']) >0)

                      @foreach($dataset['categoryData']->all() as $category)

                      <option value="{{ $category->id.'-'.$category->category}}">{{$category->category}}</option>

                      @endforeach

                      @endif



                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Sub Category</label>
                      <select name="subcategory" id="subcategory" class="form-control select2" style="width: 100%;">

                      <option value="All">All</option>
                      @if(count($dataset['subCategoryData']) >0)

                      @foreach($dataset['subCategoryData']->all() as $subCategory)

                      <option value="{{ $subCategory->id.'-'.$subCategory->subcategory}}">{{$subCategory->subcategory}}</option>

                      @endforeach

                      @endif

                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Question Type</label>
                      <select name="questiontype" class="form-control select2" style="width: 100%;">
                      <option value="All">All</option>
                        <option value="MCQ">MCQ</option>
                        <option value="TRUEFALSE">True/False</option>
                        <option value="FILLBLANKS">Fill in Blaks</option>
                        <option value="MATCHING">Matching</option>
                        <option value="SHORT">Short Answer</option>
                        <option value="ESSAY">Essay Type</option>

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