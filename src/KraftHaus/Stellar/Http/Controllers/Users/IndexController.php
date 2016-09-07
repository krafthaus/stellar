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

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use KraftHaus\Stellar\Support\Facades\Theme;
use KraftHaus\Stellar\Database\Eloquent\Repositories\UserRepository;

class IndexController extends Controller
{

    public function __construct()
    {
        view()->share('sidebar_active', 'users');
    }

    /**
     * @return Response
     */
    public function index(UserRepository $user)
    {
        $users = $user->all();

        return Theme::view('screens.users.index')->with(compact('users'));
    }
}
