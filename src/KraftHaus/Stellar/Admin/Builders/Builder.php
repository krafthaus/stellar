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

use KraftHaus\Stellar\Admin\Mappers\Mapper;

abstract class Builder
{

    /**
     * The Mapper instance.
     * @var Mapper
     */
    protected $mapper;

    /**
     * @param  Mapper  $mapper
     */
    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * Try to build the mapper.
     */
    abstract public function build();

    /**
     * Render the builder.
     */
    public function render()
    {
        return theme($this->view)->with([
            'mapper' => $this->mapper,
            'builder' => $this
        ])->render();
    }
}
