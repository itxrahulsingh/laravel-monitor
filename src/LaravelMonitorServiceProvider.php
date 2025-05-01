<?php

namespace Itxrahulsingh\LaravelMonitor;

use Illuminate\Support\ServiceProvider;

class LaravelMonitorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish config
        $this->publishes([
            __DIR__.'/../config/laravel-monitor.php' => config_path('laravel-monitor.php'),
        ], 'config');

        // Publish migrations
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'migrations');

        // Load routes and views
        $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-monitor');

        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Commands\TrimMonitorData::class,
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-monitor.php', 'laravel-monitor');

        // Register recorders
        collect(config('laravel-monitor.recorders'))->each(function ($config, $recorder) {
            if ($config['enabled'] ?? false) {
                $class = "\\Itxrahulsingh\\LaravelMonitor\\Recorders\\".ucfirst($recorder)."Recorder";
                if (class_exists($class)) {
                    (new $class)->register();
                }
            }
        });
    }
}
