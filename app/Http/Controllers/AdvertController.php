<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DB;
use Validator;
Use Illuminate\Support\Facades\Storage;
use App\Contractor;
use App\Advert;
use App\Advert_cit;
use App\Cit;
use App\Photo;
use App\Video;
use App\Advert_categor;
use App\Http\Requests;

class AdvertController extends Controller
{
    
    public function advertPage(Advert $advert)
    {
        //return $advert = $advert->with('photos', 'musics', 'videos', 'cits', 'advert_categor')->get();
        return view('pages.advert_page', ['ad' => $advert]);
    }

    public function my(Request $request)
    {   
        $cities = Cit::all();
        $categories = Advert_categor::all();
        $city = ($request->has('city')) ? $request->city : '';
        $category = ($request->has('category')) ? $request->category : '';
        IF($request->has('sort'))
        {
            switch($request->sort)
            {
                case 'created_at':  break;
                case 'published_at':  break;
                default : $sort = 'created_at'; break;
            }
        }
        {
            $sort = 'created_at';
        }
      
        
        $adverts = Advert::with('advert_cits')->with('advert_categor')->with('advert_stat')->with('musics')->with('photos')->with('videos')
                ->where('user_id', $request->user()->id )
                ->when($category, function($query) use ($category){
                    return $query->where('advert_categor_id', '=', $category);
                })
                ->when($city, function($q) use ($city){
                    return $q->whereExists(function($q) use ($city){
                        $q->select('cit_id','advert_id')->from('advert_cits')->whereRaw('advert_cits.advert_id = adverts.id')->where('cit_id', '=', $city);
                    });
                })
                ->orderBy($sort, 'desc')
                ->paginate(10)
                ;
        
        //DB::table('adverts')->whereExists
        
        return View('advert.adverts_my', ['adverts' => $adverts, 'cities' => $cities, 'categories' => $categories, 'city' => $city, 'category'=> $category, 'sort' => $sort]);
    }
    
    
    public function all(Request $request)
    {   
        $cities = Cit::all();
        $categories = Advert_categor::all();
        $city = ($request->has('city')) ? $request->city : '';
        $category = ($request->has('category')) ? $request->category : '';
        IF($request->has('sort'))
        {
            switch($request->sort)
            {
                case 'created': $sort = 'created_at'; break;
                case 'published': $sort = 'published_at'; break;
                default : $sort = 'created_at'; break;
            }
        }
        {
            $sort = 'created_at';
        }
        
        $adverts = Advert::with('advert_cits')
                ->when($category, function($query) use ($category){
                    return $query->where('advert_categor_id', '=', $category);
                })
                ->when($city, function($q) use ($city){
                    return $q->whereExists(function($q) use ($city){
                        $q->select('cit_id','advert_id')->from('advert_cits')->whereRaw('advert_cits.advert_id = adverts.id')->where('cit_id', '=', $city);
                    });
                })
                ->orderBy($sort, 'desc')
                ->paginate(10)
                ;   
                
        return View('advert.adverts', ['adverts' => $adverts, 'cities' => $cities, 'categories' => $categories, 'city' => $city, 'category'=> $category, 'sort' => $sort]);
    }
    
    
    public function add(Request $request, Contractor $contractor)
    {   
        $cities = Cit::all();
        $adv_cats = Advert_categor::all();
        return View('advert.add_adv', ['adv_cats' => $adv_cats, 'contr' => $contractor, 'cities' => $cities]);
    }
    
    
    public function save(Request $request)
    {
        $vr = Validator::make($request->all(), [
            'contractor_id' => 'required|numeric|exists:contractors,id',
            'name' => 'required|max:100',
            'description' => 'max:2000',
            'adv_cat' => 'required|numeric|max:30,unique:adverts,advert_categor_id,NULL,id,contractor_id,'.$request->id,
            'advert_cits.*' => 'numeric|exists:cits,id',
            'prices.*' => 'numeric|max:100000000',
            'prices_two.*' => 'numeric|max:100000000',
            'photos.*' => 'image',
            'videos.*' => 'active_url',
            
        ]);
        
        if($vr->fails())
        {
            return redirect()->back()->withErrors($vr)->withInput($request->all());
        }
        
        $contractor = Contractor::findOrFail($request->contractor_id);
        
        $add_advert = $contractor->adverts()->create([
            'name' => $request->name,
            'description' => $request->description,
            'rating' => 0,
            'views' => 0,
            'allow_type_id' => 2,
            'advert_categor_id' => $request->adv_cat,
            'advert_stat_id' => 2,
            'contractor_id' => $request->contractor_id,
            'user_id' => $request->user()->id,
            'publicshed_at' => time(),
        ]);
        
        IF( $request->has('advert_cits') && $request->has('prices') && $request->has('prices_two') )
        {

            $count_cits = count($request->advert_cits);
            $count_prices = count($request->prices);
            $count_prices_two = count($request->prices_two);

            IF( ($count_cits == $count_prices) && ($count_cits ==$count_prices_two))
            {
                FOR($i = 0; $i < $count_cits; $i++)
                {
                    IF( $request->advert_cits[$i] && $request->prices[$i] && $request->prices_two[$i])
                    $add_advert->advert_cits()->create([
                        'cit_id' => $request->advert_cits[$i],
                        'price' => $request->prices[$i],
                        'price_two' => $request->prices_two[$i],
                    ]);
                }
            }
        }
        
        $directory = 'upload/adverts/'.$add_advert->id;
        
        IF($request->hasFile('photos'))
        {   

            foreach($request->file('photos') as $photo):
                $extension = $photo-> guessExtension();
                IF($photo->isValid())
                {   
                    IF($photo->getClientSize() <= 20*1024*1024)
                    {   
                        
                        $name = str_random(10).$count;
                        $photo->move($directory.'/photos/', $name.'.'.$extension);
                        Photo::create([
                            'name' => $name,
                            'path' => $directory.'/photos/'.$name.'.'.$extension,
                            'ext' => $extension,
                            'advert_id' => $add_advert->id,
                        ]);
                    }
                }
            endforeach;
        }
        
        IF($request->has('videos'))
        {
            foreach($request->videos as $video):
                IF($video)
                {   
                    $video_rev = strrev($video);
                    $video_rev = explode('/', $video_rev);
                    $uniq_link = strrev($video_rev[0]);
                    $video_link = 'https://www.youtube.com/embed/'.$uniq_link;
                    Video::create([
                        'path' => $video_link,
                        'base_path' => $video,
                        'youtube_video_id' => $uniq_link,
                        'advert_id' => $add_advert->id,
                    ]);
                }
            endforeach;
        }
                
        return redirect('/contractors/my');
    }
    
    
    public function allow(Advert $advert)
    {
        $advert->allow_type_id = 1;
        $advert->save();
        return redirect()->back();
    }
    
    
    /*-----------------------
     * method change publishe status by advert
     * parametr Advert
     * return back url
     */
    
