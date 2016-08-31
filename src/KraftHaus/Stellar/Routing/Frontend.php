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

use KraftHaus\Stellar\Support\Facades\Context;
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
        if (Context::isFrontend() && !app()->runningInConsole()) {
            $this->website = $this->discoverWebsite();
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
    public function discoverWebsite()
    {
        $url = $this->getStrippedUrl();

        try {
            // First try to find the exact match.
            return $this->website = Website::activated()
                ->byDomain($url)
                ->sorted()
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            // When we're unable to find the exact match, we'll try to figure out the best match
            // This is done by sorting all the domains by length (sortest first) and looping
            // over those results until we find the a new `exact` match. This will be our
            // current domain. Nothing is returned when nothing is ffound.
            $websites = Website::activated()->sorted()->get();

            foreach ($websites as $website) {
                if ((bool) strstr(str_finish($url, '/'), str_finish($website->domain, '/')) === true) {
                    return $this->website = $website;
                }
            }
        }

        abort(404);
    }

    /**
     * Discover the current page.
     *
     * @return Page
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function discoverPage()
    {
        try {
            return $this->website->pages()
                ->activated()
                ->bySlug($this->getSlug())
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    /**
     * Get the stripped url from the request (without the protocol).
     *
     * @return string
     */
    protected function getStrippedUrl()
    {
        return str_replace(parse_url($url = request()->url(), PHP_URL_SCHEME) . '://', '', $url);
    }

    /**
     * Get the current slug (url minus the domain).
     *
     * @return string
     */
    protected function getSlug()
    {
        return trim(str_replace($this->website->domain, '', $this->getStrippedUrl()), '/') ?: '/';
    }
}