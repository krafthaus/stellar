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

use KraftHaus\Stellar\Flash\Handler;
use Illuminate\Support\ServiceProvider;

class FlashServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('flash', function ($app) {
            return $app->make(Handler::class);
        });
    }
}
