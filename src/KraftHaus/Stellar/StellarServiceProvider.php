<?php

namespace KraftHaus\Stellar;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use KraftHaus\Stellar\Admin\Factory;
use KraftHaus\Stellar\Support\Context;
use KraftHaus\Stellar\Routing\Frontend;
use Illuminate\Support\ServiceProvider;
use KraftHaus\Stellar\Providers\RouteServiceProvider;
use KraftHaus\Stellar\Providers\AssetServiceProvider;
use KraftHaus\Stellar\Providers\PolicyServiceProvider;
use KraftHaus\Stellar\Providers\ModuleServiceProvider;
use KraftHaus\Stellar\Providers\RoutingServiceProvider;
use KraftHaus\Stellar\Providers\ConsoleServiceProvider;

class StellarServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/stellar.php' => config_path('stellar.php')
        ], 'config');

        $this->publishes([
            __DIR__ . '/../../database/migrations' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/stellar')
        ], 'views');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'stellar');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/stellar.php', 'stellar');

        $this->registerProviders();
        $this->registerAliases();

        // Include the helpers file.
        require __DIR__ . '/helpers.php';
    }

    /**
     * Register the required Stellar service providers.
     */
    protected function registerProviders()
    {
        $this->app->register(RoutingServiceProvider::class);
        $this->app->register(ConsoleServiceProvider::class);
        $this->app->register(PolicyServiceProvider::class);
        $this->app->register(ModuleServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AssetServiceProvider::class);
    }

    /**
     * Register the aliases.
     */
    protected function registerAliases()
    {
        $this->app->singleton('admin', Factory::class);
        $this->app->singleton('context', Context::class);
        $this->app->singleton('frontend', Frontend::class);
    }
}