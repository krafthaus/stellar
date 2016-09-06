<?php

namespace KraftHaus\Stellar\Http\Controllers;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use KraftHaus\Stellar\StellarServiceProvider;
use KraftHaus\Stellar\Database\Eloquent\Models\User;

class InstallController extends Controller
{

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provider = StellarServiceProvider::class;

        // Publish the config and migration files.
        Artisan::call('vendor:publish', [
            '--provider' => $provider,
            '--tag' => ['config', 'migrations'],
        ]);

        // Migrate the database.
        Artisan::call('migrate');

        // Create the first user.
        User::createSuperUser();

        return redirect()->route('backend.sessions.create');
    }
}