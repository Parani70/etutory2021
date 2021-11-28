<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class QuestionsController extends Controller
{
    public function savemcqquestion(Request $request)
    {

        $this->validate($request, [
            'examtype'  => 'required|not_in:-- Choose User Option --',
            'category'  => 'required|not_in:-- Choose User Option --',
            'subcategory'  => 'required|not_in:-- Choose User Option --',
            'answerscount'  => 'required|not_in:-- Choose User Option --',
            'subject'  => 'required|not_in:-- Choose User Option --',
            'grade'  => 'required|not_in:-- Choose User Option --',
            'level'  => 'required|not_in:-- Choose User Option --',
            'correctanswerscount'  => 'required|not_in:-- Choose User Option --',
            'questionheader' => 'required',            
            'allocatedmarks' => 'required',
        ]);

        $qsType = "MCQ";
        $qsStatus = 0;
        if ($request->input('save') == 'save') {
            //Save the question
            $qsStatus = 3;
        } elseif ($request->input('forapproval') == 'forapproval') {
            $qsStatus = 1;
        } else {
            print_r('<h1 style="color:red;">save button  not clicked</h1>');
        }

        $exploded_list = explode('-', $request->input('examtype'));
        $examtypeid = $exploded_list[0];
        $examtypename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('category'));
        $categoryid = $exploded_list[0];
        $categoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subcategory'));
        $subcategoryid = $exploded_list[0];
        $subcategoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subject'));
        $subjectid = $exploded_list[0];
        $subjectname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('grade'));
        $gradeid = $exploded_list[0];
        $gradename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('level'));
        $levelid = $exploded_list[0];
        $levelname = $exploded_list[1];
        $answerscount = $request->input('answerscount');
        $correctanswerscount = $request->input('correctanswerscount');
        $questionheader = $request->input('questionheader');
        $imageposition = 'NA';
        $image = 'NA';
        if ($request->hasFile('questionimage')) {
            $imageupload = 'Y';
            $imageposition = $request->input('imageposition');
            $imageFile = $request->file('questionimage')->getClientOriginalName();
            $imageFileName = pathinfo($imageFile, PATHINFO_FILENAME);
            $imageFileExtention = $request->file('questionimage')->getClientOriginalExtension();

            $fileNameToStore = $imageFileName . '_' . time() . '.' . $imageFileExtention;
            // $imageFileName = 'question_mcq'.$imageFile.getClientOriginalExtension();
            //$path = $request->file('questionimage')->storeAs('public/question_images', $fileNameToStore);
            $file = request()->file('questionimage');
            $image  = $file->store('question_images', ['disk' => 'mypublic']);
            //$image = $fileNameToStore; 
        } else {
            $imageupload = 'N';
        }

        $allocatedmarks = $request->input('allocatedmarks');
        $negativemarks = $request->input('negativemarks');

        if($negativemarks==''){
            $negativemarks =0;
        }
        $userid = Auth::user()->id;
        $userName = Auth::user()->name;
        $userlanguage = Auth::user()->language1;

        $questionid = DB::table('questionsmain')->insertGetId(
            [
                'qstype' => $qsType,
                'examtypeid' => $examtypeid,
                'examtypename' => $examtypename,
                'categoryid' => $categoryid,
                'categoryname' => $categoryname,
                'subcategoryid' => $subcategoryid,
                'subcategoryname' => $subcategoryname,
                'subjectid' => $subjectid,
                'subjectname' => $subjectname,
                'gradeid' => $gradeid,
                'gradename' => $gradename,
                'levelid' => $levelid,
                'levelname' => $levelname,
                'questionheader' => $questionheader,
                'imageupload' => $imageupload,
                'imageurl' => $image,
                'imageposition' => $imageposition,
                'marksallocated' => $allocatedmarks,
                'marksnegative' => $negativemarks,
                'status' => $qsStatus,
                'userlanguage' => $userlanguage,
                'enteredbyid' => $userid,
                'enteredbyname' => $userName,
                'approvedbyid' => 'NA',
                'approvedbyname' => 'NA',
                'deaccuracy' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

       

        //Save Answers details
        $a = 1;
        while ($answerscount >= $a) {

            $answer = $request->input('answer' . $a);
            $answerimageupload = 'N';
            $imageUrl = 'N';
            if ($request->hasFile('answerimage' . $a)) {
                $answerimageupload = 'Y';
                $imageFile = $request->file('answerimage' . $a)->getClientOriginalName();
                $imageFileName = pathinfo($imageFile, PATHINFO_FILENAME);
                $imageFileExtention = $request->file('answerimage' . $a)->getClientOriginalExtension();

                $fileNameToStore = $imageFileName . '_answer_' . time() . '.' . $imageFileExtention;
                // $imageFileName = 'question_mcq'.$imageFile.getClientOriginalExtension();
                //$path = $request->file('answerimage' . $a)->storeAs('public/question_images', $fileNameToStore);
               // $imageUrl = $fileNameToStore;
                $file = request()->file('answerimage' . $a);
                $imageUrl  = $file->store('question_images', ['disk' => 'mypublic']);
            } else {
                $answerimageupload = 'N';
            }

            $correctCheck = 'N';
            if ($request->has('correctanswercheck' . $a)) {
                $correctCheck = 'Y';
            }

            DB::table('questions_mcq')->insert(
                [
                    'qsid' => $questionid,
                    'answerscount' => $answerscount,
                    'correctanswersacount' => $correctanswerscount,
                    'answernumber' => $a,
                    'answer' => $answer,
                    'imageupload' => $answerimageupload,
                    'imageurl' => $imageUrl,
                    'correct' => $correctCheck,
                    'status' => 'A',
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ]
            );

            $a++;
        }

        //Audit Entry
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $userid,
                'username' => $userName,
                'action' => 'create_question',
                'actionon' => 'MCQ Question',
                'actiononentry' => $questionid,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );


        $examtypedata    = DB::table('examtypes')->get();
        $categorydata    = DB::table('categories')->get();
        $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categoryid)->get();
        $subjectdata    = DB::table('subjects')->get();
        $gradedata    = DB::table('grades')->get();
        $leveldata   = DB::table('levels')->get();

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
            'examtypedata' => $examtypedata,
            'categorydata' => $categorydata,
            'subcategorydata' => $subcategorydata,
            'subjectdata' => $subjectdata,
            'gradedata' => $gradedata,
            'leveldata' => $leveldata,           
            'presettings' => 'true',
            'pre_examtype' => $examtypeid,
            'pre_category' => $categoryid,
            'pre_subcategory' => $subcategoryid,
            'pre_answercount' => $answerscount,
            'pre_subject' => $subjectid,
            'pre_grade' => $gradeid,
            'pre_level' => $levelid,
            'pre_correctanswercount' => $correctanswerscount,
            'questionsThisMonth' => $questionsThisMonth,
            'accuracy' => $accuracy,
            'alowance' => $eligibalAllwance,
        ];

        return view('pages.entermcqquestion')->with('dataset', $dataset);

        // return redirect('/entermcqquestion')->with('selectid','2');


    }

    public function savetruefalsequestion(Request $request)
    {

        $this->validate($request, [
            'examtype'  => 'required|not_in:-- Choose User Option --',
            'category'  => 'required|not_in:-- Choose User Option --',
            'subcategory'  => 'required|not_in:-- Choose User Option --',
            'subject'  => 'required|not_in:-- Choose User Option --',
            'grade'  => 'required|not_in:-- Choose User Option --',
            'level'  => 'required|not_in:-- Choose User Option --',            
            'questionheader' => 'required',
            'q1' => 'required',
            'q2' => 'required',
            'q3' => 'required',
            'q4' => 'required',
            'q5' => 'required',
            'allocatedmarks' => 'required',
        ]);

        //Save True and False Question
        $qsType = "TRUEFALSE";
        $qsStatus = 0;
        if ($request->input('save') == 'save') {
            //Save the question
            $qsStatus = 3;
        } elseif ($request->input('forapproval') == 'forapproval') {
            $qsStatus = 1;
        } else {
            print_r('<h1 style="color:red;">save button  not clicked</h1>');
        }

        $exploded_list = explode('-', $request->input('examtype'));
        $examtypeid = $exploded_list[0];
        $examtypename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('category'));
        $categoryid = $exploded_list[0];
        $categoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subcategory'));
        $subcategoryid = $exploded_list[0];
        $subcategoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subject'));
        $subjectid = $exploded_list[0];
        $subjectname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('grade'));
        $gradeid = $exploded_list[0];
        $gradename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('level'));
        $levelid = $exploded_list[0];
        $levelname = $exploded_list[1];
        $answerscount = $request->input('questionscount');
        $correctanswerscount = 'NA';
        $questionheader = $request->input('questionheader');
        $imageposition = 'NA';
        $image = 'NA';
        $imageupload = 'NA';
        $allocatedmarks = $request->input('allocatedmarks');

        $userid = Auth::user()->id;
        $userName = Auth::user()->name;
        $userlanguage = Auth::user()->language1;

        DB::table('questionsmain')->insert(
            [
                'qstype' => $qsType,
                'examtypeid' => $examtypeid,
                'examtypename' => $examtypename,
                'categoryid' => $categoryid,
                'categoryname' => $categoryname,
                'subcategoryid' => $subcategoryid,
                'subcategoryname' => $subcategoryname,
                'subjectid' => $subjectid,
                'subjectname' => $subjectname,
                'gradeid' => $gradeid,
                'gradename' => $gradename,
                'levelid' => $levelid,
                'levelname' => $levelname,
                'questionheader' => $questionheader,
                'imageupload' => $imageupload,
                'imageurl' => $image,
                'imageposition' => $imageposition,
                'marksallocated' => $allocatedmarks,
                'status' => $qsStatus,
                'userlanguage' => $userlanguage,
                'enteredbyid' => $userid,
                'enteredbyname' => $userName,
                'approvedbyid' => 'NA',
                'approvedbyname' => 'NA',
                'deaccuracy' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        $questionid = DB::table('questionsmain')->max('id');
        //Save Answers details
        $a = 1;
        while ($answerscount >= $a) {

            $answer = $request->input('q' . $a);
            $correctCheck = 'False';
            if ($request->input('qoption' . $a) == 'True') {
                $correctCheck = 'True';
            }

            DB::table('questions_truefalse')->insert(
                [
                    'qsid' => $questionid,
                    'answerscount' => $answerscount,
                    'answernumber' => $a,
                    'answer' => $answer,
                    'correct' => $correctCheck,
                    'status' => 'A',
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ]
            );

            $a++;
        }

        //Audit Entry
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $userid,
                'username' => $userName,
                'action' => 'create_question',
                'actionon' => 'True/False Question',
                'actiononentry' => $questionid,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        $examtypedata    = DB::table('examtypes')->get();
        $categorydata    = DB::table('categories')->get();
        $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categoryid)->get();
        $subjectdata    = DB::table('subjects')->get();
        $gradedata    = DB::table('grades')->get();
        $leveldata   = DB::table('levels')->get();
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
            'examtypedata' => $examtypedata,
            'categorydata' => $categorydata,
            'subcategorydata' => $subcategorydata,
            'subjectdata' => $subjectdata,
            'gradedata' => $gradedata,
            'leveldata' => $leveldata,
            'presettings' => 'true',
            'pre_examtype' => $examtypeid,
            'pre_category' => $categoryid,
            'pre_subcategory' => $subcategoryid,
            'pre_answercount' => $answerscount,
            'pre_subject' => $subjectid,
            'pre_grade' => $gradeid,
            'pre_level' => $levelid,
            'pre_correctanswercount' => $correctanswerscount,
            'questionsThisMonth' => $questionsThisMonth,
            'accuracy' => $accuracy,
            'alowance' => $eligibalAllwance,
        ];

        return view('pages.entertruefalsequestion')->with('dataset', $dataset);
    }

    public function savematchingquestion(Request $request)
    {

        $this->validate($request, [
            'examtype'  => 'required|not_in:-- Choose User Option --',
            'category'  => 'required|not_in:-- Choose User Option --',
            'subcategory'  => 'required|not_in:-- Choose User Option --',
            'subject'  => 'required|not_in:-- Choose User Option --',
            'grade'  => 'required|not_in:-- Choose User Option --',
            'level'  => 'required|not_in:-- Choose User Option --',   
            'questionheader' => 'required',
            'mainq1' => 'required',
            'mainq2' => 'required',
            'mainq3' => 'required',
            'mainq4' => 'required',
            'mainq5' => 'required',
            'counterq1' => 'required',
            'counterq2' => 'required',
            'counterq3' => 'required',
            'counterq4' => 'required',
            'counterq5' => 'required',
            'allocatedmarks' => 'required',
        ]);

        //Save Matching Question
        $qsType = "MATCHING";
        $qsStatus = 0;
        if ($request->input('save') == 'save') {
            //Save the question
            $qsStatus = 3;
        } elseif ($request->input('forapproval') == 'forapproval') {
            $qsStatus = 1;
        } else {
            print_r('<h1 style="color:red;">save button  not clicked</h1>');
        }

        $exploded_list = explode('-', $request->input('examtype'));
        $examtypeid = $exploded_list[0];
        $examtypename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('category'));
        $categoryid = $exploded_list[0];
        $categoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subcategory'));
        $subcategoryid = $exploded_list[0];
        $subcategoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subject'));
        $subjectid = $exploded_list[0];
        $subjectname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('grade'));
        $gradeid = $exploded_list[0];
        $gradename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('level'));
        $levelid = $exploded_list[0];
        $levelname = $exploded_list[1];
        $answerscount = $request->input('questionscount');
        $correctanswerscount = 'NA';
        $questionheader = $request->input('questionheader');
        $imageposition = 'NA';
        $image = 'NA';
        $imageupload = 'NA';
        $allocatedmarks = $request->input('allocatedmarks');

        $userid = Auth::user()->id;
        $userName = Auth::user()->name;
        $userlanguage = Auth::user()->language1;

        DB::table('questionsmain')->insert(
            [
                'qstype' => $qsType,
                'examtypeid' => $examtypeid,
                'examtypename' => $examtypename,
                'categoryid' => $categoryid,
                'categoryname' => $categoryname,
                'subcategoryid' => $subcategoryid,
                'subcategoryname' => $subcategoryname,
                'subjectid' => $subjectid,
                'subjectname' => $subjectname,
                'gradeid' => $gradeid,
                'gradename' => $gradename,
                'levelid' => $levelid,
                'levelname' => $levelname,
                'questionheader' => $questionheader,
                'imageupload' => $imageupload,
                'imageurl' => $image,
                'imageposition' => $imageposition,
                'marksallocated' => $allocatedmarks,
                'status' => $qsStatus,
                'userlanguage' => $userlanguage,
                'enteredbyid' => $userid,
                'enteredbyname' => $userName,
                'approvedbyid' => 'NA',
                'approvedbyname' => 'NA',
                'deaccuracy' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        $questionid = DB::table('questionsmain')->max('id');
        //Save Answers details
        $a = 1;
        while ($answerscount >= $a) {

            $mainq = $request->input('mainq' . $a);
            $counterq = $request->input('counterq' . $a);
            $matchingq = $request->input('matchingq' . $a);

            //Save Main Q Entry
            DB::table('questions_matching')->insert(
                [
                    'qsid' => $questionid,
                    'answerscount' => $answerscount,
                    'answernumber' => 'Q' . $a,
                    'answer' => $mainq,
                    'side' => '1',
                    'matchinganswer' => 'NA',
                    'status' => 'A',
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ]
            );

            //Save Counter Q Entry
            DB::table('questions_matching')->insert(
                [
                    'qsid' => $questionid,
                    'answerscount' => $answerscount,
                    'answernumber' => '' . $a,
                    'answer' => $counterq,
                    'side' => '2',
                    'matchinganswer' => $matchingq,
                    'status' => 'A',
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ]
            );

            $a++;
        }


        //Audit Entry
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $userid,
                'username' => $userName,
                'action' => 'create_question',
                'actionon' => 'Matching Question',
                'actiononentry' => $questionid,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );
        
        $examtypedata    = DB::table('examtypes')->get();
        $categorydata    = DB::table('categories')->get();
        $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categoryid)->get();
        $subjectdata    = DB::table('subjects')->get();
        $gradedata    = DB::table('grades')->get();
        $leveldata   = DB::table('levels')->get();
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
            'examtypedata' => $examtypedata,
            'categorydata' => $categorydata,
            'subcategorydata' => $subcategorydata,
            'subjectdata' => $subjectdata,
            'gradedata' => $gradedata,
            'leveldata' => $leveldata,
            'presettings' => 'true',
            'pre_examtype' => $examtypeid,
            'pre_category' => $categoryid,
            'pre_subcategory' => $subcategoryid,
            'pre_answercount' => $answerscount,
            'pre_subject' => $subjectid,
            'pre_grade' => $gradeid,
            'pre_level' => $levelid,
            'pre_correctanswercount' => $correctanswerscount,
            'questionsThisMonth' => $questionsThisMonth,
            'accuracy' => $accuracy,
            'alowance' => $eligibalAllwance,
        ];

        return view('pages.entermatchingquestion')->with('dataset', $dataset);
    }

    public function saveshortquestion(Request $request)
    {

        $this->validate($request, [
            'examtype'  => 'required|not_in:-- Choose User Option --',
            'category'  => 'required|not_in:-- Choose User Option --',
            'subcategory'  => 'required|not_in:-- Choose User Option --',
            'subject'  => 'required|not_in:-- Choose User Option --',
            'grade'  => 'required|not_in:-- Choose User Option --',
            'level'  => 'required|not_in:-- Choose User Option --',   
            'questionheader' => 'required',
            'answer' => 'required',
            'allocatedmarks' => 'required',
        ]);
        //Save Short Answer Question
        $qsType = "SHORT";
        $qsStatus = 0;
        if ($request->input('save') == 'save') {
            //Save the question
            $qsStatus = 3;
        } elseif ($request->input('forapproval') == 'forapproval') {
            $qsStatus = 1;
        } else {
            print_r('<h1 style="color:red;">save button  not clicked</h1>');
        }

        $exploded_list = explode('-', $request->input('examtype'));
        $examtypeid = $exploded_list[0];
        $examtypename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('category'));
        $categoryid = $exploded_list[0];
        $categoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subcategory'));
        $subcategoryid = $exploded_list[0];
        $subcategoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subject'));
        $subjectid = $exploded_list[0];
        $subjectname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('grade'));
        $gradeid = $exploded_list[0];
        $gradename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('level'));
        $levelid = $exploded_list[0];
        $levelname = $exploded_list[1];
        $answerscount = 'NA';
        $correctanswerscount = 'NA';
        $questionheader = $request->input('questionheader');
        $imageposition = 'NA';
        $image = 'NA';
        $imageupload = 'NA';
        $allocatedmarks = $request->input('allocatedmarks');

        $userid = Auth::user()->id;
        $userName = Auth::user()->name;
