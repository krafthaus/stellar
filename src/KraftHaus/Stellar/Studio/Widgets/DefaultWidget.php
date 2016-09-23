<?php

namespace KraftHaus\Stellar\Studio\Widgets;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use KraftHaus\Stellar\Studio\Widget;

class DefaultWidget extends Widget
{

    /**
     * Set the frontend view.
     * @var string
     */
    protected $frontendView = 'widgets.default';

    /**
     * Configure the widget.
     */
    public function configure()
    {
        $this->field('text', 'name', [
            'label' => 'Dit is gaaf'
        ]);
    }
}
