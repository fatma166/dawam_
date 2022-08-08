@extends('layout.mainlayout')

@section('title')
     {{__('trans.jobs')}}
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
                                <h3 class="page-title"> {{__('trans.jobs')}}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                                    <li class="breadcrumb-item active"> {{__('trans.jobs')}}</li>
                                </ul>
                            </div>
                            
                            <div class="col-auto float-right ml-auto">
                               
                                
                                <button class="btn add-btn" id="evlauation_val" data-toggle="modal" data-target="#add_job" 
                                 class="add_job"><i class="fa fa-plus"></i> {{ __('trans.Add Job') }}</button>  
                                
                                 <button class="btn add-btn" id="evlauation_val" data-toggle="modal" data-target="#add_job" 
                                 class="add_job"><i class="fa fa-plus"></i> {{ __('trans.Add Job') }}</button>  

                                <div class="view-icons">
                                  
                                 
                                   
                                    <button  class="list-view btn btn-link active" title="{{__('trans.list')}}">
                                       <i class="fa fa-bars"></i>
                                    </button>    
                                  
                                   
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
        
      
           
                   
          
        <!-- /Page Content -->

       
  <!-- /Table Grid -->
			   
  

<!-- /Table Grid -->




          	<div class="col-lg-12 col-md-12">
							
									<div class="table-responsive">
										<table class="table table-striped custom-table " id="table_search" >
											<thead>
												<tr>
							    	                 <th>#</th>
                                                     <th>{{__('trans.jobs')}}</th>
                                                     <th>{{__('trans.target_location_check')}}</th>
                                                      <th>{{__('trans.elements-evaluation')}}</th>
                                                      <th>{{ __('trans.Action') }}</th>
												</tr>
											</thead>
											<tbody>
                                               <?php $i=0; ?>
                                                @foreach($evaluation_keies as $jobsevaluations)
    												<?php $i++; ?>
                                                    <tr>
    													<td>{{$i}}</td>
                                                        <td>
                                                           
                                                             <a class="dropdown-item" href="#" data-href="{{url('admin/edit-evaluationjob/'.$jobsevaluations['id'])}}" jobevaluation-id="{{$jobsevaluations['id']}}" data-toggle="modal" data-target="#edit_evaluationjob">{{ $jobsevaluations['jobname'] }}</a>
                                                       </td>
                                                       <td>{{$jobsevaluations['target_location']=='1'?__('trans.Yes'):__('trans.No')}}</td>
    												   <td>
                                                       @if($jobsevaluations['totaldegree']>0)
                                                           {{$jobsevaluations['row']}}   <h4 style="color: red;">{{ __('trans.Total_Degree') }} {{$jobsevaluations['totaldegree']}}</h4>
                                                       @else
                                                         <h4>{{ __('trans.No Evluation Element') }}</h4>
                                                       @endif
                                                       </td>
    												    <td class="text-right">
                                                            <a class="btn btn-outline-success" href="#" data-href="{{url('admin/edit-evaluationjob/'.$jobsevaluations['id'])}}" jobevaluation-id="{{$jobsevaluations['id']}}" data-toggle="modal" data-target="#edit_evaluationjob"><i class="fa fa-pencil m-r-5"></i> {{__('trans.Edit')}}</a>
                                                        </td>
                
    												</tr>
                                               @endforeach
											</tbody>
										</table>
								
							</div>
                            <h5 class="note_title" hidden>{{ __('trans.Evaluation_Notification') }}</h5>
                            
                   
					</div>  

                </div>
            </div>

        <!-- Edit add_job Modal -->
        <div id="edit_evaluationjob" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                       
                          <h5>
                              {{__('trans.JobEvaluationEdit')}}
                          </h5>
                          
                         
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form method="POST" action="">
                           @csrf
                             <input type="hidden" name="jobEval_id" />
                            
                                <div class="form-group">
                                       
                                        <input class="form-control modal-title" type="text" name="title" class="job_title" required>
                                        @error('title')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
									    @enderror
                                    </div>
                            <!--target location check -->
                                <div class="col-sm-6">
                                    <label class="d-block">{{__('trans.in target')}}</label>
                                    <div class="leave-inline-form">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input target_location" type="radio" name="target_location_check" value="0" >
                                            <label class="form-check-label" for="carry_no">{{__('trans.No')}}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-inpu target_location1" type="radio" name="target_location_check" value="1">
                                            <label class="form-check-label" for="carry_yes">{{__('trans.Yes')}}</label>
                                        </div>
    
                                    </div>
                                </div> 
                            <!--target location check -->
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
                           
                                <div class="submit-section">
                                    <button class="btn btn-primary editjob-btn" type="edit">{{__('trans.Save')}}</button>
                                </div>
                                <br/>
                           
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
       <!-- Edit add_job Modal -->

            
    <!-- /Add job - -Evaulation -->
        <div id="add_job" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">{{__('trans.add_job')}}</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                           
								<form method="" action="{{route('store-job')}}">
                                
								<div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{ __('trans.Title') }} <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control job_title" type="text" name="title"  required >
                                        @error('title')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
									    @enderror
                                    </div>
                                    </div>
                                      <!--target location check -->
                                      <div class="col-sm-6">
                                            <label class="d-block">{{__('trans.in target')}}</label>
                                            <div class="leave-inline-form">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input target_location" type="radio" name="target_location_check" value="0" >
                                                    <label class="form-check-label" for="carry_no">{{__('trans.No')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-inpu target_location1" type="radio" name="target_location_check" value="1" checked>
                                                    <label class="form-check-label" for="carry_yes">{{__('trans.Yes')}}</label>
                                                </div>
             
                                            </div>
  
                                      </div> 
                                </div>


                                   
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
                                       
										<button  id="jobeval button" class="btn btn-primary evaluation-btn" 
                                                 type="add">{{__('trans.Save')}}</button>
                                         
        		                    </div>
                                         
                               
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
 
        
  //for enabled and disabled inputs
 
   // $("input[type=text]").prop('disabled',true);
    $("input[name=title]").prop('disabled',false);
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
           //  $(".evaluation-btn").prop('disabled',false);
              $(".evaluationjob-btn").prop('disabled',false);
            
              
        }
        else
        {
            // $(".evaluation-btn").prop('disabled',true);
             $(".evaluationjob-btn").prop('disabled',true);
        }
         
      
 
});

//onshow 


					
	
			

			
			
  
        
       $('#edit_evaluationjob').on('hide.bs.modal', function ()
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
				delete_url=baseUrl+"job-delete";
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
           
            
   
     
   
       
     $("#add_job").on('input', '.job_degree1', function () 
     {
            var calculated_total_sum = 0;
       $("#add_job .job_degree1").each(function () {
         
           var get_textbox_value = $(this).val();
           
           if ($.isNumeric(get_textbox_value))
            {
              calculated_total_sum += parseFloat(get_textbox_value);
             
            }                  
            });
            
             $('#total_sum_value').val(calculated_total_sum); 
              
      
          });  
          
          
      $("#edit_evaluationjob").on('input', '.job_degree1', function () 
     {
            var calculated_total_sum = 0;
       $("#edit_evaluationjob .job_degree1").each(function () {
         
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
 