
<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.employes_list')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title"><?php echo e(__('trans.Employee')); ?></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo e(__('trans.Employee')); ?></li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i><?php echo e(__('trans.Add Employee')); ?> </a>
                            <div class="view-icons">
                                <a href="employees" class="grid-view btn btn-link" title="<?php echo e(__('trans.grid')); ?>"><i class="fa fa-th"></i></a>
                                <a href="employees-list" class="list-view btn btn-link active" title="<?php echo e(__('trans.list')); ?>"><i class="fa fa-bars"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
               <!-- <form action="search-employee" method="post">-->
                <?php echo csrf_field(); ?>
                <!-- Search Filter -->
               <!-- <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="name" id="employee_name">
                            <label class="focus-label"><?php echo e(__('trans.name')); ?></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="phone" id="employee_phone">
                            <label class="focus-label"><?php echo e(__('trans.Phone')); ?></label>
                        </div>
                    </div>
                    <?php if(!empty($branches)): ?>
                    <div class="col-sm-6 col-md-3"> 
                        <div class="form-group form-focus select-focus">
                            <select class="select floating" name="branch"> 
                            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option><?php echo e($branch->title?$branch->title:''); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <label class="focus-label"><?php echo e(__('trans.Designation')); ?></label>
                        </div>
                    </div>
                    <?php endif; ?>
                   <div class="col-sm-6 col-md-3">  
                        <a href="#" class="btn btn-success btn-block"><?php echo e(__('trans.Search')); ?> </a>  
                    </div>    
                </div>--> 
                <!-- /Search Filter -->
                
               <!-- </form>-->
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
                                        <th><?php echo e(__('trans.Name')); ?></th>
                                        <th><?php echo e(__('trans.Employee ID')); ?></th>
                                        <th><?php echo e(__('trans.Email')); ?></th>
                                        <th><?php echo e(__('trans.Mobile')); ?></th>
                                        <th class="text-nowrap"><?php echo e(__('trans.Join Date')); ?></th>
                                        <th><?php echo e(__('trans.Branch')); ?></th>
                                        <th><?php echo e(__('trans.LastLogin')); ?></th>
                                        <th><?php echo e(__('trans.Status')); ?></th>
                                        <th class="text-right no-sort"><?php echo e(__('trans.Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if($users): ?>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar"href="<?php echo e(url('admin/employee-profile/'.$user->id)); ?>"><img alt="" src="<?php echo e(asset($user->avatar)); ?>"></a>
                                                <a class=""  href="<?php echo e(url('admin/employee-profile/'.$user->id)); ?>"><?php echo e($user->name); ?> <span><?php echo e($user->job_title); ?></span></a>
                                            </h2>
                                        </td>
                                        <td><?php echo e($user->id); ?></td>
                                        <td><?php echo e($user->email); ?></td>
                                        <td><?php echo e($user->phone); ?></td>
                                        <td><?php echo e($user->join_date); ?></td>
                                        <td><?php echo e($user->branch_title); ?></td>
                                        <td><?php echo e($user->last_login); ?></td>
                                        <td class="text-center">
                                                <div class="dropdown action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-dot-circle-o <?php if($user->active==0): ?><?php echo e('text-danger'); ?><?php else: ?> <?php echo e('text-success'); ?> <?php endif; ?>"><?php if($user->active==0): ?><span><?php echo e(__('trans.NotActive')); ?></span><?php else: ?> <span><?php echo e(__('trans.Active')); ?></span> <?php endif; ?></i> 
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_employee" status="1" employee-id="<?php echo e($user->id); ?>"><i class="fa fa-dot-circle-o text-success"><span><?php echo e(__('trans.Active')); ?></span></i></a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_employee" status="0"  employee-id="<?php echo e($user->id); ?>"><i class="fa fa-dot-circle-o text-danger"><span><?php echo e(__('trans.NotActive')); ?></span></i></a>
                                                    </div>
                                                </div>
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-outline-success" href="#" data-href="<?php echo e(url('admin/employee-edit/'.$user->id)); ?>" data-toggle="modal" employee-id="<?php echo e($user->id); ?>" data-target="#edit_employee"><i class="fa fa-pencil m-r-5"></i><?php echo e(__('trans.Edit')); ?></a>
                                            <a class="btn btn-outline-danger" href="#" delete-id="<?php echo e($user->id); ?>"  data-toggle="modal" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> <?php echo e(__('trans.Delete')); ?></a>
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
            <div id="add_employee" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Add Employee')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                               <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                               </div>
                            <form action="<?php echo e(route('store-employee',$subdomain)); ?>" method="post">
                            <?php echo csrf_field(); ?>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Name')); ?><span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name">
                                        </div>
                                    </div>
                               
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Email')); ?> <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Password')); ?> </label>
                                            <input class="form-control" type="password" name="password">
                                           <!-- <input class="form-control" type="password" name="old_password">-->
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
                                            <label class="col-form-label"><?php echo e(__('trans.Joining Date')); ?> <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="joining_date"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Phone')); ?> </label>
                                            <input class="form-control" type="number" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.Jobs')); ?> <span class="text-danger">*</span></label>
                                            <div class="">
                                            <select class="select job_id" name="job_id">
                                                <?php if(isset($jobs)): ?> 
                                                    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($job->id); ?>"><?php echo e($job->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                 <?php endif; ?>;
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.Department')); ?> <span class="text-danger">*</span></label>
                                            <div class="">
                                            <select class="select department" name="department">
                                                <?php if(($roles['name']=="admin")|| (Session::has('company'))): ?> 
                                                <option value="Null"><?php echo e(__('trans.all')); ?></option>
                                                <?php endif; ?>
                                                <?php if(isset($departments)): ?> 
                                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($department->id); ?>"><?php echo e($department->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                 <?php endif; ?>;
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.Branch')); ?> <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select class="select branch" name="branch">
                                              
                                                    <?php if(isset($branchs)): ?> 
                                                        <?php $__currentLoopData = $branchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>;
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.shift')); ?> <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select class="select shift" name="shift_id">
                                                    <?php if(isset($shifts)): ?> 
                                                        <?php $__currentLoopData = $shifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($shift->id); ?>"><?php echo e($shift->title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>;
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.role')); ?> <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select class="select role" name="role_id">
                                                   <option value="Null"><?php echo e(__('trans.Employee')); ?></option>
                                                   
                                                    <?php if(!empty($roles_)): ?> 
                                                        <?php $__currentLoopData = $roles_; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($role->id); ?>" ><?php echo e($role->name); ?></option>
                                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>;
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Active')); ?> </label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch1" checked=""  name="active">
                                                <label class="custom-control-label" for="customSwitch1"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Bassma')); ?> </label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch2" checked=""  name="bassma">
                                                <label class="custom-control-label" for="customSwitch2"></label>
                                            </div>
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
            <!-- /Add Employee Modal -->
            
            <!-- Edit Employee Modal -->
            <div id="edit_employee" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Edit_employe')); ?></h5>
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
                                            <label class="col-form-label"><?php echo e(__('trans.Name')); ?><span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name">
                                        </div>
                                    </div>
                              
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Email')); ?> <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" name="email">
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
                                            <label class="col-form-label"><?php echo e(__('trans.Joining Date')); ?> <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="joining_date"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Phone')); ?> </label>
                                            <input class="form-control" type="number" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.Jobs')); ?> <span class="text-danger">*</span></label>
                                            <div class="">
                                            <select class="select job_id" name="job_id">
                                                <?php if(isset($jobs)): ?> 
                                                    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($job->id); ?>"><?php echo e($job->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                 <?php endif; ?>;
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                 
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.Department')); ?> <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select class="select department" name="department">
                                                    <option class="all_dep" value="Null"><?php echo e(__('trans.all')); ?></option>
                                                    <?php if(isset($departments)): ?> 
                                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($department->id); ?>"><?php echo e($department->title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>;
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.Branch')); ?> <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select class="select branch" name="branch">
                                                
                                                    <?php if(isset($branchs)): ?> 
                                                
                                                        <?php $__currentLoopData = $branchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>;
                                                </select>
                                            </div>
                                        </div>
                                    </div>
      
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.shift')); ?> <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select class="select shift" name="shift_id">
                                                    <?php if(isset($shifts)): ?> 
                                                        <?php $__currentLoopData = $shifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($shift->id); ?>"><?php echo e($shift->title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>;
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.role')); ?> <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select class="select role" name="role_id">
                                                   <?php if(($roles['name']=="admin")|| (Session::has('company'))): ?> 
                                                    <option value="Null"><?php echo e(__('trans.Employee')); ?></option>
                                                   <?php endif; ?>
                                                    <?php if(!empty($roles_)): ?> 
                                                        <?php $__currentLoopData = $roles_; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($role->id); ?>" ><?php echo e($role->name); ?></option>
                                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>;
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Active')); ?> </label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch3" checked=""  name="active">
                                                <label class="custom-control-label" for="customSwitch3"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Bassma')); ?> </label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch4" checked=""  name="bassma">
                                                <label class="custom-control-label" for="customSwitch4"></label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                </div>
        
                    
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="edit"><?php echo e(__('trans.Edit')); ?></button>
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
                                <h3><?php echo e(__('trans.Delete Employee')); ?></h3>
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
            <!-- Approve employee Modal -->
        <div class="modal custom-modal fade" id="approve_employee" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3><?php echo e(__('trans.employee_status')); ?></h3>
                            <p><?php echo e(__('trans.Are you sure want to change status for this employee?')); ?></p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <span class="btn btn-primary continue-btn"><?php echo e(__('trans.Approve')); ?></span>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn"><?php echo e(__('trans.Decline')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Approve employee  Modal -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>

	/*    Employee edit */
		$("#edit_employee").on('show.bs.modal', function(event) {
          
			var button = $(event.relatedTarget) //Button that triggered the modal
		 
			var getHref = button.data('href'); //get button href
			
			var id = button.attr('employee-id'); 
		   
		
			
		
			update_url=baseUrl+"employee-update/"+id;
			$('#edit_employee form').attr('action',update_url);
			$.ajax({
				url:getHref,
				data:{id:id},
				}).done(function(data) {
				$.each(data, function( index,employee){
				    
				  console.log(employee);
					$( "input[name*='name']" ).val(employee.name );
                    $( "input[name*='email']" ).val(employee.email );
					$( "input[name*='old_password']" ).val(employee.password );
					$( "input[name='joining_date']" ).val(employee.join_date );
                    $( "input[name*='phone']" ).val(employee.phone);
					$( "select[name='job_id']" ).val(employee.job_id);
					$( "select[name='department']" ).val(employee.department_id);
                    $( "select[name='branch']" ).val(employee.branch_id );
                    $( "select[name='role_id']" ).val(employee.role_id );

				});

			});
		});
     
       	$("#approve_employee").on('show.bs.modal', function(event) {
               
			var button = $(event.relatedTarget) //Button that triggered the modal

			 status = button.attr('status');

		     employee_id=button.attr('employee-id');
			
		});
		$("#approve_employee .continue-btn").click(function(){
		
     
		$.ajax({
				url:"<?php echo e(route('status-employee',$subdomain)); ?>",    
				data:{status:status,id:employee_id},
				type:"get",
				}).done(function(data) {
			     location.reload(true);

			});

		});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/employee/employees-list.blade.php ENDPATH**/ ?>