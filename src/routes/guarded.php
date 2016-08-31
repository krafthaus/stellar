<?php

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::get('/', function () {
    return 'to be implemented';
});

require __DIR__ . '/guarded/springboard.php';
require __DIR__ . '/guarded/users.php';