<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | Manage Promo Code</title>
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
                  <h3 class="card-title">Manage promo code</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{url('/updatepromocode') }}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="card-body">
                  <input type="hidden" id="promocodeentryid" value="{{$dataset['promocodedata'][0]->id}}" name="promocodeentryid">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Promo Code</label>
                      <input type="text" class="form-control" name="promocode" value="{{$dataset['promocodedata'][0]->promocode}}" placeholder="Promo Code">
                      @error('promocode')

                      <div class="alert alert-danger" role="alert">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <input type="text" class="form-control" name="description" value="{{$dataset['promocodedata'][0]->description}}" placeholder="Description">
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
                          @if($dataset['promocodedata'][0]->maxunlimited == 'Y')
                          <input type="number" class="form-control " min="0" name="maxallowed" id="maxallowed" value="0" readonly placeholder="Maximum Allowed">
                            @else
                            <input type="number" class="form-control " min="0" name="maxallowed" id="maxallowed" value="{{$dataset['promocodedata'][0]->maxallowed}}" placeholder="Maximum Allowed">
                            @endif
                        
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
                            @if($dataset['promocodedata'][0]->maxunlimited == 'Y')
                            <input class="custom-control-input" name="maxunlimited" checked type="checkbox" id="customCheckbox1" value="option1">
                            @else
                            <input class="custom-control-input" name="maxunlimited" type="checkbox" id="customCheckbox1" value="option1">
                            @endif

                            <label for="customCheckbox1" class="custom-control-label">Unlimited</label>
                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Start Date</label>
                          @php
                          $dbFromDate = $dataset['promocodedata'][0]->startdate;
                          $dbFormatExploded = explode('-',$dbFromDate);
                          $fromDate = $dbFormatExploded[2].'/'.$dbFormatExploded[1].'/'.$dbFormatExploded[0];
                          @endphp
                          <input class="form-control datepicker" value="{{$fromDate}}" name="startdate" data-date-format="dd/mm/yyyy">

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
                          @php
                          $dbEndDate = $dataset['promocodedata'][0]->enddate;
                          $dbFormatExploded = explode('-',$dbEndDate);
                          $endDate = $dbFormatExploded[2].'/'.$dbFormatExploded[1].'/'.$dbFormatExploded[0];
                          @endphp
                          <input class="form-control datepicker" value="{{$endDate}}" name="enddate" data-date-format="dd/mm/yyyy">
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
                        @if($dataset['promocodedata'][0]->promotype == 'buyx')
                        <option value="discount">Discount</option>
                        <option selected value="buyx">Buy X and get N free</option>
                        @else
                        <option selected value="discount">Discount</option>
                        <option value="buyx">Buy X and get N free</option>
                        @endif


                      </select>
                    </div>
                    @if($dataset['promocodedata'][0]->promotype == 'buyx')
                    <div class="discount-container" style="display: none;">
                      @else
                      <div class="discount-container">
                        @endif

                        <div class="form-group">
                          <label for="exampleInputEmail1">Discount %</label>
                          <select class="form-control select2 col-md-4" name="discount" style="width: 100%;">
                            @php
                              $discountlist = [10,25,40,50,60,75,80,90,100];
                            @endphp

                            @foreach($discountlist as $discount)

                            @if($dataset['promocodedata'][0]->discount == $discount)
                            <option selected value="{{$discount}}">{{$discount}} %</option>
                            @else
                            <option value="{{$discount}}">{{$discount}} %</option>
                            @endif
            
                            @endforeach
                          

                          </select>
                        </div>
                      </div>
                      @if($dataset['promocodedata'][0]->promotype == 'buyx')
                      <div class="buyx-container">
                        @else
                        <div class="buyx-container" style="display: none;">
                          @endif

                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Buy Number</label>
                                <input type="number" class="form-control" value="{{$dataset['promocodedata'][0]->buynumber}}" min="0" name="buynumber" placeholder="Buy Number">
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

                                  @if($dataset['promocodedata'][0]->buyproducttype == 'S' & $dataset['promocodedata'][0]->buyproduct == $subject->id)
                                  <option selected value="{{'S'.$subject->id.'-'.$subject->subject}}">{{$subject->subject}}</option>
                                  @else
                                  <option value="{{'S'.$subject->id.'-'.$subject->subject}}">{{$subject->subject}}</option>
                                  @endif


                                  @endforeach
                                  @endif
                                  <option disabled>---------- PROMOTIONS ----------</option>
                                  @if(count($dataset['promotions']) > 0)

                                  @foreach($dataset['promotions']->all() as $promotion)

                                  @if($dataset['promocodedata'][0]->buyproducttype == 'P' & $dataset['promocodedata'][0]->buyproduct == $promotion->id)
                                  <option selected value="{{'P'.$promotion->id.'-'.$promotion->promoname}}">{{$promotion->promoname}}</option>
                                  @else
                                  <option value="{{'P'.$promotion->id.'-'.$promotion->promoname}}">{{$promotion->promoname}}</option>
                                  @endif


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
                                <input type="number" class="form-control" min="0" name="getnumber" value="{{$dataset['promocodedata'][0]->getnumber}}" placeholder="Get Number">
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
                                  @if($dataset['promocodedata'][0]->getproductype == 'S' & $dataset['promocodedata'][0]->getproduct == $subject->id)
                                  <option selected value="{{'S'.$subject->id.'-'.$subject->subject}}">{{$subject->subject}}</option>
                                  @else
                                  <option value="{{'S'.$subject->id.'-'.$subject->subject}}">{{$subject->subject}}</option>
                                  @endif


                                  @endforeach
                                  @endif
                                  <option disabled>---------- PROMOTIONS ----------</option>
                                  @if(count($dataset['promotions']) > 0)

                                  @foreach($dataset['promotions']->all() as $promotion)
                                  @if($dataset['promocodedata'][0]->getproductype == 'P' & $dataset['promocodedata'][0]->getproduct == $promotion->id)
                                  <option selected value="{{'P'.$promotion->id.'-'.$promotion->promoname}}">{{$promotion->promoname}}</option>
                                  @else
                                  <option value="{{'P'.$promotion->id.'-'.$promotion->promoname}}">{{$promotion->promoname}}</option>
                                  @endif


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
                                @if($dataset['promocodedata'][0]->examtype == 'none')
                                <option selected value="none">NONE</option>
                                @else
                                <option value="none">NONE</option>
                                @endif

                                @if($dataset['promocodedata'][0]->examtype == 'all')
                                <option selected value="all">ALL</option>
                                @else
                                <option value="all">ALL</option>
                                @endif


                                @if(count($dataset['examtypes']) > 0)

                                @foreach($dataset['examtypes']->all() as $examtype)
                                @if($dataset['promocodedata'][0]->examtypeid == $examtype->id )
                                <option selected value="{{$examtype->id.'-'.$examtype->examtype}}">{{$examtype->examtype}}</option>
                                @else
                                <option value="{{$examtype->id.'-'.$examtype->examtype}}">{{$examtype->examtype}}</option>
                                @endif


                                @endforeach
                                @endif

                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Grade</label>
                              <select class="form-control select2" name="grade" style="width: 100%;">
                                @if($dataset['promocodedata'][0]->grade == 'none')
                                <option selected value="none">NONE</option>
                                @else
                                <option value="none">NONE</option>
                                @endif

                                @if($dataset['promocodedata'][0]->grade == 'all')
                                <option selected value="all">ALL</option>
                                @else
                                <option value="all">ALL</option>
                                @endif
                                @if(count($dataset['grades']) > 0)

                                @foreach($dataset['grades']->all() as $grade)
                                @if($dataset['promocodedata'][0]->gradeid == $grade->id )
                                <option selected value="{{$grade->id.'-'.$grade->grade}}">{{$grade->grade}}</option>
                                @else
                                <option value="{{$grade->id.'-'.$grade->grade}}">{{$grade->grade}}</option>
                                @endif

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
                                @if($dataset['promocodedata'][0]->subject == 'none')
                                <option selected value="none">NONE</option>
                                @else
                                <option value="none">NONE</option>
                                @endif

                                @if($dataset['promocodedata'][0]->subject == 'all')
                                <option selected value="all">ALL</option>
                                @else
                                <option value="all">ALL</option>
                                @endif
                                @if(count($dataset['subjects']) > 0)

                                @foreach($dataset['subjects']->all() as $subject)

                                @if($dataset['promocodedata'][0]->subjectid == $subject->id )
                                <option selected value="{{$subject->id.'-'.$subject->subject}}">{{$subject->subject}}</option>
                                @else
                                <option value="{{$subject->id.'-'.$subject->subject}}">{{$subject->subject}}</option>
                                @endif


                                @endforeach
                                @endif

                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Promotion</label>
                              <select class="form-control select2 " name="promotion" style="width: 100%;">
                                @if($dataset['promocodedata'][0]->promotion == 'none')
                                <option selected value="none">NONE</option>
                                @else
                                <option value="none">NONE</option>
                                @endif

                                @if($dataset['promocodedata'][0]->promotion == 'all')
                                <option selected value="all">ALL</option>
                                @else
                                <option value="all">ALL</option>
                                @endif
                                @if(count($dataset['promotions']) > 0)

                                @foreach($dataset['promotions']->all() as $promotion)

                                @if($dataset['promocodedata'][0]->promotionid == $promotion->id )
                                <option selected value="{{$promotion->id.'-'.$promotion->promoname}}">{{$promotion->promoname}}</option>
                                @else
                                <option value="{{$promotion->id.'-'.$promotion->promoname}}">{{$promotion->promoname}}</option>
                                @endif

                                @endforeach
                                @endif

                              </select>
                            </div>
                          </div>
                        </div>

                      </div>
                      <!-- /.card-body -->

                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
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