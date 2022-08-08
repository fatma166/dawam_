

<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.tasks')); ?>

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
                            <h3 class="page-title"><?php echo e(__('trans.Tasks')); ?></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo e(__('trans.Tasks')); ?></li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_task"><i class="fa fa-plus"></i><?php echo e(__('trans.Add Task Add New')); ?> </a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <!-- Search Filter -->
				
					<!--<div class="row filter-row task">
						<div class="col-sm-6 col-md-2">  
							<div class="form-group form-focus">
								<input type="text" class="form-control floating employee_task">
								<label class="focus-label"><?php echo e(__('trans.Employee Task')); ?></label>
							</div>
						</div>
						<div class="col-sm-6 col-md-2"> 
							<div class="form-group form-focus select-focus">
								<select class="select floating employee"> 
									<option value="all">-</option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									    <option value="<?php echo e($user->name); ?>"><?php echo e($user->name); ?></option>
								    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
								<label class="focus-label"><?php echo e(__('trans.employee_name')); ?></label>
							</div>
						</div>
                        <div class="col-sm-6 col-md-2">  
							<div class="form-group form-focus focused">
									<select class="select floating status">
                                        <option value="all">-</option>
                                        <option value="delivered"><?php echo e(__('trans.deliverd')); ?></option>
                                        <option value="seen"><?php echo e(__('trans.seen')); ?></option>
                                        <option value="in_progress"><?php echo e(__('trans.in_progress')); ?></option>
                                        <option value="done"><?php echo e(__('trans.done')); ?></option>
                                        <option value="late"><?php echo e(__('trans.late')); ?></option>
                                    </select>
								<label class="focus-label"><?php echo e(__('trans.Status')); ?></label>
							</div>
						</div>
						<div class="col-sm-6 col-md-2">  
							<div class="form-group form-focus focused">
								<div class="cal-icon">
									<input class="form-control floating datetimepicker from_date" type="text" id="min">
								</div>
								<label class="focus-label">From</label>
							</div>
                        </div>
                        <div class="col-sm-6 col-md-2">  
							<div class="form-group form-focus focused">
								<div class="cal-icon">
									<input class="form-control floating datetimepicker to_date" type="text" id="max">
								</div>
								<label class="focus-label">To</label>
							</div>
						</div>
		    
                    </div>-->
                      <!-- Search Filter -->
                <form method="post" class="task_search">
                <div class="row filter-row" >
                
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">  
                        <div class="form-group form-focus">
                          <select class="employee_name  form-control" name="employee_name"></select>
                            <!--<input type="text" class="form-control floating employee_name"  />-->
                            <label class="focus-label"><?php echo e(__('trans.Employee Name')); ?></label>
                        </div>
                   </div>
    
                   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12"> 
                        <div class="form-group form-focus select-focus">
						<select class="select floating status">
                                        <option value="all">-</option>
                                        <option value="delivered"><?php echo e(__('trans.deliverd')); ?></option>
                                        <option value="seen"><?php echo e(__('trans.seen')); ?></option>
                                        <option value="in_progress"><?php echo e(__('trans.in_progress')); ?></option>
                                        <option value="done"><?php echo e(__('trans.done')); ?></option>
                                        <option value="late"><?php echo e(__('trans.late')); ?></option>
                                    </select>
                            <label class="focus-label"><?php echo e(__('trans.Status')); ?></label>
                        </div>
                   </div>
                   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <div class="form-group form-focus " >
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text" name="date_from">
                            </div>
                            <label class="focus-label"><?php echo e(__('trans.From')); ?></label>
                        </div>
                    </div>
                   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text" name="date_to">
                            </div>
                            <label class="focus-label"><?php echo e(__('trans.To')); ?></label>
                        </div>
                    </div>
                
                     <div class="col-sm-6 col-md-3"> 
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
                   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <a  class="btn btn-success btn-block" id="search_task"> <?php echo e(__('trans.Search')); ?> </a>  
                   </div>     
                </div>
                </form>
					
					<!-- /Search Filter -->
     <div id="task_data">
     
       <?php echo $__env->make('tasks.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     </div>
            </div>
            <!-- /Page Content -->

            <!-- Add task Modal -->
            <div id="add_task" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Add task')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form method="post" action="<?php echo e(route('store-task')); ?>">
                             <?php echo csrf_field(); ?>
                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.title')); ?></label>
                                            <input class="form-control" name="title" type="text">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Target User')); ?></label>

                                            <select class="select" name="user_id">
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.Start Date')); ?> <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="start_date" type="text"></div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.End Date')); ?> <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="due_date" type="text"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.Description')); ?> <span class="text-danger">*</span></label>
                                            <textarea class="form-control" rows="4" name="description"></textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="add"><?php echo e(__('trans.Submit')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Task -->
            
            <!-- Edit Task -->
            <div id="edit_task" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Goal Tracking</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form method="post">
                             <?php echo csrf_field(); ?>
                                 <div class="row">

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.title')); ?></label>
                                            <input class="form-control" name="title" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Target User')); ?></label>

                                            <select class="select" name="user_id">
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.Start Date')); ?> <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="start_date" type="text"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.End Date')); ?> <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="due_date" type="text"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.Description')); ?> <span class="text-danger">*</span></label>
                                            <textarea class="form-control" rows="4" name="description"></textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="edit"><?php echo e(__('trans.Save')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit task -->
            
            <!-- Delete task -->
            <div class="modal custom-modal fade" id="delete_task" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3><?php echo e(__('trans.Delete task')); ?></h3>
                                <p><?php echo e(__('trans.Are you sure want to delete?')); ?></p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary task-continue-btn"><?php echo e(__('trans.Delete')); ?></a>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn"><?php echo e(__('trans.Cancel')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Delete task -->
        
        </div>
        <!-- /Page Wrapper -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
        $(document).on('click', '#task_data .pagination a',function(event)
        {
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            $('#search_task').append('<img style="position: absolute; left: 0; top: 0; z-index: 10000;" src="https://i.imgur.com/v3KWF05.gif />');
            var myurl = $(this).attr('href');
           // alert(myurl);
            var page=$(this).attr('href').split('page=')[1];
  
            gettask(page);
        });

function gettask(page){
	        var employee_name= $(".task_search .employee_name").val();
          
            var date_from =$(".task_search  input[name='date_from']").val();
            var date_to =$(".task_search input[name='date_to']").val();
			var status= $(".task_search .status").val();
            var department=$(".department").val();
			var branch=$(".branch").val();
	
        data={employee_name:employee_name,date_from:date_from,date_to:date_to,status:status,department:department,branch:branch};
        $.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"get",
			    url: '?page=' + page,
			 	data:data,
                beforeSend: function() { $("#outdoor_data #load").show(); },
				}).done(function(data) {

                        history.pushState('', '',"<?php echo e(url('admin/task')); ?>"+"?employee_name="+employee_name+"&date_from="+date_from +"&status="+status+"&date_to="+date_to+"&department="+department+"&branch="+branch+"&page="+page);
			
                    
                    $("#task_data #load").hide();
					$("#task_data").empty();
					$("#task_data").append(data);
                    $('#task_data').find('#table_search').DataTable({"scrollX": true});
                    $('#task_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});
    }
    
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/tasks/task_admin.blade.php ENDPATH**/ ?>