<?php

namespace App\Http\Controllers;

use App\Advert_categor;
use Illuminate\Http\Request;
use App\Cit;
use App\Advert;
use App\Photo;
use App\Combo;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

use App\Http\Requests;

class SiteMapController extends Controller
{
    public function index()
    {
        // create new sitemap object
        $sitemap = App::make("sitemap");

        // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
        // by default cache is disabled
        $sitemap->setCache('laravel.sitemap', 60);

        // check if there is cached sitemap and build new only if is not
        if (!$sitemap->isCached()) {
            // add item to the sitemap (url, date, priority, freq)
            $sitemap->add(secure_url('/'), '2017-04-25T20:10:00+02:00', '1.0', 'daily');
            $sitemap->add(secure_url('/bakyt'), '2017-04-26T12:30:00+02:00', '0.5', 'monthly');
            $sitemap->add(secure_url('/services'), '2017-04-26T12:30:00+02:00', '0.8', 'monthly');

            //$sitemap->add(URL::to('post-with-images'), '2015-06-24T14:30:00+02:00', '0.9', 'monthly', $images);

            $adverts = Advert::with('photos','videos')->orderBy('updated_at', 'desc')->get();
            foreach ($adverts as $advert):
                // get all images for the current post
                $images = array();
                foreach ($advert->photos as $image) {
                    $images[] = array(
                        'url' => 'https://svadba.kz/'.$image->path,
                        'title' => 'Фото '.$image->id.' объявления '.$advert->id,
                        'caption' => 'Фото обхявления'
                    );
                }
                // get all videos for the current post
                $videos = array();
                foreach ($advert->videos as $video) {
                    $videos[] = array(
                        'url' => 'https://svadba.kz/'.$video->path,
                        'title' => 'Видео '.$video->id.' объявления '.$advert->id,
                        'caption' => 'Видео обхявления'
                    );
                }
                $sitemap->add(secure_url('/advert/'.$advert->id), $advert->updated_at, '0.8', 'monthly', $images);
            endforeach;

            $cities = Cit::all();
            foreach ($cities as $cit):
                $sitemap->add(secure_url('/cities/'.$cit->name), $cit->updated_at, '0.9', 'monthly');
            endforeach;

            foreach ($cities as $cit):
                $sitemap->add(secure_url('/city/by_id?city='.$cit->id), $cit->updated_at, '0.9', 'monthly');
            endforeach;

            $combos = Combo::orderBy('created_at', 'desc')->with('combo_cits')->get();
            foreach($combos as $combo):
                foreach($combo->combo_cits as $combo_cit):
                    $sitemap->add(secure_url('/combo/'.$combo->id.'/'.$combo_cit->id), $combo_cit->crated_at, '0.9', 'monthly');
                endforeach;
            endforeach;

            $categories = Advert_categor::all();
            foreach($categories as $categor):
                $sitemap->add(secure_url('/services/filter?category='.$categor->id), $categor->crated_at, '0.9', 'monthly');
            endforeach;

            foreach($cities as $city):
                $sitemap->add(secure_url('/services/filter?city='.$city->id), $city->crated_at, '0.9', 'monthly');
                foreach($categories as $categor):
                    $sitemap->add(secure_url('/services/filter?city='.$city->id.'&amp;category='.$categor->id), $categor->crated_at, '0.9', 'monthly');
                endforeach;
            endforeach;

        }

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        $sitemap->store('xml', 'sitemap');

        return redirect('/');
    }
}
