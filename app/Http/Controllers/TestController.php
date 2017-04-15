<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Advert;
use App\Cit_top;

class TestController extends Controller
{
    public function test_method(Advert $advert){

        $adverts = ['110', '111', '112', '113', '114', '115', '116', '117', '118', '121', '122', '123', '124', '125', '126', '136', '138'];
        $cits = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15'];
        $types = ['1', '2', '3'];


        foreach($adverts as $adv):
            foreach($cits as $cit):
                foreach($types as $tp):
                    Cit_top::create([
                    'advert_id' => $adv,
                    'cit_id' => $cit,
                    'top_type' => $tp
                ]);
                endforeach;
            endforeach;
        endforeach;

          
    }
}
