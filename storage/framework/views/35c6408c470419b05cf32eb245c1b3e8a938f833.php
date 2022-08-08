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
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                   <a class="dropdown-item" data-href="<?php echo e(url('admin/visitquestion-edit/'.$visit_question->id)); ?>" visitquestion-id="<?php echo e($visit_question->id); ?>"  data-toggle="modal" data-target="#edit_visit_question"><i class="fa fa-pencil m-r-5"></i><?php echo e(__('trans.Edit')); ?></a>
                                                   <a class="dropdown-item" data-toggle="modal"  data-target="#delete_visit_question" delete-id="<?php echo e($visit_question->id); ?>"><i class="fa fa-trash-o m-r-5"></i> <?php echo e(__('trans.Delete')); ?></a>
                                                </div>

                                            </div>
                                            
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><?php /**PATH /home/dawam/public_html/manger/resources/views/outdoors/question_search.blade.php ENDPATH**/ ?>