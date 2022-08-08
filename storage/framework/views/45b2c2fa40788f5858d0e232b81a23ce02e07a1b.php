                              
                                  <hr />   
                               <div class="row">
                                         <span class="eval_employee_title"><?php echo e(__('trans.eval_employee_title')); ?></span>
                                        <h5 class="modal-title"><?php echo e($user->name); ?></h5>
                                         
                                        <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>" />
                                        <input type="hidden" name="month" value="" />
                                        <input type="hidden" name="year" value="" />
                                      
                                        <hr />   
                                        <h3 id="eval_month"></h3>
                                        <hr />   
                                        <h3 id="eval_year"></h3>
                                   
                                        
                                        <br />
                                       
                              
                                       <div class="table-responsive m-t-15">
										<table class="table table-striped custom-table was-validated" id="evaluation_emptable">
						                    <thead>
											
                                                    <th>#</th>
                                                     <th><?php echo e(__('trans.check')); ?></th>
                                                    <th><?php echo e(__('trans.Element')); ?></th>
											        <th><?php echo e(__('trans.degree_evaluation')); ?></th>
            	                                  	<th><?php echo e(__('trans.employe_degree')); ?></th>
												
								         	</thead>
											<tbody>
                                                 <?php $i=0; ?>
                                                 <?php $total=0; ?>
                                                 <?php $__currentLoopData = $evaluation_keies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                   
                                                    	<tr>
                                                           <?php $i++; ?>
                                                           <td><?php echo e($i); ?></td>
                                                          
        											        <td><input type="checkbox" checked="true" disabled="true" /></td>
                                                            <td><?php echo e($eval['title']); ?></td>
                                                            <td>
                                                               <?php echo e($eval['degree']); ?>

                                                                <input type="hidden" name="basic_degree[<?php echo e($eval['id']); ?>]" value="<?php echo e($eval['degree']); ?>" />
                                                            </td>
											                <td><input  type="number" id="degree_empval"  name="degree[<?php echo e($eval['id']); ?>]"  class="form-control emp_degree" max="<?php echo e($eval['degree']); ?>"  min="0" style="width:100px" required /></td>  
                                                           
                                                         <input  type="hidden"  name="evaljob_id" value="<?php echo e($eval['evaljob_id']); ?>" />   
                                                            
                                                             <input  type="hidden" value="<?php echo e($eval['id']); ?>"  />                                                       
        												</tr>
                                                        <?php $total +=$eval['degree']; ?>  
										         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                           
                                               
										
											</tbody>
										</table>
                                          <hr />
                                          
                                               
                                                    
                                              <h5 style="color: red;"><?php echo e(__('trans.Basic_Total_Degree')); ?></h5>
                                              	 <input  type="number" id="basic_empval" disabled  class="form-control" 
                                                          style="width:100px" required value="<?php echo e($total); ?>"/>  
                                                    <h5 style="color: red;"><?php echo e(__('trans.employe_Total_Degree')); ?></h5>
                                             <input  type="number" id="degree_empval"  disabled  class="form-control emp_total_degree"  style="width:100px" required value="0" />  
                                                                                                               
        									
                                                   	
                                                        
										      
                                           
                                               
										
										
                                         <div class="submit-section">
                                       
									             	<button class="btn btn-primary" id="eval_empbtn">Save</button>
                                         
                                            </div>
									</div>
                                    </div>
                              
              

  

                                
           
                                <?php /**PATH /home/dawam/public_html/manger/resources/views/evaluations/evaluation_table.blade.php ENDPATH**/ ?>