<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | E Learnig Centre | Promotion</title>
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
    @include('includes.sidebarstudent')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">E Learning Centre</h1>
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
            <div class="col-md-12">
              @if($dataset['promotype'] == 'single')
              <div class="card">
                <div class="card-body">

                  <p class="text-info">You have selected Promotion package "{{$dataset['promodata'][0]->promoname}}" </p>
                  <p class="text-danger">You will be able to take {{$dataset['promodata'][0]->paperscount}} exams on the selected subject with 30 days of time.</p>
                  <p>Please select your subjects</p>
                  <form role="form" action="{{url('/proceedpromopurchase') }}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <input type="hidden" value="{{$dataset['promodata'][0]->id}}" id="promoid" name="promoid">
                    @if(count($dataset['subjectdata'])>0)
                    <input type="hidden" value="{{count($dataset['subjectdata'])}}" id="subjectentriescount" name="subjectentriescount">
                    @php
                    $i=1;
                    @endphp
                    @foreach($dataset['subjectdata']->all() as $subject)

                    <div class="row">
                      <div class="col-md-4">
                        <p><b>{{$subject->subject}}</b></p>
                      </div>

                      <div class="col-md-2">
                        <input class="subjectcheckbox" onclick="subjectchcker(this)" type="checkbox" id="subject{{$i}}" name="subject{{$i}}" value="{{$subject->id}}">

                      </div>
                    </div>
                    @php
                    $i++;
                    @endphp
                    @endforeach

                    @endif
                    @error('examsubject')

                    <div class="alert alert-danger" role="alert">
                      {{ $message }}
                    </div>
                    @enderror
                    <button type="submit" class="btn btn-block btn-info col-sm-3">Proceed to Pay</a>

                  </form>
                </div>
              </div>
              @elseif($dataset['promotype'] == 'multiple')
              <div class="card">
                <div class="card-body">

                  <p class="text-info">You have selected Promotion package "{{$dataset['promodata'][0]->promoname}}"  </p>
                  <p class="text-danger">You can site for a total of {{$dataset['promodata'][0]->examcount}} exams of any subjects selected. The validity of the exams in 30 days. You can sit for a maximum of {{$dataset['promodata'][0]->maxpaperforexam}} papers for a subject</p>
                  <p>Please select the Please select the subjects and number of papers</p>
                  <form role="form" action="{{url('/proceedpromopurchase') }}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <input type="hidden" value="{{$dataset['promodata'][0]->examcount}}" id="totalExamCount" name="totalExamCount">
                  <input type="hidden" value="0" id="selectedExamCount" name="selectedExamCount">
                  <input type="hidden" value="multiple" id="promotype" name="promotype">
                  <input type="hidden" value="{{count($dataset['subjectdata'])}}" id="subjectcount" name="subjectcount">
                  <input type="hidden" value="{{$dataset['promodata'][0]->id}}" id="promoid" name="promoid">
              
             
                  @if(count($dataset['subjectdata'])>0)
                  @php 
                    $s=1;
                  @endphp
                  <div class="row">
                    <div class="col-md-4">
                      <h5>Subject</h5>
                    </div>
                    <div class="col-md-4">
                      <h5>Number of Papers</h5>
                    </div>
                  </div>
                  @foreach($dataset['subjectdata']->all() as $subject)

                  <div class="row">
                    <div class="col-md-4">
                      <p><b>{{ $subject->subject}}</b></p>
                    </div>

                    <div class="col-md-2">
                      <select class="form-control select2" id="countentry{{ $s}}" onclick="validateExamCount(this)" name="countentry{{ $s}}"   style="width: 100%;">
                        @php
                        
                        $entrycount = $dataset['promodata'][0]->maxpaperforexam;
                        $p=0;
                        @endphp

                        @while($entrycount >= $p)
                        <option value="{{$p}}-{{$subject->id}}">{{$p}}</option>

                        @php
                        $p ++;
                        @endphp

                        @endwhile
                       
                      </select>
                    </div>
                  </div>
                  @php 
                    $s++;
                  @endphp
                  @endforeach

                  @endif
                  <button type="submit" class="btn btn-block btn-info col-sm-3">Proceed to Pay</button>
                  </form>
                </div>
              </div>
              @endif

            </div>

          </div>
          <!-- /.row -->


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
  <!-- AdminLTE App -->
  <script src="{{URL::asset('dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{URL::asset('dist/js/demo.js')}}"></script>
  <script type="text/javascript">
    window.onload = function() {
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

    function subjectchcker(subjectentry) {

      var subjectid = subjectentry.id;

      var i = 1;
      var remember = document.getElementById(subjectid);
      if (remember.checked) {
        $(".subjectcheckbox").prop("checked", false);
        $("#" + subjectid).prop("checked", true);
      }


    }

    function validateExamCount(subjectEntry){

      var changesEntryID = subjectEntry.id;
      var totalExamCount = $('#totalExamCount').val();
      var subjectcount = $('#subjectcount').val();
      var p=1;
      var selectedEntryCount =0;
      while(subjectcount >= p){
        var thisEntryVal = $('#countentry'+p).val();
        selectedEntryCount += parseInt(thisEntryVal) ;
        p++;
      }
     
      $('#selectedExamCount').val(selectedEntryCount);

      if(selectedEntryCount > totalExamCount){

        $(document).Toasts('create', {
          class: 'bg-warning',
          autohide: true,
          delay: 2500,
          title: 'Exceeeded Exam Count!',

          body: 'Exceeeded Exam Count!'
        })

        $('#'+changesEntryID).val(0);

      }

     

    }
  </script>
</body>

</html>