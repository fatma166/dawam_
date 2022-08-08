               
                <div class="row" >
                    <div class="col-md-12">
                        <div class="table-responsive">
                                   <th><h2><?php echo e(__('trans.visit_type')); ?></h2><h3><?php if(isset($serach_name['name'])): ?><?php echo e($serach_name['name']); ?><?php else: ?> <?php echo e(__('trans.search to get result')); ?><?php endif; ?></h3></th>
                            <table class="table table-striped custom-table mb-0 " id="table_search">
                              
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('trans.Question Id')); ?></th>
                                        <th><?php echo e(__('trans.Question Title')); ?></th>
                                        <th><?php echo e(__('trans.Question Type')); ?></th>
                                        <th><?php echo e(__('trans.visit_type')); ?></th>
                                        <th colspan="4"><?php echo e(__('trans.QUESTION ANSWERS')); ?></th>
                         
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                 <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

                                 <?php $__currentLoopData = $visitquestionanswers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$visitquestionanswer_): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                   
                                        <td>
                                            <strong><?php echo e($id); ?></strong>
                                        </td>
                                        <td>
                                            <strong><?php echo e($visitquestionanswer_['question_text']); ?></strong>
                                        </td>
                                        <td>
                                            <strong><?php echo e($visitquestionanswer_['question_type']); ?></strong>
                                        </td>
                                        <td>
                                            <strong><?php echo e($serach_name['name']); ?></strong>
                                        </td>
                                         <?php $__currentLoopData = $visitquestionanswer_['answer']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=> $visitquestionanswer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <?php    $total_answers=0; $total_answers.=($visitquestionanswer->COUNT_NUMBER) ?>
                                               
                                                <td class="border">
                                                      <?php echo e($visitquestionanswer->answer_value); ?><span> &nbsp; &nbsp; </span><strong> <a href="<?php echo e(url('https://egifix.dawam.net/admin/visitReport?outdoor_ids='.$visitquestionanswer->outdoor_ids)); ?>"><?php echo e($visitquestionanswer->COUNT_NUMBER); ?></a> </strong>
                                                </td>
                                           
                                              
                                         
                                                
                                            
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              <?php /**PATH /home/dawam/public_html/manger/resources/views/outdoor_report/vistTypeReportsearch.blade.php ENDPATH**/ ?>