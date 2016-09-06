<?php

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Path to Modules.
    |--------------------------------------------------------------------------
    |
    | Define the path where you'd like to store your modules. Note that if you
    | choose a path that's outside of your public directory, you will need to
    | copy your module assets (CSS, images, etc.) to your public directory.
    */

    'modules-path' => env('STELLAR_MODULES_PATH', app_path('Modules')),

    /*
     |--------------------------------------------------------------------------
     | Modules Default State.
     |--------------------------------------------------------------------------
     |
     | When a previously unknown module is added, if it doesn't have an 'enabled'
     | state set then this is the value which it will default to. If this is
     | not provided then the module will default to being 'enabled.
     */

    'modules-enabled' => env('STELLAR_MODULES_ENABLED', true),

    /*
     |--------------------------------------------------------------------------
     | Module Base Namespace.
     |--------------------------------------------------------------------------
     |
     | Define the base namespace for your modules. Be sure to update this
     | value if you move your modules directory to a new path. This
     | is primarily used by the Artisan module:make command.
     */

    'modules-namespace' => env('STELLAR_MODULES_NAMESPACE', 'App\Modules\\'),

    /*
     |--------------------------------------------------------------------------
     | Backend URI
     |--------------------------------------------------------------------------
     |
     | This value determines where the "backend section" of stellar is located.
     | Beware that changing this value also changes the backend route names
     | so when using backend routes it's best to use the `s_route` and
     | `s_route_string` helper methods instead of the "native"
     | `route` and `route_string` helper methods.
     */

    'backend-uri' => env('STELLAR_BACKEND_URI', 'cp'),

    /*
     |--------------------------------------------------------------------------
     | Backend Middleware
     |--------------------------------------------------------------------------
     |
     | This is the middleware that gets executed on backend
     | routes registered through the Stellar Router.
     */

    'backend-middleware' => [

        'installed' => KraftHaus\Stellar\Http\Middleware\Installed::class,
        'springboard' => KraftHaus\Stellar\Http\Middleware\Springboard::class,
        'authenticate' => KraftHaus\Stellar\Http\Middleware\Authenticate::class,

    ],

    'admin-widgets' => [

        'form' => KraftHaus\Stellar\Admin\Widgets\FormWidget::class,
        'table' => KraftHaus\Stellar\Admin\Widgets\TableWidget::class,
        
    ]

];