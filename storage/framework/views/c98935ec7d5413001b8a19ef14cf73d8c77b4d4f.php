
<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.outdoor-type')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title"><?php echo e(__('trans.visit_type')); ?></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo e(__('trans.visit_type')); ?></li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_outdoor_type"><i class="fa fa-plus"></i><?php echo e(__('trans.Add Visittype')); ?></a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">#</th>
                                        <th><?php echo e(__('trans.name')); ?></th>
                                        <th><?php echo e(__('trans.Created_at')); ?></th>
                                        <th class="text-right"><?php echo e(__('trans.Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $visit_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($visit_type->id); ?></td>
                                        <td><?php echo e($visit_type->name); ?></td>
                                      
                                        <td><?php echo e($visit_type->created_at); ?></td>
                                        
                                        <td class="text-right">
                                            <a class="btn btn-outline-success" href="#" data-href="<?php echo e(url('admin/outdoor-type-edit/'.$visit_type->id)); ?>" outdoor-type-id="<?php echo e($visit_type->id); ?>"  data-toggle="modal" data-target="#edit_outdoor_type">
                                                <i class="fa fa-pencil m-r-5"></i><?php echo e(__('trans.Edit')); ?>

                                            </a>
                                            <a class="btn btn-outline-danger" href="#" data-toggle="modal"  data-target="#delete_outdoor_type" delete-id="<?php echo e($visit_type->id); ?>">
                                                <i class="fa fa-trash-o m-r-5"></i><?php echo e(__('trans.Delete')); ?>

                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->

            <!-- Add outdoor Modal -->
            <div id="add_outdoor_type" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Add Visit Type')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form method="post" action="<?php echo e(route('store-outdoor-type',$subdomain)); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                   
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.name')); ?> <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name">
                                        </div>
                                    </div>
                                

                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="add"><?php echo e(__('trans.Submit')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Task -->
            
            <!-- Edit Task -->
            <div id="edit_outdoor_type" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Edit Visit')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form method="post">
                             <?php echo csrf_field(); ?>
                                <div class="row">
  
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Name')); ?> <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name">
                                        </div>
                                    </div>
   
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="edit"><?php echo e(__('trans.Save')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit task -->
            
            <!-- Delete task -->
            <div class="modal custom-modal fade" id="delete_outdoor_type" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3><?php echo e(__('trans.Delete visit type' )); ?></h3>
                                <p><?php echo e(__('trans.Are you sure want to delete?')); ?></p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary outdoor-type-continue-btn"><?php echo e(__('trans.Delete')); ?></a>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn"><?php echo e(__('trans.Cancel')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>php 
                </div>
            </div>
            <!-- /Delete task -->
        
        </div>
        <!-- /Page Wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/outdoors/visittype.blade.php ENDPATH**/ ?>