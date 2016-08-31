<?php

/**
 * This file is part of the Centagon Build/Foundation package.
 *
 * (c) Centagon <build@centagon.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::resource('sessions', 'Auth\SessionsController', [
    'only' => ['create', 'store']
]);

Route::resource('install', 'InstallController', [
    'only' => ['index', 'store']
]);