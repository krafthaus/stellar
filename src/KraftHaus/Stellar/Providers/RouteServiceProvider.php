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

use Illuminate\Support\Facades\Route;
use KraftHaus\Stellar\Support\Facades\Frontend;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * The controller namespace of the module.
     * @var string
     */
    protected $namespace = 'KraftHaus\Stellar\Http\Controllers';

    /**
     * The path to the route files.
     * @var string
     */
    protected $path;

    public function map()
    {
        $this->path = __DIR__ . '/../../../routes';

        $this->mapProtectedBackendRoutes();
        $this->mapGuestBackendRoutes();

        if (Frontend::page()) {
            $this->mapFrontendRoutes();
        }
    }

    protected function mapProtectedBackendRoutes()
    {
        Route::backend(function () {
            require $this->path . '/guarded.php';
        }, ['namespace' => $this->namespace]);
    }

    protected function mapGuestBackendRoutes()
    {
        Route::group([
            'middleware' => ['web'],
            'namespace' => $this->namespace,
            'prefix' => config('stellar.backend-uri'),
        ], function () {
            require $this->path . '/guest.php';
        });
    }

    protected function mapFrontendRoutes()
    {
        Route::group(['middleware' => ['web'], 'namespace' => $this->namespace], function () {
            require $this->path . '/frontend.php';
        });
    }
}
