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
     * @param \App\Models\Breeding $breeding
     * @return \Inertia\Response
     */
    public function index(Breeding $breeding)
    {
        $breeding->idGenerator();

        inertia::setrootview('layouts/app');

        return inertia::render('Inventory/Breeding', [
            'data' => [
                'breeding_table_link' => route('breeding.table'),
                'breeding_form_link'  => route('breeding.form'),
            ],
        ]);
    }

    public function table()
    {
        return DataTables::of(Breeding::query()->with(['sire', 'dam']))
                         ->setTransformer(function ($data) {
                             $data                       = collect($data)->toArray();
                             $data["created_at"]         = Carbon::parse($data["created_at"])->format("F j, Y h:i:sA");
                             $data["updated_at"]         = Carbon::parse($data["updated_at"])->format("F j, Y h:i:sA");
                             $data["breeding_edit_link"] = route('breeding.form.edit', ['id' => $data['id']]);

                             return $data;
                         })->make(true);
    }
}
