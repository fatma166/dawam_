<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
protected  $fillable=['table_name','key','company_id'];
 public $timestamps = false;
public function roles()
{
    return $this->belongsToMany(Role::Class);
}

public static function generateFor($table_name,$company_id)
{
    self::firstOrCreate(['key' => $table_name, 'table_name' => $table_name,'company_id'=>$company_id]);
    self::firstOrCreate(['key' => 'update-'.$table_name, 'table_name' => $table_name,'company_id'=>$company_id]);
    self::firstOrCreate(['key' => 'edit-'.$table_name, 'table_name' => $table_name,'company_id'=>$company_id]);
    self::firstOrCreate(['key' => 'store-'.$table_name, 'table_name' => $table_name,'company_id'=>$company_id]);
    self::firstOrCreate(['key' => 'delete-'.$table_name, 'table_name' => $table_name,'company_id'=>$company_id]);
}

}