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

use InvalidArgumentException;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use KraftHaus\Stellar\Support\Facades\Studio;

abstract class Widget
{

    /**
     * Holds the model instance.
     * @var Model
     */
    protected $instance;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $fields;

    /**
     * @param  Model  $instance
     */
    public function __construct(Model $instance)
    {
        $this->instance = $instance;
        $this->fields = collect();

        if (method_exists($this, 'configure')) {
            $this->configure();
        }
    }

    /**
     * Get the available widget fields.
     *
     * @return Collection
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Get the field values set on the fields of this widget.
     *
     * @return Collection
     */
    public function getValues()
    {
        $values = collect();

        foreach ($this->getFields() as $field) {
            $values->put($field->getName(), $field->getValue());
        }

        return $values;
    }

    /**
     * Set the field values for this widget instance.
     *
     * @param  Collection  $values
     */
    public function setValues($values)
    {
        $values->each(function ($value, $key) use ($values) {
            // If we cannot find any field belonging to this key then
            // pull the key, we apparently don't need it anymore.
            if (! $this->fields->has($key)) {
                $values->pull($key);

                // Update the model.
                $this->instance->update([
                    'values' => $values
                ]);

                return;
            }

            // Apparently we've found an existing field/value combination
            // so let's call the `setVAlue()` method on that field.
            $this->fields[$key]->setValue($value);
        });
    }

    /**
     * Try to render the widget view.
     *
     * @return mixed
     */
    public function render()
    {
        // Are we rendering on the backend?
        $path = context()->isBackend()
            ? $this->getBackendViewPath()
            : $this->getFrontendViewPath();

        $widget = $this->instance;
        $page = $widget->page;

        $view = theme($path)->with(compact('widget', 'page'))->render();

        return $view;
    }

    /**
     * Add a new field to the widget.
     *
     * @param  string  $type
     * @param  string  $name
     * @param  array   $arguments
     *
     * @return $this
     */
    protected function field($type, $name, array $arguments = [])
    {
        if (! $namespace = Studio::get('field', $type)) {
            throw new InvalidArgumentException('Cannot render field ' . $type);
        }

        $instance = new $namespace($name, $arguments);

        $instance->setWidget($this);

        $this->fields->put($name, $instance);

        return $this;
    }

    /**
     * The path of the view can be overwritten from within the
     * widget class by using the `$frontendView` property.
     * If this property does not exist, we'll try to
     * create our own path by dissecting the
     * namespace of the instance.
     *
     * @return string
     */
    protected function getFrontendViewPath()
    {
        return ! property_exists($this, 'frontendView')
            ? $this->discoverViewPath()
            : $this->frontendView;
    }

    protected function getBackendViewPath()
    {
        return ! property_exists($this, 'backendView')
            ? $this->discoverViewPath()
            : $this->backendView;
    }

    /**
     * This method is used when no specific view property is set on the instance.
     * If so, this will try to dissect the instance namespace
     * and create a view path from that.
     *
     * return string
     */
    protected function discoverViewPath()
    {
        $view = ltrim(strtolower(str_replace('\\', '.', $this->instance->classname)), 'app.resources.');

        if (ends_with($view, 'widget')) {
            $view = substr($view, 0, -6);
        }

        return $view;
    }
}
