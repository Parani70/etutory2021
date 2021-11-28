<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomScriptsController extends Controller
{
    public function qsimagepaths()
    {
        $questiondata    = DB::table('questionsmain')->where('imageurl', '!=', 'NA')->get();
        print_r('<br/>::::::::::::SCRIPT EXECUTION STARTED::::::::::::');
        foreach ($questiondata as $qsentry) {

            $imageurlid = $qsentry->id;
            $imageurl = $qsentry->imageurl;
            $imageurlNew =  'question_images/' . $imageurl;

            DB::table('questionsmain')
                ->where('id', $imageurlid)
                ->update([
                    'imageurl' => $imageurlNew,
                ]);

            print_r('<br/>' . $imageurlNew);
        }

        print_r('<br/>::::::::::::SCRIPT EXECUTION FINISHED::::::::::::');
    }
}
