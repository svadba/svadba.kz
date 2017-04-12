<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Advert;

class TestController extends Controller
{
    public function test_method(Advert $advert){

        $advert = $advert->with('photos', 'musics', 'videos', 'advert_cits', 'advert_categor')->where('id', 215)->get();
        //return view('pages.advert_page', ['advert' => $advert]);
        return $advert;
          
    }
}
