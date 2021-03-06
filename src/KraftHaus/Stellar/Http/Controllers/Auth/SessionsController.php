<?php

namespace KraftHaus\Stellar\Http\Controllers\Auth;

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
use Illuminate\Routing\Controller;

class SessionsController extends Controller
{

    /**
     * @return Response
     */
    public function create()
    {
        return view('stellar::screens.auth.sessions.create');
    }

    /**
     * @return Response
     */
    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials, $request->get('remember_me'))) {
            return redirect()->intended(config('stellar.backend-uri'));
        }

        return redirect()->back()->withInput()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    /**
     * @return Response
     */
    public function destroy()
    {
        auth()->logout();

        session()->flush();

        return redirect()->guest(config('stellar.backend-uri'));
    }
}
