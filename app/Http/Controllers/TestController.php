<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advert_cit;
use App\Advert;
use App\Photo;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use App\Combo;
use App\Combo_cit;

class TestController extends Controller
{
    public function test_method(){
        set_time_limit(0);
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

	$photos = Photo::all();
	//return $photos;
	
	foreach($photos as $photo):
	    $image = Image::make($photo->path);
	    $image->grab(290)
		->save('upload/adverts/' .$photo->advert_id. '/photos_two/' .$photo->name. '.' .$photo->ext, 90);
	endforeach;




    foreach($adverts as $advert):
        $first = $advert->photos->first();

        if($first)
        {
            $first['main'] = 1;
            $first->save();
            $image = Image::make($first['path']);
            $image->fit(290)->save('upload/adverts/thumbs/' .$first['name']. '.' .$first['ext']);
            printf($advert->id.'</br>');
        }

    endforeach;

    $adverts = Advert::where('id', '<', 200)->with(['photos' => function($query) {
        $query->where('main', 1);
    }])->get();
	return $adverts;


    $combos = Combo::whereExists(function($q) {
            $q->select('combo_id', 'cit_id')->from('combo_cits')->whereRaw('combo_cits.combo_id = combos.id')->where('cit_id', 1);
        })
        ->with(['combo_cits' => function($q){
            $q->where('cit_id', 1)->with('categories');
        }])
        ->get();*/

    $combo_cit = Combo_cit::with('combo_categors.advert_categor', 'combo_categors.adverts')->get();
    return $combo_cit;

    }
}
