<?php

namespace KraftHaus\Stellar\Http\Middleware;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class Authenticate
{

    /**
     * @param  Request  $request
     * @param  Closure  $next
     *
     * @return RedirectResponse|Response
     */
    public function handle($request, Closure $next)
    {
        if (app('auth')->guest()) {
            // No redirects for ajax requests.
            if ($request->ajax()) {
                return response('Unauthorized', 401);
            }

            // If we cannot authenticate the current user
            // then just redirect to the login screen.
            return redirect()->guest(route('backend.sessions.create'));
        }

        // Nothing to see here, move along...
        return $next($request);
    }
}
