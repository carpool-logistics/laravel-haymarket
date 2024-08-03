<?php

namespace CarpoolLogistics\Heymarket;

use Illuminate\Support\ServiceProvider;

class HeymarketServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(HeymarketClient::class, function ($app) {
            return new HeymarketClient(config('heymarket.api_key'));
        });

        $this->mergeConfigFrom(__DIR__ . '/config/heymarket.php', 'heymarket');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/heymarket.php' => config_path('heymarket.php'),
        ]);
    }
}
