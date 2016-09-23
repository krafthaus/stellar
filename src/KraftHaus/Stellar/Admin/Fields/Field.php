<?php

namespace KraftHaus\Stellar\Admin\Fields;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\Collection;
use KraftHaus\Stellar\Admin\Mappers\Mapper;

abstract class Field
{

    /**
     * Holds the view path.
     * @var null|string
     */
    protected $view = null;

    /**
     * @var Mapper
     */
    protected $mapper;

    /**
     * @var Collection
     */
    public $properties;

    /**
     * Default field properties.
     * @var array
     */
    protected $defaults = [];

    /**
     * @param  Mapper  $mapper
     * @param  array   $properties
     */
    public function __construct(Mapper $mapper, array $properties = [])
    {
        $this->mapper = $mapper;
        $this->properties = collect();

        foreach ($properties as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * Overload the clone method to fix cloning fields from a builder instance.
     */
    public function __clone()
    {
        $this->properties = clone $this->properties;
    }

    public function __get($property)
    {
        return $this->get($property);
    }

    /**
     * `Magic` property setter method. This function automatically
     * tries to call the corresponding property setter method.
     *
     * @param  string  $property
     * @param  mixed   $value
     */
    public function __set($property, $value)
    {
        $this->set($property, $value);
    }

    /**
     * Determine if a property is set on this field.
     *
     * @param  string  $property
     *
     * @return bool
     */
    public function __isset($property)
    {
        return $this->properties->has($property);
    }

    /**
     * Field property getter method. This function automatically
     * tries to call the corresponding property getter method.
     *
     * @param  string  $property
     *
     * @return mixed
     */
    public function get($property)
    {
        if (method_exists($this, $method = 'get' . studly_case($property))) {
            return $this->$method($this);
        }

        return $this->properties->get($property);
    }

    public function set($property, $value)
    {
        if (method_exists($this, $method = 'set' . studly_case($property))) {
            $value = $this->$method($value, $this);
        }

        $this->properties->put($property, $value);

        return $this;
    }

    /**
     * Render the field.
     */
    public function render()
    {
        // Check for the render property, If it exists on this field instance
        // we'll try to use the callback as the render function.
        if (isset($this->render)) {
            return $this->properties['render']($this);
        }

        return theme($this->view)->with([
            'field' => $this,
            'attributes' => $this->getRenderedAttributes()
        ])->render();
    }

    /**
     * Get the label of the field.
     *
     * @return string
     */
    public function getLabel()
    {
        return isset($this->properties['label'])
            ? $this->properties['label']
            : $this->properties['name'];
    }

    /**
     * Get the field attributes.
     *
     * @return array|mixed
     */
    public function getAttributes()
    {
        $attrs = $this->attrs;

        if ($attrs) {
            return $attrs + $this->defaults;
        }

        return $this->defaults;
    }

    /**
     * Render the field attributes.
     *
     * @return string
     */
    public function getRenderedAttributes()
    {
        $attributes = $this->getAttributes();

        return implode(' ', array_map(function ($key, $value) {
            return "{$value}=\"{$key}\"";
        }, $attributes, array_keys($attributes)));
    }
}
