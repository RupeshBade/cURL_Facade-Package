<?php

namespace GeniusSystem\CurlFacade;

use Illuminate\Support\ServiceProvider;
use GeniusSystem\CurlFacade\CurlService;

class CurlServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('curl-service', function () {
            return new CurlService();
        });
    }
    public function boot()
    {
        // Check if the application is running in the context of a Laravel app
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/curl-facade.php' => config_path('curl-facade.php'),
            ], 'curl-facade-config');
        }
    } 
}
