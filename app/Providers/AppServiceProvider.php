<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contractor;
use App\Advert;
use App\Sv_count;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Share to all view count contractors and adverts
        $count_contr = Contractor::all()->count();
        $count_advert = Advert::all()->count();
        $count_video_cat = Advert::where('advert_categor_id', 6)->count();
        $count_photo_cat = Advert::where('advert_categor_id', 14)->count();
        $count_ved = Advert::where('advert_categor_id', 4)->count();
        $sv_count = Sv_count::find(1);
        $svadba_like = $sv_count->likes;
        view()->share('count_cont', $count_contr);
        view()->share('count_adv', $count_advert);
        view()->share('count_video', $count_video_cat);
        view()->share('count_photo', $count_photo_cat);
        view()->share('count_ved', $count_ved);
        view()->share('svadba_like', $svadba_like);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->singleton(\App\Services\ServiceMan::class, function ($app) {
        //для версии 5.1 и ранее:
        //$this->app->singleton('Riak\Contracts\Connection', function ($app) {
         // return new \App\Services\ServiceMan;
        //});
    }
}
