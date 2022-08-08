
<?php $__env->startSection('content'); ?>
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">

                    <!-- Breadcrumb -->
                    <div class="col">
                        <h3 class="page-title"><?php echo e(__('trans.methods')); ?></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><?php echo e(__('trans.dashboard')); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e(__('trans.methods')); ?></li>
                        </ul>
                    </div>
                     <!-- Breadcrumb -->
                    
                     <!-- Add Button -->
                  <div class="col-auto float-right ml-auto">
                       
                        <a class="btn add-btn" data-toggle="modal"
                            data-target="#add_method"><i class="fa fa-plus"></i><?php echo e(__('trans.add')); ?></a>
                           
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
            	                                    <th><?php echo e(__('trans.status')); ?></th>
													<th><?php echo e(__('trans.edit')); ?>/<?php echo e(__('trans.delete')); ?></th>
												</tr>
											</thead>
											<tbody>
                                                <?php $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    												<tr>
    													<td><?php echo e($method->title); ?></td>
                                                        <td class="text-center">
                                                            <div class="dropdown action-label">
                                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-dot-circle-o <?php if($method->status==0): ?><?php echo e('text-danger'); ?><?php else: ?> <?php echo e('text-success'); ?> <?php endif; ?>"><?php if($method->status==0): ?><?php echo e(__('trans.NotActive')); ?><?php else: ?><?php echo e(__('trans.Active')); ?><?php endif; ?></i> 
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_pay_method" status="1" pay_method_id="<?php echo e($method->id); ?>"><i class="fa fa-dot-circle-o text-success"></i> <?php echo e(__('trans.Active')); ?></a>
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_pay_method" status="0" pay_method_id="<?php echo e($method->id); ?>"><i class="fa fa-dot-circle-o text-danger"></i><?php echo e(__('trans.NotActive')); ?></a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                         <td class="text-right">
                                                            <div class="dropdown dropdown-action">
                                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" href="#" data-href="<?php echo e(url('admin/method-edit/'.$method->id)); ?>" method-id="<?php echo e($method->id); ?>" data-toggle="modal" data-target="#edit_method"><i class="fa fa-pencil m-r-5"></i> <?php echo e(__('trans.Edit')); ?></a>
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_method" delete-id="<?php echo e($method->id); ?>"><i class="fa fa-trash-o m-r-5"></i> <?php echo e(__('trans.Delete')); ?></a>
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
        <div id="add_method" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('trans.add_method')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form method="post" action="<?php echo e(route('store-method',$subdomain)); ?>">
                            <div class="row">

                               <div class="col-sm-12">
                                    <div class="form-group form-focus select-focus">
                                         <select class="select floating method" name="title"> 
                                       
                                            <option value="visa">visa</option>
                                            <option value="bank_convert">bank_convert</option>
                                            <option value="postal_convert">postal_convert</option>
                                            <option value="customer">customer</option>
                                        
                                         </select>
                                               <input type="text" class="method" name="title"/>
                                            <label class="focus-label"><?php echo e(__('trans.Payment Method')); ?></label>
                                    </div>  
                                </div>
                            
                               <div class="col-sm-12">
                                    <div class="form-group">
                                            <span class="pay-now"><?php echo e(__('trans.status')); ?></span>
                                            <label class="switch">
                                                <input type="checkbox" class="pay-method-status" value="0"/>
                                                <span class="slider round"></span>
                                            </label>
    								</div>
                              </div>

                            <div class="col-sm-12">
                                    <div class="form-group">
                                          <label><?php echo e(__('trans.number vonvert')); ?>  </label>
                                        
                                            <input type="number" class="number_convert" name="number_convert"/>
                                           
                                      
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
        <div id="edit_method" class="modal custom-modal fade" role="dialog">
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

           
                               <div class="col-sm-12">
                                    <div class="form-group form-focus select-focus">
                                         <select class="select floating method" name="title"> 
                                       
                                            <option value="visa">visa</option>
                                            <option value="bank_convert">bank_convert</option>
                                            <option value="postal_convert">postal_convert</option>
                                            <option value="customer">customer</option>
                                        
                                         </select>
                                               <input type="text" class="method" name="title"/>
                                            <label class="focus-label"><?php echo e(__('trans.Payment Method')); ?></label>
                                    </div>  
                                </div>
                              <div class="col-sm-12">
                                    <div class="form-group">
                                            <span class="pay-method-status"><?php echo e(__('trans.status')); ?></span>
                                            <label class="switch">
                                                <input type="checkbox" class="check-pay" value="0"/>
                                                <span class="slider round"></span>
                                            </label>
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
        <div class="modal custom-modal fade" id="delete_method" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3><?php echo e(__('trans.Delete method')); ?></h3>
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
        
            <!-- Approve pay-method Modal -->
            <div class="modal custom-modal fade" id="approve_pay_method" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3><?php echo e(__('trans.pay-method Approve')); ?></h3>
                                <p><?php echo e(__('trans.Are you sure want to approve for this pay-method?')); ?></p>
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
            <!-- /Approve pay-method Modal -->
