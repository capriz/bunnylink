<?php

namespace App\Http\Controllers\Inventory;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Rabbit;
use App\Models\Breeding;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BreedingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        inertia::setrootview('layouts/app');

        return inertia::render('Inventory/Breeding', [
            'data' => [
                'rabbits_table_link' => route('rabbits.table'),
            ],
        ]);
    }

    public function table()
    {
        return DataTables::of(Breeding::all())->setTransformer(function ($data) {
            $data               = collect($data)->toArray();
            $data["created_at"] = Carbon::parse($data["created_at"])->format("F j, Y h:i:sA");
            $data["updated_at"] = Carbon::parse($data["updated_at"])->format("F j, Y h:i:sA");
            return $data;
        })->make(true);
    }
}
