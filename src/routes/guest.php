<?php

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
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

Route::get('sign-out', [
    'as' => 'backend.sessions.destroy',
    'uses' => 'Auth\SessionsController@destroy'
]);
