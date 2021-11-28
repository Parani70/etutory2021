<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | To Be Completed</title>
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
        <div class="container-fluid">
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
            <div class="col-md-12">
              <form role="form" action="{{url('/filtertobe') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="card collapsed-card">
                  <div class="card-header">
                    <h3 class="card-title">Filter</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-plus"></i></button>

                    </div>
                  </div>
                  <div class="card-body" style="display: none;">

                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Exam Type</label>
                          <select name="examtype" class="form-control select2" style="width: 100%;">
                            @if(count($dataset['examtypedata']) > 0)
                            <option value="All">All</option>
                            @foreach($dataset['examtypedata']->all() as $examtype)
                            <option value="{{$examtype->id.'-'.$examtype->examtype}}">{{$examtype->examtype}}</option>
                            @endforeach
                            @endif
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Grade</label>
                          <select name="grade"  id="grade" class="form-control select2" style="width: 100%;">
                            @if(count($dataset['gradedata']) > 0)
                            <option value="All">All</option>
                            @foreach($dataset['gradedata']->all() as $grade)
                            <option value="{{$grade->id.'-'.$grade->grade}}">{{$grade->grade}}</option>
                            @endforeach
                            @endif
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Subject</label>
                          <select name="subject" id="subject" class="form-control select2" style="width: 100%;">
                            @if(count($dataset['subjectdata']) > 0)
                            <option value="All">All</option>
                            @foreach($dataset['subjectdata']->all() as $subject)
                            <option value="{{$subject->id.'-'.$subject->subject}}">{{$subject->subject}}</option>
                            @endforeach
                            @endif
                          </select>
                        </div>
                      </div>
                      
                    </div>
                    <!-- /.row -->
                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                          <label>Category</label>
                          <select name="category" id="category" class="form-control select2" style="width: 100%;">
                            @if(count($dataset['categorydata']) > 0)
                            <option value="All">All</option>
                            @foreach($dataset['categorydata']->all() as $category)
                            <option value="{{$category->id.'-'.$category->category}}">{{$category->category}}</option>
                            @endforeach
                            @endif
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Sub Category</label>
                          <select name="subcategory" id="subcategory" class="form-control select2" style="width: 100%;">
                            @if(count($dataset['subcategorydata']) > 0)
                            <option value="All">All</option>
                            @foreach($dataset['subcategorydata']->all() as $subcategory)
                            <option value="{{$subcategory->id.'-'.$subcategory->subcategory}}">{{$subcategory->subcategory}}</option>
                            @endforeach
                            @endif
                          </select>
                        </div>
                      </div>
                      
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Level</label>
                          <select name="level" class="form-control select2" style="width: 100%;">
                            @if(count($dataset['leveldata']) > 0)
                            <option value="All">All</option>
                            @foreach($dataset['leveldata']->all() as $level)
                            <option value="{{$level->id.'-'.$level->level}}">{{$level->level}}</option>
                            @endforeach
                            @endif
                          </select>
                        </div>
                      </div>
                    </div>
                    <!-- /.row -->

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer" style="display: none;">
                    <div class="row">

                      <div class="col-md-1">
                        <button type="submit" class="btn btn-block btn-info btn-sm col-sm-12">Filter</button>
                      </div>
                      <div class="col-md-1">
                        <button type="submit" name="reset" value="reset" class="btn btn-block btn-warning btn-sm col-sm-12">Reset</button>
                      </div>

                    </div>
                  </div>
                  <!-- /.card-footer-->
                </div>
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <h5>To Be Complated Questions</h5>
                  <table id="questions-datatable" class="table">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Exam Type</th>
                        <th>Grade</th>
                        <th>Subject</th>
                        <th>Level</th>
                        <th>Question Type</th>
                        <th>Question</th>
                        <th style="width: 10%"></th>
                      </tr>
                    </thead>
                    <tbody>

                      @if(count($dataset['questiondata'] )> 0)
                      @php
                      $i=1;
                      @endphp
                      @foreach($dataset['questiondata']->all() as $question)

                      <tr class='clickable-row' data-href="{{url('/reviewquestion/3-'.$question->id)}}">
                        <td>{{$i}}</td>
                        <td>{{$question->examtypename}}</td>
                        <td>{{$question->gradename}}</td>
                        <td>{{$question->subjectname}}</td>
                        <td>{{$question->levelname}}</td>
                        <td>{{$question->qstype}}</td>
                        <td style="width: 50%; overflow: hidden; text-overflow: ellipsis;">{!!$question->questionheader!!}</td>
                        @php
                        $qstype = '1';

                        @endphp
                        <td><a href="{{url('/editquestion/'.$qstype.'-'.$question->id)}}" class="btn btn-block btn-secondary btn-sm">Edit</a></td>
                      </tr>

                      @php
                      $i++;
                      @endphp
                      @endforeach

                      @endif




                    </tbody>
                  </table>
                </div>
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
  <!-- JQVMap -->

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
      $('#savednav').addClass('active');
      $('#queusmain').addClass('active');
      $('#queumain').addClass('menu-open');

      var responseMessege = "{{@session('response')}}";
      var edit_responseMessege = "{{@session('edit_response')}}";
      var delete_responseMessege = "{{@session('delete_response')}}";

      if (responseMessege != '') {
        $(document).Toasts('create', {
          class: 'bg-info',
          autohide: true,
          delay: 2500,
          title: 'Successful!',

          body: 'New Grade : <b>' + responseMessege + '</b> saved successfully.'
        })
      }

      if (edit_responseMessege != '') {
        $(document).Toasts('create', {
          class: 'bg-info',
          autohide: true,
          delay: 2500,
          title: 'Updated Successful!',

          body: 'The Grade : <b>' + edit_responseMessege + '</b> updated successfully.'
        })
      }

      if (delete_responseMessege != '') {
        $(document).Toasts('create', {
          class: 'bg-warning',
          autohide: true,
          delay: 2500,
          title: 'Deletion Successful!',

          body: 'Grade with ID: <b>' + delete_responseMessege + '</b> removed successfully.'
        })
      }


    }
    $('.clickable-row').css('cursor', 'pointer');

    $('.clickable-row').click(function() {
      window.location = $(this).data("href");
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

    $('#subject').change(function(){
      var subjectValue = $('#subject').val();
      var gradeValue = $('#grade').val();
    
      if(subjectValue != 'All' && gradeValue != 'All'){

        var subjectlist = subjectValue.split("-");
        var subjectID = subjectlist[0];
        var subjectName = subjectlist[1];

        var gradelist = gradeValue.split("-");
        var gradeID = gradelist[0];
        var gradeName = gradelist[1];

        $('#category').empty();
      $('#subcategory').empty();
      $('#category').append(' <option value="All">All</option>');
      $('#subcategory').append(' <option value="All">All</option>');

        $.get('/getcategoryset/' + gradeID + '^' + subjectID, function(response) {
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

      }

    });


  </script>
</body>

</html>