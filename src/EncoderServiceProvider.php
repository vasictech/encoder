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
        $this->publishConfig();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfig();

    }

    private function mergeConfig()
    {
        $path = $this->getConfigPath();
        $this->mergeConfigFrom($path, 'encoder');
    }

    private function publishConfig()
    {
        $path = $this->getConfigPath();
        $this->publishes([$path => config_path('encoder.php')], 'config');
    }

    private function getConfigPath()
    {
        return __DIR__ . '/../config/encoder.php';
    }
}
