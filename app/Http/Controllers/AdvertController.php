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
use Intervention\Image\ImageManagerStatic as Image;

class AdvertController extends Controller
{

    /**
     * @param Advert $advert
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function advertPage(Request $request, Advert $advert)
    {
        $advert = Advert::where('id', $advert->id)->with('photos', 'musics', 'videos', 'advert_cits.cit', 'advert_categor')->first();
        $categor  = $advert->advert_categor->id;
        $city = '';
        if($request->city)
        {
            $city = (int) $request->city;
            $other_advert = Advert::where('advert_categor_id', $categor)->whereExists(function($q) use ($city){
                $q->select('cit_id', 'advert_id')->from('advert_cits')->whereRaw('advert_cits.advert_id = adverts.id')->where('cit_id', $city);
            })
            ->with(['photos' => function($query) {
                $query->where('main', 1);
            }])
            ->get();
        }
        else
        {
            $array_cits = [];
            foreach($advert->advert_cits as $adv_cit):
                $array_cits[] = $adv_cit->cit_id;
            endforeach;
            $other_advert = Advert::where('advert_categor_id', $categor)
                ->whereExists(function($q) use ($array_cits){
                    $q->select('cit_id', 'advert_id')->from('advert_cits')->whereRaw('advert_cits.advert_id = adverts.id')->whereIn('cit_id', $array_cits);
                })
                ->with(['photos' => function($query) {
                    $query->where('main', 1);
                }])
                ->get();
        }
        $other_advert = (($other_advert->count())<=3) ? $other_advert : $other_advert->random(3);

        return view('pages.advert_page', ['ad' => $advert, 'other_adverts' => $other_advert, 'city_filter' => $city,'sn' => 'advert_page']);
    }




    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function my(Request $request)
    {   
        $cities = Cit::all();
        $categories = Advert_categor::all();
        $search_name = ($request->has('search_name')) ? $request->search_name : '';
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
                ->when($search_name, function($query) use ($search_name){
                    return $query->where('name', 'like', '%'.$search_name.'%');
                })
                ->when($category, function($query) use ($category){
                    return $query->where('advert_categor_id', '=', $category);
                })
                ->when($city, function($q) use ($city){
                    return $q->whereExists(function($q) use ($city){
                        $q->select('cit_id','advert_id')->from('advert_cits')->whereRaw('advert_cits.advert_id = adverts.id')->where('cit_id', '=', $city);
                    });
                })
                ->orderBy($sort, 'desc')
                ->paginate(25)
                ;
        
        //DB::table('adverts')->whereExists
        
        return View('advert.adverts_my', ['adverts' => $adverts, 'cities' => $cities, 'categories' => $categories, 'city' => $city, 'category'=> $category, 'sort' => $sort, 'search_name' => $search_name]);
    }




    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all(Request $request)
    {   
        $cities = Cit::all();
        $categories = Advert_categor::all();
        $search_name = ($request->has('search_name')) ? $request->search_name : '';
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
        
        $adverts = Advert::with('advert_cits')->with('advert_categor')->with('advert_stat')->with('musics')->with('photos')->with('videos')
                ->when($search_name, function($query) use ($search_name){
                    return $query->where('name', 'like', '%'.$search_name.'%');
                })
                ->when($category, function($query) use ($category){
                    return $query->where('advert_categor_id', '=', $category);
                })
                ->when($city, function($q) use ($city){
                    return $q->whereExists(function($q) use ($city){
                        $q->select('cit_id','advert_id')->from('advert_cits')->whereRaw('advert_cits.advert_id = adverts.id')->where('cit_id', '=', $city);
                    });
                })
                ->orderBy($sort, 'desc')
                ->paginate(25)
                ;   
                
        return View('advert.adverts', ['adverts' => $adverts, 'cities' => $cities, 'categories' => $categories, 'city' => $city, 'category'=> $category, 'sort' => $sort]);
    }




    /**
     * @param Request $request
     * @param Contractor $contractor
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request, Contractor $contractor)
    {   
        $cities = Cit::all();
        $adv_cats = Advert_categor::all();
        return View('advert.add_adv', ['adv_cats' => $adv_cats, 'contr' => $contractor, 'cities' => $cities]);
    }




    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $request)
    {
        $vr = Validator::make($request->all(), [
            'contractor_id' => 'required|numeric|exists:contractors,id',
            'name' => 'required|max:100',
            'description' => 'max:10000',
            'adv_cat' => 'required|numeric|max:30,unique:adverts,advert_categor_id,NULL,id,contractor_id,'.$request->id,
            'advert_cits.*' => 'numeric|exists:cits,id|distinct',
            'prices.*' => 'numeric|max:200000000',
            'prices_two.*' => 'numeric|max:200000000',
            'dogovor.*' => 'numeric|max:1',
            'photos.*' => 'mimes:jpg,bmp,png,jpeg,svg',
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
        
        IF( $request->has('advert_cits') && $request->has('prices') && $request->has('prices_two'))
        {

            $count_cits = count($request->advert_cits);
            $count_prices = count($request->prices);
            $count_prices_two = count($request->prices_two);

            IF( ($count_cits == $count_prices) && ($count_cits ==$count_prices_two) )
            {
                foreach($request->advert_cits as $key => $advc):

                    IF(!$advc) {break;}

                    IF($request->has('dogovor'))
                    {
                        IF(isset($request->dogovor[$key]))
                        {
                            $add_advert->advert_cits()->create([
                                'cit_id' => $advc,
                                'price' => 0,
                                'price_two' => 0,
                                'dogovor' => 1,
                            ]);
                        }
                        ELSEIF($request->prices[$key] || $request->prices_two[$key])
                        {
                            $price1 = ($request->prices[$key]) ? $request->prices[$key] : 0 ;
                            $price2 = ($request->prices_two[$key]) ? $request->prices_two[$key] : 20000000 ;
                            $add_advert->advert_cits()->create([
                                'cit_id' => $advc,
                                'price' => $price1,
                                'price_two' => $price2,
                                'dogovor' => 0,
                            ]);
                        }
                    }
                    ELSEIF($request->prices[$key] || $request->prices_two[$key])
                    {
                        $price1 = ($request->prices[$key]) ? $request->prices[$key] : 0 ;
                        $price2 = ($request->prices_two[$key]) ? $request->prices_two[$key] : 0 ;
                        $add_advert->advert_cits()->create([
                            'cit_id' => $advc,
                            'price' => $price1,
                            'price_two' => $price2,
                            'dogovor' => 0,
                        ]);
                    }
                endforeach;
            }
        }
        

        IF($request->hasFile('photos'))
        {
            $directory = 'upload/adverts/'.$add_advert->id;
            $check = false;
            foreach($request->file('photos') as $photo):
                $extension = $photo-> guessExtension();
                IF($photo->isValid())
                {   
                    IF($photo->getClientSize() <= 20*1024*1024)
                    {
                        $name = str_random(10).$add_advert->id;
                        $photo->move($directory.'/photos/', $name.'.'.$extension);
                        if($check)
                        {
                            $saved_file = Photo::create([
                                'name' => $name,
                                'path' => $directory.'/photos/'.$name.'.'.$extension,
                                'ext' => $extension,
                                'advert_id' => $add_advert->id,
                                'main' => 0,
                            ]);
                        }
                        else
                        {
                            $saved_file = Photo::create([
                                'name' => $name,
                                'path' => $directory.'/photos/'.$name.'.'.$extension,
                                'ext' => $extension,
                                'advert_id' => $add_advert->id,
                                'main' => 1,
                            ]);
                            $image = Image::make($saved_file->path);
                            $image->fit(290)->save('upload/adverts/thumbs/' .$name. '.' .$extension);
                            $check = true;
                        }
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
                
        return redirect('admin/contractors/my');
    }




    /**
     * @param Advert $advert
     * @return \Illuminate\Http\RedirectResponse
     */
    public function allow(Advert $advert)
    {
        $advert->allow_type_id = 1;
        $advert->save();
        return redirect()->back();
    }
    




