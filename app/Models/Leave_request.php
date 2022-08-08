<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Leave_type;
class Leave_request extends Model
{
    //
    protected $fillable = [
        'leave_time','company_id','status','days','user_id','leave_from','leave_to','leave_reson','leave_type_id'
    ];
       /**
     * Get the user that owns the Leave_request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function leave_type()
    {
        return $this->belongsTo(Leave_type::class);
    }

}
