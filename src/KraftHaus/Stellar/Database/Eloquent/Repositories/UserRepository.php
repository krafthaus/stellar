<?php

namespace KraftHaus\Stellar\Database\Eloquent\Repositories;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use KraftHaus\Stellar\Database\Eloquent\Repository;
use KraftHaus\Stellar\Database\Eloquent\Models\User;

class UserRepository extends Repository
{
    /**
     * Specify the model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return User::class;
    }
}
