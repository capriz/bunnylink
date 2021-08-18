<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breeding extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'org_id',
        'litter_no',
        'cage_no',
        'parent_doe',
        'parent_buck',
        'date_bred',
        'expected_kindle_date',
        'kindle_date',
        'weaning_date',
        'planned_rebreed_date',
        'isRebreed',
        'born_alive',
        'born_dead',
        'total_kits',
        'born_doe',
        'born_buck',
        'notes',
        'inserted_by',
        'updated_by',
    ];
}
