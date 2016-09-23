<?php

namespace KraftHaus\Stellar\Console;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

abstract class GeneratorCommand extends \Illuminate\Console\GeneratorCommand
{

    /**
     * Parse the name and format it according to the root namespace.
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function parseName($name)
    {
        $rootNamespace = 'App\\Modules';

        if (starts_with($name, $rootNamespace)) {
            return $name;
        }

        if (str_contains($name, '/')) {
            $name = str_replace('/', '\\', $name);
        }

        return $this->parseName($this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\' . $name);
    }
}
