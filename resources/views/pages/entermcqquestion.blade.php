<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | Enter MCQ Question</title>
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
              <h1>Enter Question | MCQ</h1>
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
                  <span class="info-box-number">{{$dataset['questionsThisMonth']}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </div>
            <div class="col-md-4">
              <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-chart-pie"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Data Entry Accuracy</span>
                  <span class="info-box-number">{{$dataset['accuracy']}}%</span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </div>
            <div class="col-md-4">
              <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-money-check-alt"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Eligible Allowance</span>
                  <span class="info-box-number">LKR {{$dataset['alowance']}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">MCQ</h3>


                </div>
                <!-- /.card-header -->
                <form role="form" action="{{url('/savemcqquestion') }}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Exam Type</label>
                          <select class="form-control select2" name="examtype" style="width: 100%;">
                            <option value="-- Choose User Option --">-- Choose Exam Type --</option>
                            @if(count($dataset['examtypedata']) > 0)
                            @foreach($dataset['examtypedata']->all() as $examtype)
                            @if($dataset['presettings'] == 'true' & $dataset['pre_examtype'] == $examtype->id)
                            <option selected=selected value="{{$examtype->id.'-'.$examtype->examtype}}">{{$examtype->examtype}}</option>
                            @else
                            <option value="{{$examtype->id.'-'.$examtype->examtype}}">{{$examtype->examtype}}</option>
                            @endif

                            @endforeach
                            @endif


                          </select>
                          @error('examtype')

                          <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Grade</label>
                          <select class="form-control select2 subcatentries_change" name="grade" id="grade" style="width: 100%;">
                          <option value="-- Choose User Option --">-- Choose Grade --</option>
                            @if(count($dataset['gradedata']) > 0)
                            @foreach($dataset['gradedata']->all() as $grade)
                            @if($dataset['presettings'] == 'true' & $dataset['pre_grade'] == $grade->id)
                            <option selected=selected value="{{$grade->id.'-'.$grade->grade}}">{{$grade->grade}}</option>
                            @else
                            <option value="{{$grade->id.'-'.$grade->grade}}">{{$grade->grade}}</option>
                            @endif

                            @endforeach
                            @endif
                          </select>
                          @error('grade')

                          <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Sub Category</label>
                          <select class="form-control select2" id="subcategory" name="subcategory" style="width: 100%;">
                          <option value="-- Choose User Option --">-- Choose SubCategory --</option>
                            @if(count($dataset['subcategorydata']) > 0)
                            @foreach($dataset['subcategorydata']->all() as $subcategory)
                            @if($dataset['presettings'] == 'true' & $dataset['pre_subcategory'] == $subcategory->id)
                            <option selected=selected value="{{$subcategory->id.'-'.$subcategory->subcategory}}">{{$subcategory->subcategory}}</option>

                            @else
                            <option value="{{$subcategory->id.'-'.$subcategory->subcategory}}">{{$subcategory->subcategory}}</option>
                            @endif




                            @endforeach
                            @endif
                          </select>
                          @error('subcategory')

                          <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>No of Answers</label>
                          <select class="col-3 form-control select2" name="answerscount" id="noofanswers" style="width: 100%;">

                          <option value="-- Choose User Option --">-- Choose No of Answers --</option>
                            @for($a =1 ; $a <=10 ; $a++) @if($dataset['presettings']=='true' & $dataset['pre_answercount']==$a) <option selected=selected value="{{$a}}">{{$a}}</option>

                              @else
                              <option value="{{$a}}">{{$a}}</option>
                              @endif
                              @endfor


                          </select>
                          @error('answerscount')

                          <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Subject</label>
                          <select class="form-control select2 subcatentries_change2" name="subject" id="subject" style="width: 100%;">
                          <option value="-- Choose User Option --">-- Choose Subject --</option>
                            @if(count($dataset['subjectdata']) > 0)
                            @foreach($dataset['subjectdata']->all() as $subject)

                            @if($dataset['presettings'] == 'true' & $dataset['pre_subject'] == $subject->id)
                            <option selected=selected value="{{$subject->id.'-'.$subject->subject}}">{{$subject->subject}}</option>
                            @else
                            <option value="{{$subject->id.'-'.$subject->subject}}">{{$subject->subject}}</option>
                            @endif
                            @endforeach
                            @endif
                          </select>
                          @error('subject')

                          <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Category</label>
                          <select class="form-control select2" id="category" name="category" style="width: 100%;">
                          <option value="-- Choose User Option --">-- Choose Category --</option>
                            @if(count($dataset['categorydata']) > 0)
                            @foreach($dataset['categorydata']->all() as $category)
                            @if($dataset['presettings'] == 'true' & $dataset['pre_category'] == $category->id)
                            <option selected=selected value="{{$category->id.'-'.$category->category}}">{{$category->category}}</option>
                            @else
                            <option value="{{$category->id.'-'.$category->category}}">{{$category->category}}</option>
                            @endif

                            @endforeach
                            @endif
                          </select>
                          @error('category')

                          <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                        
                        <div class="form-group">
                          <label>Level</label>
                          <select class="form-control select2" name="level" style="width: 100%;">
                          <option value="-- Choose User Option --">-- Choose Level --</option>
                            @if(count($dataset['leveldata']) > 0)
                            @foreach($dataset['leveldata']->all() as $level)
                            @if($dataset['presettings'] == 'true' & $dataset['pre_level'] == $level->id)
                            <option selected=selected value="{{$level->id.'-'.$level->level}}">{{$level->level}}</option>
                            @else
                            <option value="{{$level->id.'-'.$level->level}}">{{$level->level}}</option>
                            @endif

                            @endforeach
                            @endif

                          </select>
                          @error('level')

                          <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>No of Correct Answers</label>
                          <select class="col-3 form-control select2" name="correctanswerscount" id="correctanswerscount" style="width: 100%;">
                          <option value="-- Choose User Option --">-- Choose No of Correct Answers --</option>
                            @for($a =1 ; $a <=10 ; $a++) @if($dataset['presettings']=='true' & $dataset['pre_correctanswercount']==$a) <option selected=selected value="{{$a}}">{{$a}}</option>

                              @else
                              <option value="{{$a}}">{{$a}}</option>
                              @endif
                              @endfor
                          </select>
                          @error('correctanswerscount')

                          <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <!-- /.row -->
                    <hr>
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label>Question</label>
                          <textarea class="form-control textarea" rows="3" name="questionheader" placeholder="Enter MCQ Question"></textarea>
                          @error('questionheader')

                          <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <!-- <label for="customFile">Custom File</label> -->
                          <label>Upload Image</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" style="height:100%;" id="customFile" name="questionimage">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Image Position</label>
                          <select class="col-6 form-control select2" name="imageposition" id="imageposition" style="width: 100%;">
                            <option value='after'>After Text</option>
                            <option value='before'>Before Text</option>
                          </select>
                        </div>

                      </div>
                    </div>
                    <!-- /.row -->
                    <hr>
                    <input type="hidden" id="checkedanswerscount" value="0" name="checkedanswerscount">
                    <div class="mcq-answertext-block">


                      <div class="row">
                        <div class="col-md-5">

                          <div class="form-group">
                            <label>Answer 1</label>
                            <input type="text" name="answer1" class="form-control" name="" placeholder="Enter Answer 1">
                            @error('answer1')

                            <div class="alert alert-danger" role="alert">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>

                        </div>
                        <div class="col-md-4">

                          <div class="form-group">
                            <label>Upload Image 1</label>
                            <div class="custom-file">
                              <input type="file" name="answerimage1" class="custom-file-input" style="height:100%;" id="customFile">
                              <label class="custom-file-label" for="customFile">Upload Image 1</label>
                            </div>
                          </div>


                        </div>
                        <div class="col-md-3">
                          <h5><b>Correct Answers</b></h5>

                          <div class="form-group">
                            <div class="custom-control custom-checkbox">
                              <input name="correctanswercheck1" class="custom-control-input correctanswer-checkbox" onclick="cheboxcheck(this)" type="checkbox" id="customCheckbox1" value="option1">
                              <label for="customCheckbox1" class="custom-control-label"> </label>
                            </div>
                          </div>


                        </div>
                      </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Marks Allocated</label>
                          <input type="number" name="allocatedmarks" class="form-control" placeholder="Marks">
                          @error('allocatedmarks')

                          <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Marks Negative</label>
                          <input type="number" name="negativemarks" class="form-control" placeholder="Negative Marks">

                        </div>
                      </div>
                    </div>
                    <!-- /.row -->

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" name="save" value="save" class="btn btn-success">Save</button>
                    <button type="submit" name="forapproval" value="forapproval" class="btn btn-primary">Send For Approval</button>
                    <a href="{{url('/entermcqquestion')}}" class="btn btn-secondary ">Clear</a>
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
  <!-- bs-custom-file-input -->
  <script src="{{URL::asset('/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{URL::asset('dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{URL::asset('dist/js/demo.js')}}"></script>
  <script>
  $(document).on("keypress", 'form', function (e) {
    var code = e.keyCode || e.which;
    
    if (code == 13) {
        e.preventDefault();
        return false;
    }
});

$(function () {
    // Summernote
    $('.textarea').summernote();
 
  })

    $('.subcatentries_change').change(function() {
      var grade = $('#grade').val();
      var splitlist = grade.split("-");
      var gradeid = splitlist[0];
      var gradename = splitlist[1];
      var subject = $('#subject').val();
      var splitlist = subject.split("-");
      var subjectid = splitlist[0];
      var gsubjectname = splitlist[1];
      $('#category').empty();
      $('#subcategory').empty();


      $.get('/etestlms/public/getcategoryset/' + gradeid + '^' + subjectid, function(response) {
        // console.log(response);
        $('#category').empty();
        $('#subcategory').empty();      
        $('#category').append(' <option value="-- Choose User Option --">-- Choose Category --</option>');
        $('#subcategory').append(' <option value="-- Choose User Option --">-- Choose SubCategory --</option>');
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

    $('.nav-link').removeClass('active');
    $('#mcqnav').addClass('active');
    $('#mcqnavmain').addClass('active');
    $('#qsmain').addClass('menu-open');

    $(document).ready(function() {
      bsCustomFileInput.init();

      var numberofanswers = $('#noofanswers').val();
      console.log('Number of answers '+numberofanswers);
      answersCount = numberofanswers;
      if (answersCount > 0) {
        var i = 1;
        $('.mcq-answertext-block').empty();
        $('.mcq-answerimage-block').empty();
        $('.mcq-answercheck-block').empty();
        while (answersCount >= i) {

          $('.mcq-answertext-block').append('\
          <div class="row">\
          <div class="col-md-5">\
            <div class="form-group">\
              <label>Answer ' + i + '</label>\
              <input type="text" class="form-control" name="answer' + i + '" placeholder="Enter Answer ' + i + '">\
            </div>\
            </div>\
            <div class="col-md-4">\
            <div class="form-group">\
                          <label>Upload Image ' + i + '</label>\
                          <div class="custom-file">\
                            <input type="file" name="answerimage' + i + '" class="custom-file-input" style="height:100%;"  id="customFile">\
                            <label class="custom-file-label" for="customFile">Upload Image ' + i + '</label>\
                          </div>\
                          </div>\
                        </div>\
                        <div class="col-md-3">\
          <div class="form-group" style="margin-top:20px">\
          <label>Correct Answer ' + i + '</label>\
                          <div class="custom-control custom-checkbox">\
                            <input name="correctanswercheck' + i + '" class="custom-control-input correctanswer-checkbox" onclick="cheboxcheck(this)" type="checkbox" id="customCheckbox' + i + '" value="option' + i + '">\
                            <label for="customCheckbox' + i + '" class="custom-control-label"> </label>\
                          </div>\
                          </div>\
                        </div>\
                        </div>');


          i++;
        }

        bsCustomFileInput.init();

      }

    });

    $('#noofanswers').change(function() {
      var answersCount = $('#noofanswers').val();
      console.log(answersCount);
      if (answersCount > 0) {
        var i = 1;
        $('.mcq-answertext-block').empty();
        $('.mcq-answerimage-block').empty();
        $('.mcq-answercheck-block').empty();
        while (answersCount >= i) {

          $('.mcq-answertext-block').append('\
          <div class="row">\
          <div class="col-md-5">\
            <div class="form-group">\
              <label>Answer ' + i + '</label>\
              <input type="text" class="form-control" name="answer' + i + '" placeholder="Enter Answer ' + i + '">\
            </div>\
            </div>\
            <div class="col-md-4">\
            <div class="form-group">\
                          <label>Upload Image ' + i + '</label>\
                          <div class="custom-file">\
                            <input type="file" name="answerimage' + i + '" class="custom-file-input" style="height:100%;"  id="customFile">\
                            <label class="custom-file-label" for="customFile">Upload Image ' + i + '</label>\
                          </div>\
                          </div>\
                        </div>\
                        <div class="col-md-3">\
          <div class="form-group" style="margin-top:20px">\
          <label>Correct Answer ' + i + '</label>\
                          <div class="custom-control custom-checkbox">\
                            <input name="correctanswercheck' + i + '" class="custom-control-input correctanswer-checkbox" onclick="cheboxcheck(this)" type="checkbox" id="customCheckbox' + i + '" value="option' + i + '">\
                            <label for="customCheckbox' + i + '" class="custom-control-label"> </label>\
                          </div>\
                          </div>\
                        </div>\
                        </div>');


          i++;
        }

        bsCustomFileInput.init();

      }
    });


    //Category change to load new subcategries
    $('#category').change(function() {
      var category = $(this).val();
      var splitlist = category.split("-");
      var categoryid = splitlist[0];


      $.get('/etestlms/public/getsubcategorydata/' + categoryid, function(response) {
        $('#subcategory').empty();
        var responseSize = response.length;
        var i = 0;
        while (responseSize > i) {

          $('#subcategory').append('<option value="' + response[i]['id'] + '-' + response[i]['subcategory'] + '">' + response[i]['subcategory'] + '</option>');

          i++;
        }


      });
    });

    //check Correct answer selecte
    function cheboxcheck(checkboxElement) {
      var checkBoxId = checkboxElement.id;
      var allowedCorrectAnswers = $('#correctanswerscount').val();
      var checkedCount = $('#checkedanswerscount').val();

      if ($('#' + checkBoxId).prop("checked") === true) {
        if (parseInt(allowedCorrectAnswers) > parseInt(checkedCount)) {
          checkedCount++;
          $('#checkedanswerscount').val(checkedCount);
        } else {
          alert('Only ' + allowedCorrectAnswers + ' are allowed as correct answers!');
          $('#' + checkBoxId).prop("checked", false);
        }
      } else {
        checkedCount--;
        $('#checkedanswerscount').val(checkedCount);
      }
    }
  </script>
</body>

</html>