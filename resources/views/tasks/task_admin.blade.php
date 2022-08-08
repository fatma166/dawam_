@extends('layout.mainlayout')

@section('title')
    {{__('trans.tasks')}}
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
                            <h3 class="page-title">{{__('trans.Tasks')}}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                                <li class="breadcrumb-item active">{{__('trans.Tasks')}}</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_task"><i class="fa fa-plus"></i>{{__('trans.Add Task Add New')}} </a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <!-- Search Filter -->
				
					<!--<div class="row filter-row task">
						<div class="col-sm-6 col-md-2">  
							<div class="form-group form-focus">
								<input type="text" class="form-control floating employee_task">
								<label class="focus-label">{{__('trans.Employee Task')}}</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-2"> 
							<div class="form-group form-focus select-focus">
								<select class="select floating employee"> 
									<option value="all">-</option>
                                    @foreach($users as $user)
									    <option value="{{$user->name}}">{{$user->name}}</option>
								    @endforeach
								</select>
								<label class="focus-label">{{__('trans.employee_name')}}</label>
							</div>
						</div>
                        <div class="col-sm-6 col-md-2">  
							<div class="form-group form-focus focused">
									<select class="select floating status">
                                        <option value="all">-</option>
                                        <option value="delivered">{{__('trans.deliverd')}}</option>
                                        <option value="seen">{{__('trans.seen')}}</option>
                                        <option value="in_progress">{{__('trans.in_progress')}}</option>
                                        <option value="done">{{__('trans.done')}}</option>
                                        <option value="late">{{__('trans.late')}}</option>
                                    </select>
								<label class="focus-label">{{__('trans.Status')}}</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-2">  
							<div class="form-group form-focus focused">
								<div class="cal-icon">
									<input class="form-control floating datetimepicker from_date" type="text" id="min">
								</div>
								<label class="focus-label">From</label>
							</div>
                        </div>
                        <div class="col-sm-6 col-md-2">  
							<div class="form-group form-focus focused">
								<div class="cal-icon">
									<input class="form-control floating datetimepicker to_date" type="text" id="max">
								</div>
								<label class="focus-label">To</label>
							</div>
						</div>
		    
                    </div>-->
                      <!-- Search Filter -->
                <form method="post" class="task_search">
                <div class="row filter-row" >
                
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">  
                        <div class="form-group form-focus">
                          <select class="employee_name  form-control" name="employee_name"></select>
                            <!--<input type="text" class="form-control floating employee_name"  />-->
                            <label class="focus-label">{{__('trans.Employee Name')}}</label>
                        </div>
                   </div>
    
                   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12"> 
                        <div class="form-group form-focus select-focus">
						<select class="select floating status">
                                        <option value="all">-</option>
                                        <option value="delivered">{{__('trans.deliverd')}}</option>
                                        <option value="seen">{{__('trans.seen')}}</option>
                                        <option value="in_progress">{{__('trans.in_progress')}}</option>
                                        <option value="done">{{__('trans.done')}}</option>
                                        <option value="late">{{__('trans.late')}}</option>
                                    </select>
                            <label class="focus-label">{{__('trans.Status')}}</label>
                        </div>
                   </div>
                   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <div class="form-group form-focus " >
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text" name="date_from">
                            </div>
                            <label class="focus-label">{{__('trans.From')}}</label>
                        </div>
                    </div>
                   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text" name="date_to">
                            </div>
                            <label class="focus-label">{{__('trans.To')}}</label>
                        </div>
                    </div>
                
                     <div class="col-sm-6 col-md-3"> 
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
                    <div class="col-sm-6 col-md-3"> 
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
                   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <a  class="btn btn-success btn-block" id="search_task"> {{__('trans.Search')}} </a>  
                   </div>     
                </div>
                </form>
					
					<!-- /Search Filter -->
     <div id="task_data">
     
       @include('tasks.search')
     </div>
            </div>
            <!-- /Page Content -->

            <!-- Add task Modal -->
            <div id="add_task" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Add task')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form method="post" action="{{route('store-task',$subdomain)}}">
                             @csrf
                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.title')}}</label>
                                            <input class="form-control" name="title" type="text">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Target User')}}</label>

                                            <select class="select" name="user_id">
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                            
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>{{__('trans.Start Date')}} <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="start_date" type="text"></div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>{{__('trans.End Date')}} <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="due_date" type="text"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{__('trans.Description')}} <span class="text-danger">*</span></label>
                                            <textarea class="form-control" rows="4" name="description"></textarea>
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
            <!-- /Add Task -->
            
            <!-- Edit Task -->
            <div id="edit_task" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Goal Tracking</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form method="post">
                             @csrf
                                 <div class="row">

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.title')}}</label>
                                            <input class="form-control" name="title" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Target User')}}</label>

                                            <select class="select" name="user_id">
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                            
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('trans.Start Date')}} <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="start_date" type="text"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('trans.End Date')}} <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="due_date" type="text"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{__('trans.Description')}} <span class="text-danger">*</span></label>
                                            <textarea class="form-control" rows="4" name="description"></textarea>
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
            <!-- /Edit task -->
            
            <!-- Delete task -->
            <div class="modal custom-modal fade" id="delete_task" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>{{__('trans.Delete task')}}</h3>
                                <p>{{__('trans.Are you sure want to delete?')}}</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary task-continue-btn">{{__('trans.Delete')}}</a>
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
            <!-- /Delete task -->
        
        </div>
        <!-- /Page Wrapper -->
@endsection
@section('script')
<script>
        $(document).on('click', '#task_data .pagination a',function(event)
        {
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            $('#search_task').append('<img style="position: absolute; left: 0; top: 0; z-index: 10000;" src="https://i.imgur.com/v3KWF05.gif />');
            var myurl = $(this).attr('href');
           // alert(myurl);
            var page=$(this).attr('href').split('page=')[1];
  
            gettask(page);
        });

function gettask(page){
	        var employee_name= $(".task_search .employee_name").val();
          
            var date_from =$(".task_search  input[name='date_from']").val();
            var date_to =$(".task_search input[name='date_to']").val();
			var status= $(".task_search .status").val();
            var department=$(".department").val();
			var branch=$(".branch").val();
	
        data={employee_name:employee_name,date_from:date_from,date_to:date_to,status:status,department:department,branch:branch};
        $.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"get",
			    url: '?page=' + page,
			 	data:data,
                beforeSend: function() { $("#outdoor_data #load").show(); },
				}).done(function(data) {

                        history.pushState('', '',"{{url('admin/task')}}"+"?employee_name="+employee_name+"&date_from="+date_from +"&status="+status+"&date_to="+date_to+"&department="+department+"&branch="+branch+"&page="+page);
			
                    
                    $("#task_data #load").hide();
					$("#task_data").empty();
					$("#task_data").append(data);
                    $('#task_data').find('#table_search').DataTable({"scrollX": true});
                    $('#task_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});
    }
    
</script>

@endsection