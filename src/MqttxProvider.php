<?php

namespace Jzzoo\Laravel\Mqttx;

use Illuminate\Support\ServiceProvider;

class MqttxProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/mqttx.php' => config_path('mqttx.php'),
        ]);
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('demo123', function ($app) {
            return new Mqttx();
        });
    }
}