<?php

namespace App\Http\Controllers;

use App\Models\Rabbit;
use Illuminate\Http\Request;
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

    public function getTotals(Request $request): array
    {
        return [
          'rabbits' => Rabbit::query()->count(),
        ];
    }
}
