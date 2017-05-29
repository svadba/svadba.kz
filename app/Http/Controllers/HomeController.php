<?php

namespace App\Http\Controllers;

use App\Advert_cit;
use App\Http\Requests;
use App\Advert;
use App\Cit;
use App\Photo;
use App\Contractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Advert_categor;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

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
            ->with('phones', 'adverts.advert_categor', 'adverts.musics', 'adverts.photos', 'adverts.videos')->first();
        return view('home.home',
            [
                'contractor' => $contractor,
                'sn' => 'home',
                'title' => 'Панель управления пользователя - ' . $request->user()->name,
                'description' => 'Стартовая страница для управления своими объявлениями и настройками своей учетной записи'
            ]);
    }

    public function add_advert_st1_get(Contractor $contractor)
    {
        $categories = Advert_categor::all();
        return view('home.add_advert_step1', [
            'categories' => $categories,
            'contractor' => $contractor,
            'sn' => 'add_advert_step1',
            'title' => 'Добавление объявления - Шаг 1',
            'description' => 'Страница добавления объявления пользователю ' . $contractor->name
        ]);
    }

    public function add_advert_st1_post(Request $request)
    {


        $contractor = Contractor::findOrFail($request->contractor);

        $this->validate($request, [
            "contractor" => "required|integer|exists:contractors,id,user_id," . $request->user()->id,
            "name" => "required|min:2|max:100",
            'category' => "required|integer|exists:advert_categors,id",
            'description' => "required|min:500|max:1500",
        ]);

        $advert = $contractor->adverts()->create([
            'name' => $request->name,
            'description' => $request->description,
            'advert_categor_id' => $request->category,
            'advert_stat_id' => 2,
            'allow_type_id' => 2,
            'user_id' => $request->user()->id,
            'rating' => 0,
            'views' => 0
        ]);

        if ($advert) {
            return redirect('/home/adverts/edit/' . $advert->id . '/step2');
        } else {
            return redirect('/home/adverts/add/' . $contractor->id .'/step1')->withErrors([
                'Извините, добавление объявления не произошло по неизвестным причинам, повторите попытку позднее'
            ]);
        }

    }

    public function edit_advert_st1_get(Advert $advert)
    {
        $categories = Advert_categor::all();
        return view('home.edit_advert_step1', [
            'categories' => $categories,
            'advert' => $advert,
            'sn' => 'edit_advert_step1',
            'title' => 'Редактирование объявления - Шаг 1',
            'description' => 'Страница редактирования информации объявления ' . $advert->id
        ]);
    }

    public function edit_advert_st1_post(Request $request)
    {
        $advert = Advert::findOrFail($request->advert);

        $this->validate($request, [
            "advert" => 'required|integer|exists:adverts,id,user_id,' . $request->user()->id,
            "name" => "required|min:2|max:100",
            'category' => "required|integer|exists:advert_categors,id",
            'description' => "required|min:500|max:1500",
        ]);

        $advert->name = $request->name;
        $advert->advert_categor_id = $request->category;
        $advert->description = $request->description;

        if($advert->save()){
            return redirect('/home/adverts/edit/' . $advert->id . '/step2');
        } else {
            return redirect('/home/adverts/edit/' . $advert->id .'/step1')->withErrors([
                'Извините, редактирование объявления не произошло по неизвестным причинам, повторите попытку позже!'
            ]);
        }

    }


    public function edit_advert_st2_get(Advert $advert)
    {
        $advert = $advert->load('advert_cits');
        $cities = Cit::whereNotIn('id', [16, 17, 18])->orderBy('order', 'asc')->get();
        return view('home.edit_advert_step2', [
            'advert' => $advert,
            'cities' => $cities,
            'sn' => 'edit_advert_step2',
            'title' => 'Редактирование объявления - Шаг 2',
            'description' => 'Страница редактирования городов и цен для объявления ' . $advert->id
        ]);
    }

    public function edit_advert_st2_post(Request $request)
    {

        $advert = Advert::findOrFail($request->advert);

        $this->validate($request, [
            'advert' => 'required|integer|exists:adverts,id,user_id,' . $request->user()->id,
            'advert_cits.*' => 'required|numeric|exists:cits,id|distinct',
            'prices.*' => 'numeric|max:200000000',
            'prices_two.*' => 'numeric|max:200000000',
            'dogovor.*' => 'numeric|max:1'
        ]);

        IF ($request->has('advert_cits') && $request->has('prices') && $request->has('prices_two')) {

            $count_cits = count($request->advert_cits);
            $count_prices = count($request->prices);
            $count_prices_two = count($request->prices_two);

            IF (($count_cits == $count_prices) && ($count_cits == $count_prices_two)) {
                foreach ($request->advert_cits as $key => $advc):

                    IF (!$advc) {
                        break;
                    }

                    IF ($request->has('dogovor')) {
                        IF (isset($request->dogovor[$key])) {
                            $advert->advert_cits()->create([
                                'cit_id' => $advc,
                                'price' => 0,
                                'price_two' => 0,
                                'dogovor' => 1,
                            ]);
                        } ELSEIF ($request->prices[$key] || $request->prices_two[$key]) {
                            $price1 = ($request->prices[$key]) ? $request->prices[$key] : 0;
                            $price2 = ($request->prices_two[$key]) ? $request->prices_two[$key] : 20000000;
                            $advert->advert_cits()->create([
                                'cit_id' => $advc,
                                'price' => $price1,
                                'price_two' => $price2,
                                'dogovor' => 0,
                            ]);
                        }
                    } ELSEIF ($request->prices[$key] || $request->prices_two[$key]) {
                        $price1 = ($request->prices[$key]) ? $request->prices[$key] : 0;
                        $price2 = ($request->prices_two[$key]) ? $request->prices_two[$key] : 0;
                        $advert->advert_cits()->create([
                            'cit_id' => $advc,
                            'price' => $price1,
                            'price_two' => $price2,
                            'dogovor' => 0,
                        ]);
                    }
                endforeach;
            } else {
                return redirect('/home/adverts/edit/' . $advert->id .'/step2')->withErrors([
                    'Добавление города с ценами не выполнено! Причина: несовпадение массивов данных.'
                ]);
            }
        } else {
            return redirect('/home/adverts/edit/' . $advert->id .'/step2')->withErrors([
                'Добавление города с ценами не выполнено! Причина: одно или несколько значений не существует в переданных данных.'
            ]);
        }

        return redirect('/home/adverts/edit/' . $advert->id . '/step3');
    }

    public function edit_advert_st3_get(Advert $advert)
    {
        $adv_cits = Advert_cit::where('advert_id', $advert->id)->get();
        if(!count($adv_cits))
        {
            return redirect('/home/adverts/edit/' . $advert->id .'/step2')->withErrors([
                'У Вас нет ни одного добавленного города, укажите хотябы один город, где Вы готовы предоставить свои услуги!'
            ]);
        }
        $advert = $advert->load('musics', 'photos', 'videos');
        return view('home.edit_advert_step3', [
            'advert' => $advert,
            'sn' => 'add_advert_step3',
            'title' => 'Редактирование медиа - Шаг 3',
            'description' => 'Страница редактирование медиа контента объявления ' . $advert->id
        ]);
    }

    public function save_advert_photo(Request $request)
    {
        $this->validate($request,[
            'advert_id' => 'required|exists:adverts,id,user_id,'.$request->user()->id,
            'img' => 'required|mimes:jpeg,bmp,png,jpg|file'
        ]);

        $advert = Advert::findOrFail($request->advert_id);
        $photo = $request->img;
        IF ($request->hasFile('img')) {
            $check = (Photo::where('advert_id', $advert->id)->where('main', 1)->count()) ? true : false;
            $directory = 'upload/begests/' . $advert->id;
            $extension = $photo->guessExtension();
            IF ($photo->isValid()) {
                IF ($photo->getClientSize() <= 25 * 1024 * 1024) {
                    $name = str_random(10) . $advert->id;
                    $photo->move($directory . '/photos/', $name . '.' . $extension);
                    if ($check) {
                        $saved_file = Photo::create([
                            'name' => $name,
                            'path' => $directory . '/photos/' . $name . '.' . $extension,
                            'ext' => $extension,
                            'advert_id' => $advert->id,
                            'main' => 0,
                        ]);
                    } else {
                        $saved_file = Photo::create([
                            'name' => $name,
                            'path' => $directory . '/photos/' . $name . '.' . $extension,
                            'ext' => $extension,
                            'advert_id' => $advert->id,
                            'main' => 1,
                        ]);
                        $image = Image::make($saved_file->path);
                        $image->fit(290)->save('upload/begests/thumbs/' . $name . '.' . $extension);
                    }
                }else
                {
                    return json_encode(array(
                        'result' => 'false',
                        'error' => 'photo size more 25mb'
                    ));
                }
            }
            else
            {
                return json_encode(array(
                    'result' => 'false',
                    'error' => 'no valid file'
                ));
            }
        }else
        {
            return json_encode(array(
                'result' => 'false',
                'error' => 'No has file'
            ));
        }

        return json_encode(array(
            'result' => 'true',
            'photo_id' => $saved_file->id,
            'main' => $saved_file->main
        ));
    }

    public function setmain_advert_photo(Request $request)
    {
        $this->validate($request, [
            'advert_id' => 'required|exists:adverts,id,user_id,' . $request->user()->id,
            'photo_id' => 'required|exists:photos,id'
        ]);
        $photo = Photo::findOrFail($request->photo_id);
        $photo_id = $photo->id;
        if($photo->advert_id == $request->advert_id)
        {
            if($photo->main) return 'photo_is_main';
            $all_photos = Photo::where('advert_id', $photo->advert_id)->where('main', 1)->get();
            If(count($all_photos))
            {
                foreach($all_photos as $phot):
                    Storage::disk('public_my')->delete('upload/begests/thumbs/' .$phot->name. '.' .$phot->ext);
                    $phot->main = 0;
                    $phot->save();
                endforeach;
            }
            $photo->main = 1;
            $photo->save();
            $image = Image::make($photo->path);
            $image->fit(290)->save('upload/begests/thumbs/' .$photo->name. '.' .$photo->ext);
            return 'good';
        }
        else{
            return 'photo_is_not_for_you';
        }
    }

    public function delete_advert_photo(Request $request)
    {
        $this->validate($request, [
            'advert_id' => 'required|exists:adverts,id,user_id,' . $request->user()->id,
            'photo_id' => 'required|exists:photos,id'
        ]);

        $photo = Photo::findOrFail($request->photo_id);
        $photo_id = $photo->id;
        if($photo->advert_id == $request->advert_id)
        {
            if($photo->main)
            {
                Storage::disk('public_my')->delete('upload/begests/thumbs/' .$photo->name. '.' .$photo->ext);
                Storage::disk('public_my')->delete($photo->path);
                $advert_id = $photo->advert_id;
                $photo->delete();
                $next_file = Photo::where('advert_id', $advert_id)->first();
                if($next_file)
                {
                    $next_file->main = 1;
                    $next_file->save();
                    $image = Image::make($next_file->path);
                    $image->fit(290)->save('upload/begests/thumbs/' .$next_file->name. '.' .$next_file->ext);
                }
            }
            else{
                Storage::disk('public_my')->delete($photo->path);
                $photo->delete();
            }
        }
        return $photo_id;
    }

    public function delete_advert(Advert $advert)
    {
        $advert->delete();
        return redirect()->back();
    }


}
