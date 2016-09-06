<?php

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::get('{page}', [
    'as' => 'stellar.pages.show',
    'uses' => 'FrontendController@index',
])->where('page', '^([a-zA-Z0-9\/_\-\.]*)$');
