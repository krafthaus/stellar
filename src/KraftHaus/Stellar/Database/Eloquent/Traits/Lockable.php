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

trait Lockable
{

    /**
     * @var array
     */
    protected $lockableOptions = [
        'me', 'everyone'
    ];

    public function lock($unlockableBy)
    {
        if (! in_array($unlockableBy, $this->lockableOptions)) {
            throw new \InvalidArgumentException('Invalid lock strategy, try `me` or `everyone`.');
        }

        $this->lock_strategy = $unlockableBy;
        $this->locked_by = auth()->user()->getKey();

        return $this->save();
    }

    public function unlock()
    {
        if (! $this->isUnlockable()) {

        }
    }

    public function isUnlockable()
    {
        if ($this->lock_strategy == 'everyone') {

        }
    }
}