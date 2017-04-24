<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advert_categor;
use App\Cit;

use App\Http\Requests;

class ListDataController extends Controller
{
    public function view_city()
    {
        $cities = Cit::all();
        return view('admin.list_data_cities', ['cities' => $cities]);
    }

    public function view_category()
    {
        $categories  = Advert_categor::all();
        return view('admin.list_data_categories', ['categories' => $categories]);
    }

    public function add_city(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:30|unique:cits,name',
            'name_eng' => 'required|alpha_dash|max:30|unique:cits,name_eng',
        ]);

        Cit::create([
            'name'=> $request->name,
            'name_eng' => $request->name_eng
        ]);

        return redirect()->back();
    }

    public function add_category(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:30|unique:advert_categors,name',
            'name_eng' => 'required|alpha_dash|max:30|unique:advert_categors,name_eng',
        ]);

        Advert_categor::create([
            'name'=> $request->name,
            'name_eng' => $request->name_eng
        ]);

        return redirect()->back();
    }
}
