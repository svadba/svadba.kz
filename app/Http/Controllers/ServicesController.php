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
        return view('pages.services', ['services' => $services, 'sn' => 'services']);
    }


    public function by_filter(Request $request)
    {
        $categories = Advert_categor::all();
        $cities = Cit::all();

        $city = ($request->has('city')) ? $request->city : '';
        $category = ($request->has('category')) ? $request->category : '';
        IF($request->has('sort'))
        {
            switch($request->sort)
            {
                case 'created_at':  break;
                case 'published_at':  break;
                default : $sort = 'created_at'; break;
            }
        }
        {
            $sort = 'created_at';
        }


        $adverts = Advert::with('advert_cits')->with('advert_categor')->with('advert_stat')
            ->when($category, function($query) use ($category){
                return $query->where('advert_categor_id', '=', $category);
            })
            ->when($city, function($q) use ($city){
                return $q->whereExists(function($q) use ($city){
                    $q->select('cit_id','advert_id')->from('advert_cits')->whereRaw('advert_cits.advert_id = adverts.id')->where('cit_id', '=', $city);
                });
            })
            ->orderBy($sort, 'desc')
            ->paginate(12);

        return view('pages.services_by_filter', [
            'adverts' => $adverts,
            'city_filter' => $city,
            'category_filter' => $category,
            'sort_filter' => $sort,
            'categories' => $categories,
            'cities' => $cities,
            'sn' => 'services_by_filter'
        ]);
    }
}
