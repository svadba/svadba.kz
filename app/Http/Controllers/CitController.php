<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cit;
use App\Advert_categor;
use App\Combo;

class CitController extends Controller
{
    public function mainPage($city)
    {
        $categories = Advert_categor::all();
        $nowCity = Cit::where('name_eng', $city)->firstOrFail();

        $topsOne = $nowCity->cit_tops()->where('top_type', 1)->with('advert.photos')->get();
        $topsOne = ($topsOne->count() <= 4) ? $topsOne : $topsOne->random(4);

        $topsTwo = $nowCity->cit_tops()->where('top_type', 2)->with(['advert.photos' => function($query) {
            $query->where('main', 1);
        }])->get();
        $topsTwo = ($topsTwo->count() <= 4) ? $topsTwo : $topsTwo->random(4);

        $topsThree = $nowCity->cit_tops()->where('top_type', 3)->with(['advert.photos' => function($query) {
            $query->where('main', 1);
        }])->get();
        $topsThree = ($topsThree->count() <= 4) ? $topsThree : $topsThree->random(4);

        $combos = Combo::whereExists(function($q) use($nowCity){
            $q->select('combo_id', 'cit_id')->from('combo_cits')->whereRaw('combo_cits.combo_id = combos.id')->where('cit_id', $nowCity->id);
        })
            ->with(['combo_cits' => function($q) use($nowCity){
                $q->where('cit_id', $nowCity->id)->with('categories');
            }])
            ->get();

        return view('pages.cityPage' ,[
            'nowCity' => $nowCity,
            'topsOne' => $topsOne,
            'topsTwo' => $topsTwo,
            'topsThree' => $topsThree,
            'categories' => $categories,
            'combos' => $combos,
            'sn' => 'cityPage'
        ]);
    }

    public function by_id(Request $request)
    {
        if(!$request->has('city')) return redirect('/');

        $cit =  Cit::where('id', $request->city)->first();

        return redirect('/cities/'.$cit->name_eng);

    }
}
