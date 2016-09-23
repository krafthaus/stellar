<?php

namespace KraftHaus\Stellar\Database\Eloquent\Models;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use KraftHaus\Forrest\Node;
use InvalidArgumentException;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class Widget extends Node
{

    /**
     * Mass-assignment protection.
     * @var array
     */
    protected $fillable = [
        'name',
        'classname',
        'values'
    ];

    protected $instance = null;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Render the widget.
     *
     * @return mixed
     */
    public function render()
    {
        return $this->getInstance()->render();
    }

    /**
     * Override the getter for the values attribute.
     *
     * @param  string  $value
     *
     * @return Collection
     */
    public function getValuesAttribute($value)
    {
        return collect(json_decode($value));
    }

    /**
     * Override the setter for the values attribute.
     *
     * @param  Collection  $value
     *
     * @return string
     */
    public function setValuesAttribute($value)
    {
        $this->attributes['values'] = $value;
    }

    /**
     * Get the widget instance.
     *
     * @return mixed
     */
    protected function getInstance()
    {
        // Make sure widgets are not loaded more than once. If
        // this instance has never been used before, try to
        // instantiate the widget studio instance.
        if ($this->instance === null) {
            $classname = $this->classname;

            if (! class_exists($classname)) {
                throw new InvalidArgumentException('Unable to load the widget');
            }

            $this->instance = new $classname($this);

            $this->reloadInstance();
        }

        return $this->instance;
    }

    /**
     * Reload the widget instance with the current values.
     */
    protected function reloadInstance()
    {
        $this->getInstance()->setValues($this->values);
    }
}
