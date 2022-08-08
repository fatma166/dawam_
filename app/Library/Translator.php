<?php
namespace App\Library;
use Alkoumi\CarbonDateTranslator\TransDate;
use  Carbon\Carbon;

class Translator extends TransDate{
public static  function translate($datetime) {
     $carbon=new Carbon($datetime);
    $carbon->locale("en");
    $translated_datetime=self::inArabic($carbon);
    
  
    if(preg_match("@ساع@",$translated_datetime)){
        if(preg_match("@قبل@",$translated_datetime)){
            return "اليوم";
        }elseif(preg_match("@بعد@",$translated_datetime)){
            return "غدا";
        }
    }
    return $translated_datetime;
  
}

}


