<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advert_cit;
use App\Advert;
use App\Http\Requests;

class AdvertCitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function delete(Advert_cit $advert_cit)
    {
        $advert_cit->delete();
        return redirect()->back();
    }

    public function delete_ajax(Request $request)
    {
        $this->validate($request, [
            'advert_id' => 'required|exists:adverts,id,user_id,'.$request->user()->id,
            'adv_cit_id' => 'required|exists:advert_cits,id'
        ]);

        $advert_cit = Advert_cit::findOrFail($request->adv_cit_id);

        $advert_cits = Advert_cit::where('advert_id', $request->advert_id)->get();

        if(!($advert_cit->advert->user_id == $request->user()->id)) {
            return json_encode(array(
                "result" => "false",
                "error" => "error_autorization"
            ));
        }

        if($advert_cits->count() <= 1)
        {
            return json_encode(array(
                "result" => "false",
                "error" => "error_count"
            ));
        }

        $adv_id = $advert_cit->id;
        $advert_cit->delete();
        return json_encode(array(
            "result" => true,
            "id" => $adv_id
        ));
    }

    public function add_ajax(Request $request)
    {
        $this->validate($request, [
            'advert_id' => 'required|exists:adverts,id,user_id,'.$request->user()->id,
            'cit_id' => 'required|integer|exists:cits,id|unique:advert_cits,cit_id,NULL,id,advert_id,'.$request->advert_id,
            'price' => 'required|integer|max:20000000'
        ]);

        $advert = Advert::findOrFail($request->advert_id);

        if ($advert->user_id != $request->user()->id) return json_encode(array(
            "result" => false,
            "error" => 'error_autenticate'
        ));

        $add_cit = Advert_cit::create([
            "cit_id" => $request->cit_id,
            "price" => $request->price,
            "advert_id" => $request->advert_id
        ]);

        if($add_cit)
        {
            $add_cit->load('cit');
            return json_encode(array(
                "result" => true,
                "model" => $add_cit
            ));
        }
        else{
            return json_encode(array(
                "result" => false,
                "error" => 'error_add_model'
            ));
        }
    }
}
