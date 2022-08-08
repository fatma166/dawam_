@extends('layout.mainlayout')

@section('title')
    {{__('trans.evaluation_jobs')}}
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
                               
                                
                                <button class="btn add-btn" id="evlauation_val" data-toggle="modal" data-target="#job_evaluation" 
                                 class="job_evaluation"><i class="fa fa-plus"></i> {{ __('trans.job_evaluation') }}</button>  
                                
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
            
            
          	<div class="col-lg-12 col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table"  id="table_search">
											<thead>
												<tr>
							    	                 <th>{{__('trans.evaluation_job')}}</th>
                                                      <th>{{__('trans.elements-evaluation')}}</th>
                                                      <th>{{ __('trans.Action') }}</th>
												</tr>
											</thead>
											<tbody>
                                               
                                                @foreach($evaluation_keies as $jobsevaluations)
    												<tr>
    													
                                                        <td>
                                                           
                                                             <a class="dropdown-item" href="#" data-href="{{url('admin/editevaluationjob/'.$jobsevaluations['id'])}}" jobevaluation-id="{{$jobsevaluations['id']}}" data-toggle="modal" data-target="#edit_evaluation_job">{{ $jobsevaluations['jobname'] }}</a>
                                                       </td>
    												   <td>
                                                           {{$jobsevaluations['row']}}   <h4 style="color: red;">{{ __('trans.Total_Degree') }} {{$jobsevaluations['totaldegree']}}</h4>
                                                       </td>
    												    <td class="text-right">
                                                            <a class="btn btn-outline-success" href="#" data-href="{{url('admin/editevaluationjob/'.$jobsevaluations['id'])}}" jobevaluation-id="{{$jobsevaluations['id']}}" data-toggle="modal" data-target="#edit_evaluation_job"><i class="fa fa-pencil m-r-5"></i> {{__('trans.Edit')}}</a>
                                                            <a class="btn btn-outline-danger" href="#" data-toggle="modal" data-target="#delete_evaluationjob" delete-id="{{$jobsevaluations['id']}}"><i class="fa fa-trash-o m-r-5"></i> {{__('trans.Delete')}}</a>
                                                        </td>
                
    												</tr>
                                               @endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
                            <h5 class="note_title" hidden>{{ __('trans.Evaluation_Notification') }}</h5>
                            
                   
					</div>  
                         <!-- Edit job_evaluation Modal -->
        <div id="edit_evaluation_job" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                       
                          <h4>{{__('trans.JobEvaluationEdit')}}
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
                             <input type="hidden" name="jobEval_id" />
                            
                             
                           	<div class="table-responsive m-t-15">
										<table class="table table-striped custom-table">
											<thead>
												<tr>
													<th>{{__('trans.Element')}}</th>
            	                                    <th>{{__('trans.Checkelement')}}</th>
													<th>{{__('trans.degree_evaluation')}}</th>
												
												</tr>
											</thead>
											<tbody>
                                                 
                                                   	@foreach($evaluation as $eval)
        												<tr>
        													<td>{{$eval->title}}</td>
                                                           
                                                             <td><input type="checkbox"   name="element_id[{{$eval->id}}]"  value="{{$eval->id}}" class="Checkbox_Evaluation element" /></td>
                     	                                     <td class="text-center"> 
                                                              <input  type="number"  id="degree[{{$eval->id}}]"   name="degree[{{$eval->id}}]" class="form-control degree job_degree1" style="width:100px"
                                                                     min="0" />

        													</td>
        												    
        												</tr>
        											 @endforeach
										
											</tbody>
										</table>
									</div>
         
                                   <hr />
                                    <h5 style="color:red">{{__('trans.Total_Degree')}}</h5>
                                    <input  type="number" disabled id="Edit_total_sum_value"  class="form-control"
                                                               style="width:100px" min="0" value="0"/>
                           
                            
                                 
                                <button class="btn btn-primary" type="edit">{{__('trans.Save')}}</button>
                           
                           
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
       <!-- Edit job_evaluation Modal -->
