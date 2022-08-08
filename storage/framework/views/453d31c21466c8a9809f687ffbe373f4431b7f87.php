
<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.trakingpage')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title"><?php echo e(__('trans.employee_track')); ?></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><?php echo e(__('trans.Dashboard')); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e(__('trans.employee_track')); ?></li>
                        </ul>
                    </div>


                </div>
            </div>
            <!-- /Page Header -->
       <!-- Search Filter -->
       <form>
                    <div class="row filter-row">

                        <div class="col"> 
                            <div class="form-group form-focus ">
                              <select class="employee_name  form-control" name="emp_name"></select>                                                        
                                <label class="focus-label"><?php echo e(__('trans.Select Employee')); ?></label>
                            </div>
                        </div>

                        <div class="col"> 
                            <div class="form-group form-focus ">
                                <select class="select floating branch" name="branch"> 
                                     <option value=""><?php echo e(__('trans.all')); ?></option>
                                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->title); ?></option>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <label class="focus-label"><?php echo e(__('trans.Select Branch')); ?></label>
                            </div>
                        </div>

                        <div class="col">                           
                            <div class="form-group form-focus ">                                    
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_from"></div>
                                    <label class="focus-label"><?php echo e(__('trans.Select Date From')); ?></label>
                            </div>
                        </div>

                        <div class="col"> 
                                 <?php // $min=(now()->year)-3;?>              
                                <div class="form-group form-focus">
                                   
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_to"></div>
                                    <label class="focus-label"><?php echo e(__('trans.Select Date To')); ?></label>
                                </div>                               
                        </div>
                      
                        
                      
                        <div class="col">  
                            <a  class="btn btn-success btn-block" id="search"> <?php echo e(__('trans.Search')); ?> </a>  
                        </div> 

                    </div>
                </form>


            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">

                        <?php echo $dataTable->table(); ?>


                      
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

  


    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
              
$(document).ready(function(){
    
$("#search").click(function () {
    LaravelDataTables["employee_track-table"].draw();
});

LaravelDataTables["employee_track-table"].on("preXhr",function ( e, settings, data ) {
        data.branch=$("form select[name='branch']").val();
        data.emp_name=$("form select[name='emp_name']").val();
        data.date_from=$("form input[name='date_from']").val();
        data.date_to=$("form input[name='date_to']").val();
        console.log(data);
 });

  




});
    	


</script>
<?php $__env->stopSection(); ?>
<?php $__env->startPrepend('footer'); ?>

<?php echo $dataTable->scripts(); ?>


<?php $__env->stopPrepend(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/employee/tracking.blade.php ENDPATH**/ ?>