
<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.permissions')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title"><?php echo e(__('trans.Permission')); ?></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo e(__('trans.Permission')); ?></li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_permission"><i class="fa fa-plus"></i><?php echo e(__('trans.Add Permission')); ?> </a>
         
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <form action="search-permission" method="post">
                <?php echo csrf_field(); ?>
                <!-- Search Filter -->
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="name" id="employee_name">
                            <label class="focus-label"><?php echo e(__('trans.tablename')); ?></label>
                        </div>
                    </div>
  
                </div>
                <!-- /Search Filter -->
                
                </form>
                <?php if(Session::has('success')): ?>

                    <div class="alert alert-success">

                        <?php echo e(Session::get('success')); ?>


                        <?php

                            Session::forget('success');

                        ?>

                    </div>

                <?php endif; ?>


                <?php if(Session::has('error')): ?>

                    <div class="alert alert-success">

                        <?php echo e(Session::get('error')); ?>

                    </div>

                <?php endif; ?>
                <div class="row">
              
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table " id="table_search">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('trans.TableName')); ?></th>
                                        <th><?php echo e(__('trans.key')); ?></th>
                                        <th class="text-right no-sort"><?php echo e(__('trans.Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if($permissions): ?>
                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                               
                                                <a class="" data-href="<?php echo e(url('admin/permission-edit/'.$permission->id)); ?>" data-toggle="modal" permission-id="<?php echo e($permission->id); ?>" data-target="#edit_permission"><?php echo e($permission->table_name); ?></a>
                                            </h2>
                                        </td>
                                        <td><?php echo e($permission->key); ?></td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" data-href="<?php echo e(url('admin/permission-edit/'.$permission->id)); ?>" data-toggle="modal" permission-id="<?php echo e($permission->id); ?>" data-target="#edit_permission"><i class="fa fa-pencil m-r-5"></i><?php echo e(__('trans.Edit')); ?></a>
                                                    <a class="dropdown-item" delete-id="<?php echo e($permission->id); ?>"  data-toggle="modal" data-target="#delete_permission"><i class="fa fa-trash-o m-r-5"></i> <?php echo e(__('trans.Delete')); ?></a>
                                                </div>
                                            </div>
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
            
            <!-- Add Employee Modal -->
            <div id="add_permission" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Add Permission')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                               <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                            <form action="<?php echo e(route('store-permission',$subdomain)); ?>" method="post">
                            <?php echo csrf_field(); ?>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.TableName')); ?><span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="table_name">
                                        </div>
                                    </div>
                               
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Key')); ?> <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="key">
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
            </div>
            <!-- /Add Employee Modal -->
            
            <!-- Edit Employee Modal -->
            <div id="edit_permission" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(('trans.Edit Permission')); ?></h5>
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
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.TableName')); ?><span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="table_name">
                                        </div>
                                    </div>
                              
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Key')); ?> <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="key">
                                        </div>
                                    </div>

                                </div>
                       
        
                    
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="edit"><?php echo e(__('trans.Submit')); ?></button>
                                </div>
                         </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Employee Modal -->
            
            <!-- Delete Employee Modal -->
            <div class="modal custom-modal fade" id="delete_permission" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3><?php echo e(__('trans.Delete permission')); ?></h3>
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
            <!-- /Delete Employee Modal -->
            
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/permission/permission-list.blade.php ENDPATH**/ ?>