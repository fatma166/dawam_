@extends('layout.mainlayout')
@section('title')
    {{__('trans.employes_list')}}
@endsection

@section('content')
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">{{__('trans.Employee')}}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                                <li class="breadcrumb-item active">{{__('trans.Employee')}}</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i>{{__('trans.Add Employee')}} </a>
                            <div class="view-icons">
                                <a href="employees" class="grid-view btn btn-link" title="{{__('trans.grid')}}"><i class="fa fa-th"></i></a>
                                <a href="employees-list" class="list-view btn btn-link active" title="{{__('trans.list')}}"><i class="fa fa-bars"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
               <!-- <form action="search-employee" method="post">-->
                @csrf
                <!-- Search Filter -->
               <!-- <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="name" id="employee_name">
                            <label class="focus-label">{{__('trans.name')}}</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="phone" id="employee_phone">
                            <label class="focus-label">{{__('trans.Phone')}}</label>
                        </div>
                    </div>
                    @if(!empty($branches))
                    <div class="col-sm-6 col-md-3"> 
                        <div class="form-group form-focus select-focus">
                            <select class="select floating" name="branch"> 
                            @foreach($branches as $branch)
                                <option>{{$branch->title?$branch->title:''}}</option>
                            @endforeach
                            </select>
                            <label class="focus-label">{{__('trans.Designation')}}</label>
                        </div>
                    </div>
                    @endif
                   <div class="col-sm-6 col-md-3">  
                        <a href="#" class="btn btn-success btn-block">{{__('trans.Search')}} </a>  
                    </div>    
                </div>--> 
                <!-- /Search Filter -->
                
               <!-- </form>-->
                @if(Session::has('success'))

                    <div class="alert alert-success">

                        {{ Session::get('success') }}

                        @php

                            Session::forget('success');

                        @endphp

                    </div>

                @endif


                @if(Session::has('error'))

                    <div class="alert alert-success">

                        {{ Session::get('error') }}
                    </div>

                @endif
                <div class="row">
              
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 " id="table_search">
                                <thead>
                                    <tr>
                                        <th>{{__('trans.Name')}}</th>
                                        <th>{{__('trans.Employee ID')}}</th>
                                        <th>{{__('trans.Email')}}</th>
                                        <th>{{__('trans.Mobile')}}</th>
                                        <th class="text-nowrap">{{__('trans.Join Date')}}</th>
                                        <th>{{__('trans.Branch')}}</th>
                                        <th>{{__('trans.LastLogin')}}</th>
                                        <th>{{__('trans.Status')}}</th>
                                        <th class="text-right no-sort">{{__('trans.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if ($users)
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar"href="{{url('admin/employee-profile/'.$user->id)}}"><img alt="" src="{{asset($user->avatar)}}"></a>
                                                <a class=""  href="{{url('admin/employee-profile/'.$user->id)}}">{{$user->name}} <span>{{$user->job_title}}</span></a>
                                            </h2>
                                        </td>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->join_date}}</td>
                                        <td>{{$user->branch_title}}</td>
                                        <td>{{$user->last_login}}</td>
                                        <td class="text-center">
                                                <div class="dropdown action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-dot-circle-o @if($user->active==0){{'text-danger'}}@else {{'text-success'}} @endif">@if($user->active==0)<span>{{__('trans.NotActive')}}</span>@else <span>{{__('trans.Active')}}</span> @endif</i> 
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_employee" status="1" employee-id="{{$user->id}}"><i class="fa fa-dot-circle-o text-success"><span>{{__('trans.Active')}}</span></i></a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_employee" status="0"  employee-id="{{$user->id}}"><i class="fa fa-dot-circle-o text-danger"><span>{{__('trans.NotActive')}}</span></i></a>
                                                    </div>
                                                </div>
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-outline-success" href="#" data-href="{{ url('admin/employee-edit/'.$user->id) }}" data-toggle="modal" employee-id="{{$user->id}}" data-target="#edit_employee"><i class="fa fa-pencil m-r-5"></i>{{__('trans.Edit')}}</a>
                                            <a class="btn btn-outline-danger" href="#" delete-id="{{$user->id}}"  data-toggle="modal" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> {{__('trans.Delete')}}</a>
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
            
            <!-- Add Employee Modal -->
            <div id="add_employee" class="modal custom-modal fade" role="dialog">
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
                            <form action="{{route('store-employee',$subdomain)}}" method="post">
                            @CSRF

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Name')}}<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name">
                                        </div>
                                    </div>
                               
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Email')}} <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Password')}} </label>
                                            <input class="form-control" type="password" name="password">
                                           <!-- <input class="form-control" type="password" name="old_password">-->
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Confirm Password')}}</label>
                                            <input class="form-control" type="password" name="Confirm_Password">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">  
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Joining Date')}} <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="joining_date"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Phone')}} </label>
                                            <input class="form-control" type="number" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('trans.Jobs')}} <span class="text-danger">*</span></label>
                                            <div class="">
                                            <select class="select job_id" name="job_id">
                                                @if(isset($jobs)) 
                                                    @foreach($jobs as $job)
                                                        <option value="{{$job->id}}">{{$job->title}}</option>
                                                    @endforeach
                                                 @endif;
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('trans.Department')}} <span class="text-danger">*</span></label>
                                            <div class="">
                                            <select class="select department" name="department">
                                                @if(($roles['name']=="admin")|| (Session::has('company'))) 
                                                <option value="all">{{__('trans.all')}}</option>
                                                @endif
                                                @if(isset($departments)) 
                                                    @foreach($departments as $department)
                                                        <option value="{{$department->id}}">{{$department->title}}</option>
                                                    @endforeach
                                                 @endif;
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{__('trans.Branch')}} <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select class="select branch" name="branch">
                                                @if(($roles['name']=="admin")|| (Session::has('company'))) 
                                                <option value="all">{{__('trans.all')}}</option>
                                                @endif
                                                    @if(isset($branchs)) 
                                                        @foreach($branchs as $branch)
                                                            <option value="{{$branch->id}}">{{$branch->title}}</option>
                                                        @endforeach
                                                    @endif;
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{__('trans.shift')}} <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select class="select shift" name="shift_id">
                                                    @if(isset($shifts)) 
                                                        @foreach($shifts as $shift)
                                                            <option value="{{$shift->id}}">{{$shift->title}}</option>
                                                        @endforeach
                                                    @endif;
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{__('trans.role')}} <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select class="select role" name="role_id">
                                                   <option value="Null">{{__('trans.Employee')}}</option>
                                                   
                                                    @if(!empty($roles_)) 
                                                        @foreach($roles_ as $role)
                                                            <option value="{{$role->id}}" >{{$role->name}}</option>
                                                         @endforeach
                                                    @endif;
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Active')}} </label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch1" checked=""  name="active">
                                                <label class="custom-control-label" for="customSwitch1"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Bassma')}} </label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch2" checked=""  name="bassma">
                                                <label class="custom-control-label" for="customSwitch2"></label>
                                            </div>
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
            <!-- /Add Employee Modal -->
            
            <!-- Edit Employee Modal -->
            <div id="edit_employee" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Edit_employe')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                        <form action="" method="POST">
                        @CSRF
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Name')}}<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name">
                                        </div>
                                    </div>
                              
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Email')}} <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Password')}} </label>
                                            <input class="form-control" type="password" name="password"><small>{{__('trans.write only you want change')}}</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Confirm Password')}}</label>
                                            <input class="form-control" type="password" name="Confirm_Password">
                                        </div>
                                    </div>
                       
                                    <div class="col-sm-6">  
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Joining Date')}} <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="joining_date"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Phone')}} </label>
                                            <input class="form-control" type="number" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('trans.Jobs')}} <span class="text-danger">*</span></label>
                                            <div class="">
                                            <select class="select job_id" name="job_id">
                                                @if(isset($jobs)) 
                                                    @foreach($jobs as $job)
                                                        <option value="{{$job->id}}">{{$job->title}}</option>
                                                    @endforeach
                                                 @endif;
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                 
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('trans.Department')}} <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select class="select department" name="department">
                                                    <option class="all_dep" value="all">{{__('trans.all')}}</option>
                                                    @if(isset($departments)) 
                                                        @foreach($departments as $department)
                                                            <option value="{{$department->id}}">{{$department->title}}</option>
                                                        @endforeach
                                                    @endif;
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{__('trans.Branch')}} <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select class="select branch" name="branch">
                                             
                                                    <option value="all">{{__('trans.all')}}</option>
                                                
                                                    @if(isset($branchs)) 
                                                
                                                        @foreach($branchs as $branch)
                                                            <option value="{{$branch->id}}">{{$branch->title}}</option>
                                                        @endforeach
                                                    @endif;
                                                </select>
                                            </div>
                                        </div>
                                    </div>
      
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{__('trans.shift')}} <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select class="select shift" name="shift_id">
                                                    @if(isset($shifts)) 
                                                        @foreach($shifts as $shift)
                                                            <option value="{{$shift->id}}">{{$shift->title}}</option>
                                                        @endforeach
                                                    @endif;
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{__('trans.role')}} <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select class="select role" name="role_id">
                                                   @if(($roles['name']=="admin")|| (Session::has('company'))) 
                                                    <option value="Null">{{__('trans.Employee')}}</option>
                                                   @endif
                                                    @if(!empty($roles_)) 
                                                        @foreach($roles_ as $role)
                                                            <option value="{{$role->id}}" >{{$role->name}}</option>
                                                         @endforeach
                                                    @endif;
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Active')}} </label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch3" checked=""  name="active">
                                                <label class="custom-control-label" for="customSwitch3"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Bassma')}} </label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch4" checked=""  name="bassma">
                                                <label class="custom-control-label" for="customSwitch4"></label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                </div>
        
                    
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="edit">{{__('trans.Edit')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Employee Modal -->
            
            <!-- Delete Employee Modal -->
            <div class="modal custom-modal fade" id="delete_employee" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>{{__('trans.Delete Employee')}}</h3>
                                <p>{{__('trans.Are you sure want to delete?')}}</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn" continue_del="">{{__('trans.Delete')}}</a>
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
            <!-- /Delete Employee Modal -->
            <!-- Approve employee Modal -->
        <div class="modal custom-modal fade" id="approve_employee" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>{{__('trans.employee_status')}}</h3>
                            <p>{{__('trans.Are you sure want to change status for this employee?')}}</p>
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
        <!-- /Approve employee  Modal -->

@endsection
@section('script')
<script>

	/*    Employee edit */
		$("#edit_employee").on('show.bs.modal', function(event) {
          
			var button = $(event.relatedTarget) //Button that triggered the modal
		 
			var getHref = button.data('href'); //get button href
			
			var id = button.attr('employee-id'); 
		   
		
			
		
			update_url=baseUrl+"employee-update/"+id;
			$('#edit_employee form').attr('action',update_url);
			$.ajax({
				url:getHref,
				data:{id:id},
				}).done(function(data) {
				$.each(data, function( index,employee){
				    
				  console.log(employee);
					$( "input[name*='name']" ).val(employee.name );
                    $( "input[name*='email']" ).val(employee.email );
					$( "input[name*='old_password']" ).val(employee.password );
					$( "input[name='joining_date']" ).val(employee.join_date );
                    $( "input[name*='phone']" ).val(employee.phone);
					$( "select[name='job_id']" ).val(employee.job_id);
					$( "select[name='department']" ).val(employee.department_id);
                    $( "select[name='branch']" ).val(employee.branch_id );
                    $( "select[name='role_id']" ).val(employee.role_id );

				});

			});
		});
     
       	$("#approve_employee").on('show.bs.modal', function(event) {
               
			var button = $(event.relatedTarget) //Button that triggered the modal

			 status = button.attr('status');

		     employee_id=button.attr('employee-id');
			
		});
		$("#approve_employee .continue-btn").click(function(){
		
     
		$.ajax({
				url:"{{route('status-employee',$subdomain)}}",    
				data:{status:status,id:employee_id},
				type:"get",
				}).done(function(data) {
			     location.reload(true);

			});

		});
</script>
@endsection