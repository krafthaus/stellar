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

    'modules-namespace' => env('STELLAR_MODULES_NAMESPACE', 'App\\Modules\\'),

    /*
     |--------------------------------------------------------------------------
     | Theme path.
     |--------------------------------------------------------------------------
     |
     | TODO
     |
     */

    'theme-path' => env('STELLAR_THEME_PATH', 'resources/themes'),

    /*
     |--------------------------------------------------------------------------
     | Theme path.
     |--------------------------------------------------------------------------
     |
     | The public base path to the assets of a theme. This will look something.
     | like this /public/themes/{theme-name}/my-awesome-asset.css
     |
     */

    'theme-asset-path' => env('STELLAR_THEME_ASSET_PATH', 'themes'),

    /*
     |--------------------------------------------------------------------------
     | Currently activated theme.
     |--------------------------------------------------------------------------
     |
     | TODO
     |
     */

    'theme-active' => env('STELLAR_THEME_ACTIVE', 'stellar'),

    /*
     |--------------------------------------------------------------------------
     | The default widget.
     |--------------------------------------------------------------------------
     |
     | This is the default widget that gets included with every new page.
     |
     */

    'studio-default-widget' => KraftHaus\Stellar\Studio\Widgets\DefaultWidget::class,

    /*
     |--------------------------------------------------------------------------
     | Available studio widgets.
     |--------------------------------------------------------------------------
     |
     | TODO
     |
     */

    'studio-widgets' => [

        'default-widget' => KraftHaus\Stellar\Studio\Widgets\DefaultWidget::class,

    ],

    /*
     |--------------------------------------------------------------------------
     | Available studio fields.
     |--------------------------------------------------------------------------
     |
     | TODO
     |
     */

    'studio-fields' => [

        'text' => KraftHaus\Stellar\Studio\Fields\TextField::class,

    ],

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

    /*
     |--------------------------------------------------------------------------
     | Available admin mappers.
     |--------------------------------------------------------------------------
     |
     | TODO
     |
     */

    'admin-mappers' => [

        'form' => KraftHaus\Stellar\Admin\Mappers\FormMapper::class,
        'list' => KraftHaus\Stellar\Admin\Mappers\ListMapper::class,
        'scope' => KraftHaus\Stellar\Admin\Mappers\ScopeMapper::class,
        'filter' => KraftHaus\Stellar\Admin\Mappers\FilterMapper::class,
        'partial' => KraftHaus\Stellar\Admin\Mappers\PartialMapper::class,

    ],

    /*
     |--------------------------------------------------------------------------
     | Available admin fields.
     |--------------------------------------------------------------------------
     |
     | TODO
     |
     */

    'admin-fields' => [

        'date' => KraftHaus\Stellar\Admin\Fields\DateField::class,
        'file' => KraftHaus\Stellar\Admin\Fields\FileField::class,
        'text' => KraftHaus\Stellar\Admin\Fields\TextField::class,
        'time' => KraftHaus\Stellar\Admin\Fields\TimeField::class,
        'email' => KraftHaus\Stellar\Admin\Fields\EmailField::class,
        'image' => KraftHaus\Stellar\Admin\Fields\ImageField::class,
        'label' => KraftHaus\Stellar\Admin\Fields\LabelField::class,
        'anchor' => KraftHaus\Stellar\Admin\Fields\AnchorField::class,
        'number' => KraftHaus\Stellar\Admin\Fields\NumberField::class,
        'select' => KraftHaus\Stellar\Admin\Fields\SelectField::class,
        'boolean' => KraftHaus\Stellar\Admin\Fields\BooleanField::class,
        'password' => KraftHaus\Stellar\Admin\Fields\PasswordField::class,
        'textarea' => KraftHaus\Stellar\Admin\Fields\TextareaField::class,
        'date-time' => KraftHaus\Stellar\Admin\Fields\DateTimeField::class,

    ]

];
