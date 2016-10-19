<?php

namespace KraftHaus\Stellar\Http\Routing;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class ResourceRegistrar extends \Illuminate\Routing\ResourceRegistrar
{

    /**
     * Get the name for a grouped resource.
     *
     * @param  string  $prefix
     * @param  string  $resource
     * @param  string  $method
     *
     * @return string
     */
    protected function getGroupResourceName($prefix, $resource, $method)
    {
        $group = ltrim(str_replace('/', '.', $this->router->getLastGroupPrefix()), '.');

        $parts = explode('.', $group);
        $first = array_shift($parts);

        if ($parts) {
            $group = $first;

            $resource = implode('.', $parts) . '.' . $resource;
        }

        if (! empty($group) && $group == config('stellar.backend-uri')) {
            return trim("{$prefix}backend.{$resource}.{$method}", '.');
        }

        return trim("{$prefix}{$resource}.{$method}", '.');
    }
}
