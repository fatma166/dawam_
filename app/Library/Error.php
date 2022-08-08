<?php
namespace App\Library;

class Error
{
    public static function format($errors)
    {
        $errors = json_decode($errors);
        $msg = "";

        foreach ($errors as $error) {

            foreach ($error as $er_msg) {
                $msg = $msg . "." . $er_msg;
            }
        }
       $data["msg"]=$msg;
        return $data;
    }

}
