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

class RolesController extends Controller
{

    public function __construct()
    {
        view()->share('sidebar_active', 'roles');
    }

    /**
     * @return Response
     */
    public function index()
    {
        return view('stellar::screens.users.roles.index');
    }
}
