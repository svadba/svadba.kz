<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Contractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contractor = Contractor::where('user_id', $request->user()->id)
        ->with('phones','adverts.advert_categor', 'adverts.musics', 'adverts.photos', 'adverts.videos')->first();
        return view('home.home', ['contractor' => $contractor,'sn' => 'home']);
    }
    
    
}
