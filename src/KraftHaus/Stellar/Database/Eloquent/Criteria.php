<?php

namespace KraftHaus\Stellar\Database\Eloquent;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Eloquent\Model;
use KraftHaus\Stellar\Contracts\RepositoryInterface;

abstract class Criteria
{

    /**
     * @param  Model                $model
     * @param  RepositoryInterface  $repositry
     *
     * @return mixed
     */
    abstract public function apply($model, RepositoryInterface $repositry);
}
