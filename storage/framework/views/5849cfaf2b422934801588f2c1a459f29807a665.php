
                 <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>
                       <div class="available col-md-12 col-sm-12 col-12 col-lg-12 col-xl-12"><h1 class="available_title"><?php if($type=="client"): ?><?php echo e(__('trans.client_attendance')); ?><?php elseif($type=="branch"): ?><?php echo e(__('trans.branch_attendance')); ?><?php else: ?> <?php echo e(__('trans.none detected')); ?><?php endif; ?></h1></div>
                         
                        <?php $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                                <div class="profile-widget">
                                    <div class="profile-img">
                                        <a href="profile" class="avatar"><img src="<?php echo e(asset($attendance->attend_img)); ?>" alt=""></a>
                                    </div>
                                    <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="profile"><?php echo e($attendance->name); ?></a></h4>
                                    <div class="small "> <h5 class="branch_title"><?php echo e(__('trans.employeebranch')); ?>:</h5> <?php echo e($attendance->branch_title); ?></div>
                                    <div class="small "><?php echo e($attendance->time_in); ?></div>
                                    <h5 class="branch_title"><?php echo e(__('trans.attendbranch')); ?></h5>
                                    <?php  $arr_=json_decode($attendance->attendances_details);if(!empty($arr_))$count_=count((array)$arr_);else $count_=0; ?>
                                    <?php $i=0; $key_index=0;?>
                                   <?php $__currentLoopData = json_decode($attendance->attendances_details); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index =>$details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <?php if($i==2): ?> <span  class="dots" id="dots_<?php echo e($index); ?>">...</span> <span class="more" id="more<?php echo e($index); ?>"> <?php $key_index=$index;?> <?php endif; ?>
                                            <?php if($type=="client"): ?> 
                                                <a href="<?php echo e($details->client_id); ?>"> <div class="small"><?php echo e($details->client_name); ?></div></a>
                                            <?php endif; ?>
                                          <?php if($type=="branch"): ?> 
                                        
                                               <a href="<?php if(isset($details->branch_id)): ?><?php echo e($details->branch_id); ?><?php endif; ?>"> <div class="small text-muted"><?php if(isset($details->branch_name)): ?><?php echo e($details->branch_name); ?><?php endif; ?></div></a>
                                          <?php endif; ?>
                                      
                                        <?php if($count_==$i+1): ?></span> <button onclick="myFunction(<?php echo e($key_index); ?>)" id="myBtn_<?php echo e($key_index); ?>"><?php echo e(__('trans.Read more')); ?></button> <?php endif; ?>
                                       <?php ++$i; ?> 
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   <?php if($type=="not_dected"): ?> 
                                    
                                        <div class="small"><?php if(isset($attendance->address)): ?><?php echo e($attendance->address); ?><?php endif; ?></div>
                                   <?php endif; ?>  
                                  
                                   
                                </div>
                            </div>
                          
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                   
                    <div class="paginate_available" style="clear: both; float: right;"> <?php echo e($attendances->appends($_GET)->links()); ?></div> 
                    
                    
<?php $__env->startSection('script'); ?>
<script>

function myFunction(i) {
    
  var dots =document.getElementById("dots_"+i);
  var moreText = document.getElementById("more"+i);
  var btnText = document.getElementById("myBtn_"+i);
  
  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "<?php echo e(__('trans.Read more')); ?>";
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "<?php echo e(__('trans.Read less')); ?>";
    moreText.style.display = "inline";
  }
}
</script>
<?php $__env->stopSection(); ?>  <?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/available_employee/search.blade.php ENDPATH**/ ?>