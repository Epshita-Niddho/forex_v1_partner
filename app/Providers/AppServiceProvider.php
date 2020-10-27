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

   //General Inf0

    view()->composer('*', function ($view) {
     
   $general_info=\DB::table('general_information')->first();
   $view->general_info = $general_info;
   });

   // for english language only
   view()->composer(['backEnd.auth.*','backEnd.dashboard.layout','backEnd.crm.mail.*'], function ($view) {

    $general_info_others=\DB::table('general_information')->first();
    $view->general_info_others = $general_info_others;

});

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
