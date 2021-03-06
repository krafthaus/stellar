<?php

namespace KraftHaus\Stellar\Module;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use InvalidArgumentException;
use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;

class Registrar
{

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Filesystem
     */
    protected $files;

    /**
     * @param  Application  $app
     * @param  Filesystem   $files
     */
    public function __construct(Application $app, Filesystem $files)
    {
        $this->app = $app;
        $this->files = $files;
    }

    /**
     * Register the module service provider file from all modules.
     */
    public function register()
    {
        $this->enabled()->each(function ($properties) {
            $this->registerServiceProvider($properties);

            $this->autoloadFiles($properties);
        });
    }

    /**
     * Get all modules.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->getCache()->sortBy('order');
    }

    /**
     * Get all the module slugs.
     *
     * @return Collection
     */
    public function slugs(): Collection
    {
        $slugs = collect();

        $this->all()->each(function (string $item) use ($slugs) {
            $slugs->push($item['slug']);
        });

        return $slugs;
    }

    /**
     * Get all modules based on a where clause.
     *
     * @param  string  $key
     * @param  mixed   $value
     *
     * @return Collection
     */
    public function where(string $key, $value): Collection
    {
        return $this->all()->where($key, $value);
    }

    /**
     * @param  string  $slug
     * @return mixed
     */
    public function find(string $slug)
    {
        return $this->where('slug', $slug);
    }

    /**
     * Sort modules by a given key in ascending order.
     *
     * @param  string  $key
     * @param  bool    $descending
     *
     * @return Collection
     */
    public function sortBy(string $key, bool $descending = false): Collection
    {
        return $this->all()->sortBy($key, SORT_REGULAR, $descending);
    }

    /**
     * Determine that the given module exists.
     *
     * @param  string  $slug
     *
     * @return bool
     */
    public function exists(string $slug): bool
    {
        return $this->slugs()->contains(strtolower($slug));
    }

    /**
     * Returns the count of all modules.
     *
     * @return int
     */
    public function count(): int
    {
        return $this->all()->count();
    }

    /**
     * Get a module property value.
     *
     * @param  string      $property
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    public function get(string $property, $default = null)
    {
        list($slug, $key) = explode('::', $property);

        return $this->where('slug', $slug)->get($key, $default);
    }

    /**
     * Set the given module property values.
     *
     * @param  string  $property
     * @param  mixed   $value
     *
     * @return bool
     */
    public function set(string $property, $value)
    {
        list($slug, $key) = explode('::', $property);

        $module = $this->where('slug', $slug);
        $values = $module->first();

        $values[$key] = $value;

        $content = $this->getCache()->merge(collect([
            $module->keys()->first() => $values,
        ]))->all();

        return $this->files->put($this->getCachePath(), json_encode($content, JSON_PRETTY_PRINT));
    }

    /**
     * Get all enabled modules.
     *
     * @return Collection
     */
    public function enabled(): Collection
    {
        return $this->all()->where('enabled', true);
    }

    /**
     * Get all disabled modules.
     *
     * @return Collection
     */
    public function disabled(): Collection
    {
        return $this->all()->where('enabled', false);
    }

    /**
     * Determine that the specified module is enabled.
     *
     * @param  string  $slug
     *
     * @return bool
     */
    public function isEnabled(string $slug): bool
    {
        return $this->where('slug', $slug)->first()['enabled'] === true;
    }

    /**
     * Determine that the specified module is disabled.
     *
     * @param  string  $slug
     *
     * @return bool
     */
    public function isDisabled(string $slug): bool
    {
        return ! $this->isEnabled($slug);
    }

    /**
     * Enable a specific module.
     *
     * @param  string  $slug
     */
    public function enable(string $slug)
    {
        $this->set($slug . '::enabled', true);
    }

    /**
     * Disable s specific module.
     *
     * @param  string  $slug
     */
    public function disable(string $slug)
    {
        $this->set($slug . '::enabled', false);
    }

