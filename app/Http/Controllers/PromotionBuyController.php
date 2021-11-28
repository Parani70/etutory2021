<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PromotionBuyController extends Controller
{
    public function proceedpromopurchase(Request $request)
    {
        $promotype = $request->input('promotype');
        $promotionid = $request->input('promoid');
        $promotionData = DB::table('promotions')->where('id', '=', $promotionid)->get();

       
        if ($promotype == 'multiple') {

           
            $promotionType = $promotionData[0]->promotype;
            $promotionName = $promotionData[0]->promoname;
            $promoGradeID = $promotionData[0]->gradeid;
            $promoGradeName = $promotionData[0]->gradename;
            $examcount = $promotionData[0]->examcount;
            $maxapers = $promotionData[0]->maxpaperforexam;
            $price = $promotionData[0]->price;
            $userid = Auth::user()->id; 

            $studentData = DB::table('students')->where('studentid', '=', $userid)->get();
            $studentid = $userid;
            $studentname = $studentData[0]->studentname;
            $studentemail = $studentData[0]->email;

            $subjectCount = $request->input('subjectcount');
            $i = 1;

            $promotransid =  DB::table('studentpromotrans')->insertGetId(
                [
                    'studentid' => $studentid,
                    'studentname' => $studentname,
                    'email' => $studentemail,
                    'promotype' => 'single',
                    'promoid' => $promotionid,
                    'promoname' => $promotionName,
                    'papercount' => $examcount,
                    'gradeid' => $promoGradeID,
                    'gradename' => $promoGradeName,
                    'subjectid' => 'Multiple',
                    'subjectname' => 'Multiple',
                    'templateid' => 'NA',
                    'templatename' => 'NA',
                    'status' => '0',
                    'paystatus' => '0',
                    'paymethod' => '0',
                    'payimage' => '0',
                    'price' => $price,
                    'approvedbyid' => '0',
                    'approvedbyname' => '0',
                    'approvedbydate' => '0',
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ]
            );

            $subjectChecker = 0;
            while( $subjectCount >= $i){

                $subjectValue = $request->input('countentry'.$i);
                $splitlist = explode('-',$subjectValue);
                $subjectPaperCount =  $splitlist[0];
                $subjectid =  $splitlist[1];
                $subjectData = DB::table('subjects')->where('id','=',$subjectid)->get();
                $subjectname = $subjectData[0]->subject;

                if( $subjectPaperCount > 0){
                    $subjectChecker ++;

                    $templateData = DB::table('papertemplates')->where([
                        ['subjectid', '=', $subjectid],
                        ['gradeid', '=', $promoGradeID],
                    ])->get();

                    $templateEntriesCount = count($templateData );
                    $selectedpapaers = array();
                    $p=0;
                    while($subjectPaperCount > $p){

                        $minE = 0;
                        $maxE = count($templateData);
                        $maxE--;

                        do {
                            $templateSelectr = rand($minE, $maxE);
                        } while (in_array($templateSelectr, $selectedpapaers));
                        // print_r($templateSelectr);
                        array_push($selectedpapaers, $templateSelectr);

                        //read selected template
                        $templateID = $templateData[$templateSelectr]->id;
                        $templateName = $templateData[$templateSelectr]->coursename;


                        DB::table('studentpromotransdata')->insertGetId(
                            [
                                'promotransid' => $promotransid,
                                'studentid' => $studentid,
                                'studentname' => $studentname,
                                'email' => $studentemail,
                                'promotype' => 'multiple',
                                'promoid' => $promotionid,
                                'promoname' => $promotionName,
                                'papercount' => $subjectPaperCount,
                                'gradeid' => $promoGradeID,
                                'gradename' => $promoGradeName,
                                'subjectid' => $subjectid,
                                'subjectname' => $subjectname,
                                'templateid' => $templateID,
                                'templatename' =>  $templateName,
                                'status' => '0',
                                'created_at' => NOW(),
                                'updated_at' => NOW(),
                            ]
                        );

                        $p++;
                    }
                }
                

                $i++;
            }

            if($subjectChecker > 0){
                
                //go to the payment select page
                $dataset = [
                    'promotiontransid' => $promotransid,
                    'studentid' => $studentid,
                    'price' => $price,
                ];


                return view('pages.paymentselectpromo')->with('dataset', $dataset);

            }else{
                return view('pages.promotionmessage');
            }
            

            
            

        } else {

            $promotionType = $promotionData[0]->promotype;
            $promotionName = $promotionData[0]->promoname;
            $promoGradeID = $promotionData[0]->gradeid;
            $promoGradeName = $promotionData[0]->gradename;
            $papercount = $promotionData[0]->paperscount;
            $price = $promotionData[0]->price;
            $userid = Auth::user()->id;

            $studentData = DB::table('students')->where('studentid', '=', $userid)->get();
            $studentid = $userid;
            $studentname = $studentData[0]->studentname;
            $studentemail = $studentData[0]->email;

            if ("single" == $promotionType) {

                $subjectCount = $request->input('subjectentriescount');
                $i = 1;
                $selectedSubject  = "N";

                while ($subjectCount >= $i) {

                    if ($request->input('subject' . $i)) {
                        $valuesubject = $request->input('subject' . $i);
                        $selectedSubject = $valuesubject;
                    }

                    $i++;
                }

                if ($selectedSubject != 'N') {

                    $templateData = DB::table('papertemplates')->where([
                        ['subjectid', '=', $selectedSubject],
                        ['gradeid', '=', $promoGradeID],
                    ])->get();

                    $subjectData = DB::table('subjects')->where('id', '=', $selectedSubject)->get();
                    $subjectName = $subjectData[0]->subject;
                    $entryCount = count($templateData);


                    if (count($templateData) > 0 && count($templateData) >= $papercount) {

                        $promotransid =  DB::table('studentpromotrans')->insertGetId(
                            [
                                'studentid' => $studentid,
                                'studentname' => $studentname,
                                'email' => $studentemail,
                                'promotype' => 'single',
                                'promoid' => $promotionid,
                                'promoname' => $promotionName,
                                'papercount' => $papercount,
                                'gradeid' => $promoGradeID,
                                'gradename' => $promoGradeName,
                                'subjectid' => $selectedSubject,
                                'subjectname' => $subjectName,
                                'templateid' => 'NA',
                                'templatename' => 'NA',
                                'status' => '0',
                                'paystatus' => '0',
                                'paymethod' => '0',
                                'payimage' => '0',
                                'price' => $price,
                                'approvedbyid' => '0',
                                'approvedbyname' => '0',
                                'approvedbydate' => '0',
                                'created_at' => NOW(),
                                'updated_at' => NOW(),
                            ]
                        );

                        $selectedpapaers = array();

                        $p = 1;
                        while ($papercount >= $p) {

                            $minE = 0;
                            $maxE = count($templateData);
                            $maxE--;

                            do {
                                $templateSelectr = rand($minE, $maxE);
                            } while (in_array($templateSelectr, $selectedpapaers));
                            // print_r($templateSelectr);
                            array_push($selectedpapaers, $templateSelectr);

                            //read selected template
                            $templateID = $templateData[$templateSelectr]->id;
                            $templateName = $templateData[$templateSelectr]->coursename;

                            DB::table('studentpromotransdata')->insertGetId(
                                [
                                    'promotransid' => $promotransid,
                                    'studentid' => $studentid,
                                    'studentname' => $studentname,
                                    'email' => $studentemail,
                                    'promotype' => 'single',
                                    'promoid' => $promotionid,
                                    'promoname' => $promotionName,
                                    'papercount' => $papercount,
                                    'gradeid' => $promoGradeID,
                                    'gradename' => $promoGradeName,
                                    'subjectid' => $selectedSubject,
                                    'subjectname' => $subjectName,
                                    'templateid' => $templateID,
                                    'templatename' =>  $templateName,
                                    'status' => '0',
                                    'created_at' => NOW(),
                                    'updated_at' => NOW(),
                                ]
                            );

                            $p++;
                        }


                        //go to the payment select page
                        $dataset = [
                            'promotiontransid' => $promotransid,
                            'studentid' => $studentid,
                            'price' => $price,
                        ];


                        return view('pages.paymentselectpromo')->with('dataset', $dataset);
                    } else {

                        //no template data avaobale
                        return view('pages.promotionmessage');
                    }
                } else {
                    $this->validate($request, [
                        'examsubject' => 'required',

                    ]);
                }
            }
        }
    }

    public function savepromopayment(Request $request)
    {



        $propTransID = $request->input('transactionid');
        $studentID = $request->input('studentid');

        $promoTransData = DB::table('studentpromotrans')->where('id', '=', $propTransID)->get();
        $promotionID =      $promoTransData[0]->promoid;
        $promotionName =      $promoTransData[0]->promoname;
        $promotionSubject =      $promoTransData[0]->subjectname;
        $promotionGrade =      $promoTransData[0]->gradename;
        $promotionPrice =      $promoTransData[0]->price;

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

        DB::table('studentpromotrans')
            ->where('id', $propTransID)
            ->update(
                [
                    'paystatus' => '0',
                    'paymethod' => 'bank',
                    'payimage' =>  $image,
                ]

            );

        $dataset = [
            'propTransID' => $propTransID,
            'promotionID' => $promotionID,
            'promotionSubject' => $promotionSubject,
            'promotionGrade' => $promotionGrade,
            'promotionName' => $promotionName,
            'promotionPrice' => $promotionPrice,
            'email' => $promotionPrice,
            'paycredit' => 'NO'
        ];

        return view('pages.paymentreceiptpromo')->with('dataset', $dataset);
    }

    public function paymentmangerviewpromo($id)
    {
        $stdTransId = $id;

        if (Auth::check()) {

            $examsdata = DB::table('studenttransactions')->where([
                'status' => '1',
                'paystatus' => '0',
                'paymethod' => 'bank',
            ])->get();
            $transimagedata = DB::table('studentpromotrans')->where([
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
                'type' => 'promo',

            ];
            return view('pages.paymentsmanager')->with('dataset', $dataset);
        } else {
            return view('pages.home');
        }
    }
}
