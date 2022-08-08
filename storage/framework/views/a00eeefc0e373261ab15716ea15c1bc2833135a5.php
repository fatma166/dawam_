<div class="main-wrapper">
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
       
                
		            <li class="<?php echo e(Request::is('/') ? 'active' : ''); ?>"> <a  href="<?php echo e(url('/admin/dashboard')); ?>"> <?php echo e(__('trans.Dashboard')); ?></a></li>
                   <!-- <li class="menu-title">
                        <span><?php echo e(__('trans.Companies')); ?></span>
                    </li>-->


              
    				<li class="submenu">
						<a href="#" class="noti-dot subdrop"><i class="la la-cog"></i> <span><?php echo e(__('trans.Setting')); ?></span> <span class="menu-arrow"></span></a>
					      <ul style="display:block;">
                             <?php if($roles['name']!="manger"||$roles['name']=="support"): ?>
                                 <li>
                                 
                                    <a class="<?php echo e(Request::is('companies') ? 'active' : ''); ?>"
                                        href="<?php echo e(route('company',$subdomain)); ?>"><i class="la la-bank"></i> <?php echo e(__('trans.All Companies')); ?></a>
                                    
                                </li>
                              <?php if($roles['name']=="manger"||($roles['name']=="admin")|| (Session::has('company'))): ?> 
                                <li>
                                    <a class="<?php echo e(Request::is('employee/edit_admin') ? 'active' : ''); ?>"
                                        href="<?php echo e(route('AdminUser',$subdomain)); ?>"><i class="la la-edit"></i> <?php echo e(__('trans.editAdminData')); ?></a>
                                    
                                </li>
                               <?php endif; ?>
                              <?php endif; ?>
                              <?php if(($roles['name']=="developer"||$roles['name']=="accountant"||$roles['name']=="super_admin")&&(!Session::has('company'))): ?>
                             
                                    <li class="submenu">
                                        <a href="#"><i class="la la-hand-o-up"></i> <span> <?php echo e(__('trans.Subscriptions')); ?> </span> <span
                                        class="menu-arrow"></span></a>
                                        <ul style="display: none;">
        
                                            <li>
                                                <a class="<?php echo e(Request::is('subscriptions-company') ? 'active' : ''); ?>"
                                                    href="<?php echo e(route('subscribe-index',$subdomain)); ?>"> <?php echo e(__('trans.Subscriptions (Company)')); ?> </a>
                                            </li>                       
        
                                            <li>
                                                <a class="<?php echo e(Request::is('subscriptions-company') ? 'active' : ''); ?>"
                                                    href="<?php echo e(route('subscribe-index',$subdomain)); ?>"> <?php echo e(__('trans.Subscriptions (Company)')); ?> </a>
                                            </li>
        
                                            <li>
                                                <a class="<?php echo e(Request::is('company_subscribes') ? 'active' : ''); ?>"
                                                    href="<?php echo e(route('company-subscribe',$subdomain)); ?>"><?php echo e(__('trans.Subscribed Value')); ?> </a>
                                            </li>
        
        
                                        </ul>
                                    </li>
                                    <li class="submenu">
                                            <a href="#"><i class="la la-rocket"></i> <span> <?php echo e(__('trans.Representative')); ?></span> <span
                                                    class="menu-arrow"></span></a>
                                            <ul style="display: none;">
                    
                                                <li class="<?php echo e(Request::is('representative') ? 'active' : ''); ?>">
                                                    <a href="<?php echo e(route('representative',$subdomain)); ?>"><i class="la la-users"></i> <span><?php echo e(__('trans.Representatives')); ?></span></a>
                                                </li>
                    
                    
                                            </ul>
                                    </li>
                    
                                    <li>
                                        <a class="<?php echo e(Request::is('payment') ? 'active' : ''); ?>"
                                           href="<?php echo e(route('payment',$subdomain)); ?>"><?php echo e(__('trans.All payment')); ?></a>
                                            
                                    </li>  
                                <?php endif; ?>
                                <?php if($roles['name']=="developer"||$roles['name']=="super_admin"&& !(Session::has('company'))): ?>
                                    <li>
                                        <a class="<?php echo e(Request::is('banks') ? 'active' : ''); ?>"
                                           href="<?php echo e(route('bank',$subdomain)); ?>"><?php echo e(__('trans.All bank')); ?></a>
                                        
                                    </li>
                                  <!-- <li>
                                        <a class="<?php echo e(Request::is('methods') ? 'active' : ''); ?>"
                                           href="<?php echo e(route('method',$subdomain)); ?>"><?php echo e(__('trans.All method')); ?></a>
                                        
                                    </li>-->
                                    <li>
                                        <a class="<?php echo e(Request::is('category') ? 'active' : ''); ?>"
                                           href="<?php echo e(route('category',$subdomain)); ?>"><?php echo e(__('trans.All category')); ?></a>
                                        
                                    </li>
                                <?php endif; ?>
                                <?php if(($roles['name']=="admin")|| (Session::has('company'))): ?>
                                        <?php if($roles['name']!="manger"): ?>
                                            <li>
                                                <a class="<?php echo e(Request::is('companies') ? 'active' : ''); ?>"
                                                    href="<?php echo e(route('branch',$subdomain)); ?>"><i class="la la-map"></i> <?php echo e(__('trans.Branches')); ?></a>
                                                
                                            </li>
                                            <li>
                                                <a class="<?php echo e(Request::is('companies') ? 'active' : ''); ?>"
                                                    href="<?php echo e(route('department',$subdomain)); ?>"><i class="la la-sitemap"></i>  <?php echo e(__('trans.Departments')); ?></a>
                                                
                                            </li>
                                        <?php endif; ?>
                                        <li>
                                            <a class="<?php echo e(Request::is('shift') ? 'active' : ''); ?>"
                                                href="<?php echo e(route('shift',$subdomain)); ?>"><i class="la la-history"></i>  <?php echo e(__('trans.Shifts')); ?></a>
                                        </li>
                      
                 
                                         <?php if($roles['name']!="manger"): ?>
                							<li>
                                                <a class="<?php echo e(Request::is('jobs') ? 'active' : ''); ?>"
                                                    href="<?php echo e(route('job',$subdomain)); ?>"><i class="la la-user-secret"></i>  <?php echo e(__('trans.Jobs')); ?></a>
                                            </li>
                
                                            <li>
                                                <a class="<?php echo e(Request::is('holidays') ? 'active' : ''); ?>"
                                                    href="<?php echo e(route('exception-holidays',$subdomain)); ?>"><i class="la la-dot-circle-o"></i>  <?php echo e(__('trans.ExceptionHolidays')); ?></a>
                                            </li>
                                             <li>
                                                <a class="<?php echo e(Request::is('fixedholidays') ? 'active' : ''); ?>"
                                                    href="<?php echo e(route('fixed-holidays',$subdomain)); ?>"><i class="la la-dot-circle-o"></i>  <?php echo e(__('trans.FixedHolidays')); ?></a>
                                            </li>
        
                                         <?php endif; ?>
                                   <?php endif; ?>
                                   <?php if(($roles['name']=="manger")||($roles['name']=="admin")|| (Session::has('company'))): ?>
                                      <!--  <li>
                                            <a class="<?php echo e(Request::is('user_shift') ? 'active' : ''); ?>"
                                                href="<?php echo e(route('user_shift_index',$subdomain)); ?>"><?php echo e(__('trans.User Shifts')); ?></a>
                                        </li>-->
            
                                   <?php endif; ?>
                                   <?php if($roles['name']=="manger"||($roles['name']=="admin")|| (Session::has('company'))): ?> 
                                        <!--<li>
                                            <a class="<?php echo e(Request::is('Leave') ? 'active' : ''); ?>"
                                                href="<?php echo e(route('leaves',$subdomain)); ?>"><?php echo e(__('trans.Leaves (Admin)')); ?></a>
                                        </li>-->
            
                                         <?php if($roles['name']!="manger"): ?>
                                            <li>
                                                <a class="<?php echo e(Request::is('leave-settings') ? 'active' : ''); ?>"
                                                    href="<?php echo e(route('leave-settings',$subdomain)); ?>"><i class="la la-dot-circle-o"></i> <?php echo e(__('trans.Leave Settings')); ?></a>
                                            </li>
                                          <?php endif; ?>                        
                                        <li>
                                            <a class="<?php echo e(Request::is('Outdoor_type') ? 'active' : ''); ?>"
                                                href="<?php echo e(route('outdoor-type',$subdomain)); ?>"><i class="la la-dot-circle-o"></i> <?php echo e(__('trans.Outdoor Type')); ?></a>
                                        </li>
                                        <li>
                                            <a class="<?php echo e(Request::is('Specializations') ? 'active' : ''); ?>"
                                                href="<?php echo e(route('specializations',$subdomain)); ?>"><i class="la la-dot-circle-o"></i> <?php echo e(__('trans.Specializations')); ?></a>
                                        </li>
                                    <?php endif; ?>

    
                            </ul>
                    </li>
                    

                   <?php if($roles['name']=="manger"||($roles['name']=="admin")|| (Session::has('company'))): ?> 
                   <li class="submenu">
                        <a href="#" class="noti-dot"><i class="la la-check-circle-o"></i> <span> <?php echo e(__('trans.available')); ?> </span> <span
                        class="menu-arrow"></span></a>
                        <ul style="display: none;">

                            <li>
                                <a class="<?php echo e(Request::is('attendance/employee_available/client') ? 'active' : ''); ?>"
                                    href="<?php echo e(url('/admin/attendance/employee_available/'.'client')); ?>" ><?php echo e(__('trans.client_attendance')); ?> </a>
                            </li>                       

                          
                             <li>
                                <a class="<?php echo e(Request::is('attendance/employee_available/branch') ? 'active' : ''); ?>"
                                    href="<?php echo e(url('/admin/attendance/employee_available/'.'branch')); ?>"> <?php echo e(__('trans.branch_attendance')); ?> </a>
                            </li>  
                          
                            <li>
                                <a class="<?php echo e(Request::is('attendance/employee_available/not_dected') ? 'active' : ''); ?>"
                                    href="<?php echo e(url('/admin/attendance/employee_available/'.'not_dected')); ?>"> <?php echo e(__('trans.none detected')); ?> </a>
                            </li>  

                        </ul>
                    </li>
                  
                  
                    <li class="submenu">
                            <a href="#" class="noti-dot"><i class="la la-user-plus"></i> <span><?php echo e(__('trans.All Employees')); ?></span> <span class="menu-arrow"></span></a>
                                <ul style="display:none;">
                               
                                        <li>
                                            <a class="<?php echo e(Request::is('employees') ? 'active' : ''); ?>"
                                                href="<?php echo e(route('employee',$subdomain)); ?>"><?php echo e(__('trans.Total_ Employees')); ?></a>
                                        </li>
                                </ul>
                     </li>
                     <li class="submenu">
                            <a href="#" class="noti-dot"><i class="la la-history"></i> <span><?php echo e(__('trans.User Shifts')); ?></span> <span class="menu-arrow"></span></a>
                                <ul style="display:none;">
                                        <li>
                                            <a class="<?php echo e(Request::is('user_shift') ? 'active' : ''); ?>"
                                                href="<?php echo e(route('user_shift_index',$subdomain)); ?>"><?php echo e(__('trans.User Shifts')); ?></a>
                                        </li>
                                </ul>
                     </li>
                     
                     <li class="submenu">
                            <a href="#"><i class="la la-briefcase"></i> <span> <?php echo e(__('trans.Clients')); ?></span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                               
                                <li>
                                    <a class="<?php echo e(Request::is('client_type') ? 'active' : ''); ?>"
                                        href="<?php echo e(route('client_type',$subdomain)); ?>"><?php echo e(__('trans.Client_types')); ?></a>
                                </li>
                                <li class="<?php echo e(Request::is('client') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('client',$subdomain)); ?>"><i class="la la-users"></i> <span><?php echo e(__('trans.Clients')); ?></span></a>
                                </li>
    
    
                            </ul>
                        </li>  
                        <li class="submenu">
                            <a href="#" class="noti-dot"><i class="la la-car"></i> <span> <?php echo e(__('trans.Outdoors')); ?></span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display:none;">
    
                                <li>
                                    <a class="<?php echo e(Request::is('Outdoor') ? 'active' : ''); ?>"
                                        href="<?php echo e(route('outdoor',$subdomain)); ?>"><?php echo e(__('trans.Outdoors')); ?></a>
                                </li>
      
                                <li>
                                    <a class="<?php echo e(Request::is('Outdoor_question') ? 'active' : ''); ?>"
                                        href="<?php echo e(route('outdoor-question',$subdomain)); ?>"><?php echo e(__('trans.Outdoor question')); ?></a>
                                </li>
                                
                            </ul>
                        </li>
                        <?php if($roles['name']=="manger"||($roles['name']=="admin")|| (Session::has('company'))): ?> 
                          <li class="submenu">
                            <a href="#"><i class="la la-hand-o-up"></i> <span> <?php echo e(__('trans.evaluation')); ?> </span> <span
                            class="menu-arrow"></span></a>
                            <ul style="display: none;">
        
                                <li>
                                    <a class="<?php echo e(Request::is('elements-evaluation') ? 'active' : ''); ?>"
                                        href="<?php echo e(route('evaluations',$subdomain)); ?>"> <?php echo e(__('trans.elements-evaluation')); ?> </a>
                                </li>                       
        
                              
                                 <li>
                                    <a class="<?php echo e(Request::is('evaluation_jobs') ? 'active' : ''); ?>"
                                        href="<?php echo e(route('evaluation_jobs',$subdomain)); ?>"> <?php echo e(__('trans.evaluation_jobs')); ?> </a>
                                </li>  
                              
                                <li>
                                    <a class="<?php echo e(Request::is('evaluation_employes') ? 'active' : ''); ?>"
                                        href="<?php echo e(route('evaluation_employes',$subdomain)); ?>"> <?php echo e(__('trans.evaluation_employes')); ?> </a>
                                </li>  
        
                             
        
                                <a href="#"><i class="la la-hand-o-up"></i> <span> <?php echo e(__('trans.Chart_evaluation')); ?> </span> <span
                                    class="menu-arrow"></span></a>
                                    <ul style="display: none;">
                                       <?php if($roles['name']!="manger"): ?>
                                         
                                        <li>
                                    
                                            <a class="<?php echo e(Request::is('showevaluation_employes') ? 'active' : ''); ?>"
                                                href="<?php echo e(route('showevaluation_employes',$subdomain)); ?>"> <?php echo e(__('trans.Show_Employe_Evaluation')); ?> </a>
                                        </li>  
                                        <li>
                                            <a class="<?php echo e(Request::is('job_chart') ? 'active' : ''); ?>"
                                                href="<?php echo e(route('job_chart',$subdomain)); ?>"> <?php echo e(__('trans.ShowJob_ChartEvalaution')); ?> </a>
                                        </li>  
                                        <li>
                                            
                                            <a class="<?php echo e(Request::is('showdeparteval') ? 'active' : ''); ?>"
                                                href="<?php echo e(route('showdeparteval',$subdomain)); ?>"> <?php echo e(__('trans.showdeparteval')); ?> </a>
                                        </li>  
                                        <li>
                                            
                                            <a class="<?php echo e(Request::is('showbrancheval') ? 'active' : ''); ?>"
                                                href="<?php echo e(route('showbrancheval',$subdomain)); ?>"> <?php echo e(__('trans.showbrancheval')); ?> </a>
                                        </li>  
        
                                       <?php endif; ?>
                                      
                                    </ul>
                            
        
                            </ul>
                        </li>
                    
                           <?php endif; ?>


                     <li class="submenu">
                            <a href="#" class="noti-dot"><i class="la la-retweet"></i> <span><?php echo e(__('trans.Leaves (Admin)')); ?></span> <span class="menu-arrow"></span></a>
                                <ul style="display:none;">
                                    <li>
                                        <a class="<?php echo e(Request::is('Leave') ? 'active' : ''); ?>"
                                            href="<?php echo e(route('leaves',$subdomain)); ?>"><?php echo e(__('trans.Leaves (Admin)')); ?></a>
                                    </li>
                                </ul>
                     </li>
                    <?php endif; ?>
                    

                    <?php if($roles['name']=="admin"||$roles['name']=="manger" ||(Session::has('company'))): ?>
                    <li class="submenu">
                            <a href="#" class="noti-dot"><i class="la la-list-ul"></i> <span><?php echo e(__('trans.Task (Admin)')); ?></span> <span class="menu-arrow"></span></a>
                                <ul style="display:none;">
                                <li>
                                    <a class="<?php echo e(Request::is('task') ? 'active' : ''); ?>"
                                        href="<?php echo e(route('task',$subdomain)); ?>"><?php echo e(__('trans.Task (Admin)')); ?></a>
                                </li>
                                </ul>
                      </li>
                        <li class="submenu">
                            <a href="#" class="noti-dot"><i class="la la-dashboard"></i> <span><?php echo e(__('trans.Attendance (Admin)')); ?></span> <span class="menu-arrow"></span></a>
                                <ul style="display:none;">
                                   <?php if($roles['name']!="manger"): ?>
                                        <li>
                                            <a class="<?php echo e(Request::is('workflow') ? 'active' : ''); ?>"
                                                href="<?php echo e(route('workflow',$subdomain)); ?>"><?php echo e(__('trans.Workflow')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <li>
                                        <a class="<?php echo e(Request::is('attendance') ? 'active' : ''); ?>"
                                            href="<?php echo e(route('attendance',$subdomain)); ?>"><?php echo e(__('trans.Attendance (Admin)')); ?></a>
                                    </li>
                                 
                                </ul>
                         </li>
                      
    
                        <li class="submenu">
                            <a href="#" class="noti-dot"><i class="la la-pie-chart"></i> <span><?php echo e(__('trans.Reports')); ?></span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display:none;">
    
                                <li>
                                    <a class="<?php echo e(Request::is('report-department') ? 'active' : ''); ?>"
                                        href="<?php echo e(route('report-department',$subdomain)); ?>"><?php echo e(__('trans.Department Report')); ?></a>
                                </li>
                                
                                <li>
                                    <a class="<?php echo e(Request::is('report-dialy') ? 'active' : ''); ?>"
                                        href="<?php echo e(url('/admin/report-dialy'.'/present')); ?>"><?php echo e(__('trans.Present Dialy Report')); ?></a>
                                </li>
                                <li>
                                    <a class="<?php echo e(Request::is('report-dialy') ? 'active' : ''); ?>"
                                        href="<?php echo e(url('/admin/report-dialy'.'/absent')); ?>"><?php echo e(__('trans.Absent Dialy Report')); ?></a>
                                </li>
                                <li>
                                    <a class="<?php echo e(Request::is('report-dialy') ? 'active' : ''); ?>"
                                        href="<?php echo e(url('/admin/report-dialy').'/late'); ?>"><?php echo e(__('trans.Late Dialy Report')); ?></a>
                                </li>
                                <li>
                                    <a class="<?php echo e(Request::is('report-dialy') ? 'active' : ''); ?>"
                                        href="<?php echo e(url('/admin/report-dialy').'/early'); ?>"><?php echo e(__('trans.Early Dialy Report')); ?></a>
                                </li>
                                <li>
                                    <a class="<?php echo e(Request::is('report-dialy') ? 'active' : ''); ?>"
                                        href="<?php echo e(url('/admin/report-dialy').'/total'); ?>"><?php echo e(__('trans.Total Dialy Report')); ?></a>
                                </li>
                                <li>
                                    <a class="<?php echo e(Request::is('month-report') ? 'active' : ''); ?>"
                                        href="<?php echo e(route('month-report',$subdomain)); ?>"><?php echo e(__('trans.Monthly Report')); ?></a>
                                </li>
                                <li>
                                    <a class="<?php echo e(Request::is('Re') ? 'active' : ''); ?>"
                                        href="<?php echo e(route('visitReport',$subdomain)); ?>"><?php echo e(__('trans.Visit Report')); ?></a>
                                </li>
                                 <li>
                                    <a class="<?php echo e(Request::is('Re') ? 'active' : ''); ?>"
                                        href="<?php echo e(route('evaluation_report',$subdomain)); ?>"><?php echo e(__('trans.evaluation_report')); ?></a>
                                </li>
    
                            </ul>
                        </li>
                    
                    
                     <?php if($roles['name']=="developer"||$roles['name']=="accountant"||$roles['name']=="super_admin"): ?>
                        <li class="submenu">
                            <a href="#"><i class="la la-rocket"></i> <span> <?php echo e(__('trans.All Permissions')); ?></span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                 <?php if($roles['name']!="manger"||$roles['name']=="support"): ?>
                                    <li>
                                        <a class="<?php echo e(Request::is('permissions') ? 'active' : ''); ?>"
                                            href="<?php echo e(route('permission',$subdomain)); ?>"><?php echo e(__('trans.All Permissions')); ?></a>
                                    </li>
                                 <?php endif; ?>
                                    <li>
                                        <a class="<?php echo e(Request::is('roles') ? 'active' : ''); ?>"
                                            href="<?php echo e(route('role',$subdomain)); ?>"><?php echo e(__('trans.All roles')); ?></a>
                                    </li>
    
    
                            </ul>
                        </li>  
                    <?php endif; ?> 
                    <?php if($roles['name']!="manger"): ?>                  
 
                    <li class="submenu">
                        <a href="#"><i class="la la-cube"></i> <span> <?php echo e(__('trans.Application')); ?></span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                          <?php if($roles['name']=="developer"||$roles['name']=="accountant"||$roles['name']=="super_admin"): ?>
                            <li>
                                <a class="<?php echo e(Request::is('view-logs') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('view-logs',$subdomain)); ?>"><?php echo e(__('trans.Failed_operations')); ?></a>
                            </li>
                           <?php endif; ?>
                            <li>
                                <a class="<?php echo e(Request::is('view-logs') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('employee-track',$subdomain)); ?>"><?php echo e(__('trans.employee_mobiles')); ?></a>
                            </li>
                            <li>
                                <a class="<?php echo e(Request::is('track') ? 'active' : ''); ?>" 
                                    href="<?php echo e(route('track',$subdomain)); ?>"><?php echo e(__('trans.employee_track')); ?></a>
                            </li>



                        </ul>
                    </li>
                    <?php endif; ?>
                  
                    <?php endif; ?>

                
                </ul>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/layout/partials/nav.blade.php ENDPATH**/ ?>