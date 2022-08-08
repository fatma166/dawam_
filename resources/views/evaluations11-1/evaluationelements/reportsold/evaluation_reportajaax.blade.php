
  <div class="col-md-12 month_result" >
        <div class="table-responsive">
             <table class="table table-striped custom-table datatable" id="quiztable">
                  <thead>
                                <th>#</th>
                                   <th></th>
                                    <th>{{ __('trans.Title') }}</th>
                                    @if(Auth::user()->role_id==2)
                                         <th>{{ __('trans.Company Title') }}</th>
                                    @endif
                                    <th>{{ __('trans.evaluation_month') }}</th>
                                    <th>{{ __('trans.Evaluation_Year') }}</th>
                                    <th>{{ __('trans.employe_job') }}</th>
                                      <th>{{ __('trans.employe_department') }}</th>
                                    <th>{{ __('trans.Branch') }}</th>
                                    <th>{{ __('trans.Total_evalaution') }} </th>
                           
                  </thead>
                <tbody>
              
                   <?php $i=0; ?>
                          
                          @foreach($evalarray as $item)
                             <?php $i++; ?>                           
                                <tr>
                                    <td>{{$i}}</td>
                                    <td><input type="checkbox" checked="true" disabled="true" /></td>
                                      <td>
                                            <h2 class="table-avatar">
                                                  <a class="dropdown-item" href="{{ url('admin/branch-edit/') }}"
                                                       data-href="{{ url('admin/evaluationemplpye-edit/') }}" empevalution-id="" data-toggle="modal" data-target="#edit_empevalaution"
                                                       ><span>{{$item['user_name']}} </span></a>
                                          
                                            </h2> 
                                        </td>
                                         
                                        <td>
                                        {{date("M",mktime(0,0,0,$item['month']))}}
                                        <input type="hidden" value="{{$item['month']}}" name="month"/>
                                        
                                        </td>
                                        <td>
                                         {{$item['year']}}
                                           <input type="hidden" value="{{$item['year']}}" name="year"/>
                                         </td>
                                        
                                        <td>{{$item['job']}}</td> 
                                         <td>{{$item['department']}}</td>
                                          <td>{{$item['branch']}}</td>
                                          <td>
                                          @if(!empty($item['emp_degree']))
                                           <p><strong><small>{{round(($item['emp_degree']/$item['evaluation_degree'])*100,2)}} % </small></strong></p>
                                          
                                            <div class="progress">
												<div class="progress-bar bg-primary" role="progressbar" style="width:{{($item['emp_degree']/$item['evaluation_degree'])*100}}%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100">
                                                  
                                                </div>
											</div>
                                            
                                            @endif
                                          </td>
                                        
                                    </tr>
                          
                                @endforeach
                          

                </tbody>
            </table>
        </div>
   </div>
