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

use KraftHaus\Stellar\Admin\Builders\FormBuilder;

class FormMapper extends Mapper
{

    /**
     * The form builder classname.
     * @var string
     */
    protected $builder = FormBuilder::class;

    public function actions($actions = null)
    {
        if ($actions === null) {
            return 'gaaf';
        }
    }
}
