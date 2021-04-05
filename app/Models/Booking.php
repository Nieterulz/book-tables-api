<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'client_name',
        'code',
        'date',
        'persons',
        'table_id'
    ];

    protected $casts = [
        'date' => 'date'
    ];
}
