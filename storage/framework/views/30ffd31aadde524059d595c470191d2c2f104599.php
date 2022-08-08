                
                    <div class="col-md-12 clients_result">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table">
                                <thead>
                                    <tr>
                                        
                                        <th><?php echo e(__('trans.Name')); ?></th>
                                         <th><?php echo e(__('trans.Address')); ?></th>
                                        <th><?php echo e(__('trans.Contact Person')); ?></th>
                                        <th class="text-right"><?php echo e(__('trans.Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($clients)): ?>
                                <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>    
                                            
                                            <a href="<?php echo e(url('/admin/client-profile/'.$client->id)); ?>" class="avatar"></a>
                                                                                             
                                            <h2 class="table-avatar">    
                                                 <!-- <a class="dropdown-item" href="#" data-href="<?php echo e(url('admin/client-edit/'.$client->id)); ?>" client-id="<?php echo e($client->id); ?>"
                                                           data-toggle="modal" data-target="#edit_client"><?php echo e($client->name); ?></a>-->
                                                 <a  href="<?php echo e(url('/admin/client-profile/'.$client->id)); ?>"><?php echo e($client->name); ?></a>
                                              
                                            </h2>
                                        </td>
                                        <td style="overflow:hidden; display: inline-block;text-overflow: ellipsis;white-space: nowrap;width:200px;}"><?php echo e($client->address); ?></td>
                                        <td><?php echo e($client->phone); ?></td>
                                        <td class="text-right">
                                            <a class="btn btn-outline-success" href="#" data-href="<?php echo e(url('admin/client-edit/'.$client->id)); ?>" client-id="<?php echo e($client->id); ?>" data-toggle="modal" data-target="#edit_client"><i class="fa fa-pencil m-r-5"></i> <?php echo e(__('trans.Edit')); ?></a>
                                           <!-- <a class="btn btn-outline-danger" href="#" data-toggle="modal" data-target="#delete_client" delete-id="<?php echo e($client->id); ?>"><i class="fa fa-trash-o m-r-5"></i> <?php echo e(__('trans.Delete')); ?></a>-->
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
               
                 <?php echo e($clients->appends($_GET)->links()); ?>                <?php /**PATH /home/dawam/public_html/manger/resources/views/client/search_client.blade.php ENDPATH**/ ?>