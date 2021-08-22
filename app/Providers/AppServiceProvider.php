<?php

namespace App\Providers;

use App\ReqResIn\ReqResInApi;
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
        $this->app->bind(ReqResInApi::class, function () {
            return new ReqResInApi(config('services.req_res_in.base_url'));
        });
    }
}
