<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\attendance_attachment;
class Attendence extends Model
{

  
    protected  $table="attendances";
    //
   //  protected $fillable = ['status'];
 

    public function attendence_attachments(){


        return $this->hasMany(attendance_attachment::class,"attendance_id");
    }


}
