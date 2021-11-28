<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | Correction Guidline Canvas</title>
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
  <style>
    .paint-canvas {
      border: 1px black solid;
      display: block;
      margin: 1rem;
    }

    .color-picker {
      margin: 1rem 1rem 0 1rem;
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
          <input type="color" class="js-color-picker  color-picker">
          <input type="range" class="js-line-range" min="1" max="72" value="1">
          <label class="js-range-value">1</label>Px
          <button type="button" class="btn btn-primary" id="save">Save Page</button>
          <button type="button" class="btn btn-primary" id="done">Done</button>
          <input type="hidden" id="essayentryidval" value="{{ $guidlineid }}" name="essayentryidval">
          <input type="hidden" id="slidercount" value="1" name="slidercount">

          <canvas class="js-paint  paint-canvas" id="paint-canvas" width="1000" height="700"></canvas>

          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
        <div class="container-fluid">
          <div class="row imagegallary">

          </div>
        </div>
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
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script>

    $('#done').click(function(){
      var entriescount = $('#slidercount').val();
      entriescount--;
      var tokenid = $('#essayentryidval').val();

      $.ajax({
        type: "POST",
        header: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/doneguidlinecanvas",
        data: {
          _token: "{{ csrf_token() }}",
          slidercountval: entriescount,
          tokenid: tokenid,
        
        }
      }).done(function(o) {
        console.log('saved');
        window.top.close();

      });


    });
    $('#save').click(function() {
      console.log('dklklk');
      varkname = 'penentry';
      var slidercount = $('#slidercount').val();
      var entrytocken = $('#essayentryidval').val();
      var match = document.cookie;
      console.log(match);

      var canvas = document.getElementById('paint-canvas');
      var dataURL = canvas.toDataURL('img.png');
      // console.log(dataURL);
      $.ajax({
        type: "POST",
        header: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/saveguidlinecanvas",
        data: {
          _token: "{{ csrf_token() }}",
          slidercountval: slidercount,
          entryvalue: entrytocken,
          imgBase64: dataURL,

        }
      }).done(function(o) {
        console.log('saved');
        // If you want the file to be visible in the browser 
        // - please modify the callback in javascript. All you
        // need is to return the url to the file, you just saved 
        // and than put the image in your browser.
        var c = document.getElementById("paint-canvas");
        var ctx = c.getContext("2d");

        ctx.clearRect(0, 0, 1000, 700);
        var sliderpreentry = slidercount;
        slidercount++;
        $('#slidercount').val(slidercount);
        var tokenid = $('#essayentryidval').val();
        if (slidercount > 1) {
          
          var url = "{{ url('useruploaded/guidline_images') }}";
          $('.imagegallary').append('<div class="col-md-3" style="border:darkblue solid 1px;">\
<img src="' + url +'/'+ tokenid+'_I'+sliderpreentry+'.jpg" width="100%" />\
</div>');
        }

      });
    });
    const paintCanvas = document.querySelector('.js-paint');
    const context = paintCanvas.getContext('2d');
    context.lineCap = 'round';

    const colorPicker = document.querySelector('.js-color-picker');

    colorPicker.addEventListener('change', event => {
      context.strokeStyle = event.target.value;
    });

    const lineWidthRange = document.querySelector('.js-line-range');
    const lineWidthLabel = document.querySelector('.js-range-value');

    lineWidthRange.addEventListener('input', event => {
      const width = event.target.value;
      lineWidthLabel.innerHTML = width;
      context.lineWidth = width;
    });

    let x = 0,
      y = 0;
    let isMouseDown = false;

    const stopDrawing = () => {
      isMouseDown = false;
    }
    const startDrawing = event => {
      isMouseDown = true;
      [x, y] = [event.offsetX, event.offsetY];
    }
    const drawLine = event => {
      if (isMouseDown) {
        const newX = event.offsetX;
        const newY = event.offsetY;
        context.beginPath();
        context.moveTo(x, y);
        context.lineTo(newX, newY);
        context.stroke();
        //[x, y] = [newX, newY];
        x = newX;
        y = newY;
      }
    }

    paintCanvas.addEventListener('mousedown', startDrawing);
    paintCanvas.addEventListener('mousemove', drawLine);
    paintCanvas.addEventListener('mouseup', stopDrawing);
    paintCanvas.addEventListener('mouseout', stopDrawing);
  </script>
</body>

</html>