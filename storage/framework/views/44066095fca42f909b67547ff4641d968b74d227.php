
<?php $__env->startSection('content'); ?>
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title"><?php echo e(__('trans.Reports')); ?></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><?php echo e(__('trans.Dashboard')); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e(__('trans.USER REPORT')); ?></li>
                        </ul>
                    </div>
                    

                </div>
            </div>
            <!-- /Page Header -->
                <!-- Search Filter -->
                <form  method="get" >
                    <div class="row filter-row">

                        <div class="col-sm-6 col-md-3"> 
                            <!---<div class="form-group form-focus ">
                                <select class="select floating month"> 
                                
                                    <option value="1">Jan</option>
                                    <option value="2">Feb</option>
                                    <option value="3">Mar</option>
                                    <option value="4">Apr</option>
                                    <option value="5">May</option>
                                    <option value="6">Jun</option>
                                    <option value="7">Jul</option>
                                    <option value="8">Aug</option>
                                    <option value="9">Sep</option>
                                    <option value="10">Oct</option>
                                    <option value="11">Nov</option>
                                    <option value="12">Dec</option>
                                </select>
                                <label class="focus-label"><?php echo e(__('trans.Select Month')); ?></label>
                            </div>-->
                            <div class="form-group form-focus ">
                                    
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_from"></div>
                                    <label class="focus-label"><?php echo e(__('trans.Select Date From')); ?></label>
                            </div>

                        </div>
                        <div class="col-sm-6 col-md-3"> 
                        <?php // $min=(now()->year)-3;?>
               
                                <div class="form-group form-focus">
                                   
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_to"></div>
                                    <label class="focus-label"><?php echo e(__('trans.Select Date To')); ?></label>
                                </div>
                                
                        </div>

        
                        
                        <div class="col-sm-6 col-md-3"> 
                            <div class="form-group form-focus select_userforreport "><small class="alert_msg"></small>
                                <select class="employee_name  form-control" name="employee_name"></select>  
                                <label class="focus-label"><?php echo e(__('trans.Select Employee')); ?></label>
                            </div>


                        </div>
                        <div class="col-sm-6 col-md-3">  
                            <a  class="btn btn-success btn-block" id="search_userReport"> <?php echo e(__('trans.Search')); ?> </a>  
                        </div>     
                    </div>
                </form>
                <!-- /Search Filter -->
            <div class="row"></div>
            <div class="row">
                <div class="col-2">
               
                    <a href="<?php  echo url('admin/userReportPrint/userReport?id='.$user_data->id.'&date_from='.$date_from.'&date_to='.$date_to); ?>" class="btn btn-primary shift-continue-btn"   id="userReport_printlink"> <?php echo e(__('trans.Print userReport')); ?></a>
                </div>

            </div>


            <div class="row" id="userReport_" >
                    <?php echo $__env->make('reports.userRerport_ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        <!-- /Page Content -->



    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/reports/userRerport.blade.php ENDPATH**/ ?>