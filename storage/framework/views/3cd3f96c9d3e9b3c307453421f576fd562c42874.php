

<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.evaluation_jobs')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>




				


         <!-- /Table Grid -->
            <div class="page-wrapper">
                <!-- Page Content -->
                <div class="content container-fluid">
                   <!-- Page Header -->
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title"><?php echo e(__('trans.evaluation_jobs')); ?></h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                    <li class="breadcrumb-item active"><?php echo e(__('trans.evaluation')); ?></li>
                                </ul>
                            </div>
                            
                            <div class="col-auto float-right ml-auto">
                               
                                
                                <button class="btn add-btn" id="evlauation_val" data-toggle="modal" data-target="#job_evaluation" 
                                 class="job_evaluation"><i class="fa fa-plus"></i> <?php echo e(__('trans.job_evaluation')); ?></button>  
                                
                                <div class="view-icons">
                                  
                                    <button  class="grid-view btn btn-link" title="<?php echo e(__('trans.grid')); ?>">
                                       <i class="fa fa-th"></i>
                                    </button>
                                   
                                    <button  class="list-view btn btn-link active" title="<?php echo e(__('trans.list')); ?>">
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
    
                    <?php if(Session::has('success')): ?>
    
                        <p class="alert alert-danger"><?php echo e(Session::get('success')); ?></p>
    
                    <?php endif; ?>
    
                </div>
    
            </div>
            
            
          	<div class="col-lg-12 col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										
                                        <table class="table table-striped custom-table"  id="table_search">
											<thead>
												<tr>
							    	                 <th><?php echo e(__('trans.evaluation_job')); ?></th>
                                                      <th><?php echo e(__('trans.elements-evaluation')); ?></th>
                                                      <th><?php echo e(__('trans.Action')); ?></th>
												</tr>
											</thead>
											<tbody>
                                               
                                                <?php $__currentLoopData = $evaluation_keies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobsevaluations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    												<tr>
    													
                                                        <td>
                                                           
                                                             <a class="dropdown-item" href="#" data-href="<?php echo e(url('admin/editevaluationjob/'.$jobsevaluations['id'])); ?>" jobevaluation-id="<?php echo e($jobsevaluations['id']); ?>" data-toggle="modal" data-target="#edit_evaluation_job"><?php echo e($jobsevaluations['jobname']); ?></a>
                                                       </td>
    												   <td>
                                                           <?php echo e($jobsevaluations['row']); ?>   <h4 style="color: red;"><?php echo e(__('trans.Total_Degree')); ?> <?php echo e($jobsevaluations['totaldegree']); ?></h4>
                                                       </td>
    												    <td class="text-right">
                                                            <a class="btn btn-outline-success" href="#" data-href="<?php echo e(url('admin/editevaluationjob/'.$jobsevaluations['id'])); ?>" jobevaluation-id="<?php echo e($jobsevaluations['id']); ?>" data-toggle="modal" data-target="#edit_evaluation_job"><i class="fa fa-pencil m-r-5"></i> <?php echo e(__('trans.Edit')); ?></a>
                                                            <a class="btn btn-outline-danger" href="#" data-toggle="modal" data-target="#delete_evaluationjob" delete-id="<?php echo e($jobsevaluations['id']); ?>"><i class="fa fa-trash-o m-r-5"></i> <?php echo e(__('trans.Delete')); ?></a>
                                                        </td>
                
    												</tr>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</tbody>
										</table>
                                       
                                            
                                       
									</div>
								</div>
							</div>
                            <h5 class="note_title" hidden><?php echo e(__('trans.Evaluation_Notification')); ?></h5>
                            
                   
					</div>  
                         <!-- Edit job_evaluation Modal -->
        <div id="edit_evaluation_job" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                       
                          <h4 class="eval_title"><?php echo e(__('trans.JobEvaluationEdit')); ?></h4>
                           <label class="modal-title" style="color: red;"></label>
                           
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form method="POST">
                           <?php echo csrf_field(); ?>
                             <input type="hidden" name="jobEval_id" />
                            
                             
                           	<div class="table-responsive m-t-15">
										<table class="table table-striped custom-table">
											<thead>
												<tr>
													<th><?php echo e(__('trans.Element')); ?></th>
            	                                    <th><?php echo e(__('trans.Checkelement')); ?></th>
													<th><?php echo e(__('trans.degree_evaluation')); ?></th>
												
												</tr>
											</thead>
											<tbody>
                                                 
                                                   	<?php $__currentLoopData = $evaluation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        												<tr>
        													<td><?php echo e($eval->title); ?></td>
                                                           
                                                             <td><input type="checkbox"   name="element_id[<?php echo e($eval->id); ?>]"  value="<?php echo e($eval->id); ?>" class="Checkbox_Evaluation element" /></td>
                     	                                     <td class="text-center"> 
                                                              <input  type="number"  id="degree[<?php echo e($eval->id); ?>]"   name="degree[<?php echo e($eval->id); ?>]" class="form-control degree job_degree1" style="width:100px"
                                                                     min="1" />

        													</td>
        												    
        												</tr>
        											 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										
											</tbody>
										</table>
									</div>
         
                                   <hr />
                                    <h5 style="color:red"><?php echo e(__('trans.Total_Degree')); ?></h5>
                                    <input  type="number" disabled id="Edit_total_sum_value"  class="form-control"
                                                               style="width:100px" min="0" value="0"/>
                           
                            
                                 
                                <button class="btn btn-primary editjobeval_btn" type="edit"><?php echo e(__('trans.Save')); ?></button>
                           
                           
                            
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
								<h5 class="modal-title"><?php echo e(__('trans.job_evaluation')); ?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
                             
								<form method="post" action="<?php echo e(route('sotre_job_evaluation',$subdomain)); ?>">
                               
                                 <?php echo csrf_field(); ?>
                                 
									<div class="row">
										<div class="col-sm-6 col-md-6"> 
                    							<div class="form-group">
                    							<label class="focus-label"><?php echo e(__('trans.job_name')); ?></label>
                                            
                                                	<select  name="job_evalutionsid"> 
                   									  
                                                       	<?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                           <option value="<?php echo e($job->id); ?>"><?php echo e($job->title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    								</select>
                                             
                    							
                    							</div>
					                	</div>
                                        
									   
									
									</div>
                                    
                                    <?php if(!empty($job)): ?>
                                        <?php if(isset($eval)): ?>
    									<div class="table-responsive m-t-15">
    										<table class="table table-striped custom-table job_evaluationtable">
    											<thead>
    												<tr>
    													<th><?php echo e(__('trans.Element')); ?></th>
                	                                    <th><?php echo e(__('trans.Checkelement')); ?></th>
    													<th><?php echo e(__('trans.degree_evaluation')); ?></th>
    												
    												</tr>
    											</thead>
    											<tbody>
                                                
                                                
                                               	<?php $__currentLoopData = $evaluation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
    												<tr>
    													<td><?php echo e($eval->title); ?></td>
                                                       
                                                         <td><input type="checkbox"   name="evaluation_id[<?php echo e($eval->id); ?>]"  value="<?php echo e($eval->id); ?>" class="Checkbox_Evaluation" /></td>
                 	                                     <td class="text-center"> 
                                                           <input  type="number" disabled id="degree[<?php echo e($eval->id); ?>]"  name="degree[<?php echo e($eval->id); ?>]" class="form-control job_degree1"
                                                                   style="width:100px" min="1" required/>
                                                               
    													</td>
    												  
    												</tr>
    											 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    										
    											</tbody>
    										</table>
    									</div>
                                         <h5 style="color:red"><?php echo e(__('trans.Total_Degree')); ?></h5>
                                          <input  type="number" disabled id="total_sum_value"  class="form-control"
                                                               style="width:100px" min="0" value="0"/>
                                        <?php else: ?>
                                          <hr />
                                                <h5 style="color: yellow;"><?php echo e(__('trans.No Evaluation Elements')); ?></h5>
                                              <a href="<?php echo e(route('evaluations',$subdomain)); ?>"   class="btn btn-outline-success" 
                                                         ><h5 style="color: yellow;"><?php echo e(__('trans.Click Here')); ?></h5></a>
                                          
                                         <hr/>
                                      
                                        <?php endif; ?>
                                     
                                   
                                 
									<div class="submit-section">
                                       
										     <button class="btn btn-primary evaluation-add" disabled>Save</button>
                                         
                                       		</div>
                                           
                                  <?php else: ?>
								        <h2 style="color: red;"><?php echo e(__('trans.AlljobsHasEvaluation')); ?></h2>
                                   <?php endif; ?>   
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
                            <h3><?php echo e(__('trans.Delete evaluation')); ?></h3>
                            <p><?php echo e(__('trans.Are you sure want to delete?')); ?></p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn" continue_del=""><?php echo e(__('trans.Delete')); ?></a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal"
                                        class="btn btn-primary cancel-btn"><?php echo e(__('trans.Cancel')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


   <!-- /Add job - -Evaulation -->
<?php $__env->stopSection(); ?>
 <?php $__env->startSection('script'); ?>
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
  
   $(document).ready(function()
    {
        $('.job_degree1').on('keyup', function () {
            if($(this).val() !== "" && $(this).val() !== 0) {
                $("#job_evaluation .evaluation-add").prop('disabled',false);
                $("#edit_evaluation_job .editjobeval_btn").prop('disabled',false);
            } else {
                $("#job_evaluation .evaluation-add").prop('disabled',true);
               $("#edit_evaluation_job .editjobeval_btn").prop('disabled',true);
               // $(".job_degree1").prop('checked',false);
            }
        });

    //for prevent cut
        $('.job_degree1').bind('cut', function (e)
        {
            e.preventDefault();
        });

        $("#add_job").on('show.bs.modal', function(event)
            {
                    $("#add_job .job_degree1").val('');
                    $("#add_job .Checkbox_Evaluation").prop('checked',false);
                    $('#add_job .job_degree1').attr('disabled',true);
        });
    });
  
  
   $("input[type=text]").prop('disabled',true);
    var total=0;   
 $(".Checkbox_Evaluation").click(function(event)
{
    
    
 if($(this).is(':checked'))
 {
    //  alert($(this).val());
    $(this).closest('tr').find('.form-control').prop('disabled',false);
    $(this).closest('tr').find('.form-control').prop('required',true);
     $(this).closest('tr').find('.form-control').select();
  
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
   // $("#job_evaluation .evaluation-add").prop('disabled',true);

 }
 
  //for enabled and disabled button
    //var selected = new Array();
     // $(".Checkbox_Evaluation:checked").each(function() {
           //     selected.push(this.value);
      //  });
       // if (selected.length > 0) 
      //  {
            // $(".evaluation-add").prop('disabled',false);
            //  $(".evaluation-add").prop('disabled',false);
            
              
      //  }
       // else
       // {
            // $(".evaluation-btn").prop('disabled',true);
            // $(".evaluationjob-btn").prop('disabled',true);
      //  }
         
  if($("#total_sum_value").val()==0)
     {
        
         $("#job_evaluation  form .evaluation-add").prop('disabled',true);
     }
     
     if($("#edit_evaluation_job form #Edit_total_sum_value").val()==0)
     {
        
          $("#edit_evaluation_job .editjobeval_btn").prop('disabled',true);
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
            location.reload();
          
           
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
<?php $__env->stopSection(); ?>
 
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/evaluations/job_evaluations.blade.php ENDPATH**/ ?>