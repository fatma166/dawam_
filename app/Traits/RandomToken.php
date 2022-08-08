<?php
namespace App\Traits;

trait RandomToken {
public function generateToken($digit) {
$token="";
for($i=0;$i<$digit;$i++){
$token=$token.rand(0,9);
}
return $token;


 }

}