</div>
            
    <!-- /Add job - -Evaulation -->
        <div id="job_evaluation" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">{{__('trans.job_evaluation')}}</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
                             
								<form method="post" action="{{route('sotre_job_evaluation')}}">
                               
                                 @csrf
                                 
									<div class="row">
										<div class="col-sm-6 col-md-2"> 
                    							<div class="form-group form-focus select-focus">
                    						
                                            
                                                	<select class="select floating" name="job_evalutionsid"> 
                   									  
                                                       	@foreach($jobs as $job)
                                                           <option value="{{$job->id}}">{{$job->title}}</option>
                                                        @endforeach
                    								</select>
                                             
                    								<label class="focus-label">{{__('trans.job_name')}}</label>
                    							</div>
					                	</div>
                                        
									   
									
									</div>
                                    @if(!empty($job))
									<div class="table-responsive m-t-15">
										<table class="table table-striped custom-table job_evaluationtable">
											<thead>
												<tr>
													<th>{{__('trans.Element')}}</th>
            	                                    <th>{{__('trans.Checkelement')}}</th>
													<th>{{__('trans.degree_evaluation')}}</th>
												
												</tr>
											</thead>
											<tbody>
                                            
                                            
                                           	@foreach($evaluation as $eval)
												<tr>
													<td>{{$eval->title}}</td>
                                                   
                                                     <td><input type="checkbox"   name="evaluation_id[{{$eval->id}}]"  value="{{$eval->id}}" class="Checkbox_Evaluation" /></td>
             	                                     <td class="text-center"> 
                                                       <input  type="number" disabled id="degree[{{$eval->id}}]"  name="degree[{{$eval->id}}]" class="form-control job_degree1"
                                                               style="width:100px" min="0" required/>
                                                           
													</td>
												  
												</tr>
											 @endforeach
										
											</tbody>
										</table>
									</div>
                                       <hr />
                                    <h5 style="color:red">{{__('trans.Total_Degree')}}</h5>
                                    <input  type="number" disabled id="total_sum_value"  class="form-control"
                                                               style="width:100px" min="0" value="0"/>
                                 
									<div class="submit-section">
                                       
										<button class="btn btn-primary evaluation-add" disabled>Save</button>
                                         
                                       		</div>
                                         
                                  @else
								        <h2 style="color: red;">{{__('trans.AlljobsHasEvaluation')}}</h2>
                                   @endif   
								</form>
                                   
							
                                    
							</div>
						</div>
					</div>
				</div>
   
   





  

 




 </div>
     



  <!-- Delete representative Modal -->
        <div class="modal custom-modal fade" id="delete_evaluationjob" role="dialog">
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


   <!-- /Add job - -Evaulation -->
@endsection
 @section('script')
<script>
 /*evaluation  elements */
  
  /*  $(document).on("change", ".job_degree1", function() {
    var sum = 0;
    $(".job_degree1").each(function(){
        sum += +$(this).val();
    });
    //$(".total").val(sum);
    console.log(sum);
});*/
        
  //for enabled and disabled inputs
   $("input[type=text]").prop('disabled',true);
    var total=0;   
 $(".Checkbox_Evaluation").click(function(event)
{
    
 if($(this).is(':checked'))
 {
    //  alert($(this).val());
    $(this).closest('tr').find('.form-control').prop('disabled',false);
    $(this).closest('tr').find('.form-control').prop('required',true);
    
  
 }
 else
 {
    $(this).closest('tr').find('.form-control').prop('disabled','true');
    $(this).closest('tr').find('.form-control').prop('required',false);

                              
                              
    
    var inputvalue= $(this).closest('tr').find('.form-control').val();
    
    var sumvalue= $('#total_sum_value').val();
     $('#total_sum_value').val(sumvalue-inputvalue);
  
    $(this).closest('tr').find('.form-control').val('');
    
    
     var sumvalue2= $('#Edit_total_sum_value').val();
     $('#Edit_total_sum_value').val(sumvalue2-inputvalue);
    //console.log(ve);
    $(this).closest('tr').find('.form-control').val('');
   

 }
 
  //for enabled and disabled button
    var selected = new Array();
      $(".Checkbox_Evaluation:checked").each(function() {
                selected.push(this.value);
        });
        if (selected.length > 0) 
        {
             $(".evaluation-add").prop('disabled',false);
              $(".evaluation-add").prop('disabled',false);
            
              
        }
        else
        {
             $(".evaluation-btn").prop('disabled',true);
             $(".evaluationjob-btn").prop('disabled',true);
        }
         
 
 
});

