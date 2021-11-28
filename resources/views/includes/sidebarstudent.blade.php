<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-warning elevation-4">
  <!-- Brand Logo -->
  <a href="{{url('/')}}" class="brand-link navbar-warning">
    <img style="height:30px; margin-left:auto;margin-right: auto; display: block;" src="{{URL::asset('dist/img/logo.png')}}" alt="">
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{URL::asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{url('/userprofile/'.Auth::user()->id)}}" class="d-block">{{Auth::user()->name}}</a>
      </div>
    </div>
    <div class="mt-3">
      <p class="text-muted text-left">Role : <b>{{Auth::user()->role}}</b></p>

    </div>
    <div class="mt-3">

      <div class="btn-group">
        <p class="text-muted text-left">Language : </p>
        <p class="text-muted text-left">
          @if(Auth::user()->language1 == 'Tamil')
          தமிழ்
          @elseif(Auth::user()->language1 == 'Sinhala')
          සිංහල
          @else
          English
          @endif
        </p>
        <!--<button type="button" id="btnarow" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
          <span class="sr-only">Toggle Dropdown</span>
          <div class="dropdown-menu" role="menu">
            <a class="dropdown-item" href="#">English</a>
            <a class="dropdown-item" href="#">සිංහල</a>
            <a class="dropdown-item" href="#">தமிழ்</a>
            
          </div>
        </button>-->
      </div>

    </div>
    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
      <div class="btn btn-block btn-outline-danger btn-xs" id="btn-logout">Logout </div>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>

    <hr>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{url('/elearninghome')}}" id="learningcentrenav" class="nav-link">
            <i class="nav-icon fas fa-desktop  "></i>
            <p>E Learning Centre</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{url('/examhome')}}" id="examxcetrenav" class="nav-link">
            <i class="nav-icon fas fa-th-large"></i>
            <p>Exam Centre</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{url('/studenthistory')}}" id="examxcetrenav" class="nav-link">
            <i class="nav-icon fas fa-clock"></i>
            <p>History </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>