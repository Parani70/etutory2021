<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamsSearchController extends Controller
{
    public function searchexamshome(Request $request)
    {
        
        $examname = $request->input('examname');
        $gradeval = $request->input('grade');
        $subjectval = $request->input('subject');

        
        $gradeid= '';
        if($gradeval != 'all'){
            $glist = explode('-', $gradeval);  
            $gradeid = $glist[1];
        } 

        $subjectid ='';
        
        if($subjectval != 'all'){
            $slist = explode('-', $subjectval);  
            $subjectid = $slist[1];
        } else{
            
        }
        
        $searchdata =      DB::table('papertemplates')->where([
            ['coursename' ,'like', $examname.'%'],
            ['gradename' ,'like', $gradeid.'%'],
            ['subjectname' ,'like', $subjectid.'%'],
        ])->get();

    
        $gradedata    = DB::table('grades')->get();
        $subjectdata    = DB::table('subjects')->get();

        $dataset = [
            'examsdata' => $searchdata,
            'gradedata' => $gradedata,
            'subjectdata' => $subjectdata,
        ];
       return view('pages.coursesexamspage')->with('dataset', $dataset);

    }

    public function searchpromohome(Request $request)
    {
        //NA
    }
}
