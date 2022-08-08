
<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.leave')); ?>

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
                            <h3 class="page-title"><?php echo e(__('trans.Leaves')); ?></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo e(__('trans.Leaves')); ?></li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i><?php echo e(__('trans.Add Leave')); ?></a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <!-- Leave Statistics -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-info">
                            <h6><?php echo e(__('trans.Today Presents')); ?></h6>
                            <h4><?php echo e($attend_today); ?></h4>
                        </div>
                    </div>
                  <!--  <div class="col-md-3">
                        <div class="stats-info">
                            <h6><?php echo e(__('trans.Planned Leaves')); ?></h6>
                            <h4>8 <span><?php echo e(__('trans.Today')); ?></span></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-info">
                            <h6><?php echo e(__('trans.Unplanned Leaves')); ?></h6>
                            <h4>0 <span><?php echo e(__('trans.Today')); ?></span></h4>
                        </div>
                    </div>-->
                    <div class="col-md-3">
                        <div class="stats-info">
                            <h6><?php echo e(__('trans.Pending Requests')); ?></h6>
                            <h4><?php echo e($pending_today); ?></h4>
                        </div>
                    </div>
                </div>
                <!-- /Leave Statistics -->
                
                <!-- Search Filter -->
                <form method="post" class="leave_serch">
                <div class="row filter-row" id="leave">

                   <div class="col-md-3 col-lg-3">  
                        <div class="form-group form-focus">
                          <select class="employee_name  form-control" name="employee_name"></select>
                            <!--<input type="text" class="form-control floating employee_name"  />-->
                            <label class="focus-label"><?php echo e(__('trans.Employee Name')); ?></label>
                        </div>
                   </div>

                   <div class="col-md-3 col-lg-3">  
                        <div class="form-group form-focus select-focus">
                            <select class="select floating leave_type" name="type"> 
                                <option value="all" ><?php echo e(__('trans.all')); ?></option>
                              <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                           
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <label class="focus-label"><?php echo e(__('trans.Leave Type')); ?></label>
                        </div>
                   </div>

                   <div class="col-md-3 col-lg-3"> 
                        <div class="form-group form-focus select-focus">
                            <select class="select floating status" name="status" > 
                                <option value="all"><?php echo e(__('trans.all')); ?></option>
                                <option> Pending </option>
                                <option> Approved </option>
                                <option> Rejected </option>
                            </select>
                            <label class="focus-label"><?php echo e(__('trans.Leave Status')); ?></label>
                        </div>
                   </div>

                   <div class="col-md-3 col-lg-3">  
                        <div class="form-group form-focus " >
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text" name="date_from">
                            </div>
                            <label class="focus-label"><?php echo e(__('trans.From')); ?></label>
                        </div>
                    </div>

                   <div class="col-md-3 col-lg-3">  
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text" name="date_to">
                            </div>
                            <label class="focus-label"><?php echo e(__('trans.To')); ?></label>
                        </div>
                    </div>

                     <div class="col-md-3 col-lg-3"> 
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

                    <div class="col-md-3 col-lg-3"> 
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

                   <div class="col-md-3 col-lg-3">  
                        <a  class="btn btn-success btn-block" id="search_leave"> <?php echo e(__('trans.Search')); ?> </a>  
                   </div> 

                </div>
                </form>
             <?php if(Session::has('success')): ?>

                <div class="alert alert-success">

                    <?php echo e(Session::get('success')); ?>


                    <?php

                        Session::forget('success');

                    ?>

                </div>

            <?php endif; ?>


            <?php if(Session::has('error')): ?>

                <div class="alert alert-success">

                    <?php echo e(Session::get('error')); ?>




                </div>

            <?php endif; ?>
    <!-- /Search Filter -->
    
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                    
                        <?php echo $dataTable->table(); ?>


                    </div>
                </div>
            </div>
            </div>
            <!-- /Page Content -->
            
            <!-- Add Leave Modal -->
            <div id="add_leave" class="modal custom-modal fade " role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">إضافة إذن</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form action="<?php echo e(route('store-leaves',$subdomain)); ?>"  method="post">
                            <div class="container">
                            <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo e(__('trans.user')); ?> <span class="text-danger">*</span></label>
                                    <select class="select leave_user" name="user_id">
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo e(__('trans.Leave Type')); ?> <span class="text-danger">*</span></label>
                                    <select class="select select_leave_type" name="type">
                                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span><?php echo e(__('trans.available days')); ?></span><span>     </span><span class="available_days"></span></br>
                                    <span><?php echo e(__('trans.message:')); ?></span><span class="msg-text"></span>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo e(__('trans.From')); ?> <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker from"  id="from_" type="text" name="leave_from">
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo e(__('trans.To')); ?> <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker to" type="text" name="leave_to">
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-12">
                                <div class="form-group">
                                    <label><?php echo e(__('trans.Number of days')); ?> <span class="text-danger">*</span></label>
                                    <input class="form-control" readonly type="text" name="days">
                                </div>
                                </div>
                                <div class="col-lg-12">
                                <div class="form-group">
                                    <label><?php echo e(__('trans.Leave Reason')); ?> <span class="text-danger">*</span></label>
                                    <textarea rows="10" class="form-control" name="leave_reson"></textarea>
                                </div>
                                </div>


                                <div class="save_msg" style="color:red;text-align:center;"></div>
                                <div class="submit-section text-center">
                                    <button class="btn btn-primary submit-btn" type="add"><?php echo e(__('trans.Submit')); ?></button>
                                </div>
                                </div> 
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Leave Modal -->
            
            <!-- Edit Leave Modal -->
            <div id="edit_leave" class="modal custom-modal fade leave_" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Edit Leave')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form >
                                <div class="form-group">
                                    <label><?php echo e(__('trans.user')); ?> <span class="text-danger">*</span></label>
                                    <select class="select" name="user_id">
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(__('trans.Leave Type')); ?> <span class="text-danger">*</span></label>
                                    <select class="select select_leave_type" name="type">
                                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span><?php echo e(__('trans.available days')); ?></span><span>     </span><span class="available_days"></span></br>
                                    <span><?php echo e(__('trans.message:')); ?></span><span class="msg-text"></span>
                                </div>
                               <div class="form-group">
                                    <label><?php echo e(__('trans.From')); ?> <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker from" type="text" name="leave_from">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(__('trans.To')); ?> <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text" name="leave_to">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(__('trans.Number of days')); ?> <span class="text-danger">*</span></label>
                                    <input class="form-control" readonly type="text" name="days">
                                </div>
  
                                <div class="form-group">
                                    <label><?php echo e(__('trans.Leave Reason')); ?> <span class="text-danger">*</span></label>
                                    <textarea rows="4" class="form-control" name="leave_reson"></textarea>
                                </div>
                   
                                   <div class="save_msg" style="color:red;text-align:center;"></div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="edit"><?php echo e(__('trans.Save')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Leave Modal -->

            <!-- Approve Leave Modal -->
            <div class="modal custom-modal fade" id="stutas_leave" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3><?php echo e(__('trans.Leave Status')); ?></h3>
                                <p><?php echo e(__('trans.Are you sure want to do action for this leave?')); ?></p>
                            </div>
                                <div class="form-group">
                                    <label><?php echo e(__('trans.Leave Answer')); ?> <span class="text-danger">*</span></label>
                                    <textarea rows="4" class="form-control" name="answer"></textarea>
                                </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary leave_status_continue-btn" ><?php echo e(__('trans.Approve')); ?></a>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn"><?php echo e(__('trans.Decline')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Approve Leave Modal -->
            <div class="modal custom-modal fade" id="decline_leave" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Leave Approve</h3>
                                <p>Are you sure want to approve for this leave?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary leave_decline_continue-btn">Decline</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Approve Leave Modal -->
            
            <!-- Delete Leave Modal -->
            <div class="modal custom-modal fade" id="delete_leave" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3><?php echo e(__('trans.Delete Leave')); ?></h3>
                                <p><?php echo e(__('trans.Are you sure want to delete this leave?')); ?></p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn leave-continue-btn"><?php echo e(__('trans.Delete')); ?></a>
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
            <!-- /Delete Leave Modal -->
            
        </div>
        <!-- /Page Wrapper -->
       
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
  <?php 
 $search_data=0;
        if(isset($_GET['employee_name'])) { $search_data=1;}else {$search_data=0;}
        
 ?>   
$(document).ready(function(){
   
if (window.location.href.indexOf('?employee_name=') > 0) {
            employee_name=GetURLParameter('employee_name');
            leave_type=GetURLParameter('leave_type');
            from=GetURLParameter('from');  
            to=GetURLParameter('to');
            department=GetURLParameter('department');
            branch=GetURLParameter('branch');
            status=GetURLParameter('status');
            var $newOptionEmployee = $("<option selected='selected'></option>").val(employee_name);
     
            $(".leave_serch .employee_name").append($newOptionEmployee).trigger('change');
            $(".leave_serch .leave_type").val(leave_type);
            $(".leave_serch .status").val(status);
            $(".leave_serch  input[name='date_from']").val(from);
            $(".leave_serch input[name='date_to']").val(to); 
            $(".department").val(department); 
            $(".branch").val(branch); 
    }
     
    function GetURLParameter(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam)
        {
            return decodeURIComponent(sParameterName[1]);
        }
    }
}       
$("#search_leave").click(function () {
    LaravelDataTables["leaves-table"].draw();
});

LaravelDataTables["leaves-table"].on("preXhr",function ( e, settings, data ) {
         	data.employee_name= $(".leave_serch .employee_name").val();
			data.leave_type= $(".leave_serch .leave_type").val();
			data.status= $(".leave_serch .status").val();
			data.from= $(".leave_serch  input[name='date_from']").val();
			data.to= $(".leave_serch input[name='date_to']").val();
            data.department=$(".department").val();
			data.branch=$(".branch").val();
        console.log(data);
 });

  


   
   
   
});
    	


</script>
    

   <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="<?php echo e(asset('/vendor/datatables/buttons.server-side.js')); ?>"></script>
    	<script src="<?php echo e(asset('js/select2.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
        	<script src="<?php echo e(asset('js/jquery.slimscroll.min.js')); ?>"></script>
            		<!-- Datetimepicker JS -->  
		<script src="<?php echo e(asset('js/moment.min.js')); ?>"></script>
		<script src="<?php echo e(asset('js/bootstrap-datetimepicker.min.js')); ?>"></script>                                    
<?php $__env->stopSection(); ?>
<?php $__env->startPrepend('footer'); ?>

<?php echo $dataTable->scripts(); ?>


<?php $__env->stopPrepend(); ?>

 
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/leave/leavedatatable.blade.php ENDPATH**/ ?>