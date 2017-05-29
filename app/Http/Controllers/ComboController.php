<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Combo;
use App\Cit;
use App\Combo_cit;
use App\Advert_categor;
use App\Combo_cit_categor;
use App\Combo_cit_categor_advert;
use App\Advert;
use Validator;


use App\Http\Requests;

class ComboController extends Controller
{
    public function all()
    {
        $combos = Combo::with('combo_cits.cit', 'combo_cits.combo_categors', 'combo_cits.combo_categors.advert_categor', 'combo_cits.combo_categors.adverts')->get();
        //return $combos;
        return view('combo.all', ['combos' => $combos]);
    }

    public function viewUser(Request $request, Combo $combo, Combo_cit $combo_cit)
    {
        If($combo_cit->combo_id != $combo->id) return redirect()->back();

        $combo_cit = $combo_cit->load('combo_categors.advert_categor', 'combo_categors.adverts.photos', 'cit');
        //return $combo;
        //return $combo_cit;
        return view('combo.viewCombo', [
            'combo' => $combo,
            'combo_cit'=> $combo_cit,
            'sn' => 'combo',
            'title' => 'Станица пакета '.$combo_cit->cit->name,
            'description' => 'Страница для заказа паета '.$combo_cit->cit->name
        ]);
    }

    public function add(Request $request)
    {
        return view('combo.add');
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100|unique:combos,name',
            'name_eng' => 'required|string|max:100|unique:combos,name_eng',
            'description' => 'string|max:2000',
            'price' => 'required|numeric|max:20000000',
            'photo_path' => 'required|mimes:jpeg,jpg,bmp,png,svg'
        ]);

        $added = Combo::create([
            'name' => $request->name,
            'name_eng' => $request->name_eng,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        $directory = 'upload/combos/';
        IF($request->hasFile('photo_path'))
        {
            $photo = $request->photo_path;
            IF($photo->isValid())
            {
                IF($photo->getClientSize() <= 20*1024*1024)
                {
                    $extension = $photo-> guessExtension();
                    $name = str_random(10).$added->id;
                    $photo->move($directory, $name.'.'.$extension);
                    $added->photo_path = $directory.$name.'.'.$extension;
                    $added->save();
                }
            }
        }

        return redirect('/admin/combos/all');
    }

    //AJAX


    public function get_cities()
    {
        return Cit::whereNotIn('id', [16,17,18])->get();
    }

    public function set_cities(Request $request, Combo $combo)
    {
        IF(!$request->has('data')) return 'error_data';

        $cities = array_keys(json_decode($request->data, true));

        IF(!$cities) return 'error_keys';

        $valid  = Validator::make(
            ['data' => $cities],
            ['data.*' => 'required|numeric|exists:cits,id|unique:combo_cits,cit_id,NULL,id,combo_id,'.$combo->id]
        );

        IF($valid->fails()) return 'error_valid';

        $added_array = [];
        foreach($cities as $city):
            $to_added_array = $combo->combo_cits()->create([
                'cit_id' => $city
            ]);
            $added_array[] = $to_added_array->id;
        endforeach;

        return Combo_cit::whereIn('id', $added_array)->with('cit')->with('combo')->get();
    }




    public function get_categories()
    {
        return Advert_categor::all();
    }

    public function set_categories(Request $request, Combo_cit $combo_cit)
    {
        IF(!$request->has('data')) return 'error_data';

        $categories = array_keys(json_decode($request->data, true));

        IF(!$categories) return 'error_keys';

        $valid  = Validator::make(
            ['data' => $categories],
            ['data.*' => 'required|numeric|exists:advert_categors,id|unique:combo_cit_categors,advert_categor_id,NULL,id,combo_cit_id,'.$combo_cit->id]
        );

        IF($valid->fails()) return 'error_valid';

        $added_array = [];
        foreach($categories as $cat):
            $to_added_array = $combo_cit->combo_categors()->create([
                'advert_categor_id' => $cat
            ]);
            $added_array[] = $to_added_array->id;
        endforeach;

        return Combo_cit_categor::whereIn('id', $added_array)->with('advert_categor')->with('combo_cit.cit')->get();
    }


    public function get_adverts(Request $request)
    {

        $this->validate($request, [
            'city' => "required|numeric|exists:cits,id",
            'category' => "required|numeric|exists:advert_categors,id"
        ]);
        $city = $request->city;
        $category = $request->category;

        return Advert::with('photos', 'advert_categor','advert_stat', 'advert_cits.cit')->where('advert_categor_id', $category)->whereExists(function($q) use ($city){
                            $q->select('cit_id','advert_id')->from('advert_cits')->whereRaw('advert_cits.advert_id = adverts.id')->where('cit_id', '=', $city);
                })->get();
    }

    public function set_adverts(Request $request, Combo_cit_categor $combo_cit_categor)
    {
        IF(!$request->has('data')) return 'error_data';

        $adverts = array_keys(json_decode($request->data, true));

        IF(!$adverts) return 'error_keys';

        $valid  = Validator::make(
            ['data' => $adverts],
            ['data.*' => 'required|numeric|exists:adverts,id|unique:combo_cit_categor_adverts,advert_id,NULL,id,combo_cit_categor_id,'.$combo_cit_categor->id]
        );

        IF($valid->fails()) return 'error_valid';

        $added_array = [];
        foreach($adverts as $advert):
            $to_added_array = $combo_cit_categor->combo_adverts()->create([
                'advert_id' => $advert
            ]);
            $added_array[] = $to_added_array->id;
        endforeach;

        return Combo_cit_categor_advert::whereIn('id', $added_array)->with('advert')->get();
    }

    public function delete_city(Combo_cit $combo_cit)
    {
        $id = $combo_cit->id;
        $combo_cit->delete();
        return $id;
    }

    public function delete_category(Combo_cit_categor $combo_cit_categor)
    {
        $id = $combo_cit_categor->id;
        $combo_cit_categor->delete();
        return $id;
    }

    public function delete_advert(Combo_cit_categor_advert $combo_cit_categor_advert)
    {
        $id = $combo_cit_categor_advert->id;
        $combo_cit_categor_advert->delete();
        return $id;
    }

    //AJAX


    public function bakyt()
    {
        $cities = Cit::whereNotIn('id', [16,17,18])->orderBy('order', 'ASC')->get();
        return view('combo.bakyt',
            [
                'cities' => $cities,
                'sn' => 'bakyt',
                'title' => 'Мастер класс "Бакыт"',
                'description' => 'Страница для оформления заяявки на мастер класс "Бакыт"'
            ]);
    }


}
