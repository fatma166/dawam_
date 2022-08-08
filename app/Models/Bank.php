<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Company;

class Bank extends Model
{
    protected $fillable = [
        'name','account_number','balance'
    ];
    public $timestamps = false;


}
