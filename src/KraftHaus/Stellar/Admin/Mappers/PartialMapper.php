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

use KraftHaus\Stellar\Admin\Builders\PartialBuilder;

class PartialMapper extends Mapper
{

    /**
     * The form builder classname.
     * @var string
     */
    protected $builder = PartialBuilder::class;

    public function view($path)
    {
        $this->partial = $path;
    }
}
