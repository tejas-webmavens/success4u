<?php

namespace App\Providers;
use App\Page;
use App\Settings;
use Illuminate\Support\Facades\Schema;


use Illuminate\Support\Facades\View;
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
        Schema::defaultStringLength(191);
		View::share('settings', Settings::first());
        View::share('aml', Page::find(1));
        View::share('kyc', Page::find(2));
        View::share('tos', Page::find(3));
        View::share('pp', Page::find(4));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
