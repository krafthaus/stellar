<?php

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::resource('modules', 'ModulesController');

Route::get('modules/{module}/enable', 'ModulesController@enable')->name('backend.modules.enable');
Route::get('modules/{module}/disable', 'ModulesController@disable')->name('backend.modules.disable');