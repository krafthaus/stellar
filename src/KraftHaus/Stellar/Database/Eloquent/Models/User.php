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

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * @property mixed websites
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use CanResetPassword;
    use Authenticatable;

    /**
     * Mass-assignment protection.
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function websites()
    {
        return $this->belongsToMany(Website::class);
    }

    public function hasWebsite($website)
    {
        if ($website instanceof Model) {
            $website = $website->getKey();
        }

        return $this->whereHas('websites', function ($query) use ($website) {
            $query->where('id', $website);
        })->count();
    }

    /**
     * Create the new super user. (there can only be one of this).
     *
     * @return Model
     */
    public static function createSuperUser()
    {
        return static::create([
            'name' => 'Super User',
            'email' => 'super@user.com',
            'password' => bcrypt('password'),
        ]);
    }
}
