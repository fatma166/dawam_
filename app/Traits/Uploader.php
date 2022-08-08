<?php
namespace App\Traits;
use Illuminate\Support\Str;

trait Uploader {



 public function upload_attachement($attachment) {

    $new_name = Str::random(40) . '.' . $attachment->getClientOriginalExtension();
    $attachment->move(public_path("uploads/users"), $new_name);
    return '/uploads/users/' . $new_name;


 }
 
  public function delete_attachement($path) {

  
   unlink(public_path($path));


 }
 
}
