<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E Tutory.lk | View Questions Report</title>
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
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Questions Report</h3>
                </div>
                <div class="card-body">
                  @php
                      $tableColCount = 6;
                      $theStatusVal = 0;
                      if($dataset['qsStatusVal'] == 'All'){
                        $theStatusVal = 0;
                      }else{
                        $theStatusVal = $dataset['qsStatusVal'];
                      }

                  @endphp
                <table class="table table-bordered">
                  <thead>                  
                    <tr>                  
                      <th>Subject</th>
                      <th>Question Type</th>
                      <th>Category</th>
                      <th>Sub Category</th>
                      @if($dataset['qsStatusVal'] == 'All')
                      <th>Approved Questions</th>
                      <th>None Approved Questions</th>
                      @elseif($dataset['qsStatusVal'] == '1')
                     
                      <th>Pending For Approval</th>
                      @php
                          $tableColCount = 5;
                      @endphp

                      @elseif($dataset['qsStatusVal'] == '0')
                      <th>Approved</th>
                      @php
                        $tableColCount = 5;                      
                      @endphp

                      @elseif($dataset['qsStatusVal'] == '2')
                      <th>On Hold</th>
                      @php
                        $tableColCount = 5;                      
                      @endphp

                      @elseif($dataset['qsStatusVal'] == '4')
                      <th>Rejected</th>
                      @php
                        $tableColCount = 5;                      
                      @endphp

                      @elseif($dataset['qsStatusVal'] == '3')
                      <th>Saved</th>
                      @php
                        $tableColCount = 5;                      
                      @endphp

                      @endif
                      
                    </tr>
                  </thead>
                  <tbody>
                    @if($dataset['mediumVal'] == 'All')
                        @php 
                          $mediumArray = ['English','Sinhala','Tamil'];
                        @endphp
                        @foreach($mediumArray as $theMedium)

                        <tr class="bg-info">
                          <td colspan="{{$tableColCount}}">Medium : {{ $theMedium}}</td>                          
                        </tr>
                        
                        <!-- Get the meduim centric grade list values -->
                        @php
                          if($dataset['gradeVal'] == 'All'){
                            $gradesList =  DB::table('questionsmain')->where('userlanguage', '=', $theMedium)->groupBy('gradeid')->get();
                          }else{
                            $explodedArray = explode(' - ',$dataset['gradeVal']);
                            $thegradeName =    $explodedArray[1];
                            $gradesList =  DB::table('questionsmain')->where([
                              ['userlanguage', '=', $theMedium],
                              ['gradename', '=', $thegradeName],
                              ])->groupBy('gradeid')->get();
                          }
                          
                        @endphp

                          @if(count($gradesList) > 0)
                              @foreach($gradesList as $grade)
                              <tr class="bg-info">
                                <td colspan="{{$tableColCount}}"> Grade : {{ $grade->gradename}}</td>                          
                              </tr>
                              <!-- get entries for this grade -->
                              @php
                                if($dataset['subjectVal'] == 'All'){

                                  $subjectList =  DB::table('questionsmain')->where([
                                  ['userlanguage', '=', $theMedium],
                                  ['gradename', '=', $grade->gradename],
                                  ])->groupBy('subjectname')->get();

                                }else{
                                  $explodedArray = explode(' - ',$dataset['subjectVal']);
                                  $theSubjectName =    $explodedArray[1];

                                  $subjectList =  DB::table('questionsmain')->where([
                                  ['userlanguage', '=', $theMedium],
                                  ['gradename', '=', $grade->gradename],
                                  ['subjectname', '=', $theSubjectName],
                                  ])->groupBy('subjectname')->get();

                                }
                               
                                
                              @endphp
                              @if(count($subjectList) > 0)
                             
                                @foreach($subjectList as $subject)
                                  
                           
                                  @php
                                  $subjectTotalApproved =0;
                                  $subjectTotalNotApproved =0;
                                  $s=1;

                                    if($dataset['qsType'] == 'All'){
                                      $qsTypeList =  DB::table('questionsmain')->where([
                                      ['userlanguage', '=', $theMedium],
                                      ['gradename', '=', $grade->gradename],
                                      ['subjectname', '=', $subject->subjectname],
                                      ])->groupBy('qstype')->get();
                                    }else{
                                      
                                      $theQsType =   $dataset['qsType'];

                                      $qsTypeList =  DB::table('questionsmain')->where([
                                      ['userlanguage', '=', $theMedium],
                                      ['gradename', '=', $grade->gradename],
                                      ['subjectname', '=', $subject->subjectname],
                                      ['qstype', '=', $theQsType],
                                      ])->groupBy('qstype')->get();
                                    }


                                    
                                
                                  @endphp
                                  @if(count($qsTypeList) > 0)
                                      @foreach($qsTypeList as $qsType)
                                        @php
                                          $qsTypeTotalApproved =0;
                                          $qsTypeTotalNotApproved =0;
                                          $t=1;
                                          if($dataset['categoryVal'] == 'All'){
                                            $categoryList =  DB::table('questionsmain')->where([
                                              ['userlanguage', '=', $theMedium],
                                              ['gradename', '=', $grade->gradename],
                                              ['subjectname', '=', $subject->subjectname],
                                              ['qstype', '=', $qsType->qstype],
                                              ])->groupBy('categoryname')->get();

                                          }else{

                                            $explodedArray = explode('-',$dataset['categoryVal']);
                                            $theCategoryName =    $explodedArray[1];

                                            $categoryList =  DB::table('questionsmain')->where([
                                              ['userlanguage', '=', $theMedium],
                                              ['gradename', '=', $grade->gradename],
                                              ['subjectname', '=', $subject->subjectname],
                                              ['qstype', '=', $qsType->qstype],
                                              ['categoryname', '=', $theCategoryName],
                                              ])->groupBy('categoryname')->get();

                                          }                                         
                                      
                                        @endphp

                                        @if(count($categoryList) > 0)
                                            @foreach($categoryList as $category)
                                            
                                            @php
                                            $categoryTotalApproved = 0;
                                            $categoryTotalNotApproved = 0;
                                            $c=1;

                                              if($dataset['subCategoryVal'] == 'All'){

                                                $subcategoryList =  DB::table('questionsmain')->where([
                                                ['userlanguage', '=', $theMedium],
                                                ['gradename', '=', $grade->gradename],
                                                ['subjectname', '=', $subject->subjectname],
                                                ['qstype', '=', $qsType->qstype],
                                                ['categoryname', '=', $category->categoryname],
                                                ])->groupBy('subcategoryname')->get();

                                              }else{

                                                $explodedArray = explode('-',$dataset['subCategoryVal']);
                                            $theSubCategoryName =    $explodedArray[1];


                                                $subcategoryList =  DB::table('questionsmain')->where([
                                                ['userlanguage', '=', $theMedium],
                                                ['gradename', '=', $grade->gradename],
                                                ['subjectname', '=', $subject->subjectname],
                                                ['qstype', '=', $qsType->qstype],
                                                ['categoryname', '=', $category->categoryname],
                                                ['subcategoryname', '=', $theSubCategoryName],
                                                ])->groupBy('subcategoryname')->get();

                                              }

                                              
                                          
                                            @endphp

                                            @if(count($subcategoryList) > 0)
                                                @foreach($subcategoryList as $subcategory)

                                                  <!-- Approved Count -->
                                                  @php 
                                                  
                                                  $approvedCount =  DB::table('questionsmain')->where([
                                                  ['userlanguage', '=', $theMedium],
                                                  ['gradename', '=', $grade->gradename],
                                                  ['subjectname', '=', $subject->subjectname],
                                                  ['qstype', '=', $qsType->qstype],
                                                  ['categoryname', '=', $category->categoryname],
                                                  ['subcategoryname', '=', $subcategory->subcategoryname],
                                                  ['status', '=', $theStatusVal],
                                                  ])->count('id');

                                                  $categoryTotalApproved += $approvedCount;
                                                  $qsTypeTotalApproved += $approvedCount;
                                                  $subjectTotalApproved += $approvedCount;
                                        
                                                  if($dataset['qsStatusVal']  == 'All'){

                                                    $notapprovedCount =  DB::table('questionsmain')->where([
                                                  ['userlanguage', '=', $theMedium],
                                                  ['gradename', '=', $grade->gradename],
                                                  ['subjectname', '=', $subject->subjectname],
                                                  ['qstype', '=', $qsType->qstype],
                                                  ['categoryname', '=', $category->categoryname],
                                                  ['subcategoryname', '=', $subcategory->subcategoryname],
                                                  ['status', '!=', '0'],
                                                  ])->count('id');

                                                    $categoryTotalNotApproved += $notapprovedCount;                                                    
                                                    $qsTypeTotalNotApproved += $notapprovedCount;         
                                                    $subjectTotalNotApproved += $notapprovedCount;   


                                                  }
                                                  
                                                  @endphp

                                                  <tr>
                                                    @if($s == 1)
                                                    <td>{{$subject->subjectname}}</td>
                                                      @php  $s++;
                                                      @endphp
                                                    @else
                                                    <td> </td>
                                                    @endif

                                                    @if($t == 1)
                                                    <td>{{$qsType->qstype}}</td>
                                                      @php  $t++;
                                                      @endphp
                                                    @else
                                                    <td> </td>
                                                    @endif
                                                    @if($c == 1)
                                                    <td>{{$category->categoryname}}</td>
                                                      @php  $c++;
                                                      @endphp
                                                    @else
                                                    <td> </td>
                                                    @endif
                                                   
                                                    
                                                   
                                                    <td>{{$subcategory->subcategoryname}}</td>
                                                    <td>{{$approvedCount}}</td>
                                                    @if($dataset['qsStatusVal']  == 'All')
                                                    <td>{{$notapprovedCount}}</td>
                                                    @endif
                                                 
                                                  </tr>

                                                @endforeach
                                            @endif
                                            <tr>
                                              <td colspan="2"></td>
                                              <td colspan="2" class="bg-success">Sub Total</td>
                                              <td class="bg-success"><b>{{$categoryTotalApproved}}</b></td>
                                              @if($dataset['qsStatusVal']  == 'All')
                                              <td class="bg-success"><b>{{$categoryTotalNotApproved}}</b></td>
                                              @endif
                                            </tr>
                                            @endforeach
                                        @endif
                                        <tr>
                                              <td colspan="1"></td>
                                              <td colspan="3" class="bg-success">Sub Total</td>
                                              <td class="bg-success"><b>{{$qsTypeTotalApproved}}</b></td>
                                              @if($dataset['qsStatusVal']  == 'All')
                                              <td class="bg-success"><b>{{$qsTypeTotalNotApproved}}</b></td>
                                              @endif
                                            </tr>
                                      @endforeach
                                  @endif

                                  <tr>
                                            
                                              <td colspan="4" class="bg-success">Sub Total</td>
                                              <td class="bg-success"><b>{{$subjectTotalApproved}}</b></td>
                                              @if($dataset['qsStatusVal']  == 'All')
                                              <td class="bg-success"><b>{{$subjectTotalNotApproved}}</b></td>
                                              @endif
                                            </tr>
                                @endforeach
                              @endif
                              @endforeach
                          @endif
                        @endforeach

                    @else
                        <tr class="bg-info">
                          <td colspan="8">Medium : {{$dataset['mediumVal']}}</td>
                          
                        </tr>
                        @php
                          $theMedium = $dataset['mediumVal'];
                         
                          if($dataset['gradeVal'] == 'All'){
                            $gradesList =  DB::table('questionsmain')->where('userlanguage', '=', $theMedium)->groupBy('gradeid')->get();
                          }else{
                            $explodedArray = explode(' - ',$dataset['gradeVal']);
                            $thegradeName =    $explodedArray[1];
                            $gradesList =  DB::table('questionsmain')->where([
                              ['userlanguage', '=', $theMedium],
                              ['gradename', '=', $thegradeName],
                              ])->groupBy('gradeid')->get();
                          }

                        @endphp

                        @if(count($gradesList) > 0)

                            @foreach($gradesList as $grade)
                            <tr class="bg-info">
                                <td colspan="8"> Grade : {{ $grade->gradename}}</td>                          
                              </tr>

                              @php
                              if($dataset['subjectVal'] == 'All'){

                                  $subjectList =  DB::table('questionsmain')->where([
                                  ['userlanguage', '=', $theMedium],
                                  ['gradename', '=', $grade->gradename],
                                  ])->groupBy('subjectname')->get();

                                }else{
                                  $explodedArray = explode(' - ',$dataset['subjectVal']);
                                  $theSubjectName =    $explodedArray[1];

                                  $subjectList =  DB::table('questionsmain')->where([
                                  ['userlanguage', '=', $theMedium],
                                  ['gradename', '=', $grade->gradename],
                                  ['subjectname', '=', $theSubjectName],
                                  ])->groupBy('subjectname')->get();

                                }
                              @endphp

                              @if(count($subjectList) > 0)

                                @foreach($subjectList as $subject)

                                @php
                                  $subjectTotalApproved =0;
                                  $subjectTotalNotApproved =0;
                                  $s=1;
                                   
                                  if($dataset['qsType'] == 'All'){
                                      $qsTypeList =  DB::table('questionsmain')->where([
                                      ['userlanguage', '=', $theMedium],
                                      ['gradename', '=', $grade->gradename],
                                      ['subjectname', '=', $subject->subjectname],
                                      ])->groupBy('qstype')->get();
                                    }else{
                                      
                                      $theQsType =   $dataset['qsType'];

                                      $qsTypeList =  DB::table('questionsmain')->where([
                                      ['userlanguage', '=', $theMedium],
                                      ['gradename', '=', $grade->gradename],
                                      ['subjectname', '=', $subject->subjectname],
                                      ['qstype', '=', $theQsType],
                                      ])->groupBy('qstype')->get();
                                    }
                                
                                  @endphp

                                  @if(count($qsTypeList) > 0)

                                      @foreach($qsTypeList as $qsType)

                                        @php
                                            $qsTypeTotalApproved =0;
                                            $qsTypeTotalNotApproved =0;
                                            $t=1;
                                            if($dataset['categoryVal'] == 'All'){
                                            $categoryList =  DB::table('questionsmain')->where([
                                              ['userlanguage', '=', $theMedium],
                                              ['gradename', '=', $grade->gradename],
                                              ['subjectname', '=', $subject->subjectname],
                                              ['qstype', '=', $qsType->qstype],
                                              ])->groupBy('categoryname')->get();
                                          }else{

                                            $explodedArray = explode('-',$dataset['categoryVal']);
                                            $theCategoryName =    $explodedArray[1];

                                            $categoryList =  DB::table('questionsmain')->where([
                                              ['userlanguage', '=', $theMedium],
                                              ['gradename', '=', $grade->gradename],
                                              ['subjectname', '=', $subject->subjectname],
                                              ['qstype', '=', $qsType->qstype],
                                              ['categoryname', '=', $theCategoryName],
                                              ])->groupBy('categoryname')->get();

                                          } 
                                        
                                          @endphp

                                          @if(count($categoryList) > 0)

                                            @foreach($categoryList as $category)

                                            @php
                                            $categoryTotalApproved = 0;
                                            $categoryTotalNotApproved = 0;
                                            $c=1;
                                             
                                            if($dataset['subCategoryVal'] == 'All'){

                                              $subcategoryList =  DB::table('questionsmain')->where([
                                              ['userlanguage', '=', $theMedium],
                                              ['gradename', '=', $grade->gradename],
                                              ['subjectname', '=', $subject->subjectname],
                                              ['qstype', '=', $qsType->qstype],
                                              ['categoryname', '=', $category->categoryname],
                                              ])->groupBy('subcategoryname')->get();

                                              }else{

                                              $explodedArray = explode('-',$dataset['subCategoryVal']);
                                              $theSubCategoryName =    $explodedArray[1];


                                              $subcategoryList =  DB::table('questionsmain')->where([
                                              ['userlanguage', '=', $theMedium],
                                              ['gradename', '=', $grade->gradename],
                                              ['subjectname', '=', $subject->subjectname],
                                              ['qstype', '=', $qsType->qstype],
                                              ['categoryname', '=', $category->categoryname],
                                              ['subcategoryname', '=', $theSubCategoryName],
                                              ])->groupBy('subcategoryname')->get();

                                              }


                                            @endphp

                                            @if(count($subcategoryList) > 0)

                                            @foreach($subcategoryList as $subcategory)


                                            @php 
                                                  $approvedCount =  DB::table('questionsmain')->where([
                                                  ['userlanguage', '=', $theMedium],
                                                  ['gradename', '=', $grade->gradename],
                                                  ['subjectname', '=', $subject->subjectname],
                                                  ['qstype', '=', $qsType->qstype],
                                                  ['categoryname', '=', $category->categoryname],
                                                  ['subcategoryname', '=', $subcategory->subcategoryname],
                                                  ['status', '=', '0'],
                                                  ])->count('id');

                                                  $categoryTotalApproved += $approvedCount;
                                                  $qsTypeTotalApproved += $approvedCount;
                                                  $subjectTotalApproved += $approvedCount;
                                        

                                                  $notapprovedCount =  DB::table('questionsmain')->where([
                                                  ['userlanguage', '=', $theMedium],
                                                  ['gradename', '=', $grade->gradename],
                                                  ['subjectname', '=', $subject->subjectname],
                                                  ['qstype', '=', $qsType->qstype],
                                                  ['categoryname', '=', $category->categoryname],
                                                  ['subcategoryname', '=', $subcategory->subcategoryname],
                                                  ['status', '!=', '0'],
                                                  ])->count('id');

                                                    $categoryTotalNotApproved += $notapprovedCount;                                                    
                                                    $qsTypeTotalNotApproved += $notapprovedCount;         
                                                    $subjectTotalNotApproved += $notapprovedCount;   

                                                  @endphp

                                                  <tr>
                                                    @if($s == 1)
                                                    <td>{{$subject->subjectname}}</td>
                                                      @php  $s++;
                                                      @endphp
                                                    @else
                                                    <td> </td>
                                                    @endif

                                                    @if($t == 1)
                                                    <td>{{$qsType->qstype}}</td>
                                                      @php  $t++;
                                                      @endphp
                                                    @else
                                                    <td> </td>
                                                    @endif
                                                    @if($c == 1)
                                                    <td>{{$category->categoryname}}</td>
                                                      @php  $c++;
                                                      @endphp
                                                    @else
                                                    <td> </td>
                                                    @endif
                                                   
                                                    
                                                   
                                                    <td>{{$subcategory->subcategoryname}}</td>
                                                    <td>{{$approvedCount}}</td>
                                                    @if($dataset['qsStatusVal']  == 'All')
                                                    <td>{{$notapprovedCount}}</td>
                                                    @endif
                                                  </tr>


                                            @endforeach

                                            @endif
                                            <tr>
                                              <td colspan="2"></td>
                                              <td colspan="2" class="bg-success">Sub Total</td>
                                              <td class="bg-success"><b>{{$categoryTotalApproved}}</b></td>
                                              @if($dataset['qsStatusVal']  == 'All')
                                              <td class="bg-success"><b>{{$categoryTotalNotApproved}}</b></td>
                                              @endif
                                            </tr>
                                            @endforeach

                                          @endif
                                          <tr>
                                              <td colspan="1"></td>
                                              <td colspan="3" class="bg-success">Sub Total</td>
                                              <td class="bg-success"><b>{{$qsTypeTotalApproved}}</b></td>
                                              @if($dataset['qsStatusVal']  == 'All')
                                              <td class="bg-success"><b>{{$qsTypeTotalNotApproved}}</b></td>
                                              @endif
                                            </tr>
                                      @endforeach

                                  @endif
                                  <tr>
                                            
                                            <td colspan="4" class="bg-success">Sub Total</td>
                                            <td class="bg-success"><b>{{$subjectTotalApproved}}</b></td>
                                            @if($dataset['qsStatusVal']  == 'All')
                                            <td class="bg-success"><b>{{$subjectTotalNotApproved}}</b></td>
                                            @endif
                                          </tr>
                                @endforeach

                              @endif

                            @endforeach

                        @endif

                    @endif
                  </tbody>
                </table>
                </div>
                <div class="card-footer">
                <form role="form" action="{{url('/questionsreportPDF') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden"   value="{{$dataset['mediumVal']}}" name="mediumVal">
                <input type="hidden"   value="{{$dataset['qsStatusVal']}}" name="qsStatusVal">
                <input type="hidden"   value="{{$dataset['examTypeVal']}}" name="examTypeVal">
                <input type="hidden"   value="{{$dataset['gradeVal']}}" name="gradeVal">
                <input type="hidden"   value="{{$dataset['subjectVal']}}" name="subjectVal">
                <input type="hidden"   value="{{$dataset['qsType']}}" name="qsType">
                <input type="hidden"   value="{{$dataset['categoryVal']}}" name="categoryVal">
                <input type="hidden"   value="{{$dataset['subCategoryVal']}}" name="subCategoryVal">
                  <button type="submit" class="btn btn-primary">Download PDF</button>
                  <a href="{{url('/questionsreport')}}" class="btn btn-danger">Cancel</a>
                </form>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                
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

  <script>
    $('#subject').change(function() {
      var subjectVal = $('#subject').val();
      var splitlist = subjectVal.split(" - ");
      var subjectId = splitlist[0];
      var subjectName = splitlist[1];
      var gradeVal = $('#grade').val();
      var splitlist = gradeVal.split(" - ");
      var gardeId = splitlist[0];
      var gardeName = splitlist[1];


      $('#category').empty();
      $('#subcategory').empty();
      $('#category').append('     <option value="All">All</option>');
      $('#subcategory').append('     <option value="All">All</option>');

      

      $.get('/getcategoryset/' + gardeId + '^' + subjectId, function(response) {
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

    $('#category').change(function(){

        var categoryVal = $('#category').val();
        var splitlist = categoryVal.split("-");
       var categoryId = splitlist[0];

       
      $.get('/getsubcategorydata/' + categoryId, function(response) {
        $('#subcategory').empty();
        $('#subcategory').append('     <option value="All">All</option>');
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