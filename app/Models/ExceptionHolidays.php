<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ExceptionHolidays extends Model
{
    protected $fillable=['title','date_from','date_to','company_id'];
}
