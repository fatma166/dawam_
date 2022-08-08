<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Visits_type;
use Illuminate\Http\Request;
USE App\Contracts\ErrorMessages;
class OutdoorQuestionController extends Controller
{
    //
    public function Index(Request $request, $id)
    {
  
        if (!$outdoorType = Visits_type::find($id)) {
            $data['msg']='no content';
            return response()->json(['msg' => ErrorMessages::OUTDOOR_QUESTION_INDEX_NO_CONTENT_ERROR], 400);
        }

        return $outdoorType->questions;
    }
    
       public function questions(Request $request, $id=null)
    {



        return $id?Visits_type::with("questions")->find($id):$request->user()->company->visitsQuestion()->with("questions")->get();
    }
}
