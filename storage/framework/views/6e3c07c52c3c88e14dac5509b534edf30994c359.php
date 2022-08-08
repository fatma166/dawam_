

<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.ExceptionHolidays')); ?>

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
                            <h3 class="page-title"><?php echo e(__('trans.exception Holiday')); ?></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo e(__('trans.exception Holiday')); ?></li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_ex_holiday"><i class="fa fa-plus"></i> <?php echo e(__('trans.Add Holiday')); ?></a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0" id="table_search">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo e(__('trans.Title')); ?></th>                           
                                        <th><?php echo e(__('trans.Day From')); ?></th>
                                        <th><?php echo e(__('trans.Day to')); ?></th>
                                        <th class="text-right"><?php echo e(__('trans.Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($exception_holidays)): ?>
                                <?php $__currentLoopData = $exception_holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exceptionholiday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="holiday-completed">
                                        <td><?php echo e($exceptionholiday->id); ?></td>
                                        <td><?php echo e($exceptionholiday->title); ?></td>
                                        <td><?php echo e($exceptionholiday->date_from); ?></td>
                                        <td><?php echo e($exceptionholiday->date_to); ?></td>
                                        <td class="text-right">
                                            <a class="btn btn-outline-success" href="#"  data-href="<?php echo e(url('admin/exception-holidays-edit/'.$exceptionholiday->id)); ?>" ex_holiday-id="<?php echo e($exceptionholiday->id); ?>"  data-toggle="modal" data-target="#edit_ex_holiday"><i class="fa fa-pencil m-r-5"></i><?php echo e(__('trans.Edit')); ?></a>
                                            <a class="btn btn-outline-danger" href="#" data-toggle="modal" data-target="#delete_ex_holiday" delete-id="<?php echo e($exceptionholiday->id); ?>"><i class="fa fa-trash-o m-r-5"></i><?php echo e(__('trans.Delete')); ?></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                   
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
            
            <!-- Add Holiday Modal -->
            <div class="modal custom-modal fade" id="add_ex_holiday" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Add Holiday')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form action="<?php echo e(route('store-exception-holidays',$subdomain)); ?>" method="post">
                             <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label><?php echo e(__('trans.Holiday Name')); ?> <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="title">
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(__('trans.Holiday Date From')); ?><span class="text-danger">*</span></label>
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_from"></div>
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(__('trans.Holiday Date To')); ?> <span class="text-danger">*</span></label>
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_to"></div>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="add"><?php echo e(__('trans.Submit')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Holiday Modal -->
            
            <!-- Edit Holiday Modal -->
            <div class="modal custom-modal fade" id="edit_ex_holiday" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Edit Holiday')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                           <form action="" method="POST">
                           <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label>Holiday Name <span class="text-danger">*</span></label>
                                    <input class="form-control" value="New Year" type="text" name="title">
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(__('trans.Holiday Date From')); ?><span class="text-danger">*</span></label>
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_from"></div>
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(__('trans.Holiday Date To')); ?> <span class="text-danger">*</span></label>
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_to"></div>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="edit"><?php echo e(__('trans.Save')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Holiday Modal -->

            <!-- Delete Holiday Modal -->
            <div class="modal custom-modal fade" id="delete_ex_holiday" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3><?php echo e(__('trans.Delete Holiday')); ?></h3>
                                <p><?php echo e(__('trans.Are you sure want to delete?')); ?></p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn" continue_del=""><?php echo e(__('trans.Delete')); ?></a>
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
            <!-- /Delete Holiday Modal -->
            
        </div>
        <!-- /Page Wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/holiday/exception_holidays.blade.php ENDPATH**/ ?>