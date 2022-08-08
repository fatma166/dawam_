

<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.company')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title"><?php echo e(__('trans.Companies')); ?></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e(__('trans.Companies')); ?></li>
                        </ul>
                    </div>
                    <?php if($roles['name']=="developer"||$roles['name']=="accountant"||$roles['name']=="super_admin"|| (Session::has('company'))): ?> 
                    <div class="col-auto float-right ml-auto">
                        <?php if($check=="add"): ?>
                        <a href="<?php echo e(route('create-company',$subdomain)); ?>" class="btn add-btn" data-toggle="modal"
                            data-target="#add_company"><i class="fa fa-plus"></i> <?php echo e(__('trans.Add Company')); ?></a>
                            <?php endif; ?>
                        <div class="view-icons">
                            
                           <!-- abdelkawy change href to button and call by jquery  -->
                             <button  class="grid-view btn btn-link" title="<?php echo e(__('trans.grid')); ?>">
                                       <i class="fa fa-th"></i>
                                    </button>
                                   
                                    <button  class="list-view btn btn-link active" title="<?php echo e(__('trans.list')); ?>">
                                       <i class="fa fa-bars"></i>
                            </button>    
                        
                      
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- /Page Header -->

   <!-- /Table Grid -->
			   
					<div class="row staff-grid-row" style="display: none;">
                       <?php if(isset($company->id)): ?>
                            
					  <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                      
							<div class="profile-widget">
								<div class="profile-img">
									<a  data-href="<?php echo e(url('admin/company-edit/'.$company->id)); ?>"
                                        data-id="<?php echo e($company->id); ?>" data-toggle="modal" data-target="#edit_company" class="avatar"></a>
								</div>
								<div class="dropdown profile-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                 		<div class="dropdown-menu dropdown-menu-right">
									     <a class="dropdown-item" data-href="<?php echo e(url('admin/company-edit/'.$company->id)); ?>"
                                                         data-id="<?php echo e($company->id); ?>" data-toggle="modal" data-target="#edit_company"><i
                                                            class="fa fa-pencil m-r-5"></i> <?php echo e(__('trans.Edit')); ?></a>
       
        
									</div>
								</div>
								 <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="#"><?php if(isset($company->title)): ?> <?php echo e($company->title); ?> <?php endif; ?></a></h4>
                                 
							</div>
						</div>
                          
                          <?php endif; ?>
					</div>


       



            <div class="row">
             <?php if($roles['name']=="developer"||$roles['name']=="accountant"||$roles['name']=="super_admin"): ?>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 " id="table_search">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('trans.company_name')); ?></th>
                     
                                   
                                   

                                        <th><?php echo e(__('trans.go_company')); ?></th>
                                        <th><?php echo e(__('trans.total_users')); ?></th>
                                        <th><?php echo e(__('trans.status')); ?></th>
                                   
                                      <!-- <th><?php echo e(__('trans.edit')); ?></th>-->
                                   
                                    
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                          
                          <?php if(isset($company->id)): ?>
                                   <tr>
                                        <td>
                                           
                                        
                                            <a  data-toggle="modal" data-href="<?php echo e(url('admin/company-edit/'.$company->id)); ?>"
                                                data-id="<?php echo e($company->id); ?>" style="cursor: pointer;"
                                              data-target="#edit_company"> <?php if(isset($company->title)): ?> <?php echo e($company->title); ?> <?php endif; ?></a>
                                        </td>
                                        <td>
                                            <a class="btn btn-outline-warning" data-toggle="modal" data-href="<?php echo e(url('admin/company-edit/'.$company->id)); ?>"
                                                data-id="<?php echo e($company->id); ?>" style="cursor: pointer;"
                                              data-target="#edit_company"> <?php echo e(__('trans.Edit')); ?></a>
                                        </td>



                                      
                                    </tr>       
                                
                                
                                
                                
                                <?php else: ?>
                                
                                <?php $__currentLoopData = $company; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="<?php echo e(url('admin/company/profile/'.$company1->id)); ?>"><?php if(isset($company1->title)): ?> <?php echo e($company1->title); ?> <?php endif; ?></span></a>
                                            </h2>
                                        </td>




                                        
                                        <?php if($roles['name']=="developer"||$roles['name']=="accountant"||$roles['name']=="super_admin"): ?>
                                            <td><button   onclick="goCompany(<?php echo e($company1->id); ?>)" ><?php echo e(__('trans.go_to_company')); ?></button></td>
                                            <td><?php echo e($company1['total']); ?></td>
                                     
                                            <!--<td><?php if($company1['status']==1): ?><?php echo e(__('trans.Yes')); ?><?php else: ?><?php echo e(__('trans.No')); ?> <?php endif; ?></td>-->
                                            <td class="text-center">
                                                <div class="dropdown action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-dot-circle-o <?php if($company1['status']==0): ?><?php echo e('text-danger'); ?><?php else: ?> <?php echo e('text-success'); ?> <?php endif; ?>"><?php if($company1['status']==0): ?><?php echo e(__('trans.NotActive')); ?><?php else: ?><?php echo e(__('trans.Active')); ?><?php endif; ?></i> 
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_company" status="1" company-id="<?php echo e($company1->id); ?>"><i class="fa fa-dot-circle-o text-success"></i> <?php echo e(__('trans.Active')); ?></a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_company" status="0"  company-id="<?php echo e($company1->id); ?>"><i class="fa fa-dot-circle-o text-danger"></i><?php echo e(__('trans.NotActive')); ?></a>
                                                    </div>
                                                </div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>       
                                
                                
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                


                            </tbody>
                        </table>
                    </div>
                </div>
        <?php else: ?>
                

      <?php if(isset($company)&& (Session::has('company'))||(isset($company)&& ($roles['name']=='admin')||($roles['name']=='manger'))): ?>
       
        <!-- Edit company Modal -->
       <!-- <div id="edit_company" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                   <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('trans.Edit Company')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>-->
                    <!-- <div class="modal-body">
                       <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>-->
            <div id="edit_company" class="<?php if($roles['name']=='developer'||$roles['name']=='accountant'||$roles['name']=='super_admin'|| (Session::has('company'))): ?> <?php echo e('modal custom-modal fade'); ?><?php endif; ?>" role="<?php if($roles['name']=='developer'||$roles['name']=='accountant'||$roles['name']=='super_admin'): ?> <?php echo e('dialog'); ?> <?php endif; ?>" >
                
                <div class="modal-content-m">
                   <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('trans.Edit Company')); ?></h5>
                       <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>-->
                    </div>
                     <div class="modal-body">
                       <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form action="<?php echo e(url('admin/company-update/'.$company->id)); ?>" method="post" enctype="multipart/form-data">
                           
                            <div class="row">
                        
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.Company_Title')); ?><span class="text-danger">*</span></label>
                                        <input class="form-control" name="title" type="text"  value="<?php echo e($company->title); ?>" required>
                                         <input class="form-control"  type="hidden"  id="company_logo" name="company_logo" />                                        
                                         <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                         <span class="text-danger" role="alert">
                                             <strong><?php echo e($message); ?></strong>
                                         </span>
                                     <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Distance')); ?> <span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" name="distance" value="<?php echo e($company->distance); ?>">
                                        </div>
                                    </div>

                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.min_time_attend')); ?> <span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" name="min_time" value="<?php echo e($company->min_time); ?>"/>
                                        </div>
                                </div> 

                               <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.logout_time')); ?> <span class="text-danger">*</span></label>
                                            <input type="time" class="form-control" name="logout_time"  value="<?php echo e($company->logout_time); ?>"/>
                                        </div>
                                </div> 
                             <!-- fake -->
                                <div class="col-sm-3">
                                    <div class="leave-left">
                                            <label class="d-block"><?php echo e(__('trans.fake')); ?></label> 
                                            <div class="leave-inline-form">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input is_fake" type="radio" name="is_fake" value="0" <?php if($company->is_fake==0): ?><?php echo e('checked'); ?><?php endif; ?> />
                                                    <label class="form-check-label" for="carry_no"><?php echo e(__('trans.No')); ?></label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-inpu is_fake1" type="radio" name="is_fake" value="1" <?php if($company->is_fake==1): ?><?php echo e('checked'); ?><?php endif; ?> />
                                                    <label class="form-check-label" for="carry_yes"><?php echo e(__('trans.Yes')); ?></label>
                                                </div>
             
                                            </div>
                                    </div>

                               </div> 
                               <!--target location check -->
                                <div class="col-sm-3">
                                    <div class="leave-left">
                                            <label class="d-block"><?php echo e(__('trans.in target')); ?></label>
                                            <div class="leave-inline-form">
                                                <div class="form-check form-check-inline">
                                              
                                                    <input class="form-check-input target_location" type="radio" name="target_location_check" value="0"  <?php if($company->target_location_check==0): ?><?php echo e('checked'); ?><?php endif; ?> >
                                                   
                                                    <label class="form-check-label" for="carry_no"><?php echo e(__('trans.No')); ?></label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input target_location1" type="radio" name="target_location_check" value="1"  <?php if($company->target_location_check==1): ?><?php echo e('checked'); ?><?php endif; ?> >
                                                    <label class="form-check-label" for="carry_yes"><?php echo e(__('trans.Yes')); ?></label>
                                                </div>
             
                                            </div>
                                    </div>
  
                               </div> 
                                 <!--target location check -->
                                <div class="col-sm-3">
                                    <div class="leave-left">
                                            <label class="d-block"><?php echo e(__('trans.mac check')); ?></label>
                                            <div class="leave-inline-form">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input mac_check" type="radio" name="mac_check" value="0 " <?php if($company->mac_check==0): ?><?php echo e('checked'); ?><?php endif; ?>  >
                                                    <label class="form-check-label" for="carry_no"><?php echo e(__('trans.No')); ?></label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-inpu mac_check1" type="radio" name="mac_check" value="1 " <?php if($company->mac_check==1): ?><?php echo e('checked'); ?><?php endif; ?> >
                                                    <label class="form-check-label" for="carry_yes"><?php echo e(__('trans.Yes')); ?></label>
                                                </div>
             
                                            </div>
                                    </div>
                                </div>  
                                

                                 <!--employee add client -->
                                <div class="col-sm-3">
                                    <div class="leave-left">
                                            <label class="d-block"><?php echo e(__('trans.employee add client')); ?></label>
                                            <div class="leave-inline-form">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input add_client" type="radio" name="add_client" value="0"  <?php if($company->add_client==0): ?><?php echo e('checked'); ?><?php endif; ?> />
                                                    <label class="form-check-label" for="carry_no"><?php echo e(__('trans.No')); ?></label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-inpu add_client1" type="radio" name="add_client" value="1"  <?php if($company->add_client==1): ?><?php echo e('checked'); ?><?php endif; ?>  />
                                                    <label class="form-check-label" for="carry_yes"><?php echo e(__('trans.Yes')); ?></label>
                                                </div>
             
                                            </div>
                                    </div>
                                </div>    
                                <div class="col-sm-12">
                                <!-- image --->
                                    <div class='preview company-logo'>
                                        <img  id="img" width="100" height="100" src="<?php echo e(url('public'.'/'.$company->logo)); ?>"/> <span class="delete_img" company_id="">x</span>
                                    </div>
                                    <div >
                                        <input type="file" id="file" name="file"  class="but_upload"/>     
                                      
                                       <!-- <input type="button" class="button" value="Upload"  />-->
                                    </div>
                                    </div>
                            
                               
                        <div class="col-sm-12">
                             <!-- end image -->
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn"><?php echo e(__('trans.Save')); ?></button>
                            </div>
                        </div>

                        </form>
                    </div>
               <!-- </div>
            </div>
        </div>-->
        <!-- /Edit Employee Modal -->
        </div>
        </div>
        
        </div>
         <?php endif; ?>
         <?php endif; ?>
        </div>