//onshow 
$("#edit_evaluation_job").on('show.bs.modal', function(event) 
    {
           
             //$(".Checkbox_Evaluation").prop('checked',true);
              $("#edit_evaluation_job .element").attr('checked',false);
              $("#edit_evaluation_job .degree").val('');
               $("#edit_evaluation_job .degree").prop('disabled',true);
				var button = $(event.relatedTarget) //Button that triggered the modal
		     
		       var	getHref = button.data('href'); //get button href
				
				 var id = button.attr('jobevaluation-id'); 

				 update_url=baseUrl+"update-evaluationjob/"+id;
				 $('#edit_evaluation_job form').attr('action',update_url);
				$.ajax({
					url:getHref,
                   // data:{id:id},
				
					}).done(function(data) {
			        //  console.log(data);
                    //  return;
                     //return;
                     $('.modal-title').text(data.jobtitle.title);
                  $('input[name="jobEval_id"]').val(data.jobevalution.job_id);
                  var eleme_dgree=JSON.parse(data.jobevalution.element_degree); 
                  //  console.log(eleme_dgree)elem_id,degree;   
                
                  ///console.log(eleme_dgree)
                    	var total=0;			
					  jQuery.each(eleme_dgree, function( i, val ) {
					    
  					//	i = i.replace(/"|'/g,'');
						//console.log(i);
                   
                         
                   
        					 $('input[name="element_id['+i+']"]').attr('checked','checked');
        					  
        																																																																											$( "#" + i ).append( document.createTextNode( " - " + val ) );
        					  $('input[name="degree['+i+']"]').val(val);	
                               
                              $('input[name="degree['+i+']"]').prop('disabled',false);	
                              
                              //total += $('input[name="degree['+i+']"]').val(val);
                               total += parseInt($('input[name="degree['+i+']"]').val());
                               $('#Edit_total_sum_value').val(total);
                               
                             
                              
                             
                             });	
                            																																																															});
					       
                             
    });
					
	
			

			
			
  
        
       $('#edit_evaluation_job').on('hide.bs.modal', function ()
         {
            //location.reload();
           // location.reload();
          //$('input[name="degree['+i+']"]').val('');	
          // $('input[name="element_id['+i+']"]').attr('checked',false);
         //  $('input[name="element_id['+i+']"]').attr('checked',false);
         // $(".Checkbox_Evaluation").prop('checked',false);
         
           
        });
        
        /* $("#edit_evaluationjob").on('hide.bs.modal', function(){
            alert('The modal is about to be hidden.');
        });*/
 
     
         
      
   

        $("#delete_evaluationjob").on('show.bs.modal', function(event) {
				var button = $(event.relatedTarget) //Button that triggered the modal
				var id = button.attr('delete-id');
				del_id=id;
				delete_url=baseUrl+"delete-evaluationjob";
                $("#delete_evaluationjob .continue-btn").click(function(){
                    	$.ajax({
    					url:delete_url,    
    					data:{id:del_id},
    					 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    					type:"post"
    					}).done(function(data) {
    				     location.reload(true);
    	
    				});
                });
			
			});
           
            
   
     
   
       
     $("#job_evaluation").on('input', '.job_degree1', function () 
     {
            var calculated_total_sum = 0;
       $("#job_evaluation .job_degree1").each(function () {
         
           var get_textbox_value = $(this).val();
           
           if ($.isNumeric(get_textbox_value))
            {
              calculated_total_sum += parseFloat(get_textbox_value);
             
            }                  
            });
            
             $('#total_sum_value').val(calculated_total_sum); 
              
      
          });  
          
          
      $("#edit_evaluation_job").on('input', '.job_degree1', function () 
     {
            var calculated_total_sum = 0;
       $("#edit_evaluation_job .job_degree1").each(function () {
         
           var get_textbox_value = $(this).val();
           
           if ($.isNumeric(get_textbox_value))
            {
              calculated_total_sum += parseFloat(get_textbox_value);
             
            }                  
            });
             
             $('#Edit_total_sum_value').val(calculated_total_sum);  
      
          });    
          
   
	
</script>
@endsection
 