<!-- Main Sidebar Container -->

<style>
  #btnarow {
    margin-left: 20px;
    background-color: #001f3f;
    color: white;
    border-radius: 100%;
    padding: 5px;
    width: 30px;
    height: 30px;
  }
</style>
<aside class="main-sidebar sidebar-light-warning elevation-4">
  <!-- Brand Logo -->
  <a href="{{url('/')}}" class="brand-link navbar-warning">
    <img style="height:30px; margin-left:auto;margin-right: auto; display: block;" src="{{URL::asset('dist/img/logo.png')}}" alt="">
  </a>
  @php
  $userroledata = DB::table('userroles')->where('userrole', '=', Auth::user()->role)->get();
  $privilagedata = DB::table('roleprivileges')->where('roleid', '=', $userroledata[0]->id)->get();
  $priviledgesArray = array();


  @endphp

  @foreach($privilagedata as $prv)
  @php
  array_push($priviledgesArray,$prv->privilegename)
  @endphp
  <!-- <p>{{$prv->privilegename}}</p> -->
  @endforeach
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="border-bottom: none;">
      <!-- <div class="image">
        <img src="{{URL::asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div> -->
      <div class="info2">
        <a href="{{url('/userprofileadmin/'.Auth::user()->id)}}" class="d-block">User : <b>{{Auth::user()->name}}</b></a>
      </div>
    </div>
    <div class="mt-1">
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
                                                     document.getElementById('logout-form').submit();"><div class="btn btn-block btn-outline-danger btn-xs" id="btn-logout">Logout   </div></a>
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
          <a href="{{url('/dashboard')}}" id="dashboardnav" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        @if(in_array('Search question', (array) $priviledgesArray))

        <li class="nav-item">
          <a href="{{url('/searchquestion')}}" id="searchnav" class="nav-link">
            <i class="nav-icon fas fa-search"></i>
            <p>Search</p>
          </a>
        </li>

        @endif

        @php
        $user = Auth::user();
        @endphp
        <li class="nav-item has-treeview" id="queumain">
          <a href="#" id="queusmain" class="nav-link">
            <i class="nav-icon fas fa-list-ul"></i>
            <p>
              Queues
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if(Auth::check())
            @if(true)


            <li class="nav-item">
              <a href="{{url('/forapprovequestionsqueu')}}" id="forapprovenav" class="nav-link">
                <i class="far fa-thumbs-up nav-icon"></i>
                <p>For Approval</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/onholdquestionsqueu')}}" id="onholdnav" class="nav-link">
                <i class="far fa-bookmark  nav-icon"></i>
                <p>On Hold</p>
              </a>
            </li>
            @endif
            @endif
            @if(in_array('Question Entry', (array) $priviledgesArray))
            <li class="nav-item">
              <a href="{{url('/savedquestionsqueu')}}" id="savednav" class="nav-link">
                <i class="far fa-calendar-alt nav-icon"></i>
                <p>To be Completed</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/rejectedquestionsqueu')}}" id="rejectednav" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Rejected</p>
              </a>
            </li>
            @endif
          </ul>
        </li>
        @if(in_array('Question Entry', (array) $priviledgesArray))


        <li class="nav-item has-treeview" id="qsmain">
          <a href="#" class="nav-link" id="mcqnavmain">
            <i class="nav-icon fas fa-book-open"></i>
            <p>
              Enter Question
              <i class="fas fa-angle-left right"></i>

            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('/entermcqquestion')}}" id="mcqnav" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>MCQ</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/entertruefalsequestion')}}" id="truefalse" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>True/False</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/entermatchingquestion')}}" id="matchingnav" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Match</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/enterfillblanksquestion')}}" id="fillinnav" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Fill in the Blanks</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/entershortquestion')}}" id="shortnav" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Short Answer</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/enteressayquestion')}}" id="essaynav" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Essay</p>
              </a>
            </li>

          </ul>
        </li>

        @endif

    
      
        @if(in_array('Paper Correction', (array) $priviledgesArray))
        <li class="nav-item">
          <a href="{{url('/papercorrection')}}" id="papercorrectionlink" class="nav-link">
            <i class="nav-icon fas fa-certificate"></i>
            <p>Paper Correction</p>
          </a>
        </li>
        @endif
        @if(in_array('Template Management', (array) $priviledgesArray))
        <li class="nav-item">
          <a href="{{url('/examtemplates')}}" id="examtempnav" class="nav-link">
            <i class="nav-icon fas fa-th-list"></i>
            <p>Exam Template</p>
          </a>
        </li>
        @endif

        @if(true)
        <li class="nav-item has-treeview" id="mastermain">
          <a href="#" class="nav-link" id="masternavmain">
            <i class="nav-icon fas fa-database"></i>
            <p>
              Master Data
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if(in_array('Exam Type Management', (array) $priviledgesArray))
            <li class="nav-item">
              <a href="{{url('/examtypes')}}" id="examtypenav" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Exams Types</p>
              </a>
            </li>

            @endif
            <!--<li class="nav-item">
              <a href="{{url('/courses')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Courses</p>
              </a>
            </li>-->
            @if(in_array('Subject Management', (array) $priviledgesArray))
            <li class="nav-item">
              <a href="{{url('/subjects')}}" id="subjectsnav" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Subjects</p>
              </a>
            </li>
            @endif
            @if(in_array('Category Management', (array) $priviledgesArray))
            <li class="nav-item">
              <a href="{{url('/categories')}}" id="categorynav" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Categories</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/subcategories')}}" id="subcategorynav" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sub Categories</p>
              </a>
            </li>
            @endif
            @if(in_array('Level Management', (array) $priviledgesArray))
            <li class="nav-item">
              <a href="{{url('/levels')}}" id="levelsnav" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Levels</p>
              </a>
            </li>
            @endif
            @if(in_array('Grade Management', (array) $priviledgesArray))
            <li class="nav-item">
              <a href="{{url('/grades')}}" id="gradesnav" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Grades</p>
              </a>
            </li>
            @endif
            @if(in_array('Password Policy Management', (array) $priviledgesArray))
            <li class="nav-item">
              <a href="{{url('/passwordpolicy')}}" id="policynav" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Password Policy</p>
              </a>
            </li>
            @endif
          </ul>
        </li>


        <li class="nav-item has-treeview" id="pricemain">
          <a href="#" class="nav-link" id="pricehilightmain">
            <i class="nav-icon fas fa-file-invoice-dollar"></i>
            <p>
              Promotions & Pricing
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if(in_array('Promotion Management', (array) $priviledgesArray))
            <li class="nav-item">
              <a href="{{url('/promotionsmanager')}}" id="promotionnav" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Promotions</p>
              </a>
            </li>
            @endif
            @if(in_array('Promo Code Management', (array) $priviledgesArray))
            <li class="nav-item">
              <a href="{{url('/promocodemanager')}}" id="promocodenav" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Promo Codes</p>
              </a>
            </li>
            @endif
            @if(in_array('Pricing Management', (array) $priviledgesArray))
            <li class="nav-item">
              <a href="{{url('/pricingmanager')}}" id="pricingnav" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pricing</p>
              </a>
            </li>
            @endif
            @if(in_array('Approve Bank Payment', (array) $priviledgesArray))
            <li class="nav-item">
              <a href="{{url('/paymentmanger')}}" id="Paymentnav" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Payment Management</p>
              </a>
            </li>
            @endif
          </ul>
        </li>

        @if(in_array('User Management', (array) $priviledgesArray))

        <li class="nav-item has-treeview" id="masteruser">
          <a href="#" class="nav-link" id="masterusernav">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>
              Users & Roles
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('/userlist')}}" class="nav-link" id="usernav">
                <i class="far fa-circle nav-icon"></i>
                <p>Users</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{url('/userroles')}}" class="nav-link" id="rolesnav">
                <i class="far fa-circle nav-icon"></i>
                <p>Roles</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/privileges')}}" class="nav-link" id="rolesnav">
                <i class="far fa-circle nav-icon"></i>
                <p>Privilege Management</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/studentslist')}}" class="nav-link" id="dataentrynav">
                <i class="far fa-circle nav-icon"></i>
                <p>Students</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/dataentrylist')}}" class="nav-link" id="dataentrynav">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Entry Operators</p>
              </a>
            </li>
            
            

          </ul>
        </li>
        @endif
        @endif
        <li class="nav-item has-treeview" id="masteruser">
          <a href="#" class="nav-link" id="masterusernav">
            <i class="nav-icon fas fa-folder-open"></i>
            <p>
              Reports
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          @if(in_array('View question Reports', (array) $priviledgesArray))
            <li class="nav-item">
              <a href="{{url('/questionsreport')}}" class="nav-link" id="dataentrynav">
                <i class="far fa-circle nav-icon"></i>
                <p>Questions Report</p>
              </a>
            </li>
            @endif
            @if(in_array('View Revenue reports', (array) $priviledgesArray))
            <li class="nav-item">
              <a href="{{url('/revenuereport')}}" class="nav-link" id="dataentrynav">
                <i class="far fa-circle nav-icon"></i>
                <p>Revenue Report</p>
              </a>
            </li>
            @endif
            @if(in_array('View Purchase Report', (array) $priviledgesArray))
            <li class="nav-item">
              <a href="{{url('/purchasereport')}}" class="nav-link" id="dataentrynav">
                <i class="far fa-circle nav-icon"></i>
                <p>Purchase Report</p>
              </a>
            </li>
            @endif
            @if(in_array('View Student Report', (array) $priviledgesArray))
            <li class="nav-item">
              <a href="{{url('/studentsreport')}}" class="nav-link" id="dataentrynav">
                <i class="far fa-circle nav-icon"></i>
                <p>Student Report</p>
              </a>
            </li>
            @endif
            @if(in_array('View PromoCode report', (array) $priviledgesArray))
            <li class="nav-item">
              <a href="{{url('/promocodereport')}}" class="nav-link" id="dataentrynav">
                <i class="far fa-circle nav-icon"></i>
                <p>Promo Codes Report</p>
              </a>
            </li>
            @endif
            @if(in_array('View Audit report', (array) $priviledgesArray))
            <li class="nav-item">
              <a href="{{url('/auditreport')}}" class="nav-link" id="dataentrynav">
                <i class="far fa-circle nav-icon"></i>
                <p>Audit Report</p>
              </a>
            </li>
            @endif

          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>