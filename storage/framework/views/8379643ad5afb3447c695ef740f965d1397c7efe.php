
<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.outdoor-question')); ?>

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
                            <h3 class="page-title"><?php echo e(__('trans.Outdoors-question')); ?></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo e(__('trans.Visit_question')); ?></li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_visit_question"><i class="fa fa-plus"></i><?php echo e(__('trans.Add QUESTION')); ?></a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <search filter>
                <form method="post">
                <div class="row filter-row" id="visit_que">


                   <div class="col-lg-5"> 
                        <div class="form-group form-focus select-focus">
                            <select class="select floating type" name="type" > 
                                <option value="all"><?php echo e(__('trans.-- Select --')); ?> </option>
                                <option value="mcq"> <?php echo e(__('choose')); ?> </option>
                                <option value="text"> <?php echo e(__('text')); ?> </option>
                                <option value="tf"><?php echo e(__('t/f')); ?></option>

                            </select>
                            <label class="focus-label"><?php echo e(__('trans.Question Type')); ?></label>
                        </div>
                   </div>

                    <div class="col-lg-5"> 
                        <div class="form-group form-focus select-focus">
                            <select class="select floating visit_type" name="type" > 
                                <option value="all"> -- Select -- </option>
                                <?php $__currentLoopData = $visit_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($visit_type->id); ?>"> <?php echo e($visit_type->name); ?></option>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <label class="focus-label"><?php echo e(__('trans.Visit Type')); ?></label>
                        </div>
                   </div>


                   <div class="col-lg-2">  
                        <a  class="btn btn-success btn-block" id="search_question"> <?php echo e(__('trans.Search')); ?> </a>  
                   </div> 

                </div>
                </form>
                <!-- /Search Filter -->
                <div class="visit_question_data">
                <div class="row" id="visit_question">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">#</th>
                                        <th><?php echo e(__('trans.question_text')); ?></th>
                                        <th><?php echo e(__('trans.type')); ?></th>
                                        <th><?php echo e(__('trans.visittype')); ?></th>
                                        <th class="text-right"><?php echo e(__('trans.Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

                                <?php if(!empty($visits_question)): ?>
                                <?php $__currentLoopData = $visits_question; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit_question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($visit_question->id); ?></td>
                                        <td><?php echo e($visit_question->question_text); ?></td>
                                        <td><?php echo e($visit_question->type); ?></td>
                                        <td><?php echo e($visit_question->name); ?></td>
                                        <td class="text-right">
                                           
                                            <a class="btn btn-outline-success" href="#" data-href="<?php echo e(url('admin/visitquestion-edit/'.$visit_question->id)); ?>" visitquestion-id="<?php echo e($visit_question->id); ?>"  data-toggle="modal" data-target="#edit_visit_question"><i class="fa fa-pencil m-r-5"></i><?php echo e(__('trans.Edit')); ?></a>
                                            <a class="btn btn-outline-danger" href="#" data-toggle="modal"  data-target="#delete_visit_question" delete-id="<?php echo e($visit_question->id); ?>"><i class="fa fa-trash-o m-r-5"></i> <?php echo e(__('trans.Delete')); ?></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- /Page Content -->
         

            <!-- Add visit_question Modal -->
            <div id="add_visit_question" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Add Visit question')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form method="post" action="<?php echo e(route('store-visitquestion',$subdomain)); ?>">
                             <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Target Type')); ?></label>

                                            <select class="select" name="visit_type">
                                            <?php $__currentLoopData = $visit_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($visit_type->id); ?>"><?php echo e($visit_type->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Question Type')); ?></label>

                                            <select class="select que_type" name="que_type">
                                                 <option value="mcq">choose</option>
                                                 <option value="text">text</option>
                                                  <option value="t/f">true/false</option>
                                            
                                            </select>
                                        </div>
                                    </div>
                                <div class="col-sm-12 question">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.	question_text')); ?> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="question_text">
                                    </div>
                                </div>
                                <div class="msq_answer col-sm-12">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.add choose1')); ?> <span class="text-danger" >*</span></label>
                                            <input class="form-control add_lat" type="text" name="choose1" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.add choose2')); ?> <span class="text-danger" >*</span></label>
                                            <input class="form-control choose2" type="text" name="choose2" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.add choose3')); ?> <span class="text-danger" >*</span></label>
                                            <input class="form-control add_lat" type="text" name="choose3" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.add choose4')); ?> <span class="text-danger" >*</span></label>
                                            <input class="form-control choose2" type="text" name="choose4" >
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="col-sm-12>
                                    <span id="insertAfterBtn" onclick="add_question();"><i class="fa fa-th"><?php echo e(__('trans.Add')); ?></i></span> 
                                </div>-->

                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="add"><?php echo e(__('trans.Submit')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add visit_question -->
            
            <!-- Edit visit question -->
            <div id="edit_visit_question" class="modal custom-modal fade" role="dialog">
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
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Target Type')); ?></label>

                                            <select class="select" name="visit_type">
                                                <?php $__currentLoopData = $visit_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($visit_type->id); ?>"><?php echo e($visit_type->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Question Type')); ?></label>

                                     
                                             <select class="select que_type" name="que_type">
                                                 <option value="mcq">choose</option>
                                                 <option value="text">text</option>
                                                  <option value="t/f">true/false</option>
                                            
                                            </select>
                                        </div>
                                    </div>
                                <div class="col-sm-12 question">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.question_text')); ?> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="question_text">
                                    </div>
                                </div>
                                <div class="msq_answer col-sm-12 ">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.add choose1')); ?> <span class="text-danger" >*</span></label>
                                            <input class="form-control add_lat" type="text" name="choose1" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.add choose2')); ?> <span class="text-danger" >*</span></label>
                                            <input class="form-control choose2" type="text" name="choose2" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.add choose3')); ?> <span class="text-danger" >*</span></label>
                                            <input class="form-control add_lat" type="text" name="choose3" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.add choose4555')); ?> <span class="text-danger" >*</span></label>
                                            <input class="form-control choose2" type="text" name="choose4" >
                                        </div>
                                    </div>
                                </div>
                              <!--  <div class="col-sm-12">
                                <span  onclick="add_question_answer();"><i class="fa fa-th"><?php echo e(__('trans.Add')); ?></i></span> 
                                </div>-->

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
            <!-- /Edit visit_question -->
            
            <!-- Delete visit_question -->
            <div class="modal custom-modal fade" id="delete_visit_question" role="dialog">
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
                                        <a href="javascript:void(0);" class="btn btn-primary visit_question-continue-btn"><?php echo e(__('trans.Delete')); ?></a>
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
        <!-- /Page Wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/outdoors/question.blade.php ENDPATH**/ ?>