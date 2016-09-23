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

use Prettus\Repository\Eloquent\BaseRepository;
use KraftHaus\Stellar\Database\Eloquent\Models\User;

class UserRepository extends BaseRepository
{

    /**
     * Specify the model class name.
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
}
