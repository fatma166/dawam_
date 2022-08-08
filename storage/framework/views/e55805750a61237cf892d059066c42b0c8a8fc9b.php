
<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.report-dialy')); ?>

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
                            <li class="breadcrumb-item active">  <?php if($type=="present"): ?><?php echo e(__('trans.Print Present')); ?> <?php endif; ?>  <?php if($type=="absent"): ?> <?php echo e(__('trans.Print Absent')); ?> <?php endif; ?>   <?php if($type=="late"): ?><?php echo e(__('trans.Print late_comers')); ?> <?php endif; ?> <?php if($type=="early"): ?><?php echo e(__('trans.Print early leave')); ?> <?php endif; ?>  <?php if($type=="total"): ?><?php echo e(__('trans.Print total day')); ?> <?php endif; ?></li>
                        </ul>
                    </div>
                    

                </div>
            </div>
            <!-- /Page Header -->

				
           <div class="row"></div>

                
                             <!-- Search Filter -->
                <form >
                    <div class="row filter-row">
                        <?php if($type!="absent"): ?>
                        <div class="col-sm-2 col-md-2"> 
                            
                            <div class="form-group form-focus ">
                                    
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_from"></div>
                                    <label class="focus-label"><?php echo e(__('trans.Select Date From')); ?></label>
                            </div>

                        </div>
                        <div class="col-sm-2 col-md-2"> 
                        <?php // $min=(now()->year)-3;?>
               
                                <div class="form-group form-focus">
                                   
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_to"></div>
                                    <label class="focus-label"><?php echo e(__('trans.Select Date To')); ?></label>
                                </div>
                                
                        </div>
                        <?php endif; ?>
                         <div class=" <?php if($type!='absent'): ?> col-sm-2 col-md-2 <?php elseif($type=='absent'): ?>col-sm-3 col-md-3 <?php endif; ?>"> 
                            <div class="form-group form-focus ">
                                <select class="select floating department" > 
                                 <option value="all"><?php echo e(__('trans.all')); ?></option>
                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>         
                                    <option value="<?php echo e($dep->id); ?>"><?php echo e($dep->title); ?></option>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <label class="focus-label"><?php echo e(__('trans.Select Department')); ?></label>
                            </div>


                        </div>
                        <div class="<?php if($type!='absent'): ?> col-sm-2 col-md-2 <?php elseif($type=='absent'): ?>col-sm-3 col-md-3 <?php endif; ?>"> 
                            <div class="form-group form-focus ">
                                <select class="select floating branch"> 
                                     <option value="all"><?php echo e(__('trans.all')); ?></option>
                                    <?php $__currentLoopData = $branchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->title); ?></option>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <label class="focus-label"><?php echo e(__('trans.Select Branch')); ?></label>
                            </div>
   

                        </div>
                        
                        <div class="<?php if($type!='absent'): ?> col-sm-2 col-md-2 <?php elseif($type=='absent'): ?>col-sm-3 col-md-3 <?php endif; ?>"> 
                            <div class="form-group form-focus ">   
                            <select class="employee_name  form-control" name="employee_name"></select>  
                                <!--<select class="select floating employee"> 
                                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($employee->id); ?>"><?php echo e($employee->name); ?></option>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>-->       
                                <label class="focus-label"><?php echo e(__('trans.Select Employee')); ?></label>
                            </div>


                        </div>
                        <div class="<?php if($type!='absent'): ?> col-sm-2 col-md-2 <?php elseif($type=='absent'): ?>col-sm-3 col-md-3 <?php endif; ?>">  
                            <a  class="btn btn-success btn-block" id="search_daily"> <?php echo e(__('trans.Search')); ?> </a>  
                        </div>     
                    </div>
                    <input type="hidden" name="type_daily" value="<?php echo e($type); ?>" />
                </form>

                <!-- /Search Filter -->
            <!-- print button -->
            <div class="row">
                <?php if($type=="present"): ?>
                    <div class="col-2">
                        <a href="<?php echo e(url('admin/dialyPrint/present')); ?>" class="btn btn-primary shift-continue-btn" id="daily_printlink"  target="_blank"><?php echo e(__('trans.Print Present')); ?></a>
                    </div>
                <?php endif; ?>
                <?php if($type=="absent"): ?>
                    <div class="col-2">
                        <a href="<?php echo e(url('admin/dialyPrint/absent')); ?>" class="btn btn-primary shift-continue-btn" id="daily_printlink" target="_blank"><?php echo e(__('trans.Print Absent')); ?></a>
                    </div>
                 <?php endif; ?>
                <?php if($type=="late"): ?>
                    <div class="col-2">
                        <a href="<?php echo e(url('admin/dialyPrint/late')); ?>" class="btn btn-primary shift-continue-btn" id="daily_printlink" target="_blank"><?php echo e(__('trans.Print late_comers')); ?></a>
                    </div>
                 <?php endif; ?>
                <?php if($type=="early"): ?>
                    <div class="col-2">
                        <a href="<?php echo e(url('admin/dialyPrint/early')); ?>" class="btn btn-primary shift-continue-btn" id="daily_printlink" target="_blank"><?php echo e(__('trans.Print early leave')); ?></a>
                    </div>
                 <?php endif; ?>
                <?php if($type=="total"): ?>
                    <div class="col-2">
                        <a href="<?php echo e(url('admin/dialyPrint/total')); ?>" class="btn btn-primary shift-continue-btn" id="daily_printlink" target="_blank"><?php echo e(__('trans.Print total day')); ?></a>
                    </div>
                <?php endif; ?>

                
                
           </div>
         
            <div class="row" id="basic_" >
                  <?php echo $__env->make('reports.report_ajax.dialy_ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        <!-- /Page Content -->

				<!-- Attendance Modal -->
				<div class="modal custom-modal fade" id="attendance_info" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title"><?php echo e(__('trans.Attendance Info')); ?></h5><h3 class="user_name_view"></h3>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-6">
										<div class="card punch-status">
											<div class="card-body">
												<h5 class="card-title"><?php echo e(__('trans.Timesheet')); ?> <small class="text-muted"></small></h5>
												<div class="punch-det">
													<h6><?php echo e(__('trans.Punch In at')); ?></h6>
													<p id="punch_in">dff</p>
												</div>
												<div class="punch-info">
													<div class="punch-hours">
														<span>00 hrs</span>
													</div>
												</div>
												<div class="punch-det">
													<h6 ><?php echo e(__('trans.Punch Out at')); ?></h6>
													<p id="punch_out"></p>
												</div>
											<div class="statistics">
													<div class="row">
														<div class="col-md-6 col-6 text-center">
															<div class="stats-box">
																<p>Break</p>
																<h6 class="break_value"> </h6>
															</div>
														</div>
														<div class="col-md-6 col-6 text-center">
															<div class="stats-box">
																<p>Overtime</p>
																<h6 class="overtime_value"></h6>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
										<div class="col-md-6">
										<div class="card recent-activity">
											<div class="card-body">
												<h5 class="card-title"><?php echo e(__('trans.Activity')); ?></h5>
												<ul class="res-activity-list">
													<li>
														<p class="mb-0"><?php echo e(__('trans.Punch In at')); ?></p>
														<p class="res-activity-time">
															<i class="fa fa-clock-o"></i>
															<span class="active_in"></span > 
												            <div class="punch-info">
																<div class="punch-img_in">
																	<span></span>
																</div>
														     </div>
														</p>
													</li>
													<li>
														<p class="mb-0"><?php echo e(__('trans.Punch Out at')); ?></p>
														<p class="res-activity-time">
															<i class="fa fa-clock-o"></i>
										                    <span class="active_out"></span ><span><?php echo e(__('trans.lat')); ?></span></span > 
														    	<div class="punch-img_out">
																	<span></span>
																</div>
														</p>
													</li>
                                                    <li>
                                                       
                                                       
                                                        <span class="user_attend" style="display:none;"></span>
                                                        <span class="user_date" style="display:none;"></span>
                                                      <!-- <div class="onoffswitch">
                											<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox change_attend_status" id="switch_custom01" value="on" checked="">
                											<label class="onoffswitch-label" for="switch_custom01">
                												<span class="onoffswitch-inner"></span>
                												<span class="onoffswitch-switch"></span>
                											</label>
        									           	</div>-->
                                                         <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label> <h5><?php echo e(__('trans.change_status')); ?></h5></label>
                                                                
                                                                <select  class="dropdown-menu dropdown-menu-right change_attend_status" name="attend_status" style="display: block;">
                                                                    <option  class="dropdown-item" value="Attendance_discount"><i class="fa fa-dot-circle-o text-success"></i> <?php echo e(__('trans.Attendance_discount')); ?></option>
                                                                    <option  class="dropdown-item" value="attend"><a><i class="fa fa-dot-circle-o text-success"></i></a><?php echo e(__('trans.attend')); ?></option>
                                                                    <option  class="dropdown-item" value="absent"><i class="fa fa-dot-circle-o text-danger"></i><?php echo e(__('trans.absent')); ?></option>
                                                                </select>
                                                               
                                                            </div>

                                                        </div>
                                                    
                                                    </li>
                                                    
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Attendance Modal -->


    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/reports/dialy_report.blade.php ENDPATH**/ ?>