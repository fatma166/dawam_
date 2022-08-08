<?php

namespace App\Models;
use App\Models\task_dones;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
   // public $timestamps = false;
    protected $fillable = [
        'title', 'start_date', 'due_date','user_id','status','company_id','description','in_progress','branch_id'
    ];
    //
    
/**
 * Get all of the comments for the Task
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
public function task_dones()
{
    return $this->hasMany(task_dones::class);
}


}
