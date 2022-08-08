<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyPlan extends Model
{
    //
     protected $fillable=['company_id','duration','number_user','status','salary','date_from','currency','plan_id','paid','date_to','transaction_status',' transaction_id'];
}
