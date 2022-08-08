                              
                                  <hr />   
                               <div class="row">
                                    
                                        <h5 class="modal-title">{{$user->name}}      </h5>
                                        <input type="hidden" name="user_id" value="{{$user->id}}" />
                                        <input type="hidden" name="month" value="" />
                                        <input type="hidden" name="year" value="" />
                                        <br />
                                       
                                   
                                       <div class="table-responsive m-t-15">
										<table class="table table-striped custom-table was-validated" id="evaluation_emptable">
											<thead>
												<tr>
                                                    <th>#</th>
                                                     <th></th>
                                                    <th>{{__('trans.Element')}}</th>
											        <th>{{__('trans.degree_evaluation')}}</th>
            	                                  	<th>{{__('trans.employe_degree')}}</th>
												</tr>
											</thead>
											<tbody>
                                                 <?php $i=0; ?>
                                                 @php $total=0; @endphp
                                                 @foreach($evaluation_keies as $eval)
                                                   
                                                    	<tr>
                                                           <?php $i++; ?>
                                                           <td>{{ $i }}</td>
                                                          
        											        <td><input type="checkbox" checked="true" disabled="true" /></td>
                                                            <td>{{$eval['title']}}</td>
                                                            <td>
                                                               {{$eval['degree']}}
                                                                <input type="hidden" name="basic_degree[{{$eval['id']}}]" value="{{$eval['degree']}}" />
                                                            </td>
											                <td><input  type="number" id="degree_empval"  name="degree[{{$eval['id']}}]"  class="form-control emp_degree" max="{{$eval['degree']}}"  min="0" style="width:100px" required /></td>  
                                                           
                                                            <td><input  type="hidden"  name="evaljob_id" value="{{$eval['evaljob_id']}}" /></td>   
                                                            
                                                             <td><input  type="hidden" value="{{$eval['id']}}"  /></td>                                                         
        												</tr>
                                                        @php $total +=$eval['degree']; @endphp  
										         @endforeach
                                           
                                               
										
											</tbody>
										</table>
                                          <hr />
                                          
                                               
                                                    
                                              <h5 style="color: red;">{{__('trans.Basic_Total_Degree')}}</h5>
                                              	 <input  type="number" id="basic_empval" disabled  class="form-control" 
                                                          style="width:100px" required value="{{$total}}"/>  
                                                    <h5 style="color: red;">{{__('trans.employe_Total_Degree')}}</h5>
                                             <input  type="number" id="degree_empval"  disabled  class="form-control emp_total_degree"  style="width:100px" required value="0" />  
                                                                                                               
        									
                                                   	
                                                        
										      
                                           
                                               
										
										
                                         <div class="submit-section">
                                       
									             	<button class="btn btn-primary" id="eval_empbtn">Save</button>
                                         
                                            </div>
									</div>
                                    </div>
                              
              

  

                                
           
                                