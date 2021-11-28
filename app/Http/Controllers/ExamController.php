<?php

namespace App\Http\Controllers;

use App\Mail\StudentResults;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ExamController extends Controller
{

    //old exam start function
    public function startexam(Request $request)
    {

        $examid = $request->input('examid');
        $examdata = DB::table('papertemplates')->where('id', '=', $examid)->get();
        $examsubdata = DB::table('papertemplatesdata')->where('templateid', '=', $examid)->get();

        $examname = $examdata[0]->coursename;
        $subject = $examdata[0]->subjectid;
        $subjectname = $examdata[0]->subjectname;
        $grade = $examdata[0]->gradeid;
        $gradename = $examdata[0]->gradename;
        $duration_hrs = $examdata[0]->durationhour;
        $duration_mns = $examdata[0]->durationminute;
        $numberofquestion = $examdata[0]->numberofquestion;

        $firstquestionid = 0;
        $userid = Auth::user()->id;
        $username = Auth::user()->name;
        $email = Auth::user()->email;
        //Create new exam seat
        $examseatid = DB::table('examseat')->insertGetId(
            [
                'userid' => $userid,
                'username' => $username,
                'email' => $email,
                'examid' => $examid,
                'examname' =>  $examname,
                'grade' => $grade,
                'gradename' => $gradename,
                'subject' => $subject,
                'subjectname' => $subjectname,
                'noofquestions' => $numberofquestion,
                'status' => '0',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );


        $questioncore = [];
        $c = 0;
        $qnumber = 0;
        foreach ($examsubdata as $examsub) {

            $category = $examsub->categoryid;
            $subcategory = $examsub->subcategoryid;
            $level = $examsub->levelid;
            $qstype = $examsub->qstype;
            $qscount = $examsub->qscount;

            // $questionrawdata = DB::table('questionsmain')->where([
            //     'qstype' => $qstype,
            //     'categoryid' => $category,
            //     'subcategoryid' => $subcategory,
            //     'subjectid' => $subject,
            //     'gradeid' => $grade,
            //     'levelid' => $level,
            //     'status' => '0',
            // ])->limit($qscount)->inRandomOrder()->get();

            $questionrawdata = DB::table('questionsmain')->where([
                'qstype' => $qstype,
                'categoryid' => $category,
                'subcategoryid' => $subcategory,
                'subjectid' => $subject,
                'gradeid' => $grade,
                'levelid' => $level,
                'status' => '0',
            ])->inRandomOrder()->get();

            $p = 1;
            $qcounter = 1;
            foreach ($questionrawdata as $question) {

                //Check the question duplication
                $qcheckcount = DB::table('questionselecttracker')->where([
                    ['qsid', '=', $question->id],
                    ['qstype', '=', $qstype],
                    ['stdid', '=', $userid],
                ])->count();

                if (!($qcheckcount > 0)) {

                    if ($p == 1) {

                        $firstquestionid = $question->id;
                    }

                    DB::table('questionselecttracker')->insert(
                        [
                            'qsid' => $question->id,
                            'qstype' => $qstype,
                            'stdid' => $userid,
                        ]
                    );

                    DB::table('examseatdata')->insertGetId(
                        [
                            'position' => $qnumber,
                            'examseatid' => $examseatid,
                            'questiontype' => $qstype,
                            'questionid' => $question->id,
                            'questionheader' => $question->questionheader,
                            'qsubject' => $question->subjectid,
                            'answer' => 'NE',
                            'correct' => '0',
                            'marks' => '0',
                            'status' => '0',
                            'created_at' => NOW(),
                            'updated_at' => NOW(),
                        ]
                    );

                    $thisqid = $question->id;
                    $currentquestion = DB::table('questionsmain')->where('id', '=', $thisqid)->get();
                    $questionsubdata = "";
                    $fillindata = "";
                    $questiontype = $currentquestion[0]->qstype;
                    if ($questiontype == "MCQ") {
                        $questionsubdata    = DB::table('questions_mcq')->where('qsid', '=', $thisqid)->get();
                    } elseif ($questiontype == "TRUEFALSE") {
                        $questionsubdata    = DB::table('questions_truefalse')->where('qsid', '=', $thisqid)->get();
                    } elseif ($questiontype == "MATCHING") {
                        $questionsubdata    = DB::table('questions_matching')->where('qsid', '=', $thisqid)->get();
                    } elseif ($questiontype == "SHORT") {
                        $questionsubdata    = DB::table('questions_short')->where('qsid', '=', $thisqid)->get();
                    } elseif ($questiontype == "ESSAY") {
                        $questionsubdata    = DB::table('questions_essay')->where('qsid', '=', $thisqid)->get();
                    } elseif ($questiontype == "FILLBLANKS") {
                        $questionsubdata    = DB::table('fillblanksquestionheaders')->where('qsid', '=', $thisqid)->get();
                        $fillindata    = DB::table('fillblanksexpected')->where('qsid', '=', $thisqid)->get();
                    }

                    $questioncore[$qnumber]['questionmain'] = $currentquestion;
                    $questioncore[$qnumber]['questionsubdata'] = $questionsubdata;
                    $questioncore[$qnumber]['fillindata'] = $fillindata;
                    $qnumber++;

                    $p++;


                    $c++;

                    if ($qcounter == $qscount) {
                        break;
                    }

                    $qcounter++;
                }
            }
        }

        $questionposition = 1;
        $currentquestion = DB::table('questionsmain')->where('id', '=', $firstquestionid)->get();
        $questionsubdata = "";
        $fillindata = "";
        $questiontype = $currentquestion[0]->qstype;
        if ($questiontype == "MCQ") {
            $questionsubdata    = DB::table('questions_mcq')->where('qsid', '=', $firstquestionid)->get();
        } elseif ($questiontype == "TRUEFALSE") {
            $questionsubdata    = DB::table('questions_truefalse')->where('qsid', '=', $firstquestionid)->get();
        } elseif ($questiontype == "MATCHING") {
            $questionsubdata    = DB::table('questions_matching')->where('qsid', '=', $firstquestionid)->get();
        } elseif ($questiontype == "SHORT") {
            $questionsubdata    = DB::table('questions_short')->where('qsid', '=', $firstquestionid)->get();
        } elseif ($questiontype == "ESSAY") {
            $questionsubdata    = DB::table('questions_essay')->where('qsid', '=', $firstquestionid)->get();
        } elseif ($questiontype == "FILLBLANKS") {
            $questionsubdata    = DB::table('fillblanksquestionheaders')->where('qsid', '=', $firstquestionid)->get();
            $fillindata    = DB::table('fillblanksexpected')->where('qsid', '=', $firstquestionid)->get();
        }



        $dataset = [
            'examid' => $examid,
            'examseatid' => $examseatid,
            'examdata' => $examdata,
            'examname' => $examname,
            'examsubdata' => $examsubdata,
            'questioncore' => $questioncore,
            'questioncount' => $numberofquestion,
            'questionposition' => $questionposition,
            'questiontype' => $questiontype,
            'questionmain' => $currentquestion,
            'questionsubdata' => $questionsubdata,
            'fillindata' => $fillindata,
            'c' => $c,
            'duration_hours' => $duration_hrs,
            'duration_minutes' => $duration_mns,
        ];
        return view('pages.examstart')->with('dataset', $dataset);
    }

    public function nextajaxexam(Request $request)
    {
        $examseatid = $request->input('seatid');
        $position = $request->input('qspoistion');
        $qsid = $request->input('qsid');
        $answer = $request->input('answer');
        $iscorrect = $request->input('iscorrect');
        $qsstatus = $request->input('qsstatus');
        DB::table('examseatdata')
            ->where(
                [
                    ['examseatid', '=', $examseatid],
                    ['position', '=', $position],
                    ['questionid', '=', $qsid],

                ]
            )
            ->update([

                'answer' => $answer,
                'correct' => $iscorrect,
                'status' => $qsstatus,

            ]);
    }
    public function saveexamanswer(Request $request)
    {

        $questionid = $request->input('qsid');
        $position = $request->input('qposition');
        $examseatid = $request->input('examseatid');
        $correctanswer = $request->input('correctanser');
        $qstype = $request->input('qstype');
        if ($correctanswer == 1) {
            $correctanswer = 'CORRECT';
        } else {
            $correctanswer = 'WRONG';
        }
        $thisanswer = 'NA';
        if ($qstype == 'SHORT') {
            $thisanswer = $request->input('answer');
        } else if ($qstype == 'ESSAY') {
            $thisanswer = $request->input('answer');
        }

        DB::table('examseatdata')
            ->where(
                [
                    ['position', '=', $position],
                    ['examseatid', '=', $examseatid],
                    ['questiontype', '=', $qstype],
                    ['questionid', '=', $questionid],
                ]
            )
            ->update([
                'answer' => $thisanswer,
                'correct' => $correctanswer,
                'status' => 'A',

            ]);
    }

    public function papercorrectionpage($id)
    {

        $seatdata = DB::table('examseatdata')->where([
            ['examseatid', '=', $id],
            ['questiontype', '=', 'SHORT'],
            ['questiontype', '=', 'ESSAY'],
        ])->get();

        $e = 1;
        $qsdataset = [];
        foreach ($seatdata as $seatentry) {
            $qsdataset[$e] = DB::table('questionsmain')->where([
                ['id', '=', $seatentry->questionid],
            ])->get();
            $e++;
        }

        $dataset = [
            'qsdataset' => $qsdataset,
            'examseatdata' => $seatdata,
        ];

        return view('pages.papercorrectionreview')->with('dataset', $dataset);
    }

    public function saveanswermcq(Request $request)
    {

        //updaate the examseat data with MCQ answer
        $examSeatID = $request->input('examseat');
        $questionID = $request->input('qsnumber');
        $answer = $request->input('givenAnswer');
        $thisQsMarks = 0;
        //get the alocated marks
        $qsDataSet = DB::table('questionsmain')->where('id', '=', $questionID)->get();
        if ($answer == 'true') {
            $allocatedMarks = $qsDataSet[0]->marksallocated;
            $thisQsMarks = $allocatedMarks;
        } else {
            $allocatedMarks = $qsDataSet[0]->marksnegative;
            $thisQsMarks = $allocatedMarks * -1;
        }

        DB::table('examseatdata')
            ->where([
                ['examseatid', '=', $examSeatID],
                ['questionid', '=', $questionID],
                ['questiontype', '=', 'MCQ'],
            ])
            ->update([
                'correct' => $answer,
                'marks' => $thisQsMarks,
                'status' => 'A'
            ]);

        return 0;
    }

    public function saveanswerfillblanks(Request $request)
    {

        $examSeatID = $request->input('examseat');
        $questionID = $request->input('qsnumber');
        $answer = $request->input('givenAnswer');
        $thisQsMarks = 0;
        if ($answer == 'true') {
            //get the alocated marks
            $qsDataSet = DB::table('questionsmain')->where('id', '=', $questionID)->get();
            $allocatedMarks = $qsDataSet[0]->marksallocated;
            $thisQsMarks = $allocatedMarks;
        }
        DB::table('examseatdata')
            ->where([
                ['examseatid', '=', $examSeatID],
                ['questionid', '=', $questionID],
                ['questiontype', '=', 'FILLBLANKS'],
            ])
            ->update([
                'correct' => $answer,
                'marks' => $thisQsMarks,
                'status' => 'A'
            ]);

        return 0;
    }

    public function saveanswertruefalse(Request $request)
    {

        $examSeatID = $request->input('examseat');
        $questionID = $request->input('qsnumber');
        $answer = $request->input('givenAnswer');
        $thisQsMarks = 0;
        if ($answer == 'true') {
            //get the alocated marks
            $qsDataSet = DB::table('questionsmain')->where('id', '=', $questionID)->get();
            $allocatedMarks = $qsDataSet[0]->marksallocated;
            $thisQsMarks = $allocatedMarks;
        }

        DB::table('examseatdata')
            ->where([
                ['examseatid', '=', $examSeatID],
                ['questionid', '=', $questionID],
                ['questiontype', '=', 'TRUEFALSE'],
            ])
            ->update([
                'correct' => $answer,
                'marks' => $thisQsMarks,
                'status' => 'A'
            ]);

        return 0;
    }

    public function saveanswermatching(Request $request)
    {

        $examSeatID = $request->input('examseat');
        $questionID = $request->input('qsnumber');
        $answer = $request->input('givenAnswer');
        $thisQsMarks = 0;
        if ($answer == 'true') {
            //get the alocated marks
            $qsDataSet = DB::table('questionsmain')->where('id', '=', $questionID)->get();
            $allocatedMarks = $qsDataSet[0]->marksallocated;
            $thisQsMarks = $allocatedMarks;
        }

        DB::table('examseatdata')
            ->where([
                ['examseatid', '=', $examSeatID],
                ['questionid', '=', $questionID],
                ['questiontype', '=', 'MATCHING'],
            ])
            ->update([
                'correct' => $answer,
                'marks' => $thisQsMarks,
                'status' => 'A'
            ]);

        return 0;
    }

    public function saveanswershort(Request $request)
    {

        $examSeatID = $request->input('examseat');
        $questionID = $request->input('qsnumber');
        $answer = $request->input('givenAnswer');


        DB::table('examseatdata')
            ->where([
                ['examseatid', '=', $examSeatID],
                ['questionid', '=', $questionID],
                ['questiontype', '=', 'SHORT'],
            ])
            ->update([
                'correct' => 'NA',
                'answer' => $answer,
                'status' => 'A'
            ]);

        return 0;
    }

    public function saveansweressay(Request $request)
    {


        $examSeatID = $request->input('examseat');
        $questionID = $request->input('qsnumber');
        $answer = $request->input('givenAnswer');

        DB::table('examseatdata')
            ->where([
                ['examseatid', '=', $examSeatID],
                ['questionid', '=', $questionID],
                ['questiontype', '=', 'ESSAY'],
            ])
            ->update([
                'correct' => 'NA',
                'answer' => $answer,
                'status' => 'A'
            ]);

        return 0;
    }

    public function examfinishedupdate(Request $request)
    {

        $examSeatID = $request->input('examseat');
        $studentID = $request->input('studentid');
        $examSeatData = DB::table('examseat')->where('id', '=', $examSeatID)->get();
        $examSeatMarks = DB::table('examseatdata')->where('examseatid', '=', $examSeatID)->sum('marks');

        DB::table('examseat')
            ->where([
                ['id', '=', $examSeatID],

            ])
            ->update([
                'status' => '1',
                'marks' => $examSeatMarks,
            ]);

        DB::table('studenttransactions')
            ->where([
                ['productid', '=', $examSeatData[0]->examid],
                ['studentid', '=', $studentID],
            ])
            ->update([
                'status' => '9',
            ]);

        $studentdata = DB::table('students')->where('studentid', '=', $studentID)->get();
        $examseatdata = DB::table('examseatdata')->where('examseatid', '=', $examSeatID)->get();
        $examseatmaindata = DB::table('examseat')->where('id', '=', $examSeatID)->get();
        $studentEmail =      $studentdata[0]->email;
        $examname =    $examseatmaindata[0]->examname;

        //send the results via email
        $data = [
            'studentname' =>  $studentdata[0]->studentname,
            'examname' =>  $examname,
            'examseatdata' =>   $examseatdata,
            'totalmarks' => $examSeatMarks,
        ];

        Mail::to($studentEmail)->send(new StudentResults($data));
    }

    public function answercanvas($idvalues)
    {

        $expldedList = explode('-', $idvalues);
        $examseatid = $expldedList[0];
        $questionid = $expldedList[1];
        $dataset = [
            'examseatid' => $examseatid,
            'questionid' => $questionid,
        ];
        return view('pages.answercanvas')->with('dataset', $dataset);
    }

    public function openpapercorrection($idvalues)
    {

        $explodedList = explode('-', $idvalues);
        $examseatid = $explodedList[0];
        $questionid = $explodedList[1];

        $examAnswerData = DB::table('examseatdata')->where([
            ['examseatid', '=', $examseatid],
            ['questionid', '=', $questionid],
        ])->get();
        $questiondata = DB::table('questionsmain')->where([
            ['id', '=', $questionid],
        ])->get();
        $questionSubData =  DB::table('questions_essay')->where([
            ['qsid', '=', $questionid],
        ])->get();

        $questionpendata =  DB::table('examseatcanvasentries')->where([
            ['examseatid', '=', $examseatid],
            ['qscode', '=', $questionid],
        ])->get();



        $dataset = [
            'examseatid' => $examseatid,
            'questionid' => $questionid,
            'examAnswerData' => $examAnswerData,
            'questiondata' => $questiondata,
            'questionSubData' => $questionSubData,
            'questionpendata' => $questionpendata,
        ];

        return view('pages.papercorrectionreview')->with('dataset', $dataset);
    }

    public function complatepapercorrection(Request $request)
    {

        $examseatid = $request->input('examseatid');
        $questionid = $request->input('questionid');
        $givenMarks = $request->input('marks');


        DB::table('examseatdata')
            ->where([
                ['examseatid', '=', $examseatid],
                ['questionid', '=', $questionid],
            ])
            ->update([
                'status' => 'M',
                'marks' => $givenMarks,
            ]);

        //get the next question
        $nextqsdata  = DB::table('examseatdata')->where([
            ['status', '=', 'A'],
        ])->where(function ($query) {
            $query->where('questiontype', '=', 'SHORT')
                ->orWhere('questiontype', '=', 'ESSAY');
        })->get();

        if (count($nextqsdata) > 0) {

            $examseatid = $nextqsdata[0]->examseatid;
            $questionid = $nextqsdata[0]->questionid;

            $examAnswerData = DB::table('examseatdata')->where([
                ['examseatid', '=', $examseatid],
                ['questionid', '=', $questionid],
            ])->get();
            $questiondata = DB::table('questionsmain')->where([
                ['id', '=', $questionid],
            ])->get();
            $questionSubData =  DB::table('questions_essay')->where([
                ['qsid', '=', $questionid],
            ])->get();

            $questionpendata =  DB::table('examseatcanvasentries')->where([
                ['examseatid', '=', $examseatid],
                ['qscode', '=', $questionid],
            ])->get();



            $dataset = [
                'examseatid' => $examseatid,
                'questionid' => $questionid,
                'examAnswerData' => $examAnswerData,
                'questiondata' => $questiondata,
                'questionSubData' => $questionSubData,
                'questionpendata' => $questionpendata,
            ];

            return view('pages.papercorrectionreview')->with('dataset', $dataset);
        } else {
            return redirect('/papercorrection');
        }
    }

    public function viweexamresults($seatid)
    {

        $examseatid = $seatid;

        $exammainData = DB::table('examseat')->where([
            ['id', '=', $examseatid],
        ])->get();

        $examSubData  =  DB::table('examseatdata')->where([
            ['examseatid', '=', $examseatid],
        ])->get();

        $dataset = [
            'exammainData' => $exammainData,
            'examSubData' => $examSubData,
        ];

        return view('pages.examresults')->with('dataset', $dataset);
    }
}
