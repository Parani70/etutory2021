<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk| Exam : {{$dataset['examname']}}</title>
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
  <link rel="stylesheet" href="{{URL::asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::asset('dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{URL::asset('dist/img/favicon.png')}}" />
  <!-- summernote -->
  <link rel="stylesheet" href="{{URL::asset('plugins/summernote/summernote-bs4.css')}}">
</head>

<body>
  <style>
    .ui-state-highlight-sucess {
      background-color: #FFD659;
    }

    .ui-state-highlight-wrong {
      background-color: #FFD659;
    }

    #demo {
      font-weight: 900;
      background-color: red;
      width: 150px;
      color: white;
      padding: 10px;
      border-radius: 5px;
      text-align: center;
    }

    #passqslist {
      height: 30px;
    }

    .pasentrypod {

      margin-right: 20px;
      margin-top: 0;
      margin-bottom: 0;
      display: inline-block;
    }
  </style>

  <div class="container">
  @php 

    $studentid = Auth::user()->id;

  @endphp 
  <input type="hidden" id="studentid" value="{{$studentid}}" name="studentid">
    <div class="row">
      <div class="col">
        <h1>Online Exam Center</h1>
        <h3>{{$dataset['examname']}}</h3>
      </div>
    </div>
    <div class="row">

      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <p>Question Number: <span id="qsnumberdisplay">{{$dataset['questionposition']}}</span> of <span>{{$dataset['questioncount']}}</span> </p>
              </div>
              <input type="hidden" id="openexamstatus" value="0" name="openexamstatus">
              <div class="col-sm-6">
                <p id="demo" class="float-right"></p>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <span class=" badge bg-warning passqsindicator" style="display: none;">This is an already passed question</span>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="row" id="passqslist">

            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header qsEntryBlocK">
            <div class="qsEntryBlocK qsnumberDisplayBox">
              Question - <span id="qstypedisplay">{{$dataset['questioncore'][0]['questionmain'][0]->qstype}}</span>
            </div>

          </div>
          <div class="card-body">
            <div class="qsFinishBlock" style="display:none;">
              <h3>Congratulations !</h3>
            </div>

            @if(count($dataset) > 0)
            @php
            $questioncount = $dataset['questioncount'];
            $i=0;
            @endphp
            <input type="hidden" id="currentquestionentry" value="0" name="currentquestionentry">
            <input type="hidden" id="currentPosition" value="1" name="currentPosition">
            <input type="hidden" id="examqscount" value="{{$questioncount}}" name="examqscount">
            <input type="hidden" id="lastpassentry" value="NA" name="lastpassentry">

            @php

            while($questioncount > $i){

            $qmainentry = $dataset['questioncore'][$i]['questionmain'];
            $qsubentry = $dataset['questioncore'][$i]['questionsubdata'];
            $qfillentry = $dataset['questioncore'][$i]['fillindata'];

            $thisqstype = $qmainentry[0]->qstype;

            @endphp

            @if($thisqstype == 'MCQ')
            <input type="hidden" id="entry{{$i}}-qstype" value="{{$qmainentry[0]->qstype}}" name="currentquestionentry">
            <input type="hidden" id="entry{{$i}}-qsid" value="{{$qmainentry[0]->id}}" name="currentquestionentry">
            <input type="hidden" id="entry{{$i}}-answerscount" value="{{$qsubentry[0]->answerscount}}" name="answerscount">
            <input type="hidden" id="entry{{$i}}-status" value="0" name="status">
            <div id="entry{{$i}}" class="qsEntryBlock" style="display:none;">

              @if($qmainentry[0]->imageupload == 'Y' & $qmainentry[0]->imageposition == 'before')



              
              <img src="{{ url('/useruploaded/'.$qmainentry[0]->imageurl) }}" class="img-fluid" />

              @endif
              <dl class="row">
                <dt class="col-sm-2">Question :</dt>
                <dd class="col-sm-10">{!!$qmainentry[0]->questionheader!!}</dd>

              </dl>
              @if($qmainentry[0]->imageupload == 'Y' & $qmainentry[0]->imageposition == 'after')

              <!-- <img src="{{ url('storage/question_images/'.$qmainentry[0]->imageurl) }}" width="100%" /> -->
              <img src="{{ url('/useruploaded/'.$qmainentry[0]->imageurl) }}" class="img-fluid" />

              @endif
              <hr>
              @if(count($qsubentry) > 0)
              @foreach($qsubentry->all() as $qsub)
              <dl class="row">
                <dt class="col-sm-10">{{$qsub->answernumber}}. {{$qsub->answer}}</dt>
                <dd class="col-sm-2">
                  <div class="">
                    <input class="" onclick="mcqchecker(this)" type="checkbox" id="entry{{$i}}-answercheck{{$qsub->answernumber}}" name="answercheck{{$qsub->answernumber}}" value="option{{$qsub->answernumber}}">

                  </div>
                </dd>
                <input type="hidden" id="entry{{$i}}-correctanswer{{$qsub->answernumber}}" value="{{$qsub->correct}}" name="correctanswer{{$qsub->answernumber}}">
              </dl>
              <div class="row">
                <div class="col-md-10">
                  @if($qsub->imageupload == 'Y' )

                  <!-- <img src="{{ url('storage/question_images/'.$qsub->imageurl) }}" width="100%" /> -->
                  <img src="{{ url('/useruploaded/'.$qsub->imageurl) }}" class="img-fluid" />

                  @endif
                </div>
              </div>


              @endforeach
              @endif


            </div>

            @elseif($thisqstype == 'FILLBLANKS')
            <input type="hidden" id="entry{{$i}}-qstype" value="{{$qmainentry[0]->qstype}}" name="currentquestionentry">
            <input type="hidden" id="entry{{$i}}-qsid" value="{{$qmainentry[0]->id}}" name="currentquestionentry">
            <input type="hidden" id="entry{{$i}}-status" value="0" name="status">
            <div id="entry{{$i}}" class="qsEntryBlock" style="display:none;">

              <dl class="row">
                <dt class="col-sm-4">Question Header:</dt>
                <dd class="col-sm-8">{!!$qmainentry[0]->questionheader!!}</dd>
                <input type="hidden" id="entry{{$i}}-qentrycount" value="{{count($qsubentry)}}" name="qentrycount">
              </dl>
              <hr>


              @if(count($qsubentry) > 0)

              @foreach($qsubentry->all() as $qsub)
              <dl class="row">
                <dt class="col-sm-1">Q{{$qsub->position}}</dt>
                <dd class="col-sm-10">
                  <input type="hidden" id="entry{{$i}}-q{{$qsub->position}}-bcount" value="{{$qsub->blanks}}" name="q{{$qsub->position}}-bcount">
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
                  <input type="hidden" id="entry{{$i}}-stateq{{$qsub->position}}-b{{$br}}" value="0" name="stateq{{$qsub->position}}-b{{$br}}">

                  @endif
                  @php
                  $qr++;
                  $br++;
                  }
                  @endphp
                </dd>


              </dl>
              <dl class="row">


                @if(false)
                @foreach($qfillentry->all() as $exptecteda)
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
              <dl class="row">


                @if(count($qfillentry) > 0)
                @foreach($qfillentry->all() as $exptecteda)
                @if(true)
                <dd class="col">
                  <div class="draggable" data-temp-key="{{ $exptecteda->entry.'-'. $exptecteda->position}}" class="ui-widget-content">
                    <p class="btn btn-info">{{$exptecteda->qselement}}</p>
                  </div>
                  @endif
                </dd>
                @endforeach
                @endif



              </dl>

            </div>

            @elseif($thisqstype == 'TRUEFALSE')
            <input type="hidden" id="entry{{$i}}-qstype" value="{{$qmainentry[0]->qstype}}" name="currentquestionentry">
            <input type="hidden" id="entry{{$i}}-qsid" value="{{$qmainentry[0]->id}}" name="currentquestionentry">
            <input type="hidden" id="entry{{$i}}-qsanswercount" value="{{$qsubentry[0]->answerscount}}" name="qsanswercount">
            <input type="hidden" id="entry{{$i}}-status" value="0" name="status">
            <div id="entry{{$i}}" class="qsEntryBlock" style="display:none;">
              <dl class="row">
                <dt class="col-sm-4">Question Header :</dt>
                <dd class="col-sm-8">{{$qmainentry[0]->questionheader}}</dd>
              </dl>
              <hr>
              @if(count($qsubentry) > 0)
              <dl class="row">
                <dt class="col-sm-8">Answer</dt>
                <dt class="col-sm-2">TRUE</dt>
                <dt class="col-sm-2">FALSE</dt>
              </dl>
              @foreach($qsubentry->all() as $qsub)
              <dl class="row">
                <dt class="col-sm-8">{{$qsub->answernumber}}. {{$qsub->answer}}</dt>
                <dd class="col-sm-2">
                  <div class="">
                    <input class="trufalsecheckbox" type="checkbox" onclick="cheboxcheck(this)" id="entry{{$i}}-truecheck{{$qsub->answernumber}}" name="truecheck{{$qsub->answernumber}}" value="option{{$qsub->answernumber}}">

                  </div>
                </dd>
                <dd class="col-sm-2">
                  <div class="">
                    <input class="trufalsecheckbox" type="checkbox" onclick="cheboxcheck(this)" id="entry{{$i}}-falsecheck{{$qsub->answernumber}}" name="falsecheck{{$qsub->answernumber}}" value="option{{$qsub->answernumber}}">

                  </div>
                </dd>
                <input type="hidden" id="entry{{$i}}-correctanswer{{$qsub->answernumber}}" value="{{$qsub->correct}}" name="correctanswer{{$qsub->answernumber}}">
              </dl>


              @endforeach
              @endif


            </div>

            @elseif($thisqstype == 'MATCHING')
            <input type="hidden" id="entry{{$i}}-qstype" value="{{$qmainentry[0]->qstype}}" name="currentquestionentry">
            <input type="hidden" id="entry{{$i}}-qsid" value="{{$qmainentry[0]->id}}" name="currentquestionentry">
            <input type="hidden" id="entry{{$i}}-qsanswercount" value="{{$qsubentry[0]->answerscount}}" name="qsanswercount">

            <div id="entry{{$i}}" class="qsEntryBlock" style="display:none;">

              <dl class="row">
                <dt class="col-sm-4">Question Header:</dt>
                <dd class="col-sm-8">{{$qmainentry[0]->questionheader}}</dd>

              </dl>
              <hr>
              <dl class="row">
                <dt class="col-sm-5">Answer</dt>
                <dt class="col-sm-5">Counter Answer</dt>
                <dt class="col-sm-2">Matching Answer</dt>

              </dl>
              @foreach($qsubentry->all() as $qsub)
              <input type="hidden" id="entry{{$i}}-answer{{$qsub->answernumber}}" value="{{$qsub->answer}}" name="answer{{$qsub->answernumber}}">
              @if($qsub->side == '2')
              <dl class="row">
                <dt class="col-sm-5" id="entry{{$i}}-answermain{{$qsub->answernumber}}"></dt>
                <dt class="col-sm-5" id="entry{{$i}}-answercontra{{$qsub->answernumber}}">{{$qsub->answer}}</dt>
                <dt class="col-sm-2">
                  <select class="form-control select2 entry{{$i}}-matchingselect" id="entry{{$i}}-matchingq{{$qsub->answernumber}}" name="matchingq{{$qsub->answernumber}}" style="width: 100%;">
                    <option value="Q1">Q1</option>
                    <option value="Q2">Q2</option>
                    <option value="Q3">Q3</option>
                    <option value="Q4">Q4</option>
                    <option value="Q5">Q5</option>
                  </select>
                </dt>
              </dl>
              <input type="hidden" id="entry{{$i}}-correct{{$qsub->answernumber}}" value="{{$qsub->matchinganswer}}" name="correct{$qsub->answernumber}}">
              @endif
              @endforeach
            </div>

            @elseif($thisqstype == 'SHORT')
            <input type="hidden" id="entry{{$i}}-qstype" value="{{$qmainentry[0]->qstype}}" name="currentquestionentry">
            <input type="hidden" id="entry{{$i}}-qsid" value="{{$qmainentry[0]->id}}" name="currentquestionentry">
            <div id="entry{{$i}}" class="qsEntryBlock" style="display:none;">
              <dl class="row">
                <dt class="col-sm-4">Question Header:</dt>
                <dd class="col-sm-8">{!!$qmainentry[0]->questionheader!!}</dd>

              </dl>
              <hr>
              <dl class="row">
                <dt class="col-sm-4">Expected Answer:</dt>
                <dd class="col-sm-8">
                <dd class="col-sm-8"><textarea class="form-control textarea" rows="3" name="answer" id="entry{{$i}}-shortanswer" placeholder="Enter Correction Guidlines"></textarea></dd>
                </dd>

              </dl>
            </div>

            @elseif($thisqstype == 'ESSAY')
            <input type="hidden" id="entry{{$i}}-qstype" value="{{$qmainentry[0]->qstype}}" name="currentquestionentry">
            <input type="hidden" id="entry{{$i}}-qsid" value="{{$qmainentry[0]->id}}" name="currentquestionentry">
            <div id="entry{{$i}}" class="qsEntryBlock canvasentrychecker" style="display:none;">
              @if($qmainentry[0]->imageupload == 'Y' & $qmainentry[0]->imageposition == 'before')

              <!-- <img src="{{ url('storage/question_images/'.$qmainentry[0]->imageurl) }}" width="100%" /> -->
              <img src="{{ url('/useruploaded/'.$qmainentry[0]->imageurl) }}" class="img-fluid" />

              @endif
              <dl class="row">

                <dt class="col-sm-2">Question Header:</dt>
                <dd class="col-sm-10">{!!$qmainentry[0]->questionheader!!}</dd>

              </dl>
              @if($qmainentry[0]->imageupload == 'Y' & $qmainentry[0]->imageposition == 'after')

              <!-- <img src="{{ url('storage/question_images/'.$qmainentry[0]->imageurl) }}" width="100%" /> -->
              <img src="{{ url('/useruploaded/'.$qmainentry[0]->imageurl) }}" class="img-fluid" />

              @endif
              <hr>
              <dl class="row">
                <dt class="col-sm-4">Expected Answer:</dt>
                <dd class="col-sm-8">
                <dd class="col-sm-8"><textarea class="form-control textarea" rows="3" name="answer" id="entry{{$i}}-essayanswer" placeholder="Enter Correction Guidlines"></textarea></dd>
                </dd>

              </dl>
              <a href="{{url('/answercanvas/'.$dataset['examseatid'].'-'.$qmainentry[0]->id)}}" class="btn btn-danger" id="pen" target="_blank"><i class="fa fa-pencil "></i>Pen</a>
              <hr>
              <div class="row mt-3" id="penbox{{$i}}">

              </div>

            </div>

            @endif

            @php

            $i++;
            }
            @endphp

            @endif

          </div>
        </div>
      </div>
    </div>
    <div class="row">

      <form role="form" action="{{url('/saveexamanswer') }}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @if($dataset['questiontype'] == 'MCQ')
        <!-- MCQ Question data values input -->
        <input type="hidden" id="answerscount" value="{{$qsubentry[0]->answerscount}}" name="answerscount">
        <input type="hidden" id="correctanswerscount" value="{{$qsubentry[0]->correctanswersacount}}" name="correctanswerscount">
        <input type="hidden" id="questiontype" value="{{$dataset['questiontype']}}" name="questiontype">
        @elseif($dataset['questiontype'] == 'TRUEFALSE')
        <input type="hidden" id="answerscount" value="{{$qsubentry[0]->answerscount}}" name="answerscount">
        @elseif($dataset['questiontype'] == 'MATCHING')
        <input type="hidden" id="answerscount" value="{{$qsubentry[0]->answerscount}}" name="answerscount">

        @endif
        <input type="hidden" id="qsid" value="{{$qmainentry[0]->id}}" name="qsid">
        <input type="hidden" id="qstype" value="{{$qmainentry[0]->qstype}}" name="qstype">
        <input type="hidden" id="correctanser" value="0" name="correctanser">
        <input type="hidden" id="qposition" value="{{$dataset['questionposition']}}" name="qposition">
        <input type="hidden" id="examseatid" value="{{$dataset['examseatid']}}" name="examseatid">
        <input type="hidden" id="passentrycount" value="0" name="passentrycount">
        <input type="hidden" id="currentpassentry" value="N" name="currentpassentry">
        <div id="passentrybox">

        </div>
    </div>
    <div class="card-body" id="examfinishmessage" style="display:none;">
      <div class="row">
        <div class="col-md-12 text-center">
          <h2>Exam Finished</h2>
          <a href="{{url('/examhome')}}" id="va" class="btn btn-warning">Go Back to Exam Centre</a>
          <p class="text-primary mt-3">To view results for Part I papers, go to the history page</p>
          <a href="{{url('/studenthistory')}}" id="va" class="btn btn-info">History Page</a>

        </div>
      </div>
    </div>
    <div class="card-body" id="examelapsedmessage" style="display:none;">
      <div class="row">
        <div class="col-md-12">
          <h2>Exam Time Elapsed</h2>
          <a href="{{url('/examhome')}}" id="va" class="btn btn-warning">Go Back to Exam Centre</a>

        </div>
      </div>
    </div>
    <div class="card-footer">
      <div class="row">
        <div class="col-sm-10">
          <button type="button" id="passbutton" class="btn btn-warning">Mark as "Pass"</button>
          <button type="button" id="completebutton" class="btn btn-success" data-toggle="modal" data-target="#modal-default">Completed Exam</button>
        </div>
        <div class="col-sm-2">


          <button type="button" id="prebutton" value="pre" name="prebutton" class="btn btn-primary">Previous</button>
          <button type="button" id="nextbutton" value="next" name="next" class="btn btn-primary">Next</button>

          <div class="examanswerbox">

            @php

            $qsEntryCount = count($dataset['questioncore']);
            $qans = 1;

            @endphp
            @while( $qsEntryCount >= $qans)

            <div class="qanswer{{$qans}}"></div>


            @php


            $qans ++;

            @endphp

            @endwhile
          </div>
          </form>

        </div>
      </div>


    </div>
  </div>
  </div>
  </div>

  </div>

  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Complete Exam</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to finish the exam ?&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
              <button type="button" id="btnyesfisnish" data-dismiss="modal" class="btn btn-primary">YES</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <input type="hidden" id="duhours" value="{{$dataset['duration_hours']}}" name="duhours">
  <input type="hidden" id="dumins" value="{{$dataset['duration_minutes']}}" name="dumins">
  <!-- jQuery -->
  <script src="{{URL::asset('plugins/jquery/jquery.min.js')}}"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <!-- Summernote -->
  <script src="{{URL::asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
  <script src="{{URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{URL::asset('dist/js/adminlte.min.js')}}"></script>

  <script>
    // Set the date we're counting down to
    var hoursduration = $("#duhours").val();
    var minsduration = $("#dumins").val();
    var countDownDate = new Date().getTime() + (hoursduration * 60 * 60 * 1000) + (minsduration * 60 * 1000);
    //countDownDate.setTime(countDownDate.getTime() + (h*60*60*1000));

    // Update the count down every 1 second
    var x = setInterval(function() {

      // Get today's date and time
      var now = new Date().getTime();

      // Find the distance between now and the count down date
      var distance = countDownDate - now;

      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Output the result in an element with id="demo"
      document.getElementById("demo").innerHTML = '' + hours + "h " +
        minutes + "m " + seconds + "s ";

      // If the count down is over, write some text 
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
        var currentQuestion = $('#currentquestionentry').val();
        $('#entry' + currentQuestion).hide();
        $('#examelapsedmessage').show();
        $('#donebutton').hide();
        $('#passbutton').hide();
        $('#nextbutton').hide();
        $('#prebutton').hide();
        $('.qsnumberDisplayBox').empty();
        $('#passqslist').empty();


        var examSeat = $('#examseatid').val();
        $('.qsEntryBlock').hide();
        $('.qsFinishBlock').show();
        let _token = $('meta[name="csrf-token"]').attr('content');
        var studentid = $('#studentid').val();
        //save the answer details
        $.ajax({
          url: "/examfinishedupdate",
          type: "POST",
          data: {

            examseat: examSeat,
            studentid: studentid,

            _token: _token
          },
          success: function(response) {
            console.log(response);
            if (response) {
              $('.success').text(response.success);

            }
          },
        });
      }
    }, 1000);


    $('#btnyesfisnish').click(function(){
    
      var examSeat = $('#examseatid').val();
      var currentQuestion = $('#currentquestionentry').val();
        var currentPosition = $('#currentPosition').val();

        $('#entry' + currentQuestion).hide();
        $('#entry' + currentQuestion + "-status").val(1);
        $('.qsnumberDisplayBox').empty();
        $('#examfinishmessage').show();

        $('#passbutton').hide();
        $('#completebutton').hide();
        $('#prebutton').hide();
        $('#nextbutton').hide();

        let _token = $('meta[name="csrf-token"]').attr('content');
        var studentid = $('#studentid').val();
        //save the answer details
        $.ajax({
          url: "/examfinishedupdate",
          type: "POST",
          data: {

            examseat: examSeat,
            studentid: studentid,
            _token: _token
          },
          success: function(response) {
            console.log(response);
            if (response) {
              $('.success').text(response.success);

            }
          },
        });


    });

    $(function() {
      // Summernote
      $('.textarea').summernote();
      $('.textarea2').summernote();
    })

    $(function() {
      // Summernote
      var currentPosition = $('#currentPosition').val();
      if (currentPosition == 1) {
        $('#prebutton').hide();
      } else {
        $('#prebutton').show();
      }
    })


    function loadpassedentry(passeentry) {
      var questionpassValue = passeentry.id;
      console.log('this is the id vlaue:'+questionpassValue);
      passentryNumber = questionpassValue.substring(10);
      console.log('this is the id substring:'+passentryNumber);
      passentryPosition = passentryNumber;
      passentryPosition--;

      var currentQsPosition = $('#currentquestionentry').val();
      var currentQsDisNumber = $('#currentPosition').val();

      $('#entry'+currentQsPosition).hide();

      $('#entry'+passentryPosition).show();
      $('#'+questionpassValue).remove();

      $('.passqsindicator').show();
      $('#qsnumberdisplay').html(passentryNumber);
      $('#currentPosition').val(passentryNumber);
      $('#currentquestionentry').val(passentryPosition);
      $('#passed_btndiv'+passentryNumber).remove();

      if(passentryNumber == 1){
$('#prebutton').hide();
      }else{
        $('#prebutton').show();
      }
    }

    function mcqchecker(checkelement) {

      var checkBoxId = checkelement.id;
      console.log('mcq checkBoxId->' + checkBoxId);
      var res = checkBoxId.split("-");
      var entryvalue = res[0];
      var answerentry = res[1];

      var answercount = $('#' + entryvalue + '-answerscount').val();
      console.log('mcq answerentry->' + answerentry);
      console.log('mcq answercount->' + answercount);

      if ($('#' + checkBoxId).prop("checked") === true) {
        var pos = 1;
        while (answercount >= pos) {

          if ('answercheck' + pos != answerentry) {

            $('#' + entryvalue + '-answercheck' + pos).prop("checked", false);
          }
          pos++;
        }
      } else {
        console.log('this  is not checked !');
      }

    }


    function cheboxcheck(checkboxElement) {
      var currentQuestion = $('#currentquestionentry').val();
      var checkBoxId = checkboxElement.id;
      console.log('currentQuestion ' + currentQuestion);
      console.log('checkBoxId ' + checkBoxId);
      var questiontype = $('#qstype').val();
      console.log('questiontype ' + questiontype);
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
        var checkboxtype = checkBoxId.substring(7, 11);
        console.log('checkboxtype ' + checkboxtype);
        console.log('checkboxtype ' + checkboxtype);
        if (checkboxtype == 'true') {
          var checkboxtnumber = checkBoxId.substring(16);
          console.log('checkboxtnumber ' + checkboxtnumber);
          $('#entry' + currentQuestion + '-falsecheck' + checkboxtnumber).prop('checked', false);
        } else {
          var checkboxtnumber = checkBoxId.substring(17);
          console.log('checkboxtnumber false ' + checkboxtnumber);
          $('#entry' + currentQuestion + '-truecheck' + checkboxtnumber).prop('checked', false);
        }
      }

    }

    window.onload = function() {

      $(".draggable").draggable();
      $(".droppable").droppable({
        drop: function(event, ui) {

          var currentQuestion = $('#currentquestionentry').val();
          var value = ui.draggable.data("temp-key");
          var valueq = $(this).data("temp-key");
          var vlist = valueq.split('-');
          var qv = vlist[0];
          var bv = vlist[1];
          console.log('value' + value);
          console.log('valueq' + valueq);
          console.log(qv);
          console.log(bv);
          console.log('#entry' + currentQuestion + '-stateq' + qv + '-b' + bv + '');
          if (value == valueq) {
            $('#entry' + currentQuestion + '-stateq' + qv + '-b' + bv + '').val('1');
            $(this)
              .addClass("ui-state-highlight-sucess")
              .removeClass("ui-state-highlight-wrong")
              .find("p")
              .html("Dropped!");
          } else {
            $('#entry' + currentQuestion + '-stateq' + qv + '-b' + bv + '').val('0');
            $(this)
              .addClass("ui-state-highlight-wrong")
              .removeClass("ui-state-highlight-sucess")
              .find("p")
              .html("Dropped!");
          }

        }
      });

      varcurrentQ = $('#currentquestionentry').val();
      $('#entry' + varcurrentQ).show();
      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      var currentQuestion = $('#currentquestionentry').val();
      var currentQuestionType = $('#entry' + currentQuestion + '-qstype').val();
      var qscount = $('#examqscount').val();
      var m = 1;
      console.log('--qscount ' + qscount);
      while (qscount >= m) {
        console.log('--m ' + m);
        var thisQuestionType = $('#entry' + m + '-qstype').val();
        console.log('--thisQuestionType  ' + thisQuestionType);
        if (thisQuestionType == 'MATCHING') {

          var answersCount = $('#entry' + m + '-qsanswercount').val();
          console.log('xx--answersCount  ' + answersCount);
          var answerEntryCount = answersCount * 2;
          $('.entry' + m + '-matchingselect').empty();
          var a = 1;
          while (answersCount >= a) {
            $('.entry' + m + '-matchingselect').append('<option value="Q' + a + '">Q' + a + '</option>');
            var answermain = $('#entry' + m + '-answerQ' + a).val();
            console.log('xx--answermain  ' + answermain);
            $('#entry' + m + '-answermain' + a).html(answermain);
            a++;
          }

        }

        m++;
      }

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

      $('#donebutton').click(function() {

        var examSeat = $('#examseatid').val();

        let _token = $('meta[name="csrf-token"]').attr('content');
        var studentid = $('#studentid').val();
        //save the answer details
        $.ajax({
          url: "/examfinishedupdate",
          type: "POST",
          data: {

            examseat: examSeat,
            studentid: studentid,
            _token: _token
          },
          success: function(response) {
            console.log(response);
            if (response) {
              $('.success').text(response.success);

            }
          },
        });


        window.close();

      });

      $('#nextbutton').click(function() {

        $('.passqsindicator').hide();
        var currentQuestion = $('#currentquestionentry').val();
        var currentPosition = $('#currentPosition').val();
        console.log('currentPosition->' + currentPosition);
        if (currentPosition == 1) {
          $('#prebutton').hide();
        } else {
          $('#prebutton').show();
        }

        var oldposion = currentQuestion;
        var currentQuestionType = $('#entry' + currentQuestion + '-qstype').val();
        var currentQuestionID = $('#entry' + currentQuestion + '-qsid').val();
        var examSeat = $('#examseatid').val();
        var qscount = $('#examqscount').val();
        var openexamstatus = $('#openexamstatus').val();
        console.log('currentQuestionType' + currentQuestionType);
        console.log('currentQuestion' + currentQuestion);

        console.log('start next ---------------------------------------------');
        console.log('currentPosition ' + currentPosition);
        console.log('qscount ' + qscount);
        if (true) {

          if (currentQuestionType == 'MCQ') { //chack ans save the answer for MCQ

            var currentAnswerCount = $('#entry' + currentQuestion + '-answerscount').val();
            var i = 1;
            var givenAnswer = false;


            while (currentAnswerCount >= i) {

              var givenAns = $('#entry' + currentQuestion + '-answercheck' + i).is(':checked');
              var sysAns = $('#entry' + currentQuestion + '-correctanswer' + i).val();


              if (givenAns & sysAns == 'Y') {

                givenAnswer = true;
              } else if (sysAns == 'N') {
                givenAnswer = true;
              } else {
                givenAnswer = false;
                break
              }

              i++;
            }



            let _token = $('meta[name="csrf-token"]').attr('content');
            //save the answer details
            $.ajax({
              url: "/saveanswermcq",
              type: "POST",
              data: {
                qstype: 'MCQ',
                examseat: examSeat,
                qsnumber: currentQuestionID,
                givenAnswer: givenAnswer,
                message: 'NA',
                _token: _token
              },
              success: function(response) {
                console.log(response);
                if (response) {
                  $('.success').text(response.success);

                }
              },
            });



          } else if (currentQuestionType == 'FILLBLANKS') {

            console.log('Fill blanks insde');
            var entrycount = $('#entry' + currentQuestion + '-qentrycount').val();
            var i = 1;
            answerState = true;
            console.log('entrycount ' + entrycount);
            while (entrycount >= i && answerState) {

              var blankscount = $('#entry' + currentQuestion + '-q' + i + '-bcount').val();
              var b = 1;
              console.log('blankscount ' + blankscount);
              while (blankscount >= b) {
                var checkanswerval = $('#entry' + currentQuestion + '-stateq' + i + '-b' + b + '').val();
                console.log('checkanswerval' + checkanswerval);
                console.log('b ' + b);
                if (checkanswerval == 1) {
                  answerState = true;
                } else {
                  answerState = false;
                  console.log('break the while');
                  break;
                }
                b++;
              }


              i++;
            }


            console.log(' --------------------------------------- AJAX ----------------------------------------');

            console.log('examSeat ' + examSeat);
            console.log('currentQuestionID ' + currentQuestionID);
            console.log('answerState ' + answerState);

            let _token = $('meta[name="csrf-token"]').attr('content');
            console.log('examseat ' + examSeat);
            console.log('currentQuestionID ' + currentQuestionID);
            console.log('answerState ' + answerState);
            //save the answer details
            $.ajax({
              url: "/saveanswerfillblanks",
              type: "POST",
              data: {
                qstype: 'FILLBLANKS',
                examseat: examSeat,
                qsnumber: currentQuestionID,
                givenAnswer: answerState,
                message: 'NA',
                _token: _token
              },
              success: function(response) {
                console.log('the resonce' + response);
                if (response) {
                  $('.success').text(response.success);

                }
              },
            });


          } else if (currentQuestionType == 'TRUEFALSE') {

            //var answersCount = $('#answerscount').val();qsanswercount
            var currentAnswerCount = $('#entry' + currentQuestion + '-qsanswercount').val();
            var i = 1;
            var answerState = true;

            while (currentAnswerCount >= i && answerState) {

              var checkanswertrue = $('#entry' + currentQuestion + '-truecheck' + i).is(':checked');
              var checkanswerfalse = $('#entry' + currentQuestion + '-falsecheck' + i).is(':checked');


              console.log('checkanswertrue ' + checkanswertrue);
              console.log('checkanswerfalse ' + checkanswerfalse);

              if (checkanswertrue) {
                var realamswer = $('#entry' + currentQuestion + '-correctanswer' + i).val();
                console.log('realamswer ' + realamswer);
                if (realamswer == 'True') {
                  answerState = true;
                } else {
                  var answerState = false;
                  break;
                }
              } else if (checkanswerfalse) {
                var realamswer = $('#entry' + currentQuestion + '-correctanswer' + i).val();
                console.log('realamswer ' + realamswer);
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

            console.log('answerState ' + answerState);

            let _token = $('meta[name="csrf-token"]').attr('content');

            //save the answer details
            $.ajax({
              url: "/saveanswertruefalse",
              type: "POST",
              data: {
                qstype: 'TRUEFALSE',
                examseat: examSeat,
                qsnumber: currentQuestionID,
                givenAnswer: answerState,
                message: 'NA',
                _token: _token
              },
              success: function(response) {
                console.log('the resonce' + response);
                if (response) {
                  $('.success').text(response.success);

                }
              },
            });

          } else if (currentQuestionType == 'MATCHING') {

            var answersCount = $('#entry' + currentQuestion + '-qsanswercount').val();
            var i = 1;
            var answerState = false;
            while (answersCount >= i) {

              var selectedAnswer = $('#entry' + currentQuestion + '-matchingq' + i).val();
              var correctAnswer = $('#entry' + currentQuestion + '-correct' + i).val();

              if (selectedAnswer == correctAnswer) {
                answerState = true;
              } else {
                var answerState = false;
                break;
              }

              i++;
            }

            let _token = $('meta[name="csrf-token"]').attr('content');

            //save the answer details
            $.ajax({
              url: "/saveanswermatching",
              type: "POST",
              data: {
                qstype: 'MATCHING',
                examseat: examSeat,
                qsnumber: currentQuestionID,
                givenAnswer: answerState,
                message: 'NA',
                _token: _token
              },
              success: function(response) {
                console.log('the resonce' + response);
                if (response) {
                  $('.success').text(response.success);

                }
              },
            });

          } else if (currentQuestionType == 'SHORT') {

            var thisAnswerShort = $('#entry' + currentQuestion + '-shortanswer').val();
            console.log(thisAnswerShort);

            let _token = $('meta[name="csrf-token"]').attr('content');

            //save the answer details
            $.ajax({
              url: "/saveanswershort",
              type: "POST",
              data: {
                qstype: 'SHORT',
                examseat: examSeat,
                qsnumber: currentQuestionID,
                givenAnswer: thisAnswerShort,
                message: 'NA',
                _token: _token
              },
              success: function(response) {
                console.log('the resonce' + response);
                if (response) {
                  $('.success').text(response.success);

                }
              },
            });


          } else if (currentQuestionType == 'ESSAY') {
            var thisAnswerEssay = $('#entry' + currentQuestion + '-essayanswer').val();
            console.log(thisAnswerEssay);

            let _token = $('meta[name="csrf-token"]').attr('content');

            //save the answer details
            $.ajax({
              url: "/saveansweressay",
              type: "POST",
              data: {
                qstype: 'ESSAY',
                examseat: examSeat,
                qsnumber: currentQuestionID,
                givenAnswer: thisAnswerEssay,
                message: 'NA',
                _token: _token
              },
              success: function(response) {
                console.log('the resonce' + response);
                if (response) {
                  $('.success').text(response.success);

                }
              },
            });


          } //end if ajax if else

          //next question display
          console.log(qscount);
          console.log(currentQuestion);
          if (parseInt(qscount) >= parseInt(currentPosition)) {

            $('#entry' + currentQuestion).hide();
            $('#entry' + currentQuestion + "-status").val(1);
            currentQuestion++;
            currentPosition++;


            if (currentPosition == 1) {
              $('#prebutton').hide();
            } else {
              $('#prebutton').show();
            }

            var qsCount = $('#examqscount').val();

            if (qsCount == currentPosition) {
              $('#nextbutton').hide();
            } else {
              $('#nextbutton').show();
            }
            var statusValue = $('#entry' + currentQuestion + "-status").val();
            // while (statusValue == 1) {

            //   currentQuestion++;
            //   statusValue = $('#entry' + currentQuestion + "-status").val();

            // }




            var qstype = $('#entry' + currentQuestion + '-qstype').val();
            var qstypeold = $('#entry' + oldposion + '-qstype').val();
            $('#qstypedisplay').html(qstype);
            console.log('---------------------outside finish');
            console.log('currentPosition ' + currentPosition);
            console.log('qscount ' + qscount);
         //   if (currentPosition > qscount) {
              if (false) {


              console.log('---------------------inside finish');
              $('#openexamstatus').val('F');
              var q = 0;
              nextPassedQuestion = '0';
              isPassAvaibale = false;
              while (qscount > q) {

                var qsPassStatus = $('#entry' + q + '-status').val();
                console.log('<br/>' + qsPassStatus + '    -->' + q);

                if (qsPassStatus == '2') {
                  isPassAvaibale = true;
                  nextPassedQuestion = q;
                  break;
                }

                q++;
              }

              console.log('isPassAvaibale ->' + isPassAvaibale);
              console.log('nextPassedQuestion ->' + nextPassedQuestion);
              if (isPassAvaibale) {

                $('.passqsindicator').show();
                var lastpassentry = $('#lastpassentry').val();
                if (lastpassentry != 'NA') {
                  $('#entry' + lastpassentry).hide();
                }
                $('#entry' + nextPassedQuestion).show();
                $('#lastpassentry').val(nextPassedQuestion);

                var temPosition = nextPassedQuestion + 1;
                var funalPosition = parseInt(qscount) + 1;
                var nextPassedQuestionPlus = qscount + 1

                console.log('temPosition' + temPosition);

                $('#qsnumberdisplay').html(temPosition);
                $('#currentquestionentry').val(nextPassedQuestion);
                $('#currentPosition').val(qscount);
                $('#entry' + nextPassedQuestion + '-status').val(1);

              } else {

                $('#prebutton').prop("disabled", true);
                $('#nextbutton').prop("disabled", true);
                $('#passbutton').prop("disabled", true);
                $('.qsEntryBlock').hide();
                $('.qsFinishBlock').show();

                let _token = $('meta[name="csrf-token"]').attr('content');
                var studentid = $('#studentid').val();
                //save the answer details
                $.ajax({
                  url: "/examfinishedupdate",
                  type: "POST",
                  data: {

                    examseat: examSeat,
                    studentid: studentid,
                    _token: _token
                  },
                  success: function(response) {
                    console.log(response);
                    if (response) {
                      $('.success').text(response.success);

                    }
                  },
                });

              }






            } else {
              $('#entry' + currentQuestion).show();
              $('#qsnumberdisplay').html(currentPosition);
              $('#currentquestionentry').val(currentQuestion);
              $('#currentPosition').val(currentPosition);
            }

          } else {
            $('#prebutton').prop("disabled", true);
            $('#nextbutton').prop("disabled", true);
            $('#passbutton').prop("disabled", true);
            $('.qsEntryBlock').hide();
            $('.qsFinishBlock').show();

            let _token = $('meta[name="csrf-token"]').attr('content');
            var studentid = $('#studentid').val();
            //save the answer details
            $.ajax({
              url: "/examfinishedupdate",
              type: "POST",
              data: {

                examseat: examSeat,
                studentid: studentid,
                _token: _token
              },
              success: function(response) {
                console.log(response);
                if (response) {
                  $('.success').text(response.success);

                }
              },
            });
          }

        }


      });

      $('#prebutton').click(function() {

        var currentQuestion = $('#currentquestionentry').val();
        var currentPosition = $('#currentPosition').val();
        var oldposion = currentQuestion;

        var currentQuestionType = $('#entry' + currentQuestion + '-qstype').val();
        var currentQuestionID = $('#entry' + currentQuestion + '-qsid').val();
        var examSeat = $('#examseatid').val();
        var qscount = $('#examqscount').val();

        if (currentQuestionType == 'MCQ') { //chack ans save the answer for MCQ

          var currentAnswerCount = $('#entry' + currentQuestion + '-answerscount').val();
          var i = 1;
          var givenAnswer = false;


          while (currentAnswerCount >= i) {

            var givenAns = $('#entry' + currentQuestion + '-answercheck' + i).is(':checked');
            var sysAns = $('#entry' + currentQuestion + '-correctanswer' + i).val();


            if (givenAns & sysAns == 'Y') {

              givenAnswer = true;
            } else if (sysAns == 'N') {
              givenAnswer = true;
            } else {
              givenAnswer = false;
              break
            }

            i++;
          }



          let _token = $('meta[name="csrf-token"]').attr('content');
          //save the answer details
          $.ajax({
            url: "/saveanswermcq",
            type: "POST",
            data: {
              qstype: 'MCQ',
              examseat: examSeat,
              qsnumber: currentQuestionID,
              givenAnswer: givenAnswer,
              message: 'NA',
              _token: _token
            },
            success: function(response) {
              console.log(response);
              if (response) {
                $('.success').text(response.success);

              }
            },
          });



        } else if (currentQuestionType == 'FILLBLANKS') {

          console.log('Fill blanks insde');
          var entrycount = $('#entry' + currentQuestion + '-qentrycount').val();
          var i = 1;
          answerState = true;
          console.log('entrycount ' + entrycount);
          while (entrycount >= i && answerState) {

            var blankscount = $('#entry' + currentQuestion + '-q' + i + '-bcount').val();
            var b = 1;
            console.log('blankscount ' + blankscount);
            while (blankscount >= b) {
              var checkanswerval = $('#entry' + currentQuestion + '-stateq' + i + '-b' + b + '').val();
              console.log('checkanswerval' + checkanswerval);
              console.log('b ' + b);
              if (checkanswerval == 1) {
                answerState = true;
              } else {
                answerState = false;
                console.log('break the while');
                break;
              }
              b++;
            }


            i++;
          }


          console.log(' --------------------------------------- AJAX ----------------------------------------');

          console.log('examSeat ' + examSeat);
          console.log('currentQuestionID ' + currentQuestionID);
          console.log('answerState ' + answerState);

          let _token = $('meta[name="csrf-token"]').attr('content');
          console.log('examseat ' + examSeat);
          console.log('currentQuestionID ' + currentQuestionID);
          console.log('answerState ' + answerState);
          //save the answer details
          $.ajax({
            url: "/saveanswerfillblanks",
            type: "POST",
            data: {
              qstype: 'FILLBLANKS',
              examseat: examSeat,
              qsnumber: currentQuestionID,
              givenAnswer: answerState,
              message: 'NA',
              _token: _token
            },
            success: function(response) {
              console.log('the resonce' + response);
              if (response) {
                $('.success').text(response.success);

              }
            },
          });


        } else if (currentQuestionType == 'TRUEFALSE') {

          //var answersCount = $('#answerscount').val();qsanswercount
          var currentAnswerCount = $('#entry' + currentQuestion + '-qsanswercount').val();
          var i = 1;
          var answerState = true;

          while (currentAnswerCount >= i && answerState) {

            var checkanswertrue = $('#entry' + currentQuestion + '-truecheck' + i).is(':checked');
            var checkanswerfalse = $('#entry' + currentQuestion + '-falsecheck' + i).is(':checked');


            console.log('checkanswertrue ' + checkanswertrue);
            console.log('checkanswerfalse ' + checkanswerfalse);

            if (checkanswertrue) {
              var realamswer = $('#entry' + currentQuestion + '-correctanswer' + i).val();
              console.log('realamswer ' + realamswer);
              if (realamswer == 'True') {
                answerState = true;
              } else {
                var answerState = false;
                break;
              }
            } else if (checkanswerfalse) {
              var realamswer = $('#entry' + currentQuestion + '-correctanswer' + i).val();
              console.log('realamswer ' + realamswer);
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

          console.log('answerState ' + answerState);

          let _token = $('meta[name="csrf-token"]').attr('content');

          //save the answer details
          $.ajax({
            url: "/saveanswertruefalse",
            type: "POST",
            data: {
              qstype: 'TRUEFALSE',
              examseat: examSeat,
              qsnumber: currentQuestionID,
              givenAnswer: answerState,
              message: 'NA',
              _token: _token
            },
            success: function(response) {
              console.log('the resonce' + response);
              if (response) {
                $('.success').text(response.success);

              }
            },
          });

        } else if (currentQuestionType == 'MATCHING') {

          var answersCount = $('#entry' + currentQuestion + '-qsanswercount').val();
          var i = 1;
          var answerState = false;
          while (answersCount >= i) {

            var selectedAnswer = $('#entry' + currentQuestion + '-matchingq' + i).val();
            var correctAnswer = $('#entry' + currentQuestion + '-correct' + i).val();

            if (selectedAnswer == correctAnswer) {
              answerState = true;
            } else {
              var answerState = false;
              break;
            }

            i++;
          }

          let _token = $('meta[name="csrf-token"]').attr('content');

          //save the answer details
          $.ajax({
            url: "/saveanswermatching",
            type: "POST",
            data: {
              qstype: 'MATCHING',
              examseat: examSeat,
              qsnumber: currentQuestionID,
              givenAnswer: answerState,
              message: 'NA',
              _token: _token
            },
            success: function(response) {
              console.log('the resonce' + response);
              if (response) {
                $('.success').text(response.success);

              }
            },
          });

        } else if (currentQuestionType == 'SHORT') {

          var thisAnswerShort = $('#entry' + currentQuestion + '-shortanswer').val();
          console.log(thisAnswerShort);

          let _token = $('meta[name="csrf-token"]').attr('content');

          //save the answer details
          $.ajax({
            url: "/saveanswershort",
            type: "POST",
            data: {
              qstype: 'SHORT',
              examseat: examSeat,
              qsnumber: currentQuestionID,
              givenAnswer: thisAnswerShort,
              message: 'NA',
              _token: _token
            },
            success: function(response) {
              console.log('the resonce' + response);
              if (response) {
                $('.success').text(response.success);

              }
            },
          });


        } else if (currentQuestionType == 'ESSAY') {
          var thisAnswerEssay = $('#entry' + currentQuestion + '-essayanswer').val();
          console.log(thisAnswerEssay);

          let _token = $('meta[name="csrf-token"]').attr('content');

          //save the answer details
          $.ajax({
            url: "/saveansweressay",
            type: "POST",
            data: {
              qstype: 'ESSAY',
              examseat: examSeat,
              qsnumber: currentQuestionID,
              givenAnswer: thisAnswerEssay,
              message: 'NA',
              _token: _token
            },
            success: function(response) {
              console.log('the resonce' + response);
              if (response) {
                $('.success').text(response.success);

              }
            },
          });


        } //End of exam type save ajax if else blocks


        $('#entry' + currentQuestion).hide();
        $('#entry' + currentQuestion + "-status").val(1);
        currentQuestion--;
        currentPosition--;

        if (currentPosition == 1) {
          $('#prebutton').hide();
        } else {
          $('#prebutton').show();
        }

        var qsCount = $('#examqscount').val();

        if (qsCount == currentPosition) {
          $('#nextbutton').hide();
        } else {
          $('#nextbutton').show();
        }

        var qstype = $('#entry' + currentQuestion + '-qstype').val();
            var qstypeold = $('#entry' + oldposion + '-qstype').val();
            $('#qstypedisplay').html(qstype);

            $('#entry' + currentQuestion).show();
              $('#qsnumberdisplay').html(currentPosition);
              $('#currentquestionentry').val(currentQuestion);
              $('#currentPosition').val(currentPosition);

      });

      $('#prebutton2').click(function() {



        $('.passqsindicator').hide();
        var currentQuestion = $('#currentquestionentry').val();
        var currentPosition = $('#currentPosition').val();


        var oldposion = currentQuestion;
        var currentQuestionType = $('#entry' + currentQuestion + '-qstype').val();
        var currentQuestionID = $('#entry' + currentQuestion + '-qsid').val();
        var examSeat = $('#examseatid').val();
        var qscount = $('#examqscount').val();
        var openexamstatus = $('#openexamstatus').val();
        console.log('currentQuestionType' + currentQuestionType);
        console.log('currentQuestion' + currentQuestion);

        console.log('start next ---------------------------------------------');
        console.log('currentPosition ' + currentPosition);
        console.log('qscount ' + qscount);
        if (true) {

          if (currentQuestionType == 'MCQ') { //chack ans save the answer for MCQ

            var currentAnswerCount = $('#entry' + currentQuestion + '-answerscount').val();
            var i = 1;
            var givenAnswer = false;


            while (currentAnswerCount >= i) {

              var givenAns = $('#entry' + currentQuestion + '-answercheck' + i).is(':checked');
              var sysAns = $('#entry' + currentQuestion + '-correctanswer' + i).val();


              if (givenAns & sysAns == 'Y') {

                givenAnswer = true;
              } else if (sysAns == 'N') {
                givenAnswer = true;
              } else {
                givenAnswer = false;
                break
              }

              i++;
            }



            let _token = $('meta[name="csrf-token"]').attr('content');
            //save the answer details
            $.ajax({
              url: "/saveanswermcq",
              type: "POST",
              data: {
                qstype: 'MCQ',
                examseat: examSeat,
                qsnumber: currentQuestionID,
                givenAnswer: givenAnswer,
                message: 'NA',
                _token: _token
              },
              success: function(response) {
                console.log(response);
                if (response) {
                  $('.success').text(response.success);

                }
              },
            });



          } else if (currentQuestionType == 'FILLBLANKS') {

            console.log('Fill blanks insde');
            var entrycount = $('#entry' + currentQuestion + '-qentrycount').val();
            var i = 1;
            answerState = true;
            console.log('entrycount ' + entrycount);
            while (entrycount >= i && answerState) {

              var blankscount = $('#entry' + currentQuestion + '-q' + i + '-bcount').val();
              var b = 1;
              console.log('blankscount ' + blankscount);
              while (blankscount >= b) {
                var checkanswerval = $('#entry' + currentQuestion + '-stateq' + i + '-b' + b + '').val();
                console.log('checkanswerval' + checkanswerval);
                console.log('b ' + b);
                if (checkanswerval == 1) {
                  answerState = true;
                } else {
                  answerState = false;
                  console.log('break the while');
                  break;
                }
                b++;
              }


              i++;
            }


            console.log(' --------------------------------------- AJAX ----------------------------------------');

            console.log('examSeat ' + examSeat);
            console.log('currentQuestionID ' + currentQuestionID);
            console.log('answerState ' + answerState);

            let _token = $('meta[name="csrf-token"]').attr('content');
            console.log('examseat ' + examSeat);
            console.log('currentQuestionID ' + currentQuestionID);
            console.log('answerState ' + answerState);
            //save the answer details
            $.ajax({
              url: "/saveanswerfillblanks",
              type: "POST",
              data: {
                qstype: 'FILLBLANKS',
                examseat: examSeat,
                qsnumber: currentQuestionID,
                givenAnswer: answerState,
                message: 'NA',
                _token: _token
              },
              success: function(response) {
                console.log('the resonce' + response);
                if (response) {
                  $('.success').text(response.success);

                }
              },
            });


          } else if (currentQuestionType == 'TRUEFALSE') {

            //var answersCount = $('#answerscount').val();qsanswercount
            var currentAnswerCount = $('#entry' + currentQuestion + '-qsanswercount').val();
            var i = 1;
            var answerState = true;

            while (currentAnswerCount >= i && answerState) {

              var checkanswertrue = $('#entry' + currentQuestion + '-truecheck' + i).is(':checked');
              var checkanswerfalse = $('#entry' + currentQuestion + '-falsecheck' + i).is(':checked');


              console.log('checkanswertrue ' + checkanswertrue);
              console.log('checkanswerfalse ' + checkanswerfalse);

              if (checkanswertrue) {
                var realamswer = $('#entry' + currentQuestion + '-correctanswer' + i).val();
                console.log('realamswer ' + realamswer);
                if (realamswer == 'True') {
                  answerState = true;
                } else {
                  var answerState = false;
                  break;
                }
              } else if (checkanswerfalse) {
                var realamswer = $('#entry' + currentQuestion + '-correctanswer' + i).val();
                console.log('realamswer ' + realamswer);
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

            console.log('answerState ' + answerState);

            let _token = $('meta[name="csrf-token"]').attr('content');

            //save the answer details
            $.ajax({
              url: "/saveanswertruefalse",
              type: "POST",
              data: {
                qstype: 'TRUEFALSE',
                examseat: examSeat,
                qsnumber: currentQuestionID,
                givenAnswer: answerState,
                message: 'NA',
                _token: _token
              },
              success: function(response) {
                console.log('the resonce' + response);
                if (response) {
                  $('.success').text(response.success);

                }
              },
            });

          } else if (currentQuestionType == 'MATCHING') {

            var answersCount = $('#entry' + currentQuestion + '-qsanswercount').val();
            var i = 1;
            var answerState = false;
            while (answersCount >= i) {

              var selectedAnswer = $('#entry' + currentQuestion + '-matchingq' + i).val();
              var correctAnswer = $('#entry' + currentQuestion + '-correct' + i).val();

              if (selectedAnswer == correctAnswer) {
                answerState = true;
              } else {
                var answerState = false;
                break;
              }

              i++;
            }

            let _token = $('meta[name="csrf-token"]').attr('content');

            //save the answer details
            $.ajax({
              url: "/saveanswermatching",
              type: "POST",
              data: {
                qstype: 'MATCHING',
                examseat: examSeat,
                qsnumber: currentQuestionID,
                givenAnswer: answerState,
                message: 'NA',
                _token: _token
              },
              success: function(response) {
                console.log('the resonce' + response);
                if (response) {
                  $('.success').text(response.success);

                }
              },
            });

          } else if (currentQuestionType == 'SHORT') {

            var thisAnswerShort = $('#entry' + currentQuestion + '-shortanswer').val();
            console.log(thisAnswerShort);

            let _token = $('meta[name="csrf-token"]').attr('content');

            //save the answer details
            $.ajax({
              url: "/saveanswershort",
              type: "POST",
              data: {
                qstype: 'SHORT',
                examseat: examSeat,
                qsnumber: currentQuestionID,
                givenAnswer: thisAnswerShort,
                message: 'NA',
                _token: _token
              },
              success: function(response) {
                console.log('the resonce' + response);
                if (response) {
                  $('.success').text(response.success);

                }
              },
            });


          } else if (currentQuestionType == 'ESSAY') {
            var thisAnswerEssay = $('#entry' + currentQuestion + '-essayanswer').val();
            console.log(thisAnswerEssay);

            let _token = $('meta[name="csrf-token"]').attr('content');

            //save the answer details
            $.ajax({
              url: "/saveansweressay",
              type: "POST",
              data: {
                qstype: 'ESSAY',
                examseat: examSeat,
                qsnumber: currentQuestionID,
                givenAnswer: thisAnswerEssay,
                message: 'NA',
                _token: _token
              },
              success: function(response) {
                console.log('the resonce' + response);
                if (response) {
                  $('.success').text(response.success);

                }
              },
            });


          }

          //next question display
          console.log(qscount);
          console.log(currentQuestion);
          if (parseInt(currentPosition) > 1) {

            $('#entry' + currentQuestion).hide();
            $('#entry' + currentQuestion + "-status").val(1);
            currentQuestion--;
            currentPosition--;

            if (currentPosition == 1) {
              $('#prebutton').hide();
            } else {
              $('#prebutton').show();
            }

            var statusValue = $('#entry' + currentQuestion + "-status").val();
            while (statusValue == 1) {

              currentQuestion++;
              statusValue = $('#entry' + currentQuestion + "-status").val();

            }




            var qstype = $('#entry' + currentQuestion + '-qstype').val();
            var qstypeold = $('#entry' + oldposion + '-qstype').val();
            $('#qstypedisplay').html(qstype);
            console.log('---------------------outside finish');
            console.log('currentPosition ' + currentPosition);
            console.log('qscount ' + qscount);
            if (currentPosition == 0) {


              console.log('---------------------inside finish');
              $('#openexamstatus').val('F');
              var q = 0;
              nextPassedQuestion = '0';
              isPassAvaibale = false;
              while (qscount > q) {

                var qsPassStatus = $('#entry' + q + '-status').val();
                console.log('<br/>' + qsPassStatus + '    -->' + q);

                if (qsPassStatus == '2') {
                  isPassAvaibale = true;
                  nextPassedQuestion = q;
                  break;
                }

                q++;
              }

              console.log('isPassAvaibale ->' + isPassAvaibale);
              console.log('nextPassedQuestion ->' + nextPassedQuestion);
              if (isPassAvaibale) {

                $('.passqsindicator').show();
                var lastpassentry = $('#lastpassentry').val();
                if (lastpassentry != 'NA') {
                  $('#entry' + lastpassentry).hide();
                }
                $('#entry' + nextPassedQuestion).show();
                $('#lastpassentry').val(nextPassedQuestion);

                var temPosition = nextPassedQuestion + 1;
                var funalPosition = parseInt(qscount) + 1;
                var nextPassedQuestionPlus = qscount + 1

                console.log('temPosition' + temPosition);

                $('#qsnumberdisplay').html(temPosition);
                $('#currentquestionentry').val(nextPassedQuestion);
                $('#currentPosition').val(qscount);
                $('#entry' + nextPassedQuestion + '-status').val(1);

              } else {

                $('#prebutton').prop("disabled", true);
                $('#nextbutton').prop("disabled", true);
                $('#passbutton').prop("disabled", true);
                $('.qsEntryBlock').hide();
                $('.qsFinishBlock').show();

                let _token = $('meta[name="csrf-token"]').attr('content');
                var studentid = $('#studentid').val();
                //save the answer details
                $.ajax({
                  url: "/examfinishedupdate",
                  type: "POST",
                  data: {

                    examseat: examSeat,
                    studentid: studentid,
                    _token: _token
                  },
                  success: function(response) {
                    console.log(response);
                    if (response) {
                      $('.success').text(response.success);

                    }
                  },
                });

              }






            } else {
              currentQuestion--;
              currentPosition--;
              $('#entry' + currentQuestion).show();
              $('#qsnumberdisplay').html(currentPosition);
              $('#currentquestionentry').val(currentQuestion);
              $('#currentPosition').val(currentPosition);
            }

          } else {
            $('#prebutton').prop("disabled", true);
            $('#nextbutton').prop("disabled", true);
            $('#passbutton').prop("disabled", true);
            $('.qsEntryBlock').hide();
            $('.qsFinishBlock').show();

            let _token = $('meta[name="csrf-token"]').attr('content');
            var studentid = $('#studentid').val();
            //save the answer details
            $.ajax({
              url: "/examfinishedupdate",
              type: "POST",
              data: {

                examseat: examSeat,
                studentid: studentid,
                _token: _token
              },
              success: function(response) {
                console.log(response);
                if (response) {
                  $('.success').text(response.success);

                }
              },
            });
          }

        }




      });



      $('#passbutton').click(function() {
        $('.passqsindicator').hide();
        console.log('--------------------------------PASS-------------------------------------');
        var currentQuestion = $('#currentquestionentry').val();
        var currentPosition = $('#currentPosition').val();
        var oldposion = currentQuestion;
        var qscount = $('#examqscount').val();
        $('#entry' + currentQuestion + "-status").val(2);
        console.log('currentQuestion ' + currentQuestion);
        console.log('qscount ' + qscount);

        if(currentQuestion == 0){
            $('#prebutton').show();
        }else{
            $('#prebutton').show();
        }

        console.log('currentQuestion ' + currentQuestion);

        if (parseInt(qscount) > parseInt(currentPosition)) {

          $('#entry' + currentQuestion).hide();

          //display the passquestion on list above
          $('#passqslist').append('<div class="col-sm-1" id="passed_btndiv' + currentPosition + '"><button type="button" class="pasentrypod btn btn-block btn-outline-warning btn-sm" onclick="loadpassedentry(this)" id="passed_btn' + currentPosition + '" >PASS ' + currentPosition + '</button></div>');

          currentQuestion++;
          currentPosition++;
          var statusValue = $('#entry' + currentQuestion + "-status").val();
          while (statusValue == 1) {

            currentQuestion++;
            statusValue = $('#entry' + currentQuestion + "-status").val();

          }

          $('#entry' + currentQuestion).show();
          $('#qsnumberdisplay').html(currentPosition);
          $('#currentquestionentry').val(currentQuestion);
          $('#currentPosition').val(currentPosition);


          var qstype = $('#entry' + currentQuestion + '-qstype').val();
          var qstypeold = $('#entry' + oldposion + '-qstype').val();
          $('#qstypedisplay').html(qstype);


        } else {
          var q = 0;
          nextPassedQuestion = '0';
          isPassAvaibale = false;
          while (qscount > q) {

            var qsPassStatus = $('#entry' + q + '-status').val();
            console.log('<br/>' + qsPassStatus + '    -->' + q);

            if (qsPassStatus == '2') {
              isPassAvaibale = true;
              nextPassedQuestion = q;
              break;
            }

            q++;
          }

          console.log('isPassAvaibale ->' + isPassAvaibale);
          console.log('nextPassedQuestion ->' + nextPassedQuestion);
          if (isPassAvaibale) {
            $('.passqsindicator').show();
            var lastpassentry = $('#lastpassentry').val();
            if (lastpassentry != 'NA') {
              $('#entry' + lastpassentry).hide();
            } else {
              $('#entry' + currentQuestion).hide();
            }
            $('#entry' + nextPassedQuestion).show();
            $('#lastpassentry').val(nextPassedQuestion);

            var temPosition = nextPassedQuestion + 1;
            var funalPosition = parseInt(qscount) + 1;
            var nextPassedQuestionPlus = qscount + 1

            console.log('temPosition' + temPosition);

            $('#qsnumberdisplay').html(temPosition);
            $('#currentquestionentry').val(nextPassedQuestion);
            $('#currentPosition').val(qscount);
            $('#entry' + nextPassedQuestion + '-status').val(1);

          } else {

            $('#prebutton').prop("disabled", true);
            $('#nextbutton').prop("disabled", true);
            $('#passbutton').prop("disabled", true);
            $('.qsEntryBlock').hide();
            $('.qsFinishBlock').show();

            let _token = $('meta[name="csrf-token"]').attr('content');
            var studentid = $('#studentid').val();
            //save the answer details
            $.ajax({
              url: "/examfinishedupdate",
              type: "POST",
              data: {

                examseat: examSeat,
                studentid: studentid,
                _token: _token
              },
              success: function(response) {
                console.log(response);
                if (response) {
                  $('.success').text(response.success);

                }
              },
            });

          }
        }


      });




    }

    $('.canvasentrychecker').mouseenter(function() {
      console.log(this.id);
      var thientryid = this.id;

      var currentEntry = $('#currentquestionentry').val();
      var examseatid = $('#examseatid').val();
      var questionid = $('#entry' + currentEntry + '-qsid').val();

      console.log(currentEntry);
      console.log(examseatid);
      console.log(questionid);

      $.get('/getthepenanswers/' + examseatid + '-' + questionid + '', function(response) {
        $('#penbox' + currentEntry).empty();
        var responseSize = response.length;
        var i = 0;
        while (responseSize > i) {

          var url = "{{ url('useruploaded/answercanvas') }}";
          var canvaValue = response[i]['canvas'];
          var canvasImage = canvaValue.substring(20);;
          console.log(canvasImage);
          $('#penbox' + currentEntry).append('<div class="col-md-3" style="border:darkblue solid 1px;">\
<img src="' + url + '/' + canvasImage + '" width="100%" />\
</div>');

          i++;
        }


      });


    });
  </script>


</body>


</html>