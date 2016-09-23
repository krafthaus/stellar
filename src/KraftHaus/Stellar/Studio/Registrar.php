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

    /**
     * Register a new field.
     *
     * @param  array|string  $name
     * @param  null|string   $namespace
     *
     * @return $this|Registrar
     */
    public function field($name, $namespace = null)
    {
        if (is_array($name)) {
            foreach ($name as $key => $namespace) {
                $this->register('field', $key, $namespace);
            }

            return $this;
        }

        return $this->register('field', $name, $namespace);
    }

    /**
     * Register a new widget.
     *
     * @param  string|array  $name
     * @param  null|string   $namespace
     *
     * @return $this|Registrar
     */
    public function widget($name, $namespace = null)
    {
        if (is_array($name)) {
            foreach ($name as $key => $namespace) {
                $this->register('widget', $key, $namespace);
            }

            return $this;
        }

        return $this->register('widget', $name, $namespace);
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
