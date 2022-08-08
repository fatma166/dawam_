
<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.usershift')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Page Wrapper -->
<div class="page-wrapper">
                <div class="content container-fluid">
					
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title"><?php echo e(__('trans.Daily Scheduling')); ?></h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                    <li class="breadcrumb-item active"><?php echo e(__('trans.Shift Scheduling')); ?></li>
								</ul>
                            </div>
                            <div class="col-auto float-right ml-auto">
							<!--	<a  href="<?php echo e(route('shift',$subdomain)); ?>" class="btn add-btn m-r-5"><?php echo e(__('trans.Shifts')); ?></a>-->
								<a href="#" class="btn add-btn m-r-5" data-toggle="modal" data-target="#add_schedule"> <?php echo e(__('trans.Assign Shifts')); ?></a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- Content Starts -->
					<!-- Search Filter -->
                    <form method="post">
					<div class="row filter-row">
					
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">  
                        <div class="form-group form-focus">
                          <select class="employee_name  form-control user_shift_name" name="employee_name"></select>
                            <!--<input type="text" class="form-control floating employee_name"  />-->
                            <label class="focus-label"><?php echo e(__('trans.Employee Name')); ?></label>
                        </div>
                    </div>
						<br />                        
						
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus ">
								<select class="select floating department_"> 
								<?php if(!empty($departments)): ?>
									<option value="all"><?php echo e(__('trans.All Department')); ?></option>
								<?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							
									<option value="<?php echo e($department->id); ?>"><?php echo e($department->title); ?></option>
		                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>
								</select>
								<label class="focus-label "><?php echo e(__('trans.Department')); ?></label>
							</div>
                        </div>
                        <!--<div class="col-sm-6 col-md-2">  
							<div class="form-group form-focus focused">
								<div class="cal-icon">
									<input class="form-control floating datetimepicker from_date" type="text">
								</div>
								<label class="focus-label">From</label>
							</div>
                        </div>
                        <div class="col-sm-6 col-md-2">  
							<div class="form-group form-focus focused">
								<div class="cal-icon">
									<input class="form-control floating datetimepicker to_date" type="text">
								</div>
								<label class="focus-label">To</label>
							</div>
						</div>-->
						<div class="col-sm-6 col-md-2">  
							<a  class="btn btn-success btn-block" id="search_user_shift"> <?php echo e(__('trans.Search')); ?> </a>  
						</div>     
						
                    </div>
					</form>
					<!-- Search Filter -->
                    <div id="basic_data">
					<div class="row">
						<div class="col-md-12" >
							<div class="table-responsive">
								<table class="table table-striped custom-table" >
									<thead>
										<tr>
										<th><?php echo e(__('trans.Scheduled Shift')); ?></th>
										<?php

$currentDayOfMonth = date('j');
$days = Carbon\Carbon::now()->daysInMonth;

?>
											<?php for($day=$currentDayOfMonth;$day<=$days;$day++): ?>
											<th><?php echo e($day); ?></th>
				                            <?php endfor; ?>
											
										</tr>
									</thead>
									<tbody>
									    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td>
													<h2 class="table-avatar">
														<a href="profile.html" class="avatar"><img alt="" src="<?php echo e(asset('uploads').'/'.$user->avatar); ?>"></a>
														<a href="profile.html"> <span><?php echo e($user->name); ?></span></a>
													</h2>
												</td>
												<?php for($day=$currentDayOfMonth;$day<=$days;$day++): ?>
												<?php

//$count=count($usershifts[$user->id])-1;   if($count>=0) {$compar_day_ex= explode('-',$usershifts[$user->id][$count]->date); $compar_day=$compar_day_ex[2];

?>
												   <?php

$added = "empty";
if (count($usershifts[$user->id]) > 0)
{
    foreach ($usershifts[$user->id] as $user_data_arr)
    {
        $compar_day_ex = explode('-', $user_data_arr->date);
        $compar_day = $compar_day_ex[2];

?>
                                                    <?php if($day==$compar_day): ?>
														<td>
															<div class="user-add-shedule-list">
																<h2>
																	<a href="#" data-toggle="modal" data-target="#edit_schedule" style="border:2px dashed #1eb53a" data-href="<?php echo e(url('admin/usershift/user_shift_edit/'.$usershifts[$user->id][0]->id)); ?>" user_shift-id="<?php echo e($usershifts[$user->id][0]->id); ?>">
																	<span class="username-info m-b-10"><?php

        $startTime = Carbon\Carbon::parse($usershifts[$user->id][0]->time_in);
        $endTime = Carbon\Carbon::parse($usershifts[$user->id][0]->time_out);

        $totalDuration = $endTime->diffForHumans($startTime);
        echo $totalDuration;

?></span>
																
																	</a>
																		<span class="btn btn-primary user_shift-continue-btn" delete-id="<?php echo e($usershifts[$user->id][0]->id); ?>"><?php echo e(__('trans.Delete Shift')); ?></span>
																</h2>
															</div>
														</td>
									                 <?php

        $added = "added";

?>
													<?php endif; ?>
													<?php

        //--$count;

    }
}
if ($added != "added")
{

?>
	                                                    <td>
															<div class="user-add-shedule-list">
																<a href="#" data-toggle="modal" data-target="#add_schedule">
																<span><i class="fa fa-plus"></i></span>
																</a>
															</div>
													     </td>

													<?php

}

