@extends('layout.mainlayout')
@section('title')
    {{__('trans.Shifts')}}
@endsection
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">{{ __('trans.shifts') }}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('trans.shifts') }}</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_shift"><i class="fa fa-plus"></i> {{__('trans.Add shift')}}</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
           
                
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0" id="table_search">
                                <thead>
                                    <tr>
                                        <th>{{__('trans.Title')}}</th>
                                        <th>{{__('trans.From')}}</th>
                                        <th>{{__('trans.To')}}</th>
                                        <th>{{__('trans.main')}}</th>
                                        <th class="text-center">{{__('trans.Status')}}</th>
                                         @if(Auth::user()->role_id==2)
                                         <th>{{__('trans.Company Title')}}</th>
                                         @endif
                                        <th class="text-right">{{__('trans.Actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(isset($shifts))
                                    @foreach($shifts as $shift)
                                    <tr>
    
                                            <td>{{$shift->title}}</td>
                                            <td>{{$shift->time_from}}</td>
                                            <td>{{$shift->time_to}}</td>
                                            <td>@if($shift->shift_default==1){{__('trans.Yes')}}@else{{__('trans.No')}} @endif</td>
                                            
                                            <td class="text-center">
                                                <div class="dropdown action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-dot-circle-o @if($shift->status==0){{'text-danger'}}@else {{'text-success'}} @endif">@if($shift->status==0)<span>{{__('trans.NotActive')}}</span>@else<span>{{__('trans.Active')}}</span>@endif</i> 
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_shift" status="1" shift_id="{{$shift->id}}"><i class="fa fa-dot-circle-o text-success"><span>{{__('trans.Active')}}</span></i></a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_shift" status="0" shift_id="{{$shift->id}}"><i class="fa fa-dot-circle-o text-danger"><span>{{__('trans.NotActive')}}</span></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                             @if(Auth::user()->role_id==2)
                                            <td>{{$shift->company_title}}</td>
                                            @endif
                                            <td class="text-right">
                                                <a class="btn btn-outline-success" href="#" data-href="{{ url('admin/shift-edit/'.$shift->id) }}" shift-id="{{$shift->id}}"  data-toggle="modal" data-target="#edit_shift"><i class="fa fa-pencil m-r-5"></i>{{ __('trans.Edit') }}</a>
                                                <a class="btn btn-danger" data-toggle="modal"  href="#" data-target="#delete_shift" delete-id="{{$shift->id}}"><i class="fa fa-trash-o m-r-5"></i>{{__('trans.Delete')}}</a>
    
                                            </td>
                                          
                                    </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
            
            <!-- Add Shift Modal -->
            <div id="add_shift" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Add Shift')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form method="post" action="{{route('store-shift',$subdomain)}}">
                                @CSRF
                              @if(Auth::user()->role_id==2)
                               <div class="col-6">
     
                                    <div class="form-group form-focus select-focus">
                                        <select class="select floating" name="company_id"> 
                                            @foreach($companies as $company)
                                                <option value="{{$company['id']}}">{{$company['title']}}</option>
                                            @endforeach
                                        </select>
                                        <label class="focus-label">{{__('trans.Company')}}</label>
                                    </div>
                                
                                </div>
                             
                                @endif
                                <div class="row">

                                <div class="col-12">
                                <div class="form-group">
                                    <label>{{__('trans.Title')}}<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="title">
                                </div>
                                </div>
                                 <div class="col-12">  <h3>{{__('trans.working hours')}}</h3></div>
                                       <div class="col-6">
                                           <div class="form-group">
                                            <label class="col-form-label">{{__('trans.From')}} <span class="text-danger">*</span></label>
                                            <input type="time" class="form-control" name="from"  />
                                            </div>
                                       </div>  
                                       <div class=" col-6">
                                          <div class="form-group">
                                            <label class="col-form-label">{{__('trans.To')}} <span class="text-danger">*</span></label>
                                            <input type="time" class="form-control" name="to"  />
                                          </div>
                                        </div> 
                                   <div class="col-12">  <h3>{{__('trans.check in out avaliable')}}</h3></div>
                                       <div class="col-6">
											<div class="form-group">
												<label class="col-form-label">{{__('trans.Min Start Time')}}   <span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
													<!--<input class="form-control" name="time_in_max"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
											         <input type="time" class="form-control" name="time_in_min"  />
                                            	</div>
											</div>
                                       </div>   

                
                                
                                     	<div class="col-6">
											<div class="form-group">
												<label class="col-form-label">{{__('trans.Max Start Time')}}  <span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
													<!--<input class="form-control" name="time_in_max"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
											         <input type="time" class="form-control" name="time_in_max"  />
                                            	</div>
											</div>
										</div>

										<div class="col-6">
											<div class="form-group">
												<label class="col-form-label">{{__('trans.Min End Time')}}  <span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
													<!--<input class="form-control" name="time_out_min"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
                                                     <input type="time" class="form-control" name="time_out_min" />
												</div>
											</div>
										</div>


										<div class="col-6">
											<div class="form-group">
												<label class="col-form-label">{{__('trans.Max End Time')}}<span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
													<!--<input class="form-control" name="time_out_max"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
											          <input type="time" class="form-control" name="time_out_max"  />
                                            	</div>
											</div>
										</div>
                        
										<div class="col-6">
											<div class="form-group">
												<label class="col-form-label">{{__('trans.Break Time')}}  <span class="text-danger">*</span></label>
												<input class="form-control" type="number" name="break_time">
											</div>
										</div>  
                                        <div class="col-6">
                             <div class="leave-left"> 
                                    <div class="form-group">
                                    	<label class="col-form-label">{{__('trans.default')}} </label>
                                        <select class="select floating" name="shift_default"> 
                                        
                                            <option value="0">{{__('trans.No')}}</option>
                                            <option value="1">{{__('trans.Yes')}}</option>
                                        
                                        </select>
                                       
                                    </div>
                                </div>
     
                                        </div>
                                    </div>

                           <!--    <div class="leave-left">
                                    <label class="d-block"></label>
                                    <div class="leave-inline-form">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="shift_default" value="0"  >
                                            <label class="form-check-label" for="carry_no"></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="shift_default" value="1" >
                                            <label class="form-check-label" for="carry_yes"></label>
                                        </div>
        
                                    </div>
                                </div>-->
                                    <div class="col-12">

                                        <div class="form-group">
                                                <label class="col-form-label">{{__('trans.Accept Extra Hours')}} </label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch1" checked=""  name="over_time">
                                                    <label class="custom-control-label" for="customSwitch1"></label>
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
            <!-- /Add shifts Modal -->
            
            <!-- Edit shift Modal -->
            <div id="edit_shift" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Edit shift')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form method="post" action="">
                             @csrf
                             <div class="row">
                             <div class="col-12">
                                <div class="form-group">
                                    <label>{{__('trans.Title')}}<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="title">
                                </div>
                            </div>

                                        <div class="col-12">  <h3>{{__('trans.working hours')}}</h3></div>
                                           <div class="col-6">
                                               <div class="form-group">
                                                <label class="col-form-label">{{__('trans.From')}} <span class="text-danger">*</span></label>
                                                <input type="time" class="form-control" name="from"  />
                                                </div>
                                           </div> 
                                          <div class="col-6">
                                              <div class="form-group">
                                                <label class="col-form-label">{{__('trans.To')}} <span class="text-danger">*</span></label>
                                                <input type="time" class="form-control" name="to"  />
                                              </div>
                                            </div>
                                       <div class="col-12">  <h3>{{__('trans.check in out avaliable')}}</h3></div>
                  
                                           <div class="col-6">
    											<div class="form-group">
    												<label class="col-form-label">{{__('trans.Max Start Time')}}  <span class="text-danger">*</span></label>
    												<div class="input-group time timepicker">
    													<!--<input class="form-control" name="time_in_max"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
    											         <input type="time" class="form-control" name="time_in_min"  />
                                                	</div>
    											</div>
                                           </div>
                                         	<div class="col-6">
    											<div class="form-group">
    												<label class="col-form-label">{{__('trans.Max Start Time')}}  <span class="text-danger">*</span></label>
    												<div class="input-group time timepicker">
    													<!--<input class="form-control" name="time_in_max"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
    											         <input type="time" class="form-control" name="time_in_max"  />
                                                	</div>
    											</div>
    										</div>

    										<div class="col-6">
    											<div class="form-group">
    												<label class="col-form-label">{{__('trans.Min End Time')}}  <span class="text-danger">*</span></label>
    												<div class="input-group time timepicker">
    													<!--<input class="form-control" name="time_out_min"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
                                                         <input type="time" class="form-control" name="time_out_min" />
    												</div>
    											</div>
    										</div>


    
    										<div class="col-6">
    											<div class="form-group">
    												<label class="col-form-label">{{__('trans.Max End Time')}}<span class="text-danger">*</span></label>
    												<div class="input-group time timepicker">
    													<!--<input class="form-control" name="time_out_max"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
    											          <input type="time" class="form-control" name="time_out_max"  />
                                                	</div>
    											</div>
    										</div>

										<div class="col-12">
											<div class="form-group">
												<label class="col-form-label">{{__('trans.Break Time')}}  <span class="text-danger">*</span></label>
												<input class="form-control" type="number" name="break_time">
											</div>
										</div>  

                                        <div class="col-lg-12">
											<div class="form-group">
												<label class="col-form-label">{{__('trans.Accept Extra Hours')}} </label>
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="customSwitch2" checked=""  name="over_time">
													<label class="custom-control-label" for="customSwitch2"></label>
												</div>
											</div>
										</div>
                                    </div>
                                <div class="leave-left">
                                    <label class="d-block">{{__('trans.default')}}</label>
                               
                                    <div class="form-group form-focus select-focus">
                                        <select class="select floating" name="shift_default"> 
                                        
                                            <option class="check_no" value="0">{{__('trans.No')}}</option>
                                            <option class="check_yes" value="1">{{__('trans.Yes')}}</option>
                                        
                                        </select>
                                        
                                    </div>
                               
        
                                </div>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="edit">{{__('trans.Save')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit shift Modal -->

            <!-- Approve shift Modal -->
            <div class="modal custom-modal fade" id="approve_shift" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>{{__('trans.shift Approve')}}</h3>
                                <p>{{__('trans.Are you sure want to approve for this shift?')}}</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <span class="btn btn-primary continue-btn">{{__('trans.Approve')}}</span>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">{{__('trans.Decline')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Approve shift Modal -->
            
            <!-- Delete shift Modal -->
            <div class="modal custom-modal fade" id="delete_shift" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>{{__('trans.Delete shift')}}</h3>
                                <p>{{__('trans.Are you sure want to delete this shift?')}}</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary shift-continue-btn">{{__('trans.Delete')}}</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">{{__('trans.Cancel')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Delete shift Modal -->
            
      
        <!-- /Page Wrapper -->
@endsection