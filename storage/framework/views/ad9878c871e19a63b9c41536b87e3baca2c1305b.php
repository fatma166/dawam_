

        <div class="table-responsive">
             <table class="table table-striped custom-table">
                  <thead>
                              
                                <th>#</th>
                                <th><?php echo e(__('trans.Empolyee')); ?></th>
                                <th><?php echo e(__('trans.evaluation_month')); ?></th>
                                <th><?php echo e(__('trans.Evaluation_Year')); ?></th>
                                <th><?php echo e(__('trans.employe_job')); ?></th> 
                                <th><?php echo e(__('trans.employe_department')); ?></th> 
                                <th><?php echo e(__('trans.Branch')); ?></th> 
                                <th><?php echo e(__('trans.Total_evalaution')); ?></th> 
                           
                  </thead>
                <tbody>
              
                     <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>
                            <?php $__currentLoopData = $monthly; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                  <td class="text-center"><?php echo e(($empevalu->currentPage() - 1)  * $empevalu->links()->paginator->perPage() + $loop->iteration); ?></td> 
                                  <td>
                                            <h2 class="table-avatar">
                                                  <a class="dropdown-item" href="<?php echo e(url('admin/branch-edit/')); ?>"
                                                       data-href="<?php echo e(url('admin/evaluationemplpye-edit/')); ?>" empevalution-id="" data-toggle="modal" data-target="#edit_empevalaution"
                                                       ><span><?php echo e($item['user_name']); ?> </span></a>
                                          
                                            </h2> 
                                        </td>
                                         
                                        <td>
                                        <?php echo e(date("M",mktime(0,0,0,$item['month']))); ?>

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
                                          
                                           <p><strong><small><?php echo e(round(($item['emp_degree']),2)); ?> % </small></strong></p>
                                         
                                            <div class="progress">
												<div class="progress-bar bg-primary" role="progressbar" style="width:<?php echo e(($item['emp_degree'])); ?>%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100">
                                                  
                                                </div>
											</div>
                                            
                                            
                                          </td>
                                        
                                    </tr>
                          
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          
                </tbody>
            </table>
        </div>
       
  <?php echo e($empevalu->appends($_GET)->links()); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/reports/evaluationreport_ajax.blade.php ENDPATH**/ ?>