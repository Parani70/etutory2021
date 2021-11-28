<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | New Exam Templates</title>
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
      <form role="form" action="{{url('/savepapertemplate') }}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-md-12">

                <div class="card card-default">
                  <div class="card-header">
                    <h3 class="card-title">New Exam Template</h3>

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
                          <input type="text" class="form-control float-right" name="coursename">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Exam Type</label>
                          <select name="examtype" id="examtype" class="form-control select2" style="width: 100%;">
                            <option value="-- Choose User Option --">-- Choose Exam Type --</option>
                            @if(count($dataset['examtypedata']) > 0)
                            @foreach($dataset['examtypedata']->all() as $examtype)
                            <option value="{{$examtype->id.'-'.$examtype->examtype}}">{{$examtype->examtype}}</option>
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
                            <option value="{{$subject->id.'-'.$subject->subject}}">{{$subject->subject}}</option>
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
                            <option value="{{$grade->id.'-'.$grade->grade}}">{{$grade->grade}}</option>
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
                          <input type="text" class="form-control float-right" name="noofquestions" id="noofquestions">

                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label>Duration</label>

                          <input type="text" class="form-control float-right" name="durationhr" placeholder="HH">



                        </div>

                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label>&nbsp;</label>
                          <input type="text" class="form-control float-right" name="durationmin" placeholder="mm">


                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Language</label>

                          <select name="language" class="form-control select2" style="width: 100%;">
                            <option value="-- Choose User Option --">-- Choose Language --</option>
                            <option value="English">English</option>
                            <option value="Sinhala">Sinhala</option>
                            <option value="Tamil">Tamil</option>

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
                    <input type="hidden" id="qscounter" value="0" name="qscounter">

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
                      <tbody id="tbody entrybody">


                      </tbody>
                    </table>
                    <div id="tabledataset">
                      <input type="hidden" id="questionentrycount" value="0" name="questionentrycount">
                    </div>
                    <div class="entrypositiondata">
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-block btn-success btn-sm col-sm-1">Save</button>
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
        var entryCount = $('#questionentrycount').val();
        var rowentry = entryCount;
        entryCount++;
        $('#questionentrycount').val(entryCount);

        $('.entrypositiondata').append(' <input type="hidden" id="idposition' + rowentry + '" name="idposition' + rowentry + '" value="' + rowentry + '">');

        t.row.add([
          entryCount,
          category,
          subcategory,
          level,
          qstype,
          qscount,
          '<button type="button" id="removeentry_action' + rowentry + '" onclick="removeentry_action(this)"  class="btn btn-block btn-danger btn-xs"><i class="fas fa-times-circle"></i>Remove</button>',
        ]).draw(false);


        //onclick="removeentry_action(this)" 

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

    function removeentry_action(entryid) {
      var entryidval = entryid.id;
      var entryidvalString = entryidval + '  ';
      console.log('this is value:' + entryidval);
      console.log('this is value String:' + entryidvalString);
      butonElementName = entryidval.name
      console.log('this is button element:' + butonElementName);
      entryrow = entryidvalString.toString().substring(18);
      console.log('this his substring:' + entryrow);
      
      var exactValue = $('#idposition'+entryrow).val();

      $('#idposition'+entryrow).val('D');

      console.log('this is exact Value:'+exactValue);
      var t = $('#questions-datatable').DataTable();

        t.row(':eq('+exactValue+')')
        .remove()
        .draw();

         

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
      
    }
  </script>
</body>

</html>