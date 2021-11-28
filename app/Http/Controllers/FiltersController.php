<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FiltersController extends Controller
{
    public function filteredapprove(Request $request){


        $questionqueu = array();
        $enteredbyid = Auth::user()->id;
        
        $examtype =  $request->input('examtype');
        $category =  $request->input('category');
        $subcategory =  $request->input('subcategory');
        $subject =  $request->input('subject');
        $grade =  $request->input('grade');
        $level =  $request->input('level');

        $reset =  $request->input('reset');

        if ($examtype == 'All') {
            $examtype = '%';
        } else {
            $exploded_list = explode('-', $request->input('examtype'));
            $examtype = $exploded_list[0].'%';
        }

        if ($category == 'All') {
            $category = '%';
        } else {
            $exploded_list = explode('-', $request->input('category'));
            $category = $exploded_list[0].'%';
        }

        if ($subcategory == 'All') {
            $subcategory = '%';
        } else {
            $exploded_list = explode('-', $request->input('subcategory'));
            $subcategory = $exploded_list[0].'%';
        }

        if ($subject == 'All') {
            $subject = '%';
        } else {
            $exploded_list = explode('-', $request->input('subject'));
            $subject = $exploded_list[0].'%';
        }
        if ($grade == 'All') {
            $grade = '%';
        } else {
            $exploded_list = explode('-', $request->input('grade'));
            $grade = $exploded_list[0].'%';
        }
        if ($level == 'All') {
            $level = '%';
        } else {
            $exploded_list = explode('-', $request->input('level'));
            $level = $exploded_list[0].'%';
        }

        if ($reset == 'reset') {
            $examtype = '%';
            $category = '%';
            $subcategory = '%';
            $subject = '%';
            $grade = '%';
            $level = '%';
        }

        $questionqueu = DB::table('questionsmain')->where([
            ['examtypeid', 'like', $examtype],
            ['categoryid', 'like', $category],
            ['subcategoryid', 'like', $subcategory],
            ['subjectid', 'like', $subject],
            ['gradeid', 'like', $grade],
            ['levelid', 'like', $level],
            ['enteredbyid', '=', $enteredbyid],
            ['status', '=', '1'],
        ])->get();

        $examtypedata    = DB::table('examtypes')->get();
        $categorydata    = DB::table('categories')->get();
        $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
        $subjectdata    = DB::table('subjects')->get();
        $gradedata    = DB::table('grades')->get();
        $leveldata   = DB::table('levels')->get();
        $userid = Auth::user()->id;
        $myDateFirst = Date('Y-m-') . '01';
        $myDateLast = Date('Y-m-t');

        $questionsThisMonth = DB::table('questionsmain')->where([
            ['enteredbyid', '=', $userid],
        ])->whereBetween('created_at', [$myDateFirst, $myDateLast])->count();
        $questionsApprovedThisMonth = DB::table('questionsmain')->where([
            ['enteredbyid', '=', $userid],
            ['status', '=', '1'],
        ])->whereBetween('created_at', [$myDateFirst, $myDateLast])->count();
        $accuracy = 0;
        if ($questionsThisMonth > 0) {
            $accuracy = floatval($questionsApprovedThisMonth) / floatval($questionsThisMonth) * 100;
        }

        $alowancedata = DB::table('users')->where('id', '=', Auth::user()->id)->get();
        $allowance = $alowancedata[0]->allowance;
        $eligibalAllwance = floatval($allowance) * floatval($questionsApprovedThisMonth);

        $accuracy =  round($accuracy, 2);

        $dataset = [
            'questiondata' => $questionqueu,            
            'examtypedata' => $examtypedata,
            'categorydata' => $categorydata,
            'subcategorydata' => $subcategorydata,
            'subjectdata' => $subjectdata,
            'gradedata' => $gradedata,
            'leveldata' => $leveldata,
            'questionsThisMonth' => $questionsThisMonth,
            'accuracy' => $accuracy,
            'alowance' => $eligibalAllwance,
        ];

        return view('pages.forapprovequestionsqueu')->with('dataset', $dataset);

    }

    public function filteronhold(Request $request){

        $questionqueu = array();
        $enteredbyid = Auth::user()->id;
        
        $examtype =  $request->input('examtype');
        $category =  $request->input('category');
        $subcategory =  $request->input('subcategory');
        $subject =  $request->input('subject');
        $grade =  $request->input('grade');
        $level =  $request->input('level');

        $reset =  $request->input('reset');

        if ($examtype == 'All') {
            $examtype = '%';
        } else {
            $exploded_list = explode('-', $request->input('examtype'));
            $examtype = $exploded_list[0].'%';
        }

        if ($category == 'All') {
            $category = '%';
        } else {
            $exploded_list = explode('-', $request->input('category'));
            $category = $exploded_list[0].'%';
        }

        if ($subcategory == 'All') {
            $subcategory = '%';
        } else {
            $exploded_list = explode('-', $request->input('subcategory'));
            $subcategory = $exploded_list[0].'%';
        }

        if ($subject == 'All') {
            $subject = '%';
        } else {
            $exploded_list = explode('-', $request->input('subject'));
            $subject = $exploded_list[0].'%';
        }
        if ($grade == 'All') {
            $grade = '%';
        } else {
            $exploded_list = explode('-', $request->input('grade'));
            $grade = $exploded_list[0].'%';
        }
        if ($level == 'All') {
            $level = '%';
        } else {
            $exploded_list = explode('-', $request->input('level'));
            $level = $exploded_list[0].'%';
        }

        if ($reset == 'reset') {
            $examtype = '%';
            $category = '%';
            $subcategory = '%';
            $subject = '%';
            $grade = '%';
            $level = '%';
        }

        $questionqueu = DB::table('questionsmain')->where([
            ['examtypeid', 'like', $examtype],
            ['categoryid', 'like', $category],
            ['subcategoryid', 'like', $subcategory],
            ['subjectid', 'like', $subject],
            ['gradeid', 'like', $grade],
            ['levelid', 'like', $level],
            ['enteredbyid', '=', $enteredbyid],
            ['status', '=', '2'],
        ])->get();

        $examtypedata    = DB::table('examtypes')->get();
        $categorydata    = DB::table('categories')->get();
        $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
        $subjectdata    = DB::table('subjects')->get();
        $gradedata    = DB::table('grades')->get();
        $leveldata   = DB::table('levels')->get();
        $userid = Auth::user()->id;
        $myDateFirst = Date('Y-m-') . '01';
        $myDateLast = Date('Y-m-t');

        $questionsThisMonth = DB::table('questionsmain')->where([
            ['enteredbyid', '=', $userid],
        ])->whereBetween('created_at', [$myDateFirst, $myDateLast])->count();
        $questionsApprovedThisMonth = DB::table('questionsmain')->where([
            ['enteredbyid', '=', $userid],
            ['status', '=', '1'],
        ])->whereBetween('created_at', [$myDateFirst, $myDateLast])->count();
        $accuracy = 0;
        if ($questionsThisMonth > 0) {
            $accuracy = floatval($questionsApprovedThisMonth) / floatval($questionsThisMonth) * 100;
        }

        $alowancedata = DB::table('users')->where('id', '=', Auth::user()->id)->get();
        $allowance = $alowancedata[0]->allowance;
        $eligibalAllwance = floatval($allowance) * floatval($questionsApprovedThisMonth);

        $accuracy =  round($accuracy, 2);

        $dataset = [
            'questiondata' => $questionqueu,            
            'examtypedata' => $examtypedata,
            'categorydata' => $categorydata,
            'subcategorydata' => $subcategorydata,
            'subjectdata' => $subjectdata,
            'gradedata' => $gradedata,
            'leveldata' => $leveldata,
            'questionsThisMonth' => $questionsThisMonth,
            'accuracy' => $accuracy,
            'alowance' => $eligibalAllwance,
        ];

        return view('pages.onholdquestionsqueu')->with('dataset', $dataset);

    }

    public function filtertobe(Request $request){

        $questionqueu = array();
        $enteredbyid = Auth::user()->id;
        
        $examtype =  $request->input('examtype');
        $category =  $request->input('category');
        $subcategory =  $request->input('subcategory');
        $subject =  $request->input('subject');
        $grade =  $request->input('grade');
        $level =  $request->input('level');

        $reset =  $request->input('reset');

        if ($examtype == 'All') {
            $examtype = '%';
        } else {
            $exploded_list = explode('-', $request->input('examtype'));
            $examtype = $exploded_list[0].'%';
        }

        if ($category == 'All') {
            $category = '%';
        } else {
            $exploded_list = explode('-', $request->input('category'));
            $category = $exploded_list[0].'%';
        }

        if ($subcategory == 'All') {
            $subcategory = '%';
        } else {
            $exploded_list = explode('-', $request->input('subcategory'));
            $subcategory = $exploded_list[0].'%';
        }

        if ($subject == 'All') {
            $subject = '%';
        } else {
            $exploded_list = explode('-', $request->input('subject'));
            $subject = $exploded_list[0].'%';
        }
        if ($grade == 'All') {
            $grade = '%';
        } else {
            $exploded_list = explode('-', $request->input('grade'));
            $grade = $exploded_list[0].'%';
        }
        if ($level == 'All') {
            $level = '%';
        } else {
            $exploded_list = explode('-', $request->input('level'));
            $level = $exploded_list[0].'%';
        }

        if ($reset == 'reset') {
            $examtype = '%';
            $category = '%';
            $subcategory = '%';
            $subject = '%';
            $grade = '%';
            $level = '%';
        }

        $questionqueu = DB::table('questionsmain')->where([
            ['examtypeid', 'like', $examtype],
            ['categoryid', 'like', $category],
            ['subcategoryid', 'like', $subcategory],
            ['subjectid', 'like', $subject],
            ['gradeid', 'like', $grade],
            ['levelid', 'like', $level],
            ['enteredbyid', '=', $enteredbyid],
            ['status', '=', '3'],
        ])->get();

        $examtypedata    = DB::table('examtypes')->get();
        $categorydata    = DB::table('categories')->get();
        $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
        $subjectdata    = DB::table('subjects')->get();
        $gradedata    = DB::table('grades')->get();
        $leveldata   = DB::table('levels')->get();
        $userid = Auth::user()->id;
        $myDateFirst = Date('Y-m-') . '01';
        $myDateLast = Date('Y-m-t');

        $questionsThisMonth = DB::table('questionsmain')->where([
            ['enteredbyid', '=', $userid],
        ])->whereBetween('created_at', [$myDateFirst, $myDateLast])->count();
        $questionsApprovedThisMonth = DB::table('questionsmain')->where([
            ['enteredbyid', '=', $userid],
            ['status', '=', '1'],
        ])->whereBetween('created_at', [$myDateFirst, $myDateLast])->count();
        $accuracy = 0;
        if ($questionsThisMonth > 0) {
            $accuracy = floatval($questionsApprovedThisMonth) / floatval($questionsThisMonth) * 100;
        }

        $alowancedata = DB::table('users')->where('id', '=', Auth::user()->id)->get();
        $allowance = $alowancedata[0]->allowance;
        $eligibalAllwance = floatval($allowance) * floatval($questionsApprovedThisMonth);

        $accuracy =  round($accuracy, 2);

        $dataset = [
            'questiondata' => $questionqueu,            
            'examtypedata' => $examtypedata,
            'categorydata' => $categorydata,
            'subcategorydata' => $subcategorydata,
            'subjectdata' => $subjectdata,
            'gradedata' => $gradedata,
            'leveldata' => $leveldata,
            'questionsThisMonth' => $questionsThisMonth,
            'accuracy' => $accuracy,
            'alowance' => $eligibalAllwance,
        ];

        return view('pages.savedquestionsqueu')->with('dataset', $dataset);


    }

    public function filterreject(Request $request)
    {
        $questionqueu = array();
        $enteredbyid = Auth::user()->id;
        
        $examtype =  $request->input('examtype');
        $category =  $request->input('category');
        $subcategory =  $request->input('subcategory');
        $subject =  $request->input('subject');
        $grade =  $request->input('grade');
        $level =  $request->input('level');

        $reset =  $request->input('reset');

        if ($examtype == 'All') {
            $examtype = '%';
        } else {
            $exploded_list = explode('-', $request->input('examtype'));
            $examtype = $exploded_list[0].'%';
        }

        if ($category == 'All') {
            $category = '%';
        } else {
            $exploded_list = explode('-', $request->input('category'));
            $category = $exploded_list[0].'%';
        }

        if ($subcategory == 'All') {
            $subcategory = '%';
        } else {
            $exploded_list = explode('-', $request->input('subcategory'));
            $subcategory = $exploded_list[0].'%';
        }

        if ($subject == 'All') {
            $subject = '%';
        } else {
            $exploded_list = explode('-', $request->input('subject'));
            $subject = $exploded_list[0].'%';
        }
        if ($grade == 'All') {
            $grade = '%';
        } else {
            $exploded_list = explode('-', $request->input('grade'));
            $grade = $exploded_list[0].'%';
        }
        if ($level == 'All') {
            $level = '%';
        } else {
            $exploded_list = explode('-', $request->input('level'));
            $level = $exploded_list[0].'%';
        }

        if ($reset == 'reset') {
            $examtype = '%';
            $category = '%';
            $subcategory = '%';
            $subject = '%';
            $grade = '%';
            $level = '%';
        }

        $questionqueu = DB::table('questionsmain')->where([
            ['examtypeid', 'like', $examtype],
            ['categoryid', 'like', $category],
            ['subcategoryid', 'like', $subcategory],
            ['subjectid', 'like', $subject],
            ['gradeid', 'like', $grade],
            ['levelid', 'like', $level],
            ['enteredbyid', '=', $enteredbyid],
            ['status', '=', '4'],
        ])->get();

        $examtypedata    = DB::table('examtypes')->get();
        $categorydata    = DB::table('categories')->get();
        $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
        $subjectdata    = DB::table('subjects')->get();
        $gradedata    = DB::table('grades')->get();
        $leveldata   = DB::table('levels')->get();
        $userid = Auth::user()->id;
        $myDateFirst = Date('Y-m-') . '01';
        $myDateLast = Date('Y-m-t');

        $questionsThisMonth = DB::table('questionsmain')->where([
            ['enteredbyid', '=', $userid],
        ])->whereBetween('created_at', [$myDateFirst, $myDateLast])->count();
        $questionsApprovedThisMonth = DB::table('questionsmain')->where([
            ['enteredbyid', '=', $userid],
            ['status', '=', '1'],
        ])->whereBetween('created_at', [$myDateFirst, $myDateLast])->count();
        $accuracy = 0;
        if ($questionsThisMonth > 0) {
            $accuracy = floatval($questionsApprovedThisMonth) / floatval($questionsThisMonth) * 100;
        }

        $alowancedata = DB::table('users')->where('id', '=', Auth::user()->id)->get();
        $allowance = $alowancedata[0]->allowance;
        $eligibalAllwance = floatval($allowance) * floatval($questionsApprovedThisMonth);

        $accuracy =  round($accuracy, 2);

        $dataset = [
            'questiondata' => $questionqueu,            
            'examtypedata' => $examtypedata,
            'categorydata' => $categorydata,
            'subcategorydata' => $subcategorydata,
            'subjectdata' => $subjectdata,
            'gradedata' => $gradedata,
            'leveldata' => $leveldata,
            'questionsThisMonth' => $questionsThisMonth,
            'accuracy' => $accuracy,
            'alowance' => $eligibalAllwance,
        ];

        return view('pages.rejectedquestionsqueu')->with('dataset', $dataset);


    }
}
