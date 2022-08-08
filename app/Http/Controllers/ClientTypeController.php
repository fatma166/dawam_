<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\client_type;

class ClientTypeController extends Controller
{
    //

    public function Index(Request $request,$id=null){

      return $id?client_type::find($id):client_type::all();
    }
}
