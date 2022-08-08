
  <div class="col-md-12 month_result" >
        <div class="table-responsive">
             <table class="table table-striped custom-table " id="table_search">
                <thead>
                    <th>#</th>
                    <th>{{ __('trans.Empolyee') }}</th>
                    <th>{{ __('trans.present days') }}</th>
                    <th>{{ __('trans.absent days') }}</th> 
                    <th>{{ __('trans.fixedholday') }}</th> 
                    <th>{{ __('trans.excepition holiday') }}</th>
                     <th>{{ __('trans.leave request') }}</th>
                     <th>{{ __('trans.leave hours request count') }}</th>
                      <th>{{ __('trans.avg logged hours') }}</th> 
                    <th>{{ __('trans.total logged hours') }}</th> 
                    <th>{{ __('trans.late count') }}</th> 
                    <th>{{ __('trans.total late coming') }}</th> 
                     <th>{{ __('trans.count early leave') }}</th> 
                    <th>{{ __('trans.total early leave') }}</th> 
                    <th>{{ __('trans.withoutbsma') }}</th> 
                    <th>{{ __('trans.addded client') }}</th>
                    <th>{{ __('trans.department') }}</th> 
                    <th>{{ __('trans.branch') }}</th> 
                       
                </thead>
                <tbody>
                <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

                    @if (!empty( $monthly))
                        @foreach ($monthly as $index=> $month)
                       
<tr>
                                            <td>{{$index+1}}</td>
                                            <td>
                                                <h2 class="table-avatar">      
                                                    
                                                   <a href="{{url('admin/userReport/'.$month['employeeId'])}}"  class="employee_detail">
                                                        <h2 class="table-avatar">
                                                            
                                                        @if (isset($month['name'])) {{$month['name'] }} @endif
                                                        </h2>
                                                    </a>
                                                </h2>
                                            </td>

                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                 @if (isset($month['present'])) {{$month['present'] }} @endif
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                @if (isset($month['absent'])) {{$month['absent'] }} @endif
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                @if (isset($month['fixed_holiday'])) {{$month['fixed_holiday'] }} @endif
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                @if (isset($month['exception_holiday'])) {{$month['exception_holiday'] }} @endif
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                @if (isset($month['leave_request_count'])) {{$month['leave_request_count'] }} @endif
                                                </h2>
                                            </td>
                                            
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                @if (isset($month['leave_request_hours_count'])) {{$month['leave_request_hours_count'] }} @endif
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                @if (isset($month['avg_hours_daily'])) {{$month['avg_hours_daily'] }} @endif
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                @if (isset($month['logged_time'])) {{$month['logged_time'] }} @endif
                                                </h2>
                                            </td>
                                          
                                           <td>
                                                <h2 class="table-avatar">
                                                    
                                                @if (isset($month['late_count'])) {{$month['late_count'] }} @endif
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                @if (isset($month['total_late_coming'])) {{$month['total_late_coming'] }} @endif
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                @if (isset($month['total_early_leave_count'])) {{$month['total_early_leave_count'] }} @endif
                                               
                                                </h2>
                                            </td>
                                             <td>
                                                <h2 class="table-avatar">
                                                    
                                                 @if (isset($month['total_early_leave'])) {{$month['total_early_leave'] }} @endif
                                               
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                 @if (isset($month['withoutBsma'])) {{$month['withoutBsma'] }} @endif
                                               
                                                </h2>
                                            </td> 
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                 @if (isset($month['clients'])) {{$month['clients'] }} @endif
                                               
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                 @if (isset($month['department'])) {{$month['department'] }} @endif
                                               
                                                </h2>
                                            </td>  
                                             <td>
                                                <h2 class="table-avatar">
                                                    
                                                 @if (isset($month['branch'])) {{$month['branch'] }} @endif
                                               
                                                </h2>
                                            </td>                             
                                        </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
   </div>
