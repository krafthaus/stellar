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

use Illuminate\Support\ServiceProvider;
use KraftHaus\Stellar\Module\Registrar;

class ModulesServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->app['modules']->register();
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('modules', Registrar::class);
    }
}
