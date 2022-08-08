<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    public $timestamps = false;

    //
      /**
     * The attributes that are mass assignable.
     *
     * @var array  
     */
    protected $fillable = [
        'time_from', 'time_to', 'title','company_id','status','shift_default','time_in_min','time_in_max','time_out_min','time_out_max','break_time','created_at','updated_at'
    ];
}
