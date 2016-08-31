<?php

namespace KraftHaus\Stellar\Http\Controllers\Users;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use App\Http\Controllers\Controller;
use KraftHaus\Stellar\Support\Facades\Admin;
use KraftHaus\Stellar\Entities\Users\IndexEntity;

class IndexController extends Controller
{

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Admin::make(IndexEntity::class, 'index')->render();
    }
}