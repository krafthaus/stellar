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

        return view('page')->with([
            'website' => $website,
            'page' => $page
        ]);
    }
}