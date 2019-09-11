<?php

namespace App\Providers;

use App\Channel as AppChannel;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \view()->composer('*', function ($view) {
            $channels = \Cache::rememberForever('channels', function () {
                return AppChannel::all();
            });

            $view->with('channels',$channels);
        });
        


        // \View::share('channels', \App\Channel::all());
    }
}