$userlanguage = Auth::user()->language1;

        DB::table('questionsmain')->insert(
            [
                'qstype' => $qsType,
                'examtypeid' => $examtypeid,
                'examtypename' => $examtypename,
                'categoryid' => $categoryid,
                'categoryname' => $categoryname,
                'subcategoryid' => $subcategoryid,
                'subcategoryname' => $subcategoryname,
                'subjectid' => $subjectid,
                'subjectname' => $subjectname,
                'gradeid' => $gradeid,
                'gradename' => $gradename,
                'levelid' => $levelid,
                'levelname' => $levelname,
                'questionheader' => $questionheader,
                'imageupload' => $imageupload,
                'imageurl' => $image,
                'imageposition' => $imageposition,
                'marksallocated' => $allocatedmarks,
                'status' => $qsStatus,
                'userlanguage' => $userlanguage,
                'enteredbyid' => $userid,
                'enteredbyname' => $userName,
                'approvedbyid' => 'NA',
                'approvedbyname' => 'NA',
                'deaccuracy' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        $questionid = DB::table('questionsmain')->max('id');
        //Save Answers details
        $shortAnswer = $request->input('answer');
        DB::table('questions_short')->insert(

            [
                'qsid' => $questionid,
                'shortanswer' => $shortAnswer,
                'status' => 'A',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        //Audit Entry
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $userid,
                'username' => $userName,
                'action' => 'create_question',
                'actionon' => 'Short Answer Question',
                'actiononentry' => $questionid,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        $examtypedata    = DB::table('examtypes')->get();
        $categorydata    = DB::table('categories')->get();
        $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categoryid)->get();
        $subjectdata    = DB::table('subjects')->get();
        $gradedata    = DB::table('grades')->get();
        $leveldata   = DB::table('levels')->get();

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
            'examtypedata' => $examtypedata,
            'categorydata' => $categorydata,
            'subcategorydata' => $subcategorydata,
            'subjectdata' => $subjectdata,
            'gradedata' => $gradedata,
            'leveldata' => $leveldata,
            'presettings' => 'true',
            'pre_examtype' => $examtypeid,
            'pre_category' => $categoryid,
            'pre_subcategory' => $subcategoryid,
            'pre_answercount' => $answerscount,
            'pre_subject' => $subjectid,
            'pre_grade' => $gradeid,
            'pre_level' => $levelid,
            'pre_correctanswercount' => $correctanswerscount,
            'questionsThisMonth' => $questionsThisMonth,
            'accuracy' => $accuracy,
            'alowance' => $eligibalAllwance,
        ];

        return view('pages.entershortquestion')->with('dataset', $dataset);
    }

    public function saveessayquestion(Request $request)
    {

        $penentries = $request->input('penentries');
        $tokenid = $request->input('essayentryidval');
        if($penentries > 0){

            $this->validate($request, [
                'examtype'  => 'required|not_in:-- Choose User Option --',
                'category'  => 'required|not_in:-- Choose User Option --',
                'subcategory'  => 'required|not_in:-- Choose User Option --',
                'subject'  => 'required|not_in:-- Choose User Option --',
                'grade'  => 'required|not_in:-- Choose User Option --',
                'level'  => 'required|not_in:-- Choose User Option --',   
                'questionheader' => 'required',
               
                'allocatedmarks' => 'required',
            ]);

        }else{
            $this->validate($request, [
                'examtype'  => 'required|not_in:-- Choose User Option --',
                'category'  => 'required|not_in:-- Choose User Option --',
                'subcategory'  => 'required|not_in:-- Choose User Option --',
                'subject'  => 'required|not_in:-- Choose User Option --',
                'grade'  => 'required|not_in:-- Choose User Option --',
                'level'  => 'required|not_in:-- Choose User Option --',   
                'questionheader' => 'required',
                'answerguid' => 'required',
                'allocatedmarks' => 'required',
            ]);
        }

        

        //Save Short Answer Question
        $qsType = "ESSAY";
        $qsStatus = 0;
        if ($request->input('save') == 'save') {
            //Save the question
            $qsStatus = 3;
        } elseif ($request->input('forapproval') == 'forapproval') {
            $qsStatus = 1;
        } else {
            print_r('<h1 style="color:red;">save button  not clicked</h1>');
        }


       

        $exploded_list = explode('-', $request->input('examtype'));
        $examtypeid = $exploded_list[0];
        $examtypename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('category'));
        $categoryid = $exploded_list[0];
        $categoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subcategory'));
        $subcategoryid = $exploded_list[0];
        $subcategoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subject'));
        $subjectid = $exploded_list[0];
        $subjectname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('grade'));
        $gradeid = $exploded_list[0];
        $gradename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('level'));
        $levelid = $exploded_list[0];
        $levelname = $exploded_list[1];
        $answerscount = 'NA';
        $correctanswerscount = 'NA';
        $questionheader = $request->input('questionheader');
        $imageposition = $request->input('imageposition');

        $image = 'NA';
        if ($request->hasFile('questionimage')) {
            $imageupload = 'Y';
            // $imageposition = '1';
            $imageFile = $request->file('questionimage')->getClientOriginalName();
            $imageFileName = pathinfo($imageFile, PATHINFO_FILENAME);
            $imageFileExtention = $request->file('questionimage')->getClientOriginalExtension();

            $fileNameToStore = $imageFileName . '_ESSAY_' . time() . '.' . $imageFileExtention;
            // $imageFileName = 'question_mcq'.$imageFile.getClientOriginalExtension();
            //$path = $request->file('questionimage')->storeAs('public/question_images', $fileNameToStore);
           // $image = $fileNameToStore;
            $file = request()->file('questionimage');
            $image  = $file->store('question_images', ['disk' => 'mypublic']);
        } else {
            $imageupload = 'N';
        }

        $allocatedmarks = $request->input('allocatedmarks');
        $userid = Auth::user()->id;
        $userName = Auth::user()->name;
        $userlanguage = Auth::user()->language1;

        DB::table('questionsmain')->insert(
            [
                'qstype' => $qsType,
                'examtypeid' => $examtypeid,
                'examtypename' => $examtypename,
                'categoryid' => $categoryid,
                'categoryname' => $categoryname,
                'subcategoryid' => $subcategoryid,
                'subcategoryname' => $subcategoryname,
                'subjectid' => $subjectid,
                'subjectname' => $subjectname,
                'gradeid' => $gradeid,
                'gradename' => $gradename,
                'levelid' => $levelid,
                'levelname' => $levelname,
                'questionheader' => $questionheader,
                'imageupload' => $imageupload,
                'imageurl' => $image,
                'imageposition' => $imageposition,
                'marksallocated' => $allocatedmarks,
                'status' => $qsStatus,
                'userlanguage' => $userlanguage,
                'enteredbyid' => $userid,
                'enteredbyname' => $userName,
                'approvedbyid' => 'NA',
                'approvedbyname' => 'NA',
                'deaccuracy' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        $questionid = DB::table('questionsmain')->max('id');

        //Essay answers guiid line saveing
        $answerguid = $request->input('answerguid');
        $imageposition_ans = 'NA';
        $image_ans = 'NA';
        $imageupload_ans = '';
        if ($request->hasFile('answerguidimage')) {
            $imageupload_ans = 'Y';
            $imageposition_ans = $request->input('imagepositionanswer');
            $imageFile = $request->file('answerguidimage')->getClientOriginalName();
            $imageFileName = pathinfo($imageFile, PATHINFO_FILENAME);
            $imageFileExtention = $request->file('answerguidimage')->getClientOriginalExtension();

            $fileNameToStore = $imageFileName . '_ESSAY_' . time() . '.' . $imageFileExtention;
            // $imageFileName = 'question_mcq'.$imageFile.getClientOriginalExtension();
            // $path = $request->file('answerguidimage')->storeAs('public/question_images', $fileNameToStore);
            // $image_ans = $fileNameToStore;
            $file = request()->file('answerguidimage');
            $image_ans  = $file->store('question_images', ['disk' => 'mypublic']);
        } else {
            $imageupload_ans = 'N';
        }

        DB::table('questions_essay')->insert(

            [
                'qsid' => $questionid,
                'crrectionguid' => $answerguid,
                'imageupload' => $imageupload_ans,
                'image' => $image_ans,
                'imageposition' => $imageposition_ans,
                'tokenid' => $tokenid,
                'myvalue' => $penentries,
                'status' => 'A',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

         //Audit Entry
         DB::table('auditentriesreport')->insert(
            [
                'userid' => $userid,
                'username' => $userName,
                'action' => 'create_question',
                'actionon' => 'Essay Question',
                'actiononentry' => $questionid,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        $examtypedata    = DB::table('examtypes')->get();
        $categorydata    = DB::table('categories')->get();
        $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categoryid)->get();
        $subjectdata    = DB::table('subjects')->get();
        $gradedata    = DB::table('grades')->get();
        $leveldata   = DB::table('levels')->get();

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
            'examtypedata' => $examtypedata,
            'categorydata' => $categorydata,
            'subcategorydata' => $subcategorydata,
            'subjectdata' => $subjectdata,
            'gradedata' => $gradedata,
            'leveldata' => $leveldata,
            'presettings' => 'true',
            'pre_examtype' => $examtypeid,
            'pre_category' => $categoryid,
            'pre_subcategory' => $subcategoryid,
            'pre_answercount' => $answerscount,
            'pre_subject' => $subjectid,
            'pre_grade' => $gradeid,
            'pre_level' => $levelid,
            'pre_correctanswercount' => $correctanswerscount,
            'questionsThisMonth' => $questionsThisMonth,
            'accuracy' => $accuracy,
            'alowance' => $eligibalAllwance,
        ];

        return view('pages.enteressayquestion')->with('dataset', $dataset);
    }

    public function savefillblanksquestion(Request $request)
    {

        $this->validate($request, [
            'examtype'  => 'required|not_in:-- Choose User Option --',
            'category'  => 'required|not_in:-- Choose User Option --',
            'subcategory'  => 'required|not_in:-- Choose User Option --',
            'subject'  => 'required|not_in:-- Choose User Option --',
            'grade'  => 'required|not_in:-- Choose User Option --',
            'level'  => 'required|not_in:-- Choose User Option --',   
            'questionheader' => 'required',
            'quest1' => 'required',
            'quest2' => 'required',
            'quest3' => 'required',
            'quest4' => 'required',
            'quest5' => 'required',
            'allocatedmarks' => 'required',
        ]);

        $qsType = "FILLBLANKS";
        $qsStatus = 0;
        if ($request->input('save') == 'save') {
            //Save the question
            $qsStatus = 3;
        } elseif ($request->input('forapproval') == 'forapproval') {
            $qsStatus = 1;
        } else {
            print_r('<h1 style="color:red;">save button  not clicked</h1>');
        }

        $exploded_list = explode('-', $request->input('examtype'));
        $examtypeid = $exploded_list[0];
        $examtypename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('category'));
        $categoryid = $exploded_list[0];
        $categoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subcategory'));
        $subcategoryid = $exploded_list[0];
        $subcategoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subject'));
        $subjectid = $exploded_list[0];
        $subjectname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('grade'));
        $gradeid = $exploded_list[0];
        $gradename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('level'));
        $levelid = $exploded_list[0];
        $levelname = $exploded_list[1];
        $answerscount = 'NA';
        $correctanswerscount = 'NA';
        $questionheader = $request->input('questionheader');
        $imageposition = 'NA';
        $image = 'NA';
        $blankscount = $request->input('blanckcount');

        $allocatedmarks = $request->input('allocatedmarks');
        $userid = Auth::user()->id;
        $userName = Auth::user()->name;
        $userlanguage = Auth::user()->language1;

        $qsid = DB::table('questionsmain')->insertGetId(
            [
                'qstype' => $qsType,
                'examtypeid' => $examtypeid,
                'examtypename' => $examtypename,
                'categoryid' => $categoryid,
                'categoryname' => $categoryname,
                'subcategoryid' => $subcategoryid,
                'subcategoryname' => $subcategoryname,
                'subjectid' => $subjectid,
                'subjectname' => $subjectname,
                'gradeid' => $gradeid,
                'gradename' => $gradename,
                'levelid' => $levelid,
                'levelname' => $levelname,
                'questionheader' => $questionheader,
                'imageupload' => 'N',
                'imageurl' => $image,
                'imageposition' => $imageposition,
                'marksallocated' => $allocatedmarks,
                'status' => $qsStatus,
                'userlanguage' => $userlanguage,
                'enteredbyid' => $userid,
                'enteredbyname' => $userName,
                'approvedbyid' => 'NA',
                'approvedbyname' => 'NA',
                'deaccuracy' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        $qentrycount = $request->input('blancksentrycount');

        $b = 1;
        while ($qentrycount >= $b) {

            $questiontext = $request->input('quest' . $b);
            $qblankscount = $request->input('blanckcount' . $b);



            if ($questiontext != '') {
                DB::table('fillblanksquestionheaders')->insert(
                    [
                        'qsid' => $qsid,
                        'position' => $b,
                        'blanks' => $qblankscount,
                        'entries' => $qentrycount,
                        'qselement' => $questiontext,
                        'created_at' => NOW(),
                        'updated_at' => NOW(),
                    ]
                );
            }


            //save the expected words

            if ($qblankscount > 0) {

                $e = 1;
                while ($qblankscount >= $e) {

                    $expcted =  $request->input('expected-q' . $b . '-a' . $e);
                    if ($expcted != '') {
                        DB::table('fillblanksexpected')->insert(
                            [
                                'qsid' => $qsid,
                                'entry' => $b,
                                'position' => $e,
                                'blanks' => $qblankscount,
                                'qselement' => $expcted,
                                'created_at' => NOW(),
                                'updated_at' => NOW(),
                            ]
                        );
                    }
                    $e++;
                }
            }
            $b++;
        }


         //Audit Entry
         DB::table('auditentriesreport')->insert(
            [
                'userid' => $userid,
                'username' => $userName,
                'action' => 'create_question',
                'actionon' => 'Fill In The Blanks Question',
                'actiononentry' => $qsid,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );


        $examtypedata    = DB::table('examtypes')->get();
        $categorydata    = DB::table('categories')->get();
        $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categoryid)->get();
        $subjectdata    = DB::table('subjects')->get();
        $gradedata    = DB::table('grades')->get();
        $leveldata   = DB::table('levels')->get();

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
            'examtypedata' => $examtypedata,
            'categorydata' => $categorydata,
            'subcategorydata' => $subcategorydata,
            'subjectdata' => $subjectdata,
            'gradedata' => $gradedata,
            'leveldata' => $leveldata,
            'presettings' => 'true',
            'pre_examtype' => $examtypeid,
            'pre_category' => $categoryid,
            'pre_subcategory' => $subcategoryid,
            'pre_answercount' => $answerscount,
            'pre_subject' => $subjectid,
            'pre_grade' => $gradeid,
            'pre_level' => $levelid,
            'pre_correctanswercount' => $correctanswerscount,
            'questionsThisMonth' => $questionsThisMonth,
            'accuracy' => $accuracy,
            'alowance' => $eligibalAllwance,
        ];

        return view('pages.enterfillblanksquestion')->with('dataset', $dataset);
        //  print_r($headerelements);

    }

    public function editquestion($idval)
    {

        $ilist  = explode('-', $idval);
        $id = $ilist[1];
        $quetype = $ilist[0];

        $questionmain    = DB::table('questionsmain')->where('id', '=', $id)->get();
        $qsType = $questionmain[0]->qstype;
        $qsCategoryid = $questionmain[0]->categoryid;

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

        if ($qsType == "MCQ") {

            $questionsub = DB::table('questions_mcq')->where('qsid', '=', $id)->get();

            $examtypedata    = DB::table('examtypes')->get();
            $categorydata    = DB::table('categories')->get();
            $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $qsCategoryid)->get();
            $subjectdata    = DB::table('subjects')->get();
            $gradedata    = DB::table('grades')->get();
            $leveldata   = DB::table('levels')->get();

            //get actual selected count
            $actaulcorrect = DB::table('questions_mcq')->where([
                ['qsid', '=', $id],
                ['correct', '=', 'Y'],
            ])->count();


            $dataset = [
                'questionmain' => $questionmain,
                'questionsub' => $questionsub,
                'actaulcorrect' => $actaulcorrect,
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

            return view('pages.editmcqquotation')->with('dataset', $dataset);
        } else if ($qsType == 'TRUEFALSE') {

            $questionsub = DB::table('questions_truefalse')->where('qsid', '=', $id)->get();

            $examtypedata    = DB::table('examtypes')->get();
            $categorydata    = DB::table('categories')->get();
            $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $qsCategoryid)->get();
            $subjectdata    = DB::table('subjects')->get();
            $gradedata    = DB::table('grades')->get();
            $leveldata   = DB::table('levels')->get();

            $dataset = [
                'questionmain' => $questionmain,
                'questionsub' => $questionsub,
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

            return view('pages.edittruefalsequotation')->with('dataset', $dataset);
        } else if ($qsType == 'MATCHING') {

            $questionsub = DB::table('questions_matching')->where('qsid', '=', $id)->get();

            $examtypedata    = DB::table('examtypes')->get();
            $categorydata    = DB::table('categories')->get();
            $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $qsCategoryid)->get();
            $subjectdata    = DB::table('subjects')->get();
            $gradedata    = DB::table('grades')->get();
            $leveldata   = DB::table('levels')->get();

            $dataset = [
                'questionmain' => $questionmain,
                'questionsub' => $questionsub,
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

            return view('pages.editmatchingquotation')->with('dataset', $dataset);
        } else if ($qsType == 'FILLBLANKS') {

            $questionsub = DB::table('fillblanksquestionheaders')->where('qsid', '=', $id)->get();
            $questionsubexpected = DB::table('fillblanksexpected')->where('qsid', '=', $id)->get();

            $examtypedata    = DB::table('examtypes')->get();
            $categorydata    = DB::table('categories')->get();
            $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $qsCategoryid)->get();
            $subjectdata    = DB::table('subjects')->get();
            $gradedata    = DB::table('grades')->get();
            $leveldata   = DB::table('levels')->get();

            $dataset = [
                'questionmain' => $questionmain,
                'questionsub' => $questionsub,
                'questionsubexpected' => $questionsubexpected,
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

            return view('pages.editfillblanksquestion')->with('dataset', $dataset);
        } else if ($qsType == 'SHORT') {

            $questionsub = DB::table('questions_short')->where('qsid', '=', $id)->get();


            $examtypedata    = DB::table('examtypes')->get();
            $categorydata    = DB::table('categories')->get();
            $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $qsCategoryid)->get();
            $subjectdata    = DB::table('subjects')->get();
            $gradedata    = DB::table('grades')->get();
            $leveldata   = DB::table('levels')->get();

            $dataset = [
                'questionmain' => $questionmain,
                'questionsub' => $questionsub,

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

            return view('pages.editshortquestion')->with('dataset', $dataset);
        } else if ($qsType == 'ESSAY') {

            $questionsub = DB::table('questions_essay')->where('qsid', '=', $id)->get();


            $examtypedata    = DB::table('examtypes')->get();
            $categorydata    = DB::table('categories')->get();
            $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $qsCategoryid)->get();
            $subjectdata    = DB::table('subjects')->get();
            $gradedata    = DB::table('grades')->get();
            $leveldata   = DB::table('levels')->get();

            $dataset = [
                'questionmain' => $questionmain,
                'questionsub' => $questionsub,

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

            return view('pages.editessayquestion')->with('dataset', $dataset);
        }
    }

    public function filterqueu3(Request $request)
    {
        //To be completed with status 3 queu filter.

        $questionqueu = array();

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
            $examtype = $exploded_list[0];
        }

        if ($category == 'All') {
            $category = '%';
        } else {
            $exploded_list = explode('-', $request->input('category'));
            $category = $exploded_list[0];
        }

        if ($subcategory == 'All') {
            $subcategory = '%';
        } else {
            $exploded_list = explode('-', $request->input('subcategory'));
            $subcategory = $exploded_list[0];
        }

        if ($subject == 'All') {
            $subject = '%';
        } else {
            $exploded_list = explode('-', $request->input('subject'));
            $subject = $exploded_list[0];
        }
        if ($grade == 'All') {
            $grade = '%';
        } else {
            $exploded_list = explode('-', $request->input('grade'));
            $grade = $exploded_list[0];
        }
        if ($level == 'All') {
            $level = '%';
        } else {
            $exploded_list = explode('-', $request->input('level'));
            $level = $exploded_list[0];
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

        return view('pages.dashboard')->with('dataset', $dataset);
    }

    public function filterdash_tobe(Request $request)
    {
        //To be completed with status 3 queu filter.

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
            $examtype = $exploded_list[0];
        }

        if ($category == 'All') {
            $category = '%';
        } else {
            $exploded_list = explode('-', $request->input('category'));
            $category = $exploded_list[0];
        }

        if ($subcategory == 'All') {
            $subcategory = '%';
        } else {
            $exploded_list = explode('-', $request->input('subcategory'));
            $subcategory = $exploded_list[0];
        }

        if ($subject == 'All') {
            $subject = '%';
        } else {
            $exploded_list = explode('-', $request->input('subject'));
            $subject = $exploded_list[0];
        }
        if ($grade == 'All') {
            $grade = '%';
        } else {
            $exploded_list = explode('-', $request->input('grade'));
            $grade = $exploded_list[0];
        }
        if ($level == 'All') {
            $level = '%';
        } else {
            $exploded_list = explode('-', $request->input('level'));
            $level = $exploded_list[0];
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

        $questiondata_rejected   = DB::table('questionsmain')->where([
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
            'questiondata_rejected' => $questiondata_rejected ,
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

        return view('pages.dashboard')->with('dataset', $dataset);
    }

    public function advancedsearchsubmit(Request $request)
    {
        //To be completed with status 3 queu filter.

        $questionqueu = array();

        $examtype =  $request->input('examtype');
        $category =  $request->input('category');
        $subcategory =  $request->input('subcategory');
        $subject =  $request->input('subject');
        $grade =  $request->input('grade');
        $level =  $request->input('level');

        $qstype =  $request->input('qstype');
        $enteredby =  $request->input('enteredby').'%';
        $enteredbydate =  $request->input('enteredbydate');

        $approvedby =  $request->input('approvedby');
        $approvedbydate =  $request->input('approvedbydate');

        $reset =  $request->input('reset');

        $questioncontain =  $request->input('questioncontain');

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

        if ($qstype == 'All') {
            $qstype = '%';
        }
        
        if ($enteredby == 'All%') {
        
            $enteredby = '%';
        }
        print_r($enteredby);

        if ($enteredbydate == '') {
            $enteredbydate = '%';
        }

        if ($approvedby == 'All') {
            $approvedby = '%';
        }

        if ($approvedbydate == '') {
            $approvedbydate = '%';
        }

        if ($questioncontain == '') {
            $questioncontain = '%';
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
            ['examtypeid', 'like', ''.$examtype],
            ['categoryid', 'like', ''.$category],
            ['subcategoryid', 'like', $subcategory],
            ['subjectid', 'like', $subject],
            ['gradeid', 'like', $grade],
            ['levelid', 'like', $level],
            ['qstype', 'like', $qstype],
            ['enteredbyid', 'like', $enteredby],
            ['created_at', 'like', $enteredbydate],
            ['approvedbyid', 'like', $approvedby],
            ['updated_at', 'like', $approvedbydate],
            ['questionheader', 'like', $questioncontain],
        ])->get();

       
        // 
        // 
        // 
        // 
        // 
        // 
    

        print_r(count($questionqueu));


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

        $usersdata   = DB::table('users')->where('role', '!=', 'Student')->get();

        $dataset = [
            'questiondata' => $questionqueu,
            'examtypedata' => $examtypedata,
            'categorydata' => $categorydata,
            'subcategorydata' => $subcategorydata,
            'subjectdata' => $subjectdata,
            'gradedata' => $gradedata,
            'leveldata' => $leveldata,
            'usersdata' => $usersdata,
            'questionsThisMonth' => $questionsThisMonth,
            'accuracy' => $accuracy,
            'alowance' => $eligibalAllwance,
        ];

        return view('pages.searchquestions')->with('dataset', $dataset);
        // return view('pages.dashboard')->with('dataset', $dataset);
    }

    public function reviewquestion($idval)
    {
        $ilist  = explode('-', $idval);
        $id = $ilist[1];
        $quetype = $ilist[0];
        //Review question page
        $questionmain    = DB::table('questionsmain')->where('id', '=', $id)->get();
        $questiontype = $questionmain[0]->qstype;
        $questionsubdata = "";
        $fillindata = "";

        if ($questiontype == "MCQ") {
            $questionsubdata    = DB::table('questions_mcq')->where('qsid', '=', $id)->get();
        } elseif ($questiontype == "TRUEFALSE") {
            $questionsubdata    = DB::table('questions_truefalse')->where('qsid', '=', $id)->get();
        } elseif ($questiontype == "MATCHING") {
            $questionsubdata    = DB::table('questions_matching')->where('qsid', '=', $id)->get();
        } elseif ($questiontype == "SHORT") {
            $questionsubdata    = DB::table('questions_short')->where('qsid', '=', $id)->get();
        } elseif ($questiontype == "ESSAY") {
            $questionsubdata    = DB::table('questions_essay')->where('qsid', '=', $id)->get();
        } elseif ($questiontype == "FILLBLANKS") {
            $questionsubdata    = DB::table('fillblanksquestionheaders')->where('qsid', '=', $id)->get();
            $fillindata    = DB::table('fillblanksexpected')->where('qsid', '=', $id)->get();
        }

        $userrole = Auth::user()->role;
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
            'questionmain' => $questionmain,
            'questionsubdata' => $questionsubdata,
            'questiontype' => $questiontype,
            'fillindata' => $fillindata,
            'approvedquestion' => 'N',
            'onholdquestion' => 'N',
            'rejectquestion' => 'N',
            'removequestion' => 'N',
            'userrole' => $userrole,
            'questionsThisMonth' => $questionsThisMonth,
            'accuracy' => $accuracy,
            'alowance' => $eligibalAllwance,
            'quetype' => $quetype,
        ];
        return view('pages.reviewquestion')->with('dataset', $dataset);
    }

    public function approvequestion($idval)
    {

        $ilist  = explode('-', $idval);
        $id = $ilist[1];
        $quetype = $ilist[0];
        //Approve question
        DB::table('questionsmain')
            ->where('id', $id)
            ->update(['status' => 0]);

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'approve_question',
                'actionon' => 'Approve Question ID:'.$id,
                'actiononentry' => $id,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        //get the next question
        $nextquestion = DB::table('questionsmain')->where([
            ['id', '>', $id],
            ['status', '=', '1'],
        ])->take(1)->get();

        if ($nextquestion->first()) {

            $questionmain    = DB::table('questionsmain')->where('id', '=', $nextquestion[0]->id)->get();
            $questiontype = $questionmain[0]->qstype;
            $questionsubdata = "";
            $fillindata = "";
            if ($questiontype == "MCQ") {
                $questionsubdata    = DB::table('questions_mcq')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "TRUEFALSE") {
                $questionsubdata    = DB::table('questions_truefalse')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "MATCHING") {
                $questionsubdata    = DB::table('questions_matching')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "SHORT") {
                $questionsubdata    = DB::table('questions_short')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "ESSAY") {
                $questionsubdata    = DB::table('questions_essay')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "FILLBLANKS") {
                $questionsubdata    = DB::table('fillblanksquestionheaders')->where('qsid', '=', $nextquestion[0]->id)->get();
                $fillindata = DB::table('fillblanksexpected')->where('qsid', '=', $nextquestion[0]->id)->get();
            }

            $userrole = Auth::user()->role;

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
                'questionmain' => $questionmain,
                'questionsubdata' => $questionsubdata,
                'questiontype' => $questiontype,
                'fillindata' => $fillindata,
                'approvedquestion' => 'Y',
                'onholdquestion' => 'N',
                'rejectquestion' => 'N',
                'removequestion' => 'N',
                'userrole' => $userrole,
                'questionsThisMonth' => $questionsThisMonth,
                'accuracy' => $accuracy,
                'alowance' => $eligibalAllwance,
                'quetype' => $quetype,
            ];
            return view('pages.reviewquestion')->with('dataset', $dataset);
        } else {
            return redirect('/forapprovequestionsqueu');
        }
    }

    public function onholdquestion($idval)
    {

        $ilist  = explode('-', $idval);
        $id = $ilist[1];
        $quetype = $ilist[0];
        //On Hold question
        DB::table('questionsmain')
            ->where('id', $id)
            ->update(['status' => 2]);


            //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'onhold_question',
                'actionon' => 'Onhold Question ID:'.$id,
                'actiononentry' => $id,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        //get the next question
        $nextquestion = DB::table('questionsmain')->where([
            ['id', '>', $id],
            ['status', '=', '1'],
        ])->take(1)->get();

        if ($nextquestion->first()) {

            $questionmain    = DB::table('questionsmain')->where('id', '=', $nextquestion[0]->id)->get();
            $questiontype = $questionmain[0]->qstype;
            $questionsubdata = "";
            $fillindata = "";

            if ($questiontype == "MCQ") {
                $questionsubdata    = DB::table('questions_mcq')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "TRUEFALSE") {
                $questionsubdata    = DB::table('questions_truefalse')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "MATCHING") {
                $questionsubdata    = DB::table('questions_matching')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "SHORT") {
                $questionsubdata    = DB::table('questions_short')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "ESSAY") {
                $questionsubdata    = DB::table('questions_essay')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "FILLBLANKS") {
                $questionsubdata    = DB::table('fillblanksquestionheaders')->where('qsid', '=', $id)->get();
                $fillindata = DB::table('fillblanksexpected')->where('qsid', '=', $id)->get();
            }

            $userrole = Auth::user()->role;
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
                'questionmain' => $questionmain,
                'questionsubdata' => $questionsubdata,
                'questiontype' => $questiontype,
                'fillindata' => $fillindata,
                'approvedquestion' => 'N',
                'onholdquestion' => 'Y',
                'rejectquestion' => 'N',
                'removequestion' => 'N',
                'userrole' => $userrole,
                'questionsThisMonth' => $questionsThisMonth,
                'accuracy' => $accuracy,
                'alowance' => $eligibalAllwance,
                'quetype' => $quetype,
            ];
            return view('pages.reviewquestion')->with('dataset', $dataset);
        } else {
            print_r('empty');
        }
    }

    public function rejectquestion($idval)
    {
        $ilist  = explode('-', $idval);
        $id = $ilist[1];
        $quetype = $ilist[0];
        //Reject question
        DB::table('questionsmain')
            ->where('id', $id)
            ->update(['status' => 4]);

            //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'reject_question',
                'actionon' => 'Reject Question ID:'.$id,
                'actiononentry' => $id,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        //get the next question
        $nextquestion = DB::table('questionsmain')->where([
            ['id', '>', $id],
            ['status', '=', '1'],
        ])->take(1)->get();

        if ($nextquestion->first()) {

            $questionmain    = DB::table('questionsmain')->where('id', '=', $nextquestion[0]->id)->get();
            $questiontype = $questionmain[0]->qstype;
            $questionsubdata = "";
            $fillindata = "";
            if ($questiontype == "MCQ") {
                $questionsubdata    = DB::table('questions_mcq')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "TRUEFALSE") {
                $questionsubdata    = DB::table('questions_truefalse')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "MATCHING") {
                $questionsubdata    = DB::table('questions_matching')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "SHORT") {
                $questionsubdata    = DB::table('questions_short')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "ESSAY") {
                $questionsubdata    = DB::table('questions_essay')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "FILLBLANKS") {
                $questionsubdata    = DB::table('fillblanksquestionheaders')->where('qsid', '=', $id)->get();
                $fillindata = DB::table('fillblanksexpected')->where('qsid', '=', $id)->get();
            }

            $userrole = Auth::user()->role;
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
                'questionmain' => $questionmain,
                'questionsubdata' => $questionsubdata,
                'questiontype' => $questiontype,
                'fillindata' => $fillindata,
                'approvedquestion' => 'N',
                'onholdquestion' => 'N',
                'rejectquestion' => 'Y',
                'removequestion' => 'N',
                'userrole' => $userrole,
                'questionsThisMonth' => $questionsThisMonth,
                'accuracy' => $accuracy,
                'alowance' => $eligibalAllwance,
                'quetype' => $quetype,
            ];
            return view('pages.reviewquestion')->with('dataset', $dataset);
        } else {
            print_r('empty');
        }
    }

    public function removequestion($idval)
    {
        $ilist  = explode('-', $idval);
        $id = $ilist[1];
        $quetype = $ilist[0];
        
        //Remove question
        DB::table('questionsmain')
            ->where('id', $id)
            ->update(['status' => 5]);

         //Audit Entry
         $audituserid = Auth::user()->id;
         $audituserName = Auth::user()->name;
         DB::table('auditentriesreport')->insert(
             [
                 'userid' => $audituserid,
                 'username' => $audituserName,
                 'action' => 'remove_question',
                 'actionon' => 'Remove Question ID:'.$id,
                 'actiononentry' => $id,
                 'oldvalue' => 'NA',
                 'newvalue' => 'NA',
                 'created_at' => NOW(),
                 'updated_at' => NOW(),
             ]
         );

        //get the next question
        $nextquestion = DB::table('questionsmain')->where([
            ['id', '>', $id],         
        ])->take(1)->get();

        if ($nextquestion->first()) {

            $questionmain    = DB::table('questionsmain')->where('id', '=', $nextquestion[0]->id)->get();
            $questiontype = $questionmain[0]->qstype;
            $questionsubdata = "";
            $fillindata = "";
            if ($questiontype == "MCQ") {
                $questionsubdata    = DB::table('questions_mcq')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "TRUEFALSE") {
                $questionsubdata    = DB::table('questions_truefalse')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "MATCHING") {
                $questionsubdata    = DB::table('questions_matching')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "SHORT") {
                $questionsubdata    = DB::table('questions_short')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "ESSAY") {
                $questionsubdata    = DB::table('questions_essay')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "FILLBLANKS") {
                $questionsubdata    = DB::table('fillblanksquestionheaders')->where('qsid', '=', $id)->get();
                $fillindata = DB::table('fillblanksexpected')->where('qsid', '=', $id)->get();
            }

            $userrole = Auth::user()->role;
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
                'questionmain' => $questionmain,
                'questionsubdata' => $questionsubdata,
                'questiontype' => $questiontype,
                'fillindata' => $fillindata,
                'approvedquestion' => 'N',
                'onholdquestion' => 'N',
                'rejectquestion' => 'N',
                'removequestion' => 'Y',
                'userrole' => $userrole,
                'questionsThisMonth' => $questionsThisMonth,
                'accuracy' => $accuracy,
                'alowance' => $eligibalAllwance,
                'quetype' => $quetype,
            ];
            return view('pages.reviewquestion')->with('dataset', $dataset);
        } else {
            return redirect('/forapprovequestionsqueu');
        }
    }

    public function prequestion_review($idval)
    {

        $ilist  = explode('-', $idval);
        $id = $ilist[1];
        $quetype = $ilist[0];
        //get the Pre question
        $preid = DB::table('questionsmain')->where([
            ['id', '<', $id],
            ['status', '=', $quetype],
        ])->max('id');
        $nextquestion = DB::table('questionsmain')->where([
            ['id', '=', $preid],
            ['status', '=', $quetype],
        ])->take(1)->get();

        if ($nextquestion->first()) {
            //print_r($preid);
            $questionmain    = DB::table('questionsmain')->where('id', '=', $nextquestion[0]->id)->get();
            $questiontype = $questionmain[0]->qstype;
            // print_r($questiontype.'<br>');
            $questionsubdata = "";
            $fillindata = "";
            if ($questiontype == "MCQ") {
                $questionsubdata    = DB::table('questions_mcq')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "TRUEFALSE") {
                $questionsubdata    = DB::table('questions_truefalse')->where('qsid', '=', $id)->get();
            } elseif ($questiontype == "MATCHING") {
                $questionsubdata    = DB::table('questions_matching')->where('qsid', '=', $id)->get();
            } elseif ($questiontype == "SHORT") {
                $questionsubdata    = DB::table('questions_short')->where('qsid', '=', $id)->get();
            } elseif ($questiontype == "ESSAY") {
                $questionsubdata    = DB::table('questions_essay')->where('qsid', '=', $id)->get();
            } elseif ($questiontype == "FILLBLANKS") {
                $questionsubdata    = DB::table('fillblanksquestionheaders')->where('qsid', '=', $id)->get();
                $fillindata = DB::table('fillblanksexpected')->where('qsid', '=', $id)->get();
            }
            //  print_r($nextquestion[0]->id.'<br>');
            //  print_r($questionsubdata.'<br>');

            $userrole = Auth::user()->role;
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
                'questionmain' => $questionmain,
                'questionsubdata' => $questionsubdata,
                'questiontype' => $questiontype,
                'fillindata' => $fillindata,
                'approvedquestion' => 'N',
                'onholdquestion' => 'N',
                'rejectquestion' => 'N',
                'removequestion' => 'N',
                'userrole' => $userrole,
                'questionsThisMonth' => $questionsThisMonth,
                'accuracy' => $accuracy,
                'alowance' => $eligibalAllwance,
                'quetype' => $quetype,
            ];
            return view('pages.reviewquestion')->with('dataset', $dataset);
        } else {
            return redirect('/forapprovequestionsqueu');
        }
    }

    public function nextquestion_review($idval)
    {

        $ilist  = explode('-', $idval);
        $id = $ilist[1];
        $quetype = $ilist[0];
        //get the Pre question
        $nextquestion = DB::table('questionsmain')->where([
            ['id', '>', $id],
            ['status', '=', $quetype],
        ])->take(1)->get();

        if ($nextquestion->first()) {

            $questionmain    = DB::table('questionsmain')->where('id', '=', $nextquestion[0]->id)->get();
            $questiontype = $questionmain[0]->qstype;
            $questionsubdata = "";
            $fillindata = "";
            if ($questiontype == "MCQ") {
                $questionsubdata    = DB::table('questions_mcq')->where('qsid', '=', $nextquestion[0]->id)->get();
            } elseif ($questiontype == "TRUEFALSE") {
                $questionsubdata    = DB::table('questions_truefalse')->where('qsid', '=', $id)->get();
            } elseif ($questiontype == "MATCHING") {
                $questionsubdata    = DB::table('questions_matching')->where('qsid', '=', $id)->get();
            } elseif ($questiontype == "SHORT") {
                $questionsubdata    = DB::table('questions_short')->where('qsid', '=', $id)->get();
            } elseif ($questiontype == "ESSAY") {
                $questionsubdata    = DB::table('questions_essay')->where('qsid', '=', $id)->get();
            } elseif ($questiontype == "FILLBLANKS") {
                $questionsubdata    = DB::table('fillblanksquestionheaders')->where('qsid', '=', $id)->get();
                $fillindata = DB::table('fillblanksexpected')->where('qsid', '=', $id)->get();
            }

            $userrole = Auth::user()->role;
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
                'questionmain' => $questionmain,
                'questionsubdata' => $questionsubdata,
                'questiontype' => $questiontype,
                'fillindata' => $fillindata,
                'approvedquestion' => 'N',
                'onholdquestion' => 'N',
                'rejectquestion' => 'N',
                'removequestion' => 'N',
                'userrole' => $userrole,
                'questionsThisMonth' => $questionsThisMonth,
                'accuracy' => $accuracy,
                'alowance' => $eligibalAllwance,
                'quetype' => $quetype,
            ];
            return view('pages.reviewquestion')->with('dataset', $dataset);
        } else {
            return redirect('/forapprovequestionsqueu');
        }
    }



    public function updateessayquestion(Request $request)
    {

        
        $questionId = $request->input('questionid');
        $qsType = "MATCHING";
        if ($request->input('save') == 'save') {
            //Save the question
            $qsStatus = 3;
        } elseif ($request->input('forapproval') == 'forapproval') {
            $qsStatus = 1;
        } else {
            print_r('<h1 style="color:red;">save button  not clicked</h1>');
        }

        $exploded_list = explode('-', $request->input('examtype'));
        $examtypeid = $exploded_list[0];
        $examtypename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('category'));
        $categoryid = $exploded_list[0];
        $categoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subcategory'));
        $subcategoryid = $exploded_list[0];
        $subcategoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subject'));
        $subjectid = $exploded_list[0];
        $subjectname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('grade'));
        $gradeid = $exploded_list[0];
        $gradename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('level'));
        $levelid = $exploded_list[0];
        $levelname = $exploded_list[1];
        $answerscount = $request->input('answerscount');
        $correctanswerscount = $request->input('correctanswerscount');
        $questionheader = $request->input('questionheader');

        $imageposition = 'NA';
        $image = 'NA';
        if ($request->hasFile('questionimage')) {
            $imageupload = 'Y';
            $imageposition = $request->input('imageposition');
            $imageFile = $request->file('questionimage')->getClientOriginalName();
            $imageFileName = pathinfo($imageFile, PATHINFO_FILENAME);
            $imageFileExtention = $request->file('questionimage')->getClientOriginalExtension();

            $fileNameToStore = $imageFileName . '_' . time() . '.' . $imageFileExtention;
            // $imageFileName = 'question_mcq'.$imageFile.getClientOriginalExtension();
            // $path = $request->file('questionimage')->storeAs('public/question_images', $fileNameToStore);
            // $image = $fileNameToStore;
            $file = request()->file('questionimage');
            $image  = $file->store('question_images', ['disk' => 'mypublic']);
        } else {
            $imageupload = 'N';
        }

        $allocatedmarks = $request->input('allocatedmarks');
        $answerguid = $request->input('answerguid');
        DB::table('questionsmain')
            ->where('id', $questionId)
            ->update([
                'examtypeid' => $examtypeid,
                'examtypename' => $examtypename,
                'categoryid' => $categoryid,
                'categoryname' => $categoryname,
                'subcategoryid' => $subcategoryid,
                'subcategoryname' => $subcategoryname,
                'subjectid' => $subjectid,
                'subjectname' => $subjectname,
                'gradeid' => $gradeid,
                'gradename' => $gradename,
                'levelid' => $levelid,
                'levelname' => $levelname,
                'questionheader' => $questionheader,
                'imageupload' => $imageupload,
                'imageurl' => $image,
                'imageposition' => $imageposition,
                'marksallocated' => $allocatedmarks,
                'status' => $qsStatus,
          
                'updated_at' => NOW(),
            ]);

        $imageposition = 'NA';
        $image = 'NA';
        if ($request->hasFile('answerguidimage')) {
            $imageupload = 'Y';
            $imageposition = $request->input('imagepositionanswer');
            $imageFile = $request->file('answerguidimage')->getClientOriginalName();
            $imageFileName = pathinfo($imageFile, PATHINFO_FILENAME);
            $imageFileExtention = $request->file('answerguidimage')->getClientOriginalExtension();

            $fileNameToStore = $imageFileName . '_' . time() . '.' . $imageFileExtention;
            // $imageFileName = 'question_mcq'.$imageFile.getClientOriginalExtension();
            // $path = $request->file('answerguidimage')->storeAs('public/question_images', $fileNameToStore);
            // $image = $fileNameToStore;
            $file = request()->file('answerguidimage');
            $image  = $file->store('question_images', ['disk' => 'mypublic']);

        } else {
            $imageupload = 'N';
        }

        DB::table('questions_essay')
            ->where(
                [
                    ['qsid', '=', $questionId],

                ]
            )
            ->update([
                'crrectionguid' => $answerguid,
                'imageupload' => $imageupload,
                'image' => $image,
                'imageposition' => $imageposition,
            ]);

        $questiondata    = DB::table('questionsmain')->where('status', '=', '1')->get();
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
            'questiondata' => $questiondata,
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

        return redirect('/dashboard')->with('dataset', $dataset);
    }

    public function updatematchingquestion(Request $request)
    {
        $questionId = $request->input('questionid');
        $qsType = "MATCHING";
        if ($request->input('save') == 'save') {
            //Save the question
            $qsStatus = 3;
        } elseif ($request->input('forapproval') == 'forapproval') {
            $qsStatus = 1;
        } else {
            print_r('<h1 style="color:red;">save button  not clicked</h1>');
        }

        $exploded_list = explode('-', $request->input('examtype'));
        $examtypeid = $exploded_list[0];
        $examtypename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('category'));
        $categoryid = $exploded_list[0];
        $categoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subcategory'));
        $subcategoryid = $exploded_list[0];
        $subcategoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subject'));
        $subjectid = $exploded_list[0];
        $subjectname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('grade'));
        $gradeid = $exploded_list[0];
        $gradename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('level'));
        $levelid = $exploded_list[0];
        $levelname = $exploded_list[1];
        $answerscount = $request->input('answerscount');
        $correctanswerscount = $request->input('correctanswerscount');
        $questionheader = $request->input('questionheader');

        $allocatedmarks = $request->input('allocatedmarks');

        $imageupload = 'N';
        $imageposition = 'NA';
        $image = 'NA';

        DB::table('questionsmain')
            ->where('id', $questionId)
            ->update([
                'examtypeid' => $examtypeid,
                'examtypename' => $examtypename,
                'categoryid' => $categoryid,
                'categoryname' => $categoryname,
                'subcategoryid' => $subcategoryid,
                'subcategoryname' => $subcategoryname,
                'subjectid' => $subjectid,
                'subjectname' => $subjectname,
                'gradeid' => $gradeid,
                'gradename' => $gradename,
                'levelid' => $levelid,
                'levelname' => $levelname,
                'questionheader' => $questionheader,
                'imageupload' => $imageupload,
                'imageurl' => $image,
                'imageposition' => $imageposition,
                'marksallocated' => $allocatedmarks,
                'status' => $qsStatus,
              
                'updated_at' => NOW(),
            ]);

        $a = 1;
        while ($answerscount >= $a) {

            $qentry = (string)$request->input('mainq' . $a);
            $contraentry = (string)$request->input('counterq' . $a);
            $ansentry = (string) $request->input('matchingq' . $a) . '';

            $thisq = "Q" . $a;
            DB::table('questions_matching')
                ->where(
                    [
                        ['qsid', '=', $questionId],
                        ['answernumber', '=', $thisq],
                        ['side', '=', '1'],
                    ]
                )
                ->update([
                    'answerscount' => $answerscount,
                    'answernumber' => $thisq,
                    'answer' => $qentry,

                ]);

            DB::table('questions_matching')
                ->where(
                    [
                        ['qsid', '=', $questionId],
                        ['answernumber', '=', $a],
                        ['side', '=', '2']
                    ]
                )
                ->update([
                    'answerscount' => $answerscount,
                    'answernumber' => $a,
                    'answer' => $contraentry,
                    'matchinganswer' => strval($ansentry).'',

                ]);

            $a++;
        }

        $questiondata    = DB::table('questionsmain')->where('status', '=', '1')->get();
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
            'questiondata' => $questiondata,
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


    public function updateshortquestion(Request $request)
    {

        $questionId = $request->input('questionid');

        $qsType = "MCQ";
        $qsStatus = 0;
        if ($request->input('save') == 'save') {
            //Save the question
            $qsStatus = 3;
        } elseif ($request->input('forapproval') == 'forapproval') {
            $qsStatus = 1;
        } else {
            print_r('<h1 style="color:red;">save button  not clicked</h1>');
        }

        $exploded_list = explode('-', $request->input('examtype'));
        $examtypeid = $exploded_list[0];
        $examtypename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('category'));
        $categoryid = $exploded_list[0];
        $categoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subcategory'));
        $subcategoryid = $exploded_list[0];
        $subcategoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subject'));
        $subjectid = $exploded_list[0];
        $subjectname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('grade'));
        $gradeid = $exploded_list[0];
        $gradename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('level'));
        $levelid = $exploded_list[0];
        $levelname = $exploded_list[1];
        $answerscount = $request->input('answerscount');
        $correctanswerscount = $request->input('correctanswerscount');
        $questionheader = $request->input('questionheader');
        $imageposition = 'NA';
        $image = 'NA';

        $allocatedmarks = $request->input('allocatedmarks');
        $shortanswer = $request->input('answer');

        DB::table('questionsmain')
            ->where('id', $questionId)
            ->update([
                'examtypeid' => $examtypeid,
                'examtypename' => $examtypename,
                'categoryid' => $categoryid,
                'categoryname' => $categoryname,
                'subcategoryid' => $subcategoryid,
                'subcategoryname' => $subcategoryname,
                'subjectid' => $subjectid,
                'subjectname' => $subjectname,
                'gradeid' => $gradeid,
                'gradename' => $gradename,
                'levelid' => $levelid,
                'levelname' => $levelname,
                'questionheader' => $questionheader,
                'imageupload' => 'N',
                'imageurl' => $image,
                'imageposition' => $imageposition,
                'marksallocated' => $allocatedmarks,
                'status' => $qsStatus,
         
                'updated_at' => NOW(),
            ]);

        DB::table('questions_short')
            ->where(
                [
                    ['qsid', '=', $questionId],

                ]
            )
            ->update([
                'shortanswer' => $shortanswer,
                'updated_at' => NOW(),
            ]);


        $questiondata    = DB::table('questionsmain')->where('status', '=', '1')->get();
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
            'questiondata' => $questiondata,
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

        return redirect('/dashboard')->with('dataset', $dataset);
    }

    public function updatemcqquestion(Request $request)
    {

        $questionId = $request->input('questionid');

        $qsType = "MCQ";
        $qsStatus = 0;
        if ($request->input('save') == 'save') {
            //Save the question
            $qsStatus = 3;
        } elseif ($request->input('forapproval') == 'forapproval') {
            $qsStatus = 1;
        } else {
            print_r('<h1 style="color:red;">save button  not clicked</h1>');
        }

        $exploded_list = explode('-', $request->input('examtype'));
        $examtypeid = $exploded_list[0];
        $examtypename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('category'));
        $categoryid = $exploded_list[0];
        $categoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subcategory'));
        $subcategoryid = $exploded_list[0];
        $subcategoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subject'));
        $subjectid = $exploded_list[0];
        $subjectname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('grade'));
        $gradeid = $exploded_list[0];
        $gradename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('level'));
        $levelid = $exploded_list[0];
        $levelname = $exploded_list[1];
        $answerscount = $request->input('answerscount');
        $correctanswerscount = $request->input('correctanswerscount');
        $questionheader = $request->input('questionheader');
        $imageposition = 'NA';
        $image = 'NA';
        if ($request->hasFile('questionimage')) {
            $imageupload = 'Y';
            $imageposition = $request->input('imageposition');
            $imageFile = $request->file('questionimage')->getClientOriginalName();
            $imageFileName = pathinfo($imageFile, PATHINFO_FILENAME);
            $imageFileExtention = $request->file('questionimage')->getClientOriginalExtension();

            $fileNameToStore = $imageFileName . '_' . time() . '.' . $imageFileExtention;
            // $imageFileName = 'question_mcq'.$imageFile.getClientOriginalExtension();
            // $path = $request->file('questionimage')->storeAs('public/question_images', $fileNameToStore);
            // $image = $fileNameToStore;
            $file = request()->file('questionimage');
            $image  = $file->store('question_images', ['disk' => 'mypublic']);
            
        } else {
            $imageupload = 'N';
        }

        $allocatedmarks = $request->input('allocatedmarks');
        $negativemarks = $request->input('negativemarks');

        DB::table('questionsmain')
            ->where('id', $questionId)
            ->update([
                'examtypeid' => $examtypeid,
                'examtypename' => $examtypename,
                'categoryid' => $categoryid,
                'categoryname' => $categoryname,
                'subcategoryid' => $subcategoryid,
                'subcategoryname' => $subcategoryname,
                'subjectid' => $subjectid,
                'subjectname' => $subjectname,
                'gradeid' => $gradeid,
                'gradename' => $gradename,
                'levelid' => $levelid,
                'levelname' => $levelname,
                'questionheader' => $questionheader,
                'imageupload' => $imageupload,
                'imageurl' => $image,
                'imageposition' => $imageposition,
                'marksallocated' => $allocatedmarks,
                'marksnegative' => $negativemarks,
                'status' => $qsStatus,
             
                'updated_at' => NOW(),
            ]);

        //Update Answers details
        $a = 1;
        while ($answerscount >= $a) {

            $answer = $request->input('answer' . $a);
            $answerimageupload = 'N';
            $imageUrl = 'N';
            if ($request->hasFile('answerimage' . $a)) {
                $answerimageupload = 'Y';
                $imageFile = $request->file('answerimage' . $a)->getClientOriginalName();
                $imageFileName = pathinfo($imageFile, PATHINFO_FILENAME);
                $imageFileExtention = $request->file('answerimage' . $a)->getClientOriginalExtension();

                $fileNameToStore = $imageFileName . '_answer_' . time() . '.' . $imageFileExtention;
                // $imageFileName = 'question_mcq'.$imageFile.getClientOriginalExtension();
                // $path = $request->file('answerimage' . $a)->storeAs('public/question_images', $fileNameToStore);
                // $imageUrl = $fileNameToStore;
                $file = request()->file('answerimage' . $a);
                $imageUrl  = $file->store('question_images', ['disk' => 'mypublic']);
            } else {
                $answerimageupload = 'N';
            }

            $correctCheck = 'N';
            if ($request->has('correctanswercheck' . $a)) {
                $correctCheck = 'Y';
            }

            DB::table('questions_mcq')
                ->where(
                    [
                        ['qsid', '=', $questionId],
                        ['answernumber', '=', $a],
                    ]
                )
                ->update([
                    'answerscount' => $answerscount,
                    'correctanswersacount' => $correctanswerscount,
                    'answernumber' => $a,
                    'answer' => $answer,
                    'imageupload' => $answerimageupload,
                    'imageurl' => $imageUrl,
                    'correct' => $correctCheck,
                    'status' => 'A',
                    'updated_at' => NOW(),
                ]);

            $a++;
        }

        $questiondata    = DB::table('questionsmain')->where('status', '=', '1')->get();
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
            'questiondata' => $questiondata,
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

        return Redirect('/dashboard')->with('dataset', $dataset);
    }


    public function updatetruefalsequestion(Request $request)
    {

        $questionId = $request->input('questionid');
        $qsType = "TRUEFALSE";
        $qsStatus = 0;
        if ($request->input('save') == 'save') {
            //Save the question
            $qsStatus = 3;
        } elseif ($request->input('forapproval') == 'forapproval') {
            $qsStatus = 1;
        } else {
            print_r('<h1 style="color:red;">save button  not clicked</h1>');
        }

        $exploded_list = explode('-', $request->input('examtype'));
        $examtypeid = $exploded_list[0];
        $examtypename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('category'));
        $categoryid = $exploded_list[0];
        $categoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subcategory'));
        $subcategoryid = $exploded_list[0];
        $subcategoryname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('subject'));
        $subjectid = $exploded_list[0];
        $subjectname = $exploded_list[1];
        $exploded_list = explode('-', $request->input('grade'));
        $gradeid = $exploded_list[0];
        $gradename = $exploded_list[1];
        $exploded_list = explode('-', $request->input('level'));
        $levelid = $exploded_list[0];
        $levelname = $exploded_list[1];
        $questionscount = $request->input('questionscount');
        $questionheader = $request->input('questionheader');
        $imageposition = 'NA';
        $image = 'NA';
        $imageupload = "NA";
        $allocatedmarks = $request->input('allocatedmarks');

        DB::table('questionsmain')
            ->where('id', $questionId)
            ->update([
                'examtypeid' => $examtypeid,
                'examtypename' => $examtypename,
                'categoryid' => $categoryid,
                'categoryname' => $categoryname,
                'subcategoryid' => $subcategoryid,
                'subcategoryname' => $subcategoryname,
                'subjectid' => $subjectid,
                'subjectname' => $subjectname,
                'gradeid' => $gradeid,
                'gradename' => $gradename,
                'levelid' => $levelid,
                'levelname' => $levelname,
                'questionheader' => $questionheader,
                'imageupload' => $imageupload,
                'imageurl' => $image,
                'imageposition' => $imageposition,
                'marksallocated' => $allocatedmarks,
                'status' => $qsStatus,              
                'updated_at' => NOW(), 
            ]);

        //Update Answers details
        $a = 1;
        while ($questionscount >= $a) {

            $answer = $request->input('q' . $a);
            $correctCheck = $request->input('qoption' . $a);


            DB::table('questions_truefalse')
                ->where(
                    [
                        ['qsid', '=', $questionId],
                        ['answernumber', '=', $a],
                    ]
                )
                ->update([
                    'answerscount' => $questionscount,
                    'answernumber' => $a,
                    'answer' => $answer,
                    'correct' => $correctCheck,
                    'status' => 'A',
                    'updated_at' => NOW(),
                ]);

            $a++;
        }

        $questiondata    = DB::table('questionsmain')->where('status', '=', '1')->get();
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
            'questiondata' => $questiondata,
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

        return redirect('/dashboard')->with('dataset', $dataset);
    }
}
