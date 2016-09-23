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

use Closure;
use Illuminate\Support\Collection;
use KraftHaus\Stellar\Admin\Fields\Field;
use KraftHaus\Stellar\Admin\Mappers\ListMapper;
use Illuminate\Pagination\LengthAwarePaginator;

class ListBuilder extends Builder
{

    /**
     * The view path.
     * @var string
     */
    protected $view = 'components.admin.builders.list';

    /**
     *
     */
    public function build()
    {
        $mapper = $this->mapper;
        $result = collect();

        foreach ($this->getRows() as $entry) {
            $result->put($entry->getKey(), $this->buildRow($mapper, $entry));
        }

        $mapper->rows = $result;
    }

    /**
     * @return Collection
     */
    protected function getRows()
    {
        $mapper = $this->mapper;

        $rows = $mapper->entity->variables->get($mapper->maps);

        // Is this a 'paginated' collection?
        if ($rows instanceof LengthAwarePaginator) {
            $mapper->paginator = $rows;
        }

        return $rows;
    }

    /**
     * @param  ListMapper  $mapper
     * @param  mixed       $entry
     *
     * @return Collection
     */
    protected function buildRow(ListMapper $mapper, $entry)
    {
        $row = collect();

        foreach ($mapper->fields as $field) {
            $row->put($field->name, $this->buildField($entry, $field));
        }

        return $row;
    }

    /**
     * @param  mixed  $entry
     * @param  Field  $field
     *
     * @return Field
     */
    protected function buildField($entry, Field $field)
    {
        $value = $entry->{$field->name};

        $clone = clone $field;

        foreach ($field->properties as $key => $val) {
            if ($val instanceof Closure) {
                $clone->set($key, $val($entry, $clone));
            }
        }

        if (! $clone->value) {
            $clone->value = $value;
        }

        return $clone;
    }
}
