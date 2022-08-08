<?php

namespace App\Models;

use App\Models\attendence_report;
use App\Models\Branch;
use App\Models\Company;
use App\Models\notifications_log;
use App\Models\Task;
use App\Models\Token;
use App\Models\User_shift;
use App\Models\Visit_report;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\job;
use App\Models\Shift;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   protected $fillable = [
        'name', 'phone', 'password','role_id','email','company_id','join_date','department_id','branch_id','job_id','email_isverified','avatar','shift_id','active','bassma'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = false;

    /**
     * user methoods
     */

     public function Shift()
     {
         $company=$this->company;
         $date = new \DateTime('Africa/cairo');
         $today_date = $date->format('Y-m-d');

        if (!$UserShift = $this->userShifts()->whereDate('date',  $today_date)->where('active', 1)->first()) {
            $UserShift = $company->shifts()->where('shift_default', 1)->where('status', 1)->first();
        } elseif (is_null($UserShift->time_in)) {
            $UserShift = $UserShift->shift;
        } else {
            $is_custom_shift = 1;
        }

        $data["shift"]=$UserShift;
        $data["is_custom_shift"]=isset($is_custom_shift)?true:false;

        return $data;

     }

    /**
     * user relations
     */

    public function userShift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    public function company()
    {
        return $this->belongsto(Company::class);

    }

    public function role()
    {

        return $this->belongsTo(Role::class);

    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendences()
    {
        return $this->hasMany(Attendence::class);

    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany(notifications_log::class, "notify_to");

    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];

    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function LeaveRequests()
    {
        return $this->hasMany(Leave_request::class);
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Outdoors()
    {
        return $this->hasMany(Outdoor::class);
    }

    public function userShifts()
    {

        return $this->hasMany(User_shift::class);

    }

    public function tokens()
    {

        return $this->hasMany(Token::class);

    }
    public function tasks()
    {

        return $this->hasMany(Task::class);

    }

    public function reports()
    {

        return $this->hasMany(Visit_report::class);

    }

    public function attendence_report()
    {

        return $this->hasMany(attendence_report::class);

    }

    /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(branch::class);
    }

    /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job()
    {
        return $this->belongsTo(job::class);
    }

   
    public function saveDeviceInfo($req){
      
        $device_data=[
            "app_ver"=>$req->app_ver??"",
            "os_ver"=>$req->os_ver??"",
            "brand"=>$req->brand??"",
            "ip"=>$req->ip??"",
        ];
        
        $this->device_info=$device_data;
        $this->save();
        
    }

}
