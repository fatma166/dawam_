<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class evaluation_element extends Model
{
    protected $table='evaluation_elements';
    protected $fillable = [
        'title','company_id','status'
    ];
   
     
}