<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{

   public $timestamps = false;
   protected $table = 'planes';
   protected $fillable=['price_user','currency','pay_type','name'];

}