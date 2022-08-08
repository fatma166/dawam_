<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Shift;

class User_shift extends Model
{
    //
    protected $fillable=['user_id','shift_id','time_in','time_in_max','time_in_min','time_out','time_out_max','time_out_min','break_time','date','active','over_time','company_id','created_at','updated_at'];
    public $timestamps = false;


    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
        
    }



}
