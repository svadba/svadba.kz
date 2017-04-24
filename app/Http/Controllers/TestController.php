<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advert_cit;


class TestController extends Controller
{
    public function test_method(){

        /*
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


        $adtc = Advert_cit::where([
            ['price','=','1'],
            ['price_two', '=', '1000000']
        ])->get();

        foreach($adtc as $ad_c):
            $ad_c->price= 0;
            $ad_c->price_two= 0;
            $ad_c->dogovor = 1;
            $ad_c->save();
        endforeach;
        */

    }
}
