<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'broadcast_date',
        'genre',
        'synopsis',
        'key_visual_url',
        'key_visual_reference',
    ];

    // relation
}
