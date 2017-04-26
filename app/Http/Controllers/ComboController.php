<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Combo;
use App\Cit;


use App\Http\Requests;

class ComboController extends Controller
{
    public function all()
    {
        $combos = Combo::with('cits')->get();
        return view('combo.all', ['combos' => $combos]);
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
            'foto_path' => 'mimes:jpeg,jpg,bmp,png,svg'
        ]);

        $added = Combo::create([
            'name' => $request->name,
            'name_eng' => $request->name_eng,
            'description' => $request->description,
            'price' => $request->price
        ]);

        $directory = 'upload/combos/';
        IF($request->hasFile('foto_path'))
        {
            $photo = $request->foto_path;
            IF($photo->isValid())
            {
                IF($photo->getClientSize() <= 20*1024*1024)
                {
                    $extension = $photo-> guessExtension();
                    $name = str_random(10).$added->id;
                    $photo->move($directory, $name.'.'.$extension);
                    $added->photo_path = $directory.$name.'.'.$extension;
                }
            }
        }

        return redirect('/admin/combos/all');
    }

    //AJAX


    public function get_cities()
    {
        return Cit::whereNotInt('id', [16,17,18])->get();
    }












    //AJAX
    public function on()
    {
        return view('combo.on', ['sn' => 'combo']);
    }

    public function bakyt()
    {
        $cities = Cit::whereNotIn('id', [16,17,18])->orderBy('order', 'ASC')->get();
        return view('combo.bakyt', ['cities' => $cities, 'sn' => 'bakyt']);
    }


}
