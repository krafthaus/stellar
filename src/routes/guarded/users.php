<?php

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::resource('users/permissions', 'Users\PermissionsController');
Route::resource('users/roles', 'Users\RolesController');
Route::resource('users', 'Users\IndexController');
