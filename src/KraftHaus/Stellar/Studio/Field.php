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

class Field
{

    /**
     * The field name.
     * @var string
     */
    protected $name;

    /**
     * The field arguments.
     * @var array
     */
    protected $arguments;

    /**
     * @var Widget
     */
    protected $widget;

    /**
     * The field value.
     * @var mixed
     */
    protected $value;

    /**
     * @param  string  $name
     * @param  array  $arguments
     */
    public function __construct($name, array $arguments)
    {
        $this->name = $name;
        $this->arguments = $arguments;
    }

    /**
     * Get the widget instance this field belongs to.
     *
     * @return Widget
     */
    public function getWidget()
    {
        return $this->widget;
    }

    /**
     * Set the widget instance this field belongs to.
     *
     * @param  Widget  $widget
     *
     * @return $this
     */
    public function setWidget(Widget $widget)
    {
        $this->widget = $widget;

        return $this;
    }

    /**
     * Get the field value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the field value.
     *
     * @param  mixed  $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}
