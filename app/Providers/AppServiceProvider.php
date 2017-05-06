<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contractor;
use App\Advert;
use App\Sv_count;
use App\Advert_categor;
use App\Basket_request;

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
        $count_basket = Basket_request::where('ended', 0)->count();
        $advert_categor = Advert_categor::withCount('adverts')->get();
        $sort_advert = $advert_categor->sortByDesc('adverts_count');
        $sort_advert->values()->all();
        $sv_count = Sv_count::find(1)->likes;
        //$svadba_like = $sv_count->likes;
        view()->share('count_cont', $count_contr);
        view()->share('count_adv', $count_advert);
        view()->share('sort_adverts', $sort_advert);
        view()->share('svadba_like', $sv_count);
        view()->share('count_basket', $count_basket);
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
