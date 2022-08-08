<?php
namespace App\Traits;

// use Illuminate\Support\Str;
// use Ballen\Distical\Calculator as DistanceCalculator;
// use Ballen\Distical\Entities\LatLong;
trait DistanceChecker
{
    public function checkRegisterLocation($location, $request)
    {
      
        $allowed_distance = $request->user()->company->distance;
        //allowed location
        $lat1 = $location->lati;
        
        $lon1 = $location->longi;
        $lat2 = $request->lati;
        $lon2 = $request->longi;
        if (($lat1 == $lat2) && ($lon1 == $lon2))
         {
            return true;
        }



         else
         {
           if(   is_numeric($lon1)&&is_numeric($lon2)){
            $theta = $lon1 - $lon2;
             //echo $theta; exit; 
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $distance = ($miles * 1.609344) * 1000;
            }else{
                return false;
            }
        }



        if ($distance > $allowed_distance) 
        {
            return false;
        }
        return true;


    }

}
