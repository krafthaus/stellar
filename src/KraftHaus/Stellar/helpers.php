<?php

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\HtmlString;
use KraftHaus\Stellar\Support\Context;
use KraftHaus\Stellar\Support\Facades\Asset;
use KraftHaus\Stellar\Support\Facades\Theme;

if (! function_exists('context')) {

    /**
     * @return Context
     */
    function context()
    {
        return app('context');
    }
}

if (! function_exists('css_assets')) {

    /**
     * @param  string  $namespace
     *
     * @return HtmlString
     */
    function css_assets($namespace)
    {
        $namespace = Asset::get($namespace);

        if ($namespace) {
            return new HtmlString($namespace->css());
        }
    }
}

if (! function_exists('js_assets')) {

    /**
     * @param  string  $namespace
     *
     * @return HtmlString
     */
    function js_assets($namespace)
    {
        $namespace = Asset::get($namespace);

        if ($namespace) {
            return new HtmlString($namespace->js());
        }
    }
}

if (! function_exists('theme')) {

    /**
     * @param  string  $path
     *
     * @return mixed
     */
    function theme($path = null)
    {
        if ($path) {
            return Theme::view($path);
        }

        return app('theme');
    }
}

if (! function_exists('theme_asset')) {

    /**
     * @param  string  $path
     *
     * @return mixed
     */
    function theme_asset($path)
    {
        return Theme::asset($path);
    }
}