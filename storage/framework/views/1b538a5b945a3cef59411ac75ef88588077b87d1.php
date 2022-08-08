<?php $__env->startSection('title'); ?>
    <?php echo e(__('trans.clients')); ?>

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
                            <h3 class="page-title"><?php echo e(__('trans.Clients')); ?></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>"><?php echo e(__('trans.Dashboard')); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo e(__('trans.Clients')); ?></li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_client"><i class="fa fa-plus"></i> <?php echo e(__('trans.Add Client')); ?></a>
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
                
  

        
           <!-- Search Filter -->
                <form>
                    <div class="row filter-row" id="client_search_form">
                                        
                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">  
                            <div class="form-group form-focus">
                              <select class="client_name form-control" name="client"></select>
                                <!--<input type="text" class="form-control floating employee_name"  />-->
                                <label class="focus-label"><?php echo e(__('trans.Client Name')); ?></label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2"> 
                            <div class="form-group form-focus ">
                                <select class="select floating branch" name="branch"> 
                                     <option value="all"><?php echo e(__('trans.all')); ?></option>
                                    <?php $__currentLoopData = $branchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->title); ?></option>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <label class="focus-label"><?php echo e(__('trans.Select Branch')); ?></label>
                            </div>


                        </div>
                      
                       <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2"> 
                            <div class="form-group form-focus select-focus">
                                <select class="select floating client_type" name="client_type"> 
                                    <option value="all"><?php echo e(__('trans.all')); ?></option>
                                    <?php $__currentLoopData = $client_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($client_type->id); ?>"><?php echo e($client_type->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>
                                <label class="focus-label"><?php echo e(__('trans.client types')); ?></label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2"> 
                            <div class="form-group form-focus select-focus">
                                <select class="select floating specializations" name="specializations"> 
                                    <option value="all"><?php echo e(__('trans.all')); ?></option>
                                    <?php if(!empty($specializations)): ?>
                                    <?php $__currentLoopData = $specializations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($specialization->id); ?>"><?php echo e($specialization->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <label class="focus-label"><?php echo e(__('trans.specialization')); ?></label>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">  
                            <a href="#" class="btn btn-success btn-block" id="search_client_report"> <?php echo e(__('trans.Search')); ?> </a>  
                        </div>     
                    </div>
                </form>
                <!-- /Search Filter -->
        
        
        
        





                <?php if(Session::has('success')): ?>

                    <div class="alert alert-success">

                        <?php echo e(Session::get('success')); ?>


                        <?php

                            Session::forget('success');

                        ?>

                    </div>

                <?php endif; ?>


                <?php if(Session::has('error')): ?>

                    <div class="alert alert-success">

                        <?php echo e(Session::get('error')); ?>

                    </div>

                <?php endif; ?>
                
                <div class="row" id="clients_body">
                <?php echo $__env->make('client.search_client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                
                
                
                      
           <!-- /Table Grid -->
                       
                <div class="row staff-grid-row" style="display: none;">
                        <?php if(!empty($clients)): ?>
                         <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                                                 
                         <div class="profile-widget">
                                    <div class="profile-img">
                                        <a href="profile.html" class="avatar"><img src="assets/img/profiles/avatar-02.jpg" alt=""></a>
                                    </div>
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                      <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                           data-href="<?php echo e(url('admin/client-edit/'.$client->id)); ?>" client-id="<?php echo e($client->id); ?>" data-toggle="modal" data-target="#edit_client"><i class="fa fa-pencil m-r-5"></i>
                                                            <?php echo e(__('trans.Edit')); ?></a>
                                                      <!--  <a class="dropdown-item" href="#" client_type-id="<?php echo e($client->id); ?>"
                                                             data-toggle="modal" data-target="#delete_client" delete-id="<?php echo e($client->id); ?>"><i class="fa fa-trash-o m-r-5"></i>
                                                            <?php echo e(__('trans.Delete')); ?> </a>-->
                                       </div>
                                    </div>
                                    <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="profile.html"><?php echo e($client->name); ?> / <?php echo e($client->phone); ?></a></h4>
                                    
                         </div>
                            
                         </div>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           <?php endif; ?>   
                </div>
                     
             <!-- /Table Grid -->
            </div>
            <!-- /Page Content -->
        
      
        
            <!-- Add Client Modal -->
            <div id="add_client" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Add Client')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form action="<?php echo e(route('store-client',$subdomain)); ?>" >
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                  <div class="col-sm-6 col-md-6"> 
                                        <div class="form-group">
                                             <label class="focus-label"><?php echo e(__('trans.Select Branch')); ?></label>
                                            <select class="select floating branch" name="branch">                                               
                                                <?php $__currentLoopData = $branchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->title); ?></option>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>                      
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Name')); ?> <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.phone')); ?></label>
                                            <input class="form-control" type="text" name="phone">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Email')); ?> <span class="text-danger">*</span></label>
                                            <input class="form-control floating" type="email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Contact_person')); ?></label>
                                            <input class="form-control" name="contact_person" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Contactphone')); ?></label>
                                            <input class="form-control" name="contact_phone" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.client_type')); ?> <span class="text-danger">*</span></label>
                                            
                                            <select class="select" name="client_type_id">
                                                <?php if(isset($client_types)): ?> 
                                                    <?php $__currentLoopData = $client_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($client_type->id); ?>"><?php echo e($client_type->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                 <?php endif; ?>;
                                            </select>
                                           
                                        </div>

                                       
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="focus-label"><?php echo e(__('trans.specialization')); ?></label>
                                            <select class="select" name="specializations_id"> 
                                                <option value="all"><?php echo e(__('trans.all')); ?></option>
                                                <?php if(isset($specializations)): ?> 
                                                    <?php $__currentLoopData = $specializations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($specialization->id); ?>"><?php echo e($specialization->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>;
                                            </select>
                                        </div>
                                     </div>


                                <!--<div class="col-sm-6">
                                    <div class="form-group">
                                        <label><?php echo e(__('trans.From')); ?> <span class="text-danger">*</span></label>
                                        
                                        <div class="input-group time timepicker">
                                           
                                            <input type="time" class="form-control" name="start_time"/>
                                        </div>
                                     </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label><?php echo e(__('trans.To')); ?><span class="text-danger">*</span></label>
                
                                    <div class="input-group time timepicker">
                                    
                                        <input type="time" class="form-control" name="end_time"/>
                                    </div>
                                </div>
                                </div>-->
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.target_vists')); ?></label>
                                            <input class="form-control" name="target_vists" type="number">
                                        </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.Adress')); ?> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="address" placeholder="<?php echo e(__('trans.add address then press enter')); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 d-none">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.lat')); ?> <span class="text-danger" >*</span></label>
                                        <input class="form-control add_lat" type="hidden" name="add_lat" >
                                    </div>
                                </div>
                               <div class="col-sm-6 d-none">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.lang')); ?> <span class="text-danger" >*</span></label>
                                        <input class="form-control add_lang" type="hidden" name="add_lang" >
                                    </div>
                                </div>

                                    <div class="col-sm-12">
                                           <button class="add_sch btn-primary" onclick="add_client_sch('add_client');">اضافه ميعاد جديد <i class="fa fa-plus"></i></button>
                                            <div></div>
                                          </div>
 </div>
                             
                                  
                                    
                                          <div class="client_sch row" id="0" >
                                              
                                              <div class="col-lg-4"> 
                                                <label class="col-form-label"><?php echo e(__('trans.day')); ?> <span class="text-danger" >*</span></label>
                                                  <select class="select day_0" name="day[]"> 
                                                        <option value="7"><?php echo e(__('trans.all')); ?></option>
                                                        <option value="6"><?php echo e(__('trans.saturday')); ?></option>
                                                        <option value="0"><?php echo e(__('trans.sunday')); ?></option>
                                                        <option value="1"><?php echo e(__('trans.monday')); ?></option>
                                                        <option value="2"><?php echo e(__('trans.thursday')); ?></option>
                                                        <option value="3"><?php echo e(__('trans.wednsday')); ?></option>
                                                        <option value="4"><?php echo e(__('trans.tuesday')); ?></option>
                                                        <option value="5"><?php echo e(__('trans.friday')); ?></option>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-lg-4">
                                                    <label><?php echo e(__('trans.From')); ?> <span class="text-danger">*</span></label>
                                                    
                                                    <div class="input-group time timepicker">
                                                       <!-- <input class="form-control" name=""><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
                                                        <input type="time" class="form-control str_0"  value="00:00" name="start_time[]"/>
                                                    </div>
                                                </div>
                                               <div class="col-lg-4">
                                                   <label><?php echo e(__('trans.To')); ?><span class="text-danger">*</span></label>
                                
                                                    <div class="input-group time timepicker">
                                                        <!--<input class="form-control" name=""><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
                                                        <input type="time" class="form-control end_0"  value="00:00" name="end_time[]"/>
                                                    </div>
                                                 
                                              </div>
                                            </div>
                                        
                                   
                              
                                <div class="col-sm-12">
                                    <div id="map" style="height:400px"></div>

                                </div>
                                  
                                   
                               
                              
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="add"><?php echo e(__('trans.Submit')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Client Modal -->
            
            <!-- Edit Client Modal -->
            <div id="edit_client" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('trans.Edit Client')); ?></h5>
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
                               <div class="col-sm-6 col-md-6"> 
                                        <div class="form-group form-focus ">
                                            <select class="select floating branch" name="branch"> 
                                               
                                                <?php $__currentLoopData = $branchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->title); ?></option>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <label class="focus-label"><?php echo e(__('trans.Select Branch')); ?></label>
                                        </div>
            
            
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Name')); ?> <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.phone')); ?></label>
                                            <input class="form-control" type="text" name="phone">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Email')); ?> <span class="text-danger">*</span></label>
                                            <input class="form-control floating" type="email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Contact_person')); ?></label>
                                            <input class="form-control" name="contact_person" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.Contactphone')); ?></label>
                                            <input class="form-control" name="contact_phone" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label><?php echo e(__('trans.client_type')); ?> <span class="text-danger">*</span></label>
                                            
                                            <select class="select" name="client_type_id">
                                                <?php if(isset($client_types)): ?> 
                                                    <?php $__currentLoopData = $client_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($client_type->id); ?>"><?php echo e($client_type->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                 <?php endif; ?>;
                                            </select>
                                           
                                        </div>
                                    </div>
                                  
                                 
                                     <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="focus-label"><?php echo e(__('trans.specialization')); ?></label>
                                            <select class="select" name="specializations_id"> 
                                                <?php if(isset($specializations)): ?> 
                                                    <?php $__currentLoopData = $specializations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($specialization->id); ?>"><?php echo e($specialization->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>;
                                            </select>
                                        </div>
                                     </div> 


                                <!--<div class="col-sm-3">
                                    <div class="form-group">
                                        <label><?php echo e(__('trans.From')); ?> <span class="text-danger">*</span></label>
                                        
                                        <div class="input-group time timepicker">
                                            <input class="form-control"  type="time" name="start_time">
                                        </div>
                                     </div>
                                </div>-->
                                <!--<div class="col-sm-6">
                                <div class="form-group">
                                    <label><?php echo e(__('trans.To')); ?><span class="text-danger">*</span></label>
                
                                    <div class="input-group time timepicker">
                                        <input class="form-control"  type="time" name="end_time">
                                    </div>
                                </div>
                                </div>-->
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('trans.target_vists')); ?></label>
                                            <input class="form-control" name="target_vists" type="number">
                                        </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.Adress')); ?> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="address" placeholder="<?php echo e(__('trans.add address then press enter')); ?>">
                                    </div>
                                    <input type="button" class="search_client_add"/><span>search</span>
                                </div>
                                <div class="col-sm-6 d-none">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.lat')); ?> <span class="text-danger" >*</span></label>
                                        <input class="form-control edit_lat" type="hidden" name="add_lat" >
                                    </div>
                                </div>
                               <div class="col-sm-6 d-none">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(__('trans.lang')); ?> <span class="text-danger" >*</span></label>
                                        <input class="form-control edit_lang" type="hidden" name="add_lang" >
                                    </div>
                                </div>
                                                                  
                                <div class="col-sm-12">
                                   <label><?php echo e(__('trans.add')); ?></label>
                                    <div><i class="fa fa-plus add_sch" onclick="add_client_sch('edit_client');"></i></div>
                                </div>
              
                               
                                                                 
                        
                              <div class="client_sch row" id="0" >
                                  
                                  <div class="col-lg-4"> 
                                    <label class="col-form-label"><?php echo e(__('trans.day')); ?> <span class="text-danger" >*</span></label>
                                        <select class="select day_0" name="day[]"> 
                                            <option value="7"><?php echo e(__('trans.all')); ?></option>
                                            <option value="6"><?php echo e(__('trans.saturday')); ?></option>
                                            <option value="0"><?php echo e(__('trans.sunday')); ?></option>
                                            <option value="1"><?php echo e(__('trans.monday')); ?></option>
                                            <option value="2"><?php echo e(__('trans.thursday')); ?></option>
                                            <option value="3"><?php echo e(__('trans.wednsday')); ?></option>
                                            <option value="4"><?php echo e(__('trans.tuesday')); ?></option>
                                            <option value="5"><?php echo e(__('trans.friday')); ?></option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label><?php echo e(__('trans.From')); ?> <span class="text-danger">*</span></label>
                                        
                                        <div class="input-group time timepicker">
                                           <!-- <input class="form-control" name=""><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
                                            <input type="time" class="form-control str_0" value="00:00" name="start_time[]"/>
                                        </div>
                                    </div>
                                   <div class="col-lg-4">
                                       <label><?php echo e(__('trans.To')); ?><span class="text-danger">*</span></label>
                    
                                        <div class="input-group time timepicker">
                                            <!--<input class="form-control" name=""><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
                                            <input type="time" class="form-control end_0" value="00:00" name="end_time[]"/>
                                        </div>
                                     
                                  </div>
                                </div>
                                     <div class="client_appoints"></div>      
                                <div class="col-sm-12">
                                    <div id="map_edit" style="height:400px"></div>

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
            <!-- /Edit Client Modal -->
            
            <!-- Delete Client Modal -->
            <div class="modal custom-modal fade" id="delete_client" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3><?php echo e(__('trans.Delete Client')); ?></h3>
                                <p><?php echo e(__('trans.Are you sure want to delete?')); ?></p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn"><?php echo e(__('trans.Delete')); ?></a>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn"><?php echo e(__('trans.Cancel')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Delete Client Modal -->
            
        </div>
        <!-- /Page Wrapper -->
  
         <?php echo $__env->make('./layout.partials.map_script2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>  
<script>
 /*$(document).ready(function(){
        var i=1;
     function add_client_sch(){
           
            id=$(".client_sch").last().attr('id');
            
            //  var split_id = id.split("_");
            //  var deleteindex = split_id[1];
                i=id;
               ++i;
            $(".client_sch").last().append('<div class="client_sch" id="'+i+'" ><div class="col-sm-3"> <label class="col-form-label"><?php echo e(__("trans.day")); ?> <span class="text-danger" >*</span></label><select class="select day_'+i+'" name="day[]"><option value="saturday"><?php echo e(__("trans.saturday")); ?></option><option value="sunday"><?php echo e(__("trans.sunday")); ?></option><option value="monday"><?php echo e(__("trans.monday")); ?></option><option value="thursday"><?php echo e(__("trans.thursday")); ?></option><option value="wednsday"><?php echo e(__("trans.wednsday")); ?></option><option value="tuesday"><?php echo e(__("trans.tuesday")); ?></option><option value="friday"><?php echo e(__("trans.friday")); ?></option></select></div><div class="col-sm-3"><label><?php echo e(__("trans.From")); ?> <span class="text-danger">*</span></label><div class="input-group time timepicker"><input type="time" class="form-control" name="start_time[]"/></div></div><div class="col-sm-3"><label><?php echo e(__("trans.To")); ?><span class="text-danger">*</span></label><div class="input-group time timepicker"><input type="time" class="form-control" name="end_time[]"/></div></div></div>');
        
        
        
        
        
     }
    $(".add_sch").click(function(){
         $(".add_sch").empty();
          $(".add_sch").text("delete")
    });
    
    
    
    });*/
        
        /*search_client_report search*/ 
        $("#search_client_report").click(function(){
            var client=$(".client_name").val();
            var branch=$(".branch").val();
            var client_type=$(".client_type").val();
            var specializations=$(".specializations").val();
           
            // console.log(specializations);
            // return;
            let getHref1=baseUrl+"clients";
            $.ajax({
                /*headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},*/
                type:"get",
                url:getHref1,
                data:{branch:branch,client_type:client_type,specializations:specializations,client:client},
                beforeSend: function() { $("#clients_body #load").show(); },
                }).done(function(data) {
                     history.pushState('', '',"<?php echo e(url('admin/clients')); ?>"+"?client="+client+"&branch="+branch+"&client_type="+client_type+"&specializations="+specializations);
            
                    $("#clients_body #load").show(); 
                    $("#clients_body").empty();
                    $("#clients_body").append(data);
 
                    $('#clients_body').find('.datatable').DataTable({"scrollX": true});
                    $('#clients_body').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
   
               });
  
        });

  $(document).on('click', '#clients_body .pagination a',function(event)
        {
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            $('#search_client_report').append('<img style="position: absolute; left: 0; top: 0; z-index: 10000;" src="https://i.imgur.com/v3KWF05.gif />');
            var myurl = $(this).attr('href');
           // alert(myurl);
            var page=$(this).attr('href').split('page=')[1];
  
            getclient(page);
        });

function getclient(page){
           var branch=$(".branch").val();
            var client_type=$(".client_type").val();
    
        data={branch:branch,client_type:client_type};
        $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"get",
                url: '?page=' + page,
                data:data,
                 beforeSend: function() { $("#clients_body #load").show(); },
                }).done(function(data) {

                     history.pushState('', '',"<?php echo e(url('admin/clients')); ?>"+"?branch="+branch+"&client_type="+client_type+"&page="+page);
            
                    $("#clients_body #load").show(); 
                    $("#clients_body").empty();
                    $("#clients_body").append(data);
 
                    $('#clients_body').find('.datatable').DataTable({"scrollX": true});
                    $('#clients_body').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
   
            });
    }
</script>
<?php $__env->stopSection(); ?>   
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/client/index.blade.php ENDPATH**/ ?>