<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Custom_leave extends Model
{
    //
   protected $fillable=array('name','leave_type_id','num_days','user_id');
}
