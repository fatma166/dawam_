@extends('layout.mainlayout')
@section('title')
    {{__('trans.leavesetting')}}
@endsection

@section('css')
 <style>

.onoffswitch-inner:before
 {
	background-color: #55ce63;
    color: #fff;
    content: "{{ __('trans.On') }}";
    padding-right: 14px;
    }
    .onoffswitch-inner:after {
    content: "{{ __('trans.Off') }}";
    padding-left: 14px;
    background-color: #ccc;
    color: #fff;
    text-align: left;
}
  
 </style>
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
                            <h3 class="page-title">{{__('trans.Leave Settings')}}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                                <li class="breadcrumb-item active">{{__('trans.Leave Settings')}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                   @if(isset( $leave_annual))
                        <!-- Annual Leave -->
                        <div class="card leave-box" id="leave_annual">
                            <div class="card-body">
                                <div class="h3 card-title with-switch">
                                    {{__('trans.Annual')}} 											
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"  switch_status="Annual" id="switch_annual" @if($leave_annual->status=='active'){{"checked"}}@endif>
                                        <label class="onoffswitch-label" for="switch_annual">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="leave-item">
                                    
                                    <!-- Annual Days Leave -->
                                    <div class="leave-row annual_days_box">
                                        <div class="leave-left">
                                            <div class="input-box">
                                                <div class="form-group">
                                                    <label>{{__('trans.Days')}}</label>
                                                   
                                                   
                                                    <input type="text" class="form-control"  attr_type="Annual" column="num_days" value=" @if(!empty($leave_annual->num_days))  {{$leave_annual->num_days}} @endif" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="leave-right">
                                            <button class="leave-edit-btn" >{{__('trans.Edit')}}</button>
                                        </div>
                                    </div>
                                    <!-- /Annual Days Leave -->
                                    
                                    <!-- Carry Forward -->
                                    <div class="leave-row">
                                        <div class="leave-left">
                                            <div class="input-box">
                                                <label class="d-block">{{__('trans.Carry forward')}}</label>
                                                <div class="leave-inline-form">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="carry_no" attr_type="Annual" column="carry_forward_days" value="not_active" @if(!empty($leave_annual->carry_forward)&&($leave_annual->carry_forward=="not_active"))  {{"checked"}} @endif" disabled>
                                                        <label class="form-check-label" for="carry_no">{{__('trans.No')}}</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="carry_yes" attr_type="Annual" column="carry_forward_days" value="active" @if(!empty($leave_annual->carry_forward)&&($leave_annual->carry_forward=="active"))  {{"checked"}} @endif" disabled>
                                                        <label class="form-check-label" for="carry_yes">{{__('trans.Yes')}}</label>
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">{{__('trans.Max')}}</span>
                                                        </div>
                                                        <input type="text" class="form-control carry_forward_days"  attr_type="Annual" column="carry_forward_days" value="@if(!empty($leave_annual->carry_forward_days)){{$leave_annual->carry_forward_days}} @endif" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="leave-right">
                                            <button class="leave-edit-btn">
                                               {{__('trans.Edit')}}
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /Carry Forward -->
                                    
                                    <!-- Earned Leave -->
                                    <div class="leave-row">
                                        <div class="leave-left">
                                            <div class="input-box">
                                                <label class="d-block">{{__('trans.Earned leave')}}</label>
                                                <div class="leave-inline-form">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="earned_" id="earned_no" attr_type="Annual" column="earned_leave" value="not_active" @if(!empty($leave_annual->earned_leave)&&($leave_annual->earned_leave=="not_active"))  {{"checked"}} @endif disabled>
                                                        <label class="form-check-label" for="earned_no">{{__('trans.No')}}</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="earned_" id="earned_yes" attr_type="Annual" column="earned_leave" value="active" @if(!empty($leave_annual->earned_leave)&&($leave_annual->earned_leave=="active"))  {{"checked"}} @endif disabled>
                                                        <label class="form-check-label" for="earned_yes">{{__('trans.Yes')}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="leave-right">
                                            <button class="leave-edit-btn">
                                               {{__('trans.Edit')}}
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /Earned Leave -->
                                    
                                </div>
                                

                                
                            </div>
                        </div>
                        <!-- /Annual Leave -->
                       @endif
                        @if(isset( $leave_sick))
                        <!-- Sick Leave -->
                        <div class="card leave-box" id="leave_sick">
                            <div class="card-body">
                                <div class="h3 card-title with-switch">
                                    {{__('trans.Sick')}} 											
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" switch_status="Sick"  id="switch_sick" @if($leave_sick->status=='active'){{'checked="checked"'}}@endif>
                                        <label class="onoffswitch-label" for="switch_sick">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="leave-item">
                                    <div class="leave-row">
                                        <div class="leave-left">
                                            <div class="input-box">
                                                <div class="form-group">
                                                    <label>{{__('trans.Days')}}</label>
                                                    <input type="text" class="form-control" attr_type="Sick"  column="num_days"  value="@if(isset($leave_sick->num_days))  {{$leave_sick->num_days}} @endif" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="leave-right">
                                            <button class="leave-edit-btn">
                                                {{__('trans.Edit')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Sick Leave -->
                        @endif
                         @if(isset($leave_hospital))
                        <!-- Hospitalisation Leave -->
                        <div class="card leave-box" id="leave_hospitalisation">
                            <div class="card-body">
                                <div class="h3 card-title with-switch">
                                    {{__('trans.Hospitalisation')}} 											
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" switch_status="Hospitalisation"  id="switch_hospitalisation" @if($leave_hospital->status=='active'){{'checked="checked"'}}@endif>
                                        <label class="onoffswitch-label" for="switch_hospitalisation">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="leave-item">
                                
                                    <!-- Annual Days Leave -->
                                    <div class="leave-row">
                                        <div class="leave-left">
                                            <div class="input-box">
                                                <div class="form-group">
                                                    <label>{{__('trans.Days')}}</label>
                                                    <input type="text" class="form-control"  attr_type="Hospitalisation" column="num_days" value=" @if(isset($leave_hospital->num_days))  {{$leave_hospital->num_days}} @endif" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="leave-right">
                                            <button class="leave-edit-btn">
                                               {{__('trans.Edit')}}
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /Annual Days Leave -->
                                    
                                </div>
                                

                                
                            </div>
                        </div>
                        <!-- /Hospitalisation Leave -->
                        @endif
                        @if(isset($leave_maternity))
                        <!-- Maternity Leave -->
                        <div class="card leave-box" id="leave_maternity">
                            <div class="card-body">
                                <div class="h3 card-title with-switch">
                                   {{__('trans.Maternity')}}  <span class="subtitle">{{__('trans.Assigned to female only')}}</span>
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" switch_status="Maternity" id="switch_maternity" @if($leave_maternity->status=='active'){{'checked="checked"'}}@endif >
                                        <label class="onoffswitch-label" for="switch_maternity">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="leave-item">
                                    <div class="leave-row">
                                        <div class="leave-left">
                                            <div class="input-box">
                                                <div class="form-group">
                                                    <label>{{__('trans.Days')}}</label>
                                                    <input type="text" class="form-control" attr_type="Maternity" column="num_days" value=" @if(isset($leave_maternity->num_days))  {{$leave_maternity->num_days}} @endif"disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="leave-right">
                                            <button class="leave-edit-btn">
                                                {{__('trans.Edit')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- /Maternity Leave -->
                        @if(isset($leave_hours))
                        <!-- hours Leave -->
                        <div class="card leave-box" id="leave_hours">
                            <div class="card-body">
                                <div class="h3 card-title with-switch">
                                    {{__('trans.Hours')}}
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" switch_status="hours" id="switch_hours" @if($leave_hours->status=='active'){{'checked="checked"'}}@endif >
                                        <label class="onoffswitch-label" for="switch_hours">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="leave-item">
                                    <div class="leave-row">
                                        <div class="leave-left">
                                            <div class="input-box">
                                                <div class="form-group">
                                                    <label>{{__('trans.hours')}}</label>
                                                    <input type="number" class="form-control"  attr_type="hours" column="num_hours" value="@if(isset($leave_hours->num_hours))  {{$leave_hours->num_hours}} @endif" disabled>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="leave-right">
                                            <button class="leave-edit-btn">
                                                {{__('trans.Edit')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                               <!-- <div class="leave-item">
                                    <div class="leave-row">
                                        <div class="leave-left">
                                            <div class="input-box">
                                                <div class="form-group">
                                                    <label>{{__('trans.times')}}</label>
                                                   
                                                     <input type="number" class="form-control"  attr_type="hours" column="num_days" value="@if(isset($leave_hours->num_days))  {{$leave_hours->num_days}} @endif" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="leave-right">
                                            <button class="leave-edit-btn">
                                                {{__('trans.Edit')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                        <!-- /hours Leave -->
                        @endif
                        <!-- Custom Create Leave -->
                        <div class="card leave-box mb-0" id="leave_custom01">
                            <div class="card-body">
                                <div class="h3 card-title with-switch">
                                    {{__('trans.LOP')}} 											
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch_custom01"  switch_status="LOP"  @if($leave_LOP->status=='active'){{'checked="checked"'}}@endif >
                                        <label class="onoffswitch-label" for="switch_custom01">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                  
                                </div>
                                <div class="leave-item">
                                
                                    <!-- Annual Days Leave -->
                                    <div class="leave-row">
                                        <div class="leave-left">
                                            <div class="input-box">
                                                <div class="form-group">
                                                    <label>{{__('trans.Days')}}</label>
                                                    <input type="text" class="form-control"  attr_type="LOP" column="num_days" value="@if(isset($leave_LOP->num_days))  {{$leave_LOP->num_days}} @endif"disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="leave-right">
                                            <button class="leave-edit-btn">{{__('trans.Edit')}}</button>
                                        </div>
                                    </div>
                                    <!-- /Annual Days Leave -->
                                    
                                    <!-- Carry Forward -->
                                    <div class="leave-row">
                                        <div class="leave-left">
                                                <label class="d-block">{{__('trans.Carry forward')}}</label>
                                                <div class="leave-inline-form">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="carry_no" attr_type="LOP" column="carry_forward_days" value="not_active" @if(!empty($leave_LOP->carry_forward)&&($leave_LOP->carry_forward=="not_active"))  {{"checked"}} @endif" disabled>
                                                        <label class="form-check-label" for="carry_no">{{__('trans.No')}}</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="carry_yes" attr_type="LOP" column="carry_forward_days" value="active" @if(!empty($leave_LOP->carry_forward)&&($leave_LOP->carry_forward=="active"))  {{"checked"}} @endif" disabled>
                                                        <label class="form-check-label" for="carry_yes">{{__('trans.Yes')}}</label>
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">{{__('trans.Max')}}</span>
                                                        </div>
                                                        <input type="text" class="form-control lop_carry_forward_days"  attr_type="LOP" column="lop_carry_forward_days" value="@if(!empty($leave_LOP->carry_forward_days)){{$leave_LOP->carry_forward_days}} @endif" disabled>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="leave-right">
                                            <button class="leave-edit-btn">
                                                {{__('trans.Edit')}}
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /Carry Forward -->
                                    
                                    <!-- Earned Leave -->
                                    <div class="leave-row">
                                        <div class="leave-left">
                                            <div class="input-box">
                                                <label class="d-block">{{__('trans.Earned leave')}}</label>
                                                <div class="leave-inline-form">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="earned_" id="earned_no" attr_type="LOP" column="earned_leave" value="not_active" @if(!empty($leave_LOP->earned_leave)&&($leave_LOP->earned_leave=="not_active"))  {{"checked"}} @endif disabled>
                                                        <label class="form-check-label" for="earned_no">{{__('trans.No')}}</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="earned_" id="earned_yes" attr_type="LOP" column="earned_leave" value="active" @if(!empty($leave_LOP->earned_leave)&&($leave_LOP->earned_leave=="active"))  {{"checked"}} @endif disabled>
                                                        <label class="form-check-label" for="earned_yes">{{__('trans.Yes')}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="leave-right">
                                            <button class="leave-edit-btn">
                                                {{__('trans.Edit')}}
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /Earned Leave -->
                                    
                                </div>
                                

                                
                            </div>
                        </div>
                        <!-- /Custom Create Leave 
                                              
                        <div class="card leave-box" style="margin-top: 30px;" >
                            <div class="card-body">
                                <div class="h3 card-title with-switch">
                                   {{__('trans.custom')}}										
     
                                </div>-->

                                
                                <!-- Custom Policy 
                                <div class="custom-policy">
                                    <div class="leave-header">
                                        <div class="title">{{__('trans.Custom policy')}}</div>
                                        <div class="leave-action">
                                            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#add_custom_policy"><i class="fa fa-plus"></i> {{__('trans.Add custom policy')}}</button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-nowrap leave-table mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="l-name">{{__('trans.Name')}}</th>
                                                    <th class="l-days">{{__('trans.Days')}}</th>
                                                    <th class="l-assignee">{{__('trans.Assignee')}}</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($customs_annual))
                                                @foreach($customs_annual as $custom_annual)
                                                    <tr>
                                                        <td>{{$custom_annual->custom_leaves_name}} </td>
                                                        <td>{{$custom_annual->custom_days}}</td>
                                                        <td>
                                                            
                                                            @foreach(($custom_annual->user_details) as $index => $user_detail)
                                                            
                                                                <a href="#" class="avatar"><img alt="" src="{{asset('uploads').'/'.$user_detail->avatar}}"></a>
                                                                <a href="#">{{$user_detail['username']}}</a>
                                                                @if($index==2)
                                                                    @break

                                                                @endif
                                                            @endforeach
                                                             <span>...</span>
                                                             <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#viewannual_custom_policy" custom_id="{{$custom_annual->id}}" custom_type="{{$custom_annual->name}}"><i class="fa fa-plus"></i>  {{__('trans.view more')}}</button>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="dropdown dropdown-action">
                                                                <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#edit_custom_policy"  data-href="{{ url('admin/leave/edit-custom-leave/'.$user_detail['id']) }}" custompolicy_id="$user_detail['id']"><i class="fa fa-pencil m-r-5"></i> {{__('trans.Edit')}}</a>
                                                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#delete_custom_policy"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                 Custom Policy
                                
                            </div>
                        </div> -->
                        <!-- /Annual Leave -->
                    </div>
                </div>
                    
            </div>
            <!-- /Page Content -->
            
            <!-- Add Custom Policy Modal -->
            <div id="add_custom_policy" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Add Custom Policy')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form action="{{route('add-custom-leave',$subdomain)}}" method="post">
                               @csrf
                               <div class="form-group">
                                    <label>{{__('trans.Policy Name')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <label>{{__('trans.leave_types')}} <span class="text-danger">*</span></label>
                                 
                                    <select name="leave_type_id"  class="select2-selection__rendered">
                                        @foreach ($leave_types as $leave_type)
                                            <option value="{{$leave_type->id}}">{{$leave_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>{{__('trans.Days')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="days">
                                </div>
                                <div class="form-group leave-duallist">
                                    <label>{{__('trans.Add employee')}}</label>
                                    <div class="row">
                                        <div class="col-lg-5 col-sm-5">
                                            <select name="customleave_from" id="customleave_select" class="form-control" size="5" multiple="multiple">
                                                @foreach($users as $user)
                                                   <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="multiselect-controls col-lg-2 col-sm-2">
                                            <button type="button" id="customleave_select_rightAll" class="btn btn-block btn-white"><i class="fa fa-forward"></i></button>
                                            <button type="button" id="customleave_select_rightSelected" class="btn btn-block btn-white"><i class="fa fa-chevron-right"></i></button>
                                            <button type="button" id="customleave_select_leftSelected" class="btn btn-block btn-white"><i class="fa fa-chevron-left"></i></button>
                                            <button type="button" id="customleave_select_leftAll" class="btn btn-block btn-white"><i class="fa fa-backward"></i></button>
                                        </div>
                                        <div class="col-lg-5 col-sm-5">
                                            <select name="customleave_to" id="customleave_select_to" class="form-control customleave_select_to" size="8" multiple="multiple"></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" >{{__('trans.Submit')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /view Custom Policy Modal -->
                <!-- Add Custom Policy Modal -->
            <div id="viewannual_custom_policy" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.view Custom Policy')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div  class="annual_employee_policy">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Custom Policy Modal -->        
            <!-- Edit Custom Policy Modal -->
            <div id="edit_custom_policy" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Edit Custom Policy')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form  method="post">
                               <div class="form-group">
                                    <label>{{__('trans.Policy Name')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <label>leave_types <span class="text-danger">*</span></label>
                                 
                                    <select name="leave_type_id"  class="select2-selection__rendered">
                                        @foreach ($leave_types as $leave_type)
                                            <option value="{{$leave_type->id}}">{{$leave_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>{{__('trans.Days')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="days">
                                </div>
                                <div class="form-group leave-duallist">
                                    <label>{{__('trans.Add employee')}}</label>
                                    <div class="row">
                                        <div class="col-lg-5 col-sm-5">
                                            <select name="customleave_from" id="customleave_select" class="form-control" size="5" multiple="multiple">
                                                @foreach($users as $user)
                                                   <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="multiselect-controls col-lg-2 col-sm-2">
                                            <button type="button" id="customleave_select_rightAll" class="btn btn-block btn-white"><i class="fa fa-forward"></i></button>
                                            <button type="button" id="customleave_select_rightSelected" class="btn btn-block btn-white"><i class="fa fa-chevron-right"></i></button>
                                            <button type="button" id="customleave_select_leftSelected" class="btn btn-block btn-white"><i class="fa fa-chevron-left"></i></button>
                                            <button type="button" id="customleave_select_leftAll" class="btn btn-block btn-white"><i class="fa fa-backward"></i></button>
                                        </div>
                                        <div class="col-lg-5 col-sm-5">
                                            <select name="customleave_to" id="customleave_select_to" class="form-control customleave_select_to" size="8" multiple="multiple"></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" >{{__('trans.Submit')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Custom Policy Modal -->
            
            <!-- Delete Custom Policy Modal -->
            <div class="modal custom-modal fade" id="delete_custom_policy" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>{{__('trans.Delete Custom Policy')}}</h3>
                                <p>{{__('trans.Are you sure want to delete?')}}</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn">{{__('trans.Delete')}}</a>
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
            <!-- /Delete Custom Policy Modal -->
            
        </div>
        <!-- /Page Wrapper -->
@endsection