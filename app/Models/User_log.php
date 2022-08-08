<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_log extends Model
{
    //
    protected $fillable=[
        	"action",	"description",	"data",	"datetime",	"user_id","company_id"
    ];
}
