<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Files;
use Silber\Bouncer\Bouncer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UsersStoreRequest;

class UsersController extends Controller
{
    public function index(Bouncer $bouncer)
    {
        Inertia::setRootView('layouts/app');

        return Inertia::render('Users', [
            'data' => [
                'users_table_link'  => route('users.table'),
                'users_update_link' => route('users.update'),
                'users_store_link'  => route('users.store'),
                'users_cp_link'     => route('users.cp'),
                'users_del_link'    => route('users.destroy'),
                'roles'             => $bouncer->role()->all()->toArray(),
            ],
        ]);
    }

    public function usersTable(User $user)
    {
        return DataTables::of(User::all())->setTransformer(function ($data) use ($user) {
            $data               = collect($data)->toArray();
            $data["created_at"] = Carbon::parse($data["created_at"])->format("F j, Y h:i:sA");
            $data["updated_at"] = Carbon::parse($data["updated_at"])->format("F j, Y h:i:sA");
            $data["role"]       = User::find($data["id"])->getRoles()[0] ?? '';

            return $data;
        })->make(true);
    }

    public function update(Request $request, Bouncer $bouncer)
    {
        $user = User::find($request->id);
        $bouncer->retract($user->getRoles())->from($user);
        $user->assign($request->role);
        User::updateOrCreate(["id" => $request->id], ["name" => $request->name,]);

        return ['success' => true];
    }

    public function store(UsersStoreRequest $request)
    {
        User::create(["name" => $request->name, "email" => $request->email, "password" => $request->password,]);

        return ['success' => true];
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed',
        ]);

        User::updateOrCreate(["id" => $request->id], ["password" => $request->password,]);

        return ['success' => true];
    }

    public function destroy(Request $request, Bouncer $bouncer)
    {
        $user = User::find($request->id);
        $bouncer->retract($user->getRoles())->from($user);
        // delete Files
        Files::query()->where('uploaded_by', $request->id)->delete();
        // delete User
        User::destroy($request->id);

        return ['success' => true];
    }
}
