<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table" >
									<thead>
										<tr>
										<th><?php echo e(__('trans.Scheduled Shift')); ?></th>
										<?php
										
										    $currentDayOfMonth=date('j');
										    $days= Carbon\Carbon::now()->daysInMonth; ?>
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
														<a href="profile.html" class="avatar"><img alt="" src="<?php echo e(asset('uploads/'.$user->avatar)); ?>"></a>
														<a href="profile.html"> <span><?php echo e($user->name); ?></span></a>
													</h2>
												</td>
												<?php for($day=$currentDayOfMonth;$day<=$days;$day++): ?>
												<?php $count=count($usershifts[$user->id])-1;   if($count>=0) {$compar_day_ex= explode('-',$usershifts[$user->id][$count]->date); $compar_day=$compar_day_ex[2];?>
												    <?php if($day==$compar_day): ?>
														<td>
															<div class="user-add-shedule-list">
																<h2>
																	<a href="#" data-toggle="modal" data-target="#edit_schedule" style="border:2px dashed #1eb53a">
																	<span class="username-info m-b-10"><?php     $startTime =Carbon\Carbon::parse($usershifts[$user->id][0]->time_in);
																												$endTime = Carbon\Carbon::parse($usershifts[$user->id][0]->time_out);

																												$totalDuration = $endTime->diffForHumans($startTime); echo $totalDuration; ?></span>
																
																	</a>
																		<span class="btn btn-primary user_shift-continue-btn" delete-id="<?php echo e($usershifts[$user->id][0]->id); ?>"><?php echo e(__('trans.Delete Shift')); ?></span>
																</h2>
															</div>
														</td>
													<?php else: ?>
														<td>
														<div class="user-add-shedule-list">
															<a href="#" data-toggle="modal" data-target="#add_schedule">
															<span><i class="fa fa-plus"></i></span>
															</a>
														</div>
													     </td>
													<?php endif; ?>
													<?php --$count; }else{?>
	                                                    <td>
															<div class="user-add-shedule-list">
																<a href="#" data-toggle="modal" data-target="#add_schedule">
																<span><i class="fa fa-plus"></i></span>
																</a>
															</div>
													     </td>

													<?php }?>
												<?php endfor; ?>

											</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- /Content End -->
         <?php /**PATH /home/dawam/public_html/manger/resources/views/shifts/user_shift_search.blade.php ENDPATH**/ ?>