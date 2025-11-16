<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
class Qualification extends Model
{
    //
   protected $fillable =[
          
            'userid',
            'qualification_name'

    ];
    public function user()
    {
        return $this->belongsTo(User::class,'userid');
    }
}
