<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | Manage Exam Templates</title>
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
  <!-- DataTables -->
  <link rel="stylesheet" href="{{URL::asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

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

      </div>
      <!-- /.content-header -->
      <form role="form" action="{{url('/updatepapertemplate') }}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-md-12">

                <div class="card card-default">
                  <div class="card-header">
                    <h3 class="card-title">Manage Exam Template</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>

                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Exam Name</label>
                          <input type="text" class="form-control float-right" value="{{$dataset['examTemplateData'][0]->coursename}}" name="coursename">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Exam Type</label>
                          <select name="examtype" id="examtype" class="form-control select2 subcatentries_change" style="width: 100%;">
                            <option value="-- Choose User Option --">-- Choose Exam Type --</option>
                            @if(count($dataset['examtypedata']) > 0)
                            @foreach($dataset['examtypedata']->all() as $examtype)
                            @if($examtype->id == $dataset['examTemplateData'][0]->examtypeid)
                            <option selected value="{{$examtype->id.'-'.$examtype->examtype}}">{{$examtype->examtype}}</option>
                            @else
                            <option value="{{$examtype->id.'-'.$examtype->examtype}}">{{$examtype->examtype}}</option>
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
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Subject</label>
                          <select name="subject" id="subject" class="form-control select2 subcatentries_change" style="width: 100%;">
                            <option value="-- Choose User Option --">-- Choose Subject --</option>
                            @if(count($dataset['subjectdata']) > 0)
                            @foreach($dataset['subjectdata']->all() as $subject)

                            @if($subject->id == $dataset['examTemplateData'][0]->subjectid)
                            <option selected value="{{$subject->id.'-'.$subject->subject}}">{{$subject->subject}}</option>
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

                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Grade</label>
                          <select name="grade" id="grade" class="form-control select2 subcatentries_change" style="width: 100%;">
                            <option value="-- Choose User Option --">-- Choose Grade --</option>
                            @if(count($dataset['gradedata']) > 0)
                            @foreach($dataset['gradedata']->all() as $grade)

                            @if($grade->id == $dataset['examTemplateData'][0]->gradeid)
                            <option selected value="{{$grade->id.'-'.$grade->grade}}">{{$grade->grade}}</option>
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
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Number of Questions</label>
                          <input type="number" class="form-control float-right" value="{{$dataset['examTemplateData'][0]->numberofquestion}}" name="noofquestions" id="noofquestions">

                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label>Duration</label>

                          <input type="number" class="form-control float-right" value="{{$dataset['examTemplateData'][0]->durationhour}}" name="durationhr" placeholder="HH">



                        </div>

                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label>&nbsp;</label>
                          <input type="number" class="form-control float-right" value="{{$dataset['examTemplateData'][0]->durationminute}}" name="durationmin" placeholder="mm">


                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Language</label>

                          <select name="language" class="form-control select2" style="width: 100%;">
                            <option value="-- Choose User Option --">-- Choose Language --</option>
                            @if($dataset['examTemplateData'][0]->userlang == 'Tamil')
                            <option value="English">English</option>
                            <option value="Sinhala">Sinhala</option>
                            <option selected value="Tamil">Tamil</option>
                            @elseif($dataset['examTemplateData'][0]->userlang == 'Sinhala')
                            <option value="English">English</option>
                            <option selected value="Sinhala">Sinhala</option>
                            <option value="Tamil">Tamil</option>
                            @else
                            <option selected value="English">English</option>
                            <option value="Sinhala">Sinhala</option>
                            <option value="Tamil">Tamil</option>
                            @endif



                          </select>
                          @error('language')

                          <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                          @enderror

                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Status</label>

                          <select name="status" class="form-control select2" style="width: 100%;">
                            <option value="-- Choose User Option --">-- Choose Language --</option>
                            @if($dataset['examTemplateData'][0]->status == 'A')
                            <option selected value="A">Active</option>
                            <option value="D">Disabled</option>
                           
                          
                            @else
                            <option  value="A">Active</option>
                            <option selected value="D">Disabled</option>
                            @endif



                          </select>
                          @error('language')

                          <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                          @enderror

                        </div>
                      </div>
                    </div>
                    @error('noofquestions')

                    <div class="alert alert-danger" role="alert">
                      {{ $message }}
                    </div>
                    @enderror
                    @error('durationhr')

                    <div class="alert alert-danger" role="alert">
                      {{ $message }}
                    </div>
                    @enderror
                    @error('durationmin')

                    <div class="alert alert-danger" role="alert">
                      {{ $message }}
                    </div>
                    @enderror

                  </div>

                </div>

              </div>
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Category</label>
                          <select name="category" id="category" class="form-control select2" style="width: 100%;">
                            <option value="-- Choose User Option --">-- Choose Category --</option>
                            @if(count($dataset['categorydata']) > 0)
                            @foreach($dataset['categorydata']->all() as $category)
                            <option value="{{$category->id.'-'.$category->category}}">{{$category->category}}</option>
                            @endforeach
                            @endif
                          </select>
                          @error('category')

                          <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Sub Category</label>
                          <select name="subcategory" id="subcategory" class="form-control select2" style="width: 100%;">
                            <option value="-- Choose User Option --">-- Choose Sub Category --</option>
                            @if(count($dataset['subcategorydata']) > 0)
                            @foreach($dataset['subcategorydata']->all() as $subcategory)
                            <option value="{{$subcategory->id.'-'.$subcategory->subcategory}}">{{$subcategory->subcategory}}</option>
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
                      <div class="col-md-2">
                        <div class="form-group">
                          <label>Level</label>
                          <select name="level" id="level" class="form-control select2" style="width: 100%;">
                            <option value="-- Choose User Option --">-- Choose Level --</option>
                            @if(count($dataset['leveldata']) > 0)
                            @foreach($dataset['leveldata']->all() as $level)
                            <option value="{{$level->id.'-'.$level->level}}">{{$level->level}}</option>
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
                      <div class="col-md-2">
                        <div class="form-group">
                          <label>Question Type</label>
                          <select name="qstype" id="qstype" class="form-control select2" style="width: 100%;">
                            <option value="-- Choose User Option --">-- Choose Question Type --</option>
                            <option value="MCQ">MCQ</option>
                            <option value="TRUEFALSE">TRUE FALSE</option>
                            <option value="MATCHING">MATCHING</option>
                            <option value="FILLBLANKS">FILL IN BLANKS</option>
                            <option value="SHORT">SHORT</option>
                            <option value="ESSAY">ESSAY</option>
                          </select>
                          @error('qstype')

                          <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label>No Of Questions</label>
                          <input type="text" id="qscount" class="form-control float-right" id="reservation">
                        </div>
                      </div>


                    </div>
                  </div>
                  <div class="card-footer">
                    <input type="hidden" id="qscounter" value="{{$dataset['subQsCountTotal']}}" name="qscounter">
                    <input type="hidden" id="examid" value="{{$dataset['examTemplateData'][0]->id}}" name="examid">

                    <button type="button" class="btn btn-block btn-info btn-sm col-sm-1" id="addentry">Add</button>
                  </div>
                  <!-- /.card-footer-->
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">

                    <table id="questions-datatable" class="table">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Category</th>
                          <th>Sub Category</th>
                          <th>Level</th>
                          <th>Question Type</th>
                          <th>Number of Questions</th>
                          <th></th>

                        </tr>
                      </thead>
                      <tbody id="tbody">
                        @if(count($dataset['examTeplateSubDate']) > 0)
                        @php
                        $i=1;
                        @endphp
                        @foreach($dataset['examTeplateSubDate']->all() as $exampaperEntry)

                        <tr>
                          <td>{{$i}}</td>
                          <td>{{$exampaperEntry->categoryname}}</td>
                          <td>{{$exampaperEntry->subcategoryname}}</td>
                          <td>{{$exampaperEntry->levelname}}</td>
                          <td>{{$exampaperEntry->qstype}}</td>
                          <td>{{$exampaperEntry->qscount}}</td>
                          <td><button type="button" id="removeentry_action{{$i}}" onclick="removeentry_action(this)" class="btn btn-block btn-danger btn-xs"><i class="fas fa-times-circle mr-2"></i>Remove</button></td>
                        </tr>
                        @php
                        $i++;
                        @endphp
                        @endforeach

                        @endif

                      </tbody>
                    </table>
                    @php
                    $tableQsEntryCount = count($dataset['examTeplateSubDate']);
                    @endphp
                    <input type="hidden" id="questionentrycount" value="{{$tableQsEntryCount}}" name="questionentrycount">
                    <div class="entrypositiondata">
                      @if(count($dataset['examTeplateSubDate']) > 0)

                      @php
                      $i=0;
                      @endphp
                      @foreach($dataset['examTeplateSubDate']->all() as $exampaperEntry)

                      
                      <input type="hidden" id="idposition{{$i}}" name="idposition{{$i}}" value="{{$i}}">


                      @php
                      $i++;
                      @endphp

                      @endforeach

                      @endif
                      
                    </div>
                    <div id="tabledataset">

                      @if(count($dataset['examTeplateSubDate']) > 0)

                      @php
                      $i=1;
                      @endphp
                      @foreach($dataset['examTeplateSubDate']->all() as $exampaperEntry)

                      <input type="hidden" id="category{{$i}}" value="{{$exampaperEntry->categoryid}}-{{$exampaperEntry->categoryname}}" name="category{{$i}}">
                      <input type="hidden" id="subcategory{{$i}}" value="{{$exampaperEntry->subcategoryid}}-{{$exampaperEntry->subcategoryname}}" name="subcategory{{$i}}">
                      <input type="hidden" id="level{{$i}}" value="{{$exampaperEntry->levelid}}-{{$exampaperEntry->levelname}}" name="level{{$i}}">
                      <input type="hidden" id="qstype{{$i}}" value="{{$exampaperEntry->qstype}}" name="qstype{{$i}}">
                      <input type="hidden" id="qscount{{$i}}" value="{{$exampaperEntry->qscount}}" name="qscount{{$i}}">



                      @php
                      $i++;
                      @endphp

                      @endforeach

                      @endif

                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="row">

                      <button type="submit" class="btn btn-block btn-success btn-sm col-sm-2 mr-2">Update</button>
                      <a href="{{url('/removetemplate/'.$dataset['examTemplateData'][0]->id)}}" class="btn btn-block btn-warning btn-sm col-sm-2 mr-2">Remove</a>
                      <a href="{{url('/examtemplates')}}" class="btn btn-block btn-danger btn-sm col-sm-2 mr-2">Cancel</a>

                    </div>

                  </div>
                  <!-- /.card-footer-->
                </div>
              </div>
            </div>
            <!-- /.row (main row) -->
          </div><!-- /.container-fluid -->
      </form>
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
  <!-- JQVMap -->

  <!-- jQuery Knob Chart -->
  <script src="{{URL::asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{URL::asset('plugins/moment/moment.min.js')}}"></script>
  <script src="{{URL::asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{URL::asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- InputMask -->
  <script src="{{URL::asset('plugins/moment/moment.min.js')}}"></script>
  <script src="{{URL::asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
  <!-- Summernote -->
  <script src="{{URL::asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{URL::asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- DataTables -->
  <script src="{{URL::asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{URL::asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{URL::asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{URL::asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{URL::asset('dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{URL::asset('dist/js/demo.js')}}"></script>
  <script type="text/javascript">
    function removeentry_action(entry) {
      var entryid = entry.id;
      var exactid = entryid.substring(18);
      var positionid = exactid;
      positionid--;

      var exactValue = $('#idposition'+positionid).val();
      $('#idposition'+positionid).val('D');

      var questionentrycount = $('#questionentrycount').val();
      var entrycount = $('#questionentrycount').val();
      var i=0;
      var mark=0;
      while(entrycount > i){

        var curValue = $('#idposition'+i).val();
        if(curValue != 'D'){
          $('#idposition'+i).val(mark);
            mark++;
        }
        i++;
      }
      var i = 0;
      var entryDataSet = new Array(questionentrycount, 6);
      var newrayy = Array.from(Array(6), () => new Array(0));
      var p = 1;
      console.info(newrayy);
      while (questionentrycount > i) {
        console.log('questionentrycount:' + questionentrycount);
        console.log('i:' + i);
        newrayy[i][0] = '' + p;
        newrayy[i][1] = $('#category' + p).val();
        newrayy[i][2] = $('#subcategory' + p).val();
        newrayy[i][3] = $('#level' + p).val();
        newrayy[i][4] = $('#qstype' + p).val();
        newrayy[i][5] = $('#qscount' + p).val();

        i++;
        p++;
      }

      $('#tabledataset').empty();

      var i2 = 0;
      var p2 = 1;
      console.log('thhis is positionid:' + positionid);

      while (questionentrycount > i2) {

        console.log('this is the value:' + newrayy[i2][4]);
        if (positionid != i2) {

          console.log('thhis is i2:' + i2);
          $('#tabledataset').append('<input type="hidden" id="category' + p2 + '" value="' + newrayy[i2][1] + '" name="category' + p2 + '">\
        <input type="hidden" id="subcategory' + p2 + '" value="' + newrayy[i2][2] + '" name="subcategory' + p2 + '">\
        <input type="hidden" id="level' + p2 + '" value="' + newrayy[i2][3] + '" name="level' + p2 + '">\
        <input type="hidden" id="qstype' + p2 + '" value="' + newrayy[i2][4] + '" name="qstype' + p2 + '">\
        <input type="hidden" id="qscount' + p2 + '" value="' + newrayy[i2][5] + '" name="qscount' + p2 + '">');

          p2++;
        }


        i2++;


      }

      var t = $('#questions-datatable').DataTable();

      t.row(':eq(' + positionid + ')')
        .remove()
        .draw();
      questionentrycount--;
      $('#questionentrycount').val(questionentrycount);

      console.log('this exactid:' + exactid);
      // console.log('thi is the array:' + entryDataSet[0]['entryid']);
      console.log('thi is the array2->:' + newrayy[0][0]);
    }


    window.onload = function() {


      $('.nav-link').removeClass('active');
      $('.nav-item').removeClass('menu-open');
      $('#examtempnav').addClass('active');


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




    }

    $('#addentry').click(function() {

      var allwedqscount = $('#noofquestions').val();
      var enteredqscount = $('#qscounter').val();

      var categoryval = $('#category').val();
      var splitcol = categoryval.split("-");
      var category = splitcol[1];
      var subcategoryval = $('#subcategory').val();
      var splitcol = subcategoryval.split("-");
      var subcategory = splitcol[1];
      var levelval = $('#level').val();
      var splitcol = levelval.split("-");
      var level = splitcol[1];
      var qstype = $('#qstype').val();
      var qscount = $('#qscount').val();

      var thisqscount = parseInt(enteredqscount) + parseInt(qscount);
      console.log('enteredqscount' + enteredqscount);
      console.log('qscount' + qscount);
      console.log('thisqscount' + thisqscount);
      console.log('allwedqscount' + allwedqscount);
      if (allwedqscount < thisqscount) {
        alert('Questions count exeeded! \nPlease enter a valid question count to add!');
      } else if (qscount == '' | isNaN(qscount)) {
        alert('Please enter a valid question count to add!');
      } else {
        $('#qscounter').val(thisqscount);
        var t = $('#questions-datatable').DataTable();
        t.row.add([
          category,
          subcategory,
          level,
          qstype,
          qscount
        ]).draw(false);

        var entryCount = $('#questionentrycount').val();
        entryCount++;
        $('#questionentrycount').val(entryCount);
        $('#tabledataset').append('<input type="hidden" id="category' + entryCount + '" value="' + categoryval + '" name="category' + entryCount + '">\
        <input type="hidden" id="subcategory' + entryCount + '" value="' + subcategoryval + '" name="subcategory' + entryCount + '">\
        <input type="hidden" id="level' + entryCount + '" value="' + levelval + '" name="level' + entryCount + '">\
        <input type="hidden" id="qstype' + entryCount + '" value="' + qstype + '" name="qstype' + entryCount + '">\
        <input type="hidden" id="qscount' + entryCount + '" value="' + qscount + '" name="qscount' + entryCount + '">');
        // $('#tbody').append('<tr>\
        // <td>'+category+'</td>\
        // <td>'+subcategory+'</td>\
        // <td>'+level+'</td>\
        // <td>'+qstype+'</td>\
        // <td>'+qscount+'</td>\
        // </tr>');
      }

    });


    $('#questions-datatable').DataTable({
      "pagingType": "full_numbers",
      "pageLength": 12,
      "searching": false,
      "lengthChange": false,
      "ordering": false
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