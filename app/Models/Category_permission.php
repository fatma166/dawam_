<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category_permission extends Model
{
    protected $table= 'category_permission';
     protected $fillable = [
        'permission_id','category_id'
    ];
    public $timestamps = false;


}
