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
use KraftHaus\Stellar\Support\Facades\Frontend;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * The controller namespace of the module.
     * @var string
     */
    protected $namespace = 'KraftHaus\Stellar\Http\Controllers';

    protected $resourcePath;

    /**
     * @param  Router  $router
     */
    public function map(Router $router)
    {
        $this->resourcePath = __DIR__ . '/../../..';

        $this->mapProtectedBackendRoutes($router);

        $this->mapGuestBackendRoutes($router);

        if (Frontend::page()) {
            $this->mapFrontendRoutes($router);
        }
    }

    protected function mapProtectedBackendRoutes(Router $router)
    {
        $router->backend(function () {
            require $this->resourcePath . '/routes/guarded.php';
        }, ['namespace' => $this->namespace]);
    }

    protected function mapGuestBackendRoutes(Router $router)
    {
        $router->group([
            'middleware' => ['web'],
            'namespace' => $this->namespace,
            'prefix' => config('stellar.backend-uri'),
        ], function () {
            require $this->resourcePath . '/routes/guest.php';
        });
    }

    protected function mapFrontendRoutes(Router $router)
    {
        $router->group(['middleware' => ['web'], 'namespace' => $this->namespace], function () {
            require $this->resourcePath . '/routes/frontend.php';
        });
    }
}
