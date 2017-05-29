<?php

namespace App\Providers;

use App\Services\YoutubeService;
use Illuminate\Support\ServiceProvider;

class YoutubeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(YoutubeService::class, function ($app) {
            //для версии 5.1 и ранее:
            //$this->app->singleton('Riak\Contracts\Connection', function ($app) {
            return new YoutubeService();
        });
    }
}
