<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advert_top;
use App\Advert_categor;
use App\Cit;

class MainPageController extends Controller
{
    public function mainPage()
    {

        //Получаем топов трех видов проверкой если значение меньше 8 то отадвать без рандома иначе рандом 8
        $top1 = Advert_top::where('top_type', 1)->with('advert.photos')->get();
        $top1 = (($top1->count())<=4) ? $top1 : $top1->random(4);
        $top2 = Advert_top::where('top_type', 2)->with('advert.photos')->get();
        $top2 = (($top2->count())<=4) ? $top2 : $top2->random(4);
        $top3 = Advert_top::where('top_type', 3)->with('advert.photos')->get();
        $top3 = (($top3->count())<=4) ? $top3 : $top3->random(4);

        
        
        //получаем категории и города
        $categories = Advert_categor::all();
        $cities = Cit::all();


        //возвращаем вид с переменными топов городов и категорий
       return view('pages.main_page', [
           'top1' => $top1,
           'top2' => $top2,
           'top3' => $top3,
           'categories' => $categories,
           'cities' => $cities,
           'sn' => 'main_page'
       ]);
    }

    public function contacts()
    {
        return view('static.contacts', ['sn' => 'contacts']);
    }

    public function about()
    {
        return view('static.about', ['sn' => 'about']);
    }

    public function rulesAndHelp()
    {
        return view('static.rules_and_help', ['sn' => 'rules_and_help']);
    }

    public function advertising()
    {
        return view('pages.advertising', ['sn' => 'advertising']);
    }

    public function weddingPlan()
    {
        return view('pages.wedding_plan', ['sn' => 'contacts']);
    }


}