    public function unallow(Advert $advert)
    {
        $advert->allow_type_id = 2;
        $advert->save();
        return redirect()->back();
    }
    
    
    public function edit(Advert $advert)
    {   
        $cities = Cit::all();
        $advert_categor = Advert_categor::all();
        return view('advert.edit', ['advert' => $advert, 'adv_cat' => $advert_categor, 'cities'=> $cities]);
    }
    
    
    public function edit_go(Request $request)
    {

        $vr = Validator::make($request->all(),[
            'advert_id' => 'required|numeric|exists:adverts,id',
            'name' => 'required|max:100',
            'description' => 'max:2000',
            'adv_cat' => 'required|numeric|max:30|exists:advert_categors,id',
            'advert_cits.*' => 'numeric|exists:cits,id|unique:advert_cits,cit_id,NULL,id,advert_id,'.$request->advert_id,
            'prices.*' => 'numeric|max:100000000',
            'prices_two.*' => 'numeric|max:100000000',
            'photos.*' => 'image',
            'videos.*' => 'active_url',
        ]);
        
        IF($vr->fails())
        {
            return redirect()->back()->withErrors($vr)->withInput($request->all());
        }
        
        $advert = Advert::findOrFail($request->advert_id);
        //$contractor_adverts = Advert::where('contractor_id', $advert->contractor_id);
        
        //IF(!$request->adv_cat == $advert->advert_categor_id)
        //{
        //    foreach($contractor_adverts as $adver):
        //       if($adver->advert_categor_id == $request->adv_cat) return redirect()->back()->withInput($request->all())->withErrors ('')
        //    endforeach;
        //}
        
        $advert->name = $request->name;
        $advert->description = $request->description;
        $advert->advert_categor_id = $request->adv_cat;
        $advert->save();
        
        IF($request->hasFile('photos'))
        {   
            $directory = 'upload/adverts/'.$advert->id;
            $count = 1;
            $loaded_photos = '';
            foreach($request->file('photos') as $photo):
                $extension = $photo-> guessExtension();
                IF($photo->isValid())
                {   
                    IF($photo->getClientSize() <= 20*1024*1024)
                    {   
                        $name = str_random(10).$count;
                        $photo->move($directory.'/photos/', $name.'.'.$extension);
                        Photo::create([
                            'name' => $name,
                            'path' => $directory.'/photos/'.$name.'.'.$extension,
                            'ext' => $extension,
                            'advert_id' => $advert->id,
                        ]);
                    }
                }
            $count++;    
            endforeach;
        }

        IF( $request->has('advert_cits') && $request->has('prices') && $request->has('prices_two') )
        {

            $count_cits = count($request->advert_cits);
            $count_prices = count($request->prices);
            $count_prices_two = count($request->prices_two);

            IF( ($count_cits == $count_prices) && ($count_cits ==$count_prices_two))
            {
                FOR($i = 0; $i < $count_cits; $i++)
                {
                    IF( $request->advert_cits[$i] && $request->prices[$i] && $request->prices_two[$i])
                        $advert->advert_cits()->create([
                            'cit_id' => $request->advert_cits[$i],
                            'price' => $request->prices[$i],
                            'price_two' => $request->prices_two[$i],
                        ]);
                }
            }
        }
        
        IF($request->has('videos'))
        {
            foreach($request->videos as $video):
                IF($video)
                {   
                    
                    $video_rev = strrev($video);
                    $video_rev = explode('/', $video_rev);
                    $uniq_link = strrev($video_rev[0]);
                    $video_link = 'https://www.youtube.com/embed/'.$uniq_link;
                    Video::create([
                        'path' => $video_link,
                        'base_path' => $video,
                        'youtube_video_id' => $uniq_link,
                        'advert_id' => $advert->id,
                    ]);
                }
            endforeach;
        }
        
        return redirect()->back();
    }
    
    
    public function delete(Request $request, Advert $advert)
    {   
        $directory = 'upload/adverts/'.$advert->id;
        $true_delete = Storage::disk('public_my')->deleteDirectory($directory);
        $advert->delete();
        return redirect()->back();
    }
}
