<?php

namespace KraftHaus\Stellar\Providers;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{

    protected function addMiddleware($middleware)
    {
        $kernel = $this->app[Kernel::class];

        if (is_array($middleware)) {
            foreach ($middleware as $ware) {
                $kernel->pushMiddleware($ware);
            }
        } else {
            $kernel->pushMiddleware($middleware);
        }
    }
}
