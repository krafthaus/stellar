<?php

namespace KraftHaus\Stellar\Http\Controllers;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Routing\Controller;
use KraftHaus\Stellar\Support\Facades\Flash;

class ModulesController extends Controller
{

    public function index()
    {
        $modules = app('modules')->all();

        return theme('screens.modules.index')->with([
            'modules' => $modules
        ]);
    }

    public function show($module)
    {
        $module = $this->getModule($module);

        return theme('screens.modules.show')->with([
            'module' => $module
        ]);
    }

    public function enable($module)
    {
        $module = $this->getSlug($module);

        app('modules')->enable($module);

        Flash::success('Module enabled.');

        return redirect()->back();
    }

    public function disable($module)
    {
        $module = $this->getSlug($module);

        app('modules')->disable($module);

        Flash::success('Module disabled.');

        return redirect()->back();
    }

    protected function getModule($module)
    {
        $slug = $this->getSlug($module);

        return app('modules')->find($slug)->first();
    }

    protected function getSlug($module)
    {
        return base64_decode($module);
    }
}