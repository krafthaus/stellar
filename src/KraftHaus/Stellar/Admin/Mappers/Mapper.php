<?php

namespace KraftHaus\Stellar\Admin\Mappers;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\Collection;
use KraftHaus\Stellar\Admin\Entity;
use KraftHaus\Stellar\Admin\Fields\Field;
use KraftHaus\Stellar\Admin\Builders\Builder;

abstract class Mapper
{

    /**
     * @var Collection
     */
    public $fields;

    /**
     * @var Entity
     */
    public $entity;

    /**
     * Holds the mapped variable.
     * @var string
     */
    public $maps;

    /**
     * The builder instance.
     * @var null|Builder
     */
    protected $builder = null;

    public function __construct(Entity $entity)
    {
        $this->entity = $entity;
        $this->fields = collect();
    }

    /**
     * On what variable maps the current mapper instance?
     *
     * @param  string  $variable
     *
     * @return $this
     */
    public function maps($variable)
    {
        $this->maps = $variable;

        return $this;
    }

    /**
     * @param  string  $field
     * @param  array   $arguments
     *
     * @return $this
     */
    public function add($field, array $arguments = [])
    {
        $namespace = $this->getFieldNamespace($field);

        if (! isset($arguments['name'])) {
            throw new \RuntimeException('Missing the [name] argument.');
        }

        $instance = new $namespace($this, $arguments);

        $this->fields->put($arguments['name'], $instance);

        return $this;
    }

    /**
     * Render the build mapper.
     * @return mixed
     */
    public function render()
    {
        return $this->getBuilderInstance()->render();
    }

    /**
     * Get the instance of the current builder object.
     * @return mixed
     */
    public function getBuilderInstance()
    {
        if ($this->builder === null) {
            throw new \RuntimeException('No builder set');
        }

        return new $this->builder($this);
    }

    /**
     * Get the namespace for the given field type.
     *
     * @param  string  $field
     *
     * @return Field
     */
    protected function getFieldNamespace($field)
    {
        if (! $field = config('stellar.admin-fields.' . $field, null)) {
            throw new \InvalidArgumentException("Cannot find [{$field}] field.");
        }

        return $field;
    }
}
