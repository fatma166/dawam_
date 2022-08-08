

<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.ShowJob_ChartEvalaution')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>




         <!-- /Table Grid -->
            <div class="page-wrapper">
                <!-- Page Content -->
                <div class="content container-fluid">
                   <!-- Page Header -->
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title"><?php echo e(__('trans.ShowJob_ChartEvalaution')); ?></h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                    <li class="breadcrumb-item active"><?php echo e(__('trans.ShowJob_ChartEvalaution')); ?></li>
                                </ul>
                            </div>
                            
                            <div class="col-auto float-right ml-auto">
                               
                                
                              
                                
                                <div class="view-icons">
                                  
                                    <button  class="grid-view btn btn-link" title="<?php echo e(__('trans.grid')); ?>">
                                       <i class="fa fa-th"></i>
                                    </button>
                                   
                                    <button  class="list-view btn btn-link active" title="<?php echo e(__('trans.list')); ?>">
                                       <i class="fa fa-bars"></i>
                                    </button>    
                                  
                                   
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
        
             	<!-- Search Filter -->
				
					<div class="row filter-row">
                        <div class="col-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select floating month" name="month"> 
									<option value="all">-</option>
									<option value="01">Jan</option>
									<option value="02">Feb</option>
									<option value="03">Mar</option>
									<option value="04">Apr</option>
									<option value="05">May</option>
									<option value="06">Jun</option>
									<option value="07">Jul</option>
									<option value="08">Aug</option>
									<option value="09">Sep</option>
									<option value="10">Oct</option>
									<option value="11">Nov</option>
									<option value="12">Dec</option>
								</select>
								<label class="focus-label"><?php echo e(__('trans.Select Month')); ?></label>
							</div>
						</div>  
						<div class="col-3"> 
						<?php $min=(now()->year)-3;?>
							<div class="form-group form-focus select-focus">
								<select class="select floating year" name="year"> 
									<option value="all">-</option>
									
									<?php for($year=now()->year; $year>$min; $year--): ?>
										<option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
									<?php endfor; ?>
								</select>
								<label class="focus-label"><?php echo e(__('trans.Select Year')); ?></label>
							</div>
						</div>
                           
    					   	<div class="col-3">  
    							<div class="form-group form-focus select-focus">
                                <select class="select jobscharts" name="jobs">
                                    <option value="all">-</option>
                                   <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                     <option value=<?php echo e($job->id); ?>><?php echo e($job->title); ?></option>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
    							
    								<label class="focus-label"><?php echo e(__('trans.jobs')); ?></label>
    							</div>
                               
    						</div>
                              
                    
                       
     	            
					
						<div class="col-3">  
                            <a href="#" class="btn btn-danger btn-block" id="empeval_chart"
                            href="#"  
                             data-href="<?php echo e(url('admin/showjobcharts')); ?>"> 
                            <?php echo e(__('trans.EvaluationChart')); ?>

                         </a> 
                        
						</div>     

                    </div>
				
                    
                  <hr />
          
        <!-- /Page Content -->

         <div class="row">
    
                <div class="col-sm-12">
    
                    <?php if(Session::has('success')): ?>
    
                        <p class="alert alert-danger"><?php echo e(Session::get('success')); ?></p>
    
                    <?php endif; ?>
    
                </div>
    
          
            
            
          <!-- /Table List -->
                <div class="col-md-12">
                    
                    <div class="table-responsive evalaution_table">
                         	<div class="row filter-row">
                        
    					     	<div class="col-6">  
                                      <h3 id="eval_year"></h3>
                                 </div>
                                 	<div  class="col-6">  
                                       <h3 id="eval_month"></h3>
                                  </div>
                            </div>   
                        
                         <hr/>
                        
                         
                         <div id="line-chart">
                    
                         </div>
                         
                    </div>
                </div>
                   <!-- /End Table List -->   
              </div>
            
            
        
      
   
     
 
</div>
            
  
 </div>
     



  
<?php $__env->stopSection(); ?>
 <?php $__env->startSection('script'); ?>
 


 <script>


      
    //charts
    $("#empeval_chart").click(function(event)
    {
         var job_id= $(".jobscharts").val();
        
         if(job_id=='all')
         {
            alert('Please Select job First');
            return;
            
         }
         else
         {
              
                let getHref=baseUrl+"showjobcharts";
                var now=new Date();
              
                var year=$('.year').val();
                if(year=='all')
                {
                    year=now.getFullYear();
                }
               
                var month=$('.month').val();
                 if(month=='all')(month="01")
                
                // let shortMonth = month.toLocaleString('en-us', { month: 'short' });
              
                $("#eval_year").text(year);
                ;
                $("#eval_month").text(month);

                //addbootstrap class
                $("#eval_year").addClass('btn btn-outline-warning');
                $("#eval_month").addClass('btn btn-outline-warning');
                   //  $("#emp_name").text($(".employee_name").text());
                  //  $(".employee_name").empty();
                 
                  
                 
                	$.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					url:getHref,
                    data:{job_id:job_id,year:year,month:month},
					}).done(function(data) 
                    {
                       
                       // $("#line-chart").empty();  
                       
                     //   console.log(data);
                       // return;
                        $("#line-chart").empty();
                            Morris.Line({
                            element: 'line-chart',
                            data:data,
                            xkey: 'user_name',
                            ykeys: ['emp_degree'],
                        
                            //ykeys: ['emp_degree','evaluation_degree'],
                        // labels: ['Evaluation Degree','From Degree'],
                        // ykeys: ['Total'],
                            labels: ['job Evaluation Precent %'],
                            lineColors: ['#1DB9C3'],
                            lineWidth: '4px',
                            resize: true,
                            redraw: true,
                            parseTime: false
              	});

         

        	});
           
                  
         }
    });
    
		
</script>

<script src="<?php echo e(asset('plugins/morris/morris.min.js')); ?>"></script>
 <script src="<?php echo e(asset('plugins/raphael/raphael.min.js')); ?>"></script>
 <script src="<?php echo e(asset('js/chart.js')); ?>"></script>		


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/evaluations/job_charts.blade.php ENDPATH**/ ?>