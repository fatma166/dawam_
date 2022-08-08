
<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.Shifts')); ?>

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
                            <h3 class="page-title"><?php echo e(__('trans.shifts')); ?></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo e(__('trans.shifts')); ?></li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_shift"><i class="fa fa-plus"></i> <?php echo e(__('trans.Add shift')); ?></a>
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
                                        <th><?php echo e(__('trans.Title')); ?></th>
                                        <th><?php echo e(__('trans.From')); ?></th>
                                        <th><?php echo e(__('trans.To')); ?></th>
                                        <th><?php echo e(__('trans.main')); ?></th>
                                        <th class="text-center"><?php echo e(__('trans.Status')); ?></th>
                                         <?php if(Auth::user()->role_id==2): ?>
                                         <th><?php echo e(__('trans.Company Title')); ?></th>
                                         <?php endif; ?>
                                        <th class="text-right"><?php echo e(__('trans.Actions')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($shifts)): ?>
                                    <?php $__currentLoopData = $shifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
    
                                            <td><?php echo e($shift->title); ?></td>
                                            <td><?php echo e($shift->time_from); ?></td>
                                            <td><?php echo e($shift->time_to); ?></td>
                                            <td><?php if($shift->shift_default==1): ?><?php echo e(__('trans.Yes')); ?><?php else: ?><?php echo e(__('trans.No')); ?> <?php endif; ?></td>
                                            
                                            <td class="text-center">
                                                <div class="dropdown action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-dot-circle-o <?php if($shift->status==0): ?><?php echo e('text-danger'); ?><?php else: ?> <?php echo e('text-success'); ?> <?php endif; ?>"><?php if($shift->status==0): ?><span><?php echo e(__('trans.NotActive')); ?></span><?php else: ?><span><?php echo e(__('trans.Active')); ?></span><?php endif; ?></i> 
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_shift" status="1" shift_id="<?php echo e($shift->id); ?>"><i class="fa fa-dot-circle-o text-success"><span><?php echo e(__('trans.Active')); ?></span></i></a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_shift" status="0" shift_id="<?php echo e($shift->id); ?>"><i class="fa fa-dot-circle-o text-danger"><span><?php echo e(__('trans.NotActive')); ?></span></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                             <?php if(Auth::user()->role_id==2): ?>
                                            <td><?php echo e($shift->company_title); ?></td>
                                            <?php endif; ?>
                                            <td class="text-right">
                                                <a class="btn btn-outline-success" href="#" data-href="<?php echo e(url('admin/shift-edit/'.$shift->id)); ?>" shift-id="<?php echo e($shift->id); ?>"  data-toggle="modal" data-target="#edit_shift"><i class="fa fa-pencil m-r-5"></i><?php echo e(__('trans.Edit')); ?></a>
                                                <a class="btn btn-danger" data-toggle="modal"  href="#" data-target="#delete_shift" delete-id="<?php echo e($shift->id); ?>"><i class="fa fa-trash-o m-r-5"></i><?php echo e(__('trans.Delete')); ?></a>
    
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
            
            <!-- Add Shift Modal -->
            <div id="add_shift" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Add Shift')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form method="post" action="<?php echo e(route('store-shift',$subdomain)); ?>">
                                <?php echo csrf_field(); ?>
                              <?php if(Auth::user()->role_id==2): ?>
                               <div class="col-6">
     
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
                                <div class="row">

                                <div class="col-12">
                                <div class="form-group">
                                    <label><?php echo e(__('trans.Title')); ?><span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="title">
                                </div>
                                </div>
                                 <div class="col-12">  <h3><?php echo e(__('trans.working hours')); ?></h3></div>
                                       <div class="col-6">
                                           <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.From')); ?> <span class="text-danger">*</span></label>
                                            <input type="time" class="form-control" name="from"  />
                                            </div>
                                       </div>  
                                       <div class=" col-6">
                                          <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.To')); ?> <span class="text-danger">*</span></label>
                                            <input type="time" class="form-control" name="to"  />
                                          </div>
                                        </div> 
                                   <div class="col-12">  <h3><?php echo e(__('trans.check in out avaliable')); ?></h3></div>
                                       <div class="col-6">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Min Start Time')); ?>   <span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
													<!--<input class="form-control" name="time_in_max"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
											         <input type="time" class="form-control" name="time_in_min"  />
                                            	</div>
											</div>
                                       </div>   

                
                                
                                     	<div class="col-6">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Max Start Time')); ?>  <span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
													<!--<input class="form-control" name="time_in_max"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
											         <input type="time" class="form-control" name="time_in_max"  />
                                            	</div>
											</div>
										</div>

										<div class="col-6">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Min End Time')); ?>  <span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
													<!--<input class="form-control" name="time_out_min"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
                                                     <input type="time" class="form-control" name="time_out_min" />
												</div>
											</div>
										</div>


										<div class="col-6">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Max End Time')); ?><span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
													<!--<input class="form-control" name="time_out_max"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
											          <input type="time" class="form-control" name="time_out_max"  />
                                            	</div>
											</div>
										</div>
                        
										<div class="col-6">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Break Time')); ?>  <span class="text-danger">*</span></label>
												<input class="form-control" type="number" name="break_time">
											</div>
										</div>  
                                        <div class="col-6">
                             <div class="leave-left"> 
                                    <div class="form-group">
                                    	<label class="col-form-label"><?php echo e(__('trans.default')); ?> </label>
                                        <select class="select floating" name="shift_default"> 
                                        
                                            <option value="0"><?php echo e(__('trans.No')); ?></option>
                                            <option value="1"><?php echo e(__('trans.Yes')); ?></option>
                                        
                                        </select>
                                       
                                    </div>
                                </div>
     
                                        </div>
                                    </div>

                           <!--    <div class="leave-left">
                                    <label class="d-block"></label>
                                    <div class="leave-inline-form">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="shift_default" value="0"  >
                                            <label class="form-check-label" for="carry_no"></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="shift_default" value="1" >
                                            <label class="form-check-label" for="carry_yes"></label>
                                        </div>
        
                                    </div>
                                </div>-->
                                    <div class="col-12">

                                        <div class="form-group">
                                                <label class="col-form-label"><?php echo e(__('trans.Accept Extra Hours')); ?> </label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch1" checked=""  name="over_time">
                                                    <label class="custom-control-label" for="customSwitch1"></label>
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
            <!-- /Add shifts Modal -->
            
            <!-- Edit shift Modal -->
            <div id="edit_shift" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Edit shift')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form method="post" action="">
                             <?php echo csrf_field(); ?>
                             <div class="row">
                             <div class="col-12">
                                <div class="form-group">
                                    <label><?php echo e(__('trans.Title')); ?><span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="title">
                                </div>
                            </div>

                                        <div class="col-12">  <h3><?php echo e(__('trans.working hours')); ?></h3></div>
                                           <div class="col-6">
                                               <div class="form-group">
                                                <label class="col-form-label"><?php echo e(__('trans.From')); ?> <span class="text-danger">*</span></label>
                                                <input type="time" class="form-control" name="from"  />
                                                </div>
                                           </div> 
                                          <div class="col-6">
                                              <div class="form-group">
                                                <label class="col-form-label"><?php echo e(__('trans.To')); ?> <span class="text-danger">*</span></label>
                                                <input type="time" class="form-control" name="to"  />
                                              </div>
                                            </div>
                                       <div class="col-12">  <h3><?php echo e(__('trans.check in out avaliable')); ?></h3></div>
                  
                                           <div class="col-6">
    											<div class="form-group">
    												<label class="col-form-label"><?php echo e(__('trans.Max Start Time')); ?>  <span class="text-danger">*</span></label>
    												<div class="input-group time timepicker">
    													<!--<input class="form-control" name="time_in_max"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
    											         <input type="time" class="form-control" name="time_in_min"  />
                                                	</div>
    											</div>
                                           </div>
                                         	<div class="col-6">
    											<div class="form-group">
    												<label class="col-form-label"><?php echo e(__('trans.Max Start Time')); ?>  <span class="text-danger">*</span></label>
    												<div class="input-group time timepicker">
    													<!--<input class="form-control" name="time_in_max"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
    											         <input type="time" class="form-control" name="time_in_max"  />
                                                	</div>
    											</div>
    										</div>

    										<div class="col-6">
    											<div class="form-group">
    												<label class="col-form-label"><?php echo e(__('trans.Min End Time')); ?>  <span class="text-danger">*</span></label>
    												<div class="input-group time timepicker">
    													<!--<input class="form-control" name="time_out_min"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
                                                         <input type="time" class="form-control" name="time_out_min" />
    												</div>
    											</div>
    										</div>


    
    										<div class="col-6">
    											<div class="form-group">
    												<label class="col-form-label"><?php echo e(__('trans.Max End Time')); ?><span class="text-danger">*</span></label>
    												<div class="input-group time timepicker">
    													<!--<input class="form-control" name="time_out_max"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
    											          <input type="time" class="form-control" name="time_out_max"  />
                                                	</div>
    											</div>
    										</div>

										<div class="col-12">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Break Time')); ?>  <span class="text-danger">*</span></label>
												<input class="form-control" type="number" name="break_time">
											</div>
										</div>  

                                        <div class="col-lg-12">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Accept Extra Hours')); ?> </label>
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="customSwitch2" checked=""  name="over_time">
													<label class="custom-control-label" for="customSwitch2"></label>
												</div>
											</div>
										</div>
                                    </div>
                                <div class="leave-left">
                                    <label class="d-block"><?php echo e(__('trans.default')); ?></label>
                               
                                    <div class="form-group form-focus select-focus">
                                        <select class="select floating" name="shift_default"> 
                                        
                                            <option class="check_no" value="0"><?php echo e(__('trans.No')); ?></option>
                                            <option class="check_yes" value="1"><?php echo e(__('trans.Yes')); ?></option>
                                        
                                        </select>
                                        
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
            <!-- /Edit shift Modal -->

            <!-- Approve shift Modal -->
            <div class="modal custom-modal fade" id="approve_shift" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3><?php echo e(__('trans.shift Approve')); ?></h3>
                                <p><?php echo e(__('trans.Are you sure want to approve for this shift?')); ?></p>
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
            <!-- /Approve shift Modal -->
            
            <!-- Delete shift Modal -->
            <div class="modal custom-modal fade" id="delete_shift" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3><?php echo e(__('trans.Delete shift')); ?></h3>
                                <p><?php echo e(__('trans.Are you sure want to delete this shift?')); ?></p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary shift-continue-btn"><?php echo e(__('trans.Delete')); ?></a>
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
            <!-- /Delete shift Modal -->
            
      
        <!-- /Page Wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/shifts/index.blade.php ENDPATH**/ ?>