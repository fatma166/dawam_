<div class="row">
  <div class="col-md-12">
                        <div class="table-responsive">
                                
                           <table class="table table-striped custom-table mb-0 ">
                            <thead>
                                <tr>
                                   <th>#</th>
                                   <th></th>
                                    <th><?php echo e(__('trans.Title')); ?></th>
                                    <?php if(Auth::user()->role_id==2): ?>
                                         <th><?php echo e(__('trans.Company Title')); ?></th>
                                    <?php endif; ?>
                                    <th><?php echo e(__('trans.evaluation_month')); ?></th>
                                    <th><?php echo e(__('trans.Evaluation_Year')); ?></th>
                                    <th><?php echo e(__('trans.Jobs')); ?></th>
                                    <th><?php echo e(__('trans.department')); ?></th>
                                    <th><?php echo e(__('trans.Branch')); ?></th>
                                    <th><?php echo e(__('trans.Total_evalaution')); ?> </th>
                                    <th><?php echo e(__('trans.Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                          
                             
                    <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>
                        
                          <?php $__currentLoopData = $evalarray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               
                                <tr>
                                  
                                    <td class="text-center"><?php echo e(($users->currentPage() - 1)  * $users->links()->paginator->perPage() + $loop->iteration); ?></td>
                                    <td><input type="checkbox" checked="true" disabled="true" /></td>
                                       <td>
                                            <h2 class="table-avatar">
                                                  <a class="dropdown-item" href="<?php echo e(url('admin/branch-edit/')); ?>"
                                                       data-href="<?php echo e(url('admin/evaluationemplpye-edit/')); ?>" empevalution-id="" data-toggle="modal" data-target="#edit_empevalaution"
                                                       ><span><?php echo e($item['user_name']); ?> </span></a>
                                          
                                            </h2> 
                                        </td>
                                         
                                        <td>
                                        <?php echo e($item['month']); ?>

                                        <input type="hidden" value="<?php echo e($item['month']); ?>" name="month"/>
                                        
                                        </td>
                                        <td>
                                         <?php echo e($item['year']); ?>

                                           <input type="hidden" value="<?php echo e($item['year']); ?>" name="year"/>
                                         </td>
                                       
                                         <td><?php echo e($item['job']); ?></td>
                                          <td><?php echo e($item['department']); ?></td> 
                                          <td><?php echo e($item['branch']); ?></td>
                                          <td>
                                        
                                           <p><strong><small><?php echo e($item['element_degree']); ?> % </small></strong></p>
                                          
                                            <div class="progress">
											                        	 <div class="progress-bar bg-primary" role="progressbar" style="width:<?php echo e($item['element_degree']); ?>%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100">
                                                  
                                                 </div>
											                       </div>
                                        
                                          </td>
                                          <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                
                                               <?php if(!empty($item['status']) && $item['usereval']==0): ?>
                                                 <button class="btn btn-danger" id="evlauation_val" data-toggle="modal" data-target="#employes_evaluation" 
                                                          class="job_evaluation" evaluation-user="<?php echo e($item['user_id']); ?>"
                                                            evaluation-month="<?php echo e($item['month']); ?>"
                                                            evaluation-year="<?php echo e($item['year']); ?>"
                                                          ><?php echo e(__('trans.add_evaluation')); ?>

                                                          
                                                 </button> 
                                                 
                                                <?php elseif(!empty($item['status']) && $item['usereval']==1): ?>
                                             
                                                <a class="btn btn-outline-success" href="<?php echo e(url('admin/evaluationemp-edit/'.$item['evalution_id'])); ?>"
                                                 data-href="<?php echo e(url('admin/evaluationemp-edit/'.$item['evalution_id'])); ?>" empevalu-id="<?php echo e($item['evalution_id']); ?>" data-toggle="modal" data-target="#edit_evaluationemp"> <?php echo e(__('trans.View_Evaluation')); ?>

                                                  </a>
                                                <?php else: ?>

                                                <?php endif; ?>
                                            
                                            </div>
                                        </td>
                                     </tr>
                          
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          

                            </tbody>
                        </table>
                      
                      
                       
                           </div>
                          </div>
                        </div>
                        <?php echo e($users->appends($_GET)->links()); ?>

                     <?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/evaluations/evaluationsearch.blade.php ENDPATH**/ ?>