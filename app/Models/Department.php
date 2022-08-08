<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;

class Department extends Model
{
    protected $fillable = [
        'title','company_id'
    ];
    // 
public $timestamps = false;


/**
 * Get the user that owns the Department
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function branch(): BelongsTo
{
    return $this->belongsTo(Branch::class);
}

public function getDep($company_id=null,$manger_department_id='all'){
   return( Department::where('company_id',$company_id)
                     ->Where(function($query) use ($manger_department_id){
                                       
                      if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                              $query->Where('departments.id',$manger_department_id);
                                       
                      }) ->get());
}
}
