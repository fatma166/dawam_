<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class evaluation_elements_jobs extends Model
{
    //
    protected $table='evaluation_elements_jobs';
    protected $fillable=['job_id','element_degree','company_id'];
    
    
    //relation with jobs
    
    public function jobs()
    {
        return $this->belongsto('App\Models\Job','job_id');
    }
    

}
