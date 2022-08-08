@extends('layout.mainlayout')

@section('title')
   {{__('trans.Visit Report')}}
@endsection
@section('content')
	<!-- Page Wrapper -->
    <div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">{{__('trans.Report')}}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                                <li class="breadcrumb-item active">{{__('trans.Visit Report')}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <!-- Search Filter -->
                <form>
                    <div class="row filter-row" id="visit_report">
                       <div class="col-sm-6 col-md-2"> 
                            <div class="form-group form-focus ">
                                <select class="select floating branch" name="branch"> 
                                     <option value="all">{{__('trans.all')}}</option>
                                    @foreach($branchs as $branch)
                                    <option value="{{$branch->id}}">{{$branch->title}}</option>
                                   @endforeach
                                </select>
                                <label class="focus-label">{{__('trans.Select Branch')}}</label>
                            </div>


                        </div>
                       <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">
                            <div class="form-group form-focus">
                              <select class="employee_name  form-control" name="user_id"></select>
                                <!--<input type="text" class="form-control floating employee_name"  />-->
                                <label class="focus-label">{{__('trans.Employee Name')}}</label>
                            </div>
                       </div>
                       <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">
                                    <div class="form-group form-focus select-focus">
                                     
                                        <select class="client_name_branch  form-control" name="customer_id"></select>   
                                        <label class="focus-label">{{__('trans.Target Client')}}</label>                         
                                    </div>
                       </div>
                       <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">
                            <div class="form-group form-focus select-focus">
                                <select class="select floating visit_types" name="visit_types"> 
                                    <option value="all">-- Select --</option>
                                    @foreach($visit_types as $visit_type)
                                        <option value="{{$visit_type->id}}">{{$visit_type->name}}</option>
                                    @endforeach

                                </select>
                                <label class="focus-label">{{__('trans.Visit types')}}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2">  
                            <div class="form-group form-focus">
                                <div class="cal-icon">
                                    <input class="form-control floating datetimepicker from" type="text">
                                </div>
                                <label class="focus-label">{{__('trans.From')}}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2">  
                            <div class="form-group form-focus">
                                <div class="cal-icon">
                                    <input class="form-control floating datetimepicker to" type="text">
                                </div>
                                <label class="focus-label">{{__('trans.to')}}</label>
                            </div>
                        </div>
                      <div class="col-sm-6 col-md-2"> 
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
                       <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">
                            <div class="form-group form-focus select-focus">
                                <select class="select floating created_by" name="created_by">
                                     <option value="all">  {{__('trans.-- Select --')}} </option>
                                     <option value="admin"> {{__('trans.Admin')}} </option>
                                     <option value="employee"> {{__('trans.Employee')}} </option>
                                </select>
                                <label class="focus-label">{{__('trans.created_by')}}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12"> 
                            <div class="form-group form-focus select-focus">
                                <select class="select floating status" name="status" > 
                                    <option value="all"> {{__('trans.-- Select --')}} </option>
                                    <option value="pending"> {{__('trans.Pending')}} </option>
                                    <option value="done"> {{__('trans.Done')}} </option>
                                    <option value="in_progress"> {{__('trans.in_progress')}}</option>
                                    <option value="seen"> {{__('trans.seen')}}</option>
                                </select>
                                <label class="focus-label">{{__('trans.Status')}}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2"> 
                            <div class="form-group form-focus ">
                                <select class="select floating is_registered" name="is_registered"> 
                                     <option value="all">{{__('trans.all')}}</option>
                                   
                                     <option value="1">{{__('trans.done')}}</option>
                                     <option value="0">{{__('trans.No')}}</option>
                                </select>
                                <label class="focus-label">{{__('trans.is_registered')}}</label>
                            </div>


                        </div>
                       <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">
                            <a href="#" class="btn btn-success btn-block" id="search_visit_report"> {{__('trans.Search')}} </a>  
                        </div>     
                    </div>
                </form>
                <!-- /Search Filter -->
               <div class="row">
                    <div class="col-2">
                        <a href="{{url('admin/visitPrint/visit')}}" class="btn btn-primary shift-continue-btn" id="visit_printlink">{{__('trans.Print visit Report')}}</a>
                    </div>
                </div>
                <div class="visit_report_data">

                    @include('outdoor_report.search')
                  
                </div>
            </div>
            <!-- /Page Content -->
          <!-- OUT DOOR INFO Modal -->
				<div class="modal custom-modal fade" id="visit_info" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">{{__('trans.Visit Report')}} </h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						<!--	<div class="col-md-12">
                                <div class="card punch-status">
                                    <div class="card-body">
                                    
                                        <div class="body_report_client">
                                          <h1></h1>  <h1 class="client_name"></h1>
                                            <h3 class="client_address"></h3>
                                            <h3 class="contact_phone"></h3>

                                        </div>
                                    </div>
                                </div>
                            </div>-->
            <div class="col-md-12">
                <div class="card punch-status">
                  <h1>{{__('trans.client info')}}</h1>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 body_report_client">
									<div class="profile-view">
										<div class="profile-img-wrap">
											<div class="profile-img">
                                            <div class="my-circle" title="" style=" width: 100px;
                                                                                      height: 100px;
                                                                                      border-radius: 50%;
                                                                                      background: #512DA8;
                                                                                      font-size: 35px;
                                                                                      color: #000;
                                                                                      text-align: center;
                                                                                      line-height: 150px;
                                                                                      
                                                                                      margin: 20px 0;"></div>
                                             <div class="name client_name"></div>
											  <!--	<a href="">
													<img src="assets/img/profiles/avatar-19.jpg" alt="">
												</a>-->
											</div>
										</div>
										<div class="profile-basic">
											<div class="row">
												<div class="col-md-5">
													<div class="profile-info-left">
														<h3 class="user-name m-t-0 client_name"></h3>
														<h5 class="company-role m-t-0 mb-0 branch_title"></h5>
														<small class="text-muted client_phone"></small>
														
													
													</div>
												</div>
												<div class="col-md-7">
													<ul class="personal-info">
                                                    	<li>
															<span class="title">{{__('trans.user')}}:</span>
															<span class="text user_name"></span>
                                                            <br />
														</li>
														<li>
															<span class="title">{{__('trans.Contact Phone')}}:</span>
															<span class="text contact_phone"><a href=""></a></span>
                                                            <br />
														</li>
														<li>
															<span class="title">{{__('trans.Email')}}:</span>
															<span class="text client_email"><a href=""></a></span>
                                                            <br />
														</li>

														<li>
															<span class="title">{{__('trans.Address')}}:</span>
															<span class="text client_address"></span>
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
                    </div>
                            <div class="col-md-12">
                                <div class="card punch-status">
                                   <h1>{{__('trans.question info')}}</h1>
                                    <div class="card-body">
                                    
                                        <div class="body_report"></div>
                                    </div>
                                </div>
                            </div>

                                <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card punch-status">
                                            <div class="card-body">
                                                <h5 class="card-title">{{__('trans.Timesheet')}} <small class="text-muted"></small></h5>
                                                <div class="punch-det">
                                                    <h6>{{__('trans.Punch In at')}}</h6>
                                                    <p id="punch_in"></p>
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
                                                <h5 class="card-title">Activity</h5>
                                                <ul class="res-activity-list">
                                                    <li>
                                                        <p class="mb-0">{{__('trans.Punch In at')}}</p>
                                                        <p class="res-activity-time">
                                                            <i class="fa fa-clock-o"></i>
                                                            <span class="active_in"></span ><span>{{__('trans.lat')}}</span>  <span class="lat_in"></span ><span>{{__('trans.long')}}</span> <span class="lang_in"></span > 
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
                                                            <span class="active_out"></span ><span>{{__('trans.lat')}}</span>  <span class="lat_out"></span ><span>{{__('trans.long')}}</span> <span class="lang_out"></span > 
                                                                <div class="punch-img_out">
                                                                    <span></span>
                                                                </div>
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    
                                            <div class="col-md-12">
                                                <div id="map_canvas" style="width:500px;height:380px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
					</div>
				</div>
				<!-- /OUTDOOR INFO Modal -->  
                
                <div id="add_edit_client" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Add Employee')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                               <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                               </div>
                            <form action="" method="post">
                                 @CSRF

                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="hidden" class="outdoor_id"/>
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Target Client')}} <span class="text-danger">*</span></label>
                                            <select class="client_name_branch  form-control" name="customer_id"></select>                            
                                        </div>
                                    </div>
                                  </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="add">{{__('trans.Submit')}}</button>
                                </div>
                            </form>
                       </div>
                 </div>
                 </div>
        </div>
        <!-- /Page Wrapper -->
        @include('../layout.partials.map_script')
