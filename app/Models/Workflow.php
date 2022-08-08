<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    //
    protected $fillable = [
        'minutes','shift_id','company_id','hours','description','type'
    ];
}
