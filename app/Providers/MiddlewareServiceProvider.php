<?php

namespace App\Providers;

use Mellivora\Application\App;
use Mellivora\Support\ServiceProvider;

class MiddlewareServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->add(\App\Middlewares\TestMiddleware::class);
    }
}
