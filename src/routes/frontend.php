<?php

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::get('{page}', 'FrontendController@index')
    ->name('stellar.pages.show')
    ->where('page', '^([a-zA-Z0-9\/_\-\.]*)$');
