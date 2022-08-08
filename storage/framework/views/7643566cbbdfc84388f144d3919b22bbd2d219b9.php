         <div class="row">
              <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered custom-table mb-0 ">
									<thead>
										<tr>
											<th><?php echo e(__('trans.Employee')); ?></th>
											<?php $days= Carbon\Carbon::now()->daysInMonth?>
											<?php for($day=1;$day<=$days;$day++): ?>
											<th><?php echo e($day); ?></th>
				                            <?php endfor; ?>
										</tr>
									</thead>
									<tbody>
									        <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

								
                                    <?php $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendancee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if(!is_null($attendancee)): ?>
										<tr>
										<?php if(isset($attendancee[0]['name'])): ?>
											<td>
												<h2 class="table-avatar">
													<a class="avatar avatar-xs" href="#"><img alt="" src="<?php echo e(asset('img/profiles/avatar-09.jpg')); ?>"></a>
													<a href="profile"><?php echo e($attendancee[0]['name']); ?></a>
												</h2>
											</td>
										<?php endif; ?>	
										<?php $last_day=1;?>
										<?php $__currentLoopData = $attendancee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if(isset($attendance['name'])): ?> 
                                               
										<?php
										 $count_loop=count($attendancee)-1;
										 $day_number=$attendance['created_at']->format('d');?>
										<?php for($day=$last_day;$day<=$days;$day++): ?>
										<?php if(($attendance['type']!="out")): ?>
										<?php if(($day==$day_number)): ?>
                                           
											<td><?php if(!is_null($attendance['time_in'])&&!is_null($attendance['time_out'])): ?><a href="javascript:void(0);"  user_id="<?php echo e($attendance['user_id']); ?>" day="<?php echo e($day); ?>"  date="<?php echo e($attendance['created_at']); ?>"  data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check <?php if($attendance['status']=='Attendance_discount'): ?><?php echo e('text-warning'); ?><?php elseif($attendance['status']=='attend'): ?> <?php echo e('text-success'); ?><?php elseif($attendance['status']=='absent'): ?><?php echo e('text-danger'); ?><?php endif; ?>"></i></a><?php endif; ?> 
											<?php if(!is_null($attendance['time_in'])&& is_null($attendance['time_out'])): ?>
													<span class="first-off"><a href="javascript:void(0);" data-toggle="modal"  user_id="<?php echo e($attendance['user_id']); ?>" day="<?php echo e($day); ?>" date="<?php echo e($attendance['created_at']); ?>"  data-target="#attendance_info"><i class="fa fa-check <?php if($attendance['status']=='Attendance_discount'): ?><?php echo e('text-warning'); ?><?php elseif($attendance['status']=='attend'): ?> <?php echo e('text-success'); ?><?php elseif($attendance['status']=='absent'): ?><?php echo e('text-danger'); ?><?php endif; ?>"></i></a></span> 
													<span class="first-off" style="float: left;margin-top: 28px !important;margin-right: -36px;"><i class="fa fa-close text-danger"></i></span>
											<?php endif; ?>
											<?php if(is_null($attendance['time_in'])&& !is_null($attendance['time_out'])): ?>
													<span class="first-off"><i class="fa fa-close text-danger"></i></span>
													<span class="first-off" style="float: left;margin-top: 28px !important;margin-right: -36px;"><a href="javascript:void(0);" data-toggle="modal" user_id="<?php echo e($attendance['user_id']); ?>" day="<?php echo e($day); ?>" date="<?php echo e($attendance['created_at']); ?>"  data-target="#attendance_info"><i class="fa fa-check <?php if($attendance['status']=='Attendance_discount'): ?><?php echo e('text-warning'); ?><?php elseif($attendance['status']=='attend'): ?> <?php echo e('text-success'); ?><?php elseif($attendance['status']=='absent'): ?><?php echo e('text-danger'); ?><?php endif; ?>"></i></a></span> 
													
											<?php endif; ?>
											<?php if(is_null($attendance['time_in'])&& is_null($attendance['time_out'])): ?>
											
													<span class="first-off"><i class="fa fa-close text-danger"></i></span>		
											<?php endif; ?>

											</td>

										   <?php $last_day=$day_number+1; ?> <?php if(($attendancee[$count_loop]['created_at']->format('d')==$day_number)&&($attendancee[$count_loop]['created_at']->format('d')<$days)): ?> <?php else: ?> <?php break; ?><?php endif; ?>
										 
										  
									         
									   <?php else: ?>
										      <td><span class="first-off"><i class="fa fa-close text-danger"></i></span></td>
									
                                        
										<?php endif; ?>
										<?php endif; ?>
										
										<?php endfor; ?>	
										<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tr>
										<?php endif; ?>
									
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										
									</tbody>
								</table>
							</div>
         </div>
         
    </div>
     <?php echo e($users->appends($_GET)->links()); ?>

     <?php /**PATH /home/dawam/public_html/manger/resources/views/attandance/search.blade.php ENDPATH**/ ?>