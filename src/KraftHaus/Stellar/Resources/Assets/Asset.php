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

use Illuminate\View\Factory;
use Illuminate\Support\Collection;

class Asset
{

    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @param  Factory  $factory
     */
    public function __construct(Factory $factory)
    {
        $this->collection = collect();

        $factory->share('asset', $this);
    }

    /**
     * @param  string         $namespace
     * @param  callable|null  $callback
     *
     * @return Group
     */
    public function make($namespace, $callback = null)
    {
        $group = new Group;

        if (is_callable($callback)) {
            call_user_func($callback, $group);
        }

        $this->collection->put($namespace, $group);

        return $group;
    }

    /**
     * @param  string  $namespace
     *
     * @return null|Group
     */
    public function get($namespace)
    {
        return $this->collection->get($namespace, null);
    }
}
