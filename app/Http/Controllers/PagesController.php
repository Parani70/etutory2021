<?php

namespace App\Http\Controllers;

use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class PagesController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        $userid = Auth::user()->id;
        if (Auth::user()->role == 'Data Entry') {
            $questiondata    = DB::table('questionsmain')->where([
                ['status', '=', '3'],
                ['enteredbyid', '=', $userid],
            ])->get();
            $questiondata_rejected    = DB::table('questionsmain')->where([
                ['status', '=', '4'],
                ['enteredbyid', '=', $userid],
            ])->get();
        } elseif (Auth::user()->role == 'Subject Owner') {
            $questiondata    = DB::table('questionsmain')->where([
                ['status', '=', '3'],
            ])->get();
            $questiondata_rejected    = DB::table('questionsmain')->where([
                ['status', '=', '4'],
                ['enteredbyid', '=', $userid],
            ])->get();
        } else {
            $questiondata    = DB::table('questionsmain')->where([
                ['status', '=', '3'],
            ])->get();
            $questiondata_rejected    = DB::table('questionsmain')->where([
                ['status', '=', '4'],
                ['enteredbyid', '=', $userid],
            ])->get();
        }
        //$questiondata    = DB::table('questionsmain')->where('status', '=', '3')->get();
        $examtypedata    = DB::table('examtypes')->get();
        $categorydata    = DB::table('categories')->get();
        $subcategorydata = [];
        if (count($categorydata) > 0) {
            $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
        }

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
            'questiondata_rejected' => $questiondata_rejected,
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

    public function home()
    {
        if (Auth::check()) {


            $user = Auth::user();

            if ($user->role == 'Student') {

                $subjectdata    = DB::table('subjects')->get();
                $promotiondata    = DB::table('promotions')->where('status', '=', 'A')->get();
                $coursedata    = DB::table('papertemplates')->where([
                    ['subjectid', '=', $subjectdata[0]->id],
                  
                ])->get();
                $userid = Auth::user()->id;
                $cartdata =  DB::table('shoppingcart')->where([
                    ['userid', '=', $userid],
                    ['status', '=', 'O'],
                ])->get();
                $entries = 0;
                if (count($cartdata) > 0) {
                    $entries = $cartdata[0]->entries;
                }

                $exampuchasedata = DB::table('studenttransactions')->where([
                    ['studentid', '=', $userid],
                    ['status', '=', '1'],
                ])->count();

                $expiredays = DB::table('studenttransactions')->where([
                    ['studentid', '=', $userid],
                    ['status', '=', '1'],
                ])->min('created_at');

                $datepluse30 = date('m/d/Y', strtotime('+30 days', strtotime($expiredays)));
                $expiredays = date('m/d/Y');

                $datediff = strtotime($datepluse30) - strtotime($expiredays);

                $expireDatesDifferance = round($datediff / (60 * 60 * 24));

                $dataset = [
                    'subjectdata' => $subjectdata,
                    'promotiondata' => $promotiondata,
                    'coursedata' => $coursedata,
                    'cartentries' => $entries,
                    'exampuchasedata' => $exampuchasedata,
                    'expiredays' => $expireDatesDifferance,
                ];
                
                return view('pages.elearninghome')->with('dataset', $dataset);
            } else {
                return redirect('/dashboard');
            }
        } else {
            $examdata    = DB::table('papertemplates')->get();
            $promotiondata    = DB::table('promotions')->get();
            $pricingdata    = DB::table('exampricing')->get();
            $dataset = [
                'examdata' => $examdata,
                'promotiondata' => $promotiondata,
                'pricingdata' => $pricingdata,

            ];
           // return view('pages.home2')->with('dataset', $dataset);
             return view('pages.homepage')->with('dataset', $dataset);
          
        }
    }

    public function loginpage()
    {
        return view('pages.login');
    }

    public function aboutus()
    {
        return view('pages.aboutus');
    }
    public function registernewstudent()
    {
        $examdata =  DB::table('papertemplates')->get();
        $securityquestions = DB::table('securityquestions')->where([
            ['status', '=', 'A'],

        ])->get();

        $passwordpolicy = DB::table('passwordpolicy')->get();
        $dataset = [
            'examdata' => $examdata,
            'securityquestions' => $securityquestions,
            'passwordpolicy' => $passwordpolicy,

        ];
        return view('pages.registersimple')->with('dataset', $dataset);
    }

    public function elearninghome()
    {
        if(Auth::check()){

            $subjectdata    = DB::table('subjects')->get();
        $promotiondata    = DB::table('promotions')->get();
        $coursedata    = DB::table('papertemplates')->where('subjectid', '=', $subjectdata[0]->id)->get();
        $userid = Auth::user()->id;
        $cartdata =  DB::table('shoppingcart')->where([
            ['userid', '=', $userid],
            ['status', '=', 'O'],
        ])->get();
        if (count($cartdata) > 0) {
            $entries = $cartdata[0]->entries;
        } else {
            $entries = 0;
        }

        $exampuchasedata = DB::table('studenttransactions')->where([
            ['studentid', '=', $userid],
            ['status', '=', '1'],
        ])->count();

        $expiredays = DB::table('studenttransactions')->where([
            ['studentid', '=', $userid],
            ['status', '=', '1'],
        ])->min('created_at');

        $datepluse30 = date('m/d/Y', strtotime('+30 days', strtotime($expiredays)));
        $expiredays = date('m/d/Y');

        $datediff = strtotime($datepluse30) - strtotime($expiredays);

        $expireDatesDifferance = round($datediff / (60 * 60 * 24));;

        $dataset = [
            'subjectdata' => $subjectdata,
            'promotiondata' => $promotiondata,
            'coursedata' => $coursedata,
            'cartentries' => $entries,
            'exampuchasedata' => $exampuchasedata,
            'expiredays' => $expireDatesDifferance,
        ];

        return view('pages.elearninghome')->with('dataset', $dataset);

        }else{

            return redirect('/');
        }
        
    }

    public function launchexam($id)
    {

        $examStudentTransData = DB::table('studenttransactions')->where('id', '=', $id)->get();
        $examData = DB::table('papertemplates')->where('id', '=', $examStudentTransData[0]->productid)->get();
        $examcount = DB::table('papertemplates')->where('id', '=', $examStudentTransData[0]->productid)->count();
        $dataset = [
            'examid' => $examStudentTransData[0]->productid,
            'examStudentTransData' => $examStudentTransData,
            'examData' => $examData,
            'examcount' => $examcount,

        ];

        return view('pages.examlaunch')->with('dataset', $dataset);
    }

    public function userprofileadmin($id)
    {
        $userdata    = DB::table('users')->where('id', '=', $id)->get();
        $myDateFirst = Date('Y-m-') . '01';
        $myDateLast = Date('Y-m-t');

        $dataset = [
            'userdata' => $userdata,            
        ];

        return view('pages.userprofileadmin')->with('dataset', $dataset);
    }

    public function userprofile($id)
    {
        $userdata    = DB::table('users')->where('id', '=', $id)->get();
        $myDateFirst = Date('Y-m-') . '01';
        $myDateLast = Date('Y-m-t');


        $questionsThisMonth = DB::table('questionsmain')->where([
            ['enteredbyid', '=', Auth::user()->id],
        ])->whereBetween('created_at', [$myDateFirst, $myDateLast])->count();
        $questionsApprovedThisMonth = DB::table('questionsmain')->where([
            ['enteredbyid', '=', Auth::user()->id],
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
            'userdata' => $userdata,
            'questionsThisMonth' => $questionsThisMonth,
            'accuracy' => $accuracy,
            'alowance' => $eligibalAllwance,

        ];

        return view('pages.userprofile')->with('dataset', $dataset);
    }

    public function promotionselect($id)
    {
        $subjectdata    = DB::table('subjects')->get();
        $promodata    = DB::table('promotions')->where('id', '=', $id)->get();
        $promotype = $promodata[0]->promotype;
        $dataset = [
            'subjectdata' => $subjectdata,
            'promotype' => $promotype,
            'promodata' => $promodata,
        ];
        return view('pages.promotionselect')->with('dataset', $dataset);
    }

    public function paymentselect()
    {

        return view('pages.paymentselect');
    }

    public function paymentmanger()
    {
        if (Auth::check()) {

            $examsdata = DB::table('studenttransactions')->where([
                'status' => '1',
                'paystatus' => '0',
                'paymethod' => 'bank',
            ])->get();

            $promotiondata = DB::table('studentpromotrans')->where([             
                'paystatus' => '0',
                'paymethod' => 'bank',
            ])->get();

            $dataset = [
                'examsdata' => $examsdata,
                'promotiondata' => $promotiondata,
                'view' => 'N',
                'type' => 'exam',
            ];
            return view('pages.paymentsmanager')->with('dataset', $dataset);
        } else {
            return view('pages.home');
        }
    }

    public function paymentmangerview($id)
    {
        if (Auth::check()) {

            $examsdata = DB::table('studenttransactions')->where([
                'status' => '1',
                'paystatus' => '0',
                'paymethod' => 'bank',
            ])->get();
            $transimagedata = DB::table('studenttransactions')->where([
                'id' => $id,
            ])->get();

            $promotiondata = DB::table('studentpromotrans')->where([             
                'paystatus' => '0',
                'paymethod' => 'bank',
            ])->get();

            $dataset = [
                'examsdata' => $examsdata,
                'promotiondata' => $promotiondata,
                'transimagedata' => $transimagedata,
                'view' => 'Y',
                'type' => 'exam',

            ];
            return view('pages.paymentsmanager')->with('dataset', $dataset);
        } else {
            return view('pages.home');
        }
    }

    public function examhome()
    {
        if (Auth::check()) {

            $studentEmail = Auth::user()->email;
            $examsdata = DB::table('studenttransactions')->where([
                ['email', '=', $studentEmail],
                ['paystatus', '=', '1'],
                ['status', '=', '1'],
            ])->get();

            $promotransdata = DB::table('studentpromotrans')->where([
                ['email', '=', $studentEmail],
                ['paystatus', '=', '1'],
               
            ])->get();
            $dataset = [
                'examsdata' => $examsdata,
                'promotransdata' => $promotransdata,

            ];
            return view('pages.examhome')->with('dataset', $dataset);
        } else {
            return view('pages.home');
        }
    }

    public function addpromotion()
    {

        $gradeData = DB::table('grades')->where('status','=','A')->get();

        $dataset = [
            'gradedata' => $gradeData,
        ];
        return view('pages.addpromotion')->with('dataset',$dataset);
    }

    public function addpromocode()
    {

        $examtypes = DB::table('examtypes')->where('status', '=', 'A')->get();
        $grades = DB::table('grades')->where('status', '=', 'A')->get();
        $subjects = DB::table('subjects')->where('status', '=', 'A')->get();
        $promotions = DB::table('promotions')->where('status', '=', 'A')->get();
        $dataset = [
            'examtypes' => $examtypes,
            'grades' => $grades,
            'subjects' => $subjects,
            'promotions' => $promotions,
        ];

        return view('pages.addpromocode')->with('dataset', $dataset);
    }

    public function passwordpolicy()
    {
        $securityquestions = DB::table('securityquestions')->where([
            ['status', '=', 'A'],

        ])->get();
        $passwordpolicy = DB::table('passwordpolicy')->where([
            ['status', '=', 'A'],

        ])->get();
        $dataset = [
            'securityquestionsdata' => $securityquestions,
            'passwordpolicy' => $passwordpolicy,
        ];

        return view('pages.passwordpolicy')->with('dataset', $dataset);
    }

    public function addnewsecurityquestion()
    {

        return view('pages.addnewsecurityquestion');
    }


    public function userroles()
    {
        $userrolesdata = DB::table('userroles')->get();
        $dataset = [
            'userrolesdata' => $userrolesdata,

        ];
        return view('pages.roles')->with('dataset', $dataset);
    }

    public function privileges()
    {
        $privilegesdata = DB::table('privileges')->get();
        $dataset = [
            'privilegesdata' => $privilegesdata,

        ];
        return view('pages.privileges')->with('dataset', $dataset);
    }

    public function addprivilege()
    {

        return view('pages.addprivilege');
    }

    public function manageprivilege($id)
    {

        $prividata  = DB::table('privileges')->where('id', '=', $id)->get();
        $dataset = [
            'prividata' => $prividata,

        ];
        return view('pages.manageprivilege')->with('dataset', $dataset);
    }

    public function userlist()
    {
        $usersdata = DB::table('users')->where('role', '!=', 'Student')->get();
        $dataset = [
            'usersdata' => $usersdata,

        ];
        return view('pages.userlist')->with('dataset', $dataset);
    }

    public function studentslist()
    {
        $usersdata = DB::table('users')->where('role', '=', 'Student')->get();
        $dataset = [
            'usersdata' => $usersdata,

        ];
        return view('pages.studentlist')->with('dataset', $dataset);
    }

    public function dataentrylist()
    {
        $usersdata = DB::table('users')->where('role', '=', 'Data Entry')->get();
        $dataset = [
            'usersdata' => $usersdata,

        ];
        return view('pages.dataentrylist')->with('dataset', $dataset);
    }

    public function addnewuser()
    {
        $roledata = DB::table('userroles')->get();
        $passwordpolicy = DB::table('passwordpolicy')->get();
        $subjects = DB::table('subjects')->get();
        $dataset = [
            'roledata' => $roledata,
            'passwordpolicy' => $passwordpolicy,
            'subjects' => $subjects,
        ];
        return view('auth.register')->with('dataset', $dataset);
    }
    public function addrole()
    {

        $privilegesdata = DB::table('privileges')->where('status', '=', 'A')->get();
        $dataset = [
            'privilegesdata' => $privilegesdata,
        ];
        return view('pages.addrole')->with('dataset', $dataset);
    }


    public function examtypes()
    {
        $examtypedata    = DB::table('examtypes')->get();
        $dataset = [
            'examtypedata' => $examtypedata,
        ];
        return view('pages.examtypes')->with('dataset', $dataset);
    }

    public function addexamtype()
    {
        return view('pages.addexamtype');
    }

    public function subjects()
    {
        $subjectsdata    = DB::table('subjects')->get();
        $dataset = [
            'subjectsdata' => $subjectsdata,
        ];
        return view('pages.subjects')->with('dataset', $dataset);
    }

    public function addsubject()
    {
        return view('pages.addsubject');
    }

    public function categories()
    {
        $categoriesdata    = DB::table('categories')->get();
        $dataset = [
            'categoriesdata' => $categoriesdata,
        ];
        return view('pages.categories')->with('dataset', $dataset);
    }

    public function addcategory()
    {
        $gradedata    = DB::table('grades')->get();
        $subjectdata    = DB::table('subjects')->get();
        $dataset = [
            'gradedata' => $gradedata,
            'subjectdata' => $subjectdata,
        ];
        return view('pages.addcategory')->with('dataset', $dataset);
    }


    public function subcategories()
    {
        $subcategoriesdata    = DB::table('subcategories')->get();
        $dataset = [
            'subcategoriesdata' => $subcategoriesdata,
        ];
        return view('pages.subcategories')->with('dataset', $dataset);
    }

    public function addsubcategory()
    {
        $categoriesdata    = DB::table('categories')->get();
        $gradedata    = DB::table('grades')->get();
        $subjectdata    = DB::table('subjects')->get();
        $dataset = [
            'categoriesdata' => $categoriesdata,
            'gradedata' => $gradedata,
            'subjectdata' => $subjectdata,
        ];
        return view('pages.addsubcategory')->with('dataset', $dataset);
    }

    public function levels()
    {
        $levelsdata    = DB::table('levels')->get();
        $dataset = [
            'levelsdata' => $levelsdata,
        ];
        return view('pages.levels')->with('dataset', $dataset);
    }

    public function addlevel()
    {
        return view('pages.addlevel');
    }

    public function grades()
    {
        $gradesdata    = DB::table('grades')->get();
        $dataset = [
            'gradesdata' => $gradesdata,
        ];
        return view('pages.grades')->with('dataset', $dataset);
    }

    public function addgrade()
    {
        return view('pages.addgrade');
    }

    public function promotionsmanager()
    {
        $promotionsdata    = DB::table('promotions')->get();
        $dataset = [
            'promotionsdata' => $promotionsdata,
        ];
        return view('pages.promotionsmanager')->with('dataset', $dataset);
    }

    public function promocodemanager()
    {
        $promotionsdata    = DB::table('promocodes')->get();
        $dataset = [
            'promotionsdata' => $promotionsdata,
        ];
        return view('pages.promocodemanager')->with('dataset', $dataset);
    }

    /* Enter new Question Pages*/
    public function entermcqquestion()
    {

        if (Auth::check()) {

            $userid = Auth::user()->id;

            $examtypedata    = DB::table('examtypes')->where('status', '=', 'A')->get();
            $categorydata    = DB::table('categories')->where('status', '=', 'A')->get();
            $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
            $subjectdata    = DB::table('subjects')->where('status', '=', 'A')->get();
            $gradedata    = DB::table('grades')->where('status', '=', 'A')->get();
            $leveldata   = DB::table('levels')->where('status', '=', 'A')->get();

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
                'presettings' => 'false',
                'pre_examtype' => 'false',
                'pre_category' => 'false',
                'pre_subcategory' => 'false',
                'pre_answercount' => 'false',
                'pre_subject' => 'false',
                'pre_grade' => 'false',
                'pre_level' => 'false',
                'pre_correctanswercount' => 'false',
                'questionsThisMonth' => $questionsThisMonth,
                'accuracy' => $accuracy,
                'alowance' => $eligibalAllwance,
            ];

            return view('pages.entermcqquestion')->with('dataset', $dataset);
        } else {
            return view('pages.home');
        }
    }

    public function entertruefalsequestion()
    {

        if (Auth::check()) {

            $userid = Auth::user()->id;

            $examtypedata    = DB::table('examtypes')->where('status', '=', 'A')->get();
            $categorydata    = DB::table('categories')->where('status', '=', 'A')->get();
            $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
            $subjectdata    = DB::table('subjects')->where('status', '=', 'A')->get();
            $gradedata    = DB::table('grades')->where('status', '=', 'A')->get();
            $leveldata   = DB::table('levels')->where('status', '=', 'A')->get();

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
                'presettings' => 'false',
                'pre_examtype' => 'false',
                'pre_category' => 'false',
                'pre_subcategory' => 'false',
                'pre_answercount' => 'false',
                'pre_subject' => 'false',
                'pre_grade' => 'false',
                'pre_level' => 'false',
                'pre_correctanswercount' => 'false',
                'questionsThisMonth' => $questionsThisMonth,
                'accuracy' => $accuracy,
                'alowance' => $eligibalAllwance,
            ];

            return view('pages.entertruefalsequestion')->with('dataset', $dataset);
        } else {
            return view('pages.home');
        }
    }

    public function entermatchingquestion()
    {

        if (Auth::check()) {

            $userid = Auth::user()->id;
            $examtypedata    = DB::table('examtypes')->where('status', '=', 'A')->get();
            $categorydata    = DB::table('categories')->where('status', '=', 'A')->get();
            $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
            $subjectdata    = DB::table('subjects')->where('status', '=', 'A')->get();
            $gradedata    = DB::table('grades')->where('status', '=', 'A')->get();
            $leveldata   = DB::table('levels')->where('status', '=', 'A')->get();
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
                'presettings' => 'false',
                'pre_examtype' => 'false',
                'pre_category' => 'false',
                'pre_subcategory' => 'false',
                'pre_answercount' => 'false',
                'pre_subject' => 'false',
                'pre_grade' => 'false',
                'pre_level' => 'false',
                'pre_correctanswercount' => 'false',
                'questionsThisMonth' => $questionsThisMonth,
                'accuracy' => $accuracy,
                'alowance' => $eligibalAllwance,
            ];

            return view('pages.entermatchingquestion')->with('dataset', $dataset);
        } else {
            return view('pages.home');
        }
    }


    public function entershortquestion()
    {
        if (Auth::check()) {

            $userid = Auth::user()->id;
            $examtypedata    = DB::table('examtypes')->where('status', '=', 'A')->get();
            $categorydata    = DB::table('categories')->where('status', '=', 'A')->get();
            $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
            $subjectdata    = DB::table('subjects')->where('status', '=', 'A')->get();
            $gradedata    = DB::table('grades')->where('status', '=', 'A')->get();
            $leveldata   = DB::table('levels')->where('status', '=', 'A')->get();

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
                'presettings' => 'false',
                'pre_examtype' => 'false',
                'pre_category' => 'false',
                'pre_subcategory' => 'false',
                'pre_answercount' => 'false',
                'pre_subject' => 'false',
                'pre_grade' => 'false',
                'pre_level' => 'false',
                'pre_correctanswercount' => 'false',
                'questionsThisMonth' => $questionsThisMonth,
                'accuracy' => $accuracy,
                'alowance' => $eligibalAllwance,
            ];

            return view('pages.entershortquestion')->with('dataset', $dataset);
        } else {
            return view('pages.home');
        }
    }

    public function enteressayquestion()
    {
        if (Auth::check()) {

            $userid = Auth::user()->id;
            $examtypedata    = DB::table('examtypes')->where('status', '=', 'A')->get();
            $categorydata    = DB::table('categories')->where('status', '=', 'A')->get();
            $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
            $subjectdata    = DB::table('subjects')->where('status', '=', 'A')->get();
            $gradedata    = DB::table('grades')->where('status', '=', 'A')->get();
            $leveldata   = DB::table('levels')->where('status', '=', 'A')->get();

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
                'presettings' => 'false',
                'pre_examtype' => 'false',
                'pre_category' => 'false',
                'pre_subcategory' => 'false',
                'pre_answercount' => 'false',
                'pre_subject' => 'false',
                'pre_grade' => 'false',
                'pre_level' => 'false',
                'pre_correctanswercount' => 'false',
                'questionsThisMonth' => $questionsThisMonth,
                'accuracy' => $accuracy,
                'alowance' => $eligibalAllwance,
            ];

            Cookie::queue(Cookie::forget('essayentryid'));

            $essayentryid = 'E' . rand();
            Cookie::queue('essayentryid', $essayentryid, 200);
            Cookie::queue('handraw_guidlines', '0', 200);
            return view('pages.enteressayquestion')->with('dataset', $dataset);
        } else {
            return view('pages.home');
        }
    }


    public function enterfillblanksquestion()
    {
        if (Auth::check()) {

            $userid = Auth::user()->id;
            $examtypedata    = DB::table('examtypes')->where('status', '=', 'A')->get();
            $categorydata    = DB::table('categories')->where('status', '=', 'A')->get();
            $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
            $subjectdata    = DB::table('subjects')->where('status', '=', 'A')->get();
            $gradedata    = DB::table('grades')->where('status', '=', 'A')->get();
            $leveldata   = DB::table('levels')->where('status', '=', 'A')->get();

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
                'presettings' => 'false',
                'pre_examtype' => 'false',
                'pre_category' => 'false',
                'pre_subcategory' => 'false',
                'pre_answercount' => 'false',
                'pre_subject' => 'false',
                'pre_grade' => 'false',
                'pre_level' => 'false',
                'pre_correctanswercount' => 'false',
                'questionsThisMonth' => $questionsThisMonth,
                'accuracy' => $accuracy,
                'alowance' => $eligibalAllwance,
            ];

            return view('pages.enterfillblanksquestion')->with('dataset', $dataset);
        } else {
            return view('pages.home');
        }
    }


    public function savedquestionsqueu()
    {

        if (Auth::check()) {

            $userid = Auth::user()->id;
            if (Auth::user()->role == 'Data Entry') {
                $questiondata    = DB::table('questionsmain')->where([
                    ['status', '=', '3'],
                    ['enteredbyid', '=', $userid],
                ])->get();
            } else {
                $questiondata    = DB::table('questionsmain')->where([
                    ['status', '=', '3'],
                ])->get();
            }
            $examtypedata    = DB::table('examtypes')->get();
            $categorydata    = DB::table('categories')->get();
            $subcategorydata = [];
            if (count($categorydata) > 0) {
                $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
            }
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
            return view('pages.savedquestionsqueu')->with('dataset', $dataset);
        } else {
            return view('pages.home');
        }
    }

    public function forapprovequestionsqueu()
    {
        if (Auth::check()) {

            $userid = Auth::user()->id;
            $userlang = Auth::user()->language1;
            if (Auth::user()->role == 'Data Entry') {
                $questiondata    = DB::table('questionsmain')->where([
                    ['status', '=', '1'],
                    ['enteredbyid', '=', $userid],
                    ['userlanguage', '=', $userlang],
                ])->get();
            } else {
                $questiondata    = DB::table('questionsmain')->where([
                    ['status', '=', '1'],
                    ['userlanguage', '=', $userlang],
                ])->get();
            }
            $examtypedata    = DB::table('examtypes')->get();
            $categorydata    = DB::table('categories')->get();
            $subcategorydata = [];
            if (count($categorydata) > 0) {
                $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
            }
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
        } else {
            return view('pages.home');
        }
    }

    public function onholdquestionsqueu()
    {

        if (Auth::check()) {

            $userid = Auth::user()->id;
            $userlang = Auth::user()->language1;
            if (Auth::user()->role == 'Data Entry') {
                $questiondata    = DB::table('questionsmain')->where([
                    ['status', '=', '2'],
                    ['enteredbyid', '=', $userid],
                    ['userlanguage', '=', $userlang],
                ])->get();
            } else {
                $questiondata    = DB::table('questionsmain')->where([
                    ['status', '=', '2'],
                    ['userlanguage', '=', $userlang],
                ])->get();
            }

            $examtypedata    = DB::table('examtypes')->get();
            $categorydata    = DB::table('categories')->get();
            $subcategorydata = [];
            if (count($categorydata) > 0) {
                $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
            }
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
            return view('pages.onholdquestionsqueu')->with('dataset', $dataset);
        } else {
            return view('pages.home');
        }
    }


    public function rejectedquestionsqueu()
    {

        if (Auth::check()) {

            $userid = Auth::user()->id;
            $userlang = Auth::user()->language1;
            if (Auth::user()->role == 'Data Entry') {
                $questiondata    = DB::table('questionsmain')->where([
                    ['status', '=', '4'],
                    ['enteredbyid', '=', $userid],
                    ['userlanguage', '=', $userlang],
                ])->get();
            } else {
                $questiondata    = DB::table('questionsmain')->where([
                    ['status', '=', '4'],
                    ['userlanguage', '=', $userlang],
                ])->get();
            }
            $examtypedata    = DB::table('examtypes')->get();
            $categorydata    = DB::table('categories')->get();
            $subcategorydata = [];
            if (count($categorydata) > 0) {
                $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
            }
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
            return view('pages.rejectedquestionsqueu')->with('dataset', $dataset);
        } else {
            return view('pages.home');
        }
    }

    public function searchquestion()
    {
        if (Auth::check()) {

            $userid = Auth::user()->id;
            $userlang = Auth::user()->language1;
            $questiondata    = [];
            $examtypedata    = DB::table('examtypes')->get();
            $categorydata    = DB::table('categories')->get();
            $subcategorydata = [];
            if (count($categorydata) > 0) {
                $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
            }
            $subjectdata    = DB::table('subjects')->get();
            $gradedata    = DB::table('grades')->get();
            $leveldata   = DB::table('levels')->get();
            $usersdata   = DB::table('users')->where('role', '!=', 'Student')->get();

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
                'usersdata' => $usersdata,
                'questionsThisMonth' => $questionsThisMonth,
                'accuracy' => $accuracy,
                'alowance' => $eligibalAllwance,
            ];
            return view('pages.searchquestions')->with('dataset', $dataset);
        } else {
            return view('pages.home');
        }
    }

    public function studenthistory()
    {
        $studentid = Auth::user()->id;
        $studentdata = DB::table('examseat')->where('userid', '=', $studentid)->orderBy('created_at', 'desc')->get();
        $studentpaydata = DB::table('studenttransactions')->where([
            ['studentid', '=', $studentid],
            ['status', '=', '0'],
        ])->orderBy('created_at', 'desc')->get();
        $dataset = [
            'studentdata' => $studentdata,
            'studentpaydata' => $studentpaydata,
        ];
        return view('pages.studenthistory')->with('dataset', $dataset);
    }

    public function examtemplates()
    {

        $papertemplates    = DB::table('papertemplates')->get();
        $examtypedata    = DB::table('examtypes')->get();
        $categorydata    = DB::table('categories')->get();
        $subcategorydata = [];
        if (count($categorydata) > 0) {
            $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
        }
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

    public function newexamtemplate()
    {
        $questiondata    = DB::table('questionsmain')->get();
        $examtypedata    = DB::table('examtypes')->get();
        $categorydata    = DB::table('categories')->get();
        $subcategorydata    = DB::table('subcategories')->where('parentcategoryid', '=', $categorydata[0]->id)->get();
        $subjectdata    = DB::table('subjects')->get();
        $gradedata    = DB::table('grades')->get();
        $leveldata   = DB::table('levels')->get();

        $dataset = [
            'questiondata' => $questiondata,
            'examtypedata' => $examtypedata,
            'categorydata' => $categorydata,
            'subcategorydata' => $subcategorydata,
            'subjectdata' => $subjectdata,
            'gradedata' => $gradedata,
            'leveldata' => $leveldata,
        ];

        return view('pages.newexamtemplate')->with('dataset', $dataset);
    }

    public function pricingmanager()
    {
        $pricingdata    = DB::table('exampricing')->get();
        $dataset = [
            'pricingdata' => $pricingdata,

        ];
        return view('pages.pricingmanager')->with('dataset', $dataset);
    }

    public function addnewpricing()
    {
        $examtypedata    = DB::table('examtypes')->get();
        $examtemplatedata    = DB::table('papertemplates')->get();
        $gradedata    = DB::table('grades')->get();
        $subjectsdata    = DB::table('subjects')->get();
        $dataset = [
            'examtypedata' => $examtypedata,
            'examtemplatedata' => $examtemplatedata,
            'gradedata' => $gradedata,
            'subjectsdata' => $subjectsdata,
        ];
        return view('pages.addnewpricing')->with('dataset', $dataset);
    }

    public function forgotmypassword()
    {
        $securityquestions = DB::table('securityquestions')->where([
            ['status', '=', 'A'],

        ])->get();
        $dataset = [
            'securityquestions' => $securityquestions,

        ];
        return view('pages.forgotpassword')->with('dataset', $dataset);
    }

    public function papercorrection()
    {

        $userrole = Auth::user()->role;
        $examseat    = DB::table('examseat')->get();
        $examseatdata    = DB::table('examseatdata')->where('examseatid', '=', $examseat[0]->id)->get();
        $subject = 'NA';
        $questionsData = array();
        $datacheck = 0;
        if ($userrole == 'Subject Owner' | $userrole == 'Teacher') {
            $subject = Auth::user()->subject;
            if ($subject  != 'NA') {

                $explodedlist = explode('-', $subject);
                $subjectid =  $explodedlist[0];
                $questionsData = DB::table('examseatdata')->where([
                    ['status', '=', 'A'],
                    ['qsubject', '=', $subjectid],
                ])->where(function ($query) {
                    $query->where('questiontype', '=', 'SHORT')
                        ->orWhere('questiontype', '=', 'ESSAY');
                })->get();

                $datacheck = 1;
            } else {

                $questionsData = array();
            }
        } else {

            $questionsData = array();
        }



        $dataset = [
            'examseat' => $examseat,
            'examseatdata' => $examseatdata,
            'questionsData' => $questionsData,
            'datacheck' => $datacheck,
        ];

        return view('pages.papercorrection')->with('dataset', $dataset);
    }

    public function courses()
    {

        $examsdata    = DB::table('papertemplates')->get();
        $gradedata    = DB::table('grades')->get();
        $subjectdata    = DB::table('subjects')->get();

        $dataset = [
            'examsdata' => $examsdata,
            'gradedata' => $gradedata,
            'subjectdata' => $subjectdata,
        ];
        return view('pages.coursesexamspage')->with('dataset', $dataset);
    }

    public function promopage()
    {

        $promodata    = DB::table('promotions')->where('status', '=', 'A')->get();
        $gradedata    = DB::table('grades')->get();
        $subjectdata    = DB::table('subjects')->get();
        $dataset = [
            'promodata' => $promodata,
            'gradedata' => $gradedata,
            'subjectdata' => $subjectdata,
        ];

        return view('pages.promopage')->with('dataset', $dataset);
    }

    public function privacypolicy()
    {
        return view('pages.privacypolicy');
    }

    public function contactus()
    {
        return view('pages.contactus');
    }
}
