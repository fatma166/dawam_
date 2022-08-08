<div class="col-sm-12">      
    <label for="permission"><?php echo e(__('trans.permission')); ?></label><br>
    <a href="#" class="permission-select-all"><?php echo e(__('trans.all')); ?></a> / <a href="#"  class="permission-deselect-all"><?php echo e(__('trans.cancle')); ?></a>
    <ul class="permissions checkbox" id="check_permission">    
    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <input type="checkbox" id="<?php echo e($key); ?>" class="permission-group">
                <label for="<?php echo e($key); ?>"><strong><?php echo e($key); ?></strong></label>
                <ul>
                      <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>  
                            <input type="checkbox" id="permission-1" name="permission[<?php echo e($perm->id); ?>]"  key="<?php echo e($key); ?>" class="perm_class the-permission <?php echo e($key); ?> " value="<?php echo e($perm->id); ?>" >
                            <label for="permission-1"><?php echo e($perm->key); ?></label>
                        </li>  
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         
               </ul>
            </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div><?php /**PATH /home/dawam/public_html/manger/resources/views/category/permission/cat_permission.blade.php ENDPATH**/ ?>