<?php

namespace KraftHaus\Stellar\Resources\Sidebar;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Sidebar;
use KraftHaus\Stellar\Resources\Sidebar\Extenders\UserExtender;

class Registrar implements Sidebar
{

    /**
     * @var Menu
     */
    protected $menu;

    /**
     * @param  Menu  $menu
     */
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    /**
     * Build your sidebar implementation here
     */
    public function build()
    {
        $menu = $this->menu;

        $menu->add((new UserExtender)->extendWith($menu));
    }

    /**
     * Get the menu instance.
     *
     * @return Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }
}
