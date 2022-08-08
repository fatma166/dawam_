
<?php $__env->startSection('content'); ?>
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
                
                <!-- Page Header -->
                <div class="page-header">
                    
                    <div class="row">
                        <div class="col-sm-8 col-4">
                            <h3 class="page-title">Subscriptions</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo e(__('Subscriptions')); ?></li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            
                            <a href="" class="btn add-btn" data-toggle="modal" data-target="#add_plan"><i class="fa fa-plus"></i> <?php echo e(__('trans.Add Plan')); ?></a>
                                
                            <div class="view-icons">
                                <a href="<?php echo e(route('subscribe-index',$subdomain)); ?>" class="grid-view btn btn-link" title="<?php echo e(__('trans.grid')); ?>" ><i class="fa fa-th"></i></a>
                                <a href="companies-list" class="list-view btn btn-link active" title="<?php echo e(__('trans.list')); ?>"><i class="fa fa-bars"></i></a>
                            </div>
                        </div>
                    </div>
      
            
                </div>
                <!-- /Page Header -->
            
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                    
                        <!-- Plan Tab -->
                        <div class="row justify-content-center mb-4">
                            <div class="col-auto">
                                <nav class="nav btn-group">
                                    <a href="#monthly" class="btn btn-outline-secondary active show" data-toggle="tab"><?php echo e(__('Monthly Plan')); ?></a>
                                    <a href="#annual" class="btn btn-outline-secondary" data-toggle="tab"><?php echo e(__('Annual Plan')); ?></a>
                                </nav>
                            </div>
                        </div>
                        <!-- /Plan Tab -->

                        <!-- Plan Tab Content -->
                        <div class="tab-content">
                        
                            <!-- Monthly Tab -->
                            <div class="tab-pane fade active show" id="monthly">
                                <div class="row mb-30 equal-height-cards">
                                <?php if(isset($plans_month)): ?>
                                    <?php $__currentLoopData = $plans_month; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   
                                    <div class="col-md-4" >
                                        <div class="card pricing-box">
                                            <div class="card-body d-flex flex-column">
                                                <div class="mb-4">
                                                    <h3><?php echo e($plan->name); ?></h3>
                                                    <span class="display-4"><?php echo e($plan->price_user); ?></span>
                                                    <h3><?php echo e(__('trans.userpermonth')); ?></h3>
                                                </div>
                                                <?php  $descriptions=explode(',',$plan->descriptions); ?>
                                              
                                                    <ul>
                                                        <li><i class="fa fa-check"></i> <b><?php echo e(__('trans.users')); ?><?php echo e($plan->number_users); ?></b></li>
                                                        <?php if(isset($descriptions)): ?>
                                                        <?php $__currentLoopData = $descriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $descrip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li><i class="fa fa-check"></i> <b><?php echo e($descrip); ?></b></li>
                                                    
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                          
                                                <a  href=""  class="btn btn-lg btn-outline-secondary  mt-auto"  data-href="<?php echo e(url('admin/plan-edit/'.$plan->id)); ?>" plan-id="<?php echo e($plan->id); ?>"  type="month" data-toggle="modal" data-target="#edit_plan"> <?php echo e(__('trans.Edit')); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>;
                                                       
                                <!-- Plan Details -->
                                <!--<div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-table mb-0">
                                            <div class="card-header">
                                                <h4 class="card-title mb-0">Plan month</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-center mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Plan</th>
                                                                <th>Users</th>
                                                                <th>Plan Duration</th>
                                                                <th>Start Date</th>
                                                                <th>End Date</th>
                                                                <th>Amount</th>
                                                                <th>Update Plan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Free Trial</td>
                                                                <td>30 Users</td>
                                                                <td>1 Month</td>
                                                                <td>9 Nov 2019</td>
                                                                <td>8 Dec 2019</td>
                                                                <td>$200.00</td>
                                                                <td><a class="btn btn-primary btn-sm" href="javascript:void(0);">Change Plan</a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                                <!-- /Plan Details -->
                                </div>
                            </div>

                        
                            <!-- /Monthly Tab -->
                        
                            <!-- Yearly Tab -->
                            <div class="tab-pane fade" id="annual">
                                <div class="row mb-30 equal-height-cards">
                                <?php if(isset($plans_year)): ?>
                                    <?php $__currentLoopData = $plans_year; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   
                                    <div class="col-md-4" >
                                        <div class="card pricing-box">
                                            <div class="card-body d-flex flex-column">
                                                <div class="mb-4">
                                                    <h3><?php echo e($plan->name); ?></h3>
                                                    <span class="display-4"><?php echo e($plan->price_user); ?></span>
                                                     <h3><?php echo e(__('trans.userperyear')); ?></h3>
                                                </div>
                                                <?php  $descriptions=explode(',',$plan->descriptions); ?>
                                              
                                                    <ul>
                                                        <li><i class="fa fa-check"></i> <b><?php echo e(__('trans.users')); ?><?php echo e($plan->number_users); ?></b></li>
                                                        <?php if(isset($descriptions)): ?>
                                                        <?php $__currentLoopData = $descriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $descrip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li><i class="fa fa-check"></i> <b><?php echo e($descrip); ?></b></li>
                                                    
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </ul>
                                               
                                               <a  class="btn btn-lg btn-outline-secondary  mt-auto" data-href="<?php echo e(url('admin/plan-edit/'.$plan->id)); ?>" plan-id="<?php echo e($plan->id); ?>" type="year" data-toggle="modal" data-target="#edit_plan"> <?php echo e(__('trans.Edit')); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>;
                                   
                                
                                
                                                            
                                <!-- Plan Details -->
                              <!-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-table mb-0">
                                            <div class="card-header">
                                                <h4 class="card-title mb-0">Plan year</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-center mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Plan</th>
                                                                <th>Users</th>
                                                                <th>Plan Duration</th>
                                                                <th>Start Date</th>
                                                                <th>End Date</th>
                                                                <th>Amount</th>
                                                                <th>Update Plan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Free Trial</td>
                                                                <td>30 Users</td>
                                                                <td>1 Month</td>
                                                                <td>9 Nov 2019</td>
                                                                <td>8 Dec 2019</td>
                                                                <td>$200.00</td>
                                                                <td><a class="btn btn-primary btn-sm" href="javascript:void(0);">Change Plan</a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                                <!-- /Plan Details -->
                            </div>
                            <!-- Yearly Tab -->
                            
                        </div>
                        <!-- /Plan Tab Content -->

                    </div>
                </div>
                
            </div>
            <!-- /Page Content -->
            <!-- Add plan Modal -->
            <div id="add_plan" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Add Plan')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form method="post" action="<?php echo e(route('subscribe-store-plan',$subdomain)); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                      <div class="col-sm-6">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="col-form-label"><?php echo e(__('trans.currency')); ?> <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="currency">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="col-form-label"><?php echo e(__('trans.Price User')); ?></label>
                                                    <input class="form-control" type="number" name="price_user">
                                                </div>
                                            </div>
                                           <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="col-form-label"><?php echo e(__('trans.Type')); ?></label>
        
                                                        <select class="select" name="type">
                                                        
                                                            <option value="month"><?php echo e(__('trans.month')); ?></option>
                                                            <option value="year"><?php echo e(__('trans.year')); ?></option>
                                                        
                                                        </select>
                                                </div>
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
          <!--  end Add plan Modal-->  



            <!-- edit plan Modal -->
            <div id="edit_plan" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.edit Plan')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form method="post" >
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                      <div class="col-sm-6">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="col-form-label"><?php echo e(__('trans.currency')); ?> <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="currency">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="col-form-label"><?php echo e(__('trans.Price User')); ?></label>
                                                    <input class="form-control" type="number" name="price_user">
                                                </div>
                                            </div>
                                           <div class="col-sm-12" style="display:none;">
                                                <div class="form-group">
                                                    <label class="col-form-label"><?php echo e(__('trans.Type')); ?></label>
        
                                                    <select class="select" name="type">
                                                    
                                                        <option value="month"><?php echo e(__('trans.month')); ?></option>
                                                        <option value="year"><?php echo e(__('trans.year')); ?></option>
                                                    
                                                    </select>
                                                </div>
                                            </div>
                                           
        
                                     </div>
    
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="edit"><?php echo e(__('trans.save')); ?></button>
                                </div>
                            </form>
                       </div>
                    </div>
                </div>
            </div>
          <!--  end edit plan Modal-->             
        </div>
        <!-- /Page Wrapper -->



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/company/subscribe/subscriptions-company.blade.php ENDPATH**/ ?>