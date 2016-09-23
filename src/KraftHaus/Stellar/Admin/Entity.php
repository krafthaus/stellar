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

use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use KraftHaus\Stellar\Admin\Mappers\Mapper;
use KraftHaus\Stellar\Admin\Mappers\PartialMapper;

abstract class Entity
{

    /**
     * The entity title.
     * @var string
     */
    public $title;

    /**
     * The entity subtitle.
     * @var string
     */
    public $subtitle;

    /**
     * The view path.
     * @var string
     */
    public $view = 'screens.admin.entity-renderer';

    /**
     * The view layout.
     * @var string
     */
    public $layout = 'stellar::layouts.main';

    /**
     * The available variables.
     * @var Collection
     */
    public $variables;

    /**
     * @var Collection
     */
    public $mappers;

    /**
     * The current entity action.
     * @var string
     */
    protected $action;

    /**
     * @param  string  $action
     */
    public function __construct($action)
    {
        // Test the existence of the used action.
        if (! method_exists($this, $action)) {
            throw new \InvalidArgumentException("Cannot execute [{$action}] action.");
        }

        $this->action = $action;

        $this->variables = collect();
        $this->mappers = collect();
    }

    public function __toString()
    {
        return $this->render()->render();
    }

    /**
     * @param  string|array  $key
     * @param  null|mixed    $value
     *
     * @return $this
     */
    public function with($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->with($k, $v);
            }

            return $this;
        }

        $this->variables->put($key, $value);

        return $this;
    }

    /**
     * Render the action.
     */
    public function render()
    {
        $this->execute();

        return theme($this->view)->with([
            'entity' => $this
        ]);
    }

    /**
     * Execute the action.
     */
    protected function execute()
    {
        $this->{$this->action}();

        foreach ($this->mappers as $mapper) {
            $mapper->getBuilderInstance()->build();
        }
    }

    protected function partial($view)
    {
        $this->map('partial', function (PartialMapper $partial) use ($view) {
            $partial->view($view);
        });
    }

    /**
     * @param  string    $type
     * @param  callable  $callback
     *
     * @return $this
     */
    protected function map($type, callable $callback)
    {
        $namespace = $this->getMapperNamespace($type);

        $mapper = new $namespace($this);

        // Execute the callback
        $callback($mapper);

        $this->mappers->push($mapper);

        return $this;
    }

    /**
     * @param  string  $type
     *
     * @return Mapper
     */
    protected function getMapperNamespace($type)
    {
        if (! $mapper = config('stellar.admin-mappers.' . $type, null)) {
            throw new \InvalidArgumentException("Cannot find [{$type}] mapper.");
        }

        return $mapper;
    }
}
