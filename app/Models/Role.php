<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Permission_role;
class Role extends Model
{
    //
public $timestamps = false;

    protected $fillable = [
        'name','company_id','created_at','updated_at'
    ];
    /**
     * user relations
     */

    public function permission_role()
    {
        return $this->hasMany(Permission_role::class, 'role_id');
    }
}
