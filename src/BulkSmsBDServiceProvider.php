<?php

namespace Bigraja\BulkSmsBD;

use Bigraja\BulkSmsBD\BulkSmsBDService;
use Illuminate\Support\ServiceProvider;

class BulkSmsBDServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Binding the main BulkBDSms class to the service container
        $this->app->singleton('bulksmsbd', function () {
            return new BulkSmsBDService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // You can load routes, views, migrations, etc. here if needed.
        // $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'bulksmsbd');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Publish config (optional if you add a config file)
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/bulksmsbd.php' => config_path('bulksmsbd.php'),
            ], 'bulksmsbd-config');
            
        }
        
    }
}
