<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Photo;
use App\Http\Requests;

class PhotoController extends Controller
{
    public function delete(Photo $photo)
    {
        
        $photo->delete();
        return redirect()->back();
    }
}
