
<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.department')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title"><?php echo e(__('trans.Departments')); ?></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><?php echo e(__('trans.Dashboard')); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e(__('trans.Department')); ?></li>
                        </ul>
                    </div>
                    
                    <div class="col-auto float-right ml-auto">
                       
                        <a href="<?php echo e(route('create-department',$subdomain)); ?>" class="btn add-btn" data-toggle="modal"
                            data-target="#add_department"><i class="fa fa-plus"></i> <?php echo e(__('trans.Add Department')); ?></a>
                           
                        <div class="view-icons">
                          
                                  <button  class="grid-view btn btn-link" title="<?php echo e(__('trans.grid')); ?>">
                                       <i class="fa fa-th"></i>
                                 </button>
                                   
                                <button  class="list-view btn btn-link active" title="<?php echo e(__('trans.list')); ?>">
                                       <i class="fa fa-bars"></i>
                               </button>    
                       
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
           
        <!-- /Table Grid -->
        			   
        <div class="row staff-grid-row" style="display: none;">
            <?php if(isset($departments)): ?>
                 <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
           
                 <div class="profile-widget">
                     
                     <div class="dropdown profile-action">
                         <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                              <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="<?php echo e(url('admin/department-edit/'.$department->id)); ?>"
                                            data-href="<?php echo e(url('admin/department-edit/'.$department->id)); ?>" dep-id="<?php echo e($department->id); ?>" data-toggle="modal" data-target="#edit_department"><i
                                                 class="fa fa-pencil m-r-5"></i> <?php echo e(__('trans.Edit')); ?></a>
                                      
                         </div>
                     </div>
                  

                      <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="#"><?php if(isset($department->title)): ?> <?php echo e($department->title); ?> <?php endif; ?></a></h4>
                      
                 </div>
             </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               <?php endif; ?>
         </div>
         <!-- /Table Grid -->


           
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table" id="table_search">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('trans.Title')); ?></th>
                                    <th><?php echo e(__('trans.Edit')); ?></th>

                                </tr>
                            </thead>
                            <tbody>
                          
                                <?php if(isset($departments)): ?>
                               
                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                       
                                            <h2 class="table-avatar">
                                               
                                                <a data-href="<?php echo e(url('admin/department-edit/'.$department2->id)); ?>" dep-id="<?php echo e($department2->id); ?>" data-toggle="modal"
                                                   data-target="#edit_department" style="cursor: pointer">
                                                    <?php if(isset($department2->title)): ?> <?php echo e($department2->title); ?> <?php endif; ?></span>
                                                </a>
                                            </h2>
                                          
                                        </td>
                                       
                                        <td class="text-right">
                                          
                                            <a type="button" class="btn btn-outline-success" href="<?php echo e(url('admin/department-edit/'.$department2->id)); ?>"
                                                data-href="<?php echo e(url('admin/department-edit/'.$department->id)); ?>" dep-id="<?php echo e($department2->id); ?>" data-toggle="modal" data-target="#edit_department">
                                                <i class="fa fa-pencil m-r-5"></i><?php echo e(__('trans.Edit')); ?>

                                            </a>
                                            
                                           
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
           
        </div>
        <!-- /Page Content -->

        <!-- Add Employee Modal -->
        <div id="add_department" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('trans.Add department')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form method="Post" action="<?php echo e(route('store-department',$subdomain)); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                               <?php if(Auth::user()->role_id==2): ?>
                               <div class="col-sm-6">
     
                                    <div class="form-group form-focus select-focus">
                                        <select class="select floating" name="company_id"> 
                                            <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($company['id']); ?>"><?php echo e($company['title']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <label class="focus-label"><?php echo e(__('trans.Company')); ?></label>
                                    </div>
                                
                                </div>
                             
                                <?php endif; ?>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.Title')); ?> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="title"/>
                                    </div>
                                </div>
                

                            </div>
                           
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn" type="add"><?php echo e(__('trans.Submit')); ?></button>
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        
        <!-- /Add Employee Modal -->
        
        <!-- Edit Employee Modal -->
        <div id="edit_department" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('trans.Edit department')); ?></h5>
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
                                        <label class="col-form-label"><?php echo e(__('trans.Title')); ?><span class="text-danger">*</span></label>
                                        <input class="form-control" name="title" type="text">
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
        <!-- /Edit Employee Modal -->
       
        <!-- Delete Employee Modal -->
        <div class="modal custom-modal fade" id="delete_employee" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3><?php echo e(__('trans.Delete depart')); ?></h3>
                            <p><?php echo e(__('trans.Are you sure want to delete?')); ?></p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn"><?php echo e(__('trans.Delete')); ?></a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal"
                                        class="btn btn-primary cancel-btn"><?php echo e(__('trans.Cancel')); ?></a>
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

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/company/department/department-list.blade.php ENDPATH**/ ?>