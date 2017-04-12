<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phone;
use App\Http\Requests;

class PhoneController extends Controller
{
    public function delete(Request $request, Phone $phone)
    {   
        //$phonecount = Phone::where('contractor_id', '=', $phone->contractor_id)->count();
        //if($phonecount<=1)
        //{
        //    return redirect()->back()->withErrors(['asdasd' => 'Добавьте запасной номер, прежде чем Вы удалите основной номер']);
        //}
        $phone->delete();
        return redirect()->back();
    }
}
