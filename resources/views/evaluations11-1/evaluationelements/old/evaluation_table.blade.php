                              
                                  <hr />   
                               <div class="row">
                                    
                                    <div class="col-sm-6 col-md-3"> 
                                            <div class="form-group form-focus " style="float: right;">
                                                <select class="select floating month" name="month"> 
                                                    
                                                        
                                                        @foreach($unevaluated_months as $index=> $month)
                                                        <option value="{{$index+1}}">{{$month}}</option>
                                                        @endforeach
                                                    
                                                </select>
                                              <label class="focus-label">{{__('trans.Select Month')}}</label>
                                          </div>
                                          
                                        </div>
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
                                                 @foreach($evaluation_keies as $eval)
										             
                                                         
                                                    	<tr>
                                                           <?php $i++; ?>
                                                           <td>{{ $i }}</td>
                                                          
        											        <td><input type="checkbox" checked="true" disabled="true" /></td>
                                                            <td>{{$eval['title']}}</td>
                                                            <td>{{$eval['degree']}}</td>
											                <td><input  type="number" id="degree_empval"  name="degree[{{$eval['id']}}]"  class="form-control" max="{{$eval['degree']}}" style="width:100px" required /></td>  
                                                           
                                                            <td><input  type="hidden"  name="evaljob_id" value="{{$eval['evaljob_id']}}" /></td>   
                                                            
                                                             <td><input  type="hidden" value="{{$eval['id']}}"  /></td>                                                         
        												</tr>
                                                        
										         @endforeach
                                           
                                                 
										
											</tbody>
										</table>
                                         <div class="submit-section">
                                       
									             	<button class="btn btn-primary" id="eval_empbtn">Save</button>
                                         
                                            </div>
									</div>
                                    </div>
                              
              

  

                                
           
                                