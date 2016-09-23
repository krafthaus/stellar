<?php

namespace KraftHaus\Stellar\Flash;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Session\Store;

class SessionStore
{

    function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function flash($name, $data)
    {
        $this->session->flash($name, $data);
    }
}