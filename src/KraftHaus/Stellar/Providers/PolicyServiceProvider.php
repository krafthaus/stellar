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

use KraftHaus\Stellar\Policies\WebsitePolicy;
use KraftHaus\Stellar\Database\Eloquent\Models\Website;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;

class PolicyServiceProvider extends AuthServiceProvider
{
    /**
     * The policy mapping.
     * @var array
     */
    protected $policies = [
        Website::class => WebsitePolicy::class,
    ];

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
