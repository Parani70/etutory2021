<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | Review Question</title>
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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     <!-- Favicon -->
     <link rel="icon" type="image/png" href="{{URL::asset('dist/img/favicon.png')}}" />
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <style>
    .ui-state-highlight-sucess {
      background-color: #b6eb7a;
    }

    .ui-state-highlight-wrong {
      background-color: #fb7813;
    }
  </style>
  <div class="wrapper">

    @include('includes.navbar')
    @include('includes.sidebar')

    @php
  $userroledata  = DB::table('userroles')->where('userrole', '=', Auth::user()->role)->get();
  $privilagedata = DB::table('roleprivileges')->where('roleid', '=', $userroledata[0]->id)->get();
  $priviledgesArray = array();


  @endphp
 
  @foreach($privilagedata as $prv)
    @php
    array_push($priviledgesArray,$prv->privilegename)
    @endphp
 
  @endforeach

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Review Question</h1>
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
                  <h3 class="card-title">Review Question</h3>


                </div>
                <!-- /.card-header -->
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-6">
                      <dl class="row">
                        <dt class="col-sm-4">Question Type</dt>
                        <dd class="col-sm-8">{{$dataset['questiontype']}}</dd>

                      </dl>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <dl class="row">
                        <dt class="col-sm-6">Exam Type :</dt>
                        <dd class="col-sm-6">{{$dataset['questionmain'][0]->examtypename}}</dd>

                      </dl>
                      <dl class="row">
                        <dt class="col-sm-6">Category :</dt>
                        <dd class="col-sm-6">{{$dataset['questionmain'][0]->categoryname}}</dd>

                      </dl>
                    </div>
                    <div class="col-md-4">
                      <dl class="row">
                        <dt class="col-sm-6">Sub Category :</dt>
                        <dd class="col-sm-6">{{$dataset['questionmain'][0]->subcategoryname}}</dd>

                      </dl>
                      <dl class="row">
                        <dt class="col-sm-4">Subject :</dt>
                        <dd class="col-sm-8">{{$dataset['questionmain'][0]->subjectname}}</dd>

                      </dl>
                    </div>
                    <div class="col-md-4">
                      <dl class="row">
                        <dt class="col-sm-4">Grade :</dt>
                        <dd class="col-sm-8">{{$dataset['questionmain'][0]->gradename}}</dd>

                      </dl>
                      <dl class="row">
                        <dt class="col-sm-4">Level :</dt>
                        <dd class="col-sm-8">{{$dataset['questionmain'][0]->levelname}}</dd>

                      </dl>
                    </div>
                  </div>
                  <!-- /.row -->
                  <hr>
                  @if($dataset['questiontype'] == 'MCQ')

                  @if($dataset['questionmain'][0]->imageupload == 'Y' & $dataset['questionmain'][0]->imageposition == 'before')

               
                  <img src="{{ url('/useruploaded/'.$dataset['questionmain'][0]->imageurl) }}" class="img-fluid" />

                  @endif
                  <dl class="row">
                    <dt class="col-sm-4">Question :</dt>
                    <dd class="col-sm-8">{!!$dataset['questionmain'][0]->questionheader!!}</dd>

                  </dl>
                  @if($dataset['questionmain'][0]->imageupload == 'Y' & $dataset['questionmain'][0]->imageposition == 'after')
 
                  <img src="{{ url('/useruploaded/'.$dataset['questionmain'][0]->imageurl) }}"class="img-fluid" />

                  @endif
                  <hr>
                  @if(count($dataset['questionsubdata']) > 0)
                  @foreach($dataset['questionsubdata']->all() as $qsub)
                  <dl class="row">
                    <dt class="col-sm-8">{{$qsub->answernumber}}. {{$qsub->answer}}</dt>
                    <dd class="col-sm-4">
                      <div class="">
                        <input class="" type="checkbox" id="answercheck{{$qsub->answernumber}}" name="answercheck{{$qsub->answernumber}}" value="option{{$qsub->answernumber}}">

                      </div>
                    </dd>
                    <input type="hidden" id="correctanswer{{$qsub->answernumber}}" value="{{$qsub->correct}}" name="correctanswer{{$qsub->answernumber}}">
                  </dl>
                  <div class="row">
                    <div class="col-md-8">
                      @if($qsub->imageupload == 'Y' )
                   
                      <img src="{{ url('/useruploaded/'.$qsub->imageurl) }}" class="img-fluid" />

                      @endif
                    </div>
                  </div>


                  @endforeach
                  @endif


                </div>
                @elseif($dataset['questiontype'] == 'FILLBLANKS')

                <dl class="row">
                  <dt class="col-sm-4">Question Header:</dt>
                  <dd class="col-sm-8">{!!$dataset['questionmain'][0]->questionheader!!}</dd>
                  <input type="hidden" id="qentrycount" value="{{count($dataset['questionsubdata'])}}" name="qentrycount">
                </dl>
                <hr>
                @if(count($dataset['questionsubdata']) > 0)

                @foreach($dataset['questionsubdata']->all() as $qsub)
                <dl class="row">
                  <dt class="col-sm-1">Q{{$qsub->position}}</dt>
                  <dd class="col-sm-10">
                    <input type="hidden" id="q{{$qsub->position}}-bcount" value="{{$qsub->blanks}}" name="q{{$qsub->position}}-bcount">
                    @php
                    $fulltextq = $qsub->qselement;
                    $qarray = explode("BLANK", $fulltextq);
                    $qr=0;
                    $br=1;
                    while(count($qarray) >$qr){

                    $thistext = $qarray[$qr];
                    $thistext = trim($thistext);
                    if($br> 1){
                    $thistext = substr($thistext, 1);

                    }


                    @endphp
                    @if($br == count($qarray))

                    <span> {{$thistext}} </span>

                    @else
                    <span> {{$thistext}} </span><span><input data-temp-key="{{ $qsub->position.'-'. $br}}" class="droppable" readonly type="text"></span>
                    <input type="hidden" id="stateq{{$qsub->position}}-b{{$br}}" value="0" name="stateq{{$qsub->position}}-b{{$br}}">

                    @endif
                    @php
                    $qr++;
                    $br++;
                    }
                    @endphp
                  </dd>


                </dl>
                <dl class="row">


                  @if(count($dataset['fillindata']) > 0)
                  @foreach($dataset['fillindata']->all() as $exptecteda)
                  @if($qsub->position == $exptecteda->entry)
                  <dd class="col-md-2">
                    <div class="draggable" data-temp-key="{{ $exptecteda->entry.'-'. $exptecteda->position}}" class="ui-widget-content">
                      <p class="btn btn-info">{{$exptecteda->qselement}}</p>
                    </div>
                    @endif
                  </dd>
                  @endforeach
                  @endif



                </dl>
                <hr>


                @endforeach

                @endif
                @elseif($dataset['questiontype'] == 'TRUEFALSE')
                <dl class="row">
                  <dt class="col-sm-4">Question Header:</dt>
                  <dd class="col-sm-8">{!!$dataset['questionmain'][0]->questionheader!!}</dd>

                </dl>
                <hr>
                @if(count($dataset['questionsubdata']) > 0)
                <dl class="row">
                  <dt class="col-sm-8">Answer</dt>
                  <dt class="col-sm-2">TRUE</dt>
                  <dt class="col-sm-2">FALSE</dt>
                </dl>
                @foreach($dataset['questionsubdata']->all() as $qsub)
                <dl class="row">
                  <dt class="col-sm-8">{{$qsub->answernumber}}. {{$qsub->answer}}</dt>
                  <dd class="col-sm-2">
                    <div class="">
                      <input class="trufalsecheckbox" type="checkbox" onclick="cheboxcheck(this)" id="truecheck{{$qsub->answernumber}}" name="truecheck{{$qsub->answernumber}}" value="option{{$qsub->answernumber}}">

                    </div>
                  </dd>
                  <dd class="col-sm-2">
                    <div class="">
                      <input class="trufalsecheckbox" type="checkbox" onclick="cheboxcheck(this)" id="falsecheck{{$qsub->answernumber}}" name="falsecheck{{$qsub->answernumber}}" value="option{{$qsub->answernumber}}">

                    </div>
                  </dd>
                  <input type="hidden" id="correctanswer{{$qsub->answernumber}}" value="{{$qsub->correct}}" name="correctanswer{{$qsub->answernumber}}">
                </dl>


                @endforeach
                @endif
                @elseif($dataset['questiontype'] == 'MATCHING')
                <dl class="row">
                  <dt class="col-sm-4">Question Header:</dt>
                  <dd class="col-sm-8">{!!$dataset['questionmain'][0]->questionheader!!}</dd>

                </dl>
                <hr>
                <dl class="row">
                  <dt class="col-sm-5">Answer</dt>
                  <dt class="col-sm-5">Counter Answer</dt>
                  <dt class="col-sm-2">Matching Answer</dt>

                </dl>
                @foreach($dataset['questionsubdata']->all() as $qsub)
                <input type="hidden" id="answer{{$qsub->answernumber}}" value="{{$qsub->answer}}" name="answer{{$qsub->answernumber}}">
                @if($qsub->side == '2')
                <dl class="row">
                  <dt class="col-sm-5" id="answermain{{$qsub->answernumber}}"></dt>
                  <dt class="col-sm-5" id="answercontra{{$qsub->answernumber}}">{{$qsub->answer}}</dt>
                  <dt class="col-sm-2">
                    <select class="form-control select2 matchingselect" id="matchingq{{$qsub->answernumber}}" name="matchingq{{$qsub->answernumber}}" style="width: 100%;">
                      <option value="Q1">Q1</option>
                      <option value="Q2">Q2</option>
                      <option value="Q3">Q3</option>
                      <option value="Q4">Q4</option>
                      <option value="Q5">Q5</option>
                    </select>
                  </dt>
                </dl>
                <input type="hidden" id="correct{{$qsub->answernumber}}" value="{{$qsub->matchinganswer}}" name="correct{$qsub->answernumber}}">
                @endif
                @endforeach

                @elseif($dataset['questiontype'] == 'SHORT')
                <dl class="row">
                  <dt class="col-sm-4">Question Header:</dt>
                  <dd class="col-sm-8">{!!$dataset['questionmain'][0]->questionheader!!}</dd>

                </dl>
                <hr>
                <dl class="row">
                  <dt class="col-sm-4">Expected Answer:</dt>
                  <dd class="col-sm-8">{!!$dataset['questionsubdata'][0]->shortanswer!!}</dd>

                </dl>

                @elseif($dataset['questiontype'] == 'ESSAY')


                @if($dataset['questionmain'][0]->imageupload == 'Y' & $dataset['questionmain'][0]->imageposition == 'before')

                <!-- <img src="{{ url('storage/question_images/'.$dataset['questionmain'][0]->imageurl) }}" width="100%" /> -->
                <img src="{{ url('/useruploaded/'.$dataset['questionmain'][0]->imageurl) }}" class="img-fluid" />
                

                @endif
                <dl class="row">

                  <dt class="col-sm-4">Question Header:</dt>
                  <dd class="col-sm-8">{!!$dataset['questionmain'][0]->questionheader!!}</dd>

                </dl>


                @if($dataset['questionmain'][0]->imageupload == 'Y' & $dataset['questionmain'][0]->imageposition == 'after')

                <!-- <img src="{{ url('storage/question_images/'.$dataset['questionmain'][0]->imageurl) }}" width="100%" /> -->
                <img src="{{ url('/useruploaded/'.$dataset['questionmain'][0]->imageurl) }}" class="img-fluid" />

                @endif
                <hr>
                @if($dataset['questionsubdata'][0]->imageupload == 'Y' & $dataset['questionsubdata'][0]->imageposition == 'before')

                <!-- <img src="{{ url('storage/question_images/'.$dataset['questionmain'][0]->imageurl) }}" width="100%" /> -->
                <img src="{{ url('/useruploaded/'.$dataset['questionmain'][0]->imageurl) }}" class="img-fluid" />

                @endif
                <dl class="row">
                  <dt class="col-sm-4">Correction Guidelines:</dt>
                  <dd class="col-sm-8">{!!$dataset['questionsubdata'][0]->crrectionguid!!}</dd>

                </dl>

                @if($dataset['questionsubdata'][0]->imageupload == 'Y' & $dataset['questionsubdata'][0]->imageposition == 'after')

                <!-- <img src="{{ url('storage/question_images/'.$dataset['questionsubdata'][0]->image) }}" width="100%" /> -->
                <img src="{{ url('/useruploaded/'.$dataset['questionsubdata'][0]->image) }}" class="img-fluid" />

                @endif

                @endif

                <div class="row">
                  <div class="col-md-12">
                    <div class="correctmessage">
                      <div class="alert alert-success ">

                        <h5><i class="icon fas fa-check"></i>Correct Answers !</h5>
                        The Answer you selected matches the correct answer.
                      </div>
                    </div>
                    <div class="wronganswer">
                      <div class="alert alert-danger ">

                        <h5><i class="icon fas fa-check"></i>Incorrect Answers !</h5>
                        The Answer you selected did not matches the correct answer.
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <form role="form" action="{{url('/reviewquestionactions') }}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-md-4">
                        <a href="{{url('/prequestion_review/'.$dataset['quetype'].'-'.$dataset['questionmain'][0]->id)}}" class="btn btn-info">Previouse</a>
                        <a href="{{url('/nextquestion_review/'.$dataset['quetype'].'-'.$dataset['questionmain'][0]->id)}}" class="btn btn-info">Next</a>

                      </div>
                      @if($dataset['questiontype'] == 'MCQ')
                      <!-- MCQ Question data values input -->
                      <input type="hidden" id="answerscount" value="{{$dataset['questionsubdata'][0]->answerscount}}" name="answerscount">
                      <input type="hidden" id="correctanswerscount" value="{{$dataset['questionsubdata'][0]->correctanswersacount}}" name="correctanswerscount">
                      <input type="hidden" id="quetype" value="{{$dataset['quetype']}}" name="quetype">
                      @elseif($dataset['questiontype'] == 'TRUEFALSE')
                      <input type="hidden" id="answerscount" value="{{$dataset['questionsubdata'][0]->answerscount}}" name="answerscount">
                      @elseif($dataset['questiontype'] == 'MATCHING')
                      <input type="hidden" id="answerscount" value="{{$dataset['questionsubdata'][0]->answerscount}}" name="answerscount">

                      @endif
                      <!-- Main Question data values input -->
                      <input type="hidden" id="qsid" value="{{$dataset['questionmain'][0]->id}}" name="qsid">
                      <input type="hidden" id="qstype" value="{{$dataset['questionmain'][0]->qstype}}" name="qstype">
                      <!-- ./Main Question data values input -->
                      <div class="col-md-8">
                        <button type="button" id="checkanswer" class="btn btn-success">Check</button>
                        @if(true)
                        @if(in_array('Approve question', (array) $priviledgesArray))
                        <a href="{{url('/approvequestion/'.$dataset['quetype'].'-'.$dataset['questionmain'][0]->id)}}" id="approvebutton" name="approve" value="approve" class="btn btn-info disabled">Approve</a>
                        @endif
                       
                      
                        <a href="{{url('/onholdquestion/'.$dataset['quetype'].'-'.$dataset['questionmain'][0]->id)}}" class="btn btn-warning">On Hold</a>
                        <a href="{{url('/rejectquestion/'.$dataset['quetype'].'-'.$dataset['questionmain'][0]->id)}}" class="btn btn-info">Sent Back</a>
                        @endif

                        @if(in_array('Edit question', (array) $priviledgesArray))
                        <a href="{{url('/editquestion/'.$dataset['quetype'].'-'.$dataset['questionmain'][0]->id)}}" class="btn btn-info">Edit</a>
                       @endif
                       @if(in_array('Delete question', (array) $priviledgesArray))
                       <a href="{{url('/removequestion/'.$dataset['quetype'].'-'.$dataset['questionmain'][0]->id)}}" class="btn btn-danger">Remove</a>
                       @endif

                       
                       
                        <a href="{{url('/forapprovequestionsqueu')}}" class="btn btn-warning">Close</a>
                      </div>
                    </div>

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
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <!-- AdminLTE App -->
  <script src="{{URL::asset('dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{URL::asset('dist/js/demo.js')}}"></script>
  <script>
    window.onload = function() {
      $(".draggable").draggable();
      $(".droppable").droppable({
        drop: function(event, ui) {

          var value = ui.draggable.data("temp-key");
          var valueq = $(this).data("temp-key");
          var vlist = valueq.split('-');
          var qv = vlist[0];
          var bv = vlist[1];
          console.log(value);
          console.log(valueq);
          console.log(qv);
          console.log(bv);
          console.log('#stateq' + qv + '-b' + bv + '');
          if (value == valueq) {
            $('#stateq' + qv + '-b' + bv + '').val('1');
            $(this)
              .addClass("ui-state-highlight-sucess")
              .removeClass("ui-state-highlight-wrong")
              .find("p")
              .html("Dropped!");
          } else {
            $('#stateq' + qv + '-b' + bv + '').val('0');
            $(this)
              .addClass("ui-state-highlight-wrong")
              .removeClass("ui-state-highlight-sucess")
              .find("p")
              .html("Dropped!");
          }

        }
      });

      $('.nav-link').removeClass('active');
      $('#forapprovenav').addClass('active');
      $('#queusmain').addClass('active');
      $('#queumain').addClass('menu-open');

      if ($('#qstype').val() == 'MATCHING') {
        var answersCount = $('#answerscount').val();
        var answerEntryCount = answersCount * 2;

        var a = 1;
        $('.matchingselect').empty();
        console.log('jwhejwhejhejhew');
        while (answersCount >= a) {
          $('.matchingselect').append('<option value="Q' + a + '">Q' + a + '</option>');
          var answermain = $('#answerQ' + a).val();
          $('#answermain' + a).html(answermain);
          a++;
        }
      } else if ($('#qstype').val() == 'SHORT' || $('#qstype').val() == 'ESSAY') {
        $('#approvebutton').removeClass('disabled');
        $('#checkanswer').hide();
      }
      var responseMessege_approved = "{{$dataset['approvedquestion']}}";
      var responseMessege_onhold = "{{$dataset['onholdquestion']}}";
      var responseMessege_reject = "{{$dataset['rejectquestion']}}";
      var responseMessege_remove = "{{$dataset['removequestion']}}";

      if (responseMessege_approved == 'Y') {
        $(document).Toasts('create', {
          class: 'bg-info',
          autohide: true,
          delay: 2500,
          title: 'Successful!',

          body: 'The question approved successfully!'
        })
      }


      if (responseMessege_onhold == 'Y') {
        $(document).Toasts('create', {
          class: 'bg-warning',
          autohide: true,
          delay: 2500,
          title: 'Successful!',

          body: 'The question marked as On Hold!'
        })
      }

      if (responseMessege_reject == 'Y') {
        $(document).Toasts('create', {
          class: 'bg-warning',
          autohide: true,
          delay: 2500,
          title: 'Successful!',

          body: 'The question marked as Rejected and sent back!'
        })
      }

      if (responseMessege_remove == 'Y') {
        $(document).Toasts('create', {
          class: 'bg-danger',
          autohide: true,
          delay: 2500,
          title: 'Successful!',

          body: 'The question marked as Removed!'
        })
      }

    }
    $('.nav-link').removeClass('active');
    $('#mcqnav').addClass('active');
    $('#mcqnavmain').addClass('active');
    $('.correctmessage').hide();
    $('.wronganswer').hide();


    //check Correct answer selecte
    function cheboxcheck(checkboxElement) {
      var checkBoxId = checkboxElement.id;
      var questiontype = $('#qstype').val();
      if (questiontype == "MCQ") {
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
      } else if (questiontype == "TRUEFALSE") {
        console.log('checkBoxId ' + checkBoxId);
        var checkboxtype = checkBoxId.substring(0, 4);
        console.log('checkboxtype ' + checkboxtype);
        if (checkboxtype == 'true') {
          var checkboxtnumber = checkBoxId.substring(9);
          console.log('checkboxtnumber ' + checkboxtnumber);
          $('#falsecheck' + checkboxtnumber).prop('checked', false);
        } else {
          var checkboxtnumber = checkBoxId.substring(10);
          console.log('checkboxtnumber false ' + checkboxtnumber);
          $('#truecheck' + checkboxtnumber).prop('checked', false);
        }
      }

    }

    $('#checkanswer').click(function() {
      var qsType = $('#qstype').val();
      if (qsType == "MCQ") {
        var answersCount = $('#answerscount').val();
        var i = 1;
        var answerState = false;
        while (answersCount >= i) {
          //var checkanswer = $('input[name=answercheck'+i+']:checked');
          var checkanswer = $('#answercheck' + i).is(':checked');

          if (checkanswer) {
            checkanswer = 'Y';
            var realamswer = $('#correctanswer' + i).val();
            console.log('answer given real ' + i + ' ->' + realamswer);
            console.log('answer given check ' + i + ' ->' + checkanswer);
            if (checkanswer == realamswer) {
              answerState = true;
            } else {
              answerState = false;
              break;
            }
          } else {

            checkanswer = 'N';
            var realamswer = $('#correctanswer' + i).val();
            console.log('answer given  real ' + i + ' ->' + realamswer);
            console.log('answer given check ' + i + ' ->' + checkanswer);
            if (checkanswer == realamswer) {
              answerState = true;
            } else {
              answerState = false;
              break;
            }
          }
          i++;
        }

        if (answerState) {
          $('.wronganswer').hide();
          $('.correctmessage').show();
          $('#approvebutton').removeClass('disabled');
        } else {
          $('.correctmessage').hide();
          $('.wronganswer').show();
          $('#approvebutton').addClass('disabled');

        }
      } else if (qsType == "TRUEFALSE") {
        var answersCount = $('#answerscount').val();
        var i = 1;
        var answerState = false;
        while (answersCount >= i) {
 
          var checkanswertrue = $('#truecheck' + i).is(':checked');
          var checkanswerfalse = $('#falsecheck' + i).is(':checked');

          if (checkanswertrue) {
            var realamswer = $('#correctanswer' + i).val();
            if (realamswer == 'True') {
              answerState = true;
            } else {
              var answerState = false;
              break;
            }
          } else if (checkanswerfalse) {
            var realamswer = $('#correctanswer' + i).val();
            if (realamswer == 'False') {
              answerState = true;
            } else {
              var answerState = false;
              break;
            }
          } else {
            var answerState = false;
            break;
          }
          i++;
        }

        if (answerState) {
          $('.wronganswer').hide();
          $('.correctmessage').show();
          $('#approvebutton').removeClass('disabled');
        } else {
          $('.correctmessage').hide();
          $('.wronganswer').show();
          $('#approvebutton').addClass('disabled');

        }

      } else if (qsType == "MATCHING") {
        var answersCount = $('#answerscount').val();
        var i = 1;
        var answerState = false;
        while (answersCount >= i) {
          var selectedAnswer = $('#matchingq' + i).val();
          var correctAnswer = $('#correct' + i).val();

          if (selectedAnswer == correctAnswer) {
            answerState = true;
          } else {
            var answerState = false;
            break;
          }
          i++;
        }

        if (answerState) {
          $('.wronganswer').hide();
          $('.correctmessage').show();
          $('#approvebutton').removeClass('disabled');
        } else {
          $('.correctmessage').hide();
          $('.wronganswer').show();
          $('#approvebutton').addClass('disabled');

        }
      } else if (qsType == "FILLBLANKS") {
        var entrycount = $('#qentrycount').val();
        console.log(entrycount);
        var i = 1;
        answerState = false;
        while (entrycount >= i) {

          var blankscount = $('#q' + i + '-bcount').val();
          var b = 1;
          while (blankscount >= b) {
            var checkanswerval = $('#stateq' + i + '-b' + b + '').val();
            if (checkanswerval == 1) {
              answerState = true;
            } else {
              answerState = false;
              break;
            }
            b++;
          }
          i++;

        }

        if (answerState) {
          $('.wronganswer').hide();
          $('.correctmessage').show();
          $('#approvebutton').removeClass('disabled');
        } else {
          $('.correctmessage').hide();
          $('.wronganswer').show();
          $('#approvebutton').addClass('disabled');

        }

      }

    });
  </script>
</body>

</html>