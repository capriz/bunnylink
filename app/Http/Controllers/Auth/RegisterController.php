<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use App\Models\Members;
use App\Models\Organization;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Inertia\Response
     */
    public function showRegistrationForm()
    {
        Inertia::setRootView('layouts/guest');

        return Inertia::render('Register', [
            'data' => [
                'register_store_link' => route('register'),
            ],
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user.name'        => ['required', 'string', 'max:255'],
            'user.email'       => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'user.password'    => ['required', 'string', 'min:8', 'confirmed'],
            'user.toc'         => ['required'],
            'business.name'    => ['required', 'string'],
            'business.address' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return void
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name'          => $data['user']['name'],
            'email'         => $data['user']['email'],
            'password'      => Hash::make($data['user']['password']),
            'dob'           => $data['user']['dob'],
            'phone_primary' => $data['user']['phone_primary'],
            'phone_other'   => $data['user']['phone_other'],
            'address'       => $data['user']['address'],
            'zip_code'      => $data['user']['zip_code'],
            'country'       => $data['user']['country'],
            'toc'           => $data['user']['toc'],
        ]);

        $organization = Organization::create([
            'name'    => $data['business']['name'],
            'address' => $data['business']['address'],
            'email'   => $data['business']['email'],
            'status'  => '1',
        ]);

        Members::create([
            'user_id' => $user->id,
            'org_id'  => $organization->id,
        ]);

        return $user;
    }
}
