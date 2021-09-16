<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

class DefaultController extends Controller
{
    public function index()
    {
        $links['home']             = route('home');
        $links['rabbits']          = route('rabbits');
        $links['breeding']         = route('breeding');
        $links['options']          = route('options');
        $links['users']            = route('users');
        $links['roles']            = route('roles');
        $links['settings-privacy'] = route('settings-privacy');

        return [
            'app_name' => env('APP_NAME'),
            'links'    => $links,
        ];
    }
}
