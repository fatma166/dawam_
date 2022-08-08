<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    protected $fillable = [
        'company_id', 'title','target_location_check','outdoor_without_attend'
    ];
}
