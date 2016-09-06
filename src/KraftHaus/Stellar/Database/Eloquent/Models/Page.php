<?php

namespace KraftHaus\Stellar\Database\Eloquent\Models;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use KraftHaus\Stellar\Database\Eloquent\Traits\Activatable;

class Page extends Model
{

    use Activatable;

    /**
     * Scope the query by a certain slug.
     *
     * @param  Builder  $query
     * @param  string   $slug
     */
    public function scopeBySlug($query, $slug)
    {
        $query->where('slug', $slug);
    }
}