<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ReportsConstroller extends Controller
{
    public function questionsreport()
    {

        $examTypeData = DB::table('examtypes')->where('status', '=', 'A')->get();
        $gradeData = DB::table('grades')->where('status', '=', 'A')->get();
        $subjectData = DB::table('subjects')->where('status', '=', 'A')->get();
        $categoryData = DB::table('categories')->where('status', '=', 'A')->get();
        
        $subCategoryData = DB::table('subcategories')->where([
            ['status', '=', 'A'],
            ['parentcategoryid', '=', $categoryData[0]->id],
        ])->get();

        $dataset = [
            'examTypeData' => $examTypeData,
            'gradeData' => $gradeData,
            'subjectData' => $subjectData,
            'categoryData' => $categoryData,
            'subCategoryData' => $subCategoryData,

        ];
        return view('pages.questionsreport')->with('dataset', $dataset);
    }

    public function revenuereport()
    {
        $examTypeData = DB::table('examtypes')->where('status', '=', 'A')->get();
        $gradeData = DB::table('grades')->where('status', '=', 'A')->get();

        $dataset = [
            'examTypeData' => $examTypeData,
            'gradeData' => $gradeData,
            

        ];
        return view('pages.revenuereport')->with('dataset', $dataset);
    }

    public function purchasereport()
    {
        $examTypeData = DB::table('examtypes')->where('status', '=', 'A')->get();
        $gradeData = DB::table('grades')->where('status', '=', 'A')->get();
        $studentsData = DB::table('students')->where('status', '=', '1')->get();

        $dataset = [
            'examTypeData' => $examTypeData,
            'gradeData' => $gradeData,
            'studentsData' => $studentsData,
        ];

        return view('pages.purchasereport')->with('dataset', $dataset);
    }

    public function studentsreport()
    
    {
        
        $gradeData = DB::table('grades')->where('status', '=', 'A')->get();
        $studentsData = DB::table('students')->where('status', '=', '1')->get();

        $dataset = [
           
            'gradeData' => $gradeData,
            'studentsData' => $studentsData,
        ];

        return view('pages.studentsreport')->with('dataset', $dataset);
    }

    public function promocodereport()
    {
        $promocodeData = DB::table('promocodes')->where('status', '=', 'A')->get();
        
        $dataset = [
           
            'promocodeData' => $promocodeData,
           
        ];
        return view('pages.promocodereport')->with('dataset', $dataset);
    }

    public function auditreport()
    {

        $userdata = DB::table('users')->where('status', '=', 'A')->get();

        $dataset = [           
            'userdata' => $userdata,           
        ];

        return view('pages.auditreport')->with('dataset', $dataset);
    }

    public function genquestionsreport(Request $request)
    {

        $reportId = 'qwqjkwjqkwj';

        $medium = $request->input('medium');
        $questionStatus = $request->input('qstype');
        $examType = $request->input('examtype');
        $gradeVal = $request->input('grade');
        $subjectVal = $request->input('subject');
        $questionType = $request->input('questiontype');
        $categoryVal = $request->input('category');
        $subCategoryVal = $request->input('subcategory');

        

        $dataset = [
            'mediumVal' => $medium,
            'qsStatusVal' => $questionStatus,
            'examTypeVal' => $examType,
            'gradeVal' => $gradeVal,
            'subjectVal' => $subjectVal,
            'qsType' => $questionType,
            'categoryVal' => $categoryVal,
            'subCategoryVal' => $subCategoryVal,

        ];

        return view('pages.viewquestionsreport')->with('dataset',$dataset);
    }

    public function questionsreportPDF(Request $request){

        $mediumVal = $request->input('mediumVal');
        $qsStatusVal = $request->input('qsStatusVal');
        $examTypeVal = $request->input('examTypeVal');
        $gradeVal = $request->input('gradeVal');
        $subjectVal = $request->input('subjectVal');
        $qsTypeVal = $request->input('qsType');
        $categoryVal = $request->input('categoryVal');
        $subCategoryVal = $request->input('subCategoryVal');

        $pdf = App::make('dompdf.wrapper');
        $htmlData = '<style>
        .{font-family: Arial, Helvetica, sans-serif;}
        .tb_header{
            background-color: #AED6F1;
        }
        .tb_sectionheader{
            background-color:#45B39D;
        }

        .subtotal_tr{
            background-color:#82E0AA;
        }
        </style>
        <h2>Question Report</h2>';
        $htmlData .= '<table>';
        $htmlData .= '<tr class="tb_header">
            <th>Subject</th>
            <th>Question Type</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Approved Questions</th>
            <th>None Approved Questions</th>
        </tr>';
        if(true){
            $mediumArray =array();
            if($mediumVal == 'All'){
                $mediumArray = ['English','Sinhala','Tamil'];
            }else{
                $mediumArray = [$mediumVal];
            }
            
            foreach($mediumArray as $theMedium){
                $htmlData .= '<tr class="tb_sectionheader">
                                <td colspan="8">Medium : '.$theMedium.'</td>                          
                            </tr>';
                if($gradeVal == 'All'){
                    $gradesList =  DB::table('questionsmain')->where('userlanguage', '=', $theMedium)->groupBy('gradeid')->get();
                }else{
                    $explodedArray = explode(' - ',$gradeVal);
                    $thegradeName =    $explodedArray[1];
                    $gradesList =  DB::table('questionsmain')->where([
                        ['userlanguage', '=', $theMedium],
                        ['gradename', '=', $thegradeName],
                        ])->groupBy('gradeid')->get();
                }
               
                if(count($gradesList) > 0 ){
                    foreach($gradesList as $grade){
                        $htmlData .= '<tr class="tb_sectionheader">
                        <td colspan="8"> Grade : '.$grade->gradename.'</td>                          
                      </tr>';
                      if($subjectVal == 'All'){
                        $subjectList =  DB::table('questionsmain')->where([
                            ['userlanguage', '=', $theMedium],
                            ['gradename', '=', $grade->gradename],
                            ])->groupBy('subjectname')->get();
                      }else{
                        $explodedArray = explode(' - ',$subjectVal);
                        $theSubjectName =    $explodedArray[1];

                        $subjectList =  DB::table('questionsmain')->where([
                        ['userlanguage', '=', $theMedium],
                        ['gradename', '=', $grade->gradename],
                        ['subjectname', '=', $theSubjectName],
                        ])->groupBy('subjectname')->get();
                      }
                      

                        if(count($subjectList) > 0){

                            foreach($subjectList as $subject){
                                $subjectTotalApproved =0;
                                  $subjectTotalNotApproved =0;
                                $s=1;

                                if($qsTypeVal == 'All' ){
                                    $qsTypeList =  DB::table('questionsmain')->where([
                                        ['userlanguage', '=', $theMedium],
                                        ['gradename', '=', $grade->gradename],
                                        ['subjectname', '=', $subject->subjectname],
                                        ])->groupBy('qstype')->get();
                                }else{

                                    $theQsType =   $qsTypeVal;

                                    $qsTypeList =  DB::table('questionsmain')->where([
                                    ['userlanguage', '=', $theMedium],
                                    ['gradename', '=', $grade->gradename],
                                    ['subjectname', '=', $subject->subjectname],
                                    ['qstype', '=', $theQsType],
                                    ])->groupBy('qstype')->get();

                                }
                                

                                    if(count($qsTypeList) > 0){
                                        foreach($qsTypeList as $qsType){
                                            $qsTypeTotalApproved =0;
                                            $qsTypeTotalNotApproved =0;
                                            $t=1;
                                            if($categoryVal == 'All'){

                                                $categoryList =  DB::table('questionsmain')->where([
                                                    ['userlanguage', '=', $theMedium],
                                                    ['gradename', '=', $grade->gradename],
                                                    ['subjectname', '=', $subject->subjectname],
                                                    ['qstype', '=', $qsType->qstype],
                                                    ])->groupBy('categoryname')->get();

                                            }else{

                                                $explodedArray = explode('-',$categoryVal);
                                                $theCategoryName =    $explodedArray[1];
    
                                                $categoryList =  DB::table('questionsmain')->where([
                                                  ['userlanguage', '=', $theMedium],
                                                  ['gradename', '=', $grade->gradename],
                                                  ['subjectname', '=', $subject->subjectname],
                                                  ['qstype', '=', $qsType->qstype],
                                                  ['categoryname', '=', $theCategoryName],
                                                  ])->groupBy('categoryname')->get();

                                            }
                                            

                                            if(count($categoryList) > 0){

                                                foreach($categoryList as $category){
                                                    $categoryTotalApproved = 0;
                                                    $categoryTotalNotApproved = 0;
                                                    $c=1;

                                                    if($subCategoryVal == 'All'){
                                                        $subcategoryList =  DB::table('questionsmain')->where([
                                                            ['userlanguage', '=', $theMedium],
                                                            ['gradename', '=', $grade->gradename],
                                                            ['subjectname', '=', $subject->subjectname],
                                                            ['qstype', '=', $qsType->qstype],
                                                            ['categoryname', '=', $category->categoryname],
                                                            ])->groupBy('subcategoryname')->get();
                                                    }else{

                                                            $explodedArray = explode('-',$subCategoryVal);
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

                                                

                                                    if(count($subcategoryList) > 0){

                                                        foreach($subcategoryList as $subcategory){
                                                            
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

                                                                $htmlData .= '<tr>';
                                                                if($s == 1){
                                                                    $htmlData .= '<td>'.$subject->subjectname.'</td>';
                                                                    $s++;
                                                                }else{
                                                                    $htmlData .= '<td> </td>';
                                                                }

                                                                if($t == 1){
                                                                    $htmlData .= '<td>'.$qsType->qstype.'</td>';
                                                                    $t++;
                                                                }else{
                                                                    $htmlData .= '<td> </td>';
                                                                }

                                                                if($c == 1){
                                                                    $htmlData .= '<td>'.$category->categoryname.'</td>';
                                                                    $c++;
                                                                }else{
                                                                    $htmlData .= '<td> </td>';
                                                                }

                                                                $htmlData .= '<td>'.$subcategory->subcategoryname.'</td>
                                                                <td style="text-align:right;">'.$approvedCount.'</td>
                                                                <td style="text-align:right;">'.$notapprovedCount.'</td>';
                                                                
                                                                $htmlData .= '</tr>';


                                                        }

                                                    }

                                                    $htmlData .= '<tr class="">
                                                    <td colspan="2"></td>
                                                    <td colspan="2" class="subtotal_tr">Sub Total</td>
                                                    <td class="subtotal_tr" style="text-align:right;"><b>'.$categoryTotalApproved.'</b></td>';
                                                    if($qsStatusVal  == 'All'){
                                                        $htmlData .= ' <td class="subtotal_tr" style="text-align:right;"><b>'.$categoryTotalNotApproved.'</b></td>';
                                                    }                                                    
                                           
                                                    $htmlData .= ' </tr>';
                                                }

                                            }
                                            $htmlData .= '<tr class="">
                                                    <td colspan="1"></td>
                                                    <td colspan="3" class="subtotal_tr">Sub Total</td>
                                                    <td class="subtotal_tr" style="text-align:right;"><b>'.$qsTypeTotalApproved.'</b></td>';
                                                    if($qsStatusVal  == 'All'){
                                                        $htmlData .= ' <td class="subtotal_tr" style="text-align:right;"><b>'.$qsTypeTotalNotApproved.'</b></td>';
                                                    }                                                    
                                           
                                                    $htmlData .= ' </tr>';
                                        }
                                    }
                                    $htmlData .= '<tr class="">
                                    
                                    <td colspan="4" class="subtotal_tr">Sub Total</td>
                                    <td class="subtotal_tr" style="text-align:right;"><b>'.$subjectTotalApproved.'</b></td>';
                                    if($qsStatusVal  == 'All'){
                                        $htmlData .= ' <td class="subtotal_tr" style="text-align:right;"><b>'.$subjectTotalNotApproved.'</b></td>';
                                    }                                                    
                           
                                    $htmlData .= ' </tr>';
                            }

                        }
                    }
                }
            }
        }else{
            $theMedium = $mediumVal;
            $htmlData .= '<tr class="tb_sectionheader">
            <td colspan="8">Medium : '.$theMedium.'</td>                          
        </tr>';
        }
        $htmlData .= '</table>';

        $pdf->loadHTML($htmlData);
        return $pdf->download('Question Report.pdf');

    }

    public function genrevenuereport(Request $request){

        $this->validate($request, [      
            'fromdate' => 'required',
            'todate' => 'required',
        ]);

        $fromDateVal = $request->input('fromdate');
        $toDateVal = $request->input('todate');
        $mediumVal = $request->input('medium');
        $examTypeVal = $request->input('examtype');
        $gradeVal = $request->input('grade');
        
        //From date reformt
        $expldedList = explode('/',$fromDateVal);
        $newFromDate = $expldedList[2].'-'.$expldedList[1].'-'.$expldedList[0];
        $newFromDate .= ' 00:00:01';

        $expldedList = explode('/',$toDateVal);
        $newToDate = $expldedList[2].'-'.$expldedList[1].'-'.$expldedList[0];
        $newToDate .= ' 23:59:59';

        if($mediumVal == 'All'){
            $theMedium = '';
        }else{
            $theMedium = $mediumVal;
        }

        if($examTypeVal == 'All'){
            $theExamType ='';
        }else{
            $expldedList = explode('-',$examTypeVal);
            $theExamType =    $expldedList[1];
        }

        if($gradeVal  == 'All'){
            $theGrade = '';
        }else{
            $expldedList = explode('-',$gradeVal);
            $theGrade =    $expldedList[1];
        }

        $totalRevenu = DB::table('studenttransactions')->where([
            ['usermedium', 'like', '%'.$theMedium],
            ['status', '=', '1'],                                      
            ['examtype', 'like', '%'.$theExamType],     
            ['grade', 'like', '%'.$theGrade],   
            ['created_at', '>=', $newFromDate],   
            ['created_at', '<=', $newToDate],  
            ])->sum('price');

        $dataset = [
            'fromDateVal' => $newFromDate,
            'toDateVal' => $newToDate,
            'fromDateString' => $fromDateVal,
            'toDateValString' => $toDateVal,
            'mediumVal' => $mediumVal,
            'examTypeVal' => $examTypeVal,
            'gradeVal' => $gradeVal,
            'totalRevenu' => $totalRevenu,
            'testString' => $theGrade,
        ];

        return view('pages.viewrevenuereport')->with('dataset',$dataset);
       

    }

    public function revenuereportPDF(Request $request){
        
        $fromDateVal = $request->input('fromDateVal');
        $toDateVal = $request->input('toDateVal');
        $fromDateString = $request->input('fromDateString');
        $toDateValString = $request->input('toDateValString');
        $mediumVal = $request->input('mediumVal');
        $examTypeVal = $request->input('examTypeVal');
        $gradeVal = $request->input('gradeVal');
        $totalRevenueVal = $request->input('totalRevenueVal');

        $pdf = App::make('dompdf.wrapper');
        $htmlData = '<style>
        .{font-family: Arial, Helvetica, sans-serif;}
        .tb_header{
            background-color: #AED6F1;
        }
        .total_tr{
            background-color: #C3D2D8;
        }
        </style>
        <h2>Revenue Report</h2>
        <h4>From : <b>'.$fromDateString.'</b> To :<b> '.$toDateValString.'</b></h4>
        <h4>Total Revenue : <b>'.number_format($totalRevenueVal,2).'</b></h4>';
        $htmlData .= '<table style="width:100%">';
        $htmlData .= '<tr class="tb_header">
                    <td>Medium</td>
                    <td>Exam Type</td>
                    <td>Grade</td>
                    <td style="text-align:right;">Revenue</td>
                    </tr>';

        $mediumArray = array();
        $TotalRevenue = 0;

        if($mediumVal == 'All'){
            $mediumArray = ['English','Sinhala','Tamil'];
        }else{
            $mediumArray = [$mediumVal];
        }

        foreach($mediumArray as $theMedium){
            $m =1;
            $examTypeList = DB::table('studenttransactions')->where([
                ['usermedium', '=', $theMedium],
                ['status', '=', '1'],   
                ['created_at', '>=', $fromDateVal],   
                ['created_at', '<=', $toDateVal],                                     
                ])->groupBy('examtype')->get();
 
            if(count($examTypeList) > 0){

                foreach($examTypeList as $examType){
                    $e=1;

                    $gradeList = DB::table('studenttransactions')->where([
                        ['usermedium', '=', $theMedium],
                        ['status', '=', '1'],                                      
                        ['examtype', '=', $examType->examtype],     
                        ['created_at', '>=', $fromDateVal],   
                        ['created_at', '<=', $toDateVal],   
                        ])->groupBy('grade')->get();

                    if(count($gradeList) > 0){

                            foreach($gradeList as $grade){

                                $theRevenue = DB::table('studenttransactions')->where([
                                    ['usermedium', '=', $theMedium],
                                    ['status', '=', '1'],                                      
                                    ['examtype', '=', $examType->examtype],     
                                    ['grade', '=', $grade->grade],   
                                    ['created_at', '>=', $fromDateVal],   
                                    ['created_at', '<=', $toDateVal],   
                                    ])->sum('price');
                                    $TotalRevenue += $theRevenue;

                                    $htmlData .='<tr>';
                                    if($m ==1){
                                        $m++;
                                        $htmlData .='  <td>'.$theMedium.'</td>';
                                    }else{
                                        $htmlData .='  <td></td>';
                                    }

                                    if($e ==1){
                                        $e++;
                                        $htmlData .='  <td>'.$examType->examtype.'</td>';
                                    }else{
                                        $htmlData .='  <td></td>';
                                    }
                                   
                                  
                                    $htmlData .='    <td>'.$grade->grade.'</td>
                                        <td style="text-align:right;">'.number_format($theRevenue,2).'</td>
                                    </tr>';
                            }
                    }

                }
            }

        }
        $htmlData .= '<tr class="total_tr">
        <td colspan="3">Total :</td>
        <td style="text-align:right;"><b>'.number_format($TotalRevenue,2).'</b></td>
        </tr>';
        $htmlData .= '</table>';


        $pdf->loadHTML($htmlData);
        return $pdf->download('Revenue Report.pdf');


    }

    public function genpurchasereport(Request $request){

        $this->validate($request, [      
            'fromdate' => 'required',
            'todate' => 'required',
        ]);

        $fromDateVal = $request->input('fromdate');
        $toDateVal = $request->input('todate');
        $mediumVal = $request->input('medium');
        $examTypeVal = $request->input('examtype');
        $gradeVal = $request->input('grade');
        $studentVal = $request->input('student');

         //From date reformt
         $expldedList = explode('/',$fromDateVal);
         $newFromDate = $expldedList[2].'-'.$expldedList[1].'-'.$expldedList[0];
         $newFromDate_NT = $newFromDate;
         $newFromDate .= ' 00:00:01';
 
         $expldedList = explode('/',$toDateVal);
         $newToDate = $expldedList[2].'-'.$expldedList[1].'-'.$expldedList[0];
         $newToDate_NT = $newToDate;
       
         $newToDate .= ' 23:59:59';

         $str_datediff= strtotime($newToDate_NT)-strtotime($newFromDate_NT);
         $dateDiffrance = round($str_datediff / (60 * 60 * 24));
         $dateDiffrance++;

        if($mediumVal == 'All'){
            $theMedium = '';
        }else{
            $theMedium = $mediumVal;
        }

        if($examTypeVal == 'All'){
            $theExamType = '';
        }else{
            $theExamType = $examTypeVal;
        }

        if($gradeVal  == 'All'){
            $theGrade = '';
        }else{
            $expldedList = explode(' - ',$gradeVal);
            $theGrade =    $expldedList[1];
        }

        if($studentVal = 'All'){
            $theStudent = '';
        }else{
            $expldedList = explode(' - ',$studentVal);
            $theStudent =    $expldedList[1];
        }


         $totalPrice = DB::table('studenttransactions')->where([
            ['usermedium', 'like', '%'.$theMedium],
            ['status', '=', '1'],                                      
            ['examtype', 'like', '%'.$theExamType],     
            ['grade', 'like', '%'.$theGrade],   
            ['studentname', 'like', '%'.$theStudent],   
            ['created_at', '>=', $newFromDate],   
            ['created_at', '<=', $newToDate],  
            ])->sum('price');

            $totalDiscount = DB::table('studenttransactions')->where([
                ['usermedium', 'like', '%'.$theMedium],
                ['status', '=', '1'],                                      
                ['examtype', 'like', '%'.$theExamType],     
                ['grade', 'like', '%'.$theGrade],   
                ['studentname', 'like', '%'.$theStudent],   
                ['created_at', '>=', $newFromDate],   
                ['created_at', '<=', $newToDate],  
                ])->sum('discount');

        $totalRevenueVal = $totalPrice -       $totalDiscount;

        $dataset = [
            'startDate' => $newFromDate_NT,
            'fromDateString' => $fromDateVal,
            'toDateValString' => $toDateVal,
            'mediumVal' => $mediumVal,
            'examTypeVal' => $examTypeVal,
            'gradeVal' => $gradeVal,
            'studentVal' => $studentVal,           
            'totalRevenueVal' => $totalRevenueVal,           
            'dateDiffrance' => $dateDiffrance,    
        ];

        return view('pages.viewpurchasereport')->with('dataset',$dataset);

    }

    public function purchasereportPDF(Request $request){

        $startDate = $request->input('startDate');
        $fromDateString = $request->input('fromDateString');
        $toDateValString = $request->input('toDateValString');
        $mediumVal = $request->input('mediumVal');
        $examTypeVal = $request->input('examTypeVal');
        $gradeVal = $request->input('gradeVal');
        $studentVal = $request->input('studentVal');
        $totalRevenueVal = $request->input('totalRevenueVal');
        $dateDiffrance = $request->input('dateDiffrance');

        $pdf = App::make('dompdf.wrapper');
            
        $htmlData = '<style>
            .{font-family: Arial, Helvetica, sans-serif;}
            .tb_header{
                background-color: #AED6F1;
            }
            .tb_sectionheader{
                background-color:#45B39D;
            }
    
            .subtotal_tr{
                background-color:#82E0AA;
            }
            </style>
            <h2>Purchase Report</h2>';

        if($dateDiffrance >0){

            $htmlData .='<h4>From : <b>'.$fromDateString.'</b> To : <b>'.$toDateValString.'</b></h4>';
            $htmlData .='<h4>Total Revenue : <b>'.number_format($totalRevenueVal,2).'</b></h4>';

            $htmlData .= '<table>
            <tr class="tb_header">
            <th>Date</th>              
            <th>Medium</th>
            <th>Exam Type</th>
            <th>Grade</th>
            <th>Exam Name</th>
            <th>Student</th>
            <th>Pay Type</th>
            <th  style="text-align:right;">Price</th>
            <th  style="text-align:right;">Discount</th>
            <th  style="text-align:right;">Revenue</th>                  
            </tr>';

            $i=1;
            $theCurrDate = date('Y-m-d', strtotime($startDate . ' -1 day'));
            $totalPrice =0;
            $totalDiscount=0;
            $totalRevenue=0;
            while($dateDiffrance >= $i){

                $c1=1;
                $theCurrDate = date('Y-m-d', strtotime($theCurrDate . ' +1 day'));
                $theCurrDate_Start = $theCurrDate.' 00:00:01';
                $theCurrDate_End = $theCurrDate.' 23:59:59';

                $mediumList = array();

                if($mediumVal == 'All'){
                    $mediumList = ['English','Sinhala','Tamil'];
                }else{
                $mediumList = [$mediumVal];
                }

                foreach($mediumList as $theMedium){

                    $c2=1;

                    $ExamTypeList = array();
                    if($examTypeVal == 'All'){
                        $ExamTypeList = DB::table('studenttransactions')->where([
                            ['usermedium', '=', $theMedium],
                            ['status', '=', '1'],                                       
                            ['created_at', '>=', $theCurrDate_Start],       
                            ['created_at', '<=', $theCurrDate_End],       
                            ])->groupBy('examtype')->get();
                    }else{

                        $ExamTypeList = DB::table('studenttransactions')->where([
                            ['usermedium', '=', $theMedium],
                            ['status', '=', '1'],                                       
                            ['examtype', '=', $examTypeVal],           
                            ['created_at', '>=', $theCurrDate_Start],       
                            ['created_at', '<=', $theCurrDate_End],       
                            ])->groupBy('examtype')->get();
                    }

                    if(count($ExamTypeList) > 0){

                        foreach($ExamTypeList as $examType){
                            $c3=1;
                            $gradeList = array();

                            if($gradeVal == 'All'){

                                $gradeList = DB::table('studenttransactions')->where([
                                    ['usermedium', '=', $theMedium],
                                    ['examtype', '=', $examType->examtype],
                                    ['status', '=', '1'],                                       
                                    ['created_at', '>=', $theCurrDate_Start],       
                                    ['created_at', '<=', $theCurrDate_End],       
                                    ])->groupBy('grade')->get();

                            }else{

                                $explist = explode(' - ',$gradeVal);
                                $gradeName = $explist[1];
                                $gradeList = DB::table('studenttransactions')->where([
                                          ['usermedium', '=', $theMedium],
                                          ['examtype', '=', $examType->examtype],
                                          ['grade', '=', $gradeName],
                                          ['status', '=', '1'],                                       
                                          ['created_at', '>=', $theCurrDate_Start],       
                                          ['created_at', '<=', $theCurrDate_End],       
                                          ])->groupBy('grade')->get();


                            }

                            if(count($gradeList) > 0){

                                foreach($gradeList as $grade){


                                    $productnameList = DB::table('studenttransactions')->where([
                                        ['usermedium', '=', $theMedium],
                                        ['examtype', '=', $examType->examtype],
                                        ['grade', '=', $grade->grade],
                                        ['status', '=', '1'],                                       
                                        ['created_at', '>=', $theCurrDate_Start],       
                                        ['created_at', '<=', $theCurrDate_End],       
                                        ])->groupBy('productname')->get();


                                    if(count($productnameList) > 0){

                                        foreach($productnameList as $product){

                                            $studentcodeList = array();

                                            if($studentVal == 'All'){

                                                $studentcodeList = DB::table('studenttransactions')->where([
                                                    ['usermedium', '=', $theMedium],
                                                    ['examtype', '=', $examType->examtype],
                                                    ['grade', '=', $grade->grade],
                                                    ['productname', '=', $product->productname],
                                                    ['status', '=', '1'],                                       
                                                    ['created_at', '>=', $theCurrDate_Start],       
                                                    ['created_at', '<=', $theCurrDate_End],       
                                                    ])->groupBy('studentid')->get();

                                            }else{

                                                $explist = explode(' - ',$studentVal);
                                                $studentCode = $explist[0];

                                            $studentcodeList = DB::table('studenttransactions')->where([
                                                        ['usermedium', '=', $theMedium],
                                                        ['examtype', '=', $examType->examtype],
                                                        ['grade', '=', $grade->grade],
                                                        ['productname', '=', $product->productname],
                                                        ['studentid', '=',    $studentCode],
                                                        ['status', '=', '1'],                                       
                                                        ['created_at', '>=', $theCurrDate_Start],       
                                                        ['created_at', '<=', $theCurrDate_End],       
                                                        ])->groupBy('studentid')->get();

                                            }

                                            if(count($studentcodeList) > 0){
                                                    foreach($studentcodeList as $student){


                                                        $revenueData = DB::table('studenttransactions')->where([
                                                            ['usermedium', '=', $theMedium],
                                                            ['examtype', '=', $examType->examtype],
                                                            ['grade', '=', $grade->grade],
                                                            ['productname', '=', $product->productname],
                                                            ['studentid', '=', $student->studentid],
                                                            ['status', '=', '1'],                                       
                                                            ['created_at', '>=', $theCurrDate_Start],       
                                                            ['created_at', '<=', $theCurrDate_End],       
                                                            ])->get();


                                                        if(count($revenueData) > 0){

                                                            foreach($revenueData as $reventry){

                                                                $totalPrice += $reventry->price;
                                                                $totalDiscount += $reventry->discount;
                                                       
                                                                $htmlData .= '<tr>';
                                                                if($c1 ==1){
                                                                    $htmlData .= '<td>'.$theCurrDate.'</td>';
                                                                    $c1++;
                                                                }else{
                                                                    $htmlData .= '<td></td>';
                                                                }

                                                                if($c2 ==1){
                                                                    $htmlData .= '<td>'.$theMedium.'</td>';
                                                                    $c2++;
                                                                }else{
                                                                    $htmlData .= '<td></td>';
                                                                }

                                                                if($c3 ==1){
                                                                    $htmlData .= '<td>'.$examType->examtype.'</td>';
                                                                    $c3++;
                                                                }else{
                                                                    $htmlData .= '<td></td>';
                                                                }

                                                                $htmlData .= '<td>'.$grade->grade.'</td>';
                                                                $htmlData .= '<td>'.$product->productname.'</td>';
                                                                $htmlData .= '<td>'.$student->studentid.' - '.$student->studentname.'</td>';
                                                                $htmlData .= '<td>'.$reventry->paymethod.'</td>';
                                                                $htmlData .= '<td  style="text-align:right;">'.number_format($reventry->price,2).'</td>';
                                                                $htmlData .= '<td  style="text-align:right;">'.number_format($reventry->discount,2).'</td>';
                                                                $revAmount = $reventry->price-$reventry->discount;
                                                                $htmlData .= '<td style="text-align:right;">'.number_format($revAmount,2).'</td>';
                                                                $htmlData .= '</tr>';

                                                            }
                                                        }
                                                    }
                                            }

                                        }

                                    }
                                }

                            }

                        }

                    }

                }


                $i++;
            }
            $totalRevenue = $totalPrice-$totalDiscount;

            $htmlData .= '<tr class="subtotal_tr">';
            $htmlData .= '<td colspan="7"><b>Total</b></td>';
            $htmlData .= '<td  style="text-align:right;"><b>'.number_format($totalPrice,2).'</b></td>';
            $htmlData .= '<td  style="text-align:right;"><b>'.number_format($totalDiscount,2).'</b></td>';
            $htmlData .= '<td  style="text-align:right;"><b>'.number_format($totalRevenue,2).'</b></td>';
            
            $htmlData .= '</tr>';
            $htmlData .= '</table>';
        }

        $pdf->loadHTML($htmlData);
        return $pdf->download('Purchase Report.pdf');

    }

    public function genstudentreport(Request $request){

        $this->validate($request, [      
            'fromdate' => 'required',
            'todate' => 'required',
        ]);

        $fromDateVal = $request->input('fromdate');
        $toDateVal = $request->input('todate');
        $mediumVal = $request->input('medium');       
        $gradeVal = $request->input('grade');
        $studentVal = $request->input('student');

        //From date reformt
        $expldedList = explode('/',$fromDateVal);
        $newFromDate = $expldedList[2].'-'.$expldedList[1].'-'.$expldedList[0];
        $newFromDate_NT = $newFromDate;
        $newFromDate .= ' 00:00:01';

        $expldedList = explode('/',$toDateVal);
        $newToDate = $expldedList[2].'-'.$expldedList[1].'-'.$expldedList[0];
        $newToDate_NT = $newToDate;
      
        $newToDate .= ' 23:59:59';

        $entrollCount =  DB::table('students')->where([                                                                                             
            ['created_at', '>=', $newFromDate],       
            ['created_at', '<=', $newToDate],       
            ])->count('id');
        $studentenrollVal = $entrollCount;
        $totalStudentenrollVal = $entrollCount;

        $dataset = [            
            'fromDateString' => $fromDateVal,
            'toDateValString' => $toDateVal,
            'fromDateSql' => $newFromDate,
            'toDateValSql' => $newToDate,
            'mediumVal' => $mediumVal,           
            'gradeVal' => $gradeVal,
            'studentVal' => $studentVal,           
            'studentenrollVal' => $studentenrollVal,           
            'totalStudentenrollVal' => $totalStudentenrollVal,           
            
        ];

        return view('pages.viewstudentreport')->with('dataset',$dataset);

    }

    public function studentreportPDF(Request $request){

        $fromDateString = $request->input('fromDateString');
        $toDateValString = $request->input('toDateValString');
        $fromDateSql = $request->input('fromDateSql');
        $toDateValSql = $request->input('toDateValSql');
        $mediumVal = $request->input('mediumVal');
        $gradeVal = $request->input('gradeVal');
        $studentVal = $request->input('studentVal');
        $studentenrollVal = $request->input('studentenrollVal');
        $totalStudentenrollVal = $request->input('totalStudentenrollVal');

        $pdf = App::make('dompdf.wrapper');
            
        $htmlData = '<style>
        .{font-family: Arial, Helvetica, sans-serif;}
        .tb_header{
            background-color: #AED6F1;
        }
        .tb_sectionheader{
            background-color:#45B39D;
        }

        .subtotal_tr{
            background-color:#82E0AA;
        }
        </style>
        <h2>Students Report</h2>';
        $htmlData .='<h4>From : <b>'.$fromDateString.'</b> To : <b>'.$toDateValString.'</b></h4>';
        $htmlData .='<h4>Students Enrolled : <b>'.$studentenrollVal.'</b></h4>';
        $htmlData .='<h4>Total Students Enrolled : <b>'.$totalStudentenrollVal.'</b></h4>';

        $htmlData .='<table>
        <tr class="tb_header">
            <th>Student</th>
            <th>Grade</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Address</th>
            <th>Joined Date</th>
            <th>No of Exams/Packages Purchased</th>
        </tr>';

        $studentsMainData =  DB::table('students')->where([                                                                                             
            ['created_at', '>=', $fromDateSql],       
            ['created_at', '<=', $toDateValSql],       
            ])->get();

        if(count($studentsMainData) > 0){
            foreach($studentsMainData as $studentEntry){

                $htmlData .='<tr>';
                $htmlData .='<td>'.$studentEntry->id.' - '.$studentEntry->studentname.'</td>';

                $transactionData = DB::table('studenttransactions')->where([                                                                                             
                    ['studentid', '>=',$studentEntry->id],    
                   
                    ])->get();
                if(count($transactionData) >0){
                    $htmlData .='<td>'.$transactionData[0]->grade.'</td>';
                }else{
                    $htmlData .='<td>No Grade Assigned</td>';
                }

                $htmlData .='<td>'.$studentEntry->telephone.'</td>';
                $htmlData .='<td>'.$studentEntry->email.'</td>';
                $htmlData .='<td>'.$studentEntry->address.'</td>';
                $joinedDate = substr($studentEntry->created_at,0,10);
                $htmlData .='<td>'.$joinedDate.'</td>';
                $productCount =  DB::table('studenttransactions')->where([                                                                                             
                    ['studentid', '>=',$studentEntry->id],   
                   
                    ])->count('id');
                    $htmlData .='<td>'.$productCount.'</td>';
                $htmlData .='</tr>';
            }   
        }

        $htmlData .='</table>';




        $pdf->loadHTML($htmlData);
        return $pdf->download('Purchase Report.pdf');        

    }

    public function genpromocodereport(Request $request){

        $promCode = $request->input('promocode');

        $dataset = [
            'promCode' => $promCode,
        ];

        return view('pages.viewpromocodereport')->with('dataset',$dataset);
    }

    public function promocodereportPDF(Request $request){

        $promCode = $request->input('promCode');

        $pdf = App::make('dompdf.wrapper');
            
        $htmlData = '<style>
        .{font-family: Arial, Helvetica, sans-serif;}
        .tb_header{
            background-color: #AED6F1;
            width:100%;
        }
        .tb_sectionheader{
            background-color:#45B39D;
        }

        .subtotal_tr{
            background-color:#82E0AA;
        }
        </style>
        <h2>Promo Codes Report</h2>';

        $htmlData .='<table width="100%">
        <thead>                  
                    <tr class="tb_header">     
                      <th>Student</th>              
                      <th>Subject / Package</th>
                      <th>Used On</th>
                     
                    </tr>
                  </thead>
                  <tbody>
        ';

        if($promCode == 'All'){
            $promoBasicData = DB::table('promocodes')->get();
          }else{
            $expledlist = explode(' - ',$promCode);
            $promoCodeId = $expledlist[0];
            $promoBasicData = DB::table('promocodes')->where([
                          ['id', '=', $promoCodeId],                                      
                          ])->get();
          }

          if(count($promoBasicData) > 0){


            foreach($promoBasicData as $promoEntry){

                $htmlData .='<tr class="tb_sectionheader">
                    <td colspan="3">Promo Code : <b>'.$promoEntry->promocode.'</b></td>
                </tr>
                <tr class="tb_sectionheader">
                    <td colspan="3">Promotion Type : <b>'.$promoEntry->promotype.'</b></td>
                </tr>

                <tr class="tb_sectionheader">
                <td colspan="3">Max Allocation Allowed : <b>'.$promoEntry->maxallowed.'</b></td>
                </tr>
                <tr class="tb_sectionheader">
                <td colspan="3">Consumed : <b>'.$promoEntry->totalused.'</b></td>
                </tr>';
                $htmlData .=' <tr class="tb_sectionheader">';
                if($promoEntry->status == 'A'){
                    $htmlData .=' <td colspan="3">Status : <b>Active</b></td>';
                }else{
                    $htmlData .=' <td colspan="3">Status : <b>Closed</b></td>';
                }
                $htmlData .=' </tr>';

                $promoCodeTransData = DB::table('promocodetrans')->where([
                    ['promocode', '=', $promoEntry->promocode],                                      
                    ])->get();

             
                    if(count($promoCodeTransData) > 0){

                        foreach($promoCodeTransData as $promtransentry){
                            $htmlData .='<tr>
                            <td>'.$promtransentry->studentid.'-'.$promtransentry->studentname.'</td>
                            <td>'.$promtransentry->productname.'</td>
                            <td>'.$promtransentry->created_at.'</td>
                          </tr>';
                        }
                    }
            }
          }

        $htmlData .='</table>';




        $pdf->loadHTML($htmlData);
        return $pdf->download('Promo Code Report.pdf');  

    }

    public function generateauditreport(Request $request){

        $this->validate($request, [      
            'fromdate' => 'required',
            'todate' => 'required',
        ]);

        $fromDateVal = $request->input('fromdate');
        $toDateVal = $request->input('todate');
        $action = $request->input('action');
        $actionon = $request->input('actionon');
        $donebyval = $request->input('doneby');
       

        $expldedList = explode('/',$fromDateVal);
        $newFromDate = $expldedList[2].'-'.$expldedList[1].'-'.$expldedList[0];
        $newFromDate_NT = $newFromDate;
        $newFromDate .= ' 00:00:01';

        $expldedList = explode('/',$toDateVal);
        $newToDate = $expldedList[2].'-'.$expldedList[1].'-'.$expldedList[0];
        $newToDate_NT = $newToDate;
      
        $newToDate .= ' 23:59:59';
            
        $dataset = [            
            'fromDateString' => $fromDateVal,
            'toDateValString' => $toDateVal,
            'fromDateSql' => $newFromDate,
            'toDateValSql' => $newToDate,
            'action' => $action,           
            'actionon' => $actionon,
            'donebyval' => $donebyval,           
                  
            
        ];

        return view('pages.viewauditreport')->with('dataset',$dataset);

    }
}



