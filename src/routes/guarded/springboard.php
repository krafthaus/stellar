<?php

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::get('springboard', 'Auth\SpringboardController@index')->name('backend.springboard.index');
Route::get('springboard/create', 'Auth\SpringboardController@create')->name('backend.springboard.create');
Route::post('springboard/create', 'Auth\SpringboardController@store')->name('backend.springboard.store');
Route::get('springboard/{website}', 'Auth\SpringboardController@open')->name('backend.springboard.open');
