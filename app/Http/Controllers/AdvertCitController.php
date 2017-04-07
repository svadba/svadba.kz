<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Advert_cit;
use App\Http\Requests;

class AdvertCitController extends Controller
{
    public function delete(Advert_cit $advert_cit)
    {
        $advert_cit->delete();
        return redirect()->back();
    }
    
}
