<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contype;
use Validator;
use App\Contractor;
use App\Phone;
use App\Http\Requests;

class ContController extends Controller
{   
    
    
    
    public function my(Request $request)
    {   
        $contractors = $request->user()->contractors()->with('phones')->with('adverts')->paginate(10);
        return View('contractor.contractors', ['contractors' => $contractors]);
    }
    
    public function all()
    {   
        $contractors = Contractor::with('phones')->with('adverts')->paginate(10);
        return View('contractor.contractors', ['contractors' => $contractors]);
    }
    
    public function add()
    {   
        $contypes = Contype::all();
        return View('contractor.add_cont', ['contypes' => $contypes]);
    }
     
    public function save(Request $request){
        
        $valid = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'surname' => 'max:100',
            'middlename' => 'max:100',
            'birthday' => 'max:10',
            'email' => 'email|max:255|unique:contractors,email',
            'address' => 'max:100',
            'phones.0' => 'digits_between:6,12|unique:phones,phone',
            'phones.*' => 'digits_between:6,12|unique:phones,phone',
            'contype' => 'required|numeric|max:3',
        ]);
        
        IF($valid->fails())
        {
            return redirect()->back()->withErrors($valid)->withInput($request->all());
        }
        
        $add_contractor = $request->user()->contractors()->create([
            'name' => $request->name,
            'surname' => $request->surname,
            'middlename' => $request->middlename,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'email' => $request->email,
            'allow_type_id' => 2,
            'constat_id' => 2,
            'contype_id' => $request->contype,
        ]);
        
        IF($request->has('phones'))
        {
            foreach($request->phones as $ph):
                IF($ph)
                {
                    $add_contractor->phones()->create([
                        'name' => 'Main',
                        'phone' => $ph,
                    ]);
                }
            endforeach;
        }        
        
        return redirect('/contractors/my');
    }
    
    public function view(Request $request, Contractor $contractor)
    {   
        return view('contractor.view',['contractor' => $contractor]);
    }
    
    public function edit(Contractor $contractor)
    {   
        $contypes = Contype::all();
        return view('contractor.edit',['contractor' => $contractor, 'contypes' => $contypes]);
    }
    
    public function edit_go(Request $request)
    {   
        $vr = Validator::make($request->all(), [
            'contractor_id' => 'required|numeric',
            'name' => 'required|max:100',
            'surname' => 'max:100',
            'middlename' => 'max:100',
            'birthday' => 'max:10',
            'email' => 'email|max:255|unique:contractors,email,'.$request->contractor_id.',id',
            'address' => 'max:100',
            'contype' => 'required|numeric|max:3',
            'phones.*' => 'digits_between:6,12|unique:phones,phone',
        ]);
        
        $contractor = Contractor::findOrFail($request->contractor_id);
        
        //$vr->sometimes('phones.*', 'required|digits_between:6,12|unique:phones, phone', function ($contractor){
        //    return count($contractor->phones) < 1;
        //});
        
        IF($vr->fails())
        {
            return redirect()->back()->withErrors($vr)->withInput($request->all());
        }
        
        $contractor->name = $request->name;
        $contractor->surname = $request->surname;
        $contractor->middlename = $request->middlename;
        $contractor->birthday = $request->birthday;
        $contractor->email = $request->email;
        $contractor->address = $request->address;
        $contractor->contype_id = $request->contype;
        $contractor->save();
        
        IF($request->has('phones'))
        {
            foreach($request->phones as $ph):
                IF($ph)
                {
                    $contractor->phones()->create([
                        'name' => 'Main',
                        'phone' => $ph,
                    ]);
                }
            endforeach;
        }
        
        return redirect('contractors/my');
    }
    
    
    public function delete(Contractor $contractor)
    {   
        
        $this->authorize('delete', $contractor);
        $contractor->delete();
        return redirect('/contractors/my');
    }
}
