<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave_type extends Model
{
    //
    protected $fillable=array('name','created_at','updated_at','num_days','status','carry_forward_days','carry_forward','earned_leave','num_hours','company_id');
}
