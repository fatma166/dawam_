

        <div class="table-responsive">
             <table class="table table-striped custom-table">
                  <thead>
                              
                                <th>#</th>
                                <th>{{ __('trans.Empolyee') }}</th>
                                <th>{{ __('trans.evaluation_month') }}</th>
                                <th>{{ __('trans.Evaluation_Year') }}</th>
                                <th>{{ __('trans.employe_job') }}</th> 
                                <th>{{ __('trans.employe_department') }}</th> 
                                <th>{{ __('trans.Branch') }}</th> 
                                <th>{{ __('trans.Total_evalaution') }}</th> 
                           
                  </thead>
                <tbody>
              
                     <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>
                            @foreach($monthly as $item)
                                <tr>
                                  <td class="text-center">{{ ($empevalu->currentPage() - 1)  * $empevalu->links()->paginator->perPage() + $loop->iteration }}</td> 
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
                                          {{-- @if(!empty($item['emp_degree'])) --}}
                                           <p><strong><small>{{round(($item['emp_degree']),2)}} % </small></strong></p>
                                         
                                            <div class="progress">
												<div class="progress-bar bg-primary" role="progressbar" style="width:{{($item['emp_degree'])}}%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100">
                                                  
                                                </div>
											</div>
                                            
                                            {{-- @endif --}}
                                          </td>
                                        
                                    </tr>
                          
                                @endforeach
                          
                </tbody>
            </table>
        </div>
       
  {{ $empevalu->appends($_GET)->links() }}