</div>
        <!-- /Page Content -->
</div>    
        <!-- Add Employee Modal -->
        <div id="add_company" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('trans.Companies')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="get" action="<?php echo e(route('store-company',$subdomain)); ?>">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.Title')); ?> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="title">
                                    </div>
                                </div>
                                 <div class="h3 card-title with-switch">
                                    <span class="subtitle"><?php echo e(__('trans.Nearest Branch')); ?></span>
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="onoffswitch" value="0" class="onoffswitch-checkbox" id="switch_paternity">
                                        <label class="onoffswitch-label" for="switch_paternity">
                                            <span class="onoffswitch-inner" ></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.Title')); ?> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="number" name="distance" disabled>
                                    </div>
                                </div>
                                
                            </div>
                           
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn"><?php echo e(__('trans.Submit')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
        <!-- /Add company Modal -->
       

        <!-- Delete Employee Modal -->
        <div class="modal custom-modal fade" id="delete_employee" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete company</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal"
                                        class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Employee Modal -->
       
    
 <!-- Approve company Modal -->
        <div class="modal custom-modal fade" id="approve_company" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3><?php echo e(__('trans.Company Approve')); ?></h3>
                            <p><?php echo e(__('trans.Are you sure want to change status for this company?')); ?></p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <span class="btn btn-primary continue-btn"><?php echo e(__('trans.Approve')); ?></span>
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
        <!-- /Approve company Modal -->
 </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
          
		$("#approve_company").on('show.bs.modal', function(event) {
               
			var button = $(event.relatedTarget) //Button that triggered the modal

			 status = button.attr('status');

		     comp_id=button.attr('company-id');
			
		});
		$("#approve_company .continue-btn").click(function(){
		
     
		$.ajax({
				url:"<?php echo e(route('status-company',$subdomain)); ?>",    
				data:{status:status,id:comp_id},
				type:"get",
				}).done(function(data) {
			     location.reload(true);

	             });

		});


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/company/company-list.blade.php ENDPATH**/ ?>