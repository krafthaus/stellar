<?php

namespace KraftHaus\Stellar\Admin\Builders;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use KraftHaus\Stellar\Admin\Fields\Field;

class FormBuilder extends Builder
{

    /**
     * The view path.
     * @var string
     */
    protected $view = 'components.admin.builders.form';

    /**
     * Try to build the mapper.
     */
    public function build()
    {
        $mapper = $this->mapper;
        $result = collect();

        $query = $this->getQuery();

        foreach ($mapper->fields as $field) {
            $result->put($field->name, $this->buildField($query, $field));
        }

        $mapper->result = $result;
    }

    protected function buildField($entry, Field $field)
    {
        $value = $entry->{$field->name};

        $clone = clone $field;

        foreach ($field->properties as $key => $val) {
            if ($val instanceof \Closure) {
                $clone->set($key, $val($entry, $clone));
            }
        }

        if (! $clone->value) {
            $clone->value = $value;
        }

        return $clone;
    }

    protected function getQuery()
    {
        $mapper = $this->mapper;

        return $mapper->entity->variables->get($mapper->maps);
    }
}
