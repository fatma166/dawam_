<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission_role extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'permission_id','role_id','company_id'
    ];
}