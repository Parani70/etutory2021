<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | Edit Fill in the Blanks Question</title>
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
              <h1>Edit Question | Fill in the Blanks</h1>
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
                <form role="form" action="{{url('/updatefillblanksquestion') }}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Exam Type</label>
                          <select class="form-control select2" name="examtype" style="width: 100%;">
                            @if(count($dataset['examtypedata']) > 0)
                            @foreach($dataset['examtypedata']->all() as $examtype)

                            <option value="{{$examtype->id.'-'.$examtype->examtype}}">{{$examtype->examtype}}</option>


                            @endforeach
                            @endif


                          </select>
                        </div>
                        <div class="form-group">
                          <label>Category</label>
                          <select class="form-control select2" id="category" name="category" style="width: 100%;">

                            @if(count($dataset['categorydata']) > 0)
                            @foreach($dataset['categorydata']->all() as $category)

                            <option value="{{$category->id.'-'.$category->category}}">{{$category->category}}</option>


                            @endforeach
                            @endif
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Sub Category</label>
                          <select class="form-control select2" id="subcategory" name="subcategory" style="width: 100%;">
                            @if(count($dataset['subcategorydata']) > 0)
                            @foreach($dataset['subcategorydata']->all() as $subcategory)

                            <option value="{{$subcategory->id.'-'.$subcategory->subcategory}}">{{$subcategory->subcategory}}</option>

                            @endforeach
                            @endif
                          </select>
                        </div>
                        <div class="form-group">
                          <label>No of Answers</label>
                          <select class="col-3 form-control select2" name="answerscount" id="noofanswers" style="width: 100%;">


                            @for($a =1 ; $a <=10 ; $a++) <option value="{{$a}}">{{$a}}</option>

                              @endfor


                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Subject</label>
                          <select class="form-control select2" name="subject" style="width: 100%;">
                            @if(count($dataset['subjectdata']) > 0)
                            @foreach($dataset['subjectdata']->all() as $subject)


                            <option value="{{$subject->id.'-'.$subject->subject}}">{{$subject->subject}}</option>

                            @endforeach
                            @endif
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Grade</label>
                          <select class="form-control select2" name="grade" style="width: 100%;">
                            @if(count($dataset['gradedata']) > 0)
                            @foreach($dataset['gradedata']->all() as $grade)

                            <option value="{{$grade->id.'-'.$grade->grade}}">{{$grade->grade}}</option>


                            @endforeach
                            @endif
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Level</label>
                          <select class="form-control select2" name="level" style="width: 100%;">
                            @if(count($dataset['leveldata']) > 0)
                            @foreach($dataset['leveldata']->all() as $level)

                            <option value="{{$level->id.'-'.$level->level}}">{{$level->level}}</option>


                            @endforeach
                            @endif

                          </select>
                        </div>
                        <div class="form-group">
                          <label>No of Correct Answers</label>
                          <select class="col-3 form-control select2" name="correctanswerscount" id="correctanswerscount" style="width: 100%;">
                            @for($a =1 ; $a <=10 ; $a++) <option value="{{$a}}">{{$a}}</option>

                              @endfor
                          </select>
                        </div>
                      </div>
                    </div>
                    <!-- /.row -->
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group mainhihhenset">
                          <label>Question Header</label>
                          <textarea id="questionz"  class="textarea" name="questionheader" style="width:100%" rows="3" placeholder="Enter Question">{{$dataset['questionmain'][0]->questionheader}}</textarea>

                          <input type="hidden"id="blancksentrycount" value="{{$dataset['questionsub'][0]->entries}}" name="blancksentrycount">
                          @php
                          $entrycount = $dataset['questionsub'][0]->entries;
                          $i=0;
                          $e=1;
                          while($entrycount > $i){

                          $blanksCount=0;
                          foreach($dataset['questionsubexpected']->all() as $expectdata){

                          if($expectdata->entry == $e){
                          $blanksCount= $expectdata->blanks;
                          }
                          }
                          @endphp
                          <input type="hidden" id="blanckcount{{$e}}" value="{{$blanksCount}}" name="blanckcount{{$e}}">
                          @php
                          $i++;
                          $e++;

                          }
                          @endphp



                        </div>

                      </div>
                    </div>
                    <div class="row qentryrow">

                      @foreach($dataset['questionsub']->all() as $subentry)

                      <div class="col-md-12">
                        <label>Q{{$subentry->position}}</label>
                        <textarea id="quest{{$subentry->position}}" name="quest{{$subentry->position}}" style="width:100%" rows="3" placeholder="Enter Question">{{$subentry->qselement}}</textarea>
                        <button type="button" id="addblanck{{$subentry->position}}" class="btn btn-info btn-sm addblanck">ADD BLANCK FOR Q{{$subentry->position}}</button>
                        <div class="row">
                          <div class="wordlistbox1 direct-chat-success" style="width: 100%;">

                          </div>
                        </div>
                      </div>
                      @if($subentry->blanks > 0)

                      @php
                      $blankscount = $subentry->blanks;
                      $b=1;
                      while($blankscount >= $b){

                        $expval = '';
                        foreach($dataset['questionsubexpected']->all() as $expdata){

                          if($expdata->entry == $subentry->position && $expdata->position == $b){
                            $expval = $expdata->qselement;
                          }
                        }
                      @endphp
                      <div class="col-md-12">

                        <div class="row">
                          <div class="col-md-2 ">
                            <div class="form-group direct-chat-msg right" style="width:100%;">
                              <p class="direct-chat-text">BLANCK {{$b}}</p>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <input type="text" id="entertag" class="form-control" name="expected-q{{$subentry->position}}-a{{$b}}" value="{{$expval}}" placeholder="Expected Word">
                            </div>
                          </div>
                          <div class="col-md-4"></div>
                        </div>
                      </div>
                      @php
                      $b++;
                      }

                      @endphp

                      @endif
                      @endforeach





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
                          <input type="text" name="allocatedmarks" class="form-control" value="{{$dataset['questionmain'][0]->marksallocated}}" placeholder="Marks">
                        </div>
                      </div>
                    </div>
                    <!-- /.row -->

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" name="save" value="save" class="btn btn-success">Save</button>
                    <button type="submit" name="forapproval" value="forapproval" class="btn btn-primary">Send For Approval</button>
                    <a href="{{url('/enterfillblanksquestion')}}" class="btn btn-secondary ">Clear</button>
                    <a href="" class="btn btn-danger">Close</button>
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
    $(document).ready(function() {
      $('.nav-link').removeClass('active');
      $('#fillinnav').addClass('active');
      $('#mcqnavmain').addClass('active');
      $('#qsmain').addClass('menu-open');
      // $('#question').prop('readonly', false);

      $("#question").focus();

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
                        <button type="button" id="addblanck' + entry + '" class="btn btn-info btn-sm addblanck">ADD BLANCK FOR Q' + entry + '</button>\
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
                        <p class="direct-chat-text">BLANCK ' + bcount + '</p>\
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

    
$(function () {
    // Summernote
    $('.textarea').summernote();
 
  });
  </script>
</body>

</html>