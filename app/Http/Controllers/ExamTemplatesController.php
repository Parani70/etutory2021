<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamTemplatesController extends Controller
{
    public function editexamtemplate($id){

        $examTemplateData = DB::table('papertemplates')->where('id', '=', $id)->get();
        $examTeplateSubDate = DB::table('papertemplatesdata')->where('templateid', '=', $id)->get();

        $examtypedata    = DB::table('examtypes')->get();
        $subjectdata    = DB::table('subjects')->get();
        $gradedata    = DB::table('grades')->get();
        $leveldata   = DB::table('levels')->get();
        $categorydata    = DB::table('categories')->get();
        $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();

        $subQsCountTotal = DB::table('papertemplatesdata')->where('id', '=', $id)->sum('qscount');

        $dataset = [
            'examTemplateData' => $examTemplateData,
            'examTeplateSubDate' => $examTeplateSubDate,
            'subQsCountTotal' => $subQsCountTotal,
            'examtypedata' => $examtypedata,
            'subjectdata' => $subjectdata,
            'gradedata' => $gradedata,
            'leveldata' => $leveldata,
            'categorydata' => $categorydata,
            'subcategorydata' => $subcategorydata,
        ];

        
        return view('pages.manageexamtemplate')->with('dataset',$dataset);

    }

    public function updatepapertemplate(Request $request){

        $this->validate($request, [
            'examtype'  => 'required|not_in:-- Choose User Option --',
            'subject'  => 'required|not_in:-- Choose User Option --',
            'grade'  => 'required|not_in:-- Choose User Option --',
            'language'  => 'required|not_in:-- Choose User Option --',        
            
            'noofquestions' => 'required',
            'durationhr' => 'required',
            'durationmin' => 'required',
        ]);

        //update the main entries
        $examid = $request->input('examid');
        $coursename = $request->input('coursename');
        $numberofquestion = $request->input('noofquestions');
        $questionentrycount = $request->input('questionentrycount');
        $durationhr = $request->input('durationhr');
        $durationmin = $request->input('durationmin');
        $userlang = $request->input('language');

        if ($durationhr == '') {
            $durationhr = 0;
        }

        if ($durationmin == '') {
            $durationmin = 0;
        }

        $exploded_list = explode('-', $request->input('examtype'));
        $examtypeid = $exploded_list[0];
        $examtypename = $exploded_list[1];

        $exploded_list = explode('-', $request->input('subject'));
        $subjectid = $exploded_list[0];
        $subjectname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('grade'));
        $gradeid = $exploded_list[0];
        $gradename = $exploded_list[1];

        $templatestatus = $request->input('status');

        
        DB::table('papertemplates')
            ->where('id', $examid)
            ->update([
                'coursename' => $coursename,
                'examtypeid' => $examtypeid,
                'examtypename' => $examtypename,
                'subjectid' => $subjectid,
                'subjectname' => $subjectname,
                'gradeid' => $gradeid,
                'gradename' => $gradename,
                'numberofquestion' => $numberofquestion,
                'durationhour' => $durationhr,
                'durationminute' => $durationmin,
                'userlang' => $userlang,
                'status' => $templatestatus,
                'updated_at' => NOW(),
            ]);

        //remove prevouse sub entries
        DB::table('papertemplatesdata')->where('templateid', '=',  $examid)->delete();

        $i = 1;
        while ($questionentrycount >= $i) {

            $exploded_list = explode('-', $request->input('category' . $i));
            $categoryid = $exploded_list[0];
            $categoryname = $exploded_list[1];
            $exploded_list = explode('-', $request->input('subcategory' . $i));
            $subcategoryid = $exploded_list[0];
            $subcategoryname = $exploded_list[1];
            $exploded_list = explode('-', $request->input('level' . $i));
            $levelid = $exploded_list[0];
            $levelname = $exploded_list[1];

            $qstype = $request->input('qstype' . $i);
            $qscount = $request->input('qscount' . $i);

            DB::table('papertemplatesdata')->insert(
                [
                    'templateid' => $examid,
                    'categoryid' => $categoryid,
                    'categoryname' => $categoryname,
                    'subcategoryid' => $subcategoryid,
                    'subcategoryname' => $subcategoryname,
                    'levelid' => $levelid,
                    'levelname' => $levelname,
                    'qstype' => $qstype,
                    'qscount' => $qscount,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ]
            );


            $i++;
        }

        $papertemplates    = DB::table('papertemplates')->get();
        $examtypedata    = DB::table('examtypes')->get();
        $categorydata    = DB::table('categories')->get();
        $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
        $subjectdata    = DB::table('subjects')->get();
        $gradedata    = DB::table('grades')->get();
        $leveldata   = DB::table('levels')->get();

        $dataset = [
            'papertemplates' => $papertemplates,
            'examtypedata' => $examtypedata,
            'categorydata' => $categorydata,
            'subcategorydata' => $subcategorydata,
            'subjectdata' => $subjectdata,
            'gradedata' => $gradedata,
            'leveldata' => $leveldata,
        ];

        return view('pages.examtemplates')->with('dataset', $dataset);

    }

    public function removetemplate($id){

        DB::table('papertemplates')->where('id', '=',  $id)->delete();
        DB::table('papertemplatesdata')->where('templateid', '=',  $id)->delete();

        $papertemplates    = DB::table('papertemplates')->get();
        $examtypedata    = DB::table('examtypes')->get();
        $categorydata    = DB::table('categories')->get();
        $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
        $subjectdata    = DB::table('subjects')->get();
        $gradedata    = DB::table('grades')->get();
        $leveldata   = DB::table('levels')->get();

        $dataset = [
            'papertemplates' => $papertemplates,
            'examtypedata' => $examtypedata,
            'categorydata' => $categorydata,
            'subcategorydata' => $subcategorydata,
            'subjectdata' => $subjectdata,
            'gradedata' => $gradedata,
            'leveldata' => $leveldata,
        ];

        return view('pages.examtemplates')->with('dataset', $dataset);


    }

    public function ajaxrequest(Request $request)
    {
            
        

    }
    
}


