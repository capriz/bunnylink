<?php

namespace App\Http\Controllers\Inventory;

use Inertia\Inertia;
use App\Models\Breed;
use Illuminate\Http\Request;
use App\Models\Rabbit;
use App\Models\Members;
use App\Models\Category;
use App\Models\Breeding;
use App\Models\RabbitStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class RabbitFormController extends Controller
{
    public function index(Request $request)
    {
        $rabbit = [];

        if ($request->id) {
            $rabbit          = Rabbit::query()->where('id', $request->id)->first();
            $rabbit['photo'] = null;
        }

        inertia::setrootview('layouts/app');

        return inertia::render('Inventory/RabbitForm', [
            'data' => [
                'rabbits_table_link' => route('rabbits.table'),
                'categories'         => Category::all(),
                'breeds'             => Breed::all(),
                'rabbit_status'      => RabbitStatus::all(),
                'litters'            => Breeding::query()
                                                ->where('org_id', Members::getOrgID(auth()->id()))
                                                ->select(['id', 'litter_no'])->get(),
                'litter_find_link'   => route('rabbit.litter'),
                'rabbit_store_link'  => route('rabbit.store.litter'),
                'rabbit'             => $rabbit,
            ],
        ]);
    }

    public function findLitter(Request $request)
    {
        return Breeding::query()->where('id', $request->breeding_id)->with(['sire', 'dam'])->first();
    }

    public function store(Request $request)
    {
        $rabbit = Rabbit::updateOrCreate(
            ['id' => $request->id],
            [
                "org_id"      => Members::getOrgID(auth()->id()),
                "cage_no"     => $request->cage_no,
                "status"      => $request->status,
                "category"    => $request->category,
                "breed"       => $request->breed,
                "color"       => $request->color,
                "type"        => $request->type,
                "dob"         => $request->dob,
                "gender"      => $request->gender,
                "home_breed"  => $request->home_breed,
                "breeding_id" => $request->breeding_id,
                "notes"       => $request->notes,
            ]);

        if ($request->hasFile('photo')) {
            $avatar = $request->file('photo')->store('rabbit_photos');
            Rabbit::updateOrCreate(
                ['id' => $rabbit->id],
                [
                    "avatar" => $avatar,
                ]);
        }

        return Redirect::route('rabbits');
    }
}
