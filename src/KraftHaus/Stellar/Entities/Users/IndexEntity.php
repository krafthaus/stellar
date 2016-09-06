<?php

namespace KraftHaus\Stellar\Entities\Users;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use KraftHaus\Stellar\Admin\Entity;
use KraftHaus\Stellar\Admin\Mapper;
use KraftHaus\Stellar\Database\Eloquent\Models\User;

class IndexEntity extends Entity
{

    /**
     * The entity model.
     * @var string
     */
    public $model = User::class;

    public function index(Mapper $mapper)
    {
        $table = $mapper->make('table', [
            'props' => [
                'fields' => [
                    'id'   => ['label' => 'ID'],
                    'name' => ['label' => 'Name'],
                ]
            ]
        ]);

        $mapper->add('form', [
            'props' => [
            ],
            'children' => [
                $table
            ],
        ]);
    }
}