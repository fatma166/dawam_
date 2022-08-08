

<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.branch')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>




				
///

         <!-- /Table Grid -->
            <div class="page-wrapper">
                <!-- Page Content -->
                <div class="content container-fluid">
                   <!-- Page Header -->
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title"><?php echo e(__('trans.Branches')); ?></h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                    <li class="breadcrumb-item active"><?php echo e(__('trans.Branch')); ?></li>
                                </ul>
                            </div>
                            
                            <div class="col-auto float-right ml-auto">
                               
                                <a class="btn add-btn" data-toggle="modal"
                                    data-target="#add_branch" class="add_branch"><i class="fa fa-plus"></i> <?php echo e(__('trans.Add Branch')); ?></a>
                                   
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
        
         <!-- /Table Grid -->
			   
					<div class="row staff-grid-row" style="display: none;">
                       <?php if(isset($branchs)): ?>
                            <?php $__currentLoopData = $branchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					  <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                      
							<div class="profile-widget">
								<div class="profile-img">
									<a data-href="<?php echo e(url('admin/branch-edit/'.$branch->id)); ?>" 
                                        branch-id="<?php echo e($branch->id); ?>" data-toggle="modal" data-target="#edit_branch" class="avatar"><img src="<?php echo e(asset('img/profiles/avatar-02.jpg')); ?>" alt=""></a>
								</div>
								<div class="dropdown profile-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                 		<div class="dropdown-menu dropdown-menu-right">
									     <a class="dropdown-item" href="<?php echo e(url('admin/branch-edit/'.$branch->id)); ?>"
                                                       data-href="<?php echo e(url('admin/branch-edit/'.$branch->id)); ?>" branch-id="<?php echo e($branch->id); ?>" data-toggle="modal" data-target="#edit_branch"><i
                                                            class="fa fa-pencil m-r-5"></i> <?php echo e(__('trans.Edit')); ?></a>
                                                    <a class="dropdown-item" delete-id="<?php echo e($branch->id); ?>" 
                                                        data-toggle="modal" data-target="#delete_branch"><i
                                                            class="fa fa-trash-o m-r-5"></i>
                                                        <?php echo e(__('trans.Delete')); ?> </a>
									</div>
                                  
								</div>
								 <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="#"><?php if(isset($branch->title)): ?> <?php echo e($branch->title); ?> <?php endif; ?></a></h4>
                                 <div class="small text-muted"><?php if(isset($branch->adress)): ?> <?php echo e($branch-> adress); ?> <?php endif; ?></div>
							       
                                </div>
                                
						</div>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endif; ?>
					</div>
           
 <!-- /Table Grid -->
           
              
             <!-- /Table List -->
                <div class="col-md-12">
                    <div class="table-responsive">
                                       
                        <table class="table table-striped custom-table" id="table_search">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('trans.Title')); ?></th>
                                    <?php if(Auth::user()->role_id==2): ?>
                                         <th><?php echo e(__('trans.Company Title')); ?></th>
                                    <?php endif; ?>
                                    <th><?php echo e(__('trans.Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                          
                                <?php if(isset($branchs)): ?>
                                   <?php $__currentLoopData = $branchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                               <!-- <a href="profile" class="avatar"><img alt=""src="img/profiles/avatar-02.jpg"></a>-->
                                               <!-- <a href="profile">-->
                                               
                                             <!-- abdelkawy branchs link when click on branch  view Edit Mode -->   
                                           <a class="dropdown-item" href="<?php echo e(url('admin/branch-edit/'.$branch->id)); ?>"
                                                       data-href="<?php echo e(url('admin/branch-edit/'.$branch->id)); ?>" branch-id="<?php echo e($branch->id); ?>" data-toggle="modal" data-target="#edit_branch"
                                                       ><span><?php if(isset($branch->title)): ?> <?php echo e($branch->title); ?> <?php endif; ?></span></a>
                                            
                                            </h2>
                                        </td>
                                        <?php if(Auth::user()->role_id==2): ?>
                                        <td>
                                            <h2 class="table-avatar">
                                               <!-- <a href="profile" class="avatar"><img alt=""src="img/profiles/avatar-02.jpg"></a>-->
                                               <!-- <a href="profile">--><span><?php if(isset($branch->company_title)): ?> <?php echo e($branch-> company_title); ?> <?php endif; ?></span><!--</a>-->
                                            </h2>
                                        </td>
                                        <?php endif; ?>

                                        <td class="text-right">
                                           
                                            <a type="button" class="btn btn-outline-success" href="<?php echo e(url('admin/branch-edit/'.$branch->id)); ?>"
                                                data-href="<?php echo e(url('admin/branch-edit/'.$branch->id)); ?>" branch-id="<?php echo e($branch->id); ?>" data-toggle="modal" data-target="#edit_branch">
                                                <i class="fa fa-pencil m-r-5"></i><?php echo e(__('trans.Edit')); ?>

                                            </a>
                                            <a type="button" class="btn btn-outline-danger" delete-id="<?php echo e($branch->id); ?>"  data-toggle="modal" data-target="#delete_branch">
                                                <i class="fa fa-trash-o m-r-5"></i><?php echo e(__('trans.Delete')); ?>

                                            </a>
                                        </td>
                                        
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </tbody>
                        </table>
                      
                         
                         
                         
                    </div>
                </div>
                   <!-- /End Table List -->
            </div>
        </div>
        <!-- /Page Content -->

        <!-- Add Branch Modal -->
        <div id="add_branch" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('trans.Add Branch')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                       
                        <form method="post" action="<?php echo e(route('store-branch',$subdomain)); ?>">
                         <?php echo csrf_field(); ?>
                            <div class="row">

                               <div class="col-sm-6 col-md-6"> 
                                        <div class="form-group form-focus">
                                         <label class="col-form-label"><?php echo e(__('trans.Zone')); ?> <span class="text-danger">*</span></label> 
                                          <select class="zone_id  form-control" name="zone_id"></select>                            
                                                                      
                                           
                                        </div>
            
            
                               </div>
                             <?php if(Auth::user()->role_id==2): ?>
                               <div class="col-sm-6">
     
                                    <div class="form-group form-focus select-focus">
                                        <select class="select floating" name="company_id"> 
                                            <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($company['id']); ?>"><?php echo e($company['title']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <label class="focus-label"><?php echo e(__('trans.Company')); ?></label>
                                    </div>
                                
                                </div>
                             
                                <?php endif; ?>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.Title')); ?> <span class="text-danger" >*</span></label>
                                        <input class="form-control" type="text" name="title">
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
                                        <label class="col-form-label"><?php echo e(__('trans.Adress')); ?> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="adress">
                                        <?php $__errorArgs = ['adress'];
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
                                <div class="col-sm-6" style="display: none;">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.lat')); ?> <span class="text-danger" >*</span></label>
                                        <input class="form-control add_lat" type="text" name="add_lat" readonly>
                                         <?php $__errorArgs = ['add_lat'];
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
                               <div class="col-sm-6" style="display: none;">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.lang')); ?> <span class="text-danger" >*</span></label>
                                        <input class="form-control add_lang" type="text" name="add_lang" readonly>
                                        <?php $__errorArgs = ['add_lang'];
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
                                <div class="col-sm-12">
                                    <div id="map" style="height:400px"></div>

                                </div>

                            </div>
                           
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn" type="add"><?php echo e(__('trans.Submit')); ?></button> <!--onclick="masterAdd('#add_branch','<?php echo e(route('store-branch',$subdomain)); ?>')"-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
               
        <!-- Edit Branch Modal -->
        <div id="edit_branch" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('trans.Edit Branch')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form action="" method="POST">
                           <?php echo csrf_field(); ?>

                            <div class="row">
                               <div class="col-sm-6">
                                 <div class="form-group">
                                    <!--<div class="form-group form-focus select-focus zone_id">-->
                                     <label class="focus-label"><?php echo e(__('trans.Zone')); ?></label>
                                    <select class="zone_id form-control" name="zone_id"></select>
                                        <!--<select class="select floating zone_id" name="zone_id"> 
                                            <?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($zone->zone_id); ?>"><?php echo e($zone->zone_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>-->
                                      
                                       
                                    <!--</div>-->
                                    </div>
                                
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.Title')); ?><span class="text-danger">*</span></label>
                                        <input class="form-control  branch_title" name="title" type="text">
                                    </div>
                                </div>
                              
                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Adress')); ?> <span class="text-danger">*</span></label>
                                            <input class="form-control branch_adress" type="text" name="adress">
                                        </div>
                                </div>
                                <div class="col-sm-6"  style="display: none;">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.lat')); ?> <span class="text-danger" >*</span></label>
                                        <input class="form-control edit_lat" type="text" name="edit_lat" readonly>
                                    </div>
                                </div>
                               <div class="col-sm-6"  style="display: none;">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.lang')); ?> <span class="text-danger" >*</span></label>
                                        <input class="form-control edit_lang" type="text" name="edit_lang" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div id="map_edit" style="height:400px"></div>

                                </div>
                            </div> 
                            <div class="submit-section">
                          
                                <button class="btn btn-primary submit-btn" type="edit"><?php echo e(__('trans.Save')); ?></button>
                           
                            </div>
                            <br/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Employee Modal -->
         
        <!-- Delete Employee Modal -->
        <div class="modal custom-modal fade" id="delete_branch" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3><?php echo e(__('trans.Delete Branch')); ?></h3>
                            <p><?php echo e(__('trans.Are you sure want to delete?')); ?></p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn" continue_del=""><?php echo e(__('trans.Delete')); ?></a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal"
                                        class="btn btn-primary cancel-btn"><?php echo e(__('trans.Cancel')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Employee Modal -->
        </div>
        <!-- /Add Branch Modal -->
     

 


<?php echo $__env->make('./layout.partials.map_script2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
 


<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/company/branch/branch-list.blade.php ENDPATH**/ ?>