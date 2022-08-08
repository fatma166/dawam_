

<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.evaluation')); ?>

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
                                <h3 class="page-title"><?php echo e(__('trans.elements-evaluation')); ?></h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                    <li class="breadcrumb-item active"><?php echo e(__('trans.evaluation')); ?></li>
                                </ul>
                            </div>
                            
                            <div class="col-auto float-right ml-auto">
                               
                                
                                <button class="btn add-btn" id="evlauation_val" data-toggle="modal" data-target="#add_evaluation" 
                                 class="add_evaluation"><i class="fa fa-plus"></i> <?php echo e(__('trans.Add evaluationelement')); ?></button>  
                                
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
        
      
           
              
          
        <!-- /Page Content -->

         <div class="row">
    
                <div class="col-sm-12">
    
                    <?php if(Session::has('success')): ?>
    
                        <p class="alert alert-danger"><?php echo e(Session::get('success')); ?></p>
    
                    <?php endif; ?>
    
                </div>
    
            </div>
            
   

        <!-- /Table List -->
        
              <!-- table -->
           
						<div class="col-lg-12 col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table" id="table_search">
											<thead>
												<tr>
							    	                 <th><?php echo e(__('trans.evaluation_element')); ?></th>
                                                      <th><?php echo e(__('trans.Action')); ?></th>
												</tr>
											</thead>
											<tbody>
                                                <?php $__currentLoopData = $evaluation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evaluation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    												<tr>
    													
                                                        <td>
                                                            <a class="dropdown-item" href="<?php echo e(url('admin/edit-evaluation/'.$evaluation->id)); ?>"
                                                               data-href="<?php echo e(url('admin/edit-evaluation/'.$evaluation->id)); ?>" evaluation-id="<?php echo e($evaluation->id); ?>" data-toggle="modal" data-target="#edit_evaluation"
                                                               ><span><?php if(isset($evaluation->title)): ?> <?php echo e($evaluation->title); ?> <?php endif; ?></span>
                                                            </a>
                                                       </td>
    												
    												    <!--<td class="text-right">-->
                    <!--                                        <a class="btn btn-outline-success" href="#" data-href="<?php echo e(url('admin/edit-evaluation/'.$evaluation->id)); ?>" evaluation-id="<?php echo e($evaluation->id); ?>" data-toggle="modal" data-target="#edit_evaluation"><i class="fa fa-pencil m-r-5"></i> <?php echo e(__('trans.Edit')); ?></a>-->
                                                            <!-- <a class="btn btn-outline-danger" href="#" data-toggle="modal" data-target="#delete_evaluation" delete-id="<?php echo e($evaluation->id); ?>"><i class="fa fa-trash-o m-r-5"></i> <?php echo e(__('trans.Delete')); ?></a>-->
                    <!--                                    </td>-->
                                                        <td class="text-right">
                                                           <?php if($evaluation->status==0): ?>
                                                            <a class="btn btn-outline-success" href="#" data-href="<?php echo e(url('admin/edit-evaluation/'.$evaluation->id)); ?>" evaluation-id="<?php echo e($evaluation->id); ?>" data-toggle="modal" data-target="#edit_evaluation"><i class="fa fa-pencil m-r-5"></i> <?php echo e(__('trans.Edit')); ?></a>
                                                            <!-- <a class="btn btn-outline-danger" href="#" data-toggle="modal" data-target="#delete_evaluation" delete-id="<?php echo e($evaluation->id); ?>"><i class="fa fa-trash-o m-r-5"></i> <?php echo e(__('trans.Delete')); ?></a>-->
                                                            <?php endif; ?>
                                                        </td>
                                                        
    												</tr>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
                            <h5 class="note_title" hidden><?php echo e(__('trans.Evaluation_Notification')); ?></h5>
                            
                   
					</div>
                 
           
 <!-- /Table Grid -->
           
						</div>
     	           
			   
				
           
 <!-- /Table Grid -->
            <!-- table -->
            </div>
               
          <!-- /End Table List -->



  <!-- Add Branch Modal -->
        <div id="add_evaluation" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('trans.Add evaluationelement')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form method="post" action="<?php echo e(route('store-Evaluation',$subdomain)); ?>">
                         <?php echo csrf_field(); ?>
                            <div class="row">
                              
                            
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.evaluation_element')); ?> <span class="text-danger" >*</span></label>
                                        <input class="form-control" type="text" name="title" />
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
                              

                            </div>
                           
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn evaluationelement-btn" type="add"><?php echo e(__('trans.Submit')); ?></button> <!--onclick="masterAdd('#add_branch','<?php echo e(route('store-branch',$subdomain)); ?>')"-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<!-- Add Branch Modal -->        

 <!-- Edit representative Modal -->
        <div id="edit_evaluation" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('trans.Edit_evaluationelement')); ?></h5>
                       
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

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.evaluation_element')); ?><span class="text-danger">*</span></label>
                                        <input class="form-control" name="title" type="text" />
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

                            </div>
                            
                            
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn evaluation-update" type="edit"><?php echo e(__('trans.Save')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit representative Modal -->  




            </div>
        </div>





      
     
         
      
        </div>
        <!-- /Add Branch Modal -->
      <!-- Delete representative Modal -->
        <div class="modal custom-modal fade" id="delete_evaluation" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3><?php echo e(__('trans.Delete evaluation')); ?></h3>
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

 

				<!-- /Edit Client Modal -->
   <!-- /Add job - -Evaulation -->
