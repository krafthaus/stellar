<?php

namespace KraftHaus\Stellar\Support;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

abstract class License
{

    /**
     * Try to validate the license.
     *
     * @param  string|null  $key
     *
     * @return bool
     */
    public static function validate($key = null)
    {
        if (! $key) {
            $key = env('STELLAR_KEY');
        }

        // If the key is still not provided, then there's no way for
        // us to validate the package so it instantly invalid
        if (! $key) {
            return false;
        }

        return $key == 'demo';
    }

    /**
     * Append the license key to the .env file.
     *
     * @param  string  $key
     *
     * @return bool
     */
    public static function write($key)
    {
        $path = base_path('.env');

        return app('files')->append($path, sprintf("\nSTELLAR_KEY=%s", $key));
    }
}
