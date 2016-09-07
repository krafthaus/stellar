<?php

namespace KraftHaus\Stellar\Providers;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use KraftHaus\Stellar\Theme\Registrar;
use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('theme', function ($app) {
            return new Registrar($app['files'], $app['config'], $app['view']);
        });

        $this->app->booting(function ($app) {
            $app['theme']->register();
        });
    }
}
