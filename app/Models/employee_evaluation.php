<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employee_evaluation extends Model
{
    //
    protected $table='employee_evaluations';
    protected $fillable=['user_id','month','year','evalution_jobs_id','element_degree','emp_degree','evaluation_degree','company_id'];
   
   public function users()
   {
    return $this->belongsto('App\Models\User','user_id');
   }
   
   
public static function employeesEvaluations($company_id){
      
      
      
$date=date_create(date("Y-m-d"));

$current_year=date_format($date,"Y");
$current_month=date_format($date,"m"); 
date_sub($date,date_interval_create_from_date_string("1 month"));
$previous_year=date_format($date,"Y");
$previous_month=date_format($date,"m");

  $data["dates"]=[
"previous_date"=>["month"=>$previous_month,"year"=>$previous_year],
"current_date"=>["month"=>$current_month,"year"=>$current_year]

];

           $data["items"]=User::select("users.company_id as cm_id","users.name as user_name","users.id as user_id","branches.title as branch_name",
                             'jobs.title as job_name',
                              "employee_evaluations.id as emp_ev_id","employee_evaluations.month as ev_month","employee_evaluations.year as eve_year"
                             ,"employee_evaluations.total_degree as total_degree","evaluation_elements_jobs.element_degree as element_degree")
          ->leftjoin("employee_evaluations","users.id","=","employee_evaluations.user_id")  
          ->join("branches","users.branch_id","=","branches.id")
          ->Join("jobs","users.job_id","=","jobs.id") 
          ->leftJoin("evaluation_elements_jobs","evaluation_elements_jobs.id","=","employee_evaluations.evalution_jobs_id")  
          ->where('users.company_id',"=",$company_id)              
         ->where(function($query){
            $query->whereNull("users.role_id")
            ->orWhere("users.role_id","!=",1);
          

            
         })
       ->where(function($query)use($previous_year,$previous_month,$current_month,$current_year){
            $query->where([['employee_evaluations.year',"=",$previous_year],["employee_evaluations.month","=",$previous_month]])
            ->orWhere(function($query)use($current_year,$current_month){
                 $query->where('employee_evaluations.year',$current_year)
            ->where("employee_evaluations.month",$current_month);})
            ->orWhere(function($query){
                 $query->whereNull('employee_evaluations.year')
            ->whereNull("employee_evaluations.month");
            });
            
         })
          ->orderBy('employee_evaluations.month', 'asc')
          ->get();

   return $data ;
  }

}
