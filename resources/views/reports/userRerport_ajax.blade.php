                <div class="col-md-12 userReport_result" >
                    <div class="table-responsive">
                          <h2 class="table-avatar">
                                                    
                               @if (isset($attendDaymonthly[$day_number][0]['name'])) {{$attendDaymonthly[$day_number][0]['name'] }} @endif
                          </h2>
                        <table class="table table-striped custom-table display nowrap" style="width:100%" >
                            <thead>
                                <th>#</th>
                                <th>{{ __('trans.time_in') }}</th>
                                <th>{{ __('trans.time_out') }}</th> 
                                <th>{{ __('trans.status') }}</th> 
                            </thead>
                            <tbody>
                          
                                @if (!empty( $attendDaymonthly))
                                    @foreach ($attendDaymonthly as $day=> $attendance)
                                   
                                        <tr>
                                            <td>{{$day}}</td>


                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                    @if (isset($attendance[0]['time_in'])) {{$attendance[0]['time_in']}} @endif
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                    @if (isset($attendance[0]['time_out'])) {{$attendance[0]['time_out'] }} @endif
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                    @if (isset($attendance[0]['status'])) {{$attendance[0]['status']}} @endif
                                                </h2>
                                            </td>                                  
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>