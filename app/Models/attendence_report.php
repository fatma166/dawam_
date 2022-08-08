<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Attendence;
class attendence_report extends Model
{
public $timestamps=false;   //


/**
 * Get the user that owns the attendence_report
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function attendance()
{
    
    return $this->belongsTo(Attendence::class);

}


}
