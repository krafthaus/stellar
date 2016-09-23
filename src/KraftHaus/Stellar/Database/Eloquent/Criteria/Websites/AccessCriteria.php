<?php

namespace KraftHaus\Stellar\Database\Eloquent\Criteria\Websites;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class AccessCriteria implements CriteriaInterface
{

    /**
     * @param  Model                $model
     * @param  RepositoryInterface  $repositry
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repositry)
    {
        return $model->whereIn('id', auth()->user()->websites->pluck('id'));
    }
}
