@extends('layout.mainlayout')

@section('title')
    {{__('trans.evaluation_employes')}}
@endsection

@section('content')




         <!-- /Table Grid -->
            <div class="page-wrapper">
                <!-- Page Content -->
                <div class="content container-fluid">
                   <!-- Page Header -->
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">{{ __('trans.evaluation_jobs') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('trans.evaluation') }}</li>
                                </ul>
                            </div>
                            
                            <div class="col-auto float-right ml-auto">
                               
                                
                              
                                
                                <div class="view-icons">
                                  
                                    <button  class="grid-view btn btn-link" title="{{__('trans.grid')}}">
                                       <i class="fa fa-th"></i>
                                    </button>
                                   
                                    <button  class="list-view btn btn-link active" title="{{__('trans.list')}}">
                                       <i class="fa fa-bars"></i>
                                    </button>    
                                  
                                   
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
        
             	<!-- Search Filter -->
					 <form method="get">
					<div class="row filter-row">
                           
    					   	<div class="col-sm-6 col-md-3">  
    							<div class="form-group form-focus">
                                <select class="employee_name  form-control" name="employee_name">
                                    
                                </select>
    							
    								<label class="focus-label">{{__('trans.Employee Name')}}</label>
    							</div>
                               
    						</div>
                              
                      <div class="col-sm-6 col-md-3"> 
                            <div class="form-group form-focus ">
                                <select class="select floating department" name="department">    
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
                                <select class="select floating branch" name="branch"> 
                                     <option value="all">{{__('trans.all')}}</option>
                                    @foreach($branchs as $branch)
                                    <option value="{{$branch->id}}">{{$branch->title}}</option>
                                   @endforeach
                                </select>
                                <label class="focus-label">{{__('trans.Select Branch')}}</label>
                            </div>


                        </div>
                      
     	             
					
					
						<div class="col-sm-6 col-md-3">  
							<a  class="btn btn-success btn-block" id="empeval_search"> {{__('trans.Search')}} </a>  
						</div>     
                    </div>
					</form>
                    
                   	<!-- /Search Filter -->
					<div id="evaluation_searchtable" style="display: none;">
                     <div class="table-responsive">
                          <div id="search_evaluation">
                                        
                                         
                          </div>       
                       
                         
                         
                         
                    </div>
                    </div>
              
          
        <!-- /Page Content -->

         <div class="row">
    
                <div class="col-sm-12">
    
                    @if(Session::has('success'))
    
                        <p class="alert alert-danger">{{ Session::get('success') }}</p>
    
                    @endif
    
                </div>
    
            </div>
            
            
          <!-- /Table List -->
                <div class="col-md-12">
                    
                    <div class="table-responsive evalaution_table">
                                
                        <table class="table table-striped custom-table" id="table_search">
                            <thead>
                                <tr>
                                   <th>#</th>
                                   <th></th>
                                    <th>{{ __('trans.Title') }}</th>
                                    @if(Auth::user()->role_id==2)
                                         <th>{{ __('trans.Company Title') }}</th>
                                    @endif
                                    <th>{{ __('trans.evaluation_month') }}</th>
                                    <th>{{ __('trans.Evaluation_Year') }}</th>
                                    <th>{{ __('trans.Jobs') }}</th>
                                    <th>{{ __('trans.department') }}</th>
                                    <th>{{ __('trans.Branch') }}</th>
                                    <th>{{ __('trans.Total_evalaution') }} </th>
                                    <th>{{ __('trans.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                          
                                  <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

                         <?php $i=0; ?>
                          
                          @foreach($evalarray as $item)
                             <?php $i++; ?>                           
                                <tr>
                                    <td>{{$i}}</td>
                                    <td><input type="checkbox" checked="true" disabled="true" /></td>
                                      <td>
                                            <h2 class="table-avatar">
                                                  <a class="dropdown-item" href="{{ url('admin/branch-edit/') }}"
                                                       data-href="{{ url('admin/evaluationemplpye-edit/') }}" empevalution-id="" data-toggle="modal" data-target="#edit_empevalaution"
                                                       ><span>{{$item['user_name']}} </span></a>
                                          
                                            </h2> 
                                        </td>
                                         
                                        <td>
                                        {{date("M",mktime(0,0,0,$item['month']))}}
                                        <input type="hidden" value="{{$item['month']}}" name="month"/>
                                        
                                        </td>
                                        <td>
                                         {{$item['year']}}
                                           <input type="hidden" value="{{$item['year']}}" name="year"/>
                                         </td>
                                       
                                         <td>{{$item['job']}}</td>
                                          <td>{{$item['department']}}</td> 
                                          <td>{{$item['branch']}}</td>
                                          <td>
                                          @if(!empty($item['emp_degree']))
                                           <p><strong><small>{{round(($item['emp_degree']/$item['evaluation_degree'])*100,2)}} % </small></strong></p>
                                          
                                            <div class="progress">
												<div class="progress-bar bg-primary" role="progressbar" style="width:{{($item['emp_degree']/$item['evaluation_degree'])*100}}%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100">
                                                  
                                                </div>
											</div>
                                            
                                            @endif
                                          </td>
                                          <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                
                                                
                                                
                                               @if(empty($item['evalution_jobs_id']))
                                                 <button class="btn btn-danger" id="evlauation_val" data-toggle="modal" data-target="#employes_evaluation" 
                                                          class="job_evaluation" evaluation-user="{{$item['user_id']}}"
                                                            evaluation-month="{{$item['month']}}"
                                                            evaluation-year="{{$item['year']}}"
                                                          >{{ __('trans.add_evaluation') }}
                                                          
                                                </button> 
                                                @else
                                                      <a class="btn btn-success" href="{{ url('admin/evaluationemp-edit/'.$item['evalution_id']) }}"
                                                       data-href="{{ url('admin/evaluationemp-edit/'.$item['evalution_id']) }}" empevalu-id="{{$item['evalution_id']}}" data-toggle="modal" data-target="#edit_evaluationemp"> {{ __('trans.View_Evaluation') }}
                                                     </a>
                                                @endif
                                            
                                            </div>
                                        </td>
                                    </tr>
                          
                          
                          
                          
                          
                         
                          
                          @endforeach
                          
                                 
                               
                                    
                                  
                               

                            </tbody>
                        </table>
                      
                         
                         
                         
                    </div>
                </div>
                   <!-- /End Table List -->   
            
            
            
        <!-- Edit job_evaluation Modal -->
        <div id="edit_evaluationemp" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                       
                          <h4>{{__('trans.Edit_EmployeEvaluation')}}
                           <label class="modal-title" style="color: red;"></label>
                           </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form method="POST">
                           @csrf
                           
							     
                                  <div id="edit_employeevaluation">
                                        
                                        
                                        
                                  </div>			
					     
                              
                              <button class="btn btn-primary" type="edit">{{__('trans.Save')}}</button> 
                           
                           
                           
                           
                            
                                 
                               
                           
                           
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
       <!-- Edit job_evaluation Modal -->
            
            
            
            
            
            <!-- /Add job - -Evaulation -->
        <div id="employes_evaluation" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">{{__('trans.add_employe_evaluation')}}</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
                             
								<form method="post" action="{{route('store_employeevaluation')}}">
                                 @csrf
                                 
									<div class="row filter-row">
									
                                     <div class="col-sm-6 col-md-3"> 
   							             
                        
                                          
                                      </div>		
                                   
                                   
                                    </div>
                                    <div id="eva_element">
                                         
                                    </div>
                                    
                                 
                                   
                                  
								</form>
                                   
						      

                                    
							</div>
						</div>
					</div>
          </div>
   <!-- /Add job - -Evaulation -->
   
     <!-- Delete representative Modal -->
        <div class="modal custom-modal fade" id="delete_empevaluation" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>{{__('trans.Delete evaluation')}}</h3>
                            <p>{{__('trans.Are you sure want to delete?')}}</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn" continue_del="">{{__('trans.Delete')}}</a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal"
                                        class="btn btn-primary cancel-btn">{{__('trans.Cancel')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 <!-- Delete representative Modal -->
     
          
    
</div>
            
  
  


 </div>
     



  
@endsection
 @section('script')
<script>

 $("#employes_evaluation").on('input', '.emp_degree', function () 
     {
            var calculated_total_sum = 0;
       $("#employes_evaluation .emp_degree").each(function () {
         
           var get_textbox_value = $(this).val();
         
           if ($.isNumeric(get_textbox_value))
            {
              calculated_total_sum += parseFloat(get_textbox_value);
             
            }                  
            });
           // console.log(calculated_total_sum);
            
             $('.emp_total_degree').val(calculated_total_sum); 
              
      
          });  


 $("#edit_evaluationemp").on('input', '.degree', function () 
     {
            var calculated_total_sum = 0;
       $("#edit_evaluationemp .degree").each(function () {
         
           var get_textbox_value = $(this).val();
         
           if ($.isNumeric(get_textbox_value))
            {
              calculated_total_sum += parseFloat(get_textbox_value);
             
            }                  
            });
           // console.log(calculated_total_sum);
            
             $('.total_sum_value').val(calculated_total_sum); 
              
      
          });  



 $('#emp_evaljob').on('change',(event) =>
  {
  
        var user_id=event.target.value
         //alert(user_id);
        $(".month").prop("disabled",false);
        var gethref=baseUrl+"getemployejob_id/"+user_id;
    	$.ajax
            ({
			     url:gethref
              				
			}).done(function(data) {
			       
                   console.log(data);
                   if(data)
                     {
                   
                         $('#eva_element').empty();
                        $('#eva_element').append(data);
                        // $("#evaluation_emptable").css('display','block');
                   }
                     
                   
                     });
                    
    
 });
 
 /*$(".add-btn").click(function(){
    
	
	var user_id = $("#evlauation_val evaluation-user").val(); 
    console.log(user_id);
     var gethref=baseUrl+"getemployejob_id/"+user_id;
			 	$.ajax
            ({
			     url:gethref
              				
			}).done(function(data) {
			       
                   console.log(data);
                   if(data)
                     {
                   
                         $('#eva_element').empty();
                        $('#eva_element').append(data);
                        // $("#evaluation_emptable").css('display','block');
                   }
                     
                     
                     });  
 });*/
 //onshow 
 
 $("#employes_evaluation").on('show.bs.modal', function(event) 
    {
            
	      var button = $(event.relatedTarget) //Button that triggered the modal
	         var user_id = button.attr('evaluation-user'); 
             
             var month = button.attr('evaluation-month');
             var year = button.attr('evaluation-year');
             
             //  console.log(month);
             
			 var gethref=baseUrl+"getemployejob_id/"+user_id;
			 	$.ajax
            ({
			     url:gethref
              				
			}).done(function(data) {
			       
                   //console.log(data);
                   if(data)
                     {
                   
                        $('#eva_element').empty();
                        $('#eva_element').append(data);
                        $("#eva_element  input[name='month']").val(month);
                        $("#eva_element  input[name='year']").val(year);	
                        // $("#evaluation_emptable").css('display','block');
                     }
                     
                     
                     });  
                             
                             
});
 
 
 
$("#edit_evaluationemp").on('show.bs.modal', function(event) 
    {
            
				var button = $(event.relatedTarget) //Button that triggered the modal
		     
		        var	getHref = button.data('href'); //get button href
				
				var id = button.attr('empevalu-id'); 

			 	update_url=baseUrl+"update_empevaluation/"+id;
			    $('#edit_evaluationemp form').attr('action',update_url);
				$.ajax({
					url:getHref,
                   // data:{id:id},
				
					}).done(function(data) {
			       //   console.log(data);
                      
                    $("#edit_employeevaluation").empty();
                     $("#edit_employeevaluation").append(data);
                    
        																																																																										
                         
                             
                             
     });
                             
                             
});
                             
                             
                             
 /*  $('#edit_evaluationemp').on('hidden.bs.modal', function () {
         location.reload();
        })*/
    																																																																				
					        
    	$("#delete_empevaluation").on('show.bs.modal', function(event) {
				var button = $(event.relatedTarget) //Button that triggered the modal
				var id = button.attr('delete-id');
				del_id=id;
				delete_url=baseUrl+"delete_empevaluation";
                $("#delete_empevaluation .continue-btn").click(function(){
                    	$.ajax({
    					url:delete_url,    
    					data:{id:del_id},
    					 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    					type:"post"
    					}).done(function(data) {
    					   //console.log(data);
    				     location.reload(true);
    	
    				});
                });
			
			});                       
   
         
    	/*$("#search_attendance").click(function(){
    	
		/*	var employee_name= $(".employee_name").val();
			var month=$(".month").val();
			var year=$(".year").val();
			
		
			
			let getHref1=baseUrl+"attendance/attendance_search";
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"post",
				url:getHref1,
				data:{employee_name:employee_name,month:month,year:year},
                beforeSend: function() { $("#attendance_data #load").show(); },
				}).done(function(data) {


                    $("#attendance_data #load").hide();
					$("#attendance_data").empty();
					$("#attendance_data").append(data);
                    $('#attendance_data').find('.datatable').DataTable({"scrollX": true});
                    $('#attendance_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});
            

		});
        */
       
       
       
     
     $("#empeval_search").click(function(){
        
        
         //$(".evalaution_search").show();
       //$(".evalaution_table").show();
      
           var employee_name= $(".employee_name").val();
            var department=$(".department").val();
            var branch=$(".branch").val();
            // 	var year=$(".year").val();
 	    	//	var month=$(".month").val();
 		
 			let getref=baseUrl+"evaluation_search";
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			    url:getref,
				//data:{employee_name:employee_name,month:month,year:year,department:department,branch:branch},
               	data:{employee_name:employee_name,department:department,branch:branch},
               	//data:{employee_name:employee_name,department:department,branch:branch,year:year,month:month},
				}).done(function(data)
                {
                  //console.log(data);
               
                  $(".evalaution_table").empty();
                  $(".evalaution_table").append(data);
                  $(".evalaution_table").find('.datatable').DataTable({"scrollX": true});
                  $(".evalaution_table").find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"}); 
                    //$("#evaluation_searchtable").empty();
			  	    //$("#evaluation_searchtable").append(data);
                    //$('#evaluation_searchtable').find('.datatable').DataTable({"scrollX": true});
                    //$('#evaluation_searchtable').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
		    	});

          
          
          
          
       });
    
            
          
	
</script>
@endsection
