<?php

namespace KraftHaus\Stellar\Policies;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use KraftHaus\Stellar\Database\Eloquent\Models\User;
use KraftHaus\Stellar\Database\Eloquent\Models\Website;

class WebsitePolicy
{

    /**
     * Determine that the given user has access to a certain website.
     *
     * @param  User     $user
     * @param  Website  $website
     *
     * @return bool
     */
    public function access(User $user, Website $website)
    {
        return $user->websites->contains($website->getKey());
    }
}
