<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hearth extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'path',
        'name',
        'seconds',
        'deviations',
        'graphic',
        'deviations_type',
        'user_id'
    ];
}
