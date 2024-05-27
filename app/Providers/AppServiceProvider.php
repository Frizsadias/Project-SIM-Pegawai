<?php

namespace App\Providers;

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
        date_default_timezone_set('Asia/Jakarta');
        config(['app.locale' => 'id']);
        \Carbon\Carbon::setLocale('id');
        if (env('APP_ENV') != 'local') {
            $this->app['request']->server->set('HTTPS', true); 
        } else {
            $this->app['request']->server->set('HTTPS', false);  
        } 
    }
}
