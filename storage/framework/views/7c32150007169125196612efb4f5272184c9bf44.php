
<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.company')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title"><?php echo e(__('trans.Companies')); ?></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e(__('trans.Companies')); ?></li>
                        </ul>
                    </div>
                    

                </div>
            </div>
            <!-- /Page Header -->

      <div class="row">
            <div id="edit_employee">
                <div class="modal-content">
                   <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('trans.Edit Admin')); ?></h5>
                      
                            
                       
                    </div>
                     <div class="modal-body">
                       <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form action="<?php echo e(url('admin/employee-update/'.$admin_user->id)); ?>" method="post" enctype="multipart/form-data">
                           
                            <div class="row">
                                  

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Name')); ?><span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name" value="<?php echo e($admin_user->name); ?>">
                                        </div>
                                    </div>
                                       <input type="hidden" name="type" value="admin_edit" />
                                         <input type="hidden" name="type1" value="admin_edit" />
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Email')); ?> <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" name="email" value="<?php echo e($admin_user->email); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Password')); ?> </label>
                                            <input class="form-control" type="password" name="password"><small><?php echo e(__('trans.write only you want change')); ?></small>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Confirm Password')); ?></label>
                                            <input class="form-control" type="password" name="Confirm_Password">
                                        </div>
                                    </div>
                       
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Phone')); ?> </label>
                                            <input class="form-control" type="number" name="phone" value="<?php echo e($admin_user->phone); ?>">
                                        </div>
                                    </div>

                            
                               
                                    <div class="col-sm-12">
                                         <!-- end image -->
                                        <div class="submit-section">
                                            <button class="btn btn-primary submit-btn" type="edit"><?php echo e(__('trans.Save')); ?></button>
                                        </div>
                                    </div>

                        </form>
                    </div>
               <!-- </div>
            </div>
        </div>-->
        <!-- /Edit Employee Modal -->
        </div>
        </div>
    
   </div>
            
   </div>
        <!-- /Page Content -->

   </div>
        

       
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/admin/edit.blade.php ENDPATH**/ ?>