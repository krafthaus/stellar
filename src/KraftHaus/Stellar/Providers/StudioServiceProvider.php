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
use KraftHaus\Stellar\Studio\Registrar;
use KraftHaus\Stellar\Support\Facades\Studio;

class StudioServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('studio', Registrar::class);

        $this->registerWidgets();
        $this->registerFields();
    }

    /**
     * Register the available studio widgets.
     */
    protected function registerWidgets()
    {
        Studio::field($this->app['config']->get('stellar.studio-widgets'));
    }

    /**
     * Register the available studio fields.
     */
    protected function registerFields()
    {
        Studio::field($this->app['config']->get('stellar.studio-fields'));
    }
}
