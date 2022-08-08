                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 " id="table_search">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('trans.Employee')); ?></th>
                                        <th><?php echo e(__('trans.Leave Type')); ?></th>
                                        <th><?php echo e(__('trans.From')); ?></th>
                                        <th><?php echo e(__('trans.To')); ?></th>
                                        <th><?php echo e(__('trans.No of Days')); ?></th>
                                        <th><?php echo e(__('trans.Reason')); ?></th>
                                         <th><?php echo e(__('trans.reply')); ?></th>
                                        <th class="text-center"><?php echo e(__('trans.Status')); ?></th>
                                        <th class="text-right"><?php echo e(__('trans.Actions')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

                                 <?php $__currentLoopData = $leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile" class="avatar"><img alt="" src="img/profiles/avatar-09.jpg"></a>
                                                <a href="#"><?php echo e($leave->user_name); ?> <span></span></a>
                                            </h2>
                                        </td>
                                        <td><?php echo e($leave->name); ?></td>
                                        <td><?php echo e($leave->leave_from); ?></td>
                                        <td><?php echo e($leave->leave_to); ?></td>
                                        <td><?php echo e($leave->days); ?></td>
                                        <td><?php echo e($leave->leave_reson); ?></td>
                                         <td><?php echo e($leave->answer); ?></td>
                                        <td class="text-center">
                                            <div class="dropdown action-label">
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-dot-circle-o <?php if($leave->status=='refused'): ?> <?php echo e('text-danger'); ?> <?php else: ?> <?php echo e('text-success'); ?><?php endif; ?>">
                                                        <span><?php echo e($leave->status); ?></span>
                                                    </i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">

                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#stutas_leave" leave-id="<?php echo e($leave->id); ?>" status="accepted"><i class="fa fa-dot-circle-o text-success"><span> <?php echo e(__('trans.Accepted')); ?></span></i></a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#stutas_leave" status="refused" leave-id="<?php echo e($leave->id); ?>" ><i class="fa fa-dot-circle-o text-danger"><span></span><?php echo e(__('trans.Refused')); ?></i></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-outline-success" href="#" data-href="<?php echo e(url('admin/leaves-edit/'.$leave->id)); ?>" leave-id="<?php echo e($leave->id); ?>" data-toggle="modal" data-target="#edit_leave">
                                                <i class="fa fa-pencil m-r-5"></i><?php echo e(__('trans.Edit')); ?></a>
                                            <a class="btn btn-outline-danger" delete-id="<?php echo e($leave->id); ?>" href="#" data-toggle="modal"  data-target="#delete_leave">
                                                <i class="fa fa-trash-o m-r-5"></i><?php echo e(__('trans.Delete')); ?>

                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   
                                 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><?php /**PATH /home/dawam/public_html/manger/resources/views/leave/search.blade.php ENDPATH**/ ?>