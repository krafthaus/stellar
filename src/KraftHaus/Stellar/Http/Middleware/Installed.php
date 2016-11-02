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

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use KraftHaus\Stellar\Support\License;

class Installed
{

    /**
     * @param  Request   $request
     * @param  \Closure  $next
     *
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        if (License::validate()) {
            // Yes, we're installed, continue.
            return $next($request);
        }

        // No redirects for ajax requests.
        if ($request->ajax()) {
            return response('Unauthorized', 401);
        }

        License::write('yes');

        // We're not installed so let's do that first.
        return redirect()->guest(route('backend.install.index'));
    }
}
