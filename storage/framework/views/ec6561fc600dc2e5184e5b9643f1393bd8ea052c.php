
<thead>
    <tr>
    <th><?php echo e(__('trans.Employee ID')); ?></th>

        <th><?php echo e(__('trans.Empolyee')); ?></th>
        <th><?php echo e(__('trans.Mobile')); ?></th>
        <th><?php echo e(__('trans.Branch')); ?></th>
        <th><?php echo e(__('trans.LastLogin')); ?></th>
        <th>معلومات الجهاز</th>
        <th>
    </tr>
</thead>
<tbody>
   <?php $__currentLoopData = $tracking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr>
            
        <td>
              <?php echo e($data->user_id); ?>

            </td>
            <td>
                <h2 class="table-avatar">
                    <a class="avatar"><img alt="" src="<?php echo e(asset($data->avatar)); ?>"></a>
                    <a><?php echo e($data->username); ?> <span><?php echo e($data->job_title); ?></span></a>
                </h2>
            </td>
    

          
            <td>
              <?php echo e($data->phone); ?>

            </td>
          
            <td>
              <?php echo e($data->branch_title); ?>

            </td>
            <td>
              <?php echo e($data->last_login); ?>

            </td>
            <?php
            $list=json_decode($data->device_info);
            ?>
            <?php if($list): ?>
           
            <td><?php echo e($list->brand.'~'.$list->app_ver.'~'.$list->os_ver); ?></td>
           

           <?php else: ?>
           <td></td> 
           
          <?php endif; ?>

          <td>
              <?php 
            if($data->last_login){
                echo  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$data->last_login)->locale('ar')->diffForHumans();
            }
             ?>
            </td>



        
           
      
        </tr>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 
        

</tbody>


<?php /**PATH /home/dawam/public_html/manger/resources/views/employee/tracking_datatable.blade.php ENDPATH**/ ?>