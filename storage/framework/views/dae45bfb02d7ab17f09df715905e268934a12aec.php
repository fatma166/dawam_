
<?php $__env->startSection('content'); ?>
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content">
                
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title"><?php echo e(__('trans.Activities')); ?></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo e(__('tran.Activities')); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="activity">
                            <div class="activity-box">
                                <ul class="activity-list">
                                
                                      <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                           <?php 
                                               
                                                    if($activity->type=="change_mac"|| $activity->type=="access_by_new_mac")$href="activities"; elseif($activity->type=="add_client") $href="client"; elseif($activity->type=="make_leave")$href="leaves";
                                                              elseif($activity->type=="add_outdoor"||$activity->type=="end_outdoor")$href="outdoor"; elseif($activity->type=="end_task"||$activity->type=="add_task")$href="task";  
                                                                $date1 =$activity->created_at;
                                                                $date2= Carbon\Carbon::now();
                                                                $difference = $date1->diff($date2);
                                                             // print_r($difference);
                                                                $diffInSeconds = $difference->s; //45
                                                                $diffInMinutes = $difference->i; //23
                                                                $diffInHours   = $difference->h; //8
                                                                $diffInDays    = $difference->d; //21
                                                                $diffInMonths  = $difference->m; //4
                                                                $diffInYears   = $difference->y; //1

                                           
                                           
                                           
                                           
                                            ?>
                                            <li>
                                                <div class="activity-user">
                                                    <a href="profile" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                                        <img src="img/profiles/avatar-01.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="activity-content">
                                                    <div class="timeline-content">
                                                        <a href="<?php echo e($href); ?>" class="name"><?php echo e($activity->name); ?></a>  <a href="#"><?php echo e($activity->type); ?></a>
                                                        <span class="time"><?php if($diffInMinutes>0): ?><?php echo e($diffInMinutes); ?><?php echo e("min"); ?><?php endif; ?> <?php if($diffInHours>0): ?><?php echo e($diffInHours); ?><?php echo e("hours"); ?><?php endif; ?> <?php if($diffInDays>0): ?> <?php echo e($diffInDays); ?> <?php echo e("days"); ?><?php endif; ?> <?php if($diffInMonths>0): ?> <?php echo e($diffInMonths); ?> <?php echo e("month"); ?><?php endif; ?> <?php if($diffInYears>0): ?> <?php echo e($diffInYears); ?> <?php echo e("years"); ?><?php endif; ?> <?php echo e(__('trans.ago')); ?></span>
                                                    </div>
                                                </div>
                                                 <?php if($activity->type=="change_mac" ): ?>  
                                                       <div><form action="<?php echo e(route('mac_check',$subdomain)); ?>" method="get"><input type="hidden"  name="notify_id" value="<?php echo e($activity->data_id); ?>" /><input type="hidden"  name="status" value="accept" /><input type="hidden"  name="addtion_data" value="<?php echo e($activity->addtion_data); ?>" /><input type="hidden"  name="id" value="<?php echo e($activity->id); ?>" /><button onclick="change_status_notification(<?php echo e($activity->id); ?>)"><?php echo e(__('trans.add')); ?></button></form></div>
                                                       <div><form action="<?php echo e(route('mac_check',$subdomain)); ?>" method="get"><input type="hidden"  name="notify_id" value="<?php echo e($activity->data_id); ?>" /><input type="hidden"  name="status" value="refused" /><input type="hidden"  name="id" value="<?php echo e($activity->id); ?>" /><button onclick="change_status_notification(<?php echo e($activity->id); ?>)"><?php echo e(__('trans.refuse')); ?></button></form></div>
                                                 <?php else: ?>
                                                    
                                                     <div><form action="<?php echo e(route($href,$subdomain)); ?>" method="get"><input type="hidden"  name="notify__id" value="<?php echo e($activity->data_id); ?>" /><button onclick="change_status_notification(<?php echo e($activity->id); ?>)"><?php echo e(__('trans.view')); ?></button></form></div>
                                                 <?php endif; ?>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          
                                       
                                </ul>
                                <?php echo e($activities->links()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->

        </div>
        <!-- /Page Wrapper -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
     		<script>
       function change_status_notification(notfy_id){
    
           $.ajax({
                    url:"<?php echo e(route('change_status_notification',$subdomain)); ?>",
                    type:'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{notfy_id:notfy_id},
                    success: function(data) {
                        
                       if(data.hasOwnProperty('success')){
                
                         //  location.reload(true);
                        }else{
                
                          //  printErrorMsg(data.error);
                        }
                    }
            });
        }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/activities/activities.blade.php ENDPATH**/ ?>