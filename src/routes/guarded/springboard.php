<?php

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::get('springboard', [
    'as' => 'backend.springboard.index',
    'uses' => 'Auth\SpringboardController@index',
]);

Route::get('springboard/create', [
    'as' => 'backend.springboard.create',
    'uses' => 'Auth\SpringboardController@create',
]);

Route::post('springboard/create', [
    'as' => 'backend.springboard.store',
    'uses' => 'Auth\SpringboardController@store',
]);

Route::get('springboard/{website}', [
    'as' => 'backend.springboard.open',
    'uses' => 'Auth\SpringboardController@open',
]);
