<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\PalikaProfile;

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
        // Share palika profile data with all views
        View::composer('*', function ($view) {
            $palikaProfile = PalikaProfile::first();
            $view->with('palikaProfile', $palikaProfile);
        });
    }
}
