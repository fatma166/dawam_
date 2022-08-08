<?php
namespace App\Traits\Admin\GetCoordinatee;

use App\Models\Client;

trait GetCoordinatee
{
    public function getLatLong($client_data)
    {
        
        $address=$client_data['address'];
        $id=$client_data['id'];
        
        $key="AIzaSyCMtllOMzchTUwJ_FCi1SstrTWrD5yhO3w";
        $url = "https://maps.google.com/maps/api/geocode/json?address=$address&key=$key";
        $url = preg_replace("/ /", "%20", $url);
        // send api request
        $geocode = curl_get_contents($url);
      
        $output= json_decode($geocode);
        
        $lat = $output->results[0]->geometry->location->lat;
        $long = $output->results[0]->geometry->location->lng;  
        
        Client::update(array('lati'=>$lat,'longi'=>$long))->where('id',$id);
        
    }
    
    function curl_get_contents($url)
    {
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      $data = curl_exec($ch);
      curl_close($ch);
      return $data;
    }
    
    
}