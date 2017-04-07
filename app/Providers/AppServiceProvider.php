<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
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
