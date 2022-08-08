
<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.FixedHolidays')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title"><?php echo e(__('trans.Fixed Holiday')); ?></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo e(__('trans.Fixed Holiday')); ?></li>
                            </ul>
                        </div>
                        <?php if($fixed_exist==0): ?>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_holiday"><i class="fa fa-plus"></i> <?php echo e(__('trans.Add Holiday')); ?></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>                       
                                        <th><?php echo e(__('trans.Day')); ?></th>
                                        <th class="text-right"><?php echo e(__('trans.Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($fixed_holiday)): ?>
                               
                                    <tr class="holiday-completed">
                                       <td><?php echo e($fixed_holiday->id); ?></td>
                                        <td><?php echo e($day_str); ?></td>
                                       
                                     
                                        <td class="text-right">
                                            <a class="btn btn-outline-success" href="#"  data-href="<?php echo e(url('admin/fixed-holidays-edit/'.$fixed_holiday->id)); ?>" fix_holiday-id="<?php echo e($fixed_holiday->id); ?>"  data-toggle="modal" data-target="#edit_fix_holiday"><i class="fa fa-pencil m-r-5"></i><?php echo e(__('trans.Edit')); ?></a>
                                            <a class="btn btn-outline-danger" href="#" data-toggle="modal" data-target="#delete_fix_holiday" delete-id="<?php echo e($fixed_holiday->id); ?>"><i class="fa fa-trash-o m-r-5"></i><?php echo e(__('trans.Delete')); ?></a>
                                        </td>
                                    </tr>
                        
                                <?php endif; ?>
                                   
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
            
            <!-- Add Holiday Modal -->
            <div class="modal custom-modal fade" id="add_holiday" role="dialog">
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
                            <form action="<?php echo e(route('store-fixed-holidays',$subdomain)); ?>" method="post">
                           
                                   <div class="table-responsive m-t-15">
                                    <table class="table table-striped custom-table">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><?php echo e(__('trans.saturday')); ?></th>
                                                <th class="text-center"><?php echo e(__('trans.sunday')); ?></th>
                                                <th class="text-center"><?php echo e(__('trans.monday')); ?></th>
                                                <th class="text-center"><?php echo e(__('trans.tuesday')); ?></th>
                                                <th class="text-center"><?php echo e(__('trans.wednsday')); ?></th>                
                                                <th class="text-center"><?php echo e(__('trans.thursday')); ?></th>
                                                <th class="text-center"><?php echo e(__('trans.friday')); ?></th>
                                               

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                               
                                                <td class="text-center">
                                                    <input  type="checkbox"  class="day_add" name="day[saturday]">
                                                </td>
                            
                                                
                                                <td class="text-center">
                                                    <input  type="checkbox" class="day_add" name="day[sunday]">
                                                </td>
                                      
                                                <td class="text-center">
                                                    <input  type="checkbox" class="day_add" name="day[monday]">
                                                </td>
                                            
                                                <td class="text-center">
                                                    <input  type="checkbox" class="day_add" name="day[tuesday]">
                                                </td>
                                           
                                                <td class="text-center">
                                                    <input  type="checkbox" class="day_add" name="day[wednsday]">
                                                </td>
                                                <td class="text-center">
                                                    <input  type="checkbox" class="day_add" name="day[thursday]">
                                                </td>
    
                                                <td class="text-center">
                                                    <input  type="checkbox" class="day_add" name="day[friday]">
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
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
            <div class="modal custom-modal fade" id="edit_fix_holiday" role="dialog">
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
                            <form  method="post">
                            <?php echo csrf_field(); ?>
                                   <div class="table-responsive m-t-15">
                                    <table class="table table-striped custom-table">
                                        <thead>
                                            <tr>
                               <th class="text-center"><?php echo e(__('trans.saturday')); ?></th>
                                                <th class="text-center"><?php echo e(__('trans.sunday')); ?></th>
                                                <th class="text-center"><?php echo e(__('trans.monday')); ?></th>
                                                <th class="text-center"><?php echo e(__('trans.tuesday')); ?></th>
                                                <th class="text-center"><?php echo e(__('trans.wednsday')); ?></th>                
                                                <th class="text-center"><?php echo e(__('trans.thursday')); ?></th>
                                                <th class="text-center"><?php echo e(__('trans.friday')); ?></th>
                                               

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">
                                                    <input  type="checkbox" name="day[saturday]">
                                                </td>
                            
                                                
                                                <td class="text-center">
                                                    <input  type="checkbox" name="day[sunday]">
                                                </td>
                                      
                                                <td class="text-center">
                                                    <input  type="checkbox" name="day[monday]">
                                                </td>
                                            
                                                <td class="text-center">
                                                    <input  type="checkbox" name="day[tuesday]">
                                                </td>
                                           
                                                <td class="text-center">
                                                    <input  type="checkbox" name="day[wednsday]">
                                                </td>
                                                <td class="text-center">
                                                    <input  type="checkbox"  name="day[thursday]">
                                                </td>
    
                                                <td class="text-center">
                                                    <input  type="checkbox" name="day[friday]">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="edit"><?php echo e(__('trans.Submit')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Holiday Modal -->

            <!-- Delete Holiday Modal -->
            <div class="modal custom-modal fade" id="delete_fix_holiday" role="dialog">
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
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/holiday/fixed_holiday.blade.php ENDPATH**/ ?>