
<?php $__env->startSection('content'); ?>
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">

                    <!-- Breadcrumb -->
                    <div class="col">
                        <h3 class="page-title"><?php echo e(__('trans.banks')); ?></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><?php echo e(__('trans.dashboard')); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e(__('trans.banks')); ?></li>
                        </ul>
                    </div>
                     <!-- Breadcrumb -->
                    
                     <!-- Add Button -->
                  <div class="col-auto float-right ml-auto">
                       
                        <a class="btn add-btn" data-toggle="modal"
                            data-target="#add_bank"><i class="fa fa-plus"></i><?php echo e(__('trans.add')); ?></a>
                           
                        <div class="view-icons">
                            <a href="" class="grid-view btn btn-link"><i
                                    class="fa fa-th"></i></a>
                            <a href="branch-list" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>
                        </div>
                  </div>
                    <!-- Add Button -->
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
    
                <div class="col-sm-12">
    
                    <?php if(Session::has('success')): ?>
    
                        <p class="alert alert-danger"><?php echo e(Session::get('success')); ?></p>
    
                    <?php endif; ?>
    
                </div>
    
            </div>
               <!-- table -->
            <div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped mb-0"  id="table_search">
											<thead>
												<tr>
													<th><?php echo e(__('trans.title')); ?></th>
													<th><?php echo e(__('trans.account_number')); ?></th>
                                                    <th><?php echo e(__('trans.balance')); ?></th>
													<th><?php echo e(__('trans.edit')); ?>/<?php echo e(__('trans.delete')); ?></th>
												</tr>
											</thead>
											<tbody>
                                                <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    												<tr>
    													<td><?php echo e($bank->name); ?></td>
    													<td><?php echo e($bank->account_number); ?></td>
    													<td><?php echo e($bank->balance); ?></td>
                                                         <td class="text-right">
                                                            <div class="dropdown dropdown-action">
                                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" href="#" data-href="<?php echo e(url('admin/bank-edit/'.$bank->id)); ?>" bank-id="<?php echo e($bank->id); ?>" data-toggle="modal" data-target="#edit_bank"><i class="fa fa-pencil m-r-5"></i> <?php echo e(__('trans.Edit')); ?></a>
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_bank" delete-id="<?php echo e($bank->id); ?>"><i class="fa fa-trash-o m-r-5"></i> <?php echo e(__('trans.Delete')); ?></a>
                                                                </div>
                                                            </div>
                                                        </td>
    												</tr>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
            <!-- table -->
            </div>
        </div>
        <!-- /Page Content -->
   
        <!-- Add representative Modal -->
        <div id="add_bank" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('trans.add_Bank')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form method="post" action="<?php echo e(route('store-bank',$subdomain)); ?>">
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.name')); ?><span class="text-danger">*</span></label>
                                        <input class="form-control " name="name" type="text">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.account_number')); ?><span class="text-danger">*</span></label>
                                        <input class="form-control" name="account_number" type="number">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.balance')); ?><span class="text-danger">*</span></label>
                                        <input class="form-control" name="balance" type="number">
                                    </div>
                                </div>

                           
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn" type="add"><?php echo e(__('trans.save')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

     <!-- Edit representative Modal -->
        <div id="edit_bank" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('trans.Edit')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form method="post">
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.name')); ?><span class="text-danger">*</span></label>
                                        <input class="form-control " name="name" type="text">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.account_number')); ?><span class="text-danger">*</span></label>
                                        <input class="form-control" name="account_number" type="number"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.balance')); ?><span class="text-danger">*</span></label>
                                        <input class="form-control" name="balance" type="number"/>
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
        <!-- /Edit representative Modal -->  
        
       <!-- Delete representative Modal -->
        <div class="modal custom-modal fade" id="delete_bank" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3><?php echo e(__('trans.Delete bank')); ?></h3>
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
        <!-- /Delete representative Modal --> 
        

</div>
<?php $__env->stopSection(); ?>
     
<?php $__env->startSection('script'); ?>


<script>
function clearRep(id){
            var url=baseUrl+"repersenrive-blance-set/"+id; 
            $.ajax({
                url:url,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               // data: {title:title, nearest_branch:nearest_branch , distance:distance, is_fake:is_fake,target_location_check:target_location_check,company_logo:company_logo},
                success: function(data) {
                    
                    if(data.hasOwnProperty('success')){
				
                       location.reload(true);
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });
}


</script>
<?php $__env->stopSection(); ?>
 



<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/banks/index.blade.php ENDPATH**/ ?>