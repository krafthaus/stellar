<?php

namespace KraftHaus\Stellar\Resources\Assets;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Node
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var array
     */
    public $children = [];

    /**
     * @var array
     */
    public $parents = [];

    /**
     * @param  string  $name
     */
    public function __construct($name = '')
    {
        $this->name = $name;
    }
}
