
   <div class="row">
                                    
      <input type="hidden" name="user_id" value="{{$evaluationemploye->user_id}}" />
      <input type="hidden" name="year" value="{{$evaluationemploye->year}}" />
       <input type="hidden" name="month" value="{{$evaluationemploye->month}}" />
      <input type="hidden" name="jobevaluation_id" value="{{$evaluationemploye->evalution_jobs_id}}" />
       <h3>{{$evaluationemploye->users->name}}</h3>
       <hr />
      <h3>Month: {{date("M",mktime(0,0,0,$evaluationemploye->month))}}</h3>
	<div class="table-responsive m-t-15">
            <table class="table table-striped custom-table was-validated">
               <thead>
                     <tr>
            						 <th></th>
                                     <th>#</th>
                                      <th class="text-center">{{__('trans.Element')}}</th>
            						  <th class="text-center">{{__('trans.degree_evaluation')}}</th>
                                      <th  class="text-center">{{__('trans.employe_degree')}}</th>
                                 						
                     </tr>
               </thead>
                <tbody>
                                             <?php $i=0 ?>     
                                             @php $total=0; @endphp 
                                             @php $element_total_degree=0; @endphp       
                                        	@foreach($evaluation_keies as $empeval)
                    								<tr>
                    									 <?php $i++ ?>
                                                         <td class="text-center"><input type="checkbox"  checked="true"  disabled   /></td>
                                                          	<td class="text-center">{{$i}}</td>
                                                                       
                                                             <td class="text-center"> {{$empeval['eleme_title']}}</td>
                                                              <td class="text-center"> {{$empeval['job_degree']}}</td>           
                                 	                         <td class="text-center">
                                                                        <input  type="number"  id="degree[]"   name="degree[{{$empeval['elment_id']}}]"
                                                                           value="{{$empeval['emp_degree']}}" class="form-control degree" style="width:100px" max="{{$empeval['job_degree']}}"  min="0" required="" />
   										 	                             <input type="hidden" name="basic_degree[{{$empeval['elment_id']}}]" value="{{$empeval['job_degree']}}" />
                                                                </td>
                                                             
                    										
                                                             	    
              										</tr>
                    								 @php $total += $empeval['emp_degree']; @endphp
                                                     @php $element_total_degree += $empeval['job_degree']; @endphp			
            								 @endforeach
                                             
                                                                 
	              </tbody>
            	</table>
                <hr />
                 
                  <h5 style="color: red;">{{__('trans.employe_Total_Degree')}}</h5>
                  <input  type="number" disabled class="form-control total_sum_value"
                                                               style="width:100px" min="0" value="{{$total}}" />
                   <h5 style="color: red;">{{__('trans.Basic_Total_Degree')}}</h5>
                 <input  type="number" disabled class="form-control"
                                                               style="width:100px" min="0" value="{{$element_total_degree}}" />
        </div>
        
           </div>