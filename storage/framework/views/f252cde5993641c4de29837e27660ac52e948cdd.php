
   <div class="row">
                                    
      <input type="hidden" name="user_id" value="<?php echo e($evaluationemploye->user_id); ?>" />
      <input type="hidden" name="year" value="<?php echo e($evaluationemploye->year); ?>" />
       <input type="hidden" name="month" value="<?php echo e($evaluationemploye->month); ?>" />
      <input type="hidden" name="jobevaluation_id" value="<?php echo e($evaluationemploye->evalution_jobs_id); ?>" />
       <h3><?php echo e($evaluationemploye->users->name); ?></h3>
       <hr />
      <h3>Month: <?php echo e(date("M",mktime(0,0,0,$evaluationemploye->month))); ?>-<?php echo e($evaluationemploye->year); ?></h3>
    
	<div class="table-responsive m-t-15">
            <table class="table table-striped custom-table was-validated">
               <thead>
                     <tr>
            						 <th></th>
                                     <th>#</th>
                                      <th class="text-center"><?php echo e(__('trans.Element')); ?></th>
            						  <th class="text-center"><?php echo e(__('trans.degree_evaluation')); ?></th>
                                      <th  class="text-center"><?php echo e(__('trans.employe_degree')); ?></th>
                                 						
                     </tr>
               </thead>
                <tbody>
                                             <?php $i=0 ?>     
                                             <?php $total=0; ?> 
                                             <?php $element_total_degree=0; ?>       
                                        	<?php $__currentLoopData = $evaluation_keies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empeval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    								<tr>
                    									 <?php $i++ ?>
                                                         <td class="text-center"><input type="checkbox"  checked="true"  disabled   /></td>
                                                          	<td class="text-center"><?php echo e($i); ?></td>
                                                                       
                                                             <td class="text-center"> <?php echo e($empeval['eleme_title']); ?></td>
                                                              <td class="text-center"> <?php echo e($empeval['job_degree']); ?></td>           
                                 	                         <td class="text-center">
                                                                        <input  type="number"  id="degree[]"   name="degree[<?php echo e($empeval['elment_id']); ?>]"
                                                                           value="<?php echo e($empeval['emp_degree']); ?>" class="form-control degree" style="width:100px" max="<?php echo e($empeval['job_degree']); ?>"  min="0" required="" />
   										 	                             <input type="hidden" name="basic_degree[<?php echo e($empeval['elment_id']); ?>]" value="<?php echo e($empeval['job_degree']); ?>" />
                                                                </td>
                                                             
                    										
                                                             	    
              										</tr>
                    								 <?php $total += $empeval['emp_degree']; ?>
                                                     <?php $element_total_degree += $empeval['job_degree']; ?>			
            								 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                             
                                                                 
	              </tbody>
            	</table>
                <hr />
                 
                  <h5 style="color: red;"><?php echo e(__('trans.employe_Total_Degree')); ?></h5>
                  <input  type="number" disabled class="form-control total_sum_value"
                                                               style="width:100px" min="0" value="<?php echo e($total); ?>" />
                   <h5 style="color: red;"><?php echo e(__('trans.Basic_Total_Degree')); ?></h5>
                 <input  type="number" disabled class="form-control"
                                                               style="width:100px" min="0" value="<?php echo e($element_total_degree); ?>" />
        </div>
        
           </div><?php /**PATH /home/dawam/public_html/manger/resources/views/evaluations/edit_employeevaluation.blade.php ENDPATH**/ ?>