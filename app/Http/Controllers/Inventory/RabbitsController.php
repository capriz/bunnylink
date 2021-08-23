<?php

namespace App\Http\Controllers\Inventory;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Rabbit;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class RabbitsController extends Controller
{
    public function index(Rabbit $rabbit)
    {
        $rabbit->idGenerator();

        inertia::setrootview('layouts/app');

        return inertia::render('Inventory/Rabbits', [
            'data' => [
                'rabbits_table_link' => route('rabbits.table'),
                'rabbits_form_link'  => route('rabbit.form'),
            ],
        ]);
    }

    public function table()
    {
        return DataTables::of(Rabbit::query()
                                    ->selectRaw('rabbits.*, br.litter_no')
                                    ->leftJoin('breedings as br', 'br.id', '=', 'rabbits.breeding_id')
                                    ->with(['rabbitStatus'])
                                    ->get())
                         ->setTransformer(function ($data) {
                             $data                        = collect($data)->toArray();
                             $data['rabbits_update_link'] = route('rabbit.edit.litter', ['id' => $data['id']]);
                             $data["created_at"]          = Carbon::parse($data["created_at"])->format("F j, Y");
                             $data["updated_at"]          = Carbon::parse($data["updated_at"])->format("F j, Y");
                             $data["dob"]                 = Carbon::parse($data["dob"])->format("F j, Y");

                             return $data;
                         })
                         ->make(true);
    }
}
