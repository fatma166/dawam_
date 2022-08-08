
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i> <span class="badge badge-pill"><?php echo e(count($notfys)); ?></span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title"><?php echo e(__('trans.Notifications')); ?></span>
                            <a href="javascript:void(0)" class="clear-noti"> <?php echo e(__('trans.Clear All')); ?> </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                            <?php if($notfys): ?>
                           
                               <?php $__currentLoopData = $notfys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notfy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                 <?php  
                                                    
                                                    
                                                                                                   
                                                             if($notfy->type=="change_mac" )$href="activities"; elseif($notfy->type=="access_by_new_mac")$href="activities"; elseif($notfy->type=="add_client") $href="client"; elseif($notfy->type=="make_leave")$href="leaves";
                                                              elseif($notfy->type=="add_outdoor"||$notfy->type=="end_outdoor")$href="outdoor"; elseif($notfy->type=="end_task")$href="task";  
                                                                $date1 =$notfy->created_at;
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
                                    <li class="notification-message">
                                        <a href="<?php echo e($href); ?>">
                                            <div class="media">
                                                <!--<span class="avatar">
                                                    <img alt="" src="<?php echo e(asset('img/profiles/avatar-02.jpg')); ?>">
                                                </span>-->
                                                <div class="media-body">
                                                    <p class="noti-details"><span class="noti-title"><?php echo e($notfy->name); ?></span> <span class="noti-title"><?php echo e($notfy->title); ?></span></p>
   
                                                    
                                                    
                                                    <p class="noti-time"><span class="notification-time"><?php if($diffInMinutes>0): ?><?php echo e($diffInMinutes); ?><?php echo e("min"); ?><?php endif; ?> <?php if($diffInHours>0): ?><?php echo e($diffInHours); ?><?php echo e("hours"); ?><?php endif; ?> <?php if($diffInDays>0): ?> <?php echo e($diffInDays); ?> <?php echo e("days"); ?><?php endif; ?> <?php if($diffInMonths>0): ?> <?php echo e($diffInMonths); ?> <?php echo e("month"); ?><?php endif; ?> <?php if($diffInYears>0): ?> <?php echo e($diffInYears); ?> <?php echo e("years"); ?><?php endif; ?> <?php echo e(__('trans.ago')); ?></span></p>
                                                    <?php if($notfy->type=="change_mac" ): ?>  
                                                       <div><form action="<?php echo e(route('mac_check',$subdomain)); ?>" method="get"><input type="hidden"  name="notify_id" value="<?php echo e($notfy->data_id); ?>" /><input type="hidden"  name="status" value="accept" /><input type="hidden"  name="addtion_data" value="<?php echo e($notfy->addtion_data); ?>" /><input type="hidden"  name="id" value="<?php echo e($notfy->id); ?>" /><button onclick="change_status_notification(<?php echo e($notfy->id); ?>)"><?php echo e(__('trans.add')); ?></button></form></div>
                                                       <div><form action="<?php echo e(route('mac_check',$subdomain)); ?>" method="get"><input type="hidden"  name="notify_id" value="<?php echo e($notfy->data_id); ?>" /><input type="hidden"  name="status" value="refused" /><input type="hidden"  name="id" value="<?php echo e($notfy->id); ?>" /><button onclick="change_status_notification(<?php echo e($notfy->id); ?>)"><?php echo e(__('trans.refuse')); ?></button></form></div>
                                                     <?php else: ?>
                                                        
                                                         <div><form action="<?php echo e(route($href,$subdomain)); ?>" method="get"><input type="hidden"  name="notify__id" value="<?php echo e($notfy->data_id); ?>" /><button onclick="change_status_notification(<?php echo e($notfy->id); ?>)"><?php echo e(__('trans.view')); ?></button></form></div>
                                                     <?php endif; ?>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="<?php echo e(route('activities',$subdomain)); ?>"><?php echo e(__('trans.View all Notifications')); ?></a>
                        </div>
                    </div>
                <?php /**PATH /home/dawam/public_html/manger/resources/views/activities/notfy.blade.php ENDPATH**/ ?>