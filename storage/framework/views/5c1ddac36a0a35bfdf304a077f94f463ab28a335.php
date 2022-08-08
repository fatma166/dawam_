
<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.workflow')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title"><?php echo e(__('trans.workflow')); ?></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo e(__('trans.workflow')); ?></li>
                            </ul>
                        </div>
                  
                       
                            <div class="col-auto float-right ml-auto">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_workflow"><i class="fa fa-plus"></i> <?php echo e(__('trans.Add Workflow')); ?></a>
                            </div>
                       
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                          <?php if(Session::has('success')): ?>

                                <div class="alert alert-success">

                                    <?php echo e(Session::get('success')); ?>


                                    <?php

                                        Session::forget('success');

                                    ?>

                                </div>

                            <?php endif; ?>

   

                            <div class="row">

                                <div class="col-sm-12">

                                    <?php if(Session::has('error')): ?>

                                        <p class="alert alert-danger"><?php echo e(Session::get('error')); ?></p>

                                    <?php endif; ?>

                                </div>
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                                            
                                        <th><?php echo e(__('trans.workflow')); ?></th>
                                        <th><?php echo e(__('trans.show description')); ?></th>
                                        <th><?php echo e(__('trans.Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                               
                                <?php if((isset($workflows))): ?>
                                      <?php $i=0;?>
                                    <?php $__currentLoopData = $workflows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workflow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($workflow[0])): ?>
                                        <tr class="holiday-completed">
                                        <td><?php echo e(__('trans.workflow_setting')); ?> <?php echo e($i+1); ?></td>
                                        <td> <a class="btn add-btn" data-toggle="modal" data-href="<?php echo e(url('admin/workflow-edit/'.$workflow[0]->shift_id)); ?>" data-target="#view_workflow_shift" data-number="<?php echo e($i); ?>"> <?php echo e(__('trans.view')); ?></a></td>
                                        
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                      <!-- <a class="dropdown-item"  data-href="<?php echo e(url('/admin/workflow-edit/'.$workflow[0]->shift_id)); ?>" work_flow-id="<?php echo e($workflow[0]->shift_id); ?>"  data-toggle="modal" data-target="#edit_workflow"><i class="fa fa-pencil m-r-5"></i> <?php echo e(__('trans.Edit')); ?></a>-->
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#delete_workflow_shift" delete-id="<?php echo e($workflow[0]->shift_id); ?>"><i class="fa fa-trash-o m-r-5"></i> <?php echo e(__('trans.Delete')); ?></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php $i++; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                   
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
            
            <!-- Add workflow Modal -->
            <div class="modal custom-modal fade" id="add_workflow" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Add Workflow')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo e(route('store-workflow',$subdomain)); ?>" method="get">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="col-form-label"><?php echo e(__('trans.shift')); ?> <span class="text-danger">*</span></label>
                                        <select class="form-control" name="shift_id">
                                            <?php $__currentLoopData = $shifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                 <option value="<?php echo e($shift->id); ?>"><?php echo e($shift->description); ?>-<?php echo e($shift->time_from); ?>-<?php echo e($shift->time_to); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div id="overflow"  class=" col-sm-12 col-lg-12 col-md-12">
                                    <div class=" col-sm-12 col-lg-12 col-md-12" style="border:1px solid">
                                            <div class="col-sm-6 col-lg-6 col-md-6">
                                                <label class="col-form-label"><?php echo e(__('trans.type')); ?> <span class="text-danger">*</span></label>
                                                <select class="form-control" name="type[]">
                                                    <option value="overtime"><?php echo e(__('trans.overtime')); ?> </option>
                                                    <option value="before_leave"><?php echo e(__('trans.beforetime')); ?> </option>
                                                    <option value="late"><?php echo e(__('trans.late')); ?> </option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 col-lg-6 col-md-6">
                                                <label class="col-form-label"><?php echo e(__('trans.mints')); ?> <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number" name="mints[]">
                                            </div>
                                            <div class="col-sm-6 col-lg-6 col-md-6">
                                                <label class="col-form-label"><?php echo e(__('trans.hours')); ?> <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number" name="hours[]">
                                            </div>
                                            <div class="col-sm-6 col-lg-6 col-md-6">
                                                <label class="col-form-label"><?php echo e(__('trans.desc')); ?> <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="desc[]">
                                            </div>
                                            
                                    </div>
                                    
                                    </div>
                                    <span id="insertAfterBtn" onclick="add_flow();"><i class="fa fa-th"><?php echo e(__('trans.Add')); ?></i></span>  
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn"><?php echo e(__('trans.Submit')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Holiday Modal -->
            
            <!-- Edit Holiday Modal -->
            <div class="modal custom-modal fade" id="edit_workflow" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Workflow</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form  method="post">
                            <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="col-form-label"><?php echo e(__('trans.shift')); ?> <span class="text-danger">*</span></label>
                                        <select class="form-control" name="shift_id">
                                            <?php $__currentLoopData = $shifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                 <option value="<?php echo e($shift->id); ?>"><?php echo e($shift->description); ?>-<?php echo e($shift->time_from); ?>-<?php echo e($shift->time_to); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div id="overflow"  class=" col-sm-12 col-lg-12 col-md-12">
                                    <div class="edit_workflow_append">
                                            
                                    </div>
                                    
                                    </div>
                                    <span id="insertAfterBtn" onclick="add_flow();"><i class="fa fa-th"><?php echo e(__('trans.Add')); ?></i></span>  
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn"><?php echo e(__('trans.Submit')); ?></button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit workflow Modal -->
            	<!-- view_workflow Modal -->

                <div class="modal custom-modal fade" id="view_workflow_shift" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        		<div class="modal-header">
    								<h5 class="modal-title" style="text-align: center;"><?php echo e(__('trans.view workflow')); ?></h5>
    								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    									<span aria-hidden="true">&times;</span>
    								</button>
    							</div>
    							<div class="modal-body">
    								<div class="row">
    									
    										<div class="punch-status col-md-12 col-sm-12">
                                               <div class="view_workflow_append"></div>
    						
    										</div>
    								</div>
    							</div>
                        </div>
                    </div>
            </div>
				<!-- /view_workflow Modal -->
            <!-- Delete workflow Modal -->
            <div class="modal custom-modal fade" id="delete_workflow_shift" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3><?php echo e(__('trans.Delete workflow shift')); ?></h3>
                                <p><?php echo e(__('trans.Are you sure want to delete?')); ?></p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary workflow-continue-btn" continue_del=""><?php echo e(__('trans.Delete')); ?></a>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn"><?php echo e(__('trans.Cancel')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Delete workflow Modal -->

        </div>
        <!-- /Page Wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/workflow/index.blade.php ENDPATH**/ ?>