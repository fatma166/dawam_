<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications_log extends Model
{
    //
    protected $fillable=['title','message','company_id','notify_from','notify_to','data_id','type'];
}
