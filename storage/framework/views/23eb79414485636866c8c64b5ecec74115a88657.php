

<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.evaluation_report')); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">
   
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title"><?php echo e(__('trans.evaluation_report')); ?></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><?php echo e(__('trans.evaluation_report')); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e(__('trans.Dashboard')); ?></li>
                        </ul>
                    </div>
                    

                </div>
            </div>
            <!-- /Page Header -->
         
                <!-- Search Filter -->
                <form method="get">
                    <div class="row filter-row" id="evalua_eport">

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
                            <div class="form-group form-focus ">
                                <select class="select floating department" id="datepicker">    
                                 <option value="all"><?php echo e(__('trans.all')); ?></option>
                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>         
                                    <option value="<?php echo e($dep->id); ?>"><?php echo e($dep->title); ?></option>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <label class="focus-label"><?php echo e(__('trans.Select Department')); ?></label>
                            </div>


                        </div>
                        <div class="col"> 
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
                        
                        <div class="col"> 
                            <div class="form-group form-focus ">
                              <select class="employee_name  form-control" name="employee_name"></select>                            
                               <!-- <select class="select floating employee"> 
                                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($employee->id); ?>"><?php echo e($employee->name); ?></option>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>-->
                                <label class="focus-label"><?php echo e(__('trans.Select Employee')); ?></label>
                            </div>


                        </div>
                        <div class="col">  
                            <a  class="btn btn-success btn-block" id="evaluation_search"> <?php echo e(__('trans.Search')); ?> </a>  
                        </div>   
                
                    </div>
                </form>
                <!-- /Search Filter -->



            <div class="row">
                <div class="col">
                     <a href="<?php echo e(url('admin/evaluationprint/evalaution')); ?>" class="btn btn-primary shift-continue-btn" id="evaluation_printlink"><?php echo e(__('trans.Print_EvaluationReport')); ?></a>                </div>
            </div>
            <div class="row" id="evaluation_body">
                 
                    <?php echo $__env->make('reports.evaluationreport_ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  
            </div>
            
      
       <?php $__env->startSection('script'); ?>
         <script type="text/javascript">
             $(window).on('hashchange', function() {
           if (window.location.hash) {
                  var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                   }else{
                    getData(page);
                   }
                 }
         });
           $(document).ready(function()
    {
       // $('#search_data').hide();
        $(document).on('click', '#evaluation_body .pagination a',function(event)
        {
           
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
          $('#search_empeval').append('<img style="position: absolute; left: 0; top: 0; z-index: 10000;" src="https://i.imgur.com/v3KWF05.gif />');
            var myurl = $(this).attr('href');
            // alert(myurl);
            var page=$(this).attr('href').split('page=')[1];
  
            getData(page);
        });
  
    });
    
     function getData(page)
    {
      
       var department=$(".department").val();
       var branch=$(".branch").val();
       var user=$(".employee_name").val();
       if (user=='null')
       {
        user='all';
       }
       
       let date_from=new Date($("input[name='date_from']").val());
       let from_month=((date_from.getMonth()+1) <= 9 ? '0': '') + (date_from.getMonth()+1) ;
       let from_year=date_from.getFullYear();
       let date_to=new Date($("input[name='date_to']").val());
       let to_month=((date_to.getMonth()+1) <= 9 ? '0': '') + (date_to.getMonth()+1) ;
       let to_year=date_to.getFullYear();
       data={department:department,branch:branch,user:user,from_month:from_month,from_year:from_year,to_month:to_month,to_year:to_year};
	      
        $.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"get",
			    url: '?page=' + page,
			 	data:data,
                beforeSend: function() { $("#search_data #load").show(); },
				}).done(function(data) {

                        history.pushState('', '',"<?php echo e(url('admin/Evaluation_Report')); ?>"+"?user="+user+"&department="+department +"&branch="+branch+"&from_month="+from_month+"&from_year="+from_year+"&to_month="+to_month+"&to_year="+to_year+"&page="+page);
			
                    
                    $("#evaluation_body #load").hide();
					$("#evaluation_body").empty();
					$("#evaluation_body").append(data);
                  // $('#search_data').find('#table_search').DataTable({"scrollX": true});
                 //  $('#search_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});
    }
    
        </script> 
      <?php $__env->stopSection(); ?>
        

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/reports/evaluation_report.blade.php ENDPATH**/ ?>