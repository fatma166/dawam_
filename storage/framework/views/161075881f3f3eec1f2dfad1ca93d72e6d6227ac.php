

<?php $__env->startSection('title'); ?>
     <?php echo e(__('trans.jobs')); ?>

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
                                <h3 class="page-title"> <?php echo e(__('trans.jobs')); ?></h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                    <li class="breadcrumb-item active"> <?php echo e(__('trans.jobs')); ?></li>
                                </ul>
                            </div>
                            
                            <div class="col-auto float-right ml-auto">
                               
                                
                                <a href="#" class="btn add-btn" id="evlauation_val" data-toggle="modal" data-target="#add_job" 
                                 class="add_job"  data-href="<?php echo e(url('admin/showelementevaluation/')); ?>"><i class="fa fa-plus"></i> <?php echo e(__('trans.Add Job')); ?></a>  
                                
                               
                               

                                <div class="view-icons">
                                
                                    <button  class="list-view btn btn-link active" title="<?php echo e(__('trans.list')); ?>">
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
                                                     <th><?php echo e(__('trans.jobs')); ?></th>
                                                     <th><?php echo e(__('trans.target_location_check')); ?></th>
                                                      <th><?php echo e(__('trans.elements-evaluation')); ?></th>
                                                      <th><?php echo e(__('trans.Action')); ?></th>
												</tr>
											</thead>
											<tbody>
                                               <?php $i=0; ?>
                                                <?php $__currentLoopData = $evaluation_keies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobsevaluations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    												<?php $i++; ?>
                                                    <tr>
    													<td><?php echo e($i); ?></td>
                                                        <td>
                                                           
                                                             <a class="dropdown-item" href="#" data-href="<?php echo e(url('admin/edit-evaluationjob/'.$jobsevaluations['id'])); ?>" jobevaluation-id="<?php echo e($jobsevaluations['id']); ?>" data-toggle="modal" data-target="#edit_evaluationjob"><?php echo e($jobsevaluations['jobname']); ?></a>
                                                       </td>
                                                       <td><?php echo e($jobsevaluations['target_location']=='1'?__('trans.Yes'):__('trans.No')); ?></td>
    												   <td>
                                                       <?php if($jobsevaluations['totaldegree']>0): ?>
                                                           <?php echo e($jobsevaluations['row']); ?>   <button class="btn-evaluate" style="color: red;"><?php echo e(__('trans.Total_Degree')); ?> <?php echo e($jobsevaluations['totaldegree']); ?></button>
                                                       <?php else: ?>
                                                         <button class="btn-evaluate"><?php echo e(__('trans.No Evluation Element')); ?></button>
                                                       <?php endif; ?>
                                                       </td>
    												    <td class="text-right">
                                                            <a class="btn btn-outline-success" href="#" data-href="<?php echo e(url('admin/edit-evaluationjob/'.$jobsevaluations['id'])); ?>" jobevaluation-id="<?php echo e($jobsevaluations['id']); ?>" data-toggle="modal" data-target="#edit_evaluationjob"><i class="fa fa-pencil m-r-5"></i> <?php echo e(__('trans.Edit')); ?></a>
                                                        </td>
                
    												</tr>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</tbody>
										</table>
								
							</div>
                            <h5 class="note_title" hidden><?php echo e(__('trans.Evaluation_Notification')); ?></h5>
                            
                   
					</div>  

                </div>
            </div>

        <!-- Edit add_job Modal -->
     
        <div id="edit_evaluationjob" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                       
                          <h5>
                              <?php echo e(__('trans.JobEvaluationEdit')); ?>

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
                           <?php echo csrf_field(); ?>
                             <input type="hidden" name="jobEval_id" />
                             <div class="col-sm-6">
                                <div class="form-group">
                                       
                                        <input class="form-control modal-title" type="text" name="title" class="job_title" required>
                                        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
									    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        
                                    </div>
                                    </div>
                                   <!-- client location check -->
                                  <div class="col-sm-3">
                                        <label class="d-block"><?php echo e(__('trans.client location check')); ?></label>
                                        <div class="leave-inline-form">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input client_location_check" type="radio" name="client_location_check" value="0" >
                                                <label class="form-check-label" for="carry_no"><?php echo e(__('trans.No')); ?></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-inpu client_location_check1" type="radio" name="client_location_check" value="1" checked>
                                                <label class="form-check-label" for="carry_yes"><?php echo e(__('trans.Yes')); ?></label>
                                            </div>
         
                                        </div>

                                  </div>
                            <!--target location check -->
                                <div class="col-sm-3">
                                    <label class="d-block"><?php echo e(__('trans.in target')); ?></label>
                                    <div class="leave-inline-form">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input target_location" type="radio" name="target_location_check" value="0" >
                                            <label class="form-check-label" for="carry_no"><?php echo e(__('trans.No')); ?></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-inpu target_location1" type="radio" name="target_location_check" value="1">
                                            <label class="form-check-label" for="carry_yes"><?php echo e(__('trans.Yes')); ?></label>
                                        </div>
    
                                    </div>
                                </div> 
                            <!--target location check -->
                         
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
                                                 
                                                   	<?php $__currentLoopData = $evaluation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eval1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        												<tr>
        													<td><?php echo e($eval1->title); ?></td>
                                                           
                                                             <td><input type="checkbox"   name="element_id[<?php echo e($eval1->id); ?>]"  value="<?php echo e($eval1->id); ?>" class="Checkbox_Evaluation element" /></td>
                     	                                     <td class="text-center"> 
                                                              <input  type="number"  id="degree[<?php echo e($eval1->id); ?>]"   name="degree[<?php echo e($eval1->id); ?>]" class="form-control degree job_degree1" style="width:100px"
                                                                     min="1" required />

        													</td>
        												    
        												</tr>
        											 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										
											</tbody>
										</table>
									</div>
         
                                   <hr />
                                    <h5 id="totlal_degreeelme" style="color:red"><?php echo e(__('trans.Total_Degree')); ?></h5>
                                    <input  type="number" disabled id="Edit_total_sum_value"  class="form-control"
                                                               style="width:100px" min="0" value="0"/>
                                   <div id="elments_empty" style="display: none;">
                                       <hr />
                                    <h5 class="txt-message"><?php echo e(__('trans.No Evaluation Elements')); ?></h5>
                                  <a href="<?php echo e(route('evaluations',$subdomain)); ?>"   class="btn btn-outline-success btn-message" 
                                             ><h5 class="txt-message"><?php echo e(__('trans.Click Here')); ?></h5></a>
                                  
                                 <hr />  
                                   </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary editjob-btn" type="edit"><?php echo e(__('trans.Save')); ?></button>
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
								<h5 class="modal-title"><?php echo e(__('trans.add_job')); ?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                           
								<form method="" action="<?php echo e(route('store-job',$subdomain)); ?>">
                                
								<div class="row">
                                                             
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Title')); ?> <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control job_title" type="text" name="title"  required >
                                            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger" role="alert">
                                                    <strong><?php echo e($message); ?></strong>
                                                </span>
    									    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                          <!--target location check -->
                                          <div class="col-sm-3">
                                                <label class="d-block"><?php echo e(__('trans.in target')); ?></label>
                                                <div class="leave-inline-form">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input target_location" type="radio" name="target_location_check" value="0" >
                                                        <label class="form-check-label" for="carry_no"><?php echo e(__('trans.No')); ?></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-inpu target_location1" type="radio" name="target_location_check" value="1" checked>
                                                        <label class="form-check-label" for="carry_yes"><?php echo e(__('trans.Yes')); ?></label>
                                                    </div>
                                                </div>
      
                                          </div> 
                                   
                                       <!-- client location check -->
                                          <div class="col-sm-3">
                                                <label class="d-block"><?php echo e(__('trans.client location check')); ?></label>
                                                <div class="leave-inline-form">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input client_location_check" type="radio" name="client_location_check" value="0" >
                                                        <label class="form-check-label" for="carry_no"><?php echo e(__('trans.No')); ?></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-inpu client_location_check1" type="radio" name="client_location_check" value="1" checked>
                                                        <label class="form-check-label" for="carry_yes"><?php echo e(__('trans.Yes')); ?></label>
                                                    </div>
                 
                                                </div>
      
                                          </div> 
                                                                           
                                    </div>

                                   
                                 
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
                                                               style="width:100px" min="1" />
                                                           
													</td>
												  
												</tr>
											 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										
											</tbody>
										</table>
									</div>
                                   
                                          
                                    
                                   
                                       <hr />
                                    <h5 id="totlal_degreeelme" style="color:red"><?php echo e(__('trans.Total_Degree')); ?></h5>
                                    <input  type="number" disabled id="total_sum_value"  class="form-control toal_s"
                                                               style="width:100px" min="0" value="0"/>
                                  
                                  <div id="elments_empty" style="display: none;">
                                       <hr />
                                    <h5 class="txt-message"><?php echo e(__('trans.No Evaluation Elements')); ?></h5>
                                  <a href="<?php echo e(route('evaluations',$subdomain)); ?>"   class="btn btn-outline-success btn-message" 
                                             ><h5 class="txt-message"><?php echo e(__('trans.Click Here')); ?></h5></a>
                                  
                                 <hr />  
                                   </div>
                                  
                                       
                                  
                                  <div class="submit-section">
                                       
                                    <button  id="jobeval button" class="btn btn-primary evaluation-btn" 
                                             type="add"><?php echo e(__('trans.Save')); ?></button>
                                                           
                                   </div>
                                         
                                  
								</form>
                                   
							
                                    
							</div>
						</div>
					</div>
				</div>
   
 </div>
     


   <!-- /Add job - -Evaulation -->
