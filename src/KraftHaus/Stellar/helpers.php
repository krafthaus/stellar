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
use KraftHaus\Stellar\Support\Facades\Asset;

if (!function_exists('css_assets')) {

    /**
     * @param  string  $namespace
     *
     * @return \Illuminate\Support\HtmlString
     */
    function css_assets($namespace)
    {
        $namespace = Asset::get($namespace);

        if ($namespace) {
            return new HtmlString($namespace->css());
        }

        return null;
    }
}

if (!function_exists('js_assets')) {

    /**
     * @param  string  $namespace
     *
     * @return \Illuminate\Support\HtmlString
     */
    function js_assets($namespace)
    {
        $namespace = Asset::get($namespace);

        if ($namespace) {
            return new HtmlString($namespace->js());
        }

        return null;
    }
}