<?php

namespace KraftHaus\Stellar\Database\Eloquent\Models;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use KraftHaus\Stellar\Database\Eloquent\Traits\Activatable;

class Page extends Model
{

    use Activatable;

    /**
     * Scope the query by a certain slug.
     *
     * @param Builder  $query
     * @param string   $slug
     */
    public function scopeBySlug($query, $slug)
    {
        $query->where('slug', $slug);
    }

    /**
     * @return HasMany
     */
    public function widgets(): HasMany
    {
        return $this->hasMany(Widget::class);
    }

    /**
     * Determine that the page has any attached widgets.
     *
     * @return bool
     */
    public function hasWidgets(): bool
    {
        return ! $this->widgets->isEmpty();
    }

    /**
     * Create the first root widget for this page.
     *
     * @return Widget
     */
    public function createRootWidget(): Widget
    {
        // Create a new root widget instance.
        $widget = new Widget([
            'name' => 'root',
            'classname' => config('stellar.studio-default-widget')
        ]);

        // Save the widget.
        return $this->widgets()->save($widget);
    }

    public function duplicate()
    {
        $original = $this;

        $new = $original->replicate();
        $new->push();

        $original->widgets()->duplicate();

        return $new;
    }
}
