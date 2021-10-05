<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Default route for Dashboard.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        Inertia::setRootView('layouts/app');

        return Inertia::render('Dashboard', ['data' => [],]);
    }
}
