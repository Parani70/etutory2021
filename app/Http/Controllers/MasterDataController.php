<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\BanktransferConfirmationMail;

class MasterDataController extends Controller
{
    public function saveexamtype(Request $request)
    {

        $this->validate($request, [
            'examtype' => 'required',
        ]);

        $examType = $request->input('examtype');

        DB::table('examtypes')->insert(
            [
                'examtype' => $examType,
                'status' => 'A',
                'userid' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'create_masterdata',
                'actionon' => 'Exam Types',
                'actiononentry' => $examType,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );


        return redirect('/examtypes')->with('response', '' . $examType);
    }

    public function manageexamtype($id)
    {

        $examtypedata    = DB::table('examtypes')->where('id', '=', $id)->get();
        $dataset = [
            'examtypedata' => $examtypedata,
        ];

        return view('pages.manageexamtype')->with('dataset', $dataset);
    }

    public function editexamtype(Request $request)
    {
        $this->validate($request, [
            'examtype' => 'required',
        ]);

        $examTypeId = $request->input('examtypeid');
        $examType = $request->input('examtype');

        DB::table('examtypes')
            ->where('id', $examTypeId)
            ->update(['examtype' => $examType]);

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'edit_masterdata',
                'actionon' => 'Exam Types',
                'actiononentry' => $examType,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/examtypes')->with('edit_response', '' . $examType);
    }

    public function removeexamtype($id)
    {

        $entrycount = DB::table('questionsmain')->where('examtypeid', '=', $id)->count();
        if ($entrycount > 0) {
            DB::table('examtypes')
                ->where('id', $id)
                ->update(['status' => 'D']);
        } else {
            DB::table('examtypes')->where('id', '=', $id)->delete();
        }

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'remove_masterdata',
                'actionon' => 'Exam Types',
                'actiononentry' => $id,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/examtypes')->with('delete_response', '' . $id);
    }

    public function savesubject(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required',
        ]);

        $subject = $request->input('subject');

        DB::table('subjects')->insert(
            [
                'subject' => $subject,
                'status' => 'A',
                'userid' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'create_masterdata',
                'actionon' => 'Subjects',
                'actiononentry' => $subject,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/subjects')->with('response', '' . $subject);
    }

    public function managesubject($id)
    {

        $examtypedata    = DB::table('subjects')->where('id', '=', $id)->get();
        $dataset = [
            'subjectdata' => $examtypedata,
        ];

        return view('pages.managesubject')->with('dataset', $dataset);
    }

    public function editsubject(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required',
        ]);

        $subjectId = $request->input('subjectid');
        $subject = $request->input('subject');

