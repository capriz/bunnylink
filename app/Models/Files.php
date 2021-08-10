<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'filename',
        'extension',
        'uploaded_by',
    ];

    public function getProfilePic($user_id)
    {
        return $this->where('uploaded_by', $user_id)->first();
    }
}
