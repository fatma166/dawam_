<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Visits_question;
use App\Models\Visits_type;
use App\Models\Company;
use App\Models\User;
use Validator;
class VisitQuestionController extends BaseController
{
    //
        //
        function index($subdomain){
            $company=$this->company;
            $users=User::where('company_id',$company->id)->where('role_id','!=',1)->orWhereNull('role_id')->get();
            $visit_types=visits_type::where('company_id',$company->id)->get();
            $visits_question=Visits_question::select('visits_questions.*','visits_types.name')
                                            ->join('visits_types','visits_types.id', '=', 'visits_questions.visit_type_id')
                                            ->where('visits_types.company_id',$company->id)
                                            ->get();
          
            return view('outdoors.question',['visits_question'=>$visits_question,'visit_types'=>$visit_types,'subdomain'=>$subdomain]);
        }
        
        
        
        
        
        function store($subdomain,Request $request){
            $validator = Validator::make($request->all(), [
                'visit_type' => 'required',
                'que_type'=>'required',
                'question_text'=>'required'
               ]);
              
               
            if ($validator->passes()) {
                $data=$request->all();
               
                $choose1 =$data['choose1']?$data['choose1']:null;
                $choose2=$data['choose2']?$data['choose2']:null;
                $choose3=$data['choose3']?$data['choose3']:null;
                $choose4=$data['choose4']?$data['choose4']:null;
                $visit_question=Visits_question::create(array('visit_type_id'=>$data['visit_type'],'type'=>$data['que_type'],'question_text'=>$data['question_text'],'choose_1'=>$choose1,'choose_2'=>$choose2,'choose_3'=>$choose3,'choose_4'=>$choose4))->get();
        
                if(!is_null($visit_question)) {
                    
                    return response()->json(['success'=> ' added successfully.']);
                }
            }
                    // else return with error message
             else {
                        
                return response()->json(['error'=>$validator->errors()->all()]);
            }

        }
        public function edit($subdomain,$id){
            $Visits_question=Visits_question::where('id',$id)->get();
           
            return response()->json($Visits_question);
        }

        public function update($subdomain,Request $request, $id){
            $validator = Validator::make($request->all(), [
                'visit_type' => 'required',
                'que_type'=>'required',
                'question_text'=>'required'
   
               ]);
              
               
            if ($validator->passes()) {
                $company=$this->company;
                $Visits_question=$request->all();
                $visit_que=array('visit_type_id'=>$Visits_question['visit_type'],'type'=>$Visits_question['que_type'],'question_text'=>$Visits_question['question_text'],'choose_1'=>$Visits_question['choose1'],'choose_2'=>$Visits_question['choose2'],'choose_3'=>$Visits_question['choose3'],'choose_4'=>$Visits_question['choose4']);
            
                Visits_question::where('id',$id)->update($visit_que);
                
                return response()->json(['success'=> ' updated successfully.']);
            
            }
                    // else return with error message
            else {
                        
                return response()->json(['error'=>$validator->errors()->all()]);
            }
        }
        public function delete($subdomain,Request $request)
        {
            Visits_question::where('id',$request->id)->delete();
            return back()->with('success', 'Delete successfully.');
           
        }

        public function visit_question_search($subdomain,Request $request){
            $search=$request->all();
         
            $visit_type=$search['visit_type']?$search['visit_type']:'all';
            $type=$search['type']?$search['type']:'all';
            $company=$this->company;
            $users=User::where('company_id',$company->id)->where('role_id','!=',1)->orWhereNull('role_id')->get();
            $visit_types=visits_type::where('company_id',$company->id)->get();
            $visits_question=Visits_question::select('visits_questions.*','visits_types.name')
                                            ->join('visits_types','visits_types.id', '=', 'visits_questions.visit_type_id')
                                            ->where('visits_types.company_id',$company->id)
                                            ->Where(function($query) use ($visit_type,$type) {
                      
                                                if($type!='all'){
                                                    $query->where('visits_questions.type',$type);
                                                }
                                                if($visit_type!='all'){
                                                    $query->where('visits_questions.visit_type_id','=' ,$visit_type);
                                                }
                                        
                                                })
                                            ->get();
          
            return view('outdoors.question_search',['visits_question'=>$visits_question,'visit_types'=>$visit_types,'subdomain'=>$subdomain]);
        }
}
