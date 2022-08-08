
<thead>
    <tr>
        <th><?php echo e(__('trans.Empolyee')); ?></th>
        <th><?php echo e(__('trans.process')); ?></th>
        <th><?php echo e(__('trans.Description')); ?></th>
        <th><?php echo e(__('trans.Time')); ?></th>
        <th class="text-right no-sort"><?php echo e(__('trans.Action')); ?></th>
    </tr>
</thead>
<tbody>
   <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr>
            
         
                  <td>
                <h2 class="table-avatar">
                    <a class="avatar"><img alt="" src="<?php echo e(asset($data->user_avatar)); ?>"></a>
                    <a><?php echo e($data->user_name); ?> <span><?php echo e($data->job_title); ?></span></a>
                </h2>
            </td>
            <td>

<?php echo e(__("trans.".$data->action)); ?>

            </td>
            <td>
<?php echo e($data->description); ?>

            </td>
            <td>
<?php echo e($data->datetime); ?>

            </td>



            <td class="text-right">
                <div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false"><i class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                      
                <a class="dropdown-item" href="<?php echo e(route('delete-logs',['id'=>$data->id])); ?>" data-toggle="modal"  data-target="#delete_log" delete-id="<?php echo e($data->id); ?>"><i class="fa fa-trash-o m-r-5"></i> <?php echo e(__('trans.Delete')); ?></a>

                    </div>
                </div>
            </td>
           
      
        </tr>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 
        

</tbody>


<?php /**PATH /home/dawam/public_html/manger/resources/views/logs/datatable.blade.php ENDPATH**/ ?>