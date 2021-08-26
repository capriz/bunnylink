<?php

namespace App\Http\Controllers\Inventory;

use Inertia\Inertia;
use App\Models\Rabbit;
use App\Models\Members;
use App\Models\Breeding;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\BreedingStoreRequest;

class BreedingFormController extends Controller
{
    public function index(Request $request, Rabbit $rabbit)
    {
        $breeding = [];

        if ($request->id) {
            $breeding = Breeding::query()->where('id', decrypt($request->id))->first();
        }

        inertia::setrootview('layouts/app');

        return inertia::render('Inventory/BreedingForm', [
            'data' => [
                'parent_doe_list'      => $rabbit->myDoes()->get(),
                'parent_buck_list'     => $rabbit->myBucks()->get(),
                'breeding_store_link'  => route('breeding.form.store'),
                'breeding'             => $breeding,
                'breeding_delete_link' => ! $request->id ?: route('breeding.form.delete', ['id' => $request->id]),
            ],
        ]);
    }

    public function store(BreedingStoreRequest $request)
    {
        $params = [
            "org_id"               => Members::getOrgID(auth()->id()),
            "cage_no"              => $request->cage_no,
            "parent_doe"           => $request->parent_doe,
            "parent_buck"          => $request->parent_buck,
            "date_bred"            => $request->date_bred,
            "expected_kindle_date" => $request->expected_kindle_date,
            "kindle_date"          => $request->kindle_date,
            "weaning_date"         => $request->weaning_date,
            "planned_rebreed_date" => $request->planned_rebreed_date,
            "isRebreed"            => $request->isRebreed,
            "born_alive"           => $request->born_alive,
            "born_dead"            => $request->born_dead,
            "total_kits"           => $request->total_kits,
            "born_doe"             => $request->born_doe,
            "born_buck"            => $request->born_buck,
            "notes"                => $request->notes,
        ];

        if (! $request->id) {
            $params["inserted_by"] = auth()->user()->name;
        } else {
            $params["updated_by"] = auth()->user()->name;
        }

        Breeding::updateOrCreate(['id' => $request->id], $params);

        return Redirect::route('breeding');
    }

    public function destroy($id)
    {
        Breeding::query()->where('org_id', Members::getOrgID(auth()->id()))->where('id', $id)->delete();

        return Redirect::route('breeding');
    }
}
