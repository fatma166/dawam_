<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Outdoor_attendance;
class Outdoor extends Model
{
    //
    // protected $fillable = [
    //     'company_id','visit_type_id','title','adress','description','user_id','longi','lati','date','customer_id','created_by'
    // ];
        protected  $fillable=["title","lati","longi","adress","date","description","customer_id","visit_type_id","company_id","user_id","rate","created_by","created_at"];

    public function report()
    {
        return $this->hasOne(Visit_report::class);
    }

     /**
     * Get all of the comments for the Attendence
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function outdoor_attendances()
    {
        return $this->hasOne(Outdoor_attendance::class);
    }
}
