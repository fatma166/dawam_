               
                <div class="row" >
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 " id="table_search">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('trans.Visit Title')); ?></th>
                                        <th><?php echo e(__('trans.Employee')); ?></th>
                                         <th><?php echo e(__('trans.Client')); ?></th>
                                         <th><?php echo e(__('trans.Client Address')); ?></th>
                                        <th><?php echo e(__('trans.Client Contact Phone')); ?></th>
                                        <th><?php echo e(__('trans.Created Date')); ?></th>
                                        <th><?php echo e(__('trans.Visit Date')); ?></th>
                                        <th><?php echo e(__('trans.Status')); ?></th>
                                        <th><?php echo e(__('trans.Show Details')); ?></th>
                                        <th><?php echo e(__('trans.department')); ?></th> 
                                        <th><?php echo e(__('trans.branch')); ?></th>
                                        <th><?php echo e(__('trans.Rate')); ?></th>
                                        <th><?php echo e(__('trans.Add Edit Client')); ?></th>  

                                    </tr>
                                </thead>
                                <tbody>
                                 <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

                                 <?php $__currentLoopData = $outdoors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outdoor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                   
                                        <td>
                                            <strong><?php echo e($outdoor->title); ?></strong>
                                        </td>
                                        <td> <a href="profile" class="avatar avatar-xs">
                                                <img src="img/profiles/avatar-04.jpg" alt="">
                                             </a>
                                             <h2><a href="profile"><?php echo e($outdoor->name); ?></a></h2>
                                        </td>
                                        <td>
                                              <?php echo e($outdoor->client_name); ?>

                                        </td>
                                        <td>
                                              <?php echo e($outdoor->client_address); ?>

                                        </td>
                                        <td>
                                              <?php echo e($outdoor->contact_phone); ?>

                                        </td>
                                        <td>
                                              <?php echo e($outdoor->created_at); ?>

                                        </td>
                                        <td>
                                              <?php echo e($outdoor->visit_date); ?>

                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown action-label">
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                    <i class='fa fa-dot-circle-o <?php if($outdoor->status=="pending"): ?> <?php echo e('text-danger'); ?> <?php elseif($outdoor->status=="done"): ?><?php echo e('text-success'); ?><?php endif; ?>'></i> <?php echo e($outdoor->status); ?>

                                                </a>

                                            </div>
                                        </td>
                                        <td> 
                                        	
											<span class="first-off"><a href="javascript:void(0);" data-toggle="modal" visit_id="<?php echo e($outdoor->id); ?>" user_id="<?php echo e($outdoor->user_id); ?>" data-target="#visit_info"><i class="fa fa-check text-success"></i></a></span> 
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
                                       <td>
                                            <h2 class="table-avatar">
                                                
                                             <?php if(isset($outdoor->rate)): ?> <?php echo e($outdoor->rate); ?> <?php endif; ?>  %
                                           
                                            </h2>
                                      </td>
                                      <td>
                                               <div class="col-auto float-right ml-auto">
                                                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_edit_client" outdoor_id="<?php echo e($outdoor->id); ?>" data-href="<?php echo e(url('admin/outdoor-edit-client/'.$outdoor->id)); ?>"><i class="fa fa-plus"></i><?php echo e(__('trans.Add Edit Client')); ?> </a>
                                        
                                                </div>
                                       
                                       </td> 
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php echo e($outdoors->appends($search)->links()); ?><?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/outdoor_report/search.blade.php ENDPATH**/ ?>