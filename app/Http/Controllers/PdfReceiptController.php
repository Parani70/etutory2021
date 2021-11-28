<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PdfReceiptController extends Controller
{
    public function pdfreceipt(Request $request)
    {
        $pdf = App::make('dompdf.wrapper');
        $data = '<h1>Payment Receipt</h1>
        <p>Description : <b>'.$request->input('examname').' - '.$request->input('subject'). '  '.$request->input('grade').'</b></p>';
        

        if($request->input('discountedPrice') > 0){
            $data .= '<p>Price : <b>LKR '.number_format($request->input('price'),2).'</b></p>';
            $data .= '<p>Discount Amount : <b>LKR '.number_format($request->input('discountAmount'),2).'</b></p>';
            $data .= '<p>Paid Amount : <b>LKR '.number_format($request->input('discountedPrice'),2).'</b></p>';
        }else{
            $data .= '<p>Price : <b>LKR '.number_format($request->input('price'),2).'</b></p>';
        }
        $data .= ' <p>Terms And Conditionss : <b>
        We will validate the payment and send a confirmation. From the confirmation date, you will have 30 days to login to eTutory and sit for any of the purchased exams at any time.
      </b></p>
        ';
        $pdf->loadHTML($data);
        return $pdf->download('Purchase Receipt.pdf');     
    }
}