        DB::table('subjects')
            ->where('id', $subjectId)
            ->update(['subject' => $subject]);


        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'edit_masterdata',
                'actionon' => 'Subjects',
                'actiononentry' => $subject,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/subjects')->with('edit_response', '' . $subject);
    }

    public function removesubject($id)
    {

        $entrycount = DB::table('questionsmain')->where('subjectid', '=', $id)->count();
        if ($entrycount > 0) {
            DB::table('subjects')
                ->where('id', $id)
                ->update(['status' => 'D']);
        } else {
            DB::table('subjects')->where('id', '=', $id)->delete();
        }

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'remove_masterdata',
                'actionon' => 'Subjects',
                'actiononentry' => $id,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );


        return redirect('/subjects')->with('delete_response', '' . $id);
    }

    public function savecategory(Request $request)
    {
        $this->validate($request, [
            'category' => 'required',
        ]);

        $category = $request->input('category');

        $grade = $request->input('grade');
        $sarray = explode('-', $grade);
        $gradeid = $sarray[0];
        $gradename = $sarray[1];

        $subject = $request->input('subject');
        $sarray = explode('-', $subject);
        $subjectid = $sarray[0];
        $subjectname = $sarray[1];

        DB::table('categories')->insert(
            [
                'gradeid' => $gradeid,
                'gradename' => $gradename,
                'subjectid' => $subjectid,
                'subjectname' => $subjectname,
                'category' => $category,
                'status' => 'A',
                'userid' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'create_masterdata',
                'actionon' => 'Category',
                'actiononentry' => $category,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/categories')->with('response', '' . $category);
    }

    public function managecategory($id)
    {

        $categorydata    = DB::table('categories')->where('id', '=', $id)->get();
        $gradedata    = DB::table('grades')->get();
        $subjectdata    = DB::table('subjects')->get();
        $dataset = [
            'gradedata' => $gradedata,
            'subjectdata' => $subjectdata,
            'categorydata' => $categorydata,
        ];

        return view('pages.managecategory')->with('dataset', $dataset);
    }

    public function editcategory(Request $request)
    {
        $this->validate($request, [
            'category' => 'required',
        ]);

        $categoryId = $request->input('categoryid');
        $category = $request->input('category');
        $grade = $request->input('grade');
        $sarray = explode('-', $grade);
        $gradeid = $sarray[0];
        $gradename = $sarray[1];

        $subject = $request->input('subject');
        $sarray = explode('-', $subject);
        $subjectid = $sarray[0];
        $subjectname = $sarray[1];

        DB::table('categories')
            ->where('id', $categoryId)
            ->update([
                'gradeid' => $gradeid,
                'gradename' => $gradename,
                'subjectid' => $subjectid,
                'subjectname' => $subjectname,
                'category' => $category,
            ]);

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'edit_masterdata',
                'actionon' => 'Category',
                'actiononentry' => $category,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/categories')->with('edit_response', '' . $category);
    }


    public function removecategory($id)
    {

        $entrycount = DB::table('questionsmain')->where('categoryid', '=', $id)->count();
        if ($entrycount > 0) {
            DB::table('categories')
                ->where('id', $id)
                ->update(['status' => 'D']);
        } else {
            DB::table('categories')->where('id', '=', $id)->delete();
        }

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'remove_masterdata',
                'actionon' => 'Category',
                'actiononentry' => $id,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/categories')->with('delete_response', '' . $id);
    }

    public function savesubcategory(Request $request)
    {
        $this->validate($request, [
            'subcategory' => 'required',
        ]);

        $subcategory = $request->input('subcategory');
        $parentcategoryValue = $request->input('parentcategory');
        $splitlist = explode('-', $parentcategoryValue);
        $parentcategoryid = $splitlist[0];
        $parentcategoryName = $splitlist[1];

        $gradeValue = $request->input('grade');
        $splitlist = explode('-', $gradeValue);
        $gradeid = $splitlist[0];
        $gradename = $splitlist[1];

        $subjectValue = $request->input('subject');
        $splitlist = explode('-', $subjectValue);
        $subjectid = $splitlist[0];
        $subjectName = $splitlist[1];

        DB::table('subcategories')->insert(
            [
                'subcategory' => $subcategory,
                'parentcategoryid' => $parentcategoryid,
                'parentcategory' => $parentcategoryName,
                'gradeid' => $gradeid,
                'gradename' => $gradename,
                'subjectid' => $subjectid,
                'subjectname' => $subjectName,
                'status' => 'A',
                'userid' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'create_masterdata',
                'actionon' => 'Sub Category',
                'actiononentry' => $subjectName,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/subcategories')->with('response', '' . $subcategory . ' under ' . $parentcategoryName);
    }

    public function managesubcategory($id)
    {

        $subcategorydata    = DB::table('subcategories')->where('id', '=', $id)->get();
        $parentcategorydata    = DB::table('categories')->get();
        $gradedata    = DB::table('grades')->get();
        $subjectdata    = DB::table('subjects')->get();
        $dataset = [
            'subcategorydata' => $subcategorydata,
            'parentcategorydata' => $parentcategorydata,
            'gradedata' => $gradedata,
            'subjectdata' => $subjectdata,
        ];

        return view('pages.managesubcategory')->with('dataset', $dataset);
    }

    public function editsubcategory(Request $request)
    {
        $this->validate($request, [
            'subcategory' => 'required',
        ]);

        $subcategoryId = $request->input('subcategoryid');
        $subcategory = $request->input('subcategory');
        $parentcategoryValue = $request->input('parentcategory');
        $splitlist = explode('-', $parentcategoryValue);
        $parentcategoryid = $splitlist[0];
        $parentcategoryName = $splitlist[1];

        $gradeValue = $request->input('grade');
        $splitlist = explode('-', $gradeValue);
        $gradeid = $splitlist[0];
        $gradename = $splitlist[1];

        $subjectValue = $request->input('subject');
        $splitlist = explode('-', $subjectValue);
        $subjectid = $splitlist[0];
        $subjectName = $splitlist[1];


        DB::table('subcategories')
            ->where('id', $subcategoryId)
            ->update([
                'subcategory' => $subcategory,
                'gradeid' => $gradeid,
                'gradename' => $gradename,
                'subjectid' => $subjectid,
                'subjectname' => $subjectName,
                'parentcategoryid' => $parentcategoryid,
                'parentcategory' => $parentcategoryName,
            ]);

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'edit_masterdata',
                'actionon' => 'Sub Category',
                'actiononentry' => $subcategory,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/subcategories')->with('edit_response', '' . $subcategory);
    }

    public function removesubcategory($id)
    {

        $entrycount = DB::table('questionsmain')->where('subcategoryid', '=', $id)->count();
        if ($entrycount > 0) {
            DB::table('subcategories')
                ->where('id', $id)
                ->update(['status' => 'D']);
        } else {
            DB::table('subcategories')->where('id', '=', $id)->delete();
        }

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'remove_masterdata',
                'actionon' => 'Sub Category',
                'actiononentry' => $id,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/subcategories')->with('delete_response', '' . $id);
    }

    public function savelevel(Request $request)
    {
        $this->validate($request, [
            'level' => 'required',
        ]);

        $level = $request->input('level');

        DB::table('levels')->insert(
            [
                'level' => $level,
                'status' => 'A',
                'userid' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'create_masterdata',
                'actionon' => 'Levels',
                'actiononentry' => $level,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/levels')->with('response', '' . $level);
    }


    public function savesecurityquestion(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
        ]);

        $question = $request->input('question');

        DB::table('securityquestions')->insert(
            [
                'question' => $question,
                'status' => 'A',
                'user' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/passwordpolicy')->with('response', '' . $question);
    }

    public function savepasswordpolicy(Request $request)
    {
        $this->validate($request, [
            'passwordlength' => 'required',
            'minattempts' => 'required',
        ]);

        $passwordlength = $request->input('passwordlength');
        $minattempts = $request->input('minattempts');
        $uppercase = 'N';
        $lowercase = 'N';
        $number = 'N';
        $symbol = 'N';

        if ($request->input('uppercase') == 'on') {
            $uppercase = 'Y';
        }

        if ($request->input('lowercase') == 'on') {
            $lowercase = 'Y';
        }

        if ($request->input('number') == 'on') {
            $number = 'Y';
        }

        if ($request->input('symbol') == 'on') {
            $symbol = 'Y';
        }

        DB::table('passwordpolicy')
            ->where('status', 'A')
            ->update(['status' => "C"]);

        DB::table('passwordpolicy')->insert(
            [
                'minlength' => $passwordlength,
                'minattempts' => $minattempts,
                'uppercase' => $uppercase,
                'lowercase' => $lowercase,
                'number' => $number,
                'symbol' => $symbol,
                'user' => 'NA',
                'status' => 'A',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/passwordpolicy')->with('response', '' . 'Password Policy');
    }

    public function managelevel($id)
    {

        $leveldata    = DB::table('levels')->where('id', '=', $id)->get();
        $dataset = [
            'leveldata' => $leveldata,
        ];

        return view('pages.managelevel')->with('dataset', $dataset);
    }

    public function editlevel(Request $request)
    {
        $this->validate($request, [
            'level' => 'required',
        ]);

        $levelId = $request->input('levelid');
        $level = $request->input('level');

        DB::table('levels')
            ->where('id', $levelId)
            ->update(['level' => $level]);

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'edit_masterdata',
                'actionon' => 'Levels',
                'actiononentry' => $level,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );



        return redirect('/levels')->with('edit_response', '' . $level);
    }

    public function removelevel($id)
    {

        $entrycount = DB::table('questionsmain')->where('levelid', '=', $id)->count();
        if ($entrycount > 0) {
            DB::table('levels')
                ->where('id', $id)
                ->update(['status' => 'D']);
        } else {
            DB::table('levels')->where('id', '=', $id)->delete();
        }

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'remove_masterdata',
                'actionon' => 'Levels',
                'actiononentry' => $id,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/levels')->with('delete_response', '' . $id);
    }

    public function savegrade(Request $request)
    {
        $this->validate($request, [
            'grade' => 'required',
        ]);

        $grade = $request->input('grade');

        DB::table('grades')->insert(
            [
                'grade' => $grade,
                'status' => 'A',
                'userid' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'create_masterdata',
                'actionon' => 'Grades',
                'actiononentry' => $grade,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/grades')->with('response', '' . $grade);
    }

    public function managegrade($id)
    {

        $gradedata    = DB::table('grades')->where('id', '=', $id)->get();
        $dataset = [
            'gradedata' => $gradedata,
        ];

        return view('pages.managegrade')->with('dataset', $dataset);
    }

    public function editgrade(Request $request)
    {
        $this->validate($request, [
            'grade' => 'required',
        ]);

        $gradeId = $request->input('gradeid');
        $grade = $request->input('grade');

        DB::table('grades')
            ->where('id', $gradeId)
            ->update(['grade' => $grade]);

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'edit_masterdata',
                'actionon' => 'Grades',
                'actiononentry' => $grade,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/grades')->with('edit_response', '' . $grade);
    }

    public function removegrade($id)
    {

        $entrycount = DB::table('questionsmain')->where('gradeid', '=', $id)->count();
        if ($entrycount > 0) {
            DB::table('grades')
                ->where('id', $id)
                ->update(['status' => 'D']);
        } else {
            DB::table('grades')->where('id', '=', $id)->delete();
        }


        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'remove_masterdata',
                'actionon' => 'Grades',
                'actiononentry' => $id,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/grades')->with('delete_response', '' . $id);
    }

    public function getsubcategorydata($id)
    {

        $subcategorydata = DB::table('subcategories')->where('parentcategoryid', '=', $id)->get();
        return $subcategorydata;
    }

    public function editpolicyquestion($id)
    {

        $securityquestionsdata = DB::table('securityquestions')->where('id', '=', $id)->get();
        $dataset = [
            'securityquestionsdata' => $securityquestionsdata,

        ];

        return view('pages.editsecurityquestion')->with('dataset', $dataset);
    }

    public function saveuprivilege(Request $request)
    {

        $this->validate($request, [
            'privilege' => 'required',
            'description' => 'required',
        ]);

        $privilege = $request->input('privilege');
        $description = $request->input('description');

        DB::table('privileges')->insert(
            [
                'privilege' => $privilege,
                'description' => $description,
                'status' => 'A',
                'user' => 'Admin',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/privileges')->with('addpprivi', '' . $privilege);
    }

    public function updateprivilege(Request $request)
    {
        $this->validate($request, [
            'privilege' => 'required',
            'description' => 'required',
        ]);

        $privid = $request->input('privid');
        $privilege = $request->input('privilege');
        $description = $request->input('description');
        $status = $request->input('status');

        DB::table('privileges')
            ->where('id', $privid)
            ->update([
                'privilege' => $privilege,
                'description' => $description,
                'status' => $status,
            ]);

        return redirect('/privileges')->with('updatepprivi', '' . $privilege);
    }

    public function updatesecurityquestion(Request $request)
    {

        $qsid = $request->input('qsid');
        $question = $request->input('question');
        $status = $request->input('status');

        DB::table('securityquestions')
            ->where('id', $qsid)
            ->update([
                'question' => $question,
                'status' => $status,
            ]);

        return redirect('/passwordpolicy');
    }

    public function getcategoryset($datalist)
    {
        $splitlist = explode('^', $datalist);

        $gradeid = $splitlist[0];
        $subjectid = $splitlist[1];
        $r = 'r2';
        $categorydata = DB::table('categories')->where([
            ['gradeid', '=', $gradeid],
            ['subjectid', '=', $subjectid],
        ])->get();
        $thiscat = $categorydata[0]->id;
        $subcategorydata = DB::table('subcategories')->where([
            ['gradeid', '=', $gradeid],
            ['subjectid', '=', $subjectid],
            ['parentcategoryid', '=', $thiscat],
        ])->get();

        $dataset = [
            'categorydata' => $categorydata,
            'subcategorydata' => $subcategorydata,
        ];

        return $dataset;
    }
    public function getcategorylist($datalist)
    {

        $r = 'r';
        $splitlist = explode('^', $datalist);

        $gradeid = $splitlist[0];
        $subjectid = $splitlist[1];
        $r = 'r2';
        $categorydata = DB::table('categories')->where([
            ['gradeid', '=', $gradeid],
            ['subjectid', '=', $subjectid],
        ])->get();
        return $categorydata;
    }

    public function gettransactiondata($id)
    {

        $transdata = DB::table('studenttransactions')->where('id', '=', $id)->get();
        return $transdata;
    }

    public function getexamdataforsubject($id)
    {

        $papertemplatesdata = DB::table('papertemplates')->where('subjectid', '=', $id)->get();
        return $papertemplatesdata;
    }

    public function savepromotion(Request $request)
    {


        $this->validate($request, [

            'grade'  => 'required|not_in:-- SELECT GRADE --',

        ]);

        $promotype = $request->input('promotype');
        $promoname = $request->input('promoname');
        $promodescription = $request->input('promodescription');

        $gradevalue = $request->input('grade');
        $glist = explode('-', $gradevalue);
        $gradeid = $glist[0];
        $gradename = $glist[1];

        $price = $request->input('price');
        $examcount = 0;
        $paperforexam = 0;
        $papercount = 0;

        if ($promotype == "single") {
            $papercount = $request->input('papercount');
        } else {
            $examcount  = $request->input('examcount');
            $paperforexam = $request->input('maxpapers');
        }

        DB::table('promotions')->insert(
            [
                'promotype' => $promotype,
                'promoname' => $promoname,
                'promodescription' => $promodescription,
                'examcount' => $examcount,
                'maxpaperforexam' => $paperforexam,
                'paperscount' => $papercount,
                'gradeid' => $gradeid,
                'gradename' => $gradename,
                'price' => $price,
                'status' => 'A',
                'user' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/promotionsmanager')->with('addpromo', '' . $promoname);
    }

    public function updateuserrole(Request $request)
    {

        $this->validate($request, [
            'userrole' => 'required',
        ]);

        $userroleid = $request->input('userroleid');
        $userrole = $request->input('userrole');

        DB::table('userroles')
            ->where('id', $userroleid)
            ->update(['userrole' => $userrole]);

        $privilges = $request->input('assignedvals');
        $privilegesString = '';

        DB::table('roleprivileges')->where('roleid', '=', $userroleid)->delete();

        foreach ($privilges as $privilge) {
            $splitlist = explode('-', $privilge);
            $privilgeid = $splitlist[0];
            $privilgename = $splitlist[1];

            $privilegesString .= '-' . $privilgename;
            DB::table('roleprivileges')->insertGetId(
                [
                    'roleid' => $userroleid,
                    'privilegeid' => $privilgeid,
                    'privilegename' => $privilgename,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ]
            );
        }

        if (count($privilges) > 0) {
            DB::table('userroles')
                ->where('id', $userroleid)
                ->update(['privileges' => $privilegesString]);
        }

        return redirect('/userroles')->with('responseupdate', '' . $userrole);
    }
    public function saveuserrole(Request $request)
    {
        $this->validate($request, [
            'userrole' => 'required',
        ]);

        $userrole = $request->input('userrole');

        $roleid = DB::table('userroles')->insertGetId(
            [
                'userrole' => $userrole,
                'status' => 'A',
                'privileges' => 'NULL',
                'userid' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        $privilges = $request->input('assignedvals');
        $privilegesString = '';
        foreach ($privilges as $privilge) {
            $splitlist = explode('-', $privilge);
            $privilgeid = $splitlist[0];
            $privilgename = $splitlist[1];

            $privilegesString .= '-' . $privilgename;
            DB::table('roleprivileges')->insertGetId(
                [
                    'roleid' => $roleid,
                    'privilegeid' => $privilgeid,
                    'privilegename' => $privilgename,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ]
            );
        }

        if (count($privilges) > 0) {
            DB::table('userroles')
                ->where('id', $roleid)
                ->update(['privileges' => $privilegesString]);
        }




        return redirect('/userroles')->with('response', '' . $userrole);
    }

    public function managedataentryop($id)
    {
        $usersdata = DB::table('users')->where('id', '=', $id)->get();
        $dataset = [
            'usersdata' => $usersdata,

        ];
        return view('pages.managedataentryop')->with('dataset', $dataset);
    }

    public function editdataentryallowance(Request $request)
    {

        $this->validate($request, [
            'allowance' => 'required',
        ]);

        $allowance = $request->input('allowance');
        $dataentryid = $request->input('dataentryid');

        DB::table('users')
            ->where('id', $dataentryid)
            ->update(['allowance' => $allowance]);

        return redirect('/dataentrylist')->with('edit_response', '' . $allowance);
    }


    public function updateuser(Request $request)
    {

        $this->validate($request, [

            'name' => 'required|min:3|max:50',

        ]);

        $userid = $request->input('userid');
        $username = $request->input('name');
        $role = $request->input('role');
        $language = $request->input('language1');
        $status = $request->input('status');

        DB::table('users')
            ->where('id', $userid)
            ->update([
                'name' => $username,
                'role' => $role,
                'language1' => $language,
                'status' => $status,
            ]);

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        $audituserlanguage = Auth::user()->language1;

        if ($status = 'A') {

            DB::table('auditentriesreport')->insert(
                [
                    'userid' => $audituserid,
                    'username' => $audituserName,
                    'action' => 'edit_user',
                    'actionon' => 'update user :' . $username,
                    'actiononentry' => 'update user :' . $username,
                    'oldvalue' => 'NA',
                    'newvalue' => 'NA',
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ]
            );
        } else {

            DB::table('auditentriesreport')->insert(
                [
                    'userid' => $audituserid,
                    'username' => $audituserName,
                    'action' => 'remove_user',
                    'actionon' => 'remove user :' . $username,
                    'actiononentry' => 'remove user :' . $username,
                    'oldvalue' => 'NA',
                    'newvalue' => 'NA',
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ]
            );
        }

        return redirect('/userlist');
    }

    public function manageuser($id)
    {

        $userdata = DB::table('users')->where([
            ['id', '=', $id],
        ])->get();
        $userroledata = DB::table('userroles')->get();

        $dataset = [
            'userdata' => $userdata,
            'userroledata' => $userroledata,
        ];

        return view('pages.manageuser')->with('dataset', $dataset);
    }

    public function registeruser(Request $request)
    {

        $passwordpolicy = DB::table('passwordpolicy')->where([
            ['status', '=', 'A'],

        ])->get();

        $regexvalue_upper = '';
        $regexvalue_lower = '';
        $regexvalue_number = '';
        $regexvalue_symbol = '';
        if ($passwordpolicy[0]->uppercase == 'Y') {
            $regexvalue_upper = 'regex:/[A-Z]/';
        }
        if ($passwordpolicy[0]->lowercase == 'Y') {
            $regexvalue_lower = 'regex:/[a-z]/';
        }

        if ($passwordpolicy[0]->number == 'Y') {
            $regexvalue_number = 'regex:/[0-9]/';
        }

        if ($passwordpolicy[0]->symbol == 'Y') {
            $regexvalue_symbol = 'regex:/[@$!%*#?&]/';
        }



        $minlength = $passwordpolicy[0]->minlength;

        $this->validate($request, [

            'name' => 'required|min:3|max:50',
            'email' => 'email',
            'password' => [
                'required_with:password_confirmation',
                'same:password_confirmation',
                'min:' . $minlength,
                $regexvalue_lower,      // must contain at least one lowercase letter
                $regexvalue_upper,     // must contain at least one uppercase letter
                $regexvalue_number,     // must contain at least one digit
                $regexvalue_symbol, // must contain a special character
            ],
        ]);


        $username = $request->input('name');
        $email = $request->input('email');
        $role = $request->input('role');
        $password = $request->input('password');
        $language1 = $request->input('language1');
        $subject = 'NA';

        if ($role == 'Subject Owner' | $role == 'Teacher') {

            $this->validate($request, [

                'subject'  => 'required|not_in:-- Choose Option --',

            ]);

            $subject = $request->input('subject');
        }

        User::create([
            'name' =>  $username,
            'email' => $email,
            'role' => $role,
            'language1' => $language1,
            'subject' => $subject,
            'status' => 'A',
            'password' => Hash::make($password),
        ]);

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        $audituserlanguage = Auth::user()->language1;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'create_user',
                'actionon' => 'user email :' . $email,
                'actiononentry' => 'create user with email :' . $email,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/userlist')->with('edit_response', '' . $username);
    }

    public function registerstudentsimp(Request $request)
    {
     
        //check for the alrady available email
        $email = $request->input('email');
        $userscount = DB::table('users')->where('email', '=', $email)->count();

        if ($userscount > 0) {
            return view('pages.invaliduseremail')->with('email', '' . $email);
        } else {


            $passwordpolicy = DB::table('passwordpolicy')->where([
                ['status', '=', 'A'],

            ])->get();

            $regexvalue_upper = '';
            $regexvalue_lower = '';
            $regexvalue_number = '';
            $regexvalue_symbol = '';
            if ($passwordpolicy[0]->uppercase == 'Y') {
                $regexvalue_upper = 'regex:/[A-Z]/';
            }
            if ($passwordpolicy[0]->lowercase == 'Y') {
                $regexvalue_lower = 'regex:/[a-z]/';
            }

            if ($passwordpolicy[0]->number == 'Y') {
                $regexvalue_number = 'regex:/[0-9]/';
            }

            if ($passwordpolicy[0]->symbol == 'Y') {
                $regexvalue_symbol = 'regex:/[@$!%*#?&]/';
            }



            $minlength = $passwordpolicy[0]->minlength;

            $this->validate($request, [

                'studentname' => 'required|min:3|max:50',              
                'email' => 'email',
                'password' => [
                    'required_with:password_confirmation',
                    'same:password_confirmation',
                    'min:' . $minlength,
                    $regexvalue_lower,      // must contain at least one lowercase letter
                    $regexvalue_upper,     // must contain at least one uppercase letter
                    $regexvalue_number,     // must contain at least one digit
                    $regexvalue_symbol, // must contain a special character
                ],
            ]);

            $studentname = $request->input('studentname');
            $parentname = "N";
            $address = "N";
            $telephone = "N";
            $email = $request->input('email');
            $mobile = "N";
            $examentrycount = 0;
            $paymethod = "N";
            $fileNameToStore = 'N';
          

            $imageupload = 'N';

            $username = $request->input('studentname');
            $email = $request->input('email');
            $role = 'Student';
            $password = $request->input('password');
            $questionid = "N";
            $answer = "N";
            $language = "English";

            $thisUser = User::create([
                'name' =>  $username,
                'email' => $email,
                'role' => $role,
                'questionid' => $questionid,
                'answer' => $answer,
                'language1' => $language,
                'status' => 'A',
                'password' => Hash::make($password),
            ]);

            $mailhash = rand();
            $userid = $thisUser->id;

            if($mobile == ''){
                $mobile = '0';
            }

            $stdid = DB::table('students')->insertGetId(
                [
                    'studentid' => $userid,
                    'studentname' => $studentname,
                    'parentname' => $parentname,
                    'address' => $address,
                    'telephone' => $telephone,
                    'mobile' => $mobile,
                    'email' => $email,
                    'exams' => $examentrycount,
                    'paymethod' => $paymethod,
                    'image' => $fileNameToStore,
                    'mailconfirmed' => '0',
                    'mailhash' => $mailhash,
                    'status' => '1',
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ]
            );

            $data = array(
                'mailhash' => $stdid . '-' . $mailhash,
                'studentname' => $studentname,
                'studentuser' => $email,

            );

            Mail::to($email)->send(new WelcomeMail($data));

            return view('pages.studentmailsentscreen')->with('email', $email);
        }


    }

    public function registerstudent(Request $request)
    {

        //check for the alrady available email
        $email = $request->input('email');
        $userscount = DB::table('users')->where('email', '=', $email)->count();

        if ($userscount > 0) {
            return view('pages.invaliduseremail')->with('email', '' . $email);
        } else {


            $passwordpolicy = DB::table('passwordpolicy')->where([
                ['status', '=', 'A'],

            ])->get();

            $regexvalue_upper = '';
            $regexvalue_lower = '';
            $regexvalue_number = '';
            $regexvalue_symbol = '';
            if ($passwordpolicy[0]->uppercase == 'Y') {
                $regexvalue_upper = 'regex:/[A-Z]/';
            }
            if ($passwordpolicy[0]->lowercase == 'Y') {
                $regexvalue_lower = 'regex:/[a-z]/';
            }

            if ($passwordpolicy[0]->number == 'Y') {
                $regexvalue_number = 'regex:/[0-9]/';
            }

            if ($passwordpolicy[0]->symbol == 'Y') {
                $regexvalue_symbol = 'regex:/[@$!%*#?&]/';
            }



            $minlength = $passwordpolicy[0]->minlength;

            $this->validate($request, [

                'studentname' => 'required|min:3|max:50',
                'parentname' => 'required|min:3|max:50',
                'address' => 'required|min:3|max:50',
                'telephone' => 'required|min:3|max:50',
                'questionid' => 'required|max:50',
                'answer' => 'required|min:3|max:50',
                'email' => 'email',
                'password' => [
                    'required_with:password_confirmation',
                    'same:password_confirmation',
                    'min:' . $minlength,
                    $regexvalue_lower,      // must contain at least one lowercase letter
                    $regexvalue_upper,     // must contain at least one uppercase letter
                    $regexvalue_number,     // must contain at least one digit
                    $regexvalue_symbol, // must contain a special character
                ],
            ]);

            $studentname = $request->input('studentname');
            $parentname = $request->input('parentname');
            $address = $request->input('address');
            $telephone = $request->input('telephone');
            $email = $request->input('email');
            $mobile = $request->input('mobile');
            $examentrycount = 0;
            $paymethod = $request->input('paymethod');
            $fileNameToStore = 'N';
            if ($request->hasFile('userimage')) {
                $imageupload = 'Y';
                $imageposition = $request->input('imageposition');
                $imageFile = $request->file('userimage')->getClientOriginalName();
                $imageFileName = pathinfo($imageFile, PATHINFO_FILENAME);
                $imageFileExtention = $request->file('userimage')->getClientOriginalExtension();

                $fileNameToStore = $imageFileName . '_' . time() . '.' . $imageFileExtention;
                // $imageFileName = 'question_mcq'.$imageFile.getClientOriginalExtension();
                // $path = $request->file('userimage')->storeAs('public/userimage_images', $fileNameToStore);
                // $image = $fileNameToStore;
                $file = request()->file('userimage');
                $image  = $file->store('userimage_images', ['disk' => 'mypublic']);
            } else {
                $imageupload = 'N';
            }

            $username = $request->input('studentname');
            $email = $request->input('email');
            $role = 'Student';
            $password = $request->input('password');
            $questionid = $request->input('questionid');
            $answer = $request->input('answer');
            $language = $request->input('language');

            $thisUser = User::create([
                'name' =>  $username,
                'email' => $email,
                'role' => $role,
                'questionid' => $questionid,
                'answer' => $answer,
                'language1' => $language,
                'status' => 'A',
                'password' => Hash::make($password),
            ]);

            $mailhash = rand();
            $userid = $thisUser->id;

            if($mobile == ''){
                $mobile = '0';
            }

            $stdid = DB::table('students')->insertGetId(
                [
                    'studentid' => $userid,
                    'studentname' => $studentname,
                    'parentname' => $parentname,
                    'address' => $address,
                    'telephone' => $telephone,
                    'mobile' => $mobile,
                    'email' => $email,
                    'exams' => $examentrycount,
                    'paymethod' => $paymethod,
                    'image' => $fileNameToStore,
                    'mailconfirmed' => '0',
                    'mailhash' => $mailhash,
                    'status' => '1',
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ]
            );

            $data = array(
                'mailhash' => $stdid . '-' . $mailhash,
                'studentname' => $studentname,
                'studentuser' => $email,

            );

            Mail::to($email)->send(new WelcomeMail($data));

            return view('pages.studentmailsentscreen')->with('email', $email);
        }
    }

    public function emailactivation($hashcode)
    {
        $hlist = explode("-", $hashcode);
        $stdid = $hlist[0];
        $hashval = $hlist[1];
        $usersdata = DB::table('students')->where([
            'id' => $stdid,
            'mailhash' => $hashval,
            'mailconfirmed' => '0',
        ])->get();

        if (count($usersdata) > 0) {
            $affected = DB::table('students')
                ->where([
                    'id' => $stdid,
                    'mailhash' => $hashval,
                    'mailconfirmed' => '0',
                ])->update(['mailconfirmed' => 1]);
            return view('pages.studentlinkvalid');
        } else {
            return view('pages.studentlinkinvalid');
        }
    }

    public function sendforgotemail(Request $request)
    {

        $this->validate($request, [
            'answer' => 'required',
        ]);

        $email = $request->input('email');
        $emailcount = DB::table('users')->where('email', '=', $email)->count();
        $sec_question = $request->input('questionid');
        $answer = $request->input('answer');



        $hashedpass = rand(10, 100000);

        if ($emailcount > 0) {

            $userdata = DB::table('users')->where('email', '=', $email)->get();

            $sec_question_user = $userdata[0]->questionid;
            $answer_user = $userdata[0]->answer;

            if ($sec_question_user == $sec_question & $answer == $answer_user) {


                DB::table('password_resets')->insertGetId(
                    [
                        'email' => $email,
                        'token' => $hashedpass,
                        'created_at' => NOW(),

                    ]
                );

                //send the email
                $data = array(
                    'mailhash' => $userdata[0]->id . '-' . $hashedpass,
                );

                Mail::to($email)->send(new ForgotPasswordMail($data));

                return view('pages.forgotmailsent')->with('email', $email);
            } else {
                return view('pages.answermismatch')->with('email', $email);
            }
        } else {
            return view('pages.noemailrecord')->with('email', $email);
        }
    }

    public function passwordrestter($refval)
    {

        $rlist = explode('-', $refval);
        $userid = $rlist[0];
        $hashval = $rlist[1];

        $userdata = DB::table('users')->where('id', '=', $userid)->get();
        $email =  $userdata[0]->email;

        $restentry = DB::table('password_resets')->where([
            'email' => $email,
            'token' => $hashval,
        ])->count();

        if ($restentry > 0) {

            DB::table('password_resets')->where([
                'email' => $email,
                'token' => $hashval,
            ])->delete();

            $dataset = [
                'userid' => $userid,
                'email' => $email,
            ];

            return view('pages.changetonewpassword')->with('dataset', $dataset);
        } else {
            return view('pages.tockenexired')->with('email', $email);
        }
    }

    public function updatepassword(Request $request)
    {

        $passwordpolicy = DB::table('passwordpolicy')->where([
            ['status', '=', 'A'],

        ])->get();

        $regexvalue_upper = '';
        $regexvalue_lower = '';
        $regexvalue_number = '';
        $regexvalue_symbol = '';
        if ($passwordpolicy[0]->uppercase == 'Y') {
            $regexvalue_upper = 'regex:/[A-Z]/';
        }
        if ($passwordpolicy[0]->lowercase == 'Y') {
            $regexvalue_lower = 'regex:/[a-z]/';
        }

        if ($passwordpolicy[0]->number == 'Y') {
            $regexvalue_number = 'regex:/[0-9]/';
        }

        if ($passwordpolicy[0]->symbol == 'Y') {
            $regexvalue_symbol = 'regex:/[@$!%*#?&]/';
        }



        $minlength = $passwordpolicy[0]->minlength;

        $this->validate($request, [
            'email' => 'email',
            'password' => [
                'required_with:password_confirmation',
                'same:password_confirmation',
                'min:' . $minlength,
                $regexvalue_lower,      // must contain at least one lowercase letter
                $regexvalue_upper,     // must contain at least one uppercase letter
                $regexvalue_number,     // must contain at least one digit
                $regexvalue_symbol, // must contain a special character
            ],
            'password_confirmation' => 'min:6'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');


        DB::table('users')
            ->where('email', $email)
            ->update(['password' => Hash::make($password)]);

        return view('pages.passwordchangeok')->with('email', $email);
    }

    public function changepassworduser(Request $request)
    {

        $passwordpolicy = DB::table('passwordpolicy')->where([
            ['status', '=', 'A'],

        ])->get();

        $regexvalue_upper = '';
        $regexvalue_lower = '';
        $regexvalue_number = '';
        $regexvalue_symbol = '';
        if ($passwordpolicy[0]->uppercase == 'Y') {
            $regexvalue_upper = 'regex:/[A-Z]/';
        }
        if ($passwordpolicy[0]->lowercase == 'Y') {
            $regexvalue_lower = 'regex:/[a-z]/';
        }

        if ($passwordpolicy[0]->number == 'Y') {
            $regexvalue_number = 'regex:/[0-9]/';
        }

        if ($passwordpolicy[0]->symbol == 'Y') {
            $regexvalue_symbol = 'regex:/[@$!%*#?&]/';
        }



        $minlength = $passwordpolicy[0]->minlength;

        $this->validate($request, [
            'email' => 'email',
            'oldpassword' => 'required',
            'password' => [
                'required_with:password_confirmation',
                'same:password_confirmation',
                'min:' . $minlength,
                $regexvalue_lower,      // must contain at least one lowercase letter
                $regexvalue_upper,     // must contain at least one uppercase letter
                $regexvalue_number,     // must contain at least one digit
                $regexvalue_symbol, // must contain a special character
            ],
            'password_confirmation' => 'min:6'
        ]);

        $email = $request->input('email');
        $oldpassword = $request->input('oldpassword');
        $userdata  = DB::table('users')->where('email', '=', $email)->get();
        $newpassowrd = $request->input('password');
        if (Hash::check($oldpassword, $userdata[0]->password)) {
            DB::table('users')
                ->where('email', $email)
                ->update(['password' => Hash::make($newpassowrd)]);

            return redirect('/userprofile/' . $userdata[0]->id)->with('response', '' . $email);
        } else {
            return redirect('/userprofile/' . $userdata[0]->id)->with('err_response', '' . $email);
        }
    }

    public function changepasswordadmin(Request $request)
    {

        $passwordpolicy = DB::table('passwordpolicy')->where([
            ['status', '=', 'A'],

        ])->get();

        $regexvalue_upper = '';
        $regexvalue_lower = '';
        $regexvalue_number = '';
        $regexvalue_symbol = '';
        if ($passwordpolicy[0]->uppercase == 'Y') {
            $regexvalue_upper = 'regex:/[A-Z]/';
        }
        if ($passwordpolicy[0]->lowercase == 'Y') {
            $regexvalue_lower = 'regex:/[a-z]/';
        }

        if ($passwordpolicy[0]->number == 'Y') {
            $regexvalue_number = 'regex:/[0-9]/';
        }

        if ($passwordpolicy[0]->symbol == 'Y') {
            $regexvalue_symbol = 'regex:/[@$!%*#?&]/';
        }



        $minlength = $passwordpolicy[0]->minlength;

        $this->validate($request, [
            'email' => 'email',
            'oldpassword' => 'required',
            'password' => [
                'required_with:password_confirmation',
                'same:password_confirmation',
                'min:' . $minlength,
                $regexvalue_lower,      // must contain at least one lowercase letter
                $regexvalue_upper,     // must contain at least one uppercase letter
                $regexvalue_number,     // must contain at least one digit
                $regexvalue_symbol, // must contain a special character
            ],
            'password_confirmation' => 'min:6'
        ]);

        $email = $request->input('email');
        $oldpassword = $request->input('oldpassword');
        $userdata  = DB::table('users')->where('email', '=', $email)->get();
        $newpassowrd = $request->input('password');
        if (Hash::check($oldpassword, $userdata[0]->password)) {
            DB::table('users')
                ->where('email', $email)
                ->update(['password' => Hash::make($newpassowrd)]);

            return redirect('/userprofileadmin/' . $userdata[0]->id)->with('response', '' . $email);
        } else {
            return redirect('/userprofileadmin/' . $userdata[0]->id)->with('err_response', '' . $email);
        }
    }

    public function changelanguage(Request $request)
    {

        $email  = Auth::user()->email;
        $userid  = Auth::user()->id;
        $newlanguage = $request->input('language');
        DB::table('users')
            ->where('email', $email)
            ->update(['language1' => $newlanguage]);

        return redirect('/userprofile/' . $userid)->with('lan_response', '' . $email);
    }

    public function updatetransactionstate(Request $requests)
    {
        if (Auth::check()) {

            $transid  = $requests->input('transid');
            $state  = $requests->input('paystate');
            $transtype  = $requests->input('transtype');

            $newstatus = '0';
            if ($state == 'Confirmed') {

                $newstatus = '1';
            } elseif ($state == 'Rejected') {
                $newstatus = '2';
            }


            $productid  =  '';
            $productname  = '';
            $price = '';
            $gradeName = '';
            $subjectName = '';
           


            if ($transtype == 'exam') {

                //Update the transaction data
                DB::table('studenttransactions')
                    ->where('id', $transid)
                    ->update([
                        'paystatus' => $newstatus,
                        'approvedbyid' => Auth::user()->id,
                        'approvedbyname' => Auth::user()->name,
                        'approvedbydate' => NOW(),
                    ]);

                $examsRealdata = DB::table('studenttransactions')->where([
                    'id' => $transid
                ])->get();

                $productid  =  $examsRealdata[0]->productid;
                $productname  =  $examsRealdata[0]->productname;

                $productData =  DB::table('papertemplates')->where([
                    'id' => $productid
                ])->get();

                $price = $examsRealdata[0]->price;
                $gradeName = $productData[0]->gradename;
                $subjectName = $productData[0]->subjectname;
                $studentid = $examsRealdata[0]->studentid;
            } else if ($transtype == 'promo') {

                //Update the transaction data
                DB::table('studentpromotrans')
                    ->where('id', $transid)
                    ->update([
                        'paystatus' => $newstatus,
                        'approvedbyid' => Auth::user()->id,
                        'approvedbyname' => Auth::user()->name,
                        'approvedbydate' => NOW(),
                    ]);

                $promoTransDate = DB::table('studentpromotrans')->where('id', '=', $transid)->get();

                $price = $promoTransDate[0]->price;
                $gradeName = $promoTransDate[0]->gradename;
                $subjectName = $promoTransDate[0]->subjectname;
                $productid  =  $promoTransDate[0]->promoid;
                $productname  =  $promoTransDate[0]->promoname;
                $studentid = $promoTransDate[0]->studentid;
            }


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

            //student Details
            $studentData   = DB::table('students')->where('studentid', '=', $studentid)->get();
            $email =  $studentData[0]->email;
            $data = array(
                'email' => $studentData[0]->email,
                'studentname' => $studentData[0]->studentname,
                'price' => $price,
                'examname' => $productname,
                'grade' => $gradeName,
                'subject' => $subjectName,
            );

            Mail::to($email)->send(new BanktransferConfirmationMail($data));

            return view('pages.paymentsmanager')->with('dataset', $dataset);
        } else {
            return view('pages.home');
        }
    }

    public function managerole($id)
    {

        $userroledata  = DB::table('userroles')->where('id', '=', $id)->get();
        $userprivilages  = DB::table('roleprivileges')->where('roleid', '=', $id)->get('privilegeid');
        $privilegesdata = DB::table('privileges')->where('status', '=', 'A')->get();

        $privset = array();
        foreach ($userprivilages as $prv) {
            array_push($privset, $prv->privilegeid);
        }
        $dataset = [
            'userdata' => $userroledata,
            'userprivilages' => $privset,
            'privilegesdata' => $privilegesdata,
        ];

        return view('pages.managerole')->with('dataset', $dataset);
    }

    public function deleterole($id)
    {

        $roledata = DB::table('userroles')->where('id', '=', $id)->get();
        $userdata  = DB::table('users')->where([
            ['role', '=', $roledata[0]->userrole],
            ['status', '=', 'A'],
        ])->count();

        if ($userdata  > 0) {

            DB::table('userroles')
                ->where('id', $id)
                ->update(['status' => 'D']);
        } else {

            DB::table('userroles')->where('id', '=', $id)->delete();
            DB::table('roleprivileges')->where('roleid', '=', $id)->delete();
        }

        return redirect('/userroles')->with('responseupdate', '');
    }

    public function managepromotion($id)
    {
        $promotionData =      DB::table('promotions')->where('id', '=', $id)->get();
        $gradesData =      DB::table('grades')->where('status', '=', 'A')->get();

        $dataset = [
            'promotionData' => $promotionData,
            'gradesData' => $gradesData,
        ];

        return view('pages.managepromotion')->with('dataset', $dataset);
    }

    public function updatepromotion(Request $request)
    {
        $promotioncode = $request->input('promotioncode');
        $promotype = $request->input('promotype');
        $promoname = $request->input('promoname');
        $gradevalue = $request->input('grade');
        $glist = explode('-', $gradevalue);
        $gradeid = $glist[0];
        $gradename = $glist[1];
        $promodescription = $request->input('promodescription');
        $prompapercount = 0;
        $examcount = 0;
        $maxpapaers = 0;
        $promoprice = $request->input('price');

        if ($promotype == 'single') {
            $prompapercount = $request->input('papercount');
        } else {
            $examcount = $request->input('examcount');
            $maxpapaers = $request->input('maxpapers');
        }

        DB::table('promotions')
            ->where('id', $promotioncode)
            ->update([
                'promotype' =>  $promotype,
                'promoname' =>  $promoname,
                'promodescription' =>  $promodescription,
                'gradeid' =>  $gradeid,
                'gradename' =>  $gradename,
                'price' =>  $promoprice,
                'paperscount' =>  $prompapercount,
                'examcount' =>  $examcount,
                'maxpaperforexam' =>  $maxpapaers,
            ]);

        return redirect('/promotionsmanager');
    }

    public function removepromotion($id)
    {
        DB::table('promotions')
            ->where('id', $id)
            ->update([
                'status' =>  'D',

            ]);

        return redirect('/promotionsmanager');
    }


    public function removeuser($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect('/userlist');
    }
}
