<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit_report extends Model
{
    //
    public $timestamps=false;
      protected $fillable=['question_id','user_id','outdoor_id','answer_value'];
    
   public function question()
    {
        // return $this->belongsTo('Model', 'foreign_key', 'owner_key'); 
        return $this->belongsTo('App\Models\Visits_question','question_id','id');
    }
}
