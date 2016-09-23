<?php

namespace KraftHaus\Stellar\Admin;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Factory
{

    public function make($entity, $action = null)
    {
        if (is_null($action)) {
            list($entity, $action) = explode('@', $entity);
        }

        return new $entity($action);
    }
}
