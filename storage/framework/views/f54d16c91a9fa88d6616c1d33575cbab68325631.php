                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                             <table class="table table-striped custom-table mb-0 " id="table_search">
                                <thead>
                                    <tr>
                                        <th >#</th>
                                         <th><?php echo e(__('trans.Title')); ?></th>
                                        <th><?php echo e(__('trans.Target user')); ?></th>
                                        <th><?php echo e(__('trans.client')); ?> </th>
                                         <th><?php echo e(__('trans.visit_type')); ?></th>
                                         <th><?php echo e(__('trans.Created_at')); ?></th>
                                         <th><?php echo e(__('trans.date')); ?> </th>
                                         <th><?php echo e(__('trans.Status')); ?> </th>
                                        
                                        <!--<th><?php echo e(__('trans.Address')); ?></th>-->
                                         <th><?php echo e(__('trans.department')); ?></th> 
                                         <th><?php echo e(__('trans.branch')); ?></th>
                                        
                                       
                                       
                                        <th class="text-right"><?php echo e(__('trans.Action')); ?></th>
                                
                                        <th><?php echo e(__('trans.Add Edit Client')); ?></th> 
                                         <th><?php echo e(__('trans.Add Rate')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

                                <?php $__currentLoopData = $outdoors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outdoor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($outdoor->id); ?></td>
                                        <td><?php echo e($outdoor->title); ?></td>
                                        <td><?php echo e($outdoor->username); ?></td>
                                        <td><?php echo e($outdoor->client_name); ?></td>
                                        <td ><!--style="overflow:hidden; display: inline-block;text-overflow: ellipsis;white-space: nowrap;width:200px;"-->
                                              <?php echo e($outdoor->visit_type_name); ?>

                                        </td>
                                       
                                        <td><?php echo e($outdoor->created_at); ?></td>
                                        <td><?php echo e($outdoor->date); ?></td>
                                        <td>
                                        
                                            <div class="dropdown action-label">
                                                <a class="btn btn-white btn-sm btn-rounded" href="#" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-dot-circle-o <?php if($outdoor->status=='deliverd'): ?><?php echo e('text-purple'); ?><?php elseif($outdoor->status=='pending'): ?><?php echo e('text-warning'); ?><?php elseif($outdoor->status=='start'): ?><?php echo e('text-success'); ?><?php elseif($outdoor->status=='inprogress'): ?><?php echo e('text-warning'); ?><?php elseif($outdoor->status=='done'): ?><?php echo e('text-success'); ?><?php else: ?><?php echo e('text-danger'); ?><?php endif; ?>"><?php if($outdoor->status=="deliverd"): ?><span><?php echo e(__('trans.deliverd')); ?></span><?php elseif($outdoor->status=="pending"): ?><span><?php echo e(__('trans.pending')); ?></span><?php elseif($outdoor->status=="seen"): ?><span><?php echo e(__('trans.seen')); ?></span><?php elseif($outdoor->status=="inprogress"): ?><span><?php echo e(__('trans.in_progress')); ?></span><?php elseif($outdoor->status=="done"): ?><span><?php echo e(__('trans.done')); ?></span><?php elseif($outdoor->status=="late"): ?><span><?php echo e(__('trans.late')); ?><?php endif; ?></span></i>
                                                </a>
                                               <!-- <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"><span><?php echo e(__('trans.deliverd')); ?></span></i></a>
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"><span> <?php echo e(__('trans.seen')); ?></span></i></a>
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"><span> <?php echo e(__('trans.in_progress')); ?></span></i></a>
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"><span> <?php echo e(__('trans.done')); ?></span></i></a>
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"><span><?php echo e(__('trans.late')); ?></span></i></a>
                                                   
                                                </div>-->
                                            </div>
                                        </td>
                                         
                                       <td>
                                            <h2 class="table-avatar">
                                                
                                             <?php if(isset($outdoor->dep_title)): ?> <?php echo e($outdoor->dep_title); ?> <?php endif; ?>
                                           
                                            </h2>
                                        </td>  
                                        <td>
                                            <h2 class="table-avatar">
                                                
                                             <?php if(isset($outdoor->branch_title)): ?> <?php echo e($outdoor->branch_title); ?> <?php endif; ?>
                                           
                                            </h2>
                                       </td>
                                        
                                        <td class="text-right">
                                            <a class="btn btn-outline-success" href="#" data-href="<?php echo e(url('admin/outdoor-edit/'.$outdoor->id)); ?>" outdoor-id="<?php echo e($outdoor->id); ?>"  data-toggle="modal" data-target="#edit_outdoor"><i class="fa fa-pencil m-r-5"></i><?php echo e(__('trans.Edit')); ?></a>
                                            <a class="btn btn-outline-danger" href="#" data-toggle="modal"  data-target="#delete_outdoor" delete-id="<?php echo e($outdoor->id); ?>"><i class="fa fa-trash-o m-r-5"></i> <?php echo e(__('trans.Delete')); ?></a>
                                        </td>
                                        
                                        <td>
                                               <div class="col-auto float-right ml-auto">
                                                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_edit_client" outdoor_id="<?php echo e($outdoor->id); ?>" data-href="<?php echo e(url('admin/outdoor-edit-client/'.$outdoor->id)); ?>"><i class="fa fa-plus"></i><?php echo e(__('trans.Add Edit Client')); ?> </a>
                                        
                                                </div>
                                       
                                       </td>
                                       <td>
                                               <div class="col-auto float-right ml-auto">
                                                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_edit_rate" outdoor_id="<?php echo e($outdoor->id); ?>" data-href="<?php echo e(url('admin/outdoor-edit-client/'.$outdoor->id)); ?>"><i class="fa fa-plus"></i><?php echo e(__('trans.Add Rate')); ?> </a>
                                        
                                                </div>
                                       
                                       </td>
              
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php echo e($outdoors->appends($_GET)->links()); ?>

                   <?php /**PATH /home/dawam/public_html/manger/resources/views/outdoors/search.blade.php ENDPATH**/ ?>