</div>
<?php $__env->stopSection(); ?>
     
<?php $__env->startSection('script'); ?>


<script>

          /* method */
          var toggle= false;
          $('.switch .slider').click(function() {
        
                $(".pay-method-status").attr("checked",!toggle);
                alert(toggle);
                toggle = !toggle;
                if(toggle==true)$(".pay-method-status").val(1);
                
        
           });
            $("#add_method button,#edit_method button").click(function(e){
                
                e.preventDefault();
                var data;
    			var url="";     
    		    if($(this).attr('type')==="add"){
                    url=$('#add_method form').attr('action');
                    var title= $("#add_method form input[name='title']").val();	
        			var status= $("#add_method .pay-method-status").val();
                    var number_convert= $("#add_method .number_convert").val();
      			  
    			    data= {title:title,status:status,number_convert:number_convert};
                 
                 
                 }
    			if($(this).attr('type')==="edit"){
    	
                           url=$('#edit_method form').attr('action');
                            var title= $("#edit_method form input[name='title']").val();	
                			var status= $("#edit_method .pay-method-status").val();
                            var number_convert= $("#add_method .number_convert").val(); 
            			    data= {title:title,status:status,number_convert:number_convert};
                         
                 
                 }
    		
                $.ajax({
                    url:url,
                    type:'POST',
    			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:data,
                    success: function(data) {
                       
                       if(data.hasOwnProperty('success')){
    				
                      location.reload(true);
                        }else{
                         
                            printErrorMsg(data.error);
                        }
                    }
                
            });
        });
      
      
      
      
            //onshow 
   			$("#edit_method").on('show.bs.modal', function(event) {
                        
				var button = $(event.relatedTarget) //Button that triggered the modal
			
				var getHref = button.data('href'); //get button href
				
				var id = button.attr('method-id'); 

				update_url=baseUrl+"method-update/"+id;
				$('#edit_method form').attr('action',update_url);
				$.ajax({
					url:getHref,
					data:{id:id},
					}).done(function(data) {
					$.each(data, function( index,method){
					
				        $("form input[name='title']").val(method.title);
						$("#edit_method .pay-method-status").val(method.status);

					});
	
				});
			});
            
            
            
           /* method DELETE */
			  
			$("#delete_method").on('show.bs.modal', function(event) {
				var button = $(event.relatedTarget) //Button that triggered the modal
				var id = button.attr('delete-id');
				del_id=id;
				delete_url=baseUrl+"method-delete";
                
			
			});
			$("#delete_method .continue-btn").click(function(){
                  
    			$.ajax({
    					url:delete_url,    
    					data:{id:del_id},
    					 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    					type:"post"
    					}).done(function(data) {
    				     location.reload(true);
    	
    				});

			});
            /* end method*/
			   
			$("#approve_pay_method").on('show.bs.modal', function(event) {
                   
				var button = $(event.relatedTarget) //Button that triggered the modal
	
				 status = button.attr('status');

			     pay_method_id=button.attr('pay_method_id');
				
			});
			$("#approve_pay_method .continue-btn").click(function(){
			
             
    			$.ajax({
    					url:"<?php echo e(route('status-method',$subdomain)); ?>",    
    					data:{status:status,id:pay_method_id},
    					type:"get",
    					}).done(function(data) {
    				     location.reload(true);
    	
    				});

			});
</script>
<?php $__env->stopSection(); ?>
 



<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/methods/index.blade.php ENDPATH**/ ?>