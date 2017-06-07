<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advert_categor;
use App\Cit;
use App\Advert;
use App\Http\Requests;

class ServicesController extends Controller
{

    public function all(){

        $services = Advert_categor::all();
        return view('pages.services',
            [
                'services' => $services,
                'sn' => 'services',
                'title' => 'Список всех услуг',
                'description' => 'Свадебные услуги портала SVADBA.KZ'
            ]);
    }


    public function by_filter(Request $request)
    {
        $categories = Advert_categor::all();
        $cities = Cit::all();

        $search_name = ($request->has('search_name')) ? $request->search_name : '';
        $city = ($request->city) ? $request->city : '';
        $category = ($request->category) ? $request->category : '';
        $price = ($request->has('price')) ? $request->price : '';
        IF($request->has('sort'))
        {
            switch($request->sort)
            {
                case '2':  $sort = 'views'; break;
                case '1':  $sort = 'rating'; break;
                case '3':  $sort = 'created_at'; break;
                default : $sort = 'rating'; break;
            }
        }
        else
        {
            $sort = 'rating';
        }


        $adverts = Advert::where('allow_type_id',1)->with('advert_cits')->with('advert_categor')->with('advert_stat')->with(['photos' => function($query) {
                $query->where('main', 1);
            }])
            ->when($search_name, function($query) use ($search_name){
                return $query->where('name', 'like', '%'.$search_name.'%');
            })
            ->when($category, function($query) use ($category){
                return $query->where('advert_categor_id', '=', $category);
            })
            ->when($city, function($q) use ($city){
                return $q->whereExists(function($q) use ($city){
                    $q->select('cit_id','advert_id')->from('advert_cits')->whereRaw('advert_cits.advert_id = adverts.id')->where('cit_id', '=', $city);
                });
            })
            ->when($price, function($q) use ($price){
                return $q->whereExists(function($q) use ($price){
                    $q->select('price','advert_id')->from('advert_cits')->whereRaw('advert_cits.advert_id = adverts.id')->where('price', '<=', $price);
                });
            })
            ->orderBy($sort, 'desc')
            ->paginate(12);

        return view('pages.services_by_filter', [
            'adverts' => $adverts,
            'city_filter' => $city,
            'category_filter' => $category,
            'sort_by' => $request->sort,
            'search_name' => $search_name,
            'categories' => $categories,
            'price' => $price,
            'cities' => $cities,
            'sort_list' => [
                '1' => 'По рейтингу',
                '2' => 'По просмотрам',
                '3' => 'По дате'
                ],
            'sn' => 'services_by_filter',
            'title' => 'Список объявлений по фильтру',
            'description' => 'Объявления отсортированные по городу и категории'
        ]);

    }

    public function ajax_get_adverts(Request $request)
    {

        $this->validate($request,[
            'name_search' => 'required|string|max:50'
        ]);

        $adverts = Advert::where('name', 'LIKE', '%'.$request->name_search.'%')->with(['photos' => function($query) {
                $query->where('main', 1);
            }])
            ->with('advert_stat')->with('advert_categor')->with('advert_cits.cit')->get();




        return $adverts;
    }
}
