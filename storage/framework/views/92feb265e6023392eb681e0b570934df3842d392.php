<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
  <head>
    <?php echo $__env->make('layout.partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </head>

  <body>
  <?php $segment=Request::segment(2); ?>
  <?php if(($segment != "login") && ($segment != "form_email")): ?>
                                          
        <?php echo $__env->make('layout.partials.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('layout.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   

  <?php endif; ?>
 <?php echo $__env->yieldContent('content'); ?>

 <?php echo $__env->make('layout.partials.footer-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <?php echo $__env->yieldPushContent('footer'); ?>
<?php echo $__env->yieldContent('script'); ?>
  </body>
</html>   <?php /**PATH /home/dawam/public_html/manger/resources/views/layout/mainlayout.blade.php ENDPATH**/ ?>