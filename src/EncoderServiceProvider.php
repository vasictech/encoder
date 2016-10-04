<?php

namespace Vasictech\Encoder;

use Illuminate\Support\ServiceProvider;

class EncoderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';

        $this->publishes([__DIR__.'/../config/encoder.php' => config_path('encoder.php')], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