<?php $__env->stopSection(); ?>
 <?php $__env->startSection('script'); ?>
<script>
 
        
  //for enabled and disabled inputs
 
   // $("input[type=text]").prop('disabled',true);
    $("input[name=title]").prop('disabled',false);
    var total=0;   
 $(".Checkbox_Evaluation").click(function(event)
{
    
    if($(this).is(':checked'))
    {
        // alert($(this).val());
        $(this).closest('tr').find('.job_degree1').attr('disabled',false);
        $(this).closest('tr').find('.job_degree1').select();
        $(this).closest('tr').find('.job_degree1').attr('required',true);
        $(".evaluation-btn").prop('disabled',true);
        $("#edit_evaluationjob .editjob-btn").prop('disabled',true);
    
    }
    else
    {
        $(this).closest('tr').find('.job_degree1').attr('disabled','true');
        $(this).closest('tr').find('.job_degree1').attr('required',false);
        $("#add_job .evaluation-btn").attr('disabled',false);
        $("#edit_evaluationjob .editjob-btn").prop('disabled',false);                   
                                
      var inputvalue= $(this).closest('tr').find('.form-control').val();
     
       var sumvalue= $('#add_job form #total_sum_value').val();
      //   console.log(sumvalue);
     // return;
       $('#add_job form #total_sum_value').val(sumvalue-inputvalue);
       $(this).closest('tr').find('.form-control').val('');
        
        var sumvalue2= $('#Edit_total_sum_value').val();
        $('#Edit_total_sum_value').val(sumvalue2-inputvalue);
        //console.log(ve);
        $(this).closest('tr').find('.form-control').val('');
    

    }
 
 
});

    $(document).ready(function()
    {
        $('.job_degree1').on('keyup', function () {
            if($(this).val() !== "" && $(this).val() !==0) {
                $(".evaluation-btn").prop('disabled',false);
                $("#edit_evaluationjob .editjob-btn").prop('disabled',false);
            } else {
                $(".evaluation-btn").prop('disabled',true);
                $("#edit_evaluationjob .editjob-btn").prop('disabled',true);
                $(".job_degree1").prop('checked',false);
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
                    var button = $(event.relatedTarget) //Button that triggered the modal
		            var	getHref = button.data('href'); //get button href
				
				$.ajax({
					url:getHref,
                 
					}).done(function(data) {
			        
                      // console.log(data);
                      // return;
                      if(data.evaluationelements=='')
                    {
                        $("#add_job  .table-responsive").hide();
                         $("#add_job  form #elments_empty").css('display','block');
                         $("#add_job   form #total_sum_value").hide();
                         $("#add_job   form #totlal_degreeelme").hide();
                         

                    }
                   
                  else
                  {
                      $("#add_job  .table-responsive").show();
                       $("#add_job   form #total_sum_value").show();
                        $("#add_job   form #totlal_degreeelme").show();
                       $("#add_job  form #elments_empty").css('display','none');
                   }
                      
                      
                
                        });
					       
                    
                    
        });
    });
 
      
    $("#add_job").on('input', '.job_degree1', function () 
     {
            var calculated_total_sum = 0;
       $("#add_job  form .job_degree1").each(function () {
         
           var get_textbox_value = $(this).val();
          
           
           if ($.isNumeric(get_textbox_value))
            {
              calculated_total_sum += parseFloat(get_textbox_value);
              
             
            } 
                            
            });
            
             $('#total_sum_value').val(calculated_total_sum); 
              
            

      });  
          
      
      $("#edit_evaluationjob").on('hide.bs.modal', function(){
                 location.reload();
                 
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


<?php $__env->stopSection(); ?>
 
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/jobs/job-list.blade.php ENDPATH**/ ?>