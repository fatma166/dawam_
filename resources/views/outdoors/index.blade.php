@extends('layout.mainlayout')

@section('title')
    {{__('trans.Outdoors')}}
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
                            <h3 class="page-title">{{__('trans.Outdoors')}}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                                <li class="breadcrumb-item active">{{__('trans.Outdoors')}}</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_outdoor"><i class="fa fa-plus"></i>{{__('trans.Add Visit')}}</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <!--search filter-->
                <form method="post">
                <div class="row filter-row" id="outdoor">
                  <div class="col-sm-6 col-md-3"> 
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
                          <select class="employee_name  form-control" name="employee_name"></select>
                            <!--<input type="text" class="form-control floating employee_name"  />-->
                            <label class="focus-label">{{__('trans.Employee Name')}}</label>
                        </div>
                   </div>
              
                      <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">
                                    <div class="form-group form-focus select-focus">
                                     
                                        <select class="client_name_branch  form-control customer_id" name="customer_id"></select>   
                                        <label class="focus-label">{{__('trans.Target Client')}}</label>                         
                                    </div>
                       </div>
                    <div class="col-sm-6 col-md-2"> 
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
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">  
                        <div class="form-group form-focus" >
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text" name="date">
                            </div>
                            <label class="focus-label">{{__('trans.date')}}</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">  
                            <div class="form-group form-focus">
                                <div class="cal-icon">
                                    <input class="form-control floating datetimepicker to" name="to" type="text">
                                </div>
                                <label class="focus-label">{{__('trans.to')}}</label>
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

                 <!--  <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">  
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text" name="date_to">
                            </div>
                            <label class="focus-label">{{__('trans.To')}}</label>
                        </div>
                    </div>-->
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">  
                        <a  class="btn btn-success btn-block" id="search_outdoor"> {{__('trans.Search')}} </a>  
                   </div>     
                </div>
                </form>
                <!-- /Search Filter -->
                <div id="outdoor_data">
                  @include('outdoors.search')
                            
                </div>
                @section('script')
    <script type="text/javascript">
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });
    
    $(document).ready(function()
    {
        $(document).on('click', '#outdoor_data .pagination a',function(event)
        {
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            $('#search_outdoor').append('<img style="position: absolute; left: 0; top: 0; z-index: 10000;" src="https://i.imgur.com/v3KWF05.gif />');
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
       	    var branch= $("#outdoor .branch").val();
            var employee_name= $("#outdoor .employee_name").val();
            var customer_id =$("#outdoor .customer_id").val();
            var visit_type= $("#outdoor .visit_types").val();
            var to= $("#outdoor .to").val();
           
            var department= $("#outdoor .department").val();
           
			var status= $("#outdoor .status").val();
			var date= $("#outdoor input[name='date']").val();
		//	var to= $("#outdoor input[name='date_to']").val();
            var created_by= $("#outdoor select[name='created_by']").val();
        data={employee_name:employee_name,customer_id:customer_id,status:status,date:date,created_by:created_by,branch:branch,visit_type:visit_type,to:to,department:department};
        $.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"get",
			    url: '?page=' + page,
			 	data:data,
                beforeSend: function() { $("#outdoor_data #load").show(); },
				}).done(function(data) {

                        history.pushState('', '',"{{url('admin/outdoor')}}"+"?employee_name="+employee_name+"&customer_id="+customer_id +"&status="+status+"&date="+date+"&created_by="+created_by+"&branch="+branch+"&visit_type="+visit_type+"&to="+to+"&department"+department+"&page="+page);
			
                    
                    $("#outdoor_data #load").hide();
					$("#outdoor_data").empty();
					$("#outdoor_data").append(data);
                    // $('#outdoor_data').find('#table_search').DataTable({"scrollX": true});
                    //$('#outdoor_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});
    }
    
    
      
      /*  $('body').on('click', '.pagination a', function (e) {
            e.preventDefault();
            $('#search_outdoor').append('<img style="position: absolute; left: 0; top: 0; z-index: 10000;" src="https://i.imgur.com/v3KWF05.gif />');
            var url = $(this).attr('href');
           alert(url);
            window.history.pushState("", "", url);
            loadOutdoors(url);
        });
        function loadOutdoors(url){
            	$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"get",
				url:url,
				data:{employee_name:employee_name,customer_id:customer_id,status:status,date:date,created_by:created_by},
                beforeSend: function() { $("#outdoor_data #load").show(); },
				}).done(function(data) {

                        history.pushState('', '',"{{url('admin/outdoor')}}"+"?employee_name="+employee_name+"&customer_id="+customer_id +"&status="+status+"&date="+date+"&created_by="+created_by);
			
                    
                    $("#outdoor_data #load").hide();
					$("#outdoor_data").empty();
					$("#outdoor_data").append(data);
                    $('#outdoor_data').find('#table_search').DataTable({"scrollX": true});
                    $('#outdoor_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});

        }*/
</script>
@endsection
            <!-- /Page Content -->

            <!-- Add outdoor Modal -->
            <div id="add_outdoor" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Add Visit')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form method="post" action="{{route('store-outdoor',$subdomain)}}">
                             @csrf
                                <div class="row">
                                 <div class="col-sm-6 col-md-6"> 
                                        <div class="form-group">
                                         <label class="col-form-label">{{__('trans.Select Branch')}}<span class="text-danger">*</span></label>
                                            <select class="select floating branch" name="branch"> 
                                               
                                                @foreach($branchs as $branch)
                                                <option value="{{$branch->id}}">{{$branch->title}}</option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
            
            
                                   </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{ __('trans.Title') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="title">
                                        </div>
                                    </div>
                                    <!--<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Target User')}}</label>

                                            <select class="select" name="user_id">
                                            @foreach($users as $user)
                                                <option value={{$user->id}}>{{$user->name}}</option>
                                            @endforeach
                                            
                                            </select>
                                        </div>
                                    </div>-->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('trans.Date')}} <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="date" type="text"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6"> 
                                        <div class="form-group">
                                          <label class="col-form-label">{{__('trans.Target User')}} <span class="text-danger">*</span></label>
                                          <select class="employee_name_branch  form-control" name="user_id"></select>                            
                              
                                           
                                        </div>
            
            
                                    </div>
                                   <!--<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Target Client')}}</label>

                                            <select class="select" name="customer_id">
                                            @foreach($clients as $client)
                                                <option value="{{$client->id}}">{{$client->name}}</option>
                                            @endforeach
                                            
                                            </select>
                                        </div>
                                    </div>-->
                                <div class="col-sm-12 col-md-12"> 
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.Target Client')}} <span class="text-danger">*</span></label>
                                        <select class="client_name_branch select2_multi form-control" name="customer_id[]"  multiple="multiple"></select>                            
                                    </div>
                                </div>
                              <!--  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.Adress')}} <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="adress">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.lat')}} <span class="text-danger" >*</span></label>
                                        <input class="form-control add_lat" type="text" name="add_lat" >
                                    </div>
                                </div>
                               <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.lang')}} <span class="text-danger" >*</span></label>
                                        <input class="form-control add_lang" type="text" name="add_lang" >
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div id="map" style="height:400px"></div>

                                </div>-->
                                    

                                  <!--  <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('trans.To Date')}} <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="date_to" type="text"></div>
                                        </div>
                                    </div>-->
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{__('trans.Vist Type')}} <span class="text-danger">*</span></label>
                                            <select class="select" name="visit_type_id">
                                            @if(!empty($visit_types))
                                                @foreach($visit_types as $visit_type)
                                                  <option value="{{$visit_type->id}}">{{$visit_type->name}}</option>              
                                                @endforeach
                                            @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{__('trans.description')}} <span class="text-danger">*</span></label>
                                            <textarea rows="4" class="form-control" name="description"></textarea>
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
            <div id="edit_outdoor" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Edit Visit')}}</h5>
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
                                <input  type="hidden" name="user_id" value=""/>
                                <input  type="hidden" name="customer_id" value=""/>
                                  <div class="col-sm-6 col-md-6"> 
                                        <div class="form-group">
                                         <label class="col-form-label">{{__('trans.Select Branch')}}<span class="text-danger">*</span></label>
                                            <select class="select floating branch" name="branch"> 
                                               
                                                @foreach($branchs as $branch)
                                                <option value="{{$branch->id}}">{{$branch->title}}</option>
                                               @endforeach
                                            </select>
                                            
                                        </div>
            
            
                                   </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{ __('trans.Title') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="title">
                                        </div>
                                    </div>
 
                                    <div class="col-sm-6 col-md-6"> 
                                        <div class="form-group">
                                          <label class="col-form-label">{{__('trans.Target User')}} <span class="text-danger">*</span></label>
                                          <select class="employee_name_branch form-control" name="user_id"></select>                            
                              
                                           
                                        </div>
            
            
                                    </div>
                         
                                <div class="col-sm-6 col-md-6"> 
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.Target Client')}} <span class="text-danger">*</span></label>
                                        <select class="client_name_branch  form-control" name="customer_id"></select>                            
                                    </div>
                                </div>
                            <!--    <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.Adress')}} <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="adress">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.lat')}} <span class="text-danger" >*</span></label>
                                        <input class="form-control edit_lat" type="text" name="add_lat" >
                                    </div>
                                </div>
                               <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.lang')}} <span class="text-danger" >*</span></label>
                                        <input class="form-control edit_lang" type="text" name="add_lang" >
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div id="map_edit" style="height:400px"></div>

                                </div>-->
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('trans.Date')}} <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="date" type="text"></div>
                                        </div>
                                    </div>
                                   <!-- <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('trans.To Date')}} <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="date_to" type="text"></div>
                                        </div>
                                    </div>-->
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{__('trans.Vist Type')}} <span class="text-danger">*</span></label>
                                            <select class="select" name="visit_type_id">
                                            @if(!empty($visit_types))
                                                @foreach($visit_types as $visit_type)
                                                  <option value="{{$visit_type->id}}">{{$visit_type->name}}</option>              
                                                @endforeach
                                            @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('trans.description')}} <span class="text-danger">*</span></label>
                                        <textarea rows="4" class="form-control" name="description"></textarea>
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
            <div class="modal custom-modal fade" id="delete_outdoor" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>{{__('trans.Delete visit')}}</h3>
                                <p>{{__('trans.Are you sure want to delete?')}}</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary outdoor-continue-btn">{{__('trans.Delete')}}</a>
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
        
       <div id="add_edit_rate" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Add Rate')}}</h5>
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
                                            <label class="col-form-label">{{__('trans.Rate')}} <span class="text-danger">*</span></label>
                                           <div class="col-sm-10"> <input type="number" class="form-control" name="rate_value"/></div><div class="col-sm-2">%</div>                         
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
        </div>
        <!-- /Page Wrapper -->
        
         @section('script')
         <script>

         </script>
         @endsection
@endsection
