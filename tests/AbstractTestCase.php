<?php

namespace KraftHaus\Stellar\Tests;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use KraftHaus\Stellar\StellarServiceProvider;
use GrahamCampbell\TestBench\AbstractPackageTestCase;

abstract class AbstractTestCase extends AbstractPackageTestCase
{

    /**
     * Override the base path.
     *
     * @return string
     */
    protected function getBasePath()
    {
        return __DIR__;
    }

    /**
     * Set the service provider.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return StellarServiceProvider::class;
    }
}