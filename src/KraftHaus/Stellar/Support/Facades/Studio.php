<?php

namespace KraftHaus\Stellar\Support\Facades;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\Facades\Facade;

class Studio extends Facade
{

    /**
     * Get the registered name of the facade.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'studio';
    }
}
