<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

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
        //

        $this->app->singleton('congraph.commands.congraphInit', function ($app) {
            return $app['App\Console\Commands\CongraphInit'];
        });

        $this->commands('congraph.commands.congraphInit');


        if(Config::get('cb.eav.using_elastic')) {
            $this->app->singleton('congraph.commands.initEntities', function ($app) {
                return $app['App\Console\Commands\InitEntities'];
            });

            $this->commands('congraph.commands.initEntities');
        }
        

    }
}
