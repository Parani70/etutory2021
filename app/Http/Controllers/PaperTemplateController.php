<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaperTemplateController extends Controller
{
    public function savepapertemplate(Request $request)
    {

        $this->validate($request, [
            'examtype'  => 'required|not_in:-- Choose User Option --',
            'subject'  => 'required|not_in:-- Choose User Option --',
            'grade'  => 'required|not_in:-- Choose User Option --',
            'language'  => 'required|not_in:-- Choose User Option --',
            'category'  => 'required|not_in:-- Choose User Option --',
            'subcategory'  => 'required|not_in:-- Choose User Option --',
            'level'  => 'required|not_in:-- Choose User Option --',
            'qstype'  => 'required|not_in:-- Choose User Option --',
            'noofquestions' => 'required',
            'durationhr' => 'required',
            'durationmin' => 'required',
        ]);

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


        $templateid = DB::table('papertemplates')->insertGetId(
            [
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
                'status' => 'A',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

       

        $i = 1;
        $p=0;
        //while ($questionentrycount >= $i) {
        while ($questionentrycount > $p) {

            $exactvalue = $request->input('idposition' . $p);
            if( $exactvalue != 'D'){
                $i = $exactvalue;
                $i++;

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
                    'templateid' => $templateid,
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

            }
            
            $i++;
            $p++;
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
}
