<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PromoCodeController extends Controller
{

    public function savepromocode(Request $request)
    {

        $this->validate($request, [
            'promocode' => 'required',
            'description' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
        ]);

        $promoType = $request->input('promotype');

        if ($promoType == 'buyx') {

            $this->validate($request, [
                'buynumber' => 'required',
                'getnumber' => 'required',

            ]);
        }


        $promoCode = $request->input('promocode');
        $description = $request->input('description');
        $maxAllowed = $request->input('maxallowed');


        $startDate = $request->input('startdate');
        $endDate = $request->input('enddate');
        $discount = $request->input('discount');
        $buyNumber = $request->input('buynumber');
        $buyProduct = $request->input('buyproduct');

        $getNumber = $request->input('getnumber');
        $getProduct = $request->input('getproduct');
       
        $examTypeval = $request->input('examtype');
        if( $examTypeval == 'none' |  $examTypeval == 'all'){
            $examtypeid =         $examTypeval;
            $examtypename =         $examTypeval;
        }else{
            $examExploded = explode('-',$examTypeval);
            $examtypeid = $examExploded[0];
            $examtypename = $examExploded[1];
        }
     

        $gradeval = $request->input('grade');
        if( $gradeval == 'none' |  $gradeval == 'all'){
            $gradeid = $gradeval;
            $gradename= $gradeval;
        }else{
            $gradeExploded = explode('-',$gradeval);
            $gradeid = $gradeExploded[0];
            $gradename= $gradeExploded[1];
        }
  

        $subjectval = $request->input('subject');
        if( $subjectval == 'none' |  $subjectval == 'all'){
            $subjectid = $subjectval;
            $subjectname = $subjectval;
        }else{
            $subjectExploded = explode('-',$subjectval);
            $subjectid = $subjectExploded[0];
            $subjectname = $subjectExploded[1];
        }
      

        $promotionval = $request->input('promotion');
        if( $promotionval == 'none' |  $promotionval == 'all'){
            $promotionid = $promotionval;
            $promotionname = $promotionval;
        }else{
            $promoExploded = explode('-',$promotionval);
        $promotionid =    $promoExploded[0];
        $promotionname =    $promoExploded[1];
        }
      

        if ($maxAllowed == '') {
            $maxAllowed = '0';
        }

        if ($request->input('maxunlimited')) {
            $maxUnlimited = 'Y';
        } else {
            $maxUnlimited = 'N';
            $this->validate($request, [
                'maxallowed' => 'required',
              

            ]);
        }

        $startExploded = explode('/', $startDate);
        $newStartDate =  $startExploded[2] . '-' . $startExploded[1] . '-' . $startExploded[0];

        $endExploded = explode('/', $endDate);
        $newEndDate =  $endExploded[2] . '-' . $endExploded[1] . '-' . $endExploded[0];

        if ($promoType == 'buyx') {
            $buyProductType = substr($buyProduct, 0, 1);
            $buyProductValues = substr($buyProduct, 1);
            $buyProductExploded = explode('-', $buyProductValues);
            $buyProductCode =    $buyProductExploded[0];
            $buyProductName =    $buyProductExploded[1];

            $getProductType = substr($getProduct, 0, 1);
            $getProductValues = substr($getProduct, 1);
            $getProductExploded = explode('-', $getProductValues);
            $getProductCode =    $getProductExploded[0];
            $getProductName =    $getProductExploded[1];
        } else {
            $buyProductType = 'NA';
            $buyProductValues = 'NA';
            $buyProductExploded = 'NA';
            $buyProductCode =  'NA';
            $buyProductName =  'NA';

            $getProductType = 'NA';
            $getProductValues = 'NA';
            $getProductExploded = 'NA';
            $getProductCode =   'NA';
            $getProductName =   'NA';
            $buyNumber=0;
            $getNumber=0;
        }


        DB::table('promocodes')->insert(
            [
                'promocode' => $promoCode,
                'description' => $description,
                'maxallowed' => $maxAllowed,
                'maxunlimited' => $maxUnlimited,
                'startdate' => $newStartDate,
                'enddate' => $newEndDate,
                'promotype' => $promoType,
                'discount' => $discount,
                'buynumber' => $buyNumber,
                'buyproduct' => $buyProductCode,
                'buyproductname' => $buyProductName,
                'buyproducttype' => $buyProductType,
                'getnumber' => $getNumber,
                'getproduct' => $getProductCode,
                'getproductname' => $getProductName,
                'getproductype' => $getProductType,
                'examtypeid' => $examtypeid,
                'examtype' => $examtypename,
                'gradeid' => $gradeid,
                'grade' => $gradename,
                'subjectid' => $subjectid,
                'subject' => $subjectname,
                'promotionid' => $promotionid,
                'promotion' => $promotionname,
                'status' => 'A',
                'user' => 'NA',
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
                 'action' => 'create_promocode',
                 'actionon' => $promoCode,
                 'actiononentry' => $promoCode,
                 'oldvalue' => 'NA',
                 'newvalue' => 'NA',
                 'created_at' => NOW(),
                 'updated_at' => NOW(),
             ]
         );

        return redirect('/promocodemanager');
    }

    public function managepromocode($id){

        $promocodedata =  DB::table('promocodes')->where('id','=',$id)->get();
        $examtypes = DB::table('examtypes')->where('status','=','A')->get();
        $grades = DB::table('grades')->where('status','=','A')->get();
        $subjects = DB::table('subjects')->where('status','=','A')->get();
        $promotions = DB::table('promotions')->where('status','=','A')->get();

        $dataset = [
            'promocodedata' => $promocodedata,
            'examtypes' => $examtypes,
            'grades' => $grades,
            'subjects' => $subjects,
            'promotions' => $promotions,
        ];

        return view('pages.managepromocode')->with('dataset',$dataset);
    }

    public function updatepromocode(Request $request){


        $promocodeentryid = $request->input('promocodeentryid');
        $this->validate($request, [
            'promocode' => 'required',
            'description' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
        ]);

        $promoType = $request->input('promotype');

        if ($promoType == 'buyx') {

            $this->validate($request, [
                'buynumber' => 'required',
                'getnumber' => 'required',

            ]);
        }


        $promoCode = $request->input('promocode');
        $description = $request->input('description');
        $maxAllowed = $request->input('maxallowed');


        $startDate = $request->input('startdate');
        $endDate = $request->input('enddate');
        $discount = $request->input('discount');
        $buyNumber = $request->input('buynumber');
        $buyProduct = $request->input('buyproduct');

        $getNumber = $request->input('getnumber');
        $getProduct = $request->input('getproduct');
       
        $examTypeval = $request->input('examtype');
        $examExploded = explode('-',$examTypeval);
        $examtypeid = $examExploded[0];
        $examtypename = $examExploded[1];

        $gradeval = $request->input('grade');
        $gradeExploded = explode('-',$gradeval);
        $gradeid = $gradeExploded[0];
        $gradename= $gradeExploded[1];

        $subjectval = $request->input('subject');
        $subjectExploded = explode('-',$subjectval);
        $subjectid = $subjectExploded[0];
        $subjectname = $subjectExploded[1];

        $promotionval = $request->input('promotion');
        $promoExploded = explode('-',$promotionval);
        $promotionid =    $promoExploded[0];
        $promotionname =    $promoExploded[1];

        if ($maxAllowed == '') {
            $maxAllowed = '0';
        }

        if ($request->input('maxunlimited')) {
            $maxUnlimited = 'Y';
        } else {
            $maxUnlimited = 'N';
            $this->validate($request, [
                'maxallowed' => 'required',
              

            ]);
        }

        $startExploded = explode('/', $startDate);
        $newStartDate =  $startExploded[2] . '-' . $startExploded[1] . '-' . $startExploded[0];

        $endExploded = explode('/', $endDate);
        $newEndDate =  $endExploded[2] . '-' . $endExploded[1] . '-' . $endExploded[0];

        if ($promoType == 'buyx') {
            $buyProductType = substr($buyProduct, 0, 1);
            $buyProductValues = substr($buyProduct, 1);
            $buyProductExploded = explode('-', $buyProductValues);
            $buyProductCode =    $buyProductExploded[0];
            $buyProductName =    $buyProductExploded[1];

            $getProductType = substr($getProduct, 0, 1);
            $getProductValues = substr($getProduct, 1);
            $getProductExploded = explode('-', $getProductValues);
            $getProductCode =    $getProductExploded[0];
            $getProductName =    $getProductExploded[1];
        } else {
            $buyProductType = 'NA';
            $buyProductValues = 'NA';
            $buyProductExploded = 'NA';
            $buyProductCode =  'NA';
            $buyProductName =  'NA';

            $getProductType = 'NA';
            $getProductValues = 'NA';
            $getProductExploded = 'NA';
            $getProductCode =   'NA';
            $getProductName =   'NA';
            $buyNumber=0;
            $getNumber=0;
        }

        DB::table('promocodes')
        ->where('id', $promocodeentryid)
        ->update([
            'promocode' => $promoCode,
            'description' => $description,
            'maxallowed' => $maxAllowed,
            'maxunlimited' => $maxUnlimited,
            'startdate' => $newStartDate,
            'enddate' => $newEndDate,
            'promotype' => $promoType,
            'discount' => $discount,
            'buynumber' => $buyNumber,
            'buyproduct' => $buyProductCode,
            'buyproductname' => $buyProductName,
            'buyproducttype' => $buyProductType,
            'getnumber' => $getNumber,
            'getproduct' => $getProductCode,
            'getproductname' => $getProductName,
            'getproductype' => $getProductType,
            'examtypeid' => $examtypeid,
            'examtype' => $examtypename,
            'gradeid' => $gradeid,
            'grade' => $gradename,
            'subjectid' => $subjectid,
            'subject' => $subjectname,
            'promotionid' => $promotionid,
            'promotion' => $promotionname,
        ]);

        return redirect('/promocodemanager');

    }

    public function copypromocode($id){


        $promocodedata =  DB::table('promocodes')->where('id','=',$id)->get();
        $examtypes = DB::table('examtypes')->where('status','=','A')->get();
        $grades = DB::table('grades')->where('status','=','A')->get();
        $subjects = DB::table('subjects')->where('status','=','A')->get();
        $promotions = DB::table('promotions')->where('status','=','A')->get();

        $dataset = [
            'promocodedata' => $promocodedata,
            'examtypes' => $examtypes,
            'grades' => $grades,
            'subjects' => $subjects,
            'promotions' => $promotions,
        ];

        return view('pages.copypromocode')->with('dataset',$dataset);

    }

    public function getpayment(Request $rr){
        
        $ii = $rr->isMethod('post');
        print_r('this is payconfrm'. $ii);
    }
}