    /**
     * @param Advert $advert
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unallow(Advert $advert)
    {
        $advert->allow_type_id = 2;
        $advert->save();
        return redirect()->back();
    }




    /**
     * @param Advert $advert
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Advert $advert)
    {   
        $cities = Cit::all();
        $advert_categor = Advert_categor::all();
        return view('advert.edit', ['advert' => $advert, 'adv_cat' => $advert_categor, 'cities'=> $cities]);
    }




    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function edit_go(Request $request)
    {

        $vr = Validator::make($request->all(),[
            'advert_id' => 'required|numeric|exists:adverts,id',
            'name' => 'required|max:100',
            'description' => 'max:10000',
            'adv_cat' => 'required|numeric|max:30|exists:advert_categors,id',
            'advert_cits.*' => 'numeric|exists:cits,id|unique:advert_cits,cit_id,NULL,id,advert_id,'.$request->advert_id.'||distinct',
            'prices.*' => 'numeric|max:200000000',
            'prices_two.*' => 'numeric|max:200000000',
            'photos.*' => 'mimes:jpg,bmp,png,jpeg,svg',
            'videos.*' => 'active_url',
        ]);
        
        IF($vr->fails())
        {
            return redirect()->back()->withErrors($vr)->withInput($request->all());
        }
        
        $advert = Advert::findOrFail($request->advert_id);


        /*
        IF(!$request->adv_cat == $advert->advert_categor_id)
        {
            foreach($contractor_adverts as $adver):
                if($adver->advert_categor_id == $request->adv_cat) return redirect()->back()->withInput($request->all())->withErrors ('')
            endforeach;
        }
        */
        
