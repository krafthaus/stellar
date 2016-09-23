<?php

namespace KraftHaus\Stellar\Http\Controllers\Websites;

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
use KraftHaus\Stellar\Database\Eloquent\Models\Website;
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
    public function index()
    {
        $websites = $this->websites->paginate();

        return view('gaaf');

        return theme('screens.websites.index.index')->with([
            'websites' => $websites
        ]);
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

    public function destroy()
    {

    }
}