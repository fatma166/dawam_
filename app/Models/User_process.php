<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_process extends Model
{
    //
    protected $table="user_processes";
    protected $fillable=[
        	"type",	"date",	"title","user_id"
    ];
}