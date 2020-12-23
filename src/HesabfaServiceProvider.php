<?php

namespace Amirbagh75\HesabfaClient;

use Illuminate\Support\ServiceProvider;

class HesabfaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Configs/hesabfa.php', 'hesabfa');
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/Configs/hesabfa.php' => config_path('hesabfa.php'),
            ], 'config');
        }
        $this->app->bind('hesabfaclient', function ($app) {
            return new HesabfaClient(config('hesabfa.id'), config('hesabfa.password'), config('hesabfa.key'), config('hesabfa.timeout'));
        });
    }

    public function boot()
    {
        //
    }
}
