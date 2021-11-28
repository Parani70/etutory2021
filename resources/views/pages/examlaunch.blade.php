<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | Exam Centre</title>
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
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{URL::asset('dist/img/favicon.png')}}" />
  <style>
    .sorrycontainer {
      padding: 100px;
    }

    .sorrycontainer-box h2 {
      text-align: center;
      font-family: "Nunito", sans-serif;
      font-size: 6rem;
      color: #FFCA08;
      font-weight: 800;
      margin-bottom: 50px;
    }

    .sorrycontainer-box h4 {
      text-align: center;
      font-family: "Nunito", sans-serif;
      font-size: 3rem;
      font-weight: 800;
    }

    .sorrycontainer-box p {
      text-align: center;
      font-family: "Nunito", sans-serif;
      font-size: 2rem;
      font-weight: 800;
    }

    #btn-examcentre{
      border:#FFCA08 2px solid;
      color: #FFCA08;
      padding: 20px;
      text-align: center;
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 200px;
      font-weight: 900;
      margin-top: 50px;
      border-radius: 5px;
      font-size: 1.3rem;
    }

    #btn-examcentre:hover{
      border:#493c3e 2px solid;
      color: #493c3e;
      padding: 20px;
      text-align: center;
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 200px;
      font-weight: 900;
      margin-top: 50px;
      border-radius: 5px;
      font-size: 1.3rem;
    }

  </style>
</head>

<body>
  @if($dataset['examcount'] == 0 )


  <div class="container sorrycontainer">
    <div class="row">
      <div class="col sorrycontainer-box">
        <h2>Sorry!</h2>
        <h4>No template available</h4>
        <p>Please contact the etutory.lk team !</p>
        <a href="{{url('/elearninghome')}}" id="btn-examcentre">Exam Centre</a>
      </div>
    </div>
  </div>
  @else

  <div class="container">
    <div class="row">
      <div class="col examheader">
        <h1>Online Exam Center</h1>
        <h3>{{$dataset['examData'][0]->coursename}} </h3>
        <h4>Grade : {{$dataset['examData'][0]->gradename}}</h4>
        <h4>Subject : {{$dataset['examData'][0]->subjectname}}</h4>
        <h4>Student Name : {{$dataset['examStudentTransData'][0]->studentname}}</h4>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title"><strong>Instructions</strong></h5>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <p class="text-danger">Please read the guidelines fully, before starting the test.</p>
              </div>
            </div>


            <div class="row">
              <div class="col">
                <ol>
                  <li>There is a timer displayed on the top right corner. That is the remaining time for the test. when the time reach 00:00
                    test will be closed automatically.
                  </li>
                  <li>For Part I paper, all questions will be MCQ type</li>
                  <li>For MCQ type questions, you can mark the answer, by clicking with mouse on the check box given.</li>
                  <li>For Part 1 paper, correction will be done automatically and results will be available in the history page just after completing
                    the test
                    .</li>
                  <li>Part II paper questions will be short answer and essay type questions

                  </li>
                  <li>You can answer them by 1. Typing in the text area directly 2. By using a Smart Pen to write in the text area 3. Uploading
                    scanned image of answer sheet
                  </li>
                  <li>Part II paper answers will be corrected by teachers and the results will be mailed to you within 5 working days.</li>
                  <li>After answering a question, click on the "Next" button to go to the next question</li>
                  <li>You can click on "Pass Question" button to pass a question and move to the next question. "Passed" questions will be
                    indicated on the top right corner (below timer). You can reload these questions by clicking on the question numbers
                  </li>
                  <li>After answering all the questions, you can complete the test by clicking on "Completed Test" button.</li>
                </ol>
              </div>
            </div>
            <form role="form" action="{{url('/startexam') }}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <input type="hidden" id="examid" value="{{$dataset['examid']}}" name="examid">

              <button type="submit" class="btn btn-block btn-success btn-lg col-sm-4">START</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>

  @endif

</body>

</html>