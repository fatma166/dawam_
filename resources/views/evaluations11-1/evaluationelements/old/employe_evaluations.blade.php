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
                                    <li class="breadcrumb-item"><a href="index.html">{{ __('trans.Dashboard') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('trans.evaluation_employes') }}</li>
                                </ul>
                            </div>
                            
                            <div class="col-auto float-right ml-auto">
                               
                                
                                <button class="btn add-btn" id="evlauation_val" data-toggle="modal" data-target="#employes_evaluation" 
                                 class="job_evaluation"><i class="fa fa-plus"></i> {{ __('trans.evaluation_employes') }}</button>  
                                
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
                    <div class="table-responsive">
                                       
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('trans.Title') }}</th>
                                    @if(Auth::user()->role_id==2)
                                         <th>{{ __('trans.Company Title') }}</th>
                                    @endif
                                    <th>{{ __('trans.evaluation_month') }}</th>
                                    <th>{{ __('trans.Evaluation_Year') }}</th>
                                    <th>{{ __('trans.Jobs') }}</th>
                                    <th>{{ __('trans.Branch') }}</th>
                                    <th>{{ __('trans.Total_evalaution') }} </th>
                                    <th>{{ __('trans.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                          
                                @if (isset($data_evaluation))
                                   @foreach($data_evaluation as $emp_eval)

                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                             
                                           <a class="dropdown-item" href="{{ url('admin/branch-edit/'.$emp_eval->id) }}"
                                                       data-href="{{ url('admin/evaluationemplpye-edit/'.$emp_eval->id) }}" empevalution-id="{{$emp_eval->id}}" data-toggle="modal" data-target="#edit_empevalaution"
                                                       ><span> {{ $emp_eval->user_name }} </span></a>
                                            
                                            </h2> 
                                        </td>
                                        <td>{{date("M",mktime(0,0,0,$emp_eval->month))}}</td>
                                         <td>{{$emp_eval->year}}</td>  
                                        <td>{{$emp_eval->job_name}}</td>   
                                          <td>{{$emp_eval->branch_name}}</td>  
                                          <td>
                                           <p><strong><small>{{$emp_eval->total_degree}}/ 100</small></strong></p>
                                          
                                            <div class="progress">
												<div class="progress-bar bg-primary" role="progressbar" style="width:{{$emp_eval->total_degree}}%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100">
                                                  
                                                </div>
											</div>
                                          </td>
                                       
                                       

                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ url('admin/evaluationemp-edit/'.$emp_eval->id) }}"
                                                       data-href="{{ url('admin/evaluationemp-edit/'.$emp_eval->id) }}" empevaluation-id="{{$emp_eval->id}}" data-toggle="modal" data-target="#edit_evaluationemp"><i
                                                            class="fa fa-pencil m-r-5"></i> {{ __('trans.Edit') }}
                                                     </a>
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_empevaluation"
                                                          delete-id="{{$emp_eval->id}}"><i class="fa fa-trash-o m-r-5"></i> {{__('trans.Delete')}}</a>
                                                   
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
   							              <!--<div class="form-group form-focus ">
                                                     
                                             <select class="employee_name  form-control emp_evaljob" name="user_id"> 
                                                <option>{{__('trans.Selected_Employes')}}</option>
                                              @if(isset($users))
                                                @foreach($users as $user)
                                                 <option value="{{$user->id}}">{{$user->name}}</option>
                                               @endforeach
                                               @endif
                                            </select>  
                                            
			                    	       </div>-->
                                           
                                           <div class="form-group form-focus ">
                                              <select class="employee_name  form-control" name="user_id" id="emp_evaljob" ></select>                            
                              
                                                <label class="focus-label">{{__('trans.Select Employee')}}</label>
                                            </div>
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
 
 
 //onshow 
$("#edit_evaluationemp").on('show.bs.modal', function(event) 
    {
            
				var button = $(event.relatedTarget) //Button that triggered the modal
		     
		       var	getHref = button.data('href'); //get button href
				
				var id = button.attr('empevaluation-id'); 

			 	update_url=baseUrl+"update_empevaluation/"+id;
			    $('#edit_evaluationemp form').attr('action',update_url);
				$.ajax({
					url:getHref,
                   // data:{id:id},
				
					}).done(function(data) {
			          // console.log(data);
                      
                    $("#edit_employeevaluation").empty();
                     $("#edit_employeevaluation").append(data);
             
             });
                             
                             
});
                             
                             
                             
  /* $('#edit_evaluationemp').on('hidden.bs.modal', function () {
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
   
          
          
           
            
          
	
</script>
@endsection
 