
  <div class="col-md-12 month_result" >
        <div class="table-responsive">
             <table class="table table-striped custom-table " id="table_search">
                <thead>
                    <th>#</th>
                    <th><?php echo e(__('trans.Empolyee')); ?></th>
                    <th><?php echo e(__('trans.present days')); ?></th>
                    <th><?php echo e(__('trans.absent days')); ?></th> 
                    <th><?php echo e(__('trans.fixedholday')); ?></th> 
                    <th><?php echo e(__('trans.excepition holiday')); ?></th>
                      <th><?php echo e(__('trans.avg logged hours')); ?></th> 
                    <th><?php echo e(__('trans.total logged hours')); ?></th> 
                    <th><?php echo e(__('trans.late count')); ?></th> 
                    <th><?php echo e(__('trans.total late coming')); ?></th> 
                     <th><?php echo e(__('trans.count early leave')); ?></th> 
                    <th><?php echo e(__('trans.total early leave')); ?></th> 
                    <th><?php echo e(__('trans.withoutbsma')); ?></th> 
                    <th><?php echo e(__('trans.addded client')); ?></th>
                    <th><?php echo e(__('trans.department')); ?></th> 
                    <th><?php echo e(__('trans.branch')); ?></th> 
                       
                </thead>
                <tbody>
                <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

                    <?php if(!empty( $monthly)): ?>
                        <?php $__currentLoopData = $monthly; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=> $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       
<tr>
                                            <td><?php echo e($index+1); ?></td>
                                            <td>
                                                <h2 class="table-avatar">      
                                                    
                                                   <a href="<?php echo e(route('userReport',[$month['employeeId'],$subdomain])); ?>"  class="employee_detail">
                                                        <h2 class="table-avatar">
                                                            
                                                        <?php if(isset($month['name'])): ?> <?php echo e($month['name']); ?> <?php endif; ?>
                                                        </h2>
                                                    </a>
                                                </h2>
                                            </td>

                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                 <?php if(isset($month['present'])): ?> <?php echo e($month['present']); ?> <?php endif; ?>
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                <?php if(isset($month['absent'])): ?> <?php echo e($month['absent']); ?> <?php endif; ?>
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                <?php if(isset($month['fixed_holiday'])): ?> <?php echo e($month['fixed_holiday']); ?> <?php endif; ?>
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                <?php if(isset($month['exception_holiday'])): ?> <?php echo e($month['exception_holiday']); ?> <?php endif; ?>
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                <?php if(isset($month['avg_hours_daily'])): ?> <?php echo e($month['avg_hours_daily']); ?> <?php endif; ?>
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                <?php if(isset($month['logged_time'])): ?> <?php echo e($month['logged_time']); ?> <?php endif; ?>
                                                </h2>
                                            </td>
                                          
                                           <td>
                                                <h2 class="table-avatar">
                                                    
                                                <?php if(isset($month['late_count'])): ?> <?php echo e($month['late_count']); ?> <?php endif; ?>
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                <?php if(isset($month['total_late_coming'])): ?> <?php echo e($month['total_late_coming']); ?> <?php endif; ?>
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                <?php if(isset($month['total_early_leave_count'])): ?> <?php echo e($month['total_early_leave_count']); ?> <?php endif; ?>
                                               
                                                </h2>
                                            </td>
                                             <td>
                                                <h2 class="table-avatar">
                                                    
                                                 <?php if(isset($month['total_early_leave'])): ?> <?php echo e($month['total_early_leave']); ?> <?php endif; ?>
                                               
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                 <?php if(isset($month['withoutBsma'])): ?> <?php echo e($month['withoutBsma']); ?> <?php endif; ?>
                                               
                                                </h2>
                                            </td> 
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                 <?php if(isset($month['clients'])): ?> <?php echo e($month['clients']); ?> <?php endif; ?>
                                               
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                 <?php if(isset($month['department'])): ?> <?php echo e($month['department']); ?> <?php endif; ?>
                                               
                                                </h2>
                                            </td>  
                                             <td>
                                                <h2 class="table-avatar">
                                                    
                                                 <?php if(isset($month['branch'])): ?> <?php echo e($month['branch']); ?> <?php endif; ?>
                                               
                                                </h2>
                                            </td>                             
                                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
   </div>
<?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/reports/month_ajax.blade.php ENDPATH**/ ?>