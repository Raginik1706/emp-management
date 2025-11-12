<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
     protected $table='address';
     protected $fillable = [
        'userid',
        'per_address',
        'per_city',
        'per_state',
        'curr_address',
        'curr_city',
        'curr_state'
    ];
}
