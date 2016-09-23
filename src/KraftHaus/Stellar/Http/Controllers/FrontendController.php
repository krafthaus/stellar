<?php

namespace KraftHaus\Stellar\Http\Controllers;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use KraftHaus\Stellar\Support\Facades\Frontend;

class FrontendController
{

    public function index()
    {
        $website = Frontend::website();
        $page = Frontend::page();

        // Somehow a page is created without a root widget
        // so let's be a good samaritan and create one.
        if (! $page->hasWidgets()) {
            $page->createRootWidget();
        }

        $widgets = $page->widgets->toHierarchy();

        return theme('page')->with([
            'website' => $website,
            'page' => $page,
            'widgets' => $widgets
        ]);
    }
}
