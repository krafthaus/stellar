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

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use KraftHaus\Stellar\Database\Eloquent\Models\Website;
use KraftHaus\Stellar\Http\Requests\SpringboardRequest;

class SpringboardController extends Controller
{

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $websites = auth()->user()->websites;

        // When the user does not have any previously
        // created websites, we need to create one.
        if ($websites->isEmpty()) {
            return redirect()->route('backend.springboard.create');
        }

        // Just sign into the first website if the user
        // only has one website to choose from.
        if ($websites->count() === 1) {
            return $this->open($websites->first());
        }

        // ... Saul Goodman
        return view('stellar.screens.springboard.show')->with(compact('websites'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stellar::screens.springboard.create');
    }

    /**
     * @param  SpringboardRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SpringboardRequest $request)
    {
        $website = Website::create($request->all());
        $website->users()->attach(Auth::user());
        $website->save();

        return $this->open($website);
    }

    /**
     * @param  Website  $website
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function open(Website $website)
    {
        session()->put('stellar.current-website', $website);

        return redirect()->to(config('stellar.backend-uri'));
    }
}