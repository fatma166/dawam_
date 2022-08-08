<?php
namespace App\Library;

class ThirdApi

{
    private  const geo_api=["key"=>"AIzaSyCMtllOMzchTUwJ_FCi1SstrTWrD5yhO3w","url"=>"https://maps.google.com/maps/api/geocode/json"];
    public static function ParceCoordinate($lat,$lang)
    {
      
        try{
            
        $url=self::geo_api["url"].'?latlng='.$lat.",".$lang."&key=".self::geo_api["key"];
        $geocode = file_get_contents($url);
        $json = json_decode($geocode);
        if($json->status=="ZERO_RESULTS"){
          return  "not found";
        }
        $index=isset($json->results[1])?1:0;
        $address = $json->results[$index]->formatted_address;
        return $address;
            
        }catch(\Exception $e){
            
           // $data["items"]=  $json;
          //  $data["error"]=$e->getMessage();
            return "undefined address";
            
        }
    }

}
