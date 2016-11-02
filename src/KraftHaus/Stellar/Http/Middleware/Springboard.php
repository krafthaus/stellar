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

class Springboard
{

    /**
     * @param  Request   $request
     * @param  \Closure  $next
     *
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        if (auth()->guest()) {
            return $next($request);
        }

        if (request()->segment(2) !== 'springboard') {
            $website = session('stellar.current-website');

            if (! $website) {
                return redirect()->intended(route('backend.springboard.index'));
            }

            if (! policy($website)->access(auth()->user(), $website)) {
                abort(403);
            }
        }

        return $next($request);
    }
}
