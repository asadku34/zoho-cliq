<?php

namespace Asad\ZohoCliq;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as GuzzleClient;

class ZohoCliqServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'zoho-cliq');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'zoho-cliq');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('zcliq.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/zoho-cliq'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/zoho-cliq'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/zoho-cliq'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'zcliq');

        // Register the main class to use with the facade
        $this->app->singleton('zoho-cliq', function ($app) {
            return new ZohoCliq(
                $app['config']->get('zcliq.authtoken'),
                [
                    'channel' => $app['config']->get('zcliq.channel'),
                    'send_to' => $app['config']->get('zcliq.send_to'),
                ],
                new GuzzleClient()
            );
        });
    }
}
