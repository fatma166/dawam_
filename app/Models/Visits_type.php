<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Visits_question;
use App\Models\Company;
class Visits_type extends Model
{
    //
    protected $fillable = [
        'name','company_id'
    ];
      //
    public $timestamps=false;






    public function company()

    {

        return $this->belongsto(Company::class);



    }
    /**
     * Get all of the comments for the Visits_type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Visits_question::class,'visit_type_id');
    }



}
