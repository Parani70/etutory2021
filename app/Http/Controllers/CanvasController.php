<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CanvasController extends Controller
{
    public function guidlinecanvas($id)
    {
         
        
        return view('pages.guidlinecanvas')->with('guidlineid',$id);

    }


    public function readessaycookies($tokenid){

      //  $cvalue = Cookie::get('handraw_guidlines');
        $cvalue    = DB::table('guidlineimagetockens')->where('tokenid', '=', $tokenid)->get();
        return $cvalue;
    }

    public function doneguidlinecanvas(Request $request)
    {
        $tokenid =  $request->input('tokenid');
        $slidercount =  $request->input('slidercountval');
       // $slidercount--;
        $cvalue = Cookie::get('essayentryid');

        DB::table('guidlineimagetockens')->insert(
            [
                'tokenid' => $tokenid,
                'myvalue' => $slidercount,               
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );
        //Cookie::queue('handraw_guidlines',$slidercount, 200);

        return 1;
    }

    public function saveguidlinecanvas(Request $request)
    {

        $slidercount =  $request->input('slidercountval');
        $cvalue = $request->input('entryvalue');
        $imagefilename = 'guidline_images/'.$cvalue.'_I'.$slidercount.'.jpg';
        $img =  $request->input('imgBase64');
       
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);
        //saving
        $fileName = 'photo.png';
        Storage::disk('mypublic')->put($imagefilename, $fileData);
        
        

        return 'dd';
    }

    public function saveanswercanvas(Request $request){
        $slidercount =  $request->input('slidercountval');
        $examseat = $request->input('entryvalue');
        $questioncode = $request->input('questioncode');
        $qstype = $request->input('qstype');

        $stamps = strtotime("now");
        $imagefilename = 'answercanvas/E'.$examseat.'_P'.$slidercount.'_Q'.$questioncode.'_T'.$stamps.'.jpg';
        $img =  $request->input('imgBase64');
       
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);
        //saving
         
        Storage::disk('mypublic')->put($imagefilename, $fileData);

        $answetcanvas = DB::table('examseatcanvasentries')->insertGetId(
            [
                'examseatid' => $examseat,
                'qscode' => $questioncode,
                'qstype' => $qstype,
                'canvas' => $imagefilename,
                'position' =>  $slidercount,
                'status' => 'A',
                'userid' => 'NA',               
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        );
        

        return  $imagefilename;
    }

    public function doneanswercanvas(Request $request){

    }

    public function getthepenanswers($values){

        $vlist = explode('-',$values);
        $examseatid = $vlist[0];
        $questionid = $vlist[1];

        $canvasData =  DB::table('examseatcanvasentries')->where([
            ['examseatid','=',$examseatid],
            ['qscode','=',$questionid],
        ])->get();

        return $canvasData;
    }
    
}

