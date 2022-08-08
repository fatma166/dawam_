

<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.report-department')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title"><?php echo e(__('trans.Companies')); ?></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e(__('trans.Department Report')); ?></li>
                        </ul>
                    </div>
                    

                </div>
            </div>
            <!-- /Page Header -->



            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <th>#</th>
                                <th><?php echo e(__('trans.Department')); ?></th>
                                <th><?php echo e(__('trans.total')); ?></th>
                                <th><?php echo e(__('trans.present')); ?></th> 
                                <th><?php echo e(__('trans.absent')); ?></th> 
                                <th><?php echo e(__('trans.late_comers')); ?></th> 
                                <th><?php echo e(__('trans.early leave')); ?></th> 
                            </thead>
                            <tbody>
                          
                                <?php if(!empty( $dep_report)): ?>
                                    <?php $__currentLoopData = $dep_report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=> $dep_rep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   
                                        <tr>
                                            <td><?php echo e($index+1); ?></td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                <?php if(isset($dep_rep['dep_name'])): ?> <?php echo e($dep_rep['dep_name']); ?> <?php endif; ?>
                                                </h2>
                                            </td>

                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                <?php if(isset($dep_rep['total'])): ?> <?php echo e($dep_rep['total']); ?> <?php endif; ?>
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                <?php if(isset($dep_rep['present'])): ?> <?php echo e($dep_rep['present']); ?> <?php endif; ?>
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    
                                                <?php if(isset($dep_rep['absent'])): ?> <?php echo e($dep_rep['absent']); ?> <?php endif; ?>
                                                </h2>
                                            </td>
                                             <td>
                                                <h2 class="table-avatar">
                                                    
                                                <?php if(isset($dep_rep['late_comers'])): ?> <?php echo e($dep_rep['late_comers']); ?> <?php endif; ?>
                                                </h2>
                                            </td>  
                                             <td>
                                                <h2 class="table-avatar">
                                                    
                                                <?php if(isset($dep_rep['early_leave'])): ?> <?php echo e($dep_rep['early_leave']); ?> <?php endif; ?>
                                                </h2>
                                            </td> 
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->



    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/reports/department_report.blade.php ENDPATH**/ ?>