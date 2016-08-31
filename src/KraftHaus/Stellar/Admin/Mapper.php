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

use KraftHaus\Stellar\Admin\Exceptions\InvalidWidgetException;

class Mapper
{

    /**
     * The mapper's parent instance.
     * @var Mapper
     */
    protected $parent;

    /**
     * The mapper's children.
     * @var \Illuminate\Support\Collection
     */
    public $children;

    /**
     * The mapper's properties.
     * @var \Illuminate\Support\Collection
     */
    protected $props;

    /**
     * @param  array  $arguments
     */
    public function __construct(array $arguments = [])
    {
        $this->children = collect();
        $this->props = collect();

        foreach ($arguments as $key => $value) {
            $this->{'set' . studly_case($key)}($value);
        }
    }

    /**
     * @param  string  $type
     * @param  array   $arguments
     *
     * @return $this
     */
    public function add($type, array $arguments = [])
    {
        $widget = $this->make($type, $arguments);

        $widget->setParent($this);

        $this->addChild($widget);

        return $this;
    }

    /**
     * Make a new widget instance.
     *
     * @param  string  $type
     * @param  array   $arguments
     *
     * @return mixed
     */
    public function make($type, array $arguments = [])
    {
        $widget = config('stellar.admin-widgets.' . $type);

        if (!$widget) {
            throw new InvalidWidgetException($type);
        }

        return new $widget($arguments);
    }

    /**
     * Set the parent instance.
     *
     * @param  Mapper  $parent
     *
     * @return $this
     */
    public function setParent(Mapper $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Add a child instance.
     *
     * @param  Mapper  $child
     *
     * @return $this
     */
    public function addChild(Mapper $child)
    {
        $child->setParent($child);

        $this->children->push($child);

        return $this;
    }

    /**
     * Set an array of child instances.
     *
     * @param  array  $children
     */
    public function setChildren(array $children)
    {
        $this->children = collect($children);
    }

    public function setProps(array $props)
    {
        foreach ($props as $key => $value) {
            $this->setProp($key, $value);
        }

        return $this;
    }

    public function setProp($property, $value)
    {
        $this->props->put($property, $value);

        return $this;
    }

    public function getProp($property, $default = null)
    {
        return $this->props->get($property, $default);
    }
}