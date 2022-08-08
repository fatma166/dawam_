<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\CompanyPlan;

class Payments_log extends Model
{
    
    
     protected $fillable=['paid','depit','credit','pay_method','users_number','period_from','period_to','status','company_id','company_plan_id','representative_id'];
    
    
}