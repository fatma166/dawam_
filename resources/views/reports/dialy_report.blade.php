@extends('layout.mainlayout')
@section('title')
    {{__('trans.report-dialy')}}
@endsection
@section('content')
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{ __('trans.Companies') }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                            <li class="breadcrumb-item active">  @if($type=="present"){{__('trans.Print Present')}} @endif  @if($type=="absent") {{__('trans.Print Absent')}} @endif   @if($type=="late"){{__('trans.Print late_comers')}} @endif @if($type=="early"){{__('trans.Print early leave')}} @endif  @if($type=="total"){{__('trans.Print total day')}} @endif</li>
                        </ul>
                    </div>
                    

                </div>
            </div>
            <!-- /Page Header -->

				
           <div class="row"></div>

                
                             <!-- Search Filter -->
                <form >
                    <div class="row filter-row">
                        @if($type!="absent")
                        <div class="col-sm-2 col-md-2"> 
                            
                            <div class="form-group form-focus ">
                                    
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_from"></div>
                                    <label class="focus-label">{{__('trans.Select Date From')}}</label>
                            </div>

                        </div>
                        <div class="col-sm-2 col-md-2"> 
                        <?php // $min=(now()->year)-3;?>
               
                                <div class="form-group form-focus">
                                   
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_to"></div>
                                    <label class="focus-label">{{__('trans.Select Date To')}}</label>
                                </div>
                                
                        </div>
                        @endif
                         <div class=" @if($type!='absent') col-sm-2 col-md-2 @elseif($type=='absent')col-sm-3 col-md-3 @endif"> 
                            <div class="form-group form-focus ">
                                <select class="select floating department" > 
                                 <option value="all">{{__('trans.all')}}</option>
                                    @foreach($departments as $dep)         
                                    <option value="{{$dep->id}}">{{$dep->title}}</option>
                                   @endforeach
                                </select>
                                <label class="focus-label">{{__('trans.Select Department')}}</label>
                            </div>


                        </div>
                        <div class="@if($type!='absent') col-sm-2 col-md-2 @elseif($type=='absent')col-sm-3 col-md-3 @endif"> 
                            <div class="form-group form-focus ">
                                <select class="select floating branch"> 
                                     <option value="all">{{__('trans.all')}}</option>
                                    @foreach($branchs as $branch)
                                    <option value="{{$branch->id}}">{{$branch->title}}</option>
                                   @endforeach
                                </select>
                                <label class="focus-label">{{__('trans.Select Branch')}}</label>
                            </div>
   

                        </div>
                        
                        <div class="@if($type!='absent') col-sm-2 col-md-2 @elseif($type=='absent')col-sm-3 col-md-3 @endif"> 
                            <div class="form-group form-focus ">   
                            <select class="employee_name  form-control" name="employee_name"></select>  
                                <!--<select class="select floating employee"> 
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                                   @endforeach
                                </select>-->       
                                <label class="focus-label">{{__('trans.Select Employee')}}</label>
                            </div>


                        </div>
                        <div class="@if($type!='absent') col-sm-2 col-md-2 @elseif($type=='absent')col-sm-3 col-md-3 @endif">  
                            <a  class="btn btn-success btn-block" id="search_daily"> {{__('trans.Search')}} </a>  
                        </div>     
                    </div>
                    <input type="hidden" name="type_daily" value="{{$type}}" />
                </form>

                <!-- /Search Filter -->
            <!-- print button -->
            <div class="row">
                @if($type=="present")
                    <div class="col-2">
                        <a href="{{url('admin/dialyPrint/present')}}" class="btn btn-primary shift-continue-btn" id="daily_printlink"  target="_blank">{{__('trans.Print Present')}}</a>
                    </div>
                @endif
                @if($type=="absent")
                    <div class="col-2">
                        <a href="{{url('admin/dialyPrint/absent')}}" class="btn btn-primary shift-continue-btn" id="daily_printlink" target="_blank">{{__('trans.Print Absent')}}</a>
                    </div>
                 @endif
                @if($type=="late")
                    <div class="col-2">
                        <a href="{{url('admin/dialyPrint/late')}}" class="btn btn-primary shift-continue-btn" id="daily_printlink" target="_blank">{{__('trans.Print late_comers')}}</a>
                    </div>
                 @endif
                @if($type=="early")
                    <div class="col-2">
                        <a href="{{url('admin/dialyPrint/early')}}" class="btn btn-primary shift-continue-btn" id="daily_printlink" target="_blank">{{__('trans.Print early leave')}}</a>
                    </div>
                 @endif
                @if($type=="total")
                    <div class="col-2">
                        <a href="{{url('admin/dialyPrint/total')}}" class="btn btn-primary shift-continue-btn" id="daily_printlink" target="_blank">{{__('trans.Print total day')}}</a>
                    </div>
                @endif

                
                
           </div>
         
            <div class="row" id="basic_" >
                  @include('reports.report_ajax.dialy_ajax')
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
															<span class="active_in"></span > 
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
										                    <span class="active_out"></span ><span>{{__('trans.lat')}}</span></span > 
														    	<div class="punch-img_out">
																	<span></span>
																</div>
														</p>
													</li>
                                                    <li>
                                                       
                                                       
                                                        <span class="user_attend" style="display:none;"></span>
                                                        <span class="user_date" style="display:none;"></span>
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
@endsection
