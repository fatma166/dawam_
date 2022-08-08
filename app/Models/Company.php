<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Branch;
use App\Models\ExceptionHolidays;
use App\Models\Holiday;
use App\Models\Workflow;
use App\Models\Shift;

// new 
use App\Models\Leave_type;
use App\Models\Visits_type;
use App\Models\Client;
use App\Models\Client_type;
use App\Models\Visits_question;

class Company extends Model
{
    //
    protected $fillable = [
        'id','title','nearest_branch','distance','fake_check','target_location_check','min_time','logout_time','logo','add_client','cat_id'
    ];

   public $timestamps = false;
    public function User()
    {
        return $this->hasMany(User::class,'company_id');
    }

      /**
     * Get all of the comments for the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }



    public function exception_holidays()
    {
        return $this->hasMany(ExceptionHolidays::class);

    }

    public function holidays()
    {
        return $this->hasOne(Holiday::class);
    }

    public function workflows()
    {
        return $this->hasMany(Workflow::class);

    }

    public function shifts()
    {
        return $this->hasMany(Shift::class);

    }
     ///new 
      public function leaveTypes()
    {
        return $this->hasMany(Leave_type::class);

    }

    public function visitTypes()
    {
        return $this->hasMany(Visits_type::class);

    }
    
       public function clients()
    {
        return $this->hasMany(Client::class);

    }

    public function clientTypes()
    {

        return $this->hasMany(Client_type::class);

    }
     public function visitsQuestion()
    {

              return $this->hasMany(Visits_type::class);


    }
        public function logs(){
            return User::select("user_logs.id","name as user_name","title as job_title","avatar as user_avatar","action","description","datetime","data")
            ->join('user_logs',"users.id","=","user_logs.user_id")
            ->join('jobs','jobs.id',"=","users.job_id")
            ->where('user_logs.company_id',"=",$this->id);

}
public function employeeTrack(){
    return User::select("users.id as user_id","users.name as user_name","users.phone","users.last_login","users.avatar as user_avatar","branches.title as branch_title","jobs.title as job_title","device_info")
    ->join('branches','branches.id',"=","users.branch_id")
    ->join('jobs','jobs.id',"=","users.job_id")
    ->where('users.company_id',"=",$this->id);

}
}
