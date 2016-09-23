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

use Webpatser\Uuid\Uuid;
use Spatie\Menu\Laravel\MenuFacade;
use KraftHaus\Stellar\Admin\Factory;
use KraftHaus\Stellar\Support\Context;
use KraftHaus\Stellar\Routing\Frontend;
use Illuminate\Support\ServiceProvider;
use Spatie\Menu\Laravel\MenuServiceProvider;
use KraftHaus\Stellar\Providers\FlashServiceProvider;
use KraftHaus\Stellar\Providers\RouteServiceProvider;
use KraftHaus\Stellar\Providers\ThemeServiceProvider;
use KraftHaus\Stellar\Providers\AssetServiceProvider;
use KraftHaus\Stellar\Providers\PolicyServiceProvider;
use KraftHaus\Stellar\Providers\StudioServiceProvider;
use KraftHaus\Stellar\Providers\ModulesServiceProvider;
use KraftHaus\Stellar\Providers\RoutingServiceProvider;
use KraftHaus\Stellar\Providers\ConsoleServiceProvider;
use Prettus\Repository\Providers\RepositoryServiceProvider;

class StellarServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/stellar.php' => config_path('stellar.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/stellar')
        ], 'views');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'stellar');

        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'stellar');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/stellar.php', 'stellar');

        $this->registerProviders();
        $this->registerAliases();
        $this->registerHelpers();
    }

    /**
     * Register the required Stellar service providers.
     */
    protected function registerProviders()
    {
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(RoutingServiceProvider::class);
        $this->app->register(ConsoleServiceProvider::class);
        $this->app->register(ModulesServiceProvider::class);
        $this->app->register(StudioServiceProvider::class);
        $this->app->register(PolicyServiceProvider::class);
        $this->app->register(AssetServiceProvider::class);
        $this->app->register(FlashServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(ThemeServiceProvider::class);
        $this->app->register(MenuServiceProvider::class);
        $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
    }

    /**
     * Register the aliases.
     */
    protected function registerAliases()
    {
        $this->app->singleton('frontend', Frontend::class);
        $this->app->singleton('context', Context::class);
        $this->app->singleton('admin', Factory::class);
        $this->app->alias('Menu', MenuFacade::class);
        $this->app->alias('Uuid', Uuid::class);
    }

    /**
     * Include the helpers file.
     */
    protected function registerHelpers()
    {
        require __DIR__ . '/helpers.php';
    }
}
