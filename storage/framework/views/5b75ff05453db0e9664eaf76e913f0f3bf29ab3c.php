
<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.ClientProfile')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
		<script src="<?php echo e(asset('plugins/morris/morris.min.js')); ?>"></script>

		<script src="<?php echo e(asset('plugins/raphael/raphael.min.js')); ?>"></script>

		<script src="<?php echo e(asset('js/chart.js')); ?>"></script>	
        
        

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
                            <h3 class="page-title">Profile</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo e(__('trans.ClientProfile')); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="card mb-0 profile-client">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-view">
                                    <div class="profile-img-wrap">
                                        <div class="profile-img client-img">
                                            <a href="">
                                                <img src="img/profiles/avatar-19.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="profile-basic">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="profile-info-left">
                                                    <h3 class="user-name user-name-client m-t-0"><?php echo e($profile->name); ?></h3>
                                                    <div class="client-left-info">
                                                       <h5 class="company-role m-t-0 mb-0 branch"><span class="badge badge-secondary">الفرع</span> <?php echo e($profile->branch_title); ?></h5>
                                                       <small class="text-muted"><span class="badge badge-secondary">نوع العميل</span> <?php echo e($profile->type_name); ?></small>
                                                       <!--<div class="staff-id">Employee ID : CLT-0001</div>-->
                                                   </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-7 border-dashed">
                                                <ul class="personal-info personal-info-client">
                                                    <li>
                                                        <span class="title"><?php echo e(__('trans.phone')); ?>:</span>
                                                        <span class="text"><a href=""><?php if(!empty($profile->phone)): ?><?php echo e($profile->phone); ?><?php else: ?> <?php echo e(__('trans.non')); ?> <?php endif; ?></a></span>
                                                    </li>
                                                    <li>
                                                        <span class="title"><?php echo e(__('trans.Email')); ?>:</span>
                                                        <span class="text"><a href=""><?php if(!empty($profile->email)): ?><?php echo e($profile->email); ?><?php else: ?> <?php echo e(__('trans.non')); ?> <?php endif; ?></a></span>
                                                    </li>
                                                    <li>
                                                        <span class="title"><?php echo e(__('trans.contact_person')); ?>:</span>
                                                        <span class="text"><?php if(!empty($profile->contact_person)): ?><?php echo e($profile->contact_person); ?> <?php else: ?> <?php echo e(__('trans.non')); ?> <?php endif; ?></span>
                                                    </li>
                                                    <li>
                                                        <span class="title"><?php echo e(__('trans.address')); ?>:</span>
                                                        <span class="text"><?php if(!empty($profile->address)): ?><?php echo e($profile->address); ?> <?php else: ?> <?php echo e(__('trans.non')); ?> <?php endif; ?></span>
                                                    </li>
                                                  <!--  <li>
                                                        <span class="title"><?php echo e(__('trans.start_time')); ?></span>
                                                        <span class="text"><?php echo e($profile->start_time); ?></span>
                                                    </li>
                                                                                                       <li>
                                                        <span class="title"><?php echo e(__('trans.end_time')); ?></span>
                                                        <span class="text"><?php echo e($profile->end_time); ?></span>
                                                    </li>-->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              <div class="row percent-client">
					<div class="col-md-12">
					<div class="card-group m-b-30">
                      <div class="card">
    						<div class="card-body">
    							<div class="d-flex justify-content-between mb-3">
    								<div>
    									<span class="d-block"><?php echo e(__('trans.current month percentage')); ?></span>
    								</div>
    								<div>
    									<span class="text-success"><?php echo e($percentage); ?>%</span>
    								</div>
    							</div>
    							<h3 class="mb-3"><?php echo e($outdoor_count); ?></h3>
    							<div class="progress mb-2" style="height: 5px;">
    								<div class="progress-bar bg-primary" role="progressbar" style="width:<?php echo e($percentage); ?>%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
    							</div>
    							<p class="mb-0"><?php echo e(__('trans.count target')); ?> <span><?php echo e($target); ?></span></p>
    						</div>
    					</div>
                      </div>
                   </div>
              </div> 
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12 text-center">
							<!--	<div class="card">
									<div class="card-body">
										<h3 class="card-title">Total Revenue</h3>
										<div id="bar-client-charts"></div>
									</div>
								</div>
							</div>
							<div class="col-md-6 text-center">-->
								<div class="card">
									<div class="card-body">
								     	<h3 class="card-title"><?php echo e(__('trans.statistic')); ?></h3>
										<div id="bar-client-charts"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


            </div>
            <!-- /Page Content -->
            
        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
$(document).ready(function() {

   // var data_line_chart;

		getUrl=window.location;
	var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

	// Bar Client Chart

		client_line_chart_url=baseUrl+"/client-line-chart";
        var url = window.location.pathname
        var id = url.substring(url.lastIndexOf('/') + 1);
        var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];   
	// Line Chart
		$.ajax({

		url:client_line_chart_url,
        data:{id:id},
		}).done(function(data) {
		  console.log(data);
            	Morris.Bar({
            		element:'bar-client-charts',
            		data: data,
            		xkey: 'month',
            		ykeys: ['monthly_vists'],
            		labels: ['Total outdoor'],
            		lineColors: ['#ff9b44'],
            		lineWidth: '3px',
            		barColors: ['#ff9b44'],
            		resize: true,
            		redraw: true,
                    parseTime: false,
                    xLabels:'month',
                   // axes:false
                    xLabelFormat: function (x) { // <-- changed
                       // console.log("this is the new object:" + x);
                        var month = months[x.x];
                        return month;
                    },
                    
            	});

	
		
		
      });
 });

</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/client/client_profile.blade.php ENDPATH**/ ?>