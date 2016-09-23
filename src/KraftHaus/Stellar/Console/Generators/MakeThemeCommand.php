<?php

namespace KraftHaus\Stellar\Console\Generators;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Filesystem\Filesystem;
use KraftHaus\Stellar\Theme\Registrar;
use KraftHaus\Stellar\Console\GeneratorCommand;

class MakeThemeCommand extends GeneratorCommand
{

    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'make:theme
        {slug: The slug of the theme}';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Create a new Stellar theme';

    /**
     * The theme manifest file contents.
     * @var array
     */
    protected $manifest = [];

    /**
     * @param  Filesystem  $files
     * @param  Registrar   $theme
     */
    public function __construct(Filesystem $files, Registrar $theme)
    {
        parent::__construct($files);

        $this->files = $files;
        $this->theme = $theme;
    }

    public function fire()
    {
        $this->manifest['slug'] = str_slug($this->argument('slug'));
        $this->manifest['name'] = studly_case($this->manifest['slug']);
        $this->manifest['version'] = '1.0';
        $this->manifest['description'] = sprintf('This is the description for the %s theme.', $this->manifest['name']);
    }
}
