<?php

namespace App\Models;
use App\Models\outdoor_attendance_attachment;
use Illuminate\Database\Eloquent\Model;

class Outdoor_attendance extends Model
{
    //
        //
    public $timestamps=false;

    protected $fillable = [
        'time_in','time_out','outdoor_id','status','user_id','created_at','updated_at'
    ];


    public function outdoor_attendance_attachments()
    {
        return $this->hasMany(outdoor_attendance_attachment::class);
    }

}
