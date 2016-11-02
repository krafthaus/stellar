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
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use KraftHaus\Stellar\Database\Eloquent\Traits\Activatable;

class Website extends Model
{

    use Activatable;

    /**
     * Mass-assignment protection.
     * @var array
     */
    protected $fillable = [
        'name', 'domain',
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return HasMany
     */
    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }

    /**
     * @param  Builder  $query
     * @param  string   $domain
     */
    public function scopeByDomain($query, $domain)
    {
        $query->where('domain', $domain);
    }

    /**
     * Sort the query based on the domain length (shorty's first y'all).
     *
     * @param  Builder  $query
     */
    public function scopeSorted($query)
    {
        $query->orderByRaw('LENGTH(`domain`) DESC');
    }
}
