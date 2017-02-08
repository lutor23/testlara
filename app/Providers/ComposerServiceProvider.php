<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use View;

use App\Director;
use App\Team;
use App\Folder;


class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('layouts.partials.sidebar', function($view)
        {
            $view->with('directors', Director::all());
            $view->with('teams', Team::all());
            $view->with('folders', Folder::all());
        });


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