    /**
     * Register the module service provider.
     *
     * @param  array  $properties
     */
    protected function registerServiceProvider(array $properties)
    {
        $namespace = $this->resolveNamespace($properties);
        $provider = sprintf('%s\\%2$s\\Providers\\%2$sServiceProvider', $this->getNamespace(), $namespace);

        if (class_exists($provider)) {
            $this->app->register($provider);
        }
    }

    /**
     * Autoload custom module files.
     *
     * @param  array  $properties
     */
    protected function autoloadFiles(array $properties)
    {
        if (isset($properties['autoload'])) {
            $namespace = $this->resolveNamespace($properties);

            $path = $this->getPath() . "/{$namespace}/";

            foreach ($properties['autoload'] as $file) {
                require $path . $file;
            }
        }
    }

    /**
     * Resolve the correct module namespace.
     *
     * @param  array  $properties
     *
     * @return string
     */
    protected function resolveNamespace(array $properties): string
    {
        return isset($properties['namespace'])
            ? $properties['namespace']
            : studly_case($properties['slug']);
    }

    /**
     * Get a module's manifest contents.
     *
     * @param  string  $slug
     *
     * @return Collection
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function getManifest(string $slug): Collection
    {
        if ($slug) {
            $module = studly_case($slug);

            $path = $this->getManifestPath($module);

            $contents = $this->files->get($path);

            return collect(json_decode($contents, true));
        }

        return collect();
    }

    /**
     * Get all the module basenames.
     *
     * @return Collection
     * @throws InvalidArgumentException
     */
    protected function getBasenames(): Collection
    {
        $path = $this->getPath();

        try {
            $collection = collect($this->files->directories($path));

            return $collection->map(function ($item) {
                return basename($item);
            });
        } catch (InvalidArgumentException $e) {
            return collect([]);
        }
    }

    /**
     * Get the module path.
     *
     * @return string
     */
    public function getPath(): string
    {
        return config('stellar.modules-path');
    }

    /**
     * Get the module namespace.
     *
     * @return string
     */
    public function getNamespace(): string
    {
        return rtrim(config('stellar.modules-namespace'), '/\\');
    }

    /**
     * Get the contents of the cache file.
     *
     * @return Collection
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function getCache(): Collection
    {
        $path = $this->getCachePath();

        if (! $this->files->exists($path)) {
            $content = json_encode([], JSON_PRETTY_PRINT);

            $this->files->put($path, $content);

            $this->updateCache();

            return collect(json_decode($content, true));
        }

        return collect(json_decode($this->files->get($path), true));
    }

    /**
     * Update cached repository of module information.
     *
     * @return bool
     */
    public function updateCache()
    {
        $path = $this->getCachePath();
        $cache = $this->getCache();
        $modules = collect();
        $basenames = $this->getBasenames();

        $basenames->each(function ($module) use ($modules, $cache) {
            $manifest = collect($this->getManifest($module));

            $modules->put($module, collect($cache->get($module))->merge($manifest));
        });

        $modules->each(function ($module) {
            if (! $module->has('enabled')) {
                $module->put('enabled', config('stellar.modules-enabled', true));
            }

            if (! $module->has('order')) {
                $module->put('order', 9001);
            }

            return $module;
        });

        $content = json_encode($modules->all(), JSON_PRETTY_PRINT);

        return $this->files->put($path, $content);
    }

    /**
     * Get the path to the cache file.
     *
     * @return string
     */
    protected function getCachePath(): string
    {
        return storage_path('app/stellar/modules.json');
    }

    /**
     * Get the path to the specified module.
     *
     * @param  string  $slug
     *
     * @return string
     */
    protected function getModulePath(string $slug): string
    {
        $module = studly_case($slug);

        return sprintf('%s/%s', $this->getPath(), $module);
    }

    /**
     * Get the path to the manifest file of the specified module.
     *
     * @param  string  $slug
     *
     * @return string
     */
    protected function getManifestPath(string $slug): string
    {
        return $this->getModulePath($slug) . '/manifest.json';
    }
}
