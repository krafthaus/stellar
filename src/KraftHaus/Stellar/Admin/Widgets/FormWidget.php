<?php

namespace KraftHaus\Stellar\Admin\Widgets;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class FormWidget extends Widget
{

    public function render()
    {
        return view('stellar::components.widgets.form')->with([
            'widget' => $this
        ])->render();
    }
}