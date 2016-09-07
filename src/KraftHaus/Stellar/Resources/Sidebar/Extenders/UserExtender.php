<?php

namespace KraftHaus\Stellar\Resources\Sidebar\Extenders;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\SidebarExtender;

class UserExtender implements SidebarExtender
{

    public function extendWith(Menu $menu)
    {
        $menu->group('User management', function(Group $group) {
            $group->item('Users', function ($item) {
                $item->weight(1);
                $item->route('backend.users.index');
            });

            $group->item('Roles', function ($item) {
                $item->weight(2);
                $item->route('backend.users.roles.index');
            });

            $group->item('Permissions', function ($item) {
                $item->weight(3);
                $item->route('backend.users.permissions.index');
            });
        });

        return $menu;
    }
}