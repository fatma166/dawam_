<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Company;
use App\Models\Client;

class Branch extends Model
{
    protected $fillable = [
        'title','company_id','adress','lati','longi','zone_id'
    ];
    public $timestamps = false;


    public function getBranch($company_id=null,$manger_branch_id='all'){
        
      return(Branch::where('company_id',$company_id)
                       ->Where(function($query) use ($manger_branch_id){
                                       
                       if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                              $query->Where('branches.id',$manger_branch_id);
                                       
                        })
        
                       ->get()
            );
        
    }
    /**
     * Get all of the comments for the branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departments()
    {
        return $this->hasMany(Department::class);
    }


    /**
     * Get the user that owns the branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

        /**
     * Get all of the comments for the branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clients()
    {
        return $this->hasMany(client::class);
    }

}
