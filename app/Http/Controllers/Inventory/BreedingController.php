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
                             $data                        = collect($data)->toArray();
                             $data["for_weaning_date"]    = Carbon::parse($data["kindle_date"])->addDays(30);
                             $data["for_rebreeding_date"] = Carbon::parse($data["kindle_date"])->addDays(45);
                             $data["is_due_date"]         = now()->diffInDays($data["expected_kindle_date"]);
                             $data["is_weaning"]          = Carbon::parse($data["for_weaning_date"])
                                                                  ->diffInDays(now());
                             $data["is_rebreeding"]       = Carbon::parse($data["for_rebreeding_date"])
                                                                  ->diffInDays(now());

                             $data["expected_kindle_date"] = $this->parseDate($data["expected_kindle_date"]);
                             $data["created_at"]           = $this->parseDate($data["created_at"]);
                             $data["updated_at"]           = $this->parseDate($data["updated_at"]);
                             $data["weaning_date"]         = $this->parseDate($data["weaning_date"]);
                             $data["planned_rebreed_date"] = $this->parseDate($data["planned_rebreed_date"]);
                             $data["kindle_date"]          = $this->parseDate($data["kindle_date"]);
                             $data["breeding_edit_link"]   = route('breeding.form.edit',
                                 ['id' => encrypt($data['id'])]);

                             return $data;
                         })->make(true);
    }
}
