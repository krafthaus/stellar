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

class Handler
{

    /**
     * @param  SessionStore  $session
     */
    public function __construct(SessionStore $session)
    {
        $this->session = $session;
    }

    /**
     * Create an info flash message.
     *
     * @param  string  $message
     */
    public function info(string $message)
    {
        $this->message($message, 'info');
    }

    /**
     * Create a success flash message.
     *
     * @param  string  $message
     */
    public function success(string $message)
    {
        $this->message($message, 'success');
    }

    /**
     * Create a warning flash message.
     *
     * @param  string  $message
     */
    public function warning(string $message)
    {
        $this->message($message, 'warning');
    }

    /**
     * Create a error flash message.
     *
     * @param  string  $message
     */
    public function error(string $message)
    {
        $this->message($message, 'error');
    }

    /**
     * Create a flash message.
     *
     * @param  string  $message
     * @param  string  $level
     */
    public function message(string $message, string $level)
    {
        $this->session->flash('stellar.flash.message', $message);
        $this->session->flash('stellar.flash.level', $level);
    }
}