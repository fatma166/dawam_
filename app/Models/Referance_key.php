<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referance_key extends Model
{
    protected $fillable = [
        'referance_key','type','actual_id','user_id'
    ];
    public $timestamps = false;


}
