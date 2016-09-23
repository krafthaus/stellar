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

use KraftHaus\Stellar\Admin\Builders\ListBuilder;

class ListMapper extends Mapper
{

    public $paginator;

    /**
     * @var
     */
    public $rows;

    /**
     * The table header columns.
     * @var array
     */
    public $header = [];

    /**
     * @var string
     */
    protected $builder = ListBuilder::class;

    /**
     * Set the table header.
     *
     * @param  array  $columns
     *
     * @return $this
     */
    public function header(array $columns)
    {
        $this->header = $columns;

        return $this;
    }
}
