<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Phone;

class TestController extends Controller
{
    public function test_method(){
          
        return $phones_c = Phone::where('contractor_id', 3)->count();
          
    }
}
