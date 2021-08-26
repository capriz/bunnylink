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
                             $data["created_at"]          = $this->parseDate($data["created_at"]);
                             $data["updated_at"]          = $this->parseDate($data["updated_at"]);
                             $data["dob"]                 = $this->parseDate($data["dob"]);

                             return $data;
                         })
                         ->make(true);
    }
}
