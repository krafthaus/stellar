<?php

namespace KraftHaus\Stellar\Studio;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\Collection;

class Registrar
{

    /**
     * @var array
     */
    protected $types;

    public function __construct()
    {
        $this->types = [
            'field' => collect(),
            'widget' => collect()
        ];
    }

    public function __call($method, $arguments = [])
    {
        if (! in_array($method, ['field', 'widget'])) {
            throw new \BadMethodCallException;
        }

        $name = $arguments[0];
        $namespace = isset($arguments[1]) ? $arguments[1] : null;

        if (! is_array($name)) {
            return $this->register($method, $name, $namespace);
        }

        foreach ($name as $key => $namespace) {
            $this->register($method, $key, $namespace);
        }
    }

    /**
     * Register a new set of widgets or fields.
     *
     * @param  string  $type
     * @param  string  $name
     * @param  string  $namespace
     *
     * @return $this
     */
    public function register($type, $name, $namespace)
    {
        $this->types[$type]->put($name, $namespace);

        return $this;
    }

    /**
     * Get all registered elements from a certain group.
     *
     * @param  string  $type
     *
     * @return Collection
     */
    public function all($type)
    {
        return $this->types[$type];
    }

    public function get($type, $name, $default = null)
    {
        return $this->all($type)->get($name, $default);
    }
}
