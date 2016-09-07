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

use Illuminate\Contracts\View\Factory;
use Maatwebsite\Sidebar\Presentation\SidebarRenderer;

class Creator
{

    /**
     * @var Registrar
     */
    protected $sidebar;

    /**
     * @var SidebarRenderer
     */
    protected $renderer;

    /**
     * @param  Registrar        $sidebar
     * @param  SidebarRenderer  $renderer
     */
    public function __construct(Registrar $sidebar, SidebarRenderer $renderer)
    {
        $this->sidebar = $sidebar;
        $this->renderer = $renderer;
    }

    /**
     * @param  Factory  $view
     */
    public function create($view)
    {
        $view->sidebar = $this->renderer->render($this->sidebar);
    }
}
