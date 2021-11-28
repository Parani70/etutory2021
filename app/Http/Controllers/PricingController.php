<?php

namespace App\Http\Controllers;

use App\Mail\PaymentReceiptMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\TryCatch;

class PricingController extends Controller
{
    public function savepricing(Request $request)
    {


        $examtype = $request->input('examtype');
        $sarray = explode('-', $examtype);
        $examtypeid = $sarray[0];
        $examtypename = $sarray[1];

        $grade = $request->input('grade');
        $sarray = explode('-', $grade);
        $gradeid = $sarray[0];
        $gradename = $sarray[1];

        $subject = $request->input('subject');
        $sarray = explode('-', $subject);
        $subjectid = $sarray[0];
        $subjectname = $sarray[1];

        $price = $request->input('price');
        $userid = Auth::user()->id;

        DB::table('exampricing')->insert(
            [
                'examtypeid' => $examtypeid,
                'examtypename' => $examtypename,
                'gradeid' => $gradeid,
                'gradename' => $gradename,
                'subjectid' => $subjectid,
                'subjectname' => $subjectname,
                'price' => $price,
                'user' => $userid,
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
                'action' => 'create_pricing',
                'actionon' => $examtypeid,
                'actiononentry' => $examtypeid . ' to :' . $price,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/pricingmanager')->with('response', '' . $gradename . ' - ' . $subjectname);
    }

    public function managepricing($id)
    {

        $pricingdata   = DB::table('exampricing')->where('id', '=', $id)->get();
        $examtypedata    = DB::table('examtypes')->get();
        $examtemplatedata    = DB::table('papertemplates')->get();
        $gradedata    = DB::table('grades')->get();
        $subjectsdata    = DB::table('subjects')->get();
        $dataset = [
            'pricingdata' => $pricingdata,
            'examtypedata' => $examtypedata,
            'examtemplatedata' => $examtemplatedata,
            'gradedata' => $gradedata,
            'subjectsdata' => $subjectsdata,
        ];

        return view('pages.managepricing')->with('dataset', $dataset);
    }

    public function updatepricing(Request $request)
    {

        $examtypeval = $request->input('examtype');
        $etlist = explode('-', $examtypeval);
        $examtypeid = $etlist[0];
        $examtypename = $etlist[1];
        $gradeval = $request->input('grade');
        $etlist = explode('-', $gradeval);
        $gradeid = $etlist[0];
        $gradename = $etlist[1];
        $subjectval = $request->input('subject');
        $etlist = explode('-', $subjectval);
        $subjectid = $etlist[0];
        $subjectname = $etlist[1];
        $price = $request->input('price');
        $entryid = $request->input('entryid');

        DB::table('exampricing')
            ->where('id', $entryid)
            ->update([
                'examtypeid' => $examtypeid,
                'examtypename' => $examtypename,
                'gradeid' => $gradeid,
                'gradename' => $gradename,
                'subjectid' => $subjectid,
                'subjectname' => $subjectname,
                'price' => $price
            ]);

        //Audit Entry
        $audituserid = Auth::user()->id;
        $audituserName = Auth::user()->name;
        DB::table('auditentriesreport')->insert(
            [
                'userid' => $audituserid,
                'username' => $audituserName,
                'action' => 'edit_pricing',
                'actionon' => $examtypeid,
                'actiononentry' => $examtypeid . ' to :' . $price,
                'oldvalue' => 'NA',
                'newvalue' => 'NA',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        return redirect('/pricingmanager')->with('responseupdated', '' . $gradename . ' - ' . $subjectname);
    }

    public function buynewexam(Request $request)
    {

        if ($request->input('addtocart') == 'addtocart') {

            $subject = $request->input('subject');
            $sarray = explode('-', $subject);
            $subjectid = $sarray[0];
            $subjectname = $sarray[1];
            $examid = $request->input('examlist');

            $examdata   = DB::table('papertemplates')->where('id', '=', $examid)->get();
            $examgradeid =  $examdata[0]->gradeid;
            $examgradename =  $examdata[0]->gradename;
            $examname =  $examdata[0]->coursename;



            $pricingdata   = DB::table('exampricing')->where([
                'subjectid' => $subjectid,
                'examtypeid' => $examid,
            ])->get();

            $price = $pricingdata[0]->price;

            $userid = Auth::user()->id;
            $carton = DB::table('shoppingcart')->where([
                ['userid', '=', $userid],
                ['status', '=', 'O'],
            ])->count();
            $cartid = '';
            $entries = 0;
            if ($carton <= 0) {
                $cartid =  DB::table('shoppingcart')->insertGetId(
                    [
                        'userid' => $userid,
                        'status' => 'O',
                        'entries' => 1,
                        'created_at' => NOW(),
                        'updated_at' => NOW(),
                    ]
                );

                $entries++;
            } else {
                $cartdata =  DB::table('shoppingcart')->where([
                    ['userid', '=', $userid],
                    ['status', '=', 'O'],
                ])->get();
                $cartid = $cartdata[0]->id;
                $entries = $cartdata[0]->entries + 1;

                DB::table('shoppingcart')
                    ->where('userid', $userid)
                    ->update(['entries' => $entries]);
            }

            DB::table('shoppingcartdata')->insertGetId(
                [
                    'cartid' => $cartid,
                    'userid' => $userid,
                    'productid' => $examid,
                    'productname' => $examname,
                    'producttype' => 'Exam',
                    'price' => $price,
                    'status' => 'O',
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ]
            );

            $subjectdata    = DB::table('subjects')->get();
            $promotiondata    = DB::table('promotions')->get();
            $coursedata    = DB::table('papertemplates')->where('subjectid', '=', $subjectdata[0]->id)->get();
            $exampuchasedata = DB::table('studenttransactions')->where([
                ['studentid', '=', $userid],
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
            $subject = $request->input('subject');
            $sarray = explode('-', $subject);
            $subjectid = $sarray[0];
            $subjectname = $sarray[1];
            $examid = $request->input('examlist');

            $examdata   = DB::table('papertemplates')->where('id', '=', $examid)->get();
            $examgradeid =  $examdata[0]->gradeid;
            $examgradename =  $examdata[0]->gradename;
            $examname =  $examdata[0]->coursename;

            try {

                $pricingdata   = DB::table('exampricing')->where([
                    'subjectid' => $subjectid,
                    'examtypeid' => $examid,
                ])->get();

                $price = $pricingdata[0]->price;
            } catch (Exception $Exception) {

                return redirect('')->with('error_res', 'noPricing');
            }


            $dataset = [
                'examid' => $examid,
                'examname' => $examname,
                'subjectid' => $subjectid,
                'subjectname' => $subjectname,
                'gradeid' => $examgradeid,
                'gradename' => $examgradename,
                'price' => $price,
                'msg' => 'none',
            ];

            return view('pages.exambuyscreen')->with('dataset', $dataset);
        }
    }

    public function proceedtoexampay(Request $request)
    {

        $userEmail = Auth::user()->email;
        $userid = Auth::user()->id;
        $usermedium = Auth::user()->language1;

        $PRICEVALUE = $request->input('price');
        if(intval($PRICEVALUE) == 0){
            //Save the transaction as valid FREE transaction

            $examid = $request->input('examid');
            $price = $request->input('examprice');
            $type = $request->input('producttype');
            $examdata   = DB::table('papertemplates')->where('id', '=', $examid)->get();

            $examname = $examdata[0]->coursename;
            $examtypeid = $examdata[0]->examtypeid;
            $examtypename = $examdata[0]->examtypename;
            $grade = $examdata[0]->gradeid;
            $subject = $examdata[0]->subjectid;
            $gradename = $examdata[0]->gradename;
            $subjectname = $examdata[0]->subjectname;

            $studentdata = DB::table('students')->where([
                'email' => $userEmail,
            ])->get();

            $studentid = $studentdata[0]->studentid;
                $studentname = $studentdata[0]->studentname;

            $mainTransID = DB::table('studenttransactions')->insertGetId(
                [
                    'studentid' => $studentid,
                    'studentname' => $studentname,
                    'email' => $userEmail,
                    'type' => $type,
                    'usermedium' => $usermedium,
                    'examtype' => $examtypename,
                    'productid' => $examid,
                    'productname' => $examname,
                    'grade' => $grade,
                    'gradename' => $gradename,
                    'subjectname' => $subjectname,
                    'subject' => $subject,
                    'discount' => 0,
                    'price' => 0,
                    'paymethod' => 'FREE',
                    'paystatus' => '1',
                    'approvedbyid' => 'N',
                    'approvedbyname' => 'N',
                    'approvedbydate' => 'N',
                    'status' => '1',
                    'image' => 'N',
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ]
            );

            $dataset = [
                'examdata' => $examdata,
            ];

            return view('pages.freeproductcompaltepage')->with('dataset',$dataset);

        }else{


            if ($request->input('proceedType') == 'proceesshoppingcart') {

                $promocode = $request->input('promocode');
                $discountedPrice = 0;
                $discountAmount = 0;
                $discountType = 'N';
                $getFreeArray = array();
    
                $price = $request->input('totalShoppingCart');
    
                if ($promocode != '') {
    
                    $ldate = date('Y-m-d');
                    //get promo code count
                    $promocodeentrycount = DB::table('promocodes')->where([
    
                        ['promocode', '=', $promocode],
                        ['status', '=', 'A'],
                        ['startdate', '<=',  $ldate],
                        ['enddate', '>=', $ldate],
                    ])->count();
    
                    if ($promocodeentrycount > 0) {
    
    
                        $promocodedata = DB::table('promocodes')->where([
    
                            ['promocode', '=', $promocode],
                            ['status', '=', 'A'],
                            ['startdate', '<=',  $ldate],
                            ['enddate', '>=', $ldate],
                        ])->get();
    
                        $originalPrice = $price;
                        $promoCodeType = $promocodedata[0]->promotype;
    
                        if ($promoCodeType == 'discount') { //promo code type as discount
    
                            $discountRate = $promocodedata[0]->discount;
                            $discountedPrice = ($originalPrice / 100) * (100 - $discountRate);
                            $discountAmount = $originalPrice - $discountedPrice;
                            $discountType = $promoCodeType;
                        } else {
                        }
                    } else {
    
                        $cartdata =  DB::table('shoppingcart')->where([
                            ['userid', '=', $userid],
                            ['status', '=', 'O'],
                        ])->get();
    
                        $cartid = $cartdata[0]->id;
                        $cartdatasub =  DB::table('shoppingcartdata')->where([
                            ['cartid', '=', $cartid],
    
                        ])->get();
    
                        $dataset = [
                            'cartdata' => $cartdata,
                            'cartdatasub' => $cartdatasub,
                            'msg' => 'no promocode',
                        ];
    
                        return view('pages.shoppingcart')->with('dataset', $dataset);
                    }
                }
    
    
    
                //get student data
                $studentdata = DB::table('students')->where([
                    'email' => $userEmail,
                ])->get();
    
                $studentid = $studentdata[0]->id;
                $mobile = $studentdata[0]->telephone;
                $studentname = $studentdata[0]->studentname;
                $stnameexplode = explode(' ', $studentname);
                $std_firstname = $stnameexplode[0];
                if (count($stnameexplode) > 1) {
                    $std_lasttname = $stnameexplode[1];
                } else {
                    $std_lasttname = ' ';
                }
    
                $dataset = [
                    'examid' => 'NA',
                    'price' => $price,
                    'promocode' => $promocode,
                    'discountedPrice' => $discountedPrice,
                    'discountAmount' => $discountAmount,
                    'discountType' => $discountType,
                    'getFreeArray' =>  $getFreeArray,
                    'type' => 'NA',
                    'examdata' => 'NA',
                    'std_firstname' => $std_firstname,
                    'std_lasttname' => $std_lasttname,
                    'std_email' => $userEmail,
                    'std_mobile' => $mobile,
                    'fromshoppingCart' => 'YES',
                    'studentdata' => $studentdata,
                ];
    
                return view('pages.paymentselect')->with('dataset', $dataset);
            } else {
    
    
                $promocode = $request->input('promocode');
                $discountedPrice = 0;
                $discountAmount = 0;
                $discountType = 'N';
                $getFreeArray = array();
    
                $examid = $request->input('examid');
                $price = $request->input('examprice');
                $type = $request->input('producttype');
                $examdata   = DB::table('papertemplates')->where('id', '=', $examid)->get();
                $thisProductType = 'S';
    
                $examname = $examdata[0]->coursename;
                $grade = $examdata[0]->gradeid;
                $subject = $examdata[0]->subjectid;
                $gradename = $examdata[0]->gradename;
    
                $subjectname = $examdata[0]->subjectname;
    
    
    
                if ($promocode != '') {
    
                    $ldate = date('Y-m-d');
                    //  print_r($ldate);
                    //get promo code count
                    $promocodeentrycount = DB::table('promocodes')->where([
    
                        ['promocode', '=', $promocode],
                        ['status', '=', 'A'],
                        ['startdate', '<=',  $ldate],
                        ['enddate', '>=', $ldate],
                    ])->count();
    
    
                    if ($promocodeentrycount > 0) { //check the valid promo code
    
                        $promoError = 'NA';
                        //get promo code data
                        $promocodedata = DB::table('promocodes')->where([
    
                            ['promocode', '=', $promocode],
                            ['status', '=', 'A'],
                            ['startdate', '<=',  $ldate],
                            ['enddate', '>=', $ldate],
                        ])->get();
    
                        $originalPrice = $price;
                        $promoCodeType = $promocodedata[0]->promotype;
    
                        if ($promoCodeType == 'discount') { //promo code type as discount
    
                            $discountRate = $promocodedata[0]->discount;
                            $discountedPrice = ($originalPrice / 100) * (100 - $discountRate);
                            $discountAmount = $originalPrice - $discountedPrice;
                            $discountType = $promoCodeType;
                        } else {
    
    
    
    
                            $promoBuyNumber = $promocodedata[0]->buynumber;
                            $promoBuyProduct = $promocodedata[0]->buyproduct;
                            $promoBuyProductType = $promocodedata[0]->buyproducttype;
    
                            $promoGetNumber = $promocodedata[0]->getnumber;
                            $promoGetProduct = $promocodedata[0]->getproduct;
                            $PromoGetProductType = $promocodedata[0]->getproductype;
    
                            $examtypeVal = $promocodedata[0]->examtype;
                            $gradeVal = $promocodedata[0]->grade;
                            $subjectVal = $promocodedata[0]->subject;
    
                            if ($thisProductType != $promoBuyProductType) {
    
                                $dataset = [
                                    'examid' => $examid,
                                    'examname' => $examname,
                                    'subjectid' => $subject,
                                    'subjectname' => $subjectname,
                                    'gradeid' => $grade,
                                    'gradename' => $gradename,
                                    'price' => $price,
                                    'msg' => 'product not support',
                                ];
    
                                return view('pages.exambuyscreen')->with('dataset', $dataset);
                            } else {
    
                                if ($promoBuyProductType == 'S') {
    
                                    $examTypeSql = '';
                                    if ($examtypeVal != 'all') {
                                        $examTypeSql = $examtypeVal;
                                    }
    
                                    $gradeSql = '';
                                    if ($gradeVal != 'all') {
                                        $gradeSql = $gradeVal;
                                    }
    
                                    $subjectSql = '';
                                    if ($subjectVal != 'all') {
                                        $subjectSql = $subjectVal;
                                    }
    
                                    $examGetTemplateCount = DB::table('papertemplates')->where([
                                        ['id', '!=', $examid],
                                        ['subjectid', '=', $promoGetProduct],
                                        ['gradename', 'like', '%' . $gradeSql],
                                    ])->count('id');
    
                                    if ($examGetTemplateCount >= $promoGetNumber) {
    
                                        $examGetTemplateData = DB::table('papertemplates')->where([
                                            ['id', '!=', $examid],
                                            ['subjectid', '=', $promoGetProduct],
                                            ['gradename', 'like', '%' . $gradeSql],
                                        ])->skip(0)->take($promoGetNumber)->get();
    
                                        foreach ($examGetTemplateData as $examGetTemp) {
                                            array_push($getFreeArray, $examGetTemp->id);
                                        }
    
                                        $discountType = $promoCodeType;
                                    } else {
                                        //return sue to no paper temaptes matched
                                        $dataset = [
                                            'examid' => $examid,
                                            'examname' => $examname,
                                            'subjectid' => $subject,
                                            'subjectname' => $subjectname,
                                            'gradeid' => $grade,
                                            'gradename' => $gradename,
                                            'price' => $price,
                                            'msg' => 'no product to give',
                                        ];
    
                                        return view('pages.exambuyscreen')->with('dataset', $dataset);
                                    }
                                }
                            }
                        }
                    } else {
                        $dataset = [
                            'examid' => $examid,
                            'examname' => $examname,
                            'subjectid' => $subject,
                            'subjectname' => $subjectname,
                            'gradeid' => $grade,
                            'gradename' => $gradename,
                            'price' => $price,
                            'msg' => 'invalid Promocode',
                        ];
    
                        return view('pages.exambuyscreen')->with('dataset', $dataset);
                    }
                }
    
                //get student data
                $studentdata = DB::table('students')->where([
                    'email' => $userEmail,
                ])->get();
    
                $studentid = $studentdata[0]->id;
                $mobile = $studentdata[0]->telephone;
                $studentname = $studentdata[0]->studentname;
                $stnameexplode = explode(' ', $studentname);
                $std_firstname = $stnameexplode[0];
                if (count($stnameexplode) > 1) {
                    $std_lasttname = $stnameexplode[1];
                } else {
                    $std_lasttname = ' ';
                }
    
    
                $dataset = [
                    'examid' => $examid,
                    'price' => $price,
                    'promocode' => $promocode,
                    'discountedPrice' => $discountedPrice,
                    'discountAmount' => $discountAmount,
                    'discountType' => $discountType,
                    'getFreeArray' =>  $getFreeArray,
                    'type' => $type,
                    'examdata' => $examdata,
                    'std_firstname' => $std_firstname,
                    'std_lasttname' => $std_lasttname,
                    'std_email' => $userEmail,
                    'std_mobile' => $mobile,
                    'studentdata' => $studentdata,
                    'fromshoppingCart' => 'NO',
                ];
    
                return view('pages.paymentselect')->with('dataset', $dataset);
            }
    


        }

        
        
    }

    public function saveexampayment(Request $request)
    {

        $paymethod = $request->input('paymethod');



        if ($request->input('fromshoppingCart') == 'YES') {



            if ($request->hasFile('depositimage')) {

                $imageFile = $request->file('depositimage')->getClientOriginalName();
                $imageFileName = pathinfo($imageFile, PATHINFO_FILENAME);
                $imageFileExtention = $request->file('depositimage')->getClientOriginalExtension();

                $fileNameToStore = $imageFileName . '_' . time() . '.' . $imageFileExtention;
                // $imageFileName = 'question_mcq'.$imageFile.getClientOrginalExtension();
                // $path = $request->file('depositimage')->storeAs('public/deposit_images', $fileNameToStore);
                // $image = $fileNameToStore;
                $file = request()->file('depositimage');
                $image  = $file->store('deposit_images', ['disk' => 'mypublic']);
            }

            $userEmail = Auth::user()->email;
            $usermedium = Auth::user()->language1;

            //get student data
            $studentdata = DB::table('students')->where([
                'email' => $userEmail,
            ])->get();

            $price = $request->input('examprice');

            $discountedPrice = $request->input('discountedPrice');
            $discountAmount = $request->input('discountAmount');

            $studentid = $studentdata[0]->studentid;
            $studentname = $studentdata[0]->studentname;
            $discount = $discountedPrice;

            $userid = Auth::user()->id;
            $userEmail = Auth::user()->email;
            $usermedium = Auth::user()->language1;

            $cartdata =  DB::table('shoppingcart')->where([
                ['userid', '=', $userid],
                ['status', '=', 'O'],
            ])->get();

            $cartid = $cartdata[0]->id;

            $cartdatasub =  DB::table('shoppingcartdata')->where([
                ['cartid', '=', $cartid],

            ])->get();

            foreach ($cartdatasub as $cartentry) {

                $productDetailData  = DB::table('papertemplates')->where([
                    ['id', '=', $cartentry->productid],

                ])->get();

                $mainTransID = DB::table('studenttransactions')->insertGetId(
                    [
                        'studentid' => $studentid,
                        'studentname' => $studentname,
                        'email' => $userEmail,
                        'type' => $cartentry->producttype,
                        'usermedium' => $usermedium,
                        'examtype' => $productDetailData[0]->examtypename,
                        'productid' => $cartentry->productid,
                        'productname' => $productDetailData[0]->coursename,
                        'grade' => $productDetailData[0]->gradeid,
                        'gradename' => $productDetailData[0]->gradename,
                        'subjectname' => $productDetailData[0]->subjectname,
                        'subject' => $productDetailData[0]->subjectid,
                        'discount' => $discount,
                        'price' => $cartentry->price,
                        'paymethod' => $paymethod,
                        'paystatus' => '0',
                        'approvedbyid' => 'N',
                        'approvedbyname' => 'N',
                        'approvedbydate' => 'N',
                        'status' => '1',
                        'image' => $image,
                        'created_at' => NOW(),
                        'updated_at' => NOW(),
                    ]
                );

                $promocode = $request->input('promocode');
                if ($promocode != '') {

                    $ldate = date('Y-m-d');
                    //  print_r($ldate);
                    //get promo code count
                    $promocodeentrycount = DB::table('promocodes')->where([

                        ['promocode', '=', $promocode],
                        ['status', '=', 'A'],
                        ['startdate', '<=',  $ldate],
                        ['enddate', '>=', $ldate],
                    ])->count();

                    if ($promocodeentrycount  > 0) {

                        $promocodeDataset = DB::table('promocodes')->where([

                            ['promocode', '=', $promocode],
                            ['status', '=', 'A'],
                            ['startdate', '<=',  $ldate],
                            ['enddate', '>=', $ldate],
                        ])->get();


                        DB::table('promocodetrans')->insertGetId(
                            [
                                'promocode' => $promocode,
                                'promocodetype' => $promocodeDataset[0]->promotype,
                                'studentid' => $studentid,
                                'studentname' => $studentname,
                                'transactionid' => $mainTransID,
                                'productid' => 'NA',
                                'productname' => $productDetailData[0]->coursename,
                                'producttype' => 'NA',
                                'created_at' => NOW(),
                                'updated_at' => NOW(),
                            ]
                        );
                    }
                }
            }


            DB::table('shoppingcart')
                ->where('userid', $userid)
                ->update(['status' => 'C']);




            $dataset = [
                'examid' => '0',
                'examname' => 'Multipe Exams Purchase',
                'price' => $price,
                'discountedPrice' => $discountedPrice,
                'discountAmount' => $discountAmount,
                'subject' => 'Multiple',
                'grade' => 'Multiple',
                'email' => $userEmail,
                'paycredit' => '15',
            ];



            return view('pages.paymentreceipt')->with('dataset', $dataset);
        } else {

            $examid = $request->input('examid');
            $price = $request->input('examprice');
            $type = $request->input('producttype');
            $paymethod = $request->input('paymethod');
            $discountedPrice = $request->input('discountedPrice');
            $discountAmount = $request->input('discountAmount');

            $examdata = DB::table('papertemplates')->where([
                'id' => $examid,
            ])->get();

            $examname = $examdata[0]->coursename;
            $examtypeid = $examdata[0]->examtypeid;
            $examtypename = $examdata[0]->examtypename;
            $grade = $examdata[0]->gradeid;
            $subject = $examdata[0]->subjectid;
            $gradename = $examdata[0]->gradename;
            $subjectname = $examdata[0]->subjectname;
            $image = 'N';
            if ($paymethod == "bank") {
                if ($request->hasFile('depositimage')) {

                    $imageFile = $request->file('depositimage')->getClientOriginalName();
                    $imageFileName = pathinfo($imageFile, PATHINFO_FILENAME);
                    $imageFileExtention = $request->file('depositimage')->getClientOriginalExtension();

                    $fileNameToStore = $imageFileName . '_' . time() . '.' . $imageFileExtention;
                    // $imageFileName = 'question_mcq'.$imageFile.getClientOrginalExtension();
                    // $path = $request->file('depositimage')->storeAs('public/deposit_images', $fileNameToStore);
                    // $image = $fileNameToStore;
                    $file = request()->file('depositimage');
                    $image  = $file->store('deposit_images', ['disk' => 'mypublic']);
                }

                $userEmail = Auth::user()->email;
                $usermedium = Auth::user()->language1;

                //get student data
                $studentdata = DB::table('students')->where([
                    'email' => $userEmail,
                ])->get();

                $studentid = $studentdata[0]->studentid;
                $studentname = $studentdata[0]->studentname;
                $discount = $discountedPrice;

                $mainTransID = DB::table('studenttransactions')->insertGetId(
                    [
                        'studentid' => $studentid,
                        'studentname' => $studentname,
                        'email' => $userEmail,
                        'type' => $type,
                        'usermedium' => $usermedium,
                        'examtype' => $examtypename,
                        'productid' => $examid,
                        'productname' => $examname,
                        'grade' => $grade,
                        'gradename' => $gradename,
                        'subjectname' => $subjectname,
                        'subject' => $subject,
                        'discount' => $discount,
                        'price' => $price,
                        'paymethod' => $paymethod,
                        'paystatus' => '0',
                        'approvedbyid' => 'N',
                        'approvedbyname' => 'N',
                        'approvedbydate' => 'N',
                        'status' => '1',
                        'image' => $image,
                        'created_at' => NOW(),
                        'updated_at' => NOW(),
                    ]
                );


                if ($request->input('discountType') == 'buyx') {

                    $freeEntryCount = $request->input('getFreeArraycount');
                    $ii = 1;
                    while ($freeEntryCount >= $ii) {

                        $freeproductid = $request->input('freeArray_id' . $ii);
                        DB::table('studentfreeproducts')->insertGetId(
                            [
                                'studentid' => $studentid,
                                'maintransid' => $mainTransID,
                                'promocode' => $request->input('promocode'),
                                'entrycount' => $freeEntryCount,
                                'productid' => $freeproductid,
                                'created_at' => NOW(),
                                'updated_at' => NOW(),
                            ]
                        );

                        $ii++;
                    }
                }

                $promocode = $request->input('promocode');
                if ($promocode != '') {

                    $ldate = date('Y-m-d');
                    //  print_r($ldate);
                    //get promo code count
                    $promocodeentrycount = DB::table('promocodes')->where([

                        ['promocode', '=', $promocode],
                        ['status', '=', 'A'],
                        ['startdate', '<=',  $ldate],
                        ['enddate', '>=', $ldate],
                    ])->count();

                    if ($promocodeentrycount  > 0) {

                        $promocodeDataset = DB::table('promocodes')->where([

                            ['promocode', '=', $promocode],
                            ['status', '=', 'A'],
                            ['startdate', '<=',  $ldate],
                            ['enddate', '>=', $ldate],
                        ])->get();


                        DB::table('promocodetrans')->insertGetId(
                            [
                                'promocode' => $promocode,
                                'promocodetype' => $promocodeDataset[0]->promotype,
                                'studentid' => $studentid,
                                'studentname' => $studentname,
                                'transactionid' => $mainTransID,
                                'productid' => 'NA',
                                'productname' => $examname,
                                'producttype' => 'NA',
                                'created_at' => NOW(),
                                'updated_at' => NOW(),
                            ]
                        );
                    }
                }

                $dataset = [
                    'examid' => $examid,
                    'examname' => $examname,
                    'price' => $price,
                    'discountedPrice' => $discountedPrice,
                    'discountAmount' => $discountAmount,
                    'subject' => $subjectname,
                    'grade' => $gradename,
                    'email' => $userEmail,
                    'paycredit' => '15',
                ];

                return view('pages.paymentreceipt')->with('dataset', $dataset);
            } else {
            }
        }
    }

    public function emailreceipt(Request $request)
    {
        $email = $request->input('email');
        $price = $request->input('price');
        $examname = $request->input('examname');
        $grade = $request->input('grade');
        $subject = $request->input('subject');

        //send the email
        $data = array(
            'email' => $email,
            'price' => $price,
            'examname' => $examname,
            'grade' => $grade,
            'subject' => $subject,
        );

        Mail::to($email)->send(new PaymentReceiptMail($data));
        return redirect('/');
    }

    public function deletepayment($id)
    {

        DB::table('studenttransactions')->where('id', '=', $id)->delete();

        return redirect('/studenthistory')->with('deletedentry', 'ok');
    }

    public function shoppingcartpage()
    {

        $userid = Auth::user()->id;
        $cartdata =  DB::table('shoppingcart')->where([
            ['userid', '=', $userid],
            ['status', '=', 'O'],
        ])->get();

        $noentries = 0;
        $cartid = 0;
        $cartdatasub = "";
        if (count($cartdata) > 0) {

            $noentries++;
            $cartid = $cartdata[0]->id;
            $cartdatasub =  DB::table('shoppingcartdata')->where([
                ['cartid', '=', $cartid],

            ])->get();
        }



        $dataset = [
            'cartdata' => $cartdata,
            'cartdatasub' => $cartdatasub,
            'noentries' => $noentries,
            'msg' => 'NA',
        ];

        return view('pages.shoppingcart')->with('dataset', $dataset);
    }

    public function searchpayentries(Request $request)
    {

        $this->validate($request, [
            'purchasedate' => 'required',
            'studentname' => 'required',
            'item' => 'required',
        ]);

        $purchasedate = $request->input('purchasedate');
        $studentname = $request->input('studentname');
        $item = $request->input('item');
        $status = $request->input('status');
        if ($status == 'All') {
            $status = '';
        }

        $examsdata = DB::table('studenttransactions')->where([
            ['created_at', 'like', $purchasedate],
            ['studentname', 'like', $studentname],
            ['productname', 'like', $item],
            ['status', 'like', $purchasedate],

        ])->get();

        $dataset = [
            'examsdata' => $examsdata,
            'view' => 'N',
        ];
        return view('pages.paymentsmanager')->with('dataset', $dataset);
    }

    public function cardpayproceed(Request $request)
    {

        $transtype = $request->input('transtype');
        $payamount = $request->input('cardpayamount');
        if ($transtype == 'exam') {
            $examid = $request->input('examid');
        } else {
            $examid = $request->input('promotransid');
        }

        $userEmail  = Auth::user()->email;
        $userId  = Auth::user()->id;

        $studentdata  = DB::table('students')->where([
            'email' => $userEmail,
        ])->get();
        $publicKey = "-----BEGIN PUBLIC KEY-----
        MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC9l2HykxDIDVZeyDPJU4pA0imf
        3nWsvyJgb3zTsnN8B0mFX6u5squ5NQcnQ03L8uQ56b4/isHBgiyKwfMr4cpEpCTY
        /t1WSdJ5EokCI/F7hCM7aSSSY85S7IYOiC6pKR4WbaOYMvAMKn5gCobEPtosmPLz
        gh8Lo3b8UsjPq2W26QIDAQAB
        -----END PUBLIC KEY-----";

        $secret_key = "32447aac-eda5-439e-8544-3d5d5f1f96a3";

        DB::table('cardordernumbers')->where([
            ['studentid', '=', $userId],
            ['status', '=', '0'],
        ])->delete();

        $cardtransactionEntry =   DB::table('cardordernumbers')->insertGetId(
            [
                'studentid' => $userId,
                'productid' =>  $examid,
                'transtype' => $transtype,
                'status' => '0',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );

        $dataset = [
            'studentdata' => $studentdata,
            'payamount' => $payamount,
            'publicKey' => $publicKey,
            'secret_key' => $secret_key,
            'transactionid' => $cardtransactionEntry,
            'studentid' => $userId,
            'productid' => $examid,
            'type' => $transtype,
        ];
        return view('pages.paycard')->with('dataset', $dataset);
    }

    public function cardpaylistner_2(Request $request)
    {
        print_r('OK');
        print_r('THIS IS METHOD:'.$request->method());
        switch ($request->method()) {
            case 'POST':
                // do anything in 'post request';
                print_r('THIS IS POST !');
                break;
    
            case 'GET':
                // do anything in 'get request';
                break;
    
            default:
                // invalid request
                break;
        }
    }
    

    public function cardpaylistner(Request $request)
    {
        //decode & get POST parameters
       
        $payment = base64_decode($request->input('payment'));
        
        //$payment = base64_decode('fFQwMDAwMjFJMDMwfDIwMjEtMDMtMTF8MTV8VW5zdWNjZXNzZnVsIFBheW1lbnR8NDA=');
        $responseVariables = explode('|', $payment);

        $signature = base64_decode($request->input('signature'));
        $custom_fields = base64_decode($request->input('custom_fields'));
        $customeFieldVariables = explode('|', $custom_fields);

     //   print_r('payment decoded:   '.$payment);
       // print_r('<br/>');
        //print_r($responseVariables);
        //print_r('<br/>');
        $transidOne = $responseVariables[0];
        //print_r($transidOne);
        $orderRef = $responseVariables[1];
        $transtime = $responseVariables[2];
        $statuscode = $responseVariables[3];
        $gwcomment = $responseVariables[4];
        $usedgateway = $responseVariables[5];

        $orgTransNumber = $customeFieldVariables[0];
        $studentid = $customeFieldVariables[1];
        $productid = $customeFieldVariables[2];
        $price = $customeFieldVariables[3];
        $transtype = $customeFieldVariables[4];
        $discount = '0';

        if ($statuscode == '0') { //successfull transaction

            if ($transtype == "exam") {

                $cardentrydatacheck = DB::table('cardordernumbers')->where([
                    ['studentid', '=', $studentid],
                    ['productid', '=', $productid],
                    ['status', '=', '0'],
                ])->get();

                $examdata = DB::table('papertemplates')->where([
                    'id' => $productid,
                ])->get();

                $examname = $examdata[0]->coursename;
                $examtypeid = $examdata[0]->examtypeid;
                $examtypename = $examdata[0]->examtypename;
                $grade = $examdata[0]->gradeid;
                $subject = $examdata[0]->subjectid;
                $gradename = $examdata[0]->gradename;
                $subjectname = $examdata[0]->subjectname;

                $userEmail = Auth::user()->email;
                $usermedium = Auth::user()->language1;

                $studentdata = DB::table('students')->where([
                    'email' => $userEmail,
                ])->get();

                $studentid = $studentdata[0]->studentid;
                $mobile = $studentdata[0]->telephone;
                $studentname = $studentdata[0]->studentname;

                $mainTransID = DB::table('studenttransactions')->insertGetId(
                    [
                        'studentid' => $studentid,
                        'studentname' => $studentname,
                        'email' => $userEmail,
                        'type' => 'exam',
                        'usermedium' => $usermedium,
                        'examtype' => $examtypename,
                        'productid' => $productid,
                        'productname' => $examname,
                        'grade' => $grade,
                        'subjectname' => $subjectname,
                        'subject' => $subject,
                        'discount' => $discount,
                        'price' => $price,
                        'paymethod' => 'CARD',
                        'paystatus' => '1',
                        'approvedbyid' => 'N',
                        'approvedbyname' => 'N',
                        'approvedbydate' => 'N',
                        'status' => '1',
                        'image' => 'NA',
                        'created_at' => NOW(),
                        'updated_at' => NOW(),
                    ]
                );
            } else {

                $userEmail = Auth::user()->email;
                $usermedium = Auth::user()->language1;

                $studentdata = DB::table('students')->where([
                    'email' => $userEmail,
                ])->get();

                $promotranid = $productid;
                $promoTransData = DB::table('studentpromotrans')->where('id','=',$promotranid);

                $examname = $promoTransData[0]->promoname;
                $gradename = $promoTransData[0]->gradename;
                $subjectname = $promoTransData[0]->subjectname;
                $mainTransID = $productid;

                DB::table('studentpromotrans')
                ->where('id', $promotranid)
                ->update([
                    'paystatus' => '1',
                    'approvedbyid' => Auth::user()->id,
                    'approvedbyname' => Auth::user()->name,
                    'approvedbydate' => NOW(),
                ]);
                
            }



            $creditcardtransTransID = DB::table('creditcardtrans')->insertGetId(
                [
                    'ordernumber' => $orgTransNumber,
                    'studenttransid' => $mainTransID,
                    'productid' => $productid,
                    'transtype' => $transtype,
                    'gwrefnumber' => $orderRef,
                    'gwdate' => $transtime,
                    'gwstatus' => $statuscode,
                    'gwcomment' => $gwcomment,
                    'gwgateway' => $usedgateway,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ]
            );

            $discountedPrice = 0;
            $discountAmount = 0;
            $dataset = [
                'examid' => $productid,
                'examname' => $examname,
                'price' => $price,
                'discountedPrice' => $discountedPrice,
                'discountAmount' => $discountAmount,
                'subject' => $subjectname,
                'grade' => $gradename,
                'email' => $userEmail,
                'paycredit' => '0',
            ];

            return view('pages.paymentreceipt')->with('dataset', $dataset);
        } else {
            return view('pages.invalidcardpay')->with('dataset', '');
        }
    }

    public function removepricing($id)
    {

        DB::table('exampricing')->where('id', '=', $id)->delete();

        return redirect('/pricingmanager');
    }

    public function clearshoppingcart()
    {
        $userid = Auth::user()->id;
        DB::table('shoppingcart')->where([
            ['userid', '=', $userid],
            ['status', '=', 'O'],
        ])->delete();

        DB::table('shoppingcartdata')->where([
            ['userid', '=', $userid],

        ])->delete();

        return redirect('/');
    }
}
