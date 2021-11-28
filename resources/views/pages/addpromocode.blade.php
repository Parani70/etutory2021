<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | Add Promo Code</title>
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
  <link rel="stylesheet" href="{{URL::asset('dist/css/bootstrap-datepicker.css')}}">
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
            <div class="col-md-8">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add new promo code</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{url('/savepromocode') }}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Promo Code</label>
                      <input type="text" class="form-control" name="promocode" value="{{old('promocode')}}" placeholder="Promo Code">
                      @error('promocode')

                      <div class="alert alert-danger" role="alert">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <input type="text" class="form-control" name="description" value="{{old('description')}}" placeholder="Description">
                      @error('description')

                      <div class="alert alert-danger" role="alert">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Maximum Allowed</label>
                          <input type="number" class="form-control " min="0" name="maxallowed" id="maxallowed" placeholder="Maximum Allowed">
                          @error('maxallowed')

<div class="alert alert-danger" role="alert">
  {{ $message }}
</div>
@enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> &nbsp</label>
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" name="maxunlimited"   type="checkbox" id="customCheckbox1" value="option1">
                            <label for="customCheckbox1" class="custom-control-label">Unlimited</label>
                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Start Date</label>
                          <input class="form-control datepicker" name="startdate" data-date-format="dd/mm/yyyy">
                          @error('startdate')

                          <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">End Date</label>
                          <input class="form-control datepicker" name="enddate" data-date-format="dd/mm/yyyy">
                          @error('enddate')

                          <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                      </div>
                    </div>



                    <div class="form-group">
                      <label for="exampleInputEmail1">Promo Type</label>
                      <select class="form-control select2 col-md-4" name="promotype" id="promotype" style="width: 100%;">
                        <option value="discount">Discount</option>
                        <option value="buyx">Buy X and get N free</option>

                      </select>
                    </div>
                    <div class="discount-container">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Discount %</label>
                        <select class="form-control select2 col-md-4" name="discount" style="width: 100%;">
                          <option value="10">10 %</option>
                          <option value="25">25 %</option>
                          <option value="40">40 %</option>
                          <option value="50">50 %</option>
                          <option value="60">60 %</option>
                          <option value="75">75 %</option>
                          <option value="80">80 %</option>
                          <option value="90">90 %</option>
                          <option value="100">100 %</option>

                        </select>
                      </div>
                    </div>
                    <div class="buyx-container" style="display: none;">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Buy Number</label>
                            <input type="number" class="form-control  " min="0" name="buynumber" placeholder="Buy Number">
                            @error('buynumber')

                            <div class="alert alert-danger" role="alert">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Buy Subject/Promotion</label>
                            <select class="form-control select2  " name="buyproduct" style="width: 100%;">
                              <option disabled>---------- SUBJECTS ----------</option>
                              @if(count($dataset['subjects']) > 0)

                              @foreach($dataset['subjects']->all() as $subject)
                              <option value="{{'S'.$subject->id.'-'.$subject->subject}}">{{$subject->subject}}</option>

                              @endforeach
                              @endif
                              <option disabled>---------- PROMOTIONS ----------</option>
                              @if(count($dataset['promotions']) > 0)

                              @foreach($dataset['promotions']->all() as $promotion)
                              <option value="{{'P'.$promotion->id.'-'.$promotion->promoname}}">{{$promotion->promoname}}</option>

                              @endforeach
                              @endif

                            </select>
                          </div>
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Get Number</label>
                            <input type="number" class="form-control" min="0" name="getnumber" placeholder="Get Number">
                            @error('getnumber')

                            <div class="alert alert-danger" role="alert">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Get Subject/Promotion</label>
                            <select class="form-control select2" name="getproduct" style="width: 100%;">
                              <option disabled>---------- SUBJECTS ----------</option>
                              @if(count($dataset['subjects']) > 0)

                              @foreach($dataset['subjects']->all() as $subject)
                              <option value="{{'S'.$subject->id.'-'.$subject->subject}}">{{$subject->subject}}</option>

                              @endforeach
                              @endif
                              <option disabled>---------- PROMOTIONS ----------</option>
                              @if(count($dataset['promotions']) > 0)

                              @foreach($dataset['promotions']->all() as $promotion)
                              <option value="{{'P'.$promotion->id.'-'.$promotion->promoname}}">{{$promotion->promoname}}</option>

                              @endforeach
                              @endif

                            </select>
                          </div>
                        </div>
                      </div>




                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Exam Type</label>
                          <select class="form-control select2 " name="examtype" style="width: 100%;">
                            <option value="none">NONE</option>
                            <option value="all">ALL</option>
                            @if(count($dataset['examtypes']) > 0)

                            @foreach($dataset['examtypes']->all() as $examtype)
                            <option value="{{$examtype->id.'-'.$examtype->examtype}}">{{$examtype->examtype}}</option>

                            @endforeach
                            @endif

                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Grade</label>
                          <select class="form-control select2" name="grade" style="width: 100%;">
                            <option value="none">NONE</option>
                            <option value="all">ALL</option>
                            @if(count($dataset['grades']) > 0)

                            @foreach($dataset['grades']->all() as $grade)
                            <option value="{{$grade->id.'-'.$grade->grade}}">{{$grade->grade}}</option>

                            @endforeach
                            @endif

                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Subject</label>
                          <select class="form-control select2 " name="subject" style="width: 100%;">
                            <option value="none">NONE</option>
                            <option value="all">ALL</option>
                            @if(count($dataset['subjects']) > 0)

                            @foreach($dataset['subjects']->all() as $subject)
                            <option value="{{$subject->id.'-'.$subject->subject}}">{{$subject->subject}}</option>

                            @endforeach
                            @endif

                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Promotion</label>
                          <select class="form-control select2 " name="promotion" style="width: 100%;">
                            <option value="none">NONE</option>
                            <option value="all">ALL</option>
                            @if(count($dataset['promotions']) > 0)

                            @foreach($dataset['promotions']->all() as $promotion)
                            <option value="{{$promotion->id.'-'.$promotion->promoname}}">{{$promotion->promoname}}</option>

                            @endforeach
                            @endif

                          </select>
                        </div>
                      </div>
                    </div>

                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{url('/promocodemanager')}}" class="btn btn-danger">Cancel</a>
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
  <!-- AdminLTE App -->
  <script src="{{URL::asset('dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{URL::asset('dist/js/demo.js')}}"></script>
  <script src="{{URL::asset('dist/js/bootstrap-datepicker.js')}}"></script>
  <script>
    $('.datepicker').datepicker({
      format: 'dd/mm/yyyy',
      startDate: '-3d',
      autoclose: true
    });

    $('#promotype').change(function() {
      var promoType = $('#promotype').val();
      if (promoType == 'buyx') {
        $('.buyx-container').show();
        $('.discount-container').hide();
      } else if (promoType == 'discount') {
        $('.buyx-container').hide();
        $('.discount-container').show();
      }
    });


    $('#customCheckbox1').change(function(){
      if($('#customCheckbox1').is(":checked")){
                 $('#maxallowed').val(0);
                 $("#maxallowed").attr('readonly','readonly');
            }else{
              $("#maxallowed").removeAttr('readonly','readonly');
            }
    });
  </script>
</body>

</html>