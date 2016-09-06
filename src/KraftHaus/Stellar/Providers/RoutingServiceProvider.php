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

use KraftHaus\Stellar\Routing\Router;
use KraftHaus\Stellar\Routing\Frontend;

class RoutingServiceProvider extends \Illuminate\Routing\RoutingServiceProvider
{

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('router', Router::class);
        $this->app->singleton('router.frontend', Frontend::class);

        $this->registerMiddlewares(config('stellar.backend-middleware'));
    }

    /**
     * Register the middlewares.
     *
     * @param  array  $middlewares
     */
    protected function registerMiddlewares(array $middlewares)
    {
        $router = $this->app['router'];

        foreach ($middlewares as $name => $class) {
            $router->middleware($name, $class);
        }
    }
}