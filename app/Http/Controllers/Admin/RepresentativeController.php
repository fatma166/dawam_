<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Representative;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Validator;
class RepresentativeController extends BaseController
{

    function index($subdomain)
    {
        $company = $this->company;
        //  $users=User::where('company_id',$company->id)->where('role_id','!=',1)->orWhereNull('role_id')->get();
        $representative = Representative::where('representatives.company_id', $company->id)->get();

        return view('representative.index', ['representatives' => $representative,'subdomain'=>$subdomain]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($subdomain,Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => 'required', 'enroll' =>
            'required', 'balance' => 'required', 'description' => 'required']);

      
        if ($validator->passes())
        {
            $representative_request= $request->all();
            
            $company = $this->company;
          


            $representative= Representative::create(array(
                    'company_id' => $company->id,
                    'name' => $representative_request['name'],
                    'enroll_date' => $representative_request['enroll'],
                    'balance' =>$representative_request['balance'],
                    'description' => $representative_request['description']));
                   


                if (!is_null( $representative))
                {

                    return response()->json(['success' => 'added successfully.']);
                    
                }
  
        } else
        {
            return response()->json(['error' => $validator->errors()->all()]);
        }

    }

    public function status($subdomain,Request $request)
    {

        $representative= Representative::where('id', $request->id)->update(array('status' => $request->
                status));
        if ( $representative > 0)
        {
            return back()->with('success', ' status changed successfully.');
        } else
        {
            return back()->with('error', 'messages.error');
        }

    }

    public function edit($subdomain,$id)
    {
         $representative =  Representative::where('id', $id)->get();

        return response()->json( $representative);
    }

    public function update($subdomain,Request $request, $id)
    {
            $validator = Validator::make($request->all(), ['name' => 'required', 'enroll' =>
            'required', 'balance' => 'required', 'description' => 'required']);


        if ($validator->passes())
        {
            $representative_request = $request->all();
            $company = $this->company;
            $representative=array(
                    'company_id' => $company->id,
                    'name' => $representative_request['name'],
                    'enroll_date' => $representative_request['enroll'],
                    'balance' =>$representative_request['balance'],
                    'description' => $representative_request['description']);
                    print_r($representative_request);
            Representative::where('id', $id)->update($representative);
            //return response()->json(['success' => ' updated successfully.']);
        } else
        {
            //return response()->json(['error' => $validator->errors()->all()]);
        }

    }
    public function delete($subdomain,Request $request)
    {
        Representative::where('id', $request->id)->delete();
        return back()->with('success', 'Delete successfully.');

    }
   


}
