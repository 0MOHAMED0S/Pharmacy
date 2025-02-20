<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'path',
        'price',
        'pharmacy_id',
    ];
}
