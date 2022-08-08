<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

		<!-- Main Wrapper -->

       <div class="main-wrapper">



			<!-- Page Wrapper -->

            <div class="page-wrapper">

				<!-- Page Content -->

                <div class="content container-fluid">

					<!-- Page Header -->

					<div class="page-header">

						<div class="row">

							<div class="col-sm-12">

								<h3 class="page-title"><?php echo e(__('trans.Welcome')); ?> <?php echo e(Auth::user()->name); ?></h3>

							

							</div>

						</div>

					</div>

					<!-- /Page Header -->

				

					<div class="row">

						<div class="col">

							<div class="card dash-widget">

								<div class="card-body">

								    <a href="<?php echo e(route('employee',$subdomain)); ?>">
    									<span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
    
    									<div class="dash-widget-info">
    
    										<h3><?php echo e($company_report['total']); ?></h3>
    
    										<span><?php echo e(__('trans.Total_Employees')); ?></span>
    
    									</div>
                                    </a>
								</div>

							</div>

						</div>

						<div class="col">

							<div class="card dash-widget">

								<div class="card-body">
                                   <a  href="<?php echo e(url('/admin/report-dialy'.'/present')); ?>">
									<span class="dash-widget-icon"><i class="fa fa-usd"></i></span>

									<div class="dash-widget-info">

										<h3><?php echo e($company_report['present']); ?></h3>

										<span><?php echo e(__('trans.present today')); ?></span>

									</div>
                                   </a>
								</div>

							</div>

						</div>

						<div class="col">

							<div class="card dash-widget">

								<div class="card-body">
                                  <a  href="<?php echo e(url('/admin/report-dialy'.'/absent')); ?>">
									<span class="dash-widget-icon"><i class="fa fa-diamond"></i></span>

									<div class="dash-widget-info">

										<h3><?php echo e($company_report['absent']); ?></h3>

										<span><?php echo e(__('trans.absent today')); ?></span>

									</div>
                                  </a>
								</div>

							</div>

						</div>

						<div class="col">

							<div class="card dash-widget">

								<div class="card-body">
                                    <a  href="<?php echo e(url('/admin/report-dialy').'/late'); ?>">
									<span class="dash-widget-icon"><i class="fa fa-user"></i></span>

									<div class="dash-widget-info">

										<h3><?php echo e($company_report['late_comers']); ?></h3>

										<span><?php echo e(__('trans.late comers')); ?></span>

									</div>
                                     </a>
								</div>

							</div>

						</div>

						<div class="col">

							<div class="card dash-widget">

								<div class="card-body">
                                    <a  href="<?php echo e(url('/admin/report-dialy').'/early'); ?>">
    									<span class="dash-widget-icon"><i class="fa fa-user"></i></span>
    
    									<div class="dash-widget-info">
                                            
    										<h3><?php echo e($company_report['early_leave']); ?></h3>
    
    										<span><?php echo e(__('trans.early leaves')); ?></span>
    
    									</div>
                                    </a>
								</div>

							</div>

						</div>



					</div>

					

					<div class="row">

						<div class="col-md-12">

							<div class="row">

								<div class="col-md-6 text-center">

									<div class="card">

										<div class="card-body">

											<h3 class="card-title"><?php echo e(__('trans.Attendance Overview')); ?></h3>

											<div id="line-charts" class="resize-height"></div>

										</div>

									</div>

							    </div>

								<div class="col-md-6 text-center">

					                <div class="card flex-fill">

										<div class="card-body">

											<h4 class="card-title"><?php echo e(__('trans.Task Statistics')); ?></h4>

											<div class="statistics">

												<div class="row">

													<div class="col-md-6 col-6 text-center">

														<div class="stats-box mb-4">

															<p><?php echo e(__('trans.Total Tasks')); ?></p>

															<h3><?php echo e($company_report['tasks_count']); ?></h3>

														</div>

													</div>

													<div class="col-md-6 col-6 text-center">

														<div class="stats-box mb-4">

															<p><?php echo e(__('trans.Overdue Tasks')); ?></p>

															<h3><?php echo e($company_report['tasks_count_late']); ?></h3>

														</div>

													</div>

												</div>

											</div>

											<div class="progress mb-4">

												<div class="progress-bar bg-purple" role="progressbar" style="width: <?php echo e($company_report['tasks_done_present']); ?>%" aria-valuenow="<?php echo e($company_report['tasks_done']); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo e($company_report['tasks_done_present']); ?>%</div>

												<div class="progress-bar bg-warning" role="progressbar" style="width:<?php echo e($company_report['tasks_pending_present']); ?>%" aria-valuenow="<?php echo e($company_report['tasks_count_pending']); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo e($company_report['tasks_pending_present']); ?>%</div>

												

												<div class="progress-bar bg-success" role="progressbar" style="width:  <?php echo e($company_report['tasks_inprogress_present']); ?>%" aria-valuenow="<?php echo e($company_report['tasks_count_inprogress']); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo e($company_report['tasks_inprogress_present']); ?>%</div>

												<div class="progress-bar bg-danger" role="progressbar" style="width:  <?php echo e($company_report['tasks_late_present']); ?>%" aria-valuenow="<?php echo e($company_report['tasks_count_late']); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo e($company_report['tasks_late_present']); ?>%</div>

												

											</div>

											<div>

												<p><i class="fa fa-dot-circle-o text-purple mr-2"></i><?php echo e(__('trans.Completed Tasks')); ?><span class="float-right"><?php echo e($company_report['tasks_done']); ?></span></p>

												<p><i class="fa fa-dot-circle-o text-warning mr-2"></i><?php echo e(__('trans.Pending Tasks')); ?> <span class="float-right"><?php echo e($company_report['tasks_count_pending']); ?></span></p>

												<p><i class="fa fa-dot-circle-o text-success mr-2"></i><?php echo e(__('trans.Inprogress Tasks')); ?> <span class="float-right"><?php echo e($company_report['tasks_count_inprogress']); ?></span></p>

												<p><i class="fa fa-dot-circle-o text-danger mr-2"></i><?php echo e(__('trans.Late Tasks')); ?> <span class="float-right"><?php echo e($company_report['tasks_count_late']); ?></span></p>

											</div>

										</div>

									</div>

								</div>

					   	    </div>

					    </div>

					</div>

					



					

					<!-- Statistics Widget -->

					<div class="row">

						<div class="col-md-12 col-lg-12 col-xl-4 d-flex">

							<div class="card flex-fill dash-statistics">

								<div class="card-body">

									<h5 class="card-title"><?php echo e(__('trans.Statistics')); ?></h5>

									<div class="stats-list">

										<div class="stats-info">

											<p><?php echo e(__('trans.Today Leave')); ?> <strong><?php echo e($company_report['total']); ?><small>/ <?php echo e($company_report['leave_today']); ?></small></strong></p>

											<div class="progress">

												<div class="progress-bar bg-primary" role="progressbar" style="width:<?php if($company_report['total']!=0): ?> <?php echo e((($company_report['leave_today']/$company_report['total'])*100).'%'); ?><?php else: ?><?php echo e('0%'); ?><?php endif; ?>" aria-valuenow="<?php if($company_report['total']!=0): ?><?php echo e(($company_report['leave_today']/$company_report['total'])); ?><?php else: ?> <?php echo e('0'); ?><?php endif; ?>" aria-valuemin="0" aria-valuemax="100"></div>

											</div>

										</div>

								

										<div class="stats-info">

											<p><?php echo e(__('trans.Completed Tasks')); ?> <strong> <?php echo e($company_report['tasks_count']); ?><small>/<?php echo e($company_report['task_done_today']); ?></small></strong></p>

											<div class="progress">

												<div class="progress-bar bg-success" role="progressbar" style="width:<?php if($company_report['tasks_count']): ?>!=0)<?php echo e((($company_report['task_done_today']/ $company_report['tasks_count'])*100).'%'); ?> <?php else: ?> <?php echo e('0%'); ?><?php endif; ?> " aria-valuenow="<?php if($company_report['tasks_count']): ?>!=0)<?php echo e(($company_report['task_done_today']/ $company_report['tasks_count']).'%'); ?><?php else: ?> '0%' <?php endif; ?>" aria-valuenow="<?php if($company_report['tasks_count']): ?>!=0)<?php echo e(($company_report['task_done_today']/ $company_report['tasks_count'])); ?><?php else: ?> '0%' <?php endif; ?>" aria-valuemin="0" aria-valuemax="100"></div>

											</div>

										</div>

							



									</div>

								</div>

							</div>

						</div>

						<!--leaves-->

						<div class="col-md-12 col-lg-6 col-xl-4 d-flex">

							<div class="card flex-fill">

								<div class="card-body">

									<h4 class="card-title"><?php echo e(__('trans.Today Leave')); ?> <span class="badge bg-inverse-danger ml-2"><?php echo e(count($company_report['leave_users'])); ?></span></h4>

									<?php $__currentLoopData = $company_report['leave_users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave_user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

										<div class="leave-info-box">

											<div class="media align-items-center">

												<a href="profile" class="avatar"><img alt="" src="<?php echo e(asset('uploads').$leave_user->avatar); ?>"></a>

												<div class="media-body">

													<div class="text-sm my-0"><?php echo e($leave_user->name); ?></div>

												</div>

											</div>

											<div class="row align-items-center mt-3">

												<div class="col-6">

													<h6 class="mb-0"><?php echo e($leave_user->leave_from); ?></h6>

													<span class="text-sm text-muted">Leave Date</span>

												</div>

												<div class="col-6 text-right">

													<span class="badge bg-inverse-danger"><?php echo e(('trans.Pending')); ?></span>

												</div>

											</div>

										</div>

									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

									

									<div class="load-more text-center">

										<a class="text-dark" href="<?php echo e(route('leaves',$subdomain)); ?>"><?php echo e(__('trans.Load More')); ?></a>

									</div>

								</div>

							</div>

						</div>

						<!-- absents-->

						<div class="col-md-12 col-lg-6 col-xl-4 d-flex">

							<div class="card flex-fill">

								<div class="card-body">

									<h4 class="card-title"><?php echo e(__('trans.Today Absent')); ?> <span class="badge bg-inverse-danger ml-2"><?php echo e($company_report['absent']); ?></span></h4>

									<?php $__currentLoopData = $absents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $absent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

										<div class="leave-info-box">

											<div class="media align-items-center">

												<a href="profile" class="avatar"><img alt="" src="<?php echo e(asset('uploads').'/'.$absent->avatar); ?>"></a>

												<div class="media-body">

													<div class="text-sm my-0"><?php echo e($absent->name); ?></div>

												</div>

											</div>

											<!--<div class="row align-items-center mt-3">

												<div class="col-6">

													<h6 class="mb-0"><?php echo e($absent->name); ?></h6>

													<span class="text-sm text-muted">Leave Date</span>

												</div>

												<div class="col-6 text-right">

													<span class="badge bg-inverse-danger">Pending</span>

												</div>

											</div>-->

										</div>

									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

									

									<div class="load-more text-center">

										<a class="text-dark" href="<?php echo e(route('report-dialy',$subdomain)); ?>"><?php echo e(__('trans.Load More')); ?></a>

									</div>

								</div>

							</div>

						</div>

					</div>

					<!-- /Statistics Widget -->

					

						

					<div class="row">

						<div class="col-md-6 d-flex">

							<div class="card card-table flex-fill">

								<div class="card-header">

									<h3 class="card-title mb-0"><?php echo e(__('trans.Clients')); ?></h3>

								</div>

								<div class="card-body">

									<div class="table-responsive">

										<table class="table custom-table mb-0">

											<thead>

												<tr>

													<th><?php echo e(__('trans.Name')); ?></th>

													<th><?php echo e(__('trans.Status')); ?></th>

												

												</tr>

											</thead>

											<tbody>

											<?php $__currentLoopData = $company_report['clients']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

												<tr>

													<td>

														<h2 class="table-avatar">

															

															<a href="<?php echo e(url('/admin/client-profile/'.$client->id)); ?>"><?php echo e($client->name); ?> </a>

														</h2>   

													</td>

													


													<td>

														<i class="fa fa-dot-circle-o <?php if($client->status=='notactive'): ?><?php echo e('text-danger'); ?><?php else: ?> <?php echo e('text-success'); ?> <?php endif; ?>"><?php if($client->status=="notactive"): ?><span><?php echo e(__('trans.NotActive')); ?></span><?php else: ?><span><?php echo e(__('trans.Active')); ?></span><?php endif; ?></i> 

													</td>



												</tr>

											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	

											</tbody>

										</table>

									</div>

								</div>

								<div class="card-footer">

									<a href="<?php echo e(route('client',$subdomain)); ?>"><?php echo e(__('trans.View all clients')); ?></a>

								</div>

							</div>

						</div>

						<div class="col-md-6 d-flex">

							<div class="card card-table flex-fill">

								<div class="card-header">

									<h3 class="card-title mb-0"><?php echo e(__('trans.Recent Tasks')); ?></h3>

								</div>

								<div class="card-body">

									<div class="table-responsive">

										<table class="table custom-table mb-0">

											<thead>

												<tr>

													<th><?php echo e(__('trans.Task Title')); ?> </th>

													

													<!--<th class="text-right">Action</th>-->

												</tr>

											</thead>

											<tbody>

												<?php $__currentLoopData = $company_report['tasks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

													<tr>

														<td>

															<h2><a href="project-view"><?php echo e($task->title); ?></a></h2>

															<small class="block text-ellipsis">

																<span></span> <span class="text-muted"><?php echo e($task->description); ?></span>

															

															</small>

														</td>

					

														<!--<td class="text-right">

															<div class="dropdown dropdown-action">

																<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>

																<div class="dropdown-menu dropdown-menu-right">

																	<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>

																	<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>

																</div>

															</div>

														</td>-->

													</tr>

												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

											

											</tbody>

										</table>

									</div>

								</div>

								<div class="card-footer">

									<a href="<?php echo e(route('task',$subdomain)); ?>"><?php echo e(__('trans.View Due Tasks')); ?></a>

								</div>

							</div>

						</div>

					</div>

				

				</div>

				<!-- /Page Content -->

            <!-- Edit Client Modal -->

            <div id="edit_client" class="modal custom-modal fade" role="dialog">

                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title">Edit Client</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                <span aria-hidden="true">&times;</span>

                            </button>

                        </div>

                        <div class="modal-body">

                           <form action="" method="POST">

                           <?php echo csrf_field(); ?>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="col-form-label"><?php echo e(__('trans.Name')); ?> <span class="text-danger">*</span></label>

                                            <input class="form-control" type="text" name="name">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="col-form-label"><?php echo e(__('trans.phone')); ?></label>

                                            <input class="form-control" type="text" name="phone">

                                        </div>

                                    </div>



                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="col-form-label">Email <span class="text-danger">*</span></label>

                                            <input class="form-control floating" type="email" name="email">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="col-form-label"><?php echo e(__('trans.Contact_person')); ?></label>

                                            <input class="form-control" name="contact_person" type="text">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="col-form-label"><?php echo e(__('trans.Contactphone')); ?></label>

                                            <input class="form-control" name="contact_phone" type="text">

                                        </div>

                                    </div>

                                    <div class="col-sm-6">

                                        <div class="form-group">

                                            <label><?php echo e(__('trans.client_type')); ?> <span class="text-danger">*</span></label>

                                            

                                            <select class="select" name="client_type_id">

                                                <?php if(isset($client_types)): ?> 

                                                    <?php $__currentLoopData = $client_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <option value="<?php echo e($client_type->id); ?>"><?php echo e($client_type->name); ?></option>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                 <?php endif; ?>;

                                            </select>

                                           

                                        </div>

                                    </div>



                                <div class="col-sm-6">

                                    <div class="form-group">

                                        <label><?php echo e(__('trans.From')); ?> <span class="text-danger">*</span></label>

                                        

                                        <div class="input-group time timepicker">

										    <input class="form-control" name="start_time"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>

									    </div>

                                     </div>

                                </div>

                                <div class="col-sm-6">

                                <div class="form-group">

                                    <label><?php echo e(__('trans.To')); ?><span class="text-danger">*</span></label>

                

                                   	<div class="input-group time timepicker">

										<input class="form-control" name="end_time"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>

									</div>

                                </div>

                                </div>



                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <label class="col-form-label"><?php echo e(__('trans.Adress')); ?> <span class="text-danger">*</span></label>

                                        <input class="form-control" type="text" name="address">

                                    </div>

                                </div>

                                <div class="col-sm-6">

                                    <div class="form-group">

                                        <label class="col-form-label"><?php echo e(__('trans.lat')); ?> <span class="text-danger" >*</span></label>

                                        <input class="form-control edit_lat" type="text" name="add_lat" >

                                    </div>

                                </div>

                               <div class="col-sm-6">

                                    <div class="form-group">

                                        <label class="col-form-label"><?php echo e(__('trans.lang')); ?> <span class="text-danger" >*</span></label>

                                        <input class="form-control edit_lang" type="text" name="add_lang" >

                                    </div>

                                </div>

                                <div class="col-sm-12">

                                    <div id="map_edit" style="height:400px"></div>



                                </div>

                                  

                                   

                                </div>

                              

                                <div class="submit-section">

                                    <button class="btn btn-primary submit-btn">Submit</button>

                                </div>

                            </form>



                    </div>

                    </div>

                </div>

            </div>

            <!-- /Edit Client Modal -->

             <!-- Approve shift Modal -->

            <div class="modal custom-modal fade" id="approve_client" role="dialog">

                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">

                        <div class="modal-body">

                            <div class="form-header">

                                <h3><?php echo e(__('trans.client Approve')); ?></h3>

                                <p><?php echo e(__('trans.Are you sure want to approve for this client?')); ?></p>

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

            

            </div>    

			<!-- /Page Wrapper -->

			

       </div>

		<!-- /Main Wrapper -->

		




		

		<!-- Custom JS -->

        		<!-- Chart JS -->

	

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
		<script src="<?php echo e(asset('plugins/morris/morris.min.js')); ?>"></script>

		<script src="<?php echo e(asset('plugins/raphael/raphael.min.js')); ?>"></script>

		<script src="<?php echo e(asset('js/chart.js')); ?>"></script>	

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/index.blade.php ENDPATH**/ ?>