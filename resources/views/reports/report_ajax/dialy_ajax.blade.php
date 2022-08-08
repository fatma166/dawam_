
 <div class="col-md-12 dialy_result" >
        <div class="table-responsive">
            <table class="table table-striped custom-table display nowrap" style="width:100%" id="table_search">
                <thead>
                    <th>#</th>
                    <th>{{ __('trans.Empolyee') }}</th>
                    <th>{{ __('trans.time_in') }}</th>
                    <th>{{ __('trans.time_out') }}</th>
                    <th>{{ __('trans.date') }}</th> 
                    <th>{{ __('trans.department') }}</th> 
                    <th>{{ __('trans.branch') }}</th>
                     <th>{{ __('trans.time_zone') }}</th> 
                     @if($type!="absent")  
                    <th>{{ __('trans.details') }}</th>  
                    @endif
                </thead>
                <tbody>
                   <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

                    @if (!empty( $attendances))
                    <?php //print_r($attendances); exit;?>
                        @foreach ($attendances as $index=> $attendance)
                       
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>
                                    <h2 class="table-avatar">
                                        
                                    @if (isset($attendance['name'])) {{$attendance['name'] }} @endif
                                    </h2>
                                </td>

                                <td>
                                    <h2 class="table-avatar">
                                        
                                    @if (isset($attendance['time_in'])) {{$attendance['time_in'] }} @endif
                                    </h2>
                                </td>
                                <td>
                                    <h2 class="table-avatar">
                                        
                                    @if (isset($attendance['time_out'])) {{$attendance['time_out'] }} @endif
                                    </h2>
                                </td>
                                <td>
                                    <h2 class="table-avatar">
                                        
                                    @if (isset($attendance['Date'])) {{$attendance['Date'] }} @endif
                                    </h2>
                                </td>
                                 <td>
                                    <h2 class="table-avatar">
                                        
                                    @if (isset($attendance['dep_title'])) {{$attendance['dep_title'] }} @endif
                                    </h2>
                                </td>   
                                 <td>
                                    <h2 class="table-avatar">
                                        
                                    @if (isset($attendance['branch_title'])) {{$attendance['branch_title'] }} @endif
                                    </h2>
                                </td> 
                                <td>
                                        <h2 class="table-avatar">
                                            
                                        @if (isset($attendance['zone_name'])) {{$attendance['zone_name']}} @endif
                                        </h2>
                                </td>
                                @if($type!="absent")
                       			<td>
                                     
                                     <i class="fa fa-id-card-o" user_id="{{$attendance['EmployeeId']}}" date="{{$attendance['Date']}}"  data-toggle="modal" data-target="#attendance_info"></i>
								</td>
                                @endif   
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>