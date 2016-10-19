<?php

namespace KraftHaus\Stellar\Http\Controllers\Api;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use App\Http\Controllers\Controller;
use KraftHaus\Stellar\Database\Eloquent\Models\Website;
use KraftHaus\Stellar\Database\Eloquent\Repositories\DataStoreRepository;

class DataStoreController extends Controller
{

    /**
     * @var DataStoreRepository
     */
    protected $repository;

    /**
     * @param  DataStoreRepository  $repository
     */
    public function __construct(DataStoreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->all();
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}