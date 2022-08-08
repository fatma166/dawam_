
 <div class="col-md-12 dialy_result" >
        <div class="table-responsive">
            <table class="table table-striped custom-table display nowrap" style="width:100%" id="table_search">
                <thead>
                    <th>#</th>
                    <th><?php echo e(__('trans.Empolyee')); ?></th>
                    <th><?php echo e(__('trans.time_in')); ?></th>
                    <th><?php echo e(__('trans.time_out')); ?></th>
                    <th><?php echo e(__('trans.date')); ?></th> 
                    <th><?php echo e(__('trans.department')); ?></th> 
                    <th><?php echo e(__('trans.branch')); ?></th>
                     <th><?php echo e(__('trans.time_zone')); ?></th> 
                     <?php if($type!="absent"): ?>  
                    <th><?php echo e(__('trans.details')); ?></th>  
                    <?php endif; ?>
                </thead>
                <tbody>
                   <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

                    <?php if(!empty( $attendances)): ?>
                    <?php //print_r($attendances); exit;?>
                        <?php $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=> $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       
                            <tr>
                                <td><?php echo e($index+1); ?></td>
                                <td>
                                    <h2 class="table-avatar">
                                        
                                    <?php if(isset($attendance['name'])): ?> <?php echo e($attendance['name']); ?> <?php endif; ?>
                                    </h2>
                                </td>

                                <td>
                                    <h2 class="table-avatar">
                                        
                                    <?php if(isset($attendance['time_in'])): ?> <?php echo e($attendance['time_in']); ?> <?php endif; ?>
                                    </h2>
                                </td>
                                <td>
                                    <h2 class="table-avatar">
                                        
                                    <?php if(isset($attendance['time_out'])): ?> <?php echo e($attendance['time_out']); ?> <?php endif; ?>
                                    </h2>
                                </td>
                                <td>
                                    <h2 class="table-avatar">
                                        
                                    <?php if(isset($attendance['Date'])): ?> <?php echo e($attendance['Date']); ?> <?php endif; ?>
                                    </h2>
                                </td>
                                 <td>
                                    <h2 class="table-avatar">
                                        
                                    <?php if(isset($attendance['dep_title'])): ?> <?php echo e($attendance['dep_title']); ?> <?php endif; ?>
                                    </h2>
                                </td>   
                                 <td>
                                    <h2 class="table-avatar">
                                        
                                    <?php if(isset($attendance['branch_title'])): ?> <?php echo e($attendance['branch_title']); ?> <?php endif; ?>
                                    </h2>
                                </td> 
                                <td>
                                        <h2 class="table-avatar">
                                            
                                        <?php if(isset($attendance['zone_name'])): ?> <?php echo e($attendance['zone_name']); ?> <?php endif; ?>
                                        </h2>
                                </td>
                                <?php if($type!="absent"): ?>
                       			<td>
                                     
                                     <i class="fa fa-id-card-o" user_id="<?php echo e($attendance['EmployeeId']); ?>" date="<?php echo e($attendance['Date']); ?>"  data-toggle="modal" data-target="#attendance_info"></i>
								</td>
                                <?php endif; ?>   
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div><?php /**PATH /home/dawam/public_html/manger/resources/views/reports/report_ajax/dialy_ajax.blade.php ENDPATH**/ ?>