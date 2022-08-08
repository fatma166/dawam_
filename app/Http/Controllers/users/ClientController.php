<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;
use App\Models\Referance_key;
use App\Library\NotificationManager;
use App\Library\Error;
use App\Library\ThirdApi;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
USE App\Contracts\ErrorMessages;
class ClientController extends Controller
{

      public function Index(Request $request,$id=null){

        $company=$request->user()->company;
        // return response()->json($company->id);
 
       $name=$request->name??null;
       $specialization=$request->specialization_id??null;
       $client_type=$request->client_type_id??null;
       $branch=$request->branch_id??null;

       $clients_data=$id?Client::select('clients.*','client_types.name as client_type_name','specializations.name as specialization_name',DB::raw('Count(outdoors.id)) as outdoor_count'))
               ->join('client_types','client_types.id','=','clients.client_type_id')
               ->leftjoin('specializations','clients.specialization_id','=','specializations.id')
        /*        ->join('specializations', function ($join) {
            $join->on('specializations.id', '=', 'clients.specialization_id')
                 ->orwhere('clients.specialization_id', '=',0);
        })*/
                ->leftJoin('outdoors','outdoors.customer_id','=','clients.id')
               ->find($id):$request->user()->branch->clients()
               ->select('clients.*','client_types.name as client_type_name','specializations.name as specialization_name',DB::raw('Count(outdoors.id) as outdoor_count'))
               ->join('client_types','client_types.id','=','clients.client_type_id')
               ->leftJoin('specializations','specializations.id','=','clients.specialization_id')
               ->leftJoin('outdoors','outdoors.customer_id','=','clients.id')
               ->where('clients.company_id',"=",$company->id)
               ->Where(function($query) use ($name,$specialization,$client_type,$branch)
               {
                if($name!=null)
                {
                   $query->where("clients.name",'like','%'.$name.'%')->orWhere("en_name",'like','%'.$name.'%');
                //    $query->where("clients.name",$name)->orWhere("en_name",$name);

                }
               /* if($specialization!=null)
                {
                   $query->where("clients.specialization_id",$specialization);
                    
                }*/
                if($client_type!=null)
                {
                   $query->where("clients.client_type_id",$client_type);
                }
                if($client_type!=null)
                {
                   $query->where("clients.client_type_id",$client_type);
                }
                if($branch!=null)
                {
                   $query->where("clients.branch_id",$branch);
                }
                 
               })->groupBy('clients.id')->get()->toArray();



            //    ->when($name,function($query)use ($name)
            //    {
            //     return $query->where("clients.name",$name)->orWhere("en_name",$name);
            //    })->get()->toArray();




       if(empty($clients_data)) return(array());
       $clients_data=$this->formatData($clients_data);
      // return response()->json($clients_data);
       return ($clients_data);
        
    }
    public function formatData($clients_data){
    
             foreach($clients_data  as  $index=>$client_data){
               
                    foreach($client_data as $key=>$client_val){
                        
                        if($client_val==null){
                            $clients_data[$index][$key]="";
                            
                        }
                        if($client_val==null&&($key=='lati'||$key=="longi")){
                           $clients_data[$index][$key]=0; 
                        }
                    
                        }
             }

       return($clients_data);

    }
    public function Create(Request $request){

        $req = Validator::make($request->all(), [
            'name' => 'required',
          //  'en_name' => 'required',
            'phone' => 'required|digits:11',
           // 'email' => 'required|email',
           // 'start_time' => 'required|date_format:H:i:s',
           // 'end_time' => 'required|date_format:H:i:s|after:start_time',
            'address' => 'nullable',
            'lati' => 'required',
            'longi' => 'required',
            'client_key' => 'required|nullable',
           // 'contact_phone' => 'required',
          //  'contact_person' => 'required',
            'client_type_id' => 'required|exists:client_types,id',
          //  'building_info' => 'nullable',
            'specialization_id' => 'nullable',


        ]);
      // print_r($request->all()); exit;
        if ($req->fails()) {
          //  return response()->json(['msg' => ErrorMessages::CLIENT_CREATE_VALIDATION_ERROR], 422);
            
       
         $messages=$req->messages();
           
           if($messages->has('lati')||$messages->has('longi')){
                    
                    return response()->json(['msg' => ErrorMessages::CLIENT_CREATE_LOCATION_VALIDATION_ERROR], 422);
              } elseif ($messages->has('address')) {
                     
                      return response()->json(['msg' => ErrorMessages::CLIENT_CREATE_ADDRESS_VALIDATION_ERROR], 422);
             }elseif ($messages->has('client_key')){
                      
                      return response()->json(['msg' => ErrorMessages::CLIENT_CREATE_CLIENT_KEY_VALIDATION_ERROR], 422);
              }elseif ($messages->has('client_type_id')){
                     
                       return response()->json(['msg' => ErrorMessages::CLIENT_CREATE_CLIENT_TYPE_VALIDATION_ERROR], 422);
              }elseif ($messages->has('specialization_id')){
                      
                     return response()->json(['msg' => ErrorMessages::CLIENT_CREATE_SPECIALIZATION_ID_VALIDATION_ERROR], 422);
              }else{
                     
                      return response()->json(['msg' => ErrorMessages::CLIENT_CREATE_VALIDATION_ERROR], 422);
              } 
        }
        $validated_data=$request->all();
        $validated_data["company_id"]=$request->user()->company->id;
        $validated_data["client_type_id"]=$request->client_type_id;
        $validated_data["branch_id"]=$request->user()->branch->id;
        $validated_data["address"]=$request->address??ThirdApi::ParceCoordinate($validated_data['lati'],$validated_data['longi']);
        
        if(isset($request->specialization_id))$validated_data["specialization_id"]=$request->specialization_id;
        else 
        $validated_data["specialization_id"]=null;
       
          
        $validated_data["appointments"]=json_encode($request->appoint);
        $validated_data['user_id']=$request->user()->id; 
        $client=Client::create($validated_data);

        if($request->client_key!='null'&&$request->client_key!=null){
           
            $referance_key['referance_key']=$request->client_key;
            $referance_key['type']="client";
            $referance_key['actual_id']=$client['id'];
            $referance_key['user_id']=$request->user()->id;
            Referance_key::create($referance_key);
        }
        $NotificationManager=new NotificationManager();
        $NotificationManager->build($client->id,"add_client",$request);
        $NotificationManager->commit();

        $data['msg']="success";
        return response()->json($data, 200);


    }


    public function Edit(Request $request,NotificationManager $NotificationManager,$id){
        $client=Client::findOrFail($id);
       // return response()->json(['client'=> $client]);
        $req = Validator::make($request->all(), [
            'phone' => 'digits:11|nullable',
            'email' => 'email|nullable',
            'contact_phone' => 'nullable',
            'contact_person' => 'nullable',
            'building_info' => 'nullable',
            'specialization_id'=>'nullable',
          ]);

        if ($req->fails()) {
            return response()->json(['msg' => ErrorMessages::CLIENT_EDIT_VALIDATION_ERROR], 422);
        }

       // return response()->json($request->specialization_id);
        $client->phone=$request->phone??$client->phone; 
        $client->email=$request->email??$client->email;
        $client->contact_phone=$request->contact_phone??$client->contact_phone;
        $client->contact_person=$request->contact_person??$client->contact_person;
        $client->building_info=$request->building_info??$client->building_info;
        if(isset($request->specialization_id))$client->specialization_id=$request->specialization_id;
        $request->request->add(["addtion_data"=>json_encode($client)]);
       
        $NotificationManager->build($client->id,"edit_client",$request);
        $NotificationManager->commit();

        $data['msg']="success";
         return response()->json($data, 200);


    }
}
