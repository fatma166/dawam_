         <div class="row">
              <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered custom-table mb-0 ">
									<thead>
										<tr>
											<th>{{__('trans.Employee')}}</th>
											<?php $days= Carbon\Carbon::now()->daysInMonth?>
											@for($day=1;$day<=$days;$day++)
											<th>{{$day}}</th>
				                            @endfor
										</tr>
									</thead>
									<tbody>
									        <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

								
                                    @foreach($attendances as $attendancee)
									@if(!is_null($attendancee))
										<tr>
										@if(isset($attendancee[0]['name']))
											<td>
												<h2 class="table-avatar">
													<a class="avatar avatar-xs" href="#"><img alt="" src="{{asset('img/profiles/avatar-09.jpg')}}"></a>
													<a href="profile">{{$attendancee[0]['name']}}</a>
												</h2>
											</td>
										@endif	
										<?php $last_day=1;?>
										@foreach($attendancee as $i=>$attendance)
										@if(isset($attendance['name'])) 
                                               
										<?php
										 $count_loop=count($attendancee)-1;
										 $day_number=$attendance['created_at']->format('d');?>
										@for($day=$last_day;$day<=$days;$day++)
										@if(($attendance['type']!="out"))
										@if(($day==$day_number))
                                           
											<td>@if(!is_null($attendance['time_in'])&&!is_null($attendance['time_out']))<a href="javascript:void(0);"  user_id="{{$attendance['user_id']}}" day="{{$day}}"  date="{{$attendance['created_at']}}"  data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check @if($attendance['status']=='Attendance_discount'){{'text-warning'}}@elseif($attendance['status']=='attend') {{'text-success'}}@elseif($attendance['status']=='absent'){{'text-danger'}}@endif"></i></a>@endif 
											@if(!is_null($attendance['time_in'])&& is_null($attendance['time_out']))
													<span class="first-off"><a href="javascript:void(0);" data-toggle="modal"  user_id="{{$attendance['user_id']}}" day="{{$day}}" date="{{$attendance['created_at']}}"  data-target="#attendance_info"><i class="fa fa-check @if($attendance['status']=='Attendance_discount'){{'text-warning'}}@elseif($attendance['status']=='attend') {{'text-success'}}@elseif($attendance['status']=='absent'){{'text-danger'}}@endif"></i></a></span> 
													<span class="first-off" style="float: left;margin-top: 28px !important;margin-right: -36px;"><i class="fa fa-close text-danger"></i></span>
											@endif
											@if(is_null($attendance['time_in'])&& !is_null($attendance['time_out']))
													<span class="first-off"><i class="fa fa-close text-danger"></i></span>
													<span class="first-off" style="float: left;margin-top: 28px !important;margin-right: -36px;"><a href="javascript:void(0);" data-toggle="modal" user_id="{{$attendance['user_id']}}" day="{{$day}}" date="{{$attendance['created_at']}}"  data-target="#attendance_info"><i class="fa fa-check @if($attendance['status']=='Attendance_discount'){{'text-warning'}}@elseif($attendance['status']=='attend') {{'text-success'}}@elseif($attendance['status']=='absent'){{'text-danger'}}@endif"></i></a></span> 
													
											@endif
											@if(is_null($attendance['time_in'])&& is_null($attendance['time_out']))
											
													<span class="first-off"><i class="fa fa-close text-danger"></i></span>		
											@endif

											</td>

										   <?php $last_day=$day_number+1; ?> @if (($attendancee[$count_loop]['created_at']->format('d')==$day_number)&&($attendancee[$count_loop]['created_at']->format('d')<$days)) @else <?php break; ?>@endif
										 
										  
									         
									   @else
										      <td><span class="first-off"><i class="fa fa-close text-danger"></i></span></td>
									
                                        
										@endif
										@endif
										
										@endfor	
										@endif
										@endforeach
										</tr>
										@endif
									
									@endforeach
										
									</tbody>
								</table>
							</div>
         </div>
         
    </div>
     {{ $users->appends($_GET)->links()}}
     