<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Experience extends Model
{
    //
    protected $fillable = [

        'userid',
        'experience_name'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'userid');
    }
}
