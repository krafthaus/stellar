<?php

namespace KraftHaus\Stellar\Routing;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Router extends \Illuminate\Routing\Router
{

    /**
     * Create a backend route group.
     *
     * @param  callable  $callback
     * @param  array     $attributes
     */
    public function backend(callable $callback, array $attributes = [])
    {
        $prefix = config('stellar.backend-uri');

        $middleware = array_keys(config('stellar.backend-middleware'));

        array_unshift($middleware, 'web');

        // Hacky way to fix Laravel-Debugbar middleware errors.
        $middleware = array_combine($middleware, $middleware);

        $attributes = array_merge($attributes, [
            'prefix' => $prefix,
            'middleware' => $middleware
        ]);

        $this->group(array_filter($attributes), $callback);
    }

    /**
     * Route a resource to a controller.
     *
     * @param  string  $name
     * @param  string  $controller
     * @param  array   $options
     */
    public function resource($name, $controller, array $options = [])
    {
        $registrar = new ResourceRegistrar($this);

        $registrar->register($name, $controller, $options);
    }
}
