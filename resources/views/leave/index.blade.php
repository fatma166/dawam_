@extends('layout.mainlayout')
@section('title')
    {{__('trans.leave')}}
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
                            <h3 class="page-title">{{__('trans.Leaves')}}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                                <li class="breadcrumb-item active">{{__('trans.Leaves')}}</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i>{{__('trans.Add Leave')}}</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <!-- Leave Statistics -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-info">
                            <h6>{{__('trans.Today Presents')}}</h6>
                            <h4>{{$attend_today}}</h4>
                        </div>
                    </div>
                  <!--  <div class="col-md-3">
                        <div class="stats-info">
                            <h6>{{__('trans.Planned Leaves')}}</h6>
                            <h4>8 <span>{{__('trans.Today')}}</span></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-info">
                            <h6>{{__('trans.Unplanned Leaves')}}</h6>
                            <h4>0 <span>{{__('trans.Today')}}</span></h4>
                        </div>
                    </div>-->
                    <div class="col-md-3">
                        <div class="stats-info">
                            <h6>{{__('trans.Pending Requests')}}</h6>
                            <h4>{{$pending_today}}</h4>
                        </div>
                    </div>
                </div>
                <!-- /Leave Statistics -->
                
                <!-- Search Filter -->
                <form method="post" class="leave_serch">
                <div class="row filter-row" id=leave">
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 ">  
                        <div class="form-group form-focus">
                          <select class="employee_name  form-control" name="employee_name"></select>
                            <!--<input type="text" class="form-control floating employee_name"  />-->
                            <label class="focus-label">{{__('trans.Employee Name')}}</label>
                        </div>
                   </div>
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 ">  
                        <div class="form-group form-focus select-focus">
                            <select class="select floating leave_type" name="type"> 
                                <option value="all" > -- Select -- </option>
                              @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                           
                              @endforeach
                            </select>
                            <label class="focus-label">{{__('trans.Leave Type')}}</label>
                        </div>
                   </div>
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 "> 
                        <div class="form-group form-focus select-focus">
                            <select class="select floating status" name="status" > 
                                <option value="all"> -- Select -- </option>
                                <option> Pending </option>
                                <option> Approved </option>
                                <option> Rejected </option>
                            </select>
                            <label class="focus-label">{{__('trans.Leave Status')}}</label>
                        </div>
                   </div>
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 ">  
                        <div class="form-group form-focus " >
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text" name="date_from">
                            </div>
                            <label class="focus-label">{{__('trans.From')}}</label>
                        </div>
                    </div>
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 ">  
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text" name="date_to">
                            </div>
                            <label class="focus-label">{{__('trans.To')}}</label>
                        </div>
                    </div>
                     <div class="col-sm-6 col-md-2 col-md-2 col-lg-2 col-xl-2"> 
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
                    <div class="col-sm-6  col-md-2 col-lg-2 col-xl-2"> 
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
                   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 ">  
                        <a  class="btn btn-success btn-block" id="search_leave"> {{__('trans.Search')}} </a>  
                   </div>     
                </div>
                </form>
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
                <!-- /Search Filter -->
                <div id="leave_data">
                   @include('leave/search')
                </div>
            </div>
            <!-- /Page Content -->
            
            <!-- Add Leave Modal -->
            <div id="add_leave" class="modal custom-modal fade " role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Leave</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form action="{{route('store-leaves',$subdomain)}}"  method="post">
                                <div class="form-group">
                                    <label>{{__('trans.user')}} <span class="text-danger">*</span></label>
                                    <select class="select leave_user" name="user_id">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>{{__('trans.Leave Type')}} <span class="text-danger">*</span></label>
                                    <select class="select select_leave_type" name="type">
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                    <span>{{__('trans.available days')}}</span><span>     </span><span class="available_days"></span></br>
                                    <span>{{__('trans.message:')}}</span><span class="msg-text"></span>
                                </div>
                                <div class="form-group">
                                    <label>{{__('trans.From')}} <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker from"  id="from_" type="text" name="leave_from">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{__('trans.To')}} <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker to" type="text" name="leave_to">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{__('trans.Number of days')}} <span class="text-danger">*</span></label>
                                    <input class="form-control" readonly type="text" name="days">
                                </div>
  
                                <div class="form-group">
                                    <label>{{__('trans.Leave Reason')}} <span class="text-danger">*</span></label>
                                    <textarea rows="4" class="form-control" name="leave_reson"></textarea>
                                </div>
                                <div class="save_msg" style="color:red;text-align:center;"></div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="add">{{__('trans.Submit')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Leave Modal -->
            
            <!-- Edit Leave Modal -->
            <div id="edit_leave" class="modal custom-modal fade leave_" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Edit Leave')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form >
                                <div class="form-group">
                                    <label>{{__('trans.user')}} <span class="text-danger">*</span></label>
                                    <select class="select" name="user_id">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>{{__('trans.Leave Type')}} <span class="text-danger">*</span></label>
                                    <select class="select select_leave_type" name="type">
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                    <span>{{__('trans.available days')}}</span><span>     </span><span class="available_days"></span></br>
                                    <span>{{__('trans.message:')}}</span><span class="msg-text"></span>
                                </div>
                               <div class="form-group">
                                    <label>{{__('trans.From')}} <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker from" type="text" name="leave_from">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{__('trans.To')}} <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text" name="leave_to">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{__('trans.Number of days')}} <span class="text-danger">*</span></label>
                                    <input class="form-control" readonly type="text" name="days">
                                </div>
  
                                <div class="form-group">
                                    <label>{{__('trans.Leave Reason')}} <span class="text-danger">*</span></label>
                                    <textarea rows="4" class="form-control" name="leave_reson"></textarea>
                                </div>
                   
                                   <div class="save_msg" style="color:red;text-align:center;"></div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="edit">{{__('trans.Save')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Leave Modal -->

            <!-- Approve Leave Modal -->
            <div class="modal custom-modal fade" id="stutas_leave" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>{{__('trans.Leave Status')}}</h3>
                                <p>{{__('trans.Are you sure want to do action for this leave?')}}</p>
                            </div>
                                <div class="form-group">
                                    <label>{{__('trans.Leave Answer')}} <span class="text-danger">*</span></label>
                                    <textarea rows="4" class="form-control" name="answer"></textarea>
                                </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary leave_status_continue-btn" >{{__('trans.Approve')}}</a>
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
            <!-- Approve Leave Modal -->
            <div class="modal custom-modal fade" id="decline_leave" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Leave Approve</h3>
                                <p>Are you sure want to approve for this leave?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary leave_decline_continue-btn">Decline</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Approve Leave Modal -->
            
            <!-- Delete Leave Modal -->
            <div class="modal custom-modal fade" id="delete_leave" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>{{__('trans.Delete Leave')}}</h3>
                                <p>{{__('trans.Are you sure want to delete this leave?')}}</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn leave-continue-btn">{{__('trans.Delete')}}</a>
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
            <!-- /Delete Leave Modal -->
            
        </div>
        <!-- /Page Wrapper -->
@endsection
@section('script')
<script>
$(document).ready(function()
    {
        $(document).on('click', '#leave_data .pagination a',function(event)
        {
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            $('#leave_data').append('<img style="position: absolute; left: 0; top: 0; z-index: 10000;" src="https://i.imgur.com/v3KWF05.gif />');
            var myurl = $(this).attr('href');
           // alert(myurl);
            var page=$(this).attr('href').split('page=')[1];
  
            getData(page);
        });
  
    });
  
    function getData(page){
      /*  $.ajax(
        {
            url: '?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data){
            $("#tag_container").empty().html(data);
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
              
        });*/
			var employee_name= $(".leave_serch .employee_name").val();
			var leave_type= $(".leave_serch .leave_type").val();
			var status= $(".leave_serch .status").val();
			var from= $(".leave_serch  input[name='date_from']").val();
			var to= $(".leave_serch input[name='date_to']").val();
            var department=$(".department").val();
			var branch=$(".branch").val();
       	data:{employee_name:employee_name,leave_type:leave_type,status:status,from:from,to:to},
        $.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"get",
			    url: '?page=' + page,
			 	data:data,
                beforeSend: function() { $("#leave_data #load").show(); },
				}).done(function(data) {

                    history.pushState('', '',"{{url('admin/leaves')}}"+"?employee_name="+employee_name+"&from="+from +"&leave_type="+leave_type+"&to="+to+"&department="+department+"&branch="+branch+"&page"+page);
			
                    $("#leave_data #load").hide();
					$("#leave_data").empty();
					$("#leave_data").append(data);
                    $('#leave_data').find('#table_search').DataTable({"scrollX": true});
                    $('#leave_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});
    }

</script>
@endsection