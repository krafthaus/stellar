<?php

namespace KraftHaus\Stellar\Database\Eloquent\Criteria\DataStore;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class WebsiteCriteria implements CriteriaInterface
{

    /**
     * @param  Model                $model
     * @param  RepositoryInterface  $repositry
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repositry)
    {
        if ($website = Route::current()->parameters()['website']) {
            return $model->where('website_id', $website);
        }
    }
}