<?php $__env->stopSection(); ?>
 <?php $__env->startSection('script'); ?>
<script>
 /*evaluation  elements */
             //onshow add mdoula
        //for show and hide  add modula
        
            
          
            
            $(".evaluationelement-btn,.evaluation-update").click(function(e){
                
                e.preventDefault();
                var data;
    			var url="";     
    		    if($(this).attr('type')==="add"){
                    url=$('#add_evaluation form').attr('action');
                    var title= $("#add_evaluation form input[name='title']").val();	
                    data= {title:title};
        	          
                 }
    			if($(this).attr('type')==="edit"){
                           url=$('#edit_evaluation form').attr('action');
                            var title= $("#edit_evaluation form input[name='title']").val();	
                                        
    			            data= {title:title};
    		}
                $.ajax({
                    url:url,
                    method:'POST',
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
   			$("#edit_evaluation").on('show.bs.modal', function(event) 
               {
                        
				var button = $(event.relatedTarget) //Button that triggered the modal
			
				var getHref = button.data('href'); //get button href
				
				var id = button.attr('evaluation-id'); 

				update_url=baseUrl+"update-evaluation/"+id;
				$('#edit_evaluation form').attr('action',update_url);
				$.ajax({
					url:getHref,
                    // data:{id:id},
				
					}).done(function(data) {
				    // console.log(data);
                      
                	/*$.each(data,function(index,method){
             	    });*/
				    //    console.log(data);
				        $("#edit_evaluation form input[name='title']").val(data.title);
				     

					
                    
	
				});
			});
            
          
             /* method DELETE */
			  
			$("#delete_evaluation").on('show.bs.modal', function(event) {
				var button = $(event.relatedTarget) //Button that triggered the modal
				var id = button.attr('delete-id');
				del_id=id;
				delete_url=baseUrl+"delete-evaluation";
                $("#delete_evaluation .continue-btn").click(function(){
                    	$.ajax({
    					url:delete_url,    
    					data:{id:del_id},
    					 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    					type:"post"
    					}).done(function(data) {
    					  // console.log(data);
                          // return;
    				     location.reload(true);
    	
    				});
                });
			
			});
            
 
      
       
           
           
            
          
          
          
            /* Evaluation job  
			
              
            $('#job_evaluation').on('show.bs.modal',function(event){
                 var url=baseUrl+'get-jobs';
                 	$.ajax({
					url:url,
                    
				
					}).done(function(data) {
				    // console.log(data[1]);
                    
                    //select loop
                       $('#job_evaluation select[name="job_evalutions"]').empty();
                        $('#job_evaluation select[name="job_evalutions"]').append('<option selected disabled>Choose</option>');
                        $.each(data[0], function(index, method) {
                            $('#job_evaluation select[name="job_evalutions"]').append('<option value="' + index + '">' + method + '</option>');
                        });
                
				     
                     //foreach loop
                     
                       
                        $('.custom-table tr').each(function () {
       
                         $(this).find('.evaluation_elements').each(function () {

            
                         });
    });
                     

					});
                    
	
				});
           */
            
          
	
</script>


<?php $__env->stopSection(); ?>
 
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/evaluations/evaluation_list.blade.php ENDPATH**/ ?>