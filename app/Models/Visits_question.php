<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Visit_report;
class Visits_question extends Model
{
    //
    protected $fillable=['visit_type_id','question_text','type','choose_1','choose_2','choose_3','choose_4'];
    public $timestamps=false;
                /**
     * Get all of the report for the question
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function question_report()
    {
        return $this->belongsToMany(Visit_report::class);
    }
}
