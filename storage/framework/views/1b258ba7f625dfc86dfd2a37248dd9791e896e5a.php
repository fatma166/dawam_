                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 " >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo e(__('trans.Title')); ?></th>
                                        <th><?php echo e(__('trans.Target user')); ?></th>
                                        <th><?php echo e(__('trans.Description')); ?> </th>  
                                        <th><?php echo e(__('trans.Status')); ?> </th>
                                        <th><?php echo e(__('trans.Created_at')); ?></th>
                                        <th><?php echo e(__('trans.Due Date')); ?></th>
                                        <th class="text-right"><?php echo e(__('trans.Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

                                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($task->id); ?></td>
                                        <td><?php echo e($task->title); ?></td>
                                        <td><?php echo e($task->username); ?></td>
                                        <td style="font-family: monospace;width: 2ch;overflow: hidden;white-space: nowrap;"><?php echo e($task->description); ?></td>
                                        <td>
                                        
                                            <div class="dropdown action-label">
                                                
                                              <i class="fa fa-dot-circle-o <?php if($task->status=='delivered'||$task->status=='done'): ?><?php echo e('text-success'); ?><?php else: ?><?php echo e('text-danger'); ?><?php endif; ?> "> <?php if($task->status=='delivered'): ?><?php echo e(__('trans.deliverd')); ?><?php elseif($task->status=="pending"): ?><?php echo e(__('trans.pending')); ?><?php elseif($task->status=="seen"): ?><?php echo e(__('trans.seen')); ?><?php elseif($task->status=="in_progress"): ?><?php echo e(__('trans.in_progress')); ?><?php elseif($task->status=="done"): ?><?php echo e(__('trans.done')); ?><?php elseif($task->status=="late"): ?><?php echo e(__('trans.late')); ?><?php else: ?><?php endif; ?></i>
                        
                                            </div>
                                        </td>
                                        <td><?php echo e($task->created_at); ?></td>
                                        <td><?php echo e($task->due_date); ?></td>

                                        <td class="text-right">
                                            <a class="btn btn-outline-success" href="#" data-href="<?php echo e(url('admin/task-edit/'.$task->id)); ?>" task-id="<?php echo e($task->id); ?>"  data-toggle="modal" data-target="#edit_task"><i class="fa fa-pencil m-r-5"></i><?php echo e(__('trans.Edit')); ?></a>
                                            <a class="btn btn-outline-danger" href="#" data-toggle="modal"  data-target="#delete_task" delete-id="<?php echo e($task->id); ?>"><i class="fa fa-trash-o m-r-5"></i> <?php echo e(__('trans.Delete')); ?></a>
                                        </td>
                                    </tr>
                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                <?php if(empty($tasks)): ?>
                                <tr><?php echo e(__('trans.no result')); ?></tr>
                                
                                <?php endif; ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 <?php echo e($tasks->appends($_GET)->links()); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/tasks/search.blade.php ENDPATH**/ ?>