        $advert->name = $request->name;
        $advert->description = $request->description;
        $advert->advert_categor_id = $request->adv_cat;
        $advert->save();


        IF($request->hasFile('photos'))
        {
            $check = (Photo::where('advert_id', $advert->id)->where('main', 1)->count()) ? true : false;
            $directory = 'upload/adverts/'.$advert->id;
            foreach($request->file('photos') as $photo):
                $extension = $photo-> guessExtension();
                IF($photo->isValid())
                {   
                    IF($photo->getClientSize() <= 20*1024*1024)
                    {   
                        $name = str_random(10) . $advert->id;
                        $photo->move($directory.'/photos/', $name.'.'.$extension);
                        if($check)
                        {
                            $saved_file = Photo::create([
                                'name' => $name,
                                'path' => $directory. '/photos/' .$name. '.' .$extension,
                                'ext' => $extension,
                                'advert_id' => $advert->id,
                                'main' => 0,
                            ]);
                        }
                        else
                        {
                            $saved_file = Photo::create([
                                'name' => $name,
                                'path' => $directory. '/photos/' .$name. '.' .$extension,
                                'ext' => $extension,
                                'advert_id' => $advert->id,
                                'main' => 1,
                            ]);
                            $image = Image::make($saved_file->path);
                            $image->fit(290)->save('upload/adverts/thumbs/' .$name. '.' .$extension);
                            $check = true;
                        }
                    }
                }
            endforeach;
        }

        IF( $request->has('advert_cits') && $request->has('prices') && $request->has('prices_two'))
        {

            $count_cits = count($request->advert_cits);
            $count_prices = count($request->prices);
            $count_prices_two = count($request->prices_two);

            IF( ($count_cits == $count_prices) && ($count_cits ==$count_prices_two) )
            {
                foreach($request->advert_cits as $key => $advc):

                    IF(!$advc) {break;}

                    IF($request->has('dogovor'))
                    {
                        IF(isset($request->dogovor[$key]))
                        {
                            $advert->advert_cits()->create([
                                'cit_id' => $advc,
                                'price' => 0,
                                'price_two' => 0,
                                'dogovor' => 1,
                            ]);
                        }
                        ELSEIF($request->prices[$key] || $request->prices_two[$key])
                        {
                            $price1 = ($request->prices[$key]) ? $request->prices[$key] : 0 ;
                            $price2 = ($request->prices_two[$key]) ? $request->prices_two[$key] : 20000000 ;
                            $advert->advert_cits()->create([
                                'cit_id' => $advc,
                                'price' => $price1,
                                'price_two' => $price2,
                                'dogovor' => 0,
                            ]);
                        }
                    }
                    ELSEIF($request->prices[$key] || $request->prices_two[$key])
                    {
                        $price1 = ($request->prices[$key]) ? $request->prices[$key] : 0 ;
                        $price2 = ($request->prices_two[$key]) ? $request->prices_two[$key] : 20000000 ;
                        $advert->advert_cits()->create([
                            'cit_id' => $advc,
                            'price' => $price1,
                            'price_two' => $price2,
                            'dogovor' => 0,
                        ]);
                    }
                endforeach;
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


    /**
     * @param Request $request
     * @param Advert $advert
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, Advert $advert)
    {
        $directory = 'upload/adverts/'.$advert->id;
        $thumb_photo = Photo::where('advert_id', $advert->id)->where('main', 1)->first();
        if($thumb_photo)
        {
            Storage::disk('public_my')->delete('upload/adverts/thumbs/' .$thumb_photo->name. '.' .$thumb_photo->ext);
        }
        $true_delete = Storage::disk('public_my')->deleteDirectory($directory);
        $advert->delete();
        return redirect()->back();
    }
}
