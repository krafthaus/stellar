<?php

namespace KraftHaus\Stellar\Http\Entities;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use KraftHaus\Stellar\Admin\Entity;
use KraftHaus\Stellar\Support\Facades\Theme;
use KraftHaus\Stellar\Admin\Mappers\FormMapper;
use KraftHaus\Stellar\Admin\Mappers\ListMapper;

class UserEntity extends Entity
{

    public function index()
    {
        $this->title = trans('stellar::entities/user.index.title');
        $this->subtitle = trans('stellar::entities/user.index.subtitle');

        $this->map('list', function (ListMapper $list) {
            $list->maps('users');

            $list->header([
                'name' => [
                    'label' => trans('stellar::entities/user.index.table-name')
                ],
                'email' => [
                    'label' => trans('stellar::entities/user.index.table-email')
                ]
            ]);

            $list->add('anchor', [
                'name' => 'name',
                'to' => function ($row) {
                    return route('backend.users.edit', $row);
                }
            ]);

            $list->add('label', [
                'name' => 'email'
            ]);
        });
    }

    public function edit()
    {
        $user = $this->variables->get('user');

        $this->title = trans('stellar::entities/user.edit.title');
        $this->subtitle = trans('stellar::entities/user.edit.subtitle', ['name' => $user->name]);

        $this->map('form', function (FormMapper $form) {
            $form->maps('user');

            $form->add('text', [
                'name' => 'name',
                'label' => trans('stellar::entities/user.edit.form-name')
            ]);

            $form->add('email', [
                'name' => 'email',
                'label' => trans('stellar::entities/user.edit.form-email')
            ]);

            $form->actions();
        });
    }
}
