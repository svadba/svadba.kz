<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advert_top;
use App\Advert_categor;
use App\Cit;
use App\Sv_count;

class MainPageController extends Controller
{
    public function mainPage()
    {

        //Получаем топов трех видов проверкой если значение меньше 8 то отадвать без рандома иначе рандом 8
        $top1 = Advert_top::where('top_type', 1)->with('advert.photos')->get();
        $top1 = (($top1->count())<=4) ? $top1 : $top1->random(4);

        //получаем категории и города
        $categories = Advert_categor::all();
        $cities = Cit::whereNotIn('id', [16,17,18])->orderBy('order', 'asc')->get();

        //возвращаем вид с переменными топов городов и категорий
       return view('pages.main_page', [
           'categories' => $categories,
           'cities' => $cities,
           'sn' => 'main_page',
           'title' => 'Главная',
           'description' => 'Организация свадьбы в Астане, Алмате, Актау, Актобе, Атырау, Караганде, Костанае, Кызылорде, Павлодаре, Семее, Таразе, Уральске, Усть-Каменогорске, Шымкенте'
       ]);
    }


    public function like_svadba()
    {
        $now = Sv_count::findOrFail(1);
        $like_to = $now->likes+1;
        $now->likes = $like_to;
        $now->save();

        return $like_to;
    }

}

