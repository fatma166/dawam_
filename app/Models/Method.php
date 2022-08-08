<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Company;

class Method extends Model
{
    protected $fillable = [
        'title','status'
    ];
    public $timestamps = false;


}