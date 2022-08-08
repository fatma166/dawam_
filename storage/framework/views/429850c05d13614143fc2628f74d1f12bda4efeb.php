

<?php $__env->startSection('title'); ?>
     <?php echo e(__('trans.Specializations')); ?>

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
                                <h3 class="page-title"> <?php echo e(__('trans.Specializations')); ?></h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                    <li class="breadcrumb-item active"> <?php echo e(__('trans.Specializations')); ?></li>
                                </ul>
                            </div>
                            
                            <div class="col-auto float-right ml-auto">
                                
                                <a href="#" class="btn add-btn" id="" data-toggle="modal" data-target="#add_specialization" 
                                 class="add_specialization"  data-href="<?php echo e(url('admin/showspecialization/')); ?>"><i class="fa fa-plus"></i> <?php echo e(__('trans.add specialization')); ?></a>  

                                <div class="view-icons">
                                    <button  class="list-view btn btn-link active" title="<?php echo e(__('trans.list')); ?>">
                                       <i class="fa fa-bars"></i>
                                    </button>    
                                  
                                   
                                </div>
                                
                            </div>
                        </div>
                    </div>


          	<div class="col-lg-12 col-md-12">
							
									<div class="table-responsive">
										<table class="table table-striped custom-table " id="table_search" >
											<thead>
												<tr>
							    	                 <th>#</th>
                                                     <th><?php echo e(__('trans.Specializations')); ?></th>
                                                      <th><?php echo e(__('trans.Action')); ?></th>
												</tr>
											</thead>
											<tbody>
                                               <?php $i=0; ?>
                                                <?php $__currentLoopData = $specialization; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    												<?php $i++; ?>
                                                    <tr>
    													<td><?php echo e($i); ?></td>
                                                        <td><?php echo e($specialization->name); ?></td>
                                                        <td class="text-right">
                                                            <a class="btn btn-outline-success" href="#" data-href="<?php echo e(url('admin/editspecialization/'.$specialization->id)); ?>" specialization-id="<?php echo e($specialization->id); ?>"  data-toggle="modal" data-target="#edit_specialization">
                                                                <i class="fa fa-pencil m-r-5"></i><?php echo e(__('trans.Edit')); ?>

                                                            </a>


                                                            <a class="btn btn-outline-danger" href="#" data-toggle="modal"  data-target="#delete_specialization" 
                                                                 delete-id="<?php echo e($specialization->id); ?>">
                                                                <i class="fa fa-trash-o m-r-5"></i><?php echo e(__('trans.Delete')); ?>

                                                            </a>

                                                          
                                                        </td>
    												</tr>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</tbody>
										</table>
								
							</div>
					</div>  

                </div>


         <!-- add_specialization Modal -->
            <div id="add_specialization" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.add specialization')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form method="post" action="<?php echo e(route('addspecializations',$subdomain)); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                   
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.name')); ?> <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name">
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
           <!-- add_specialization Modal -->



            <!-- Edit specialization -->
            <div id="edit_specialization" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Edit Specialization')); ?></h5>
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
                                            <label class="col-form-label"><?php echo e(__('trans.Name')); ?> <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name">
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
            <!-- Edit specialization -->

            <!-- Delete task -->
            <div class="modal custom-modal fade" id="delete_specialization" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3><?php echo e(__('trans.Delete visit type' )); ?></h3>
                                <p><?php echo e(__('trans.Are you sure want to delete?')); ?></p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary specialization-btn-del"><?php echo e(__('trans.Delete')); ?></a>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn"><?php echo e(__('trans.Cancel')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>php 
                </div>
            </div>
<!-- /Delete task -->

         </div>

   
 </div>
     


 
<?php $__env->stopSection(); ?>
 <?php $__env->startSection('script'); ?>
<script>
    	$("#add_specialization button,#edit_specialization button").click(function(e){
           
           e.preventDefault();
             
           if($(this).attr('type')==="add"){
               url=$('#add_specialization form').attr('action');
               data={name:$("#add_specialization input[name='name']").val()};
           }	
           if($(this).attr('type')==="edit"){
               url=$('#edit_specialization form').attr('action');
               data={name:$("#edit_specialization input[name='name']").val()};
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

$("#edit_specialization").on('show.bs.modal', function(event) {

var button = $(event.relatedTarget) //Button that triggered the modal

var getHref = button.data('href'); //get button href

var id = button.attr('specialization-id'); 
update_url=baseUrl+"updatespecialization/"+id;
 $('#edit_specialization form').attr('action',update_url);

    $.ajax({
		url:getHref,
		// data:{id:id},
	  }).done(function(data)
         {
            $("#edit_specialization form input[name='name']").val(data.name);
	    });
});


      $("#delete_specialization").on('show.bs.modal', function(event) {
           
           var button = $(event.relatedTarget) //Button that triggered the modal
           var id = button.attr('delete-id');
           del_id=id;
           delete_url=baseUrl+"deletespecialization/"+del_id;
           console.log( delete_url);
           });
              $("#delete_specialization .specialization-btn-del").click(function(){
            
               $.ajax({
                       url:delete_url,    
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                       type:"post"
                       }).done(function(data) {
                        location.reload(true);
                        // if(data.hasOwnProperty('success')){
                        //     location.reload(true);
                        //  }
                        //  else
                        //  {
                        //  printErrorMsg(data.error);
                        //  }
       
                   });
   
       });      

</script>


<?php $__env->stopSection(); ?>
 
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/specializations/index.blade.php ENDPATH**/ ?>