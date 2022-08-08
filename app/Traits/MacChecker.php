<?php
namespace App\Traits;


trait MacChecker
{

    public function checkMac($user,$device_info)
    {     $mac["pass"]=true;
          $mac["status"]="old";
           $user_mac_adresses =$user->MAC_address;
          
        /**
         * check if user dont have mac address
         * added to him first mac address that he login
         */
        if (!$user_mac_adresses) {
           
            $this->addNewMac($user,$user_mac_adresses,$device_info);
            return $mac;

        }
        /**
         * search about registered mac for user
         */
        $user_mac_adresses = json_decode($user_mac_adresses, true);
        foreach ($user_mac_adresses as $user_mac) {
            if ($device_info["mac"] == $user_mac["mac"]) {
                return $mac;
            }
        }

      /**
      *check if user can login with diffrent mac
      */
        $user_company = $user->company;
        if ($user_company->mac_check) {
            $this->addNewMac($user,$user_mac_adresses,$device_info);
            $mac["status"]="new";
            return $mac;
        }
        $mac["status"]="new";
        $mac["pass"]=false;
        return $mac;

    }


    public function addNewMac($user,$user_mac_adresses,$device_info){
        $user_mac_adresses=$user_mac_adresses??[];
        array_push($user_mac_adresses,$device_info);
        $user->Mac_address =json_encode($user_mac_adresses);
        $user->save();
    }

}
