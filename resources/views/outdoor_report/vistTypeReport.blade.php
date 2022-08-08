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
                                <li class="breadcrumb-item active">{{__('trans.Visit Type Report')}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <!-- Search Filter -->
                <form>
                    <div class="row filter-row" id="visit_type_report">
         
                      <!-- <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">
                            <div class="form-group form-focus">
                              <select class="employee_name  form-control" name="user_id"></select>
                              
                                <label class="focus-label">{{__('trans.Employee Name')}}</label>
                            </div>
                       </div>-->
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
                                <select class="select floating visit_types" name="visit_types"> 
                                    <option value="all">-- Select --</option>
                                    @foreach($visit_types as $visit_type)
                                        <option value="{{$visit_type->id}}">{{$visit_type->name}}</option>
                                    @endforeach

                                </select>
                                <label class="focus-label">{{__('trans.Visit types')}} </label>
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
                            <a href="#" class="btn btn-success btn-block" id="search_visit_type_report"> {{__('trans.Search')}} </a>  
                        </div>     
                    </div>
                </form>
                <!-- /Search Filter -->
              
               <!--<div class="row">
                    <div class="col-2">
                        <a href="{{url('admin/visitTypeReportPrint/visit_type')}}" class="btn btn-primary shift-continue-btn" id="visitTypeReport_printlink">{{__('trans.visitTypeReportPrint')}}</a>
                    </div>
                </div>-->
                <div class="visit_type_report_data">

                    @include('outdoor_report.vistTypeReportsearch')
                  
                </div>
            </div>
            <!-- /Page Content -->

        <!-- /Page Wrapper -->
       
@endsection
@section('script')
<script>
 	/* search visit visit_report_details*/

    	$("#search_visit_type_report").click(function(e){
    	     e.preventDefault();
    	  
  		
           // var visit_type=$(".visit_types").val();
            var from=$(".from").val();
			var to=$(".to").val();
  	        var department=$(".department").val();
			var branch=$(".branch").val();
  	        var user_id=$(".employee_name").val();
            var visit_type= $("#visit_type_report .visit_types").val();
            $('#visitTypeReport_printlink').attr("href","{{url('admin/visitTypeReportPrint/visit_type')}}"+"?user_id="+user_id+"&visit_type="+visit_type+"&to="+to+"&from="+from+"&department="+department+"&branch="+branch);
		   
		
			
			let getHref1=baseUrl+"visitTypeReport";
			$.ajax({
			//	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"get",
				url:getHref1,
				data:{user_id:user_id,visit_type:visit_type,to:to,from:from,department:department,branch:branch},
                beforeSend: function() { $(".visit_type_report_data #load").show(); },
				}).done(function(data) {
				     history.pushState('', '',"{{url('admin/visitTypeReport')}}"+"?user_id="+user_id+"&from="+from+"&to="+to+"&visit_type="+visit_type+"&department="+department+"&branch="+branch);
                    $(".visit_type_report_data #load").show();
					$(".visit_type_report_data").empty();
					$(".visit_type_report_data").append(data);
                    $('.visit_type_report_data').find('#table_search').DataTable({"scrollX": true});
                    $('.visit_type_report_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});
        });

</script>

@endsection