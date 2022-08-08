

<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.Outdoors')); ?>

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
                            <h3 class="page-title"><?php echo e(__('trans.Outdoors')); ?></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo e(__('trans.Outdoors')); ?></li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_outdoor"><i class="fa fa-plus"></i><?php echo e(__('trans.Add Visit')); ?></a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <!--search filter-->
                <form method="post">
                <div class="row filter-row" id="outdoor">
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">  
                        <div class="form-group form-focus">
                          <select class="employee_name  form-control" name="employee_name"></select>
                            <!--<input type="text" class="form-control floating employee_name"  />-->
                            <label class="focus-label"><?php echo e(__('trans.Employee Name')); ?></label>
                        </div>
                   </div>
                    <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">
                        <div class="form-group form-focus select-focus">
                            <select class="select floating customer_id" name="customer_id">
                             <option value="all">  <?php echo e(__('trans.-- Select --')); ?> </option>
                                <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($client->id); ?>"><?php echo e($client->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <label class="focus-label"><?php echo e(__('trans.Target Client')); ?></label>
                        </div>
                    </div>
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">
                        <div class="form-group form-focus select-focus">
                            <select class="select floating created_by" name="created_by">
                                 <option value="all">  <?php echo e(__('trans.-- Select --')); ?> </option>
                                 <option value="admin"> <?php echo e(__('trans.Admin')); ?> </option>
                                 <option value="employee"> <?php echo e(__('trans.Employee')); ?> </option>
                            </select>
                            <label class="focus-label"><?php echo e(__('trans.created_by')); ?></label>
                        </div>
                    </div>
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12"> 
                        <div class="form-group form-focus select-focus">
                            <select class="select floating status" name="status" > 
                                <option value="all"> <?php echo e(__('trans.-- Select --')); ?> </option>
                                <option value="pending"> <?php echo e(__('trans.Pending')); ?> </option>
                                <option value="done"> <?php echo e(__('trans.Done')); ?> </option>
                                <option value="in_progress"> <?php echo e(__('trans.in_progress')); ?></option>
                                <option value="seen"> <?php echo e(__('trans.seen')); ?></option>
                            </select>
                            <label class="focus-label"><?php echo e(__('trans.Status')); ?></label>
                        </div>
                   </div>
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">  
                        <div class="form-group form-focus" >
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text" name="date">
                            </div>
                            <label class="focus-label"><?php echo e(__('trans.date')); ?></label>
                        </div>
                    </div>
                 <!--  <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">  
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text" name="date_to">
                            </div>
                            <label class="focus-label"><?php echo e(__('trans.To')); ?></label>
                        </div>
                    </div>-->
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">  
                        <a  class="btn btn-success btn-block" id="search_outdoor"> <?php echo e(__('trans.Search')); ?> </a>  
                   </div>     
                </div>
                </form>
                <!-- /Search Filter -->
                <div id="outdoor_data">
                  <?php echo $__env->make('outdoors.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            
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
        $(document).on('click', '#outdoor_data .pagination a',function(event)
        {
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            $('#search_outdoor').append('<img style="position: absolute; left: 0; top: 0; z-index: 10000;" src="https://i.imgur.com/v3KWF05.gif />');
            var myurl = $(this).attr('href');
           // alert(myurl);
            var page=$(this).attr('href').split('page=')[1];
  
            getData(page);
        });
  
    });
  
    function getData(page){
      /*  $.ajax(
        {
            url: '?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data){
            $("#tag_container").empty().html(data);
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
              
        });*/
        	var employee_name= $("#outdoor .employee_name").val();
          
            var customer_id =$("#outdoor .customer_id").val();
			var status= $("#outdoor .status").val();
			var date= $("#outdoor input[name='date']").val();
		//	var to= $("#outdoor input[name='date_to']").val();
            var created_by= $("#outdoor select[name='created_by']").val();
        data={employee_name:employee_name,customer_id:customer_id,status:status,date:date,created_by:created_by};
        $.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"get",
			    url: '?page=' + page,
			 	data:data,
                beforeSend: function() { $("#outdoor_data #load").show(); },
				}).done(function(data) {

                        history.pushState('', '',"<?php echo e(url('admin/outdoor')); ?>"+"?employee_name="+employee_name+"&customer_id="+customer_id +"&status="+status+"&date="+date+"&created_by="+created_by+"&page="+page);
			
                    
                    $("#outdoor_data #load").hide();
					$("#outdoor_data").empty();
					$("#outdoor_data").append(data);
                    $('#outdoor_data').find('#table_search').DataTable({"scrollX": true});
                    $('#outdoor_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});
    }
    
    
      
      /*  $('body').on('click', '.pagination a', function (e) {
            e.preventDefault();
            $('#search_outdoor').append('<img style="position: absolute; left: 0; top: 0; z-index: 10000;" src="https://i.imgur.com/v3KWF05.gif />');
            var url = $(this).attr('href');
           alert(url);
            window.history.pushState("", "", url);
            loadOutdoors(url);
        });
        function loadOutdoors(url){
            	$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"get",
				url:url,
				data:{employee_name:employee_name,customer_id:customer_id,status:status,date:date,created_by:created_by},
                beforeSend: function() { $("#outdoor_data #load").show(); },
				}).done(function(data) {

                        history.pushState('', '',"<?php echo e(url('admin/outdoor')); ?>"+"?employee_name="+employee_name+"&customer_id="+customer_id +"&status="+status+"&date="+date+"&created_by="+created_by);
			
                    
                    $("#outdoor_data #load").hide();
					$("#outdoor_data").empty();
					$("#outdoor_data").append(data);
                    $('#outdoor_data').find('#table_search').DataTable({"scrollX": true});
                    $('#outdoor_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});

        }*/
</script>
<?php $__env->stopSection(); ?>
            <!-- /Page Content -->

            <!-- Add outdoor Modal -->
            <div id="add_outdoor" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Add Visit')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form method="post" action="<?php echo e(route('store-outdoor',$subdomain)); ?>">
                             <?php echo csrf_field(); ?>
                                <div class="row">
                                 <div class="col-sm-6 col-md-6"> 
                                        <div class="form-group">
                                         <label class="col-form-label"><?php echo e(__('trans.Select Branch')); ?><span class="text-danger">*</span></label>
                                            <select class="select floating branch" name="branch"> 
                                               
                                                <?php $__currentLoopData = $branchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            
                                        </div>
            
            
                                   </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Title')); ?> <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="title">
                                        </div>
                                    </div>
                                    <!--<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Target User')); ?></label>

                                            <select class="select" name="user_id">
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value=<?php echo e($user->id); ?>><?php echo e($user->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            </select>
                                        </div>
                                    </div>-->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.Date')); ?> <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="date" type="text"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6"> 
                                        <div class="form-group">
                                          <label class="col-form-label"><?php echo e(__('trans.Target User')); ?> <span class="text-danger">*</span></label>
                                          <select class="employee_name_branch  form-control" name="user_id"></select>                            
                              
                                           
                                        </div>
            
            
                                    </div>
                                   <!--<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Target Client')); ?></label>

                                            <select class="select" name="customer_id">
                                            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($client->id); ?>"><?php echo e($client->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            </select>
                                        </div>
                                    </div>-->
                                <div class="col-sm-12 col-md-12"> 
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.Target Client')); ?> <span class="text-danger">*</span></label>
                                        <select class="client_name_branch select2_multi form-control" name="customer_id[]"  multiple="multiple"></select>                            
                                    </div>
                                </div>
                              <!--  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.Adress')); ?> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="adress">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.lat')); ?> <span class="text-danger" >*</span></label>
                                        <input class="form-control add_lat" type="text" name="add_lat" >
                                    </div>
                                </div>
                               <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.lang')); ?> <span class="text-danger" >*</span></label>
                                        <input class="form-control add_lang" type="text" name="add_lang" >
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div id="map" style="height:400px"></div>

                                </div>-->
                                    

                                  <!--  <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.To Date')); ?> <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="date_to" type="text"></div>
                                        </div>
                                    </div>-->
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.Vist Type')); ?> <span class="text-danger">*</span></label>
                                            <select class="select" name="visit_type_id">
                                            <?php if(!empty($visit_types)): ?>
                                                <?php $__currentLoopData = $visit_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  <option value="<?php echo e($visit_type->id); ?>"><?php echo e($visit_type->name); ?></option>              
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.description')); ?> <span class="text-danger">*</span></label>
                                            <textarea rows="4" class="form-control" name="description"></textarea>
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
            <div id="edit_outdoor" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Edit Visit')); ?></h5>
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
                                <input  type="hidden" name="user_id" value=""/>
                                <input  type="hidden" name="customer_id" value=""/>
                                  <div class="col-sm-6 col-md-6"> 
                                        <div class="form-group">
                                         <label class="col-form-label"><?php echo e(__('trans.Select Branch')); ?><span class="text-danger">*</span></label>
                                            <select class="select floating branch" name="branch"> 
                                               
                                                <?php $__currentLoopData = $branchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->title); ?></option>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            
                                        </div>
            
            
                                   </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Title')); ?> <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="title">
                                        </div>
                                    </div>
 
                                    <div class="col-sm-6 col-md-6"> 
                                        <div class="form-group">
                                          <label class="col-form-label"><?php echo e(__('trans.Target User')); ?> <span class="text-danger">*</span></label>
                                          <select class="employee_name_branch form-control" name="user_id"></select>                            
                              
                                           
                                        </div>
            
            
                                    </div>
                         
                                <div class="col-sm-6 col-md-6"> 
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.Target Client')); ?> <span class="text-danger">*</span></label>
                                        <select class="client_name_branch  form-control" name="customer_id"></select>                            
                                    </div>
                                </div>
                            <!--    <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.Adress')); ?> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="adress">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.lat')); ?> <span class="text-danger" >*</span></label>
                                        <input class="form-control edit_lat" type="text" name="add_lat" >
                                    </div>
                                </div>
                               <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.lang')); ?> <span class="text-danger" >*</span></label>
                                        <input class="form-control edit_lang" type="text" name="add_lang" >
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div id="map_edit" style="height:400px"></div>

                                </div>-->
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.Date')); ?> <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="date" type="text"></div>
                                        </div>
                                    </div>
                                   <!-- <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.To Date')); ?> <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" name="date_to" type="text"></div>
                                        </div>
                                    </div>-->
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.Vist Type')); ?> <span class="text-danger">*</span></label>
                                            <select class="select" name="visit_type_id">
                                            <?php if(!empty($visit_types)): ?>
                                                <?php $__currentLoopData = $visit_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  <option value="<?php echo e($visit_type->id); ?>"><?php echo e($visit_type->name); ?></option>              
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo e(__('trans.description')); ?> <span class="text-danger">*</span></label>
                                        <textarea rows="4" class="form-control" name="description"></textarea>
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
            <div class="modal custom-modal fade" id="delete_outdoor" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3><?php echo e(__('trans.Delete visit')); ?></h3>
                                <p><?php echo e(__('trans.Are you sure want to delete?')); ?></p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary outdoor-continue-btn"><?php echo e(__('trans.Delete')); ?></a>
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
                        
       <div id="add_edit_client" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Add Employee')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                               <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                               </div>
                            <form action="" method="post">
                                 <?php echo csrf_field(); ?>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="hidden" class="outdoor_id"/>
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Target Client')); ?> <span class="text-danger">*</span></label>
                                            <select class="client_name_branch  form-control" name="customer_id"></select>                            
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
        
       <div id="add_edit_rate" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Add Rate')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                               <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                               </div>
                            <form action="" method="post">
                                 <?php echo csrf_field(); ?>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="hidden" class="outdoor_id"/>
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Rate')); ?> <span class="text-danger">*</span></label>
                                           <div class="col-sm-10"> <input type="number" class="form-control" name="rate_value"/></div><div class="col-sm-2">%</div>                         
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
        </div>
        <!-- /Page Wrapper -->
        
         <?php $__env->startSection('script'); ?>
         <script>

         </script>
         <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/outdoors/index.blade.php ENDPATH**/ ?>