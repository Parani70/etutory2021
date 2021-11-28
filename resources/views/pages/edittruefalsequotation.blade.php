<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | Edit True/False Question</title>
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
              <h1>Edit Question | True/False</h1>
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
            <div class="col-md-4">
              <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-book-open"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Questioned Entered This Month</span>
                  <span class="info-box-number">120</span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </div>
            <div class="col-md-4">
              <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-chart-pie"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Data Entry Accuracy</span>
                  <span class="info-box-number">70%</span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </div>
            <div class="col-md-4">
              <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-money-check-alt"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Eligible Allowance</span>
                  <span class="info-box-number">LKR 1,410.00</span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">True/False</h3>


                </div>
                <!-- /.card-header -->
                <form role="form" action="{{url('/updatetruefalsequestion') }}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Exam Type</label>
                          <select class="form-control select2" name="examtype" style="width: 100%;">
                            @if(count($dataset['examtypedata']) > 0)
                            @foreach($dataset['examtypedata']->all() as $examtype)
                            @if($dataset['questionmain'][0]->examtypeid == $examtype->id)
                            <option selected=selected value="{{$examtype->id.'-'.$examtype->examtype}}">{{$examtype->examtype}}</option>
                            @else
                            <option value="{{$examtype->id.'-'.$examtype->examtype}}">{{$examtype->examtype}}</option>
                            @endif
                            
                            @endforeach
                            @endif

                          </select>
                        </div>
                        <div class="form-group">
                          <label>Category</label>
                          <select class="form-control select2" id="category" name="category" style="width: 100%;">
                            @if(count($dataset['categorydata']) > 0)
                            @foreach($dataset['categorydata']->all() as $category)
                            @if($dataset['questionmain'][0]->categoryid  == $category->id)
                            <option selected=selected value="{{$category->id.'-'.$category->category}}">{{$category->category}}</option>
                            @else
                            <option value="{{$category->id.'-'.$category->category}}">{{$category->category}}</option>
                            @endif

                            @endforeach
                            @endif
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Sub Category</label>
                          <select class="form-control select2" id="subcategory" name="subcategory" style="width: 100%;">
                            @if(count($dataset['subcategorydata']) > 0)
                            @foreach($dataset['subcategorydata']->all() as $subcategory)
                            @if($dataset['questionmain'][0]->subcategoryid  == $subcategory->id)
                            <option selected=selected value="{{$subcategory->id.'-'.$subcategory->subcategory}}">{{$subcategory->subcategory}}</option>

                            @else
                            <option value="{{$subcategory->id.'-'.$subcategory->subcategory}}">{{$subcategory->subcategory}}</option>
                            @endif
                            @endforeach
                            @endif
                          </select>
                        </div>

                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Subject</label>
                          <select class="form-control select2" name="subject" style="width: 100%;">
                            @if(count($dataset['subjectdata']) > 0)
                            @foreach($dataset['subjectdata']->all() as $subject)

                            @if($dataset['questionmain'][0]->subjectid  == $subject->id)
                            <option selected=selected value="{{$subject->id.'-'.$subject->subject}}">{{$subject->subject}}</option>
                            @else
                            <option value="{{$subject->id.'-'.$subject->subject}}">{{$subject->subject}}</option>
                            @endif
                            @endforeach
                            @endif
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Grade</label>
                          <select class="form-control select2" name="grade" style="width: 100%;">
                            @if(count($dataset['gradedata']) > 0)
                            @foreach($dataset['gradedata']->all() as $grade)
                            @if($dataset['questionmain'][0]->gradeid  == $grade->id)
                            <option selected=selected value="{{$grade->id.'-'.$grade->grade}}">{{$grade->grade}}</option>
                            @else
                            <option value="{{$grade->id.'-'.$grade->grade}}">{{$grade->grade}}</option>
                            @endif

                            @endforeach
                            @endif
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Level</label>
                          <select class="form-control select2" name="level" style="width: 100%;">
                            @if(count($dataset['leveldata']) > 0)
                            @foreach($dataset['leveldata']->all() as $level)
                            @if($dataset['questionmain'][0]->levelid == $level->id)
                            <option selected=selected value="{{$level->id.'-'.$level->level}}">{{$level->level}}</option>
                            @else
                            <option value="{{$level->id.'-'.$level->level}}">{{$level->level}}</option>
                            @endif

                            @endforeach
                            @endif

                          </select>
                        </div>

                      </div>
                    </div>
                    <!-- /.row -->
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Question Header</label>
                          <textarea class="form-control textarea" rows="3" value="{{$dataset['questionmain'][0]->questionheader}}" name="questionheader" placeholder="Enter Question">{{$dataset['questionmain'][0]->questionheader}}</textarea>
                        </div>
                      </div>
                    </div>
                    <!-- /.row -->
                    <hr>
                    <div class="row">
                      <div class="col-md-10"></div>
                      <div class="col-md-2">
                        <h5>Answer</h5>
                      </div>
                    </div>
                    <div class="trueflase-anser-block">
                      @if(count($dataset['questionsub']) > 0)

                        @foreach($dataset['questionsub']->all() as $qsubdata)

                        <div class="row">
                        <div class="col-md-1">
                          <div class="form-group">
                            <label class="text-right">Q {{$qsubdata->answernumber}}</label>
                          </div>
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                            <input type="text" class="form-control" name="q{{$qsubdata->answernumber}}" value="{{$qsubdata->answer}}" placeholder="Enter Question {{$qsubdata->answernumber}}">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <select class="form-control select2" name="qoption{{$qsubdata->answernumber}}" style="width: 100%;">
                              @if($qsubdata->correct == 'True' )
                              <option selected="selected" value="True">True</option>
                              <option value="False">False</option>
                              @else
                              <option value="True">True</option>
                              <option selected="selected" value="False">False</option>
                              @endif
                              
                            </select>
                          </div>
                        </div>
                      </div>

                        @endforeach
                      @endif
                      
                      
                      <!-- /.row -->
                      <div id="questionsblock">

                      </div>


                    </div>
                    <!-- /.trueflase-anser-block -->
                    <div class="row">
                      <div class="col-md-10"></div>
                      <div class="col-md-2">
                        <input type="hidden" id="questionscount" value="5" name="questionscount">
                        <button type="button" id="addquestion" class="btn btn-primary">Add</button>
                      </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Marks Allocated</label>
                          <input type="text" name="allocatedmarks" class="form-control" value="{{$dataset['questionmain'][0]->marksallocated}}" placeholder="Marks">
                        </div>
                      </div>
                    </div>
                    <!-- /.row -->

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <input type="hidden" id="questionid" value="{{$dataset['questionmain'][0]->id}}" name="questionid">
                    <button type="submit" name="save" value="save" class="btn btn-success">Save</button>
                    <button type="submit" name="forapproval" value="forapproval" class="btn btn-primary">Send For Approval</button>
                    <button type="button" id="clearbutton" class="btn btn-secondary ">Clear</button>
                    <a href="{{url('/dashboard')}}" class="btn btn-danger">Close</a>
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
    $('.nav-link').removeClass('active');
    $('#filnblancknav').addClass('active');
    $('#mcqnavmain').addClass('active');
    $('#qsmain').addClass('menu-open');

     // Summernote
     $('.textarea').summernote();
 


    $('#addquestion').click(function() {
      var questionscount = $('#questionscount').val();
      questionscount++;
      $('#questionscount').val(questionscount);
      $('#questionsblock').append('<div class="row">\
                        <div class="col-md-1">\
                          <div class="form-group">\
                            <label class="text-right">Q ' + questionscount + '</label>\
                          </div>\
                        </div>\
                        <div class="col-md-9">\
                          <div class="form-group">\
                            <input type="text" class="form-control" name="qs' + questionscount + '" placeholder="Enter Question ' + questionscount + '">\
                          </div>\
                        </div>\
                        <div class="col-md-2">\
                          <div class="form-group">\
                            <select class="form-control select2" name="qoption' + questionscount + '" style="width: 100%;">\
                              <option value="True">True</option>\
                              <option value="False">False</option>\
                            </select>\
                          </div>\
                        </div>\
                      </div>');
    });

    $('#category').change(function() {
      var category = $(this).val();
      var splitlist = category.split("-");
      var categoryid = splitlist[0];


      $.get('/getsubcategorydata/' + categoryid, function(response) {
        $('#subcategory').empty();
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