?>
												<?php endfor; ?>

											</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
								</table>
							</div>
						</div>
					</div>
					</div>
					<!-- /Content End -->
          </div>
				<!-- /Page Content -->
			
							<!-- Add Schedule Modal -->
				<div id="add_schedule" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title"><?php echo e(__('trans.Add Schedule')); ?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							      <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
								<form action='<?php echo e(route("shift_schedule_store",$subdomain)); ?>'>
									<div class="row">
										<!--<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Department <span class="text-danger">*</span></label>
												<select class="select">
                                                    <option value="">Select</option>
													<option value="">Development</option>
                                                    <option value="1">Finance</option>
                                                    <option value="2">Finance and Management</option>
                                                    <option value="3">Hr & Finance</option>
                                                    <option value="4">ITech</option>
												</select>
											</div>
										</div>-->
										<div class="col-sm-12">
                                            <div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Employee Name')); ?> <span class="text-danger">*</span></label>
													<select class="select" name="user_id">
														<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</select>
											</div>
										</div>
										<div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label"><?php echo e(__('trans.From')); ?></label>
                                                <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_from"></div>
                                            </div>
										</div>
										<div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label"><?php echo e(__('trans.To')); ?></label>
                                                <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_to"></div>
                                            </div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Shifts')); ?> <span class="text-danger">*</span></label>
												<select class="select" name="shift_id">
												    <?php $__currentLoopData = $shifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                       <option value="<?php echo e($shift->id); ?>"><?php echo e($shift->title); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Min Start Time')); ?>  <span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
													<!--<input class="form-control" name="time_in_min"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
											        <input type="time" class="form-control" name="time_in_min"  />
                                            	</div>
                                                                                    
                                                   
                                                    
                                                
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Start Time')); ?> <span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
												  <!--	<input class="form-control" name="time_in"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
											         <input type="time" class="form-control" name="time_in" />
                                            	</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Max Start Time')); ?>  <span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
													<!--<input class="form-control" name="time_in_max"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
											         <input type="time" class="form-control" name="time_in_max"  />
                                            	</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Min End Time')); ?>  <span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
													<!--<input class="form-control" name="time_out_min"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
                                                     <input type="time" class="form-control" name="time_out_min" />
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.End Time')); ?>   <span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
													<!--<input class="form-control" name="time_out"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
                                                     <input type="time" class="form-control" name="time_out"  />
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Max End Time')); ?><span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
													<!--<input class="form-control" name="time_out_max"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
											          <input type="time" class="form-control" name="time_out_max"  />
                                            	</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Break Time')); ?>  <span class="text-danger">*</span></label>
												<input class="form-control" type="number" name="break_time">
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Accept Extra Hours')); ?> </label>
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="customSwitch1" checked=""  name="over_time">
													<label class="custom-control-label" for="customSwitch1"></label>
												</div>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Publish')); ?></label>
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="customSwitch2" checked="" name="active">
													<label class="custom-control-label" for="customSwitch2"></label>
												  </div>
											</div>
										</div>
									</div>
								
									<div class="submit-section">
										<button class="btn btn-primary submit-btn"><?php echo e(__('trans.Save')); ?></button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
                <!-- /Add Schedule Modal -->
                
                <!-- Edit Schedule Modal -->
                	<div id="edit_schedule" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title"><?php echo e(__('trans.show Schedule')); ?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
                                <?php echo csrf_field(); ?>
									<div class="row">
										<!--<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Department <span class="text-danger">*</span></label>
												<select class="select">
                                                    <option value="">Select</option>
													<option value="">Development</option>
                                                    <option value="1">Finance</option>
                                                    <option value="2">Finance and Management</option>
                                                    <option value="3">Hr & Finance</option>
                                                    <option value="4">ITech</option>
												</select>
											</div>
										</div>-->
										<div class="col-sm-12">
                                            <div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Employee Name')); ?> <span class="text-danger">*</span></label>
													<select class="select" name="user_id">
														<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</select>
											</div>
										</div>
										<div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Date</label>
                                                <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date"></div>
                                            </div>
										</div>
										<!--<div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Date_end</label>
                                                <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_to"></div>
                                            </div>
										</div>-->
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Shifts')); ?> <span class="text-danger">*</span></label>
												<select class="select" name="shift_id">
												    <?php $__currentLoopData = $shifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                       <option value="<?php echo e($shift->id); ?>"><?php echo e($shift->title); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Min Start Time')); ?>  <span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
													<input class="form-control" name="time_in_min"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Start Time ')); ?> <span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
													<input class="form-control" name="time_in"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Max Start Time')); ?>  <span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
													<input class="form-control" name="time_in_max"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Min End Time')); ?>  <span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
													<input class="form-control" name="time_out_min"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.End Time')); ?>   <span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
													<input class="form-control" name="time_out"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Max End Time ')); ?><span class="text-danger">*</span></label>
												<div class="input-group time timepicker">
													<input class="form-control" name="time_out_max"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Break Time')); ?>  <span class="text-danger">*</span></label>
												<input class="form-control" type="text" name="break_time">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Accept Extra Hours')); ?> </label>
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="customSwitch1" checked=""  name="over_time">
													<label class="custom-control-label" for="customSwitch1"></label>
												</div>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<label class="col-form-label"><?php echo e(__('trans.Publish')); ?></label>
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="customSwitch2" checked="" name="active">
													<label class="custom-control-label" for="customSwitch2"></label>
												  </div>
											</div>
										</div>     
									</div>
								
									<!--<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>-->
								</form>
							</div>
						</div>
					</div>
				</div>

				<!-- /Edit Schedule Modal -->
        					
            
  </div>
			<!-- /Page Wrapper -->			
           
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/shifts/usershift.blade.php ENDPATH**/ ?>