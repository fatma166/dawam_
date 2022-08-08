

<?php $__env->startSection('title'); ?>
   <?php echo e(__('trans.Visit Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<!-- Page Wrapper -->
    <div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title"><?php echo e(__('trans.Report')); ?></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo e(__('trans.Visit Type Report')); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <!-- Search Filter -->
                <form>
                    <div class="row filter-row" id="visit_type_report">
         
                      <!-- <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">
                            <div class="form-group form-focus">
                              <select class="employee_name  form-control" name="user_id"></select>
                              
                                <label class="focus-label"><?php echo e(__('trans.Employee Name')); ?></label>
                            </div>
                       </div>-->
                      <div class="col-sm-6 col-md-2"> 
                            <div class="form-group form-focus ">
                                <select class="select floating branch" name="branch"> 
                                     <option value="all"><?php echo e(__('trans.all')); ?></option>
                                    <?php $__currentLoopData = $branchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->title); ?></option>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <label class="focus-label"><?php echo e(__('trans.Select Branch')); ?></label>
                            </div>


                        </div>
                       <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">
                            <div class="form-group form-focus">
                              <select class="employee_name  form-control" name="user_id"></select>
                                <!--<input type="text" class="form-control floating employee_name"  />-->
                                <label class="focus-label"><?php echo e(__('trans.Employee Name')); ?></label>
                            </div>
                       </div>
                       <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">
                            <div class="form-group form-focus select-focus">
                                <select class="select floating visit_types" name="visit_types"> 
                                    <option value="all">-- Select --</option>
                                    <?php $__currentLoopData = $visit_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($visit_type->id); ?>"><?php echo e($visit_type->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>
                                <label class="focus-label"><?php echo e(__('trans.Visit types')); ?> </label>
                            </div>
                        </div>
 
                      <div class="col-sm-6 col-md-2">  
                            <div class="form-group form-focus">
                                <div class="cal-icon">
                                    <input class="form-control floating datetimepicker from" type="text">
                                </div>
                                <label class="focus-label"><?php echo e(__('trans.From')); ?></label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2">  
                            <div class="form-group form-focus">
                                <div class="cal-icon">
                                    <input class="form-control floating datetimepicker to" type="text">
                                </div>
                                <label class="focus-label"><?php echo e(__('trans.to')); ?></label>
                            </div>
                        </div>
                      <div class="col-sm-6 col-md-2"> 
                            <div class="form-group form-focus ">
                                <select class="select floating department" >    
                                 <option value="all"><?php echo e(__('trans.all')); ?></option>
                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>         
                                    <option value="<?php echo e($dep->id); ?>"><?php echo e($dep->title); ?></option>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <label class="focus-label"><?php echo e(__('trans.Select Department')); ?></label>
                            </div>


                        </div>
                       
                       <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">
                            <a href="#" class="btn btn-success btn-block" id="search_visit_type_report"> <?php echo e(__('trans.Search')); ?> </a>  
                        </div>     
                    </div>
                </form>
                <!-- /Search Filter -->
              
               <!--<div class="row">
                    <div class="col-2">
                        <a href="<?php echo e(url('admin/visitTypeReportPrint/visit_type')); ?>" class="btn btn-primary shift-continue-btn" id="visitTypeReport_printlink"><?php echo e(__('trans.visitTypeReportPrint')); ?></a>
                    </div>
                </div>-->
                <div class="visit_type_report_data">

                    <?php echo $__env->make('outdoor_report.vistTypeReportsearch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  
                </div>
            </div>
            <!-- /Page Content -->

        <!-- /Page Wrapper -->
       
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
 	/* search visit visit_report_details*/

    	$("#search_visit_type_report").click(function(e){
    	     e.preventDefault();
    	  
  		
           // var visit_type=$(".visit_types").val();
            var from=$(".from").val();
			var to=$(".to").val();
  	        var department=$(".department").val();
			var branch=$(".branch").val();
  	        var user_id=$(".employee_name").val();
            var visit_type= $("#visit_type_report .visit_types").val();
            $('#visitTypeReport_printlink').attr("href","<?php echo e(url('admin/visitTypeReportPrint/visit_type')); ?>"+"?user_id="+user_id+"&visit_type="+visit_type+"&to="+to+"&from="+from+"&department="+department+"&branch="+branch);
		   
		
			
			let getHref1=baseUrl+"visitTypeReport";
			$.ajax({
			//	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"get",
				url:getHref1,
				data:{user_id:user_id,visit_type:visit_type,to:to,from:from,department:department,branch:branch},
                beforeSend: function() { $(".visit_type_report_data #load").show(); },
				}).done(function(data) {
				     history.pushState('', '',"<?php echo e(url('admin/visitTypeReport')); ?>"+"?user_id="+user_id+"&from="+from+"&to="+to+"&visit_type="+visit_type+"&department="+department+"&branch="+branch);
                    $(".visit_type_report_data #load").show();
					$(".visit_type_report_data").empty();
					$(".visit_type_report_data").append(data);
                    $('.visit_type_report_data').find('#table_search').DataTable({"scrollX": true});
                    $('.visit_type_report_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});
        });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/outdoor_report/vistTypeReport.blade.php ENDPATH**/ ?>