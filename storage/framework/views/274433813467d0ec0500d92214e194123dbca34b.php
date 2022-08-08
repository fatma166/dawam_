                <div class="col-md-12 userReport_result" >
                    <div class="table-responsive">
                          <h2 class="table-avatar">
                                                    
                               <?php if(isset($attendDaymonthly[$day_number][0]['name'])): ?> <?php echo e($attendDaymonthly[$day_number][0]['name']); ?> <?php endif; ?>
                          </h2>
                        <table class="table table-striped custom-table display nowrap" style="width:100%" >
                            <thead>
                                <th>#</th>
                                <th><?php echo e(__('trans.time_in')); ?></th>
                                <th><?php echo e(__('trans.time_out')); ?></th> 
                                <th><?php echo e(__('trans.status')); ?></th> 
                            </thead>
                            <tbody>
                          
                                <?php if(!empty( $attendDaymonthly)): ?>
                                    <?php $__currentLoopData = $attendDaymonthly; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day=> $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   
                                        <tr>
                                            <td><?php echo e($day); ?></td>


                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                    <?php if(isset($attendance[0]['time_in'])): ?> <?php echo e($attendance[0]['time_in']); ?> <?php endif; ?>
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                    <?php if(isset($attendance[0]['time_out'])): ?> <?php echo e($attendance[0]['time_out']); ?> <?php endif; ?>
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                    <?php if(isset($attendance[0]['status'])): ?> <?php echo e($attendance[0]['status']); ?> <?php endif; ?>
                                                </h2>
                                            </td>                                  
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div><?php /**PATH /home/dawam/public_html/manger/resources/views/reports/userRerport_ajax.blade.php ENDPATH**/ ?>