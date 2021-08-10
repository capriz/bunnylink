<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use Silber\Bouncer\Bouncer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\RolesStoreRequest;

class RolesController extends Controller
{
    public function index()
    {
        Inertia::setRootView('layouts/app');

        return Inertia::render('Roles', [
            'data' => [
                'roles_store_link'  => route('roles.store'),
                'roles_table_link'  => route('roles.table'),
                'roles_update_link' => route('roles.update'),
                'roles_delete_link' => route('roles.delete'),
            ],
        ]);
    }

    public function store(RolesStoreRequest $request, Bouncer $bouncer)
    {
        $bouncer->role()->firstOrCreate([
            'name'  => ucfirst($request->role_name),
            'title' => ucfirst($request->role_name),
        ]);

        return ['success' => true];
    }

    public function update(Request $request, Bouncer $bouncer)
    {
        $bouncer->role()
                ->where('id', $request->id)
                ->update([
                    'name'  => ucfirst($request->name),
                    'title' => ucfirst($request->name),
                ]);

        $bouncer->sync(ucfirst($request->name))->abilities($request->abilities);

        return ['success' => true];
    }

    public function table(Bouncer $bouncer)
    {
        return DataTables::of($bouncer->role()->with(['abilities'])->get())->setTransformer(function ($value) {
            $value               = collect($value)->toArray();
            $value['created_at'] = Carbon::parse($value['created_at'])->format('F j, Y');
            $value['updated_at'] = Carbon::parse($value['updated_at'])->format('F j, Y');
            $value['abilities']  = collect($value['abilities'])->pluck('name');

            return $value;
        })->make(true);
    }

    public function destroy(Request $request, Bouncer $bouncer)
    {
        $bouncer->sync(ucfirst($request->name))->abilities([]);
        $bouncer->role()
                ->where('id', $request->id)
                ->delete();

        return ['success' => true];
    }
}
