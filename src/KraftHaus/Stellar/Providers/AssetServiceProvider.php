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
use KraftHaus\Stellar\Resources\Assets\Asset;
use KraftHaus\Stellar\Support\Facades\Asset as Facade;

class AssetServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('asset', function ($app) {
            return new Asset($app['view']);
        });

        $this->registerStdAssets();
    }

    /**
     * Register the standard assets.
     */
    protected function registerStdAssets()
    {
        Facade::make('backend.css');
        Facade::make('backend.js');

        Facade::get('backend.css')
            ->add('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.3/css/bootstrap.min.css')
            ->add(asset('css/stellar.css'));

        Facade::get('backend.js')
            ->add('//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js')
            ->add(asset('js/stellar.js'));
    }
}