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

use KraftHaus\Stellar\Database\Eloquent\Models\Page;
use KraftHaus\Stellar\Database\Eloquent\Models\Website;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Frontend
{

    /**
     * The current website.
     * @var Website
     */
    public $website = null;

    /**
     * The current page.
     * @var Page
     */
    public $page = null;

    public function __construct()
    {
        if (context()->isFrontend() && ! app()->runningInConsole()) {
            if ($website = $this->discoverWebsite()) {
                // Set the active theme.
                theme()->setActive($website->theme);

                $this->website = $website;
            }

            $this->page = $this->discoverPage();
        }
    }

    /**
     * Discover the current website.
     *
     * @return Website
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function discoverWebsite(): Website
    {
        $url = $this->getStrippedUrl();

        try {
            // First try to find the exact match.
            return Website::activated()
                ->select([
                    'id', 'domain', 'theme'
                ])
                ->byDomain($url)
                ->sorted()
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            // When we're unable to find the exact match, we'll try to figure out the best match
            // This is done by sorting all the domains by length (sortest first) and looping
            // over those results until we find the a new `exact` match. This will be our
            // current domain. Nothing is returned when nothing is ffound.
            $websites = Website::activated()
                ->select([
                    'id', 'domain', 'theme'
                ])
                ->sorted()
                ->get();

            foreach ($websites as $website) {
                if ((bool) strstr(str_finish($url, '/'), str_finish($website->domain, '/')) === true) {
                    return $website;
                }
            }
        }

        abort(404);
    }

    /**
     * Get the website instance.
     *
     * @return Website
     */
    public function website(): Website
    {
        return $this->website;
    }

    /**
     * Discover the current page.
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function discoverPage()
    {
        try {
            return $this->website->pages()
                ->select([
                    'id'
                ])
                ->activated()
                ->bySlug($this->getSlug())
                ->with('widgets', 'widgets.page')
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    /**
     * Get the page instance.
     *
     * @return Page|null
     */
    public function page()
    {
        return $this->page;
    }

    /**
     * Get the stripped url from the request (without the protocol).
     *
     * @return string
     */
    protected function getStrippedUrl(): string
    {
        return str_replace(parse_url($url = request()->url(), PHP_URL_SCHEME).'://', '', $url);
    }

    /**
     * Get the current slug (url minus the domain).
     *
     * @return string
     */
    protected function getSlug(): string
    {
        return trim(str_replace($this->website->domain, '', $this->getStrippedUrl()), '/') ?: '/';
    }
}