@endsection
@section('script')
<script>
          
              
$("#visit_info").on('show.bs.modal', function(event) {
                   
				var button = $(event.relatedTarget) //Button that triggered the modal
	
				var user_id= button.attr('user_id');
				var visit_id= button.attr('visit_id');

				getUrl=window.location;
				
				getHref=baseUrl+"visit_report_details/"+visit_id+"/"+user_id;
				$.ajax({
					url:getHref,
					
					}).done(function(data) {
					   console.log(data); 
				        $('.body_report').empty();
                         $('.body_report_client .client_name,.body_report_client .client_address,.body_report_client .contact_phone,.body_report_client .my-circle,.body_report_client  .branch_title,body_report_client .client_email,.body_report_client  .user_name,.body_report_client .client_email').empty();
                          //firstletter=(data.out_door.client_name).charAt(0);
                          if(typeof(data.out_door.client_name) != "undefined" && data.out_door.client_name !== null) {
                                firstletter= (data.out_door.client_name).split(' ').map(name => name[0]).join('').toUpperCase();
                                $(".body_report_client .my-circle").text(firstletter);
                                $('.body_report_client .client_name').text(data.out_door.client_name);
                                $('.body_report_client .client_email').text(data.out_door.client_email);
                                $('.body_report_client .client_address').text(data.out_door.client_address);
                                $('.body_report_client  .contact_phone').text(data.out_door.contact_phone);
                                $('.body_report_client  .branch_title').text(data.out_door.branch_title);
                                
                                $('.body_report_client  .client_phone').text(data.out_door.phone);
                            }else{
                               
                                $(".body_report_client .my-circle").text("");
                                if(data.out_door.client_name==null)
                                $('.body_report_client .client_name').text("{{__('trans.nodataclient')}}");
                                if(data.out_door.client_email==null)
                                $('.body_report_client .client_email').text("{{__('trans.nodataemail')}}");
                                if(data.out_door.client_address==null)
                                $('.body_report_client .client_address').text("{{__('trans.nodataaddr')}}");
                                if(data.out_door.contact_phone==null)
                                $('.body_report_client  .contact_phone').text("{{__('trans.nodataphone')}}");
                                if(data.out_door.branch_title==null)
                                $('.body_report_client  .branch_title').text("{{__('trans.nodatabranchtitle')}}");
                                
                                $('.body_report_client  .client_phone').text(data.out_door.phone); 
                            }
                            $('.body_report_client  .user_name').text(data.out_door.user_name);
						$.each(data.questions, function(index,question){
						   
						    $('.body_report').append('<p class="text-white bg-dark">'+question.question_text+'</p>');
                          
							$.each(data.answers, function(index,answer){

							 	if((answer.question_id ==question.id)&&(answer.user_id==data.user)){
				
                                  $('.body_report').append('<p class="text-muted">'+answer.answer_value+'</p>');
						        }
							});
	
						});
						
                      
						 
						    $('#visit_info #punch_in').text(data.out_door.in);
                          
						    $("#visit_info #punch_out").text(data.out_door.out);
						  /* 	if(attend.out != ''){
				
                               
						   }*/
                            $("#visit_info .punch-hours span").text(data.out_door.hours+"{{__('trans.hour')}}");
			                $("#visit_info .active_in").text(data.out_door.address);
						    $("#visit_info .lat_in").text(data.out_door.lati);
						    $("#visit_info .lang_in").text(data.out_door.longi);
							$("#visit_info .punch-img_in span").html("<img src='"+img_url+"/public"+data.out_door.outdoor_img+"' />");
							//console.log("hjhj");
							// console.log(data.out_door.attendance_attach_out);
					
						if(data.out_door.attendance_attach_out!=""){
						//	$.each(data.out_door.attendance_attach_out, function(index,attendance_out){
									
								$("#visit_info .active_out").text(data.out_door.attendance_attach_out.address);
								$("#visit_info .lat_out").text(data.out_door.attendance_attach_out.lati);
								$("#visit_info .lang_out").text(data.out_door.attendance_attach_out.longi);
								$("#visit_info .punch-img_out").html("<img src='"+img_url+"/public"+data.out_door.attendance_attach_out.outdoor_img+"' />");
						//	});
						}
						var myLatlng1 = new google.maps.LatLng(data.out_door.lati,data.out_door.longi);
						var myOptions ={
										zoom: 8,
										center: myLatlng1,
										mapTypeId: google.maps.MapTypeId.ROADMAP
                                         }
						var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
						const marker = new google.maps.Marker({
										position: myLatlng1,
										map: map,
										});
				
						
					});
			
			});

</script>

@endsection