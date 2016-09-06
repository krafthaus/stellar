<?php

namespace KraftHaus\Stellar\Http\Controllers\Users;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use App\Http\Controllers\Controller;
use KraftHaus\Stellar\Database\Eloquent\Repositories\UserRepository;

class IndexController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index(UserRepository $user)
    {
        $users = $user->all();

        return view('stellar::screens.users.index')->with(compact('users'));
    }
}
