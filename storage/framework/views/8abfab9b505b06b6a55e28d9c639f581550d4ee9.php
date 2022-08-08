

<div class="header">

			

            <!-- Logo -->

            <div class="header-left">

                <a href="<?php echo e(url('/admin/dashboard')); ?>" class="logo">

                    <img src="<?php echo e(asset('img/logo.png')); ?>" width="110" height="50" alt="">

                </a>


            </div>

            <!-- /Logo -->

            

            <a id="toggle_btn" href="javascript:void(0);">

                <span class="bar-icon">

                    <span></span>

                    <span></span>

                    <span></span>

                </span>

            </a>

            

            <!-- Header Title -->

          

            <!-- /Header Title -->

            

            <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

            

            <!-- Header Menu -->

            <ul class="nav user-menu">

            

                <!-- Search -->

             
                <?php if(Session::has('company')): ?>
                     <li><button   class="goAllCompanyAdmin" onclick="goAllCompanyAdmin()"><?php echo e(__('trans.go allcompany admin')); ?></button></li>
                <?php endif; ?>
                <!-- /Search -->

            



            

                <!-- Notifications -->

                <span id="ajax_notfy"></span>

                <li class="nav-item dropdown notfy">

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

                                    <li class="notification-message">



                                    <?php if($notfy->type=="task_end") {$url_n=route('/')."/outdoor/outdoor_search?employee_name=".$notfy->name; }else{$url_n="#";}?>

                                        <a href="<?php echo e($url_n); ?>">

                                            <div class="media">

                                                <span class="avatar">

                                                    <img alt="" src="<?php echo e(asset('uploads').'/'.$notfy->avatar); ?>">

                                                </span>

                                                <div class="media-body">

                                                    <p class="noti-details"><span class="noti-title"><?php echo e($notfy->name); ?></span> <span class="noti-title"><?php echo e($notfy->title); ?></span></p>

                                                    <?php 

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

                                                    

                                                    

                                                    <p class="noti-time"><span class="notification-time"><?php if($diffInMinutes>0): ?><?php echo e($diffInMinutes); ?><?php echo e("min"); ?><?php endif; ?> <?php if($diffInHours>0): ?><?php echo e($diffInHours); ?><?php echo e("hours"); ?><?php endif; ?> <?php if($diffInDays>0): ?> <?php echo e($diffInDays); ?> <?php echo e("days"); ?><?php endif; ?> <?php if($diffInMonths>0): ?> <?php echo e($diffInMonths); ?> <?php echo e("month"); ?><?php endif; ?> <?php if($diffInYears>0): ?> <?php echo e($diffInYears); ?> <?php echo e("years"); ?><?php endif; ?> ago</span></p>

                                                </div>

                                            </div>

                                        </a>

                                    </li>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php endif; ?>

                            </ul>

                        </div>

                        <div class="topnav-dropdown-footer">

                            <a href="activities"><?php echo e(__('trans.View all Notifications')); ?></a>

                        </div>

                    </div>

                </li>

                <!-- /Notifications -->

                





                <li class="nav-item dropdown has-arrow main-drop">

                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">

                        <span class="user-img"><img src="https://thiqah-eg.com/wp-content/uploads/2022/01/team-4-270x315.png" alt="">

                        <span class="status online"></span></span> 

                        <span><?php echo e(Auth::user()->name); ?></span>

                    </a> 

                    <div class="dropdown-menu">

                       
                    <a class="dropdown-item" href="<?php echo e(route('logout',$subdomain)); ?>"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="bx bx-log-out"></i>
                        <?php echo e(__('trans.Logout')); ?>

                       
                    </a>
                    <form id="logout-form" action="<?php echo e(route('logout',$subdomain)); ?>" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>

                    </div>

                </li>

            </ul>

            <!-- /Header Menu -->

            

            <!-- Mobile Menu -->

            <div class="dropdown mobile-user-menu">

                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>

                <div class="dropdown-menu dropdown-menu-right">

                    <a class="dropdown-item" href="profile">My Profile</a>

                    <a class="dropdown-item" href="settings">Settings</a>

                    <a class="dropdown-item" href="route('logout')">Logout</a>

                </div>

            </div>

            <!-- /Mobile Menu -->

            

        </div>
<?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/layout/partials/header.blade.php ENDPATH**/ ?>