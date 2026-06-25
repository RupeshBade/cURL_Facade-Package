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
}
