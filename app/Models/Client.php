<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Specialization;
class Client extends Model
{
    //
    protected $fillable = [
        'name','en_name','phone','email','start_time','end_time','address','lati','longi','client_type_id','contact_person','company_id','branch_id','created_at','updated_at','contact_phone','building_info','target','specialization_id','appointments'];
    public function Specialization(): BelongsTo
    {
        return $this->belongsTo(Specialization::class);
    }
}

