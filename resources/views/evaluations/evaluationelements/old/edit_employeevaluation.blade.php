
   <div class="row">
                                    
      <input type="hidden" name="user_id" value="{{$evaluationemploye->user_id}}" />
      <input type="hidden" name="year" value="{{$evaluationemploye->year}}" />
      <input type="hidden" name="jobevaluation_id" value="{{$evaluationemploye->evalution_jobs_id}}" />
       <h3>{{$evaluationemploye->users->name}}</h3>
       <hr />
       <div class="col-sm-6 col-md-3"> 
          <div class="form-group form-focus " style="float: right;">
                    <select class="select floating month" name="month"> 
                                                    
                                                        
                              @foreach($unevaluated_months as $index=> $month)
                                   <option value="{{$index+1}}" {{$evaluationemploye->month==$index+1?'selected':''}}>{{$month}}</option>
                               @endforeach
                                                    
                    </select>
            <label class="focus-label">{{__('trans.Select Month')}}</label>
         </div>
                                          
   </div>
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
                                        	@foreach($evaluation_keies as $empeval)
                    								<tr>
                    									 <?php $i++ ?>
                                                         <td class="text-center"><input type="checkbox"  checked="true"  disabled   /></td>
                                                          	<td class="text-center">{{$i}}</td>
                                                                       
                                                             <td class="text-center"> {{$empeval['eleme_title']}}</td>
                                                              <td class="text-center"> {{$empeval['job_degree']}}</td>           
                                 	                         <td class="text-center"> 
                                                                        <input  type="number"  id="degree[]"   name="degree[{{$empeval['elment_id']}}]"
                                                                           value="{{$empeval['emp_degree']}}" class="form-control degree" style="width:100px" max="{{$empeval['job_degree']}}" />
                                                                 
                  										 	 </td>
                                                             
                    												    
              										</tr>
                    											
            								 @endforeach
                                                                 
            			</tbody>
            	</table>
        </div>
        
           </div>