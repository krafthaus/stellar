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

use KraftHaus\Stellar\Admin\Mapper;

class Entity
{

    /**
     * The referenced model class.
     * @var string|null
     */
    public $model = null;

    public $mapper;

    /**
     * The entity action.
     * @var string
     */
    public $action;

    /**
     * Did we execute this entity?
     * @var bool
     */
    protected $isExecuted = false;

    /**
     * Entity constructor.
     *
     * @param  string  $action
     */
    public function __construct($action)
    {
        $this->action = $action;
    }

    public function render()
    {
        if (!$this->isExecuted) {
            $this->execute();
        }

        return view('stellar::components.admin.entity-renderer')->with([
            'entity' => $this
        ]);
    }

    public function execute()
    {
        $action = $this->action;

        if (!method_exists($this, $action)) {
            throw new \InvalidArgumentException(sprintf('Unable to execute the %s action.', $action));
        }

        $mapper = new Mapper;

        $this->mapper = $mapper;
        $this->{$action}($mapper);

        $this->isExecuted = true;

        return $this;
    }
}