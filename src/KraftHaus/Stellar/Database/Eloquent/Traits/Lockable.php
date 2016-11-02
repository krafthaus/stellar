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

use KraftHaus\Stellar\Database\Eloquent\Models\Lock;
use KraftHaus\Stellar\Database\Eloquent\Models\User;

trait Lockable
{

    /**
     * Lock this resource.
     */
    public function lock()
    {
        Lock::create($this->getLockableParameters());
    }

    /**
     * Unlock this resource.
     *
     * @return bool|void
     */
    public function unlock()
    {
        if (! $this->isUnlockable()) {
            return false;
        }

        $this->getLockableResource()->delete();
    }

    /**
     * Is this resource locked?
     *
     * @return bool
     */
    public function isLocked()
    {
        return (bool) $this->getLockableResource();
    }

    /**
     * Can this resource be unlocked?
     *
     * @return bool
     */
    public function isUnlockable()
    {
        $resource = $this->getLockableResource();

        return ($resource->lock === Lock::EVERYONE
            || ($resource->lock === Lock::ONLY_ME
                && $this->lockedBy()->getKey() === auth()->user()->getKey()));
    }

    /**
     * Return the user who locked this resource.
     *
     * @return User
     */
    public function lockedBy()
    {
        return $this->getLockableResource()->user();
    }

    /**
     * Get the locked resource.
     *
     * @return Lock
     */
    protected function getLockableResource()
    {
        return Lock::where($this->getLockableResource())->first();
    }

    /**
     * Get the lockable parameters.
     * 
     * @return array
     */
    protected function getLockableParameters()
    {
        return [
            'resource_key' => $this->getKey(),
            'resource_type' => get_class($this)
        ];
    }
}