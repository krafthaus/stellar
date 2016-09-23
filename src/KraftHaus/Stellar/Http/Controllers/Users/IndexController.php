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

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use KraftHaus\Stellar\Support\Facades\Admin;
use KraftHaus\Stellar\Support\Facades\Flash;
use KraftHaus\Stellar\Http\Entities\UserEntity;
use KraftHaus\Stellar\Database\Eloquent\Models\User;
use KraftHaus\Stellar\Http\Requests\User\IndexRequest;
use KraftHaus\Stellar\Database\Eloquent\Repositories\UserRepository;
use KraftHaus\Stellar\Database\Eloquent\Repositories\WebsiteRepository;

class IndexController extends Controller
{

    /**
     * @var WebsiteRepository
     */
    protected $websites;

    /**
     * @param  WebsiteRepository  $websites
     */
    public function __construct(WebsiteRepository $websites)
    {
        $this->websites = $websites;
    }

    /**
     * @return Response
     */
    public function index(UserRepository $user)
    {
        $users = $user->paginate();

        return Admin::make(UserEntity::class, 'index')
            ->with(compact('users'))
            ->render();
    }

    /**
     * @return Response
     */
    public function create()
    {
        $websites = $this->websites->all();

        return theme('screens.users.index.create')->with([
            'websites' => $websites
        ]);
    }

    /**
     *
     */
    public function store(IndexRequest $request)
    {
        $user = new User($request->all());

        $user->websites()->associate(1);

        $user->save();

        Flash::success('Create a new user.');

        return redirect()->route('backend.users.index');
    }

    /**
     * @param  User  $user
     *
     * @return Response
     */
    public function edit(User $user)
    {
        $websites = $this->websites->all();

        return Admin::make(UserEntity::class, 'edit')
            ->with(compact('websites', 'user'));
    }

    /**
     * @param  IndexRequest  $request
     * @param  User          $user
     *
     * @return Response
     */
    public function update(IndexRequest $request, User $user)
    {
        $user->update($request->all());

        Flash::success('Update successfull.');

        return redirect()->route('backend.users.index');
    }

    /**
     * @param  Request  $request
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        return redirect()->back();
    }
}
