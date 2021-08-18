<?php

namespace App\Http\Controllers\Inventory;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Rabbit;
use Silber\Bouncer\Bouncer;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class rabbitscontroller extends controller
{
    /**
     * display a listing of the resource.
     *
     * @return \inertia\response
     */
    public function index(Rabbit $rabbit)
    {
        $rabbit->idGenerator();

        inertia::setrootview('layouts/app');

        return inertia::render('Inventory/Rabbits', [
            'data' => [
                'rabbits_table_link' => route('rabbits.table'),
            ],
        ]);
    }

    public function table()
    {
        return DataTables::of(Rabbit::all())->setTransformer(function ($data) {
            $data               = collect($data)->toArray();
            $data["created_at"] = Carbon::parse($data["created_at"])->format("F j, Y h:i:sA");
            $data["updated_at"] = Carbon::parse($data["updated_at"])->format("F j, Y h:i:sA");
            return $data;
        })->make(true);
    }
}
