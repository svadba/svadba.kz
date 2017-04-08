<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MainPageController extends Controller
{
    public function mainPage()
    {
       return view('pages.main_page');
    }
}

