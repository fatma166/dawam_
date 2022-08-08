@if($type!="ajax")
@extends('layout.mainlayout')
@section('title')
    {{__('trans.subscibe_companies')}}
@endsection
@section('content')
@endif
@if($type!="ajax")
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
                
                <!-- Page Header -->
                <div class="page-header">
                    
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Subscribed Companies</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Subscriptions</li>
                            </ul>
                        </div>
                    </div>
      
            
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-info">
                            <h6>{{__('trans.Joining')}}</h6>
                            <h4>12 <span>{{__('trans.This Month')}}</span></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-info">
                            <h6>{{__('trans.Renewal')}}</h6>
                            <h4>3 <span>{{__('trans.This Month')}}</span></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-info">
                            <h6>{{__('trans.Renewal')}}</h6>
                            <h4>0 <span>{{__('trans.Next Month')}}</span></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-info">
                            <h6>{{__('trans.Total Companies')}}</h6>
                            <h4>312</h4>
                        </div>
                    </div>
                </div>
             <!--search filter-->
                <form method="post" action="">
                <div class="row filter-row" >
                        <div class="col-sm-6 col-md-2"> 
                          <div class="form-group form-focus ">
                              <!--<select class="company_namew form-control" name="company_name"></select>   -->                         
                                <select class="form-group" name="company_name">
                                    <option value="all"></option>
                                    @foreach($companies as $company)
                                    
                                        <option value="{{$company->id}}">{{$company->title}}</option>   
                                    
                                    
                                    @endforeach
                                    
                                
                                </select>
                                <label class="focus-label">{{__('trans.Select Company')}}</label>
                            </div>
                        </div>

                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12"> 
                        <div class="form-group form-focus select-focus">
                            <select class="floating" name="status" > 
                                <option value="all"> {{__('trans.-- Select --')}} </option>
                                <option value="1"> {{__('trans.active')}} </option>
                                <option value="0"> {{__('trans.nonactive')}} </option>
                         
                            </select>
                            <label class="focus-label">{{__('trans.Status')}}</label>
                        </div>
                   </div>
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">  
                        <div class="form-group form-focus" >
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker " type="text" name="date_from">
                            </div>
                            <label class="focus-label">{{__('trans.date from')}}</label>
                        </div>
                    </div>
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">  
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text" name="date_to">
                            </div>
                            <label class="focus-label">{{__('trans.To')}}</label>
                        </div>
                    </div>
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">  
                        <a  class="btn btn-success btn-block" id="search_subscribe_companies"> {{__('trans.Search')}} </a>  
                   </div>     
                </div>
                </form>
                <!-- /Search Filter -->
      @endif  
                <!-- Company List -->
                <div class="row" id="subscribe_data">
                    <div class="col-md-12 subscribe_result">
                        <div class="table-responsive">	
                            <table class="table table-hover custom-table datatable mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('trans.Company')}}</th>
                                        <th>{{__('trans.Plan')}}</th>
                                        <th>{{__('trans.Users')}}</th>
                                        <th>{{__('trans.Plan Duration')}}</th>
                                        <th>{{__('trans.Start Date')}}</th>
                                        <th>{{__('trans.End Date')}}</th>
                                        <th>{{__('trans.Amount')}}</th>
                                        <th>{{__('trans.Paid Status')}}</th>
                                        <th>{{__('trans.Update Plan')}}</th>
                                        <th>{{__('trans.Pause-On')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach($company_plans as $index=>$company_plan)
                                
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="client-profile" class="avatar"><img src="img/profiles/avatar-19.jpg" alt=""></a>
                                                <a href="client-profile">{{$company_plan['title']}}</a>
                                            </h2>
                                        </td>
                                        <td>{{$company_plan['pay_type']}}</td>
                                        <td>{{$company_plan['number_user']}}</td>
                                        <td>{{$company_plan['duration']}}</td>
                                        <td>{{$company_plan['date_from']}}</td>
                                        <td>{{$company_plan['date_to']}}</td>
                                        <td>${{$company_plan['price_user']*$company_plan['duration']}}</td>
                                        <td><span class="badge bg-inverse-success">{{$company_plan['paid']}}</span></td>
                                        <td><a class="btn btn-primary btn-sm"  data-href="{{ url('admin/company_subscribe_show/'.$company_plan['id']) }}" data-id="{{$company_plan['id']}}" data-toggle="modal" data-target="#upgrade_plan">Change Plan</a></td>
                                        <td>
                                       
                                            <div class="status-toggle">
                                                <input type="checkbox" subscribe-id="{{$company_plan['id']}}" id="company_status_{{$company_plan['id']}}" class="check company_status" value="{{$company_plan['status']}}" @if($company_plan['status']==1){{'checked'}}@endif>
                                                <label for="company_status_{{$company_plan['id']}}" class="checktoggle">checkbox</label>
                                            </div>
                                        </td>
                                    </tr>
                                  @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /Company List -->
                
                <!-- Upgrade Plan Modal -->
                <div class="modal custom-modal fade" id="upgrade_plan" role="dialog">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                            <div class="modal-body">
                                <h5 class="modal-title text-center mb-3">Upgrade Plan</h5>
                                    <form id="regForm" method="post" action="{{route('subscribe-store-userplan',$subdomain)}}">
                                                    <div class="alert alert-danger print-error-msg" style="display:none">
                                                        <ul></ul>
                                                    </div>
                                                      <input class="form-control plan_id" type="hidden" name="expand" />
                                                    <p>????? ????? :</p>
                                                    
                                                    <!-- One "tab" for each step in the form: -->
                                                    <div class="col-sm-12">
                    
                                                      <div class="row ">
                                                                <input class="form-control  plan_id" type="hidden" name="plan_id" />
                                                                  <input class="form-control" type="hidden" name="company_id" />
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">{{ __('trans.currency') }} <span class="text-danger">*</span></label>
                                                                    <input class="form-control" type="text" name="currency">
                                                                </div>
                                                            </div>
                    
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">{{__('trans.Number Users')}}</label>
                                                                    <input class="form-control" type="number" name="users">
                                                                </div>
                                                            </div>
                    
                                                           <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">{{__('trans.Type')}}</label>
                        
                                                                    <select class="select" name="type">
                                                                    
                                                                        <option value="month">{{__('trans.month')}}</option>
                                                                        <option value="year">{{__('trans.year')}}</option>
                                                                    
                                                                    </select>
                                                                </div>
                                                            </div>
                    
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">{{__('trans.duration')}}</label>
                                                                    <input class="form-control" type="number" name="duration">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-6"> 
                                                                <div class="form-group form-focus ">  
                                                                       <label class="col-form-label">{{__('trans.Select Date From')}}</label>                                                  
                                                                        <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_from"></div>
                                                                        
                                                                </div>               
                                                            </div>  
                                                   
                                                   <section id="our-stats"  class="show_count" style="clear: both;">
                                                
                                                		<div class="row text-center amount-list">
                                                			<div class="col">
                                                					<div class="counter">
                                                						<i class="fa fa-user fa-2x"></i>
                                                						<h2 class="timer count-title count-number number_users"></h2>
                                                						<p class="count-text ">Users</p>
                                                					</div>
                                                			</div>
                                                			<div class="col">
                                                					<div class="counter">
                                                						<i class="fa fa-calendar-o fa-2x"></i>
                                                						<h2 class="timer count-title count-number duration"></h2>
                                                						<p class="count-text "><div class="type">month</div></p>
                                                					</div>
                                                			</div>
                                                			<div class="col">
                                                					<div class="counter">
                                                						<i class="fa fa-money fa-2x"></i>
                                                						<h2 class="timer count-title count-number total"></h2>
                                                						<p class="count-text ">Amount</p>
                                                					</div>
                                                			</div>
                                                
                                                		</div>
                                                	</section> 
                    
                                                    </div>
                                                    </div>
                    							<div class="m-t-20 text-center">
        											<button class="btn btn-primary submit-btn">Save</button>
        										</div>
                                         </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Upgrade Plan Modal -->


 @if($type!="ajax")    
            </div>
            <!-- /Page Content -->
            
        </div>
        <!-- /Page Wrapper -->
 @section('script')

<script>

	     getUrl=window.location;
         baseUrl1= getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
         baseUrl=baseUrl1+"/admin/";
     /*  search select 2 to company */
        $('.company_namew').select2({
            placeholder: 'Select Company_name',
            ajax: {
                url: baseUrl+'selectCompanySearch',
                dataType: 'json',
                delay: 250,
                minimumInputLength:3,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        /* end employee select 2*/
        
        
        	$("#search_subscribe_companies").click(function(){
			var company_name=$("select[name='company_name']").val();
            var status=$("select[name='status']").val();
            var date_from=$("input[name='date_from']").val();
			var date_to=$("input[name='date_to']").val();

			let getHref1=baseUrl+"subscribe_index";
			$.ajax({
				/*headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},*/
				type:"get",
				url:getHref1,
				data:{company_id:company_name,status:status,date_to:date_to,date_from:date_from,date_to:date_to},
               // beforeSend: function() { $("#month_body #load").show(); },
				}).done(function(data) {
                   // $("#month_body #load").hide(); 
					$(".subscribe_result").empty();
					$("#subscribe_data").append(data);
                  // $('#subscribe_data').find('.datatable').DataTable({"scrollX": true});
                  // $('#subscribe_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
                    
                   /* $(".employee_detail").each(function() {
                       
                       var $this = $(this);       
                       var _href = $this.attr("href"); 
                       $this.attr("href",_href+ '?date_from='+date_from+'&date_to='+date_to);
                    }); */  
               });
  
		});
        
            /* leave type status control */
          
            var annualSwitchStatus = false;
            $(".company_status").on('change', function() {
            
                   switch_id=$(this).attr('subscribe-id');
                if ($(this).is(':checked')) {
                     SwitchStatus= $(this).is(':checked');
                   
                    
                }
                else {
                     SwitchStatus= $(this).is(':checked');
                   
                }
                
                $.ajax({
      	                type:"post",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    	url:baseUrl+"company_subscribe_change_status",
						data:{switch_status:SwitchStatus,switch_id:switch_id},
						success:function(data){
							location.reload(true);
						}
                });
            });


    $("#upgrade_plan form select[name='type']").on( "change", function() {
           
       $(".show_count .type").text($("#upgrade_plan form select[name='type']").val());
         calcualte_toatal();

    });
    $("#upgrade_plan form input[name='users']").on( "change", function() {
        $(".show_count .number_users").text($("#upgrade_plan form input[name='users']").val());
        
         calcualte_toatal();
    });
    $("#upgrade_plan form input[name='duration']").on( "change", function() {
    
       $(".show_count .duration").text($("#upgrade_plan form input[name='duration']").val());
        calcualte_toatal();
    });
    function calcualte_toatal(){
             
       $.ajax({
        url:baseUrl+"subscribe_getPlan/"+$("#upgrade_plan form select[name='type']").val()+"/"+$("#upgrade_plan form input[name='currency']").val(),
        type:'post',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:{type:$("#upgrade_plan form select[name='type']").val()},
        success: function(data) {
            $("price_per_user").text(data.price_user);
            $(".plan_id").val(data.id);
            $("currency").text(data.price_user);
            $(".show_count .total").empty();
            $(".show_count .total").text($("#upgrade_plan form input[name='users']").val()*$("#upgrade_plan form input[name='duration']").val()* data.price_user);
            
        }
       });
    }
     /*  subscribe   COMPANY edit */
		$("#upgrade_plan button").click(function(e){
          
          e.preventDefault();
           calcualte_toatal();
          var total= $(".show_count .total").text();
          var nmber_users=$("#upgrade_plan form input[name='users']").val();
          var company_id=$("#upgrade_plan form input[name='company_id']").val();
          var plan_id=$("#upgrade_plan form input[name='plan_id']").val();
  
          var duration=$("#upgrade_plan form input[name='duration']").val();
          var date_from=$("#upgrade_plan form input[name='date_from']").val();
           var type=$("#upgrade_plan form select[name='type']").val();			
           
           var url=$('#upgrade_plan form').attr('action');
            $.ajax({
                url:url,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{company_id:company_id,plan_id:plan_id,total:total,nmber_users:nmber_users,duration:duration,date_from:date_from,type:type},
                success: function(data) {
                    
                    if(data.hasOwnProperty('success')){
				
                       //location.reload(true);
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });

		});
          /*   subscribe COMPANY edit */
		$("#upgrade_plan").on('show.bs.modal', function(event) {
                
    				var button = $(event.relatedTarget) //Button that triggered the modal
    			
    				var getHref = button.data('href'); //get button href
    				
    				var id = button.data('id'); 
                   
                    
    				update_url=baseUrl+"company_subscribe_upgrade/"+id; 
                     alert(update_url);   
    				$('#upgrade_plan form').attr('action',update_url);
                    
                    $.ajax({
                    url:getHref,
                   // type:'POST',
    			   // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{id:id},
                    success: function(data) {
                        
    					$.each(data, function( index,subscribe){
    					  
                   
                              $("#upgrade_plan form input[name='users']").val(subscribe.number_user);
                              $("#upgrade_plan form input[name='company_id']").val(subscribe.company_id);
                              $("#upgrade_plan form input[name='plan_id']").val(subscribe.plan_id);
                               $("#upgrade_plan form input[name='currency']").val(subscribe.currency);
                              $("#upgrade_plan form select[name='type']").val(subscribe.pay_type);
                              $("#upgrade_plan form input[name='duration']").val(subscribe.duration);
                              $("#upgrade_plan form input[name='date_from']").val(subscribe.date_from);
                              $(".show_count .total").text(subscribe.salary);
                              $(".show_count .number_users").text(subscribe.number_user);
                              $(".show_count .duration").text(subscribe.duration);
                              $(".show_count .type").text(subscribe.pay_type);
                              calcualte_toatal();
                        //  $(".show_count .total").text(subscribe.);
   					     
    						
    					});
                    }
                });   

			});
            
                  /*$.ajax({
                    url:$("#regForm").attr('action'),
                    type:'post',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(payment) {
                        console.log(payment);
                        //if(payment.status==""){
                            
    
                            var currency= $("#add_userplan form input[name='currency']").val();
                            var users= $("#add_userplan form input[name='users']").val();
                            var type= $("#add_userplan form select[name='type']").val();
                            var date_from= $("#add_userplan form input[name='date_from']").val();
                           
                            var duration= $("#add_userplan form input[name='duration']").val();
                            var total=  $(".show_count .amount-list .total").text();*/
</script>

@endsection
@endsection
@endif