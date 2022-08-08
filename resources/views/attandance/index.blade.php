@extends('layout.mainlayout')
@section('title')
    {{__('trans.Attendance')}}
@endsection

@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">{{__('trans.Attendance')}}</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
									<li class="breadcrumb-item active">{{__('trans.Attendance')}}</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- Search Filter -->
					 <form method="post">
					<div class="row filter-row">
						<div class="col-sm-6 col-md-3">  
							<div class="form-group form-focus">
                            <select class="employee_name  form-control" name="employee_name"></select>
							<!--	<input type="text" class="form-control floating employee_name">-->
								<label class="focus-label">{{__('trans.Employee Name')}}</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select floating month"> 
									<option value="all">-</option>
									<option value="1">Jan</option>
									<option value="2">Feb</option>
									<option value="3">Mar</option>
									<option value="4">Apr</option>
									<option value="5">May</option>
									<option value="6">Jun</option>
									<option value="7">Jul</option>
									<option value="8">Aug</option>
									<option value="9">Sep</option>
									<option value="1-">Oct</option>
									<option value="11">Nov</option>
									<option value="12">Dec</option>
								</select>
								<label class="focus-label">{{__('trans.Select Month')}}</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3"> 
						<?php $min=(now()->year)-3;?>
							<div class="form-group form-focus select-focus">
								<select class="select floating year"> 
									<option value="all">-</option>
									
									@for($year=now()->year; $year>$min; $year--)
										<option value="{{$year}}">{{$year}}</option>
									@endfor
								</select>
								<label class="focus-label">{{__('trans.Select Year')}}</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">  
							<a  class="btn btn-success btn-block" id="search_attendance"> {{__('trans.Search')}} </a>  
						</div>     
                    </div>
					</form>
					<!-- /Search Filter -->
					<div id="attendance_data">
                    <div class="row">
                        <div class="col-lg-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table  ">
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
                                           
											<td>@if(!is_null($attendance['time_in'])&&!is_null($attendance['time_out']))<a href="javascript:void(0);"  user_id="{{$attendance['user_id']}}" day="{{$day}}"  data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check @if($attendance['status']=='Attendance_discount'){{'text-warning'}}@elseif($attendance['status']=='attend') {{'text-success'}}@elseif($attendance['status']=='absent'){{'text-danger'}}@endif"></i></a>@endif 
											@if(!is_null($attendance['time_in'])&& is_null($attendance['time_out']))
													<span class="first-off"><a href="javascript:void(0);" data-toggle="modal"  user_id="{{$attendance['user_id']}}" day="{{$day}}"  data-target="#attendance_info"><i class="fa fa-check @if($attendance['status']=='Attendance_discount'){{'text-warning'}}@elseif($attendance['status']=='attend') {{'text-success'}}@elseif($attendance['status']=='absent'){{'text-danger'}}@endif"></i></a></span> 
													<span class="first-off" style="float: left;margin-top: 28px !important;margin-right: -36px;"><i class="fa fa-close text-danger"></i></span>
											@endif
											@if(is_null($attendance['time_in'])&& !is_null($attendance['time_out']))
													<span class="first-off"><i class="fa fa-close text-danger"></i></span>
													<span class="first-off" style="float: left;margin-top: 28px !important;margin-right: -36px;"><a href="javascript:void(0);" data-toggle="modal" user_id="{{$attendance['user_id']}}" day="{{$day}}" data-target="#attendance_info"><i class="fa fa-check @if($attendance['status']=='Attendance_discount'){{'text-warning'}}@elseif($attendance['status']=='attend') {{'text-success'}}@elseif($attendance['status']=='absent'){{'text-danger'}}@endif"></i></a></span> 
													
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
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Attendance Modal -->
				<div class="modal custom-modal fade" id="attendance_info" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">{{__('trans.Attendance Info')}}</h5><h3 class="user_name_view"></h3>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-6">
										<div class="card punch-status">
											<div class="card-body">
												<h5 class="card-title">{{__('trans.Timesheet')}} <small class="text-muted"></small></h5>
												<div class="punch-det">
													<h6>{{__('trans.Punch In at')}}</h6>
													<p id="punch_in">dff</p>
												</div>
												<div class="punch-info">
													<div class="punch-hours">
														<span>00 hrs</span>
													</div>
												</div>
												<div class="punch-det">
													<h6 >{{__('trans.Punch Out at')}}</h6>
													<p id="punch_out"></p>
												</div>
											<div class="statistics">
													<div class="row">
														<div class="col-md-6 col-6 text-center">
															<div class="stats-box">
																<p>Break</p>
																<h6 class="break_value"> </h6>
															</div>
														</div>
														<div class="col-md-6 col-6 text-center">
															<div class="stats-box">
																<p>Overtime</p>
																<h6 class="overtime_value"></h6>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
										<div class="col-md-6">
										<div class="card recent-activity">
											<div class="card-body">
												<h5 class="card-title">{{__('trans.Activity')}}</h5>
												<ul class="res-activity-list">
													<li>
														<p class="mb-0">{{__('trans.Punch In at')}}</p>
														<p class="res-activity-time">
															<i class="fa fa-clock-o"></i>
															<div class="active_in"></div > 
												            <div class="punch-info">
																<div class="punch-img_in">
																	<span></span>
																</div>
														     </div>
														</p>
													</li>
													<li>
														<p class="mb-0">{{__('trans.Punch Out at')}}</p>
														<p class="res-activity-time">
															<i class="fa fa-clock-o"></i>
										                    <span class="active_out"></span > 
														    	<div class="punch-img_out">
																	<span></span>
																</div>
														</p>
													</li>
                                                    <li>
                                                       
                                                       
                                                        <span class="user_attend" style="display:none;"></span>
                                                        <span class="user_date" style="display:none;"></span>
                                                         <span class="user_date_search" style="display:none;"></span>
                                                      <!-- <div class="onoffswitch">
                											<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox change_attend_status" id="switch_custom01" value="on" checked="">
                											<label class="onoffswitch-label" for="switch_custom01">
                												<span class="onoffswitch-inner"></span>
                												<span class="onoffswitch-switch"></span>
                											</label>
        									           	</div>-->
                                                         <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label> <h5>{{__('trans.change_status')}}</h5></label>
                                                                
                                                                <select  class="dropdown-menu dropdown-menu-right change_attend_status" name="attend_status" style="display: block;">
                                                                    <option  class="dropdown-item" value="Attendance_discount"><i class="fa fa-dot-circle-o text-success"></i> {{__('trans.Attendance_discount')}}</option>
                                                                    <option  class="dropdown-item" value="attend"><a><i class="fa fa-dot-circle-o text-success"></i></a>{{__('trans.attend')}}</option>
                                                                    <option  class="dropdown-item" value="absent"><i class="fa fa-dot-circle-o text-danger"></i>{{__('trans.absent')}}</option>
                                                                </select>
                                                               
                                                            </div>

                                                        </div>
                                                    
                                                    </li>
                                                    
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Attendance Modal -->
				
            </div>
			<!-- Page Wrapper -->
@endsection