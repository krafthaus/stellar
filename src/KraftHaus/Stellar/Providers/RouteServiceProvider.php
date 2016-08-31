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

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * The controller namespace of the module.
     * @var string
     */
    protected $namespace = 'KraftHaus\Stellar\Http\Controllers';

    public function map(Router $router)
    {
        $resourcePath = __DIR__ . '/../../..';

        $router->backend(function () use ($resourcePath) {
            require $resourcePath . '/routes/guarded.php';
        }, ['namespace' => $this->namespace]);

        $prefix = config('stellar.backend-uri');

        $router->group([
            'middleware' => ['web'],
            'namespace'  => $this->namespace,
            'prefix'     => $prefix
        ], function () use ($resourcePath) {
            require $resourcePath . '/routes/guest.php';
        });
    }
}