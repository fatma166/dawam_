<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Payment_attach extends Model
{
    protected $table = 'payment_attachs';
     public $timestamps = false;
    protected $fillable=['file_path','company_plan_id'];
    
    
    
}