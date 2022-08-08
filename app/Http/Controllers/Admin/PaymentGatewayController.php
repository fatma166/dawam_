<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;

use App\Models\Company;

use App\Models\User;
  
use App\Models\Branch;

use App\Models\Department;

use App\Models\CompanyPlan;

use App\Models\Plan;
use Validator;



class PaymentGatewayController extends BaseController

{
    /**

     * Prepare the checkout.

     *

     * @return array($responseData)

     */
    
    public function index()
    
    {
        
       $responseData = request($amount,$currency); 
    }
    
    public function getCheckOutId(Request $request){


        $url = "https://eu-test.oppwa.com/v1/checkouts";
    	$data = "entityId=8a8294174b7ecb28014b9699220015ca" .
                    "&amount=92.00" .
                    "&currency=EUR" .
                    "&paymentType=DB";
    
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                       'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	$responseData = curl_exec($ch);
    	if(curl_errno($ch)) {
    		return curl_error($ch);
    	}
    	curl_close($ch);

         
        $res = json_decode($responseData,true);
        return response()->json($res);
       // $view = view('ajax.form')->with(['responseData' => $res , 'id' => $request -> offer_id])
           // ->renderSections();
      //  return( $res);

      /*  return response()->json([
            'status' => true,
            'content' => $view['main']
        ]);*/


    }
    
    function checkout_status($id){
      
    	$url = "https://eu-test.oppwa.com/v1/checkouts/".$id."/payment";
    	$url .= "?entityId=8a8294174b7ecb28014b9699220015ca";
    
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                       'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	$responseData = curl_exec($ch);
    	if(curl_errno($ch)) {
    		return curl_error($ch);
    	}
    	curl_close($ch);
        //print_r($responseData); exit;
       $res = json_decode($responseData, true);
       return response()->json($res);


        
    }

}