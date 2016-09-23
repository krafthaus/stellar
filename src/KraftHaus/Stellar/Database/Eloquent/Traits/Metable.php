<?php

namespace KraftHaus\Stellar\Database\Eloquent\Traits;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\Collection;
use KraftHaus\Stellar\Database\Eloquent\Models\Meta;

trait Metable
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function meta()
    {
        return $this->morphMany(Meta::class, 'metable');
    }

    /**
     * @return Collection
     */
    public function allMeta()
    {
        return $this->meta()->select([
            'key', 'value'
        ])->pluck('value', 'key');
    }

    public function getMeta($key, $default = null, $object = false)
    {

    }
}