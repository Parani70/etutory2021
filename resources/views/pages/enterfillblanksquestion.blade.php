<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | Enter Fill in the Blanks Question</title>
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

  <link rel="stylesheet" href="{{URL::asset('plugins/jquery-highlighttextarea-master/jquery.highlighttextarea.css')}}">
  <link rel="stylesheet" href="{{URL::asset('plugins/jquery-highlighttextarea-master/jquery.highlight-within-textarea.css')}}">
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{URL::asset('dist/img/favicon.png')}}" />

  <style>
    .hwt-container {
      width: 100%;
      height: 100%;
    }

    mark,
    .mark {

      background-color: #97f2f3;
      border-radius: 2px;
    }
  </style>

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
              <h1>Enter Question | Fill in the Blanks</h1>
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
                  <h3 class="card-title">Fill in the Blanks</h3>


                </div>
                <!-- /.card-header -->
                <form role="form" action="{{url('/savefillblanksquestion') }}" method="post" enctype="multipart/form-data">
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

                      </div>
                    </div>
                    <!-- /.row -->
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group mainhihhenset">
                          <label>Question Header</label>

                          <textarea id="questionz" class="textarea" name="questionheader" style="width:100%" rows="3" placeholder="Enter Question"></textarea>
                          @error('questionheader')

                          <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                          @enderror

                          <input type="hidden" id="blancksentrycount" value="5" name="blancksentrycount">
                          <input type="hidden" id="blanckcount1" value="0" name="blanckcount1">
                          <input type="hidden" id="blanckcount2" value="0" name="blanckcount2">
                          <input type="hidden" id="blanckcount3" value="0" name="blanckcount3">
                          <input type="hidden" id="blanckcount4" value="0" name="blanckcount4">
                          <input type="hidden" id="blanckcount5" value="0" name="blanckcount5">


                        </div>

                      </div>
                    </div>
                    <div class="row qentryrow">
                      <div class="col-md-12">
                        <label>Q1</label>
                        <textarea id="quest1" name="quest1" style="width:100%" rows="3" placeholder="Enter Question"></textarea>
                        @error('quest1')

                        <div class="alert alert-danger" role="alert">
                          {{ $message }}
                        </div>
                        @enderror
                        <button type="button" id="addblanck1" class="btn btn-info btn-sm addblanck">ADD BLANK FOR Q1</button>
                        <div class="row">
                          <div class="wordlistbox1 direct-chat-success" style="width: 100%;">

                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <label>Q2</label>
                        <textarea id="quest2" name="quest2" style="width:100%" rows="3" placeholder="Enter Question"></textarea>
                        @error('quest2')

                        <div class="alert alert-danger" role="alert">
                          {{ $message }}
                        </div>
                        @enderror
                        <button type="button" id="addblanck2" class="btn btn-info btn-sm addblanck">ADD BLANK FOR Q2</button>
                        <div class="row">
                          <div class="wordlistbox2 direct-chat-success" style="width: 100%;">

                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <label>Q3</label>
                        <textarea id="quest3" name="quest3" style="width:100%" rows="3" placeholder="Enter Question"></textarea>
                        @error('quest3')

                        <div class="alert alert-danger" role="alert">
                          {{ $message }}
                        </div>
                        @enderror
                        <button type="button" id="addblanck3" class="btn btn-info btn-sm addblanck">ADD BLANK FOR Q3</button>
                        <div class="row">
                          <div class="wordlistbox3 direct-chat-success" style="width: 100%;">

                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <label>Q4</label>
                        <textarea id="quest4" name="quest4" style="width:100%" rows="3" placeholder="Enter Question"></textarea>
                        @error('quest4')

                        <div class="alert alert-danger" role="alert">
                          {{ $message }}
                        </div>
                        @enderror
                        <button type="button" id="addblanck4" class="btn btn-info btn-sm addblanck">ADD BLANK FOR Q4</button>
                        <div class="row">
                          <div class="wordlistbox4 direct-chat-success" style="width: 100%;">

                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <label>Q5</label>
                        <textarea id="quest5" name="quest5" style="width:100%" rows="3" placeholder="Enter Question"></textarea>
                        @error('quest5')

                        <div class="alert alert-danger" role="alert">
                          {{ $message }}
                        </div>
                        @enderror
                        <button type="button" id="addblanck5" class="btn btn-info btn-sm addblanck">ADD BLANK FOR Q5</button>
                        <div class="row">

                          <div class="wordlistbox5 direct-chat-success" style="width: 100%;">

                          </div>
                        </div>
                      </div>



                    </div>
                    <div class="row">

                      <div class="col-md-12 card-body">
                        <div class="row">
                          <div class="col">
                            <button type="button" id="addentry" class="btn btn-warning btn-sm">ADD ENTRY</button>

                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                      <div class="col">
                        <h5>Word List</h5>
                      </div>
                    </div>
                    <div class="row">
                      <div class="wordlistbox direct-chat-success" style="width: 100%;">

                      </div>
                    </div>
                    <!-- /.row -->

                    <!-- /.row -->
                    <hr>
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
                      </div>
                    </div>
                    <!-- /.row -->

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" name="save" value="save" class="btn btn-success">Save</button>
                    <button type="submit" name="forapproval" value="forapproval" class="btn btn-primary">Send For Approval</button>
                    <a href="{{url('/enterfillblanksquestion')}}" class="btn btn-secondary ">Clear</a>
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

  <script src="{{URL::asset('plugins/jquery-highlighttextarea-master/jquery.highlighttextarea.js')}}"></script>
  <script src="{{URL::asset('plugins/jquery-highlighttextarea-master/jquery.highlight-within-textarea.js')}}"></script>
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


    $(document).ready(function() {
      $('.nav-link').removeClass('active');
      $('#fillinnav').addClass('active');
      $('#mcqnavmain').addClass('active');
      $('#qsmain').addClass('menu-open');
      // $('#question').prop('readonly', false);

      $("#question").focus();

    });

    
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
      $('#category').append(' <option value="-- Choose User Option --">-- Choose Category --</option>');
        $('#subcategory').append(' <option value="-- Choose User Option --">-- Choose SubCategory --</option>');


      $.get('/getcategoryset/' + gradeid + '^' + subjectid, function(response) {
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


    $('#addentry').click(function() {
      var entry = $('#blancksentrycount').val();
      entry++;
      $('#blancksentrycount').val(entry);
      $('.mainhihhenset').append('<input type="hidden" id="blanckcount' + entry + '" value="0" name="blanckcount' + entry + '">');
      $('.qentryrow').append('<div class="col-md-12">\
                        <label>Q' + entry + '</label>\
                        <textarea id="quest' + entry + '" name="quest' + entry + '" style="width:100%" rows="3" placeholder="Enter Question"></textarea>\
                        <button type="button" id="addblanck' + entry + '" class="btn btn-info btn-sm addblanck">ADD BLANK FOR Q' + entry + '</button>\
                        <div class="row">\
                          <div class="wordlistbox' + entry + ' direct-chat-success" style="width: 100%;">\
\
                          </div>\
                        </div>\
                      </div>');
    });


    $(document).on("click", ".addblanck", function(event) {
      //$('.addblanck').click(function() {
      var thisid = this.id;
      var idno = thisid.substring(9, 10);
      console.log(idno);
      console.log('#quest' + idno);
      var textvalue = $('#quest' + idno).val();
      console.log('#textvalue' + textvalue);
      var bcount = $('#blanckcount' + idno).val();
      bcount++;
      $('#blanckcount' + idno).val(bcount);
      textvalue += '  BLANK' + bcount + '  ';
      $('#quest' + idno).val(textvalue);

      $('.wordlistbox' + idno).append('<div class="row"><div class="col-md-2 ">\
                      <div class="form-group direct-chat-msg right" style="width;100%;">\
                        <p class="direct-chat-text">BLANK ' + bcount + '</p>\
                        </div>\
                    </div>\
                    <div class="col-md-6">\
                    <div class="form-group">\
                        <input type="text" id="entertag" class="form-control" name="expected-q' + idno + '-a' + bcount + '" placeholder="Expected Word">\
                      </div>\
                    </div><div class="col-md-4"></div></div>');

      // e = 1;
      // l = 0;
      // var list = [];
      // while (bcount >= e) {
      //   list[l] = ' BLNK' + e + ' ';
      //   e++;
      //   l++;
      // }
      //$('#quest'+idno).highlightWithinTextarea({
      //   highlight: list,
      //   className: 'red'
      // });

      $('#quest' + idno).focus();

    });

    $('#reset').click(function() {
      $('#question').val('');
      $('#blanckcount').val(0);
      $('.wordlistbox').empty();
      $('#question').highlightWithinTextarea({
        highlight: '',
        className: 'red'
      });
    });
  </script>
</body>

</html>