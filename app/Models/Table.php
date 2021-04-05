<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'code',
        'min_capacity',
        'max_capacity'
    ];

    protected $casts = [
        'code' => 'integer',
        'min_capacity' => 'integer',
        'max_capacity' => 'integer',
    ];
}
