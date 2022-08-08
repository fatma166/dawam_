

<?php $__env->startSection('title'); ?>
     <?php echo e(__('trans.available')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title"><?php echo e(__('trans.available')); ?></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo e(__('trans.available')); ?></li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                          
                            <div class="view-icons">
                                <a href="employees" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                                <a href="employees-list" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <!-- Search Filter -->
                <form method="get" class="avaliable_search">
                <div class="row filter-row">

                    <div class="col-sm-3 col-md-3">  
                        <div class="form-group form-focus">
                            <select class="employee_name  form-control" name="employee_name"></select>
                            <label class="focus-label"><?php echo e(__('trans.Employee')); ?></label>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3"> 
                        <div class="form-group form-focus select-focus">
                            <select class="select floating client"> 
                             <option value="all"><?php echo e(__('trans.all')); ?></option>
                               <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($client->id); ?>"><?php echo e($client->name); ?></option>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      
                            </select>
                            <label class="focus-label"><?php echo e(__('trans.clients')); ?></label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3"> 
                        <div class="form-group form-focus ">
                            <select class="select floating branch"> 
                                 <option value="all"><?php echo e(__('trans.all')); ?></option>
                                <?php $__currentLoopData = $branchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->title); ?></option>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <label class="focus-label"><?php echo e(__('trans.Select Branch')); ?></label>
                        </div>


                    </div>
                    <input  type="hidden" class="type" value="<?php echo e($type); ?>"/>
                    <div class="col-sm-3 col-md-3">  
                        <a href="#" class="btn btn-success btn-block" id="search_available"> <?php echo e(__('trans.Search')); ?> </a>  
                    </div>
                </div>
                </form>
                <!-- Search Filter -->
               <div class="row staff-grid-row available_data">
                 <?php echo $__env->make('available_employee.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               </div>
            </div>
            <!-- /Page Content -->
            

            
</div>
<!-- /Page Wrapper -->
<style>
.more{display: none;}

</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/available_employee/available.blade.php ENDPATH**/ ?>