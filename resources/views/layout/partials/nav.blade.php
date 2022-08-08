<div class="main-wrapper">
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
       
                
		            <li class="{{ Request::is('/') ? 'active' : '' }}"> <a  href="{{ url('/admin/dashboard') }}"> {{__('trans.Dashboard')}}</a></li>
                   <!-- <li class="menu-title">
                        <span>{{__('trans.Companies')}}</span>
                    </li>-->


              
    				<li class="submenu">
						<a href="#" class="noti-dot subdrop"><i class="la la-cog"></i> <span>{{__('trans.Setting')}}</span> <span class="menu-arrow"></span></a>
					      <ul style="display:block;">
                             @if($roles['name']!="manger"||$roles['name']=="support")
                                 <li>
                                 
                                    <a class="{{ Request::is('admin/companies') ? 'active' : '' }}"
                                        href="{{ route('company',$subdomain) }}"><i class="la la-bank"></i> {{__('trans.All Companies')}}</a>
                                    
                                </li>
                              @if($roles['name']=="manger"||($roles['name']=="admin")|| (Session::has('company'))) 
                                <li>
                                    <a class="{{ Request::is('admin/employee/edit_admin') ? 'active' : '' }}"
                                        href="{{ route('AdminUser',$subdomain) }}"><i class="la la-edit"></i> {{__('trans.editAdminData')}}</a>
                                    
                                </li>
                               @endif
                              @endif
                              @if(($roles['name']=="developer"||$roles['name']=="accountant"||$roles['name']=="super_admin")&&(!Session::has('company')))
                             
                                    <li class="submenu">
                                        <a href="#"><i class="la la-hand-o-up"></i> <span> {{__('trans.Subscriptions')}} </span> <span
                                        class="menu-arrow"></span></a>
                                        <ul style="display: none;">
        
                                            <li>
                                                <a class="{{ Request::is('admin/subscribe_index') ? 'active' : '' }}"
                                                    href="{{ route('subscribe-index',$subdomain) }}"> {{__('trans.Subscriptions (Company)')}} </a>
                                            </li>                       
        
                                           <!-- <li>
                                                <a class="{{ Request::is('subscriptions-company') ? 'active' : '' }}"
                                                    href="{{ route('subscribe-index',$subdomain) }}"> {{__('trans.Subscriptions (Company)')}} </a>
                                            </li>-->
        
                                            <li>
                                                <a class="{{ Request::is('admin/company_subscribe') ? 'active' : '' }}"
                                                    href="{{ route('company-subscribe',$subdomain) }}">{{__('trans.Subscribed Value')}} </a>
                                            </li>
        
        
                                        </ul>
                                    </li>
                                    <li class="submenu">
                                            <a href="#"><i class="la la-rocket"></i> <span> {{__('trans.Representative')}}</span> <span
                                                    class="menu-arrow"></span></a>
                                            <ul style="display: none;">
                    
                                                <li class="{{ Request::is('admin/representative') ? 'active' : '' }}">
                                                    <a href="{{ route('representative',$subdomain) }}"><i class="la la-users"></i> <span>{{__('trans.Representatives')}}</span></a>
                                                </li>
                    
                    
                                            </ul>
                                    </li>
                    
                                    <li>
                                        <a class="{{ Request::is('admin/payment') ? 'active' : '' }}"
                                           href="{{ route('payment',$subdomain) }}">{{__('trans.All payment')}}</a>
                                            
                                    </li>  
                                @endif
                                @if($roles['name']=="developer"||$roles['name']=="super_admin"&& !(Session::has('company')))
                                    <li>
                                        <a class="{{ Request::is('admin/bank') ? 'active' : '' }}"
                                           href="{{ route('bank',$subdomain) }}">{{__('trans.All bank')}}</a>
                                        
                                    </li>
                                  <!-- <li>
                                        <a class="{{ Request::is('methods') ? 'active' : '' }}"
                                           href="{{ route('method',$subdomain) }}">{{__('trans.All method')}}</a>
                                        
                                    </li>-->
                                    <li>
                                        <a class="{{ Request::is('admin/category') ? 'active' : '' }}"
                                           href="{{ route('category',$subdomain) }}">{{__('trans.All category')}}</a>
                                        
                                    </li>
                                @endif
                                @if(($roles['name']=="admin")|| (Session::has('company')))
                                        @if($roles['name']!="manger")
                                            <li>
                                                <a class="{{ Request::is('admin/branchs') ? 'active' : '' }}"
                                                    href="{{ route('branch',$subdomain) }}"><i class="la la-map"></i> {{__('trans.Branches')}}</a>
                                                
                                            </li>
                                            <li>
                                                <a class="{{ Request::is('admin/departments') ? 'active' : '' }}"
                                                    href="{{ route('department',$subdomain) }}"><i class="la la-sitemap"></i>  {{__('trans.Departments')}}</a>
                                                
                                            </li>
                                        @endif
                                        <li>
                                            <a class="{{ Request::is('admin/shift') ? 'active' : '' }}"
                                                href="{{route('shift',$subdomain) }}"><i class="la la-history"></i>  {{__('trans.Shifts')}}</a>
                                        </li>
                      
                 
                                         @if($roles['name']!="manger")
                							<li>
                                                <a class="{{ Request::is('admin/jobs') ? 'active' : '' }}"
                                                    href="{{ route('job',$subdomain) }}"><i class="la la-user-secret"></i>  {{__('trans.Jobs')}}</a>
                                            </li>
                
                                            <li>
                                                <a class="{{ Request::is('admin/exception-holidays') ? 'active' : '' }}"
                                                    href="{{route('exception-holidays',$subdomain) }}"><i class="la la-dot-circle-o"></i>  {{__('trans.ExceptionHolidays')}}</a>
                                            </li>
                                             <li>
                                                <a class="{{ Request::is('admin/fixed-holidays') ? 'active' : '' }}"
                                                    href="{{route('fixed-holidays',$subdomain) }}"><i class="la la-dot-circle-o"></i>  {{__('trans.FixedHolidays')}}</a>
                                            </li>
        
                                         @endif
                                   @endif
                                   @if(($roles['name']=="manger")||($roles['name']=="admin")|| (Session::has('company')))
                                      <!--  <li>
                                            <a class="{{ Request::is('user_shift') ? 'active' : '' }}"
                                                href="{{route('user_shift_index',$subdomain) }}">{{__('trans.User Shifts')}}</a>
                                        </li>-->
            
                                   @endif
                                   @if($roles['name']=="manger"||($roles['name']=="admin")|| (Session::has('company'))) 
                                        <!--<li>
                                            <a class="{{ Request::is('Leave') ? 'active' : '' }}"
                                                href="{{ route('leaves',$subdomain) }}">{{__('trans.Leaves (Admin)')}}</a>
                                        </li>-->
            
                                         @if($roles['name']!="manger")
                                            <li >
                                                <a class="{{ Request::is('admin/leave/leave-settings') ? 'active' : '' }}"
                                                    href="{{ route('leave-settings',$subdomain) }}"><i class="la la-dot-circle-o"></i> {{__('trans.Leave Settings')}}</a>
                                            </li>
                                          @endif                        
                                        <li>
                                            <a class="{{ Request::is('admin/outdoor-type') ? 'active' : '' }}"
                                                href="{{ route('outdoor-type',$subdomain) }}"><i class="la la-dot-circle-o"></i> {{__('trans.Outdoor Type')}}</a>
                                        </li>

                                    @endif

    
                            </ul>
                    </li>
                    

                   @if($roles['name']=="manger"||($roles['name']=="admin")|| (Session::has('company'))) 
                   <li class="submenu">
                        <a href="#" class="noti-dot"><i class="la la-check-circle-o"></i> <span> {{__('trans.available')}} </span> <span
                        class="menu-arrow"></span></a>
                        <ul style="display: none;">

                            <li>
                                <a class="{{ Request::is('admin/attendance/employee_available/client') ? 'active' : '' }}"
                                    href="{{ url('/admin/attendance/employee_available/'.'client') }}" >{{__('trans.client_attendance')}} </a>
                            </li>                       

                          
                             <li>
                                <a class="{{ Request::is('admin/attendance/employee_available/branch') ? 'active' : '' }}"
                                    href="{{ url('/admin/attendance/employee_available/'.'branch') }}"> {{__('trans.branch_attendance')}} </a>
                            </li>  
                          
                            <li>
                                <a class="{{ Request::is('admin/attendance/employee_available/not_dected') ? 'active' : '' }}"
                                    href="{{ url('/admin/attendance/employee_available/'.'not_dected') }}"> {{__('trans.none detected')}} </a>
                            </li>  

                        </ul>
                    </li>
                  
                  
                    <li class="submenu">
                            <a href="#" class="noti-dot"><i class="la la-user-plus"></i> <span>{{__('trans.All Employees')}}</span> <span class="menu-arrow"></span></a>
                                <ul style="display:none;">
                               
                                        <li>
                                            <a class="{{ Request::is('admin/employees') ? 'active' : '' }}"
                                                href="{{ route('employee',$subdomain) }}">{{__('trans.Total_ Employees')}}</a>
                                        </li>
                                </ul>
                     </li>
                     <li class="submenu">
                            <a href="#" class="noti-dot"><i class="la la-history"></i> <span>{{__('trans.User Shifts')}}</span> <span class="menu-arrow"></span></a>
                                <ul style="display:none;">
                                        <li>
                                            <a class="{{ Request::is('admin/usershift') ? 'active' : '' }}"
                                                href="{{route('user_shift_index',$subdomain) }}">{{__('trans.User Shifts')}}</a>
                                        </li>
                                </ul>
                     </li>
                     
                     <li class="submenu">
                            <a href="#"><i class="la la-briefcase"></i> <span> {{__('trans.Clients')}}</span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                               
                                <li>
                                    <a class="{{ Request::is('admin/client_type') ? 'active' : '' }}"
                                        href="{{ route('client_type',$subdomain) }}">{{__('trans.Client_types')}}</a>
                                </li>
                                <li>
                                            <a class="{{ Request::is('admin/specializations') ? 'active' : '' }}"
                                                href="{{ route('specializations',$subdomain) }}"><i class="la la-dot-circle-o"></i> {{__('trans.Specializations')}}</a>
                                </li>
                                <li class="{{ Request::is('admin/clients') ? 'active' : '' }}">
                                    <a href="{{ route('client',$subdomain) }}"><i class="la la-users"></i> <span>{{__('trans.Clients')}}</span></a>
                                </li>
    
    
                            </ul>
                        </li>  
                        <li class="submenu">
                            <a href="#" class="noti-dot"><i class="la la-car"></i> <span> {{__('trans.Outdoors')}}</span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display:none;">
    
                                <li>
                                    <a class="{{ Request::is('admin/outdoor') ? 'active' : '' }}"
                                        href="{{ route('outdoor',$subdomain) }}">{{__('trans.Outdoors')}}</a>
                                </li>
      
                                <li>
                                    <a class="{{ Request::is('admin/outdoor_question') ? 'active' : '' }}"
                                        href="{{ route('outdoor-question',$subdomain) }}">{{__('trans.Outdoor question')}}</a>
                                </li>
                                {{-- <!--<li>
                                    <a class="{{ Request::is('Re') ? 'active' : '' }}"
                                        href="{{ route('visitReport') }}">{{__('trans.Visit Report')}}</a>
                                </li>--> --}}
                            </ul>
                        </li>
                        @if($roles['name']=="manger"||($roles['name']=="admin")|| (Session::has('company'))) 
                          <li class="submenu">
                            <a href="#"><i class="la la-hand-o-up"></i> <span> {{__('trans.evaluation')}} </span> <span
                            class="menu-arrow"></span></a>
                            <ul style="display: none;">
        
                                <li>
                                    <a class="{{ Request::is('admin/elements-evaluation') ? 'active' : '' }}"
                                        href="{{ route('evaluations',$subdomain) }}"> {{__('trans.elements-evaluation')}} </a>
                                </li>                       
        
                              
                                 <li>
                                    <a class="{{ Request::is('admin/evaluation_jobs') ? 'active' : '' }}"
                                        href="{{ route('evaluation_jobs',$subdomain) }}"> {{__('trans.evaluation_jobs')}} </a>
                                </li>  
                              
                                <li>
                                    <a class="{{ Request::is('admin/evaluation_employes') ? 'active' : '' }}"
                                        href="{{ route('evaluation_employes',$subdomain) }}"> {{__('trans.evaluation_employes')}} </a>
                                </li>  
        
                             
        
                                <a href="#"><i class="la la-hand-o-up"></i> <span> {{__('trans.Chart_evaluation')}} </span> <span
                                    class="menu-arrow"></span></a>
                                    <ul style="display: none;">
                                       @if($roles['name']!="manger")
                                         
                                        <li>
                                    
                                            <a class="{{ Request::is('admin/showevaluation_employes') ? 'active' : '' }}"
                                                href="{{ route('showevaluation_employes',$subdomain) }}"> {{__('trans.Show_Employe_Evaluation')}} </a>
                                        </li>  
                                        <li>
                                            <a class="{{ Request::is('admin/job_chart') ? 'active' : '' }}"
                                                href="{{ route('job_chart',$subdomain) }}"> {{__('trans.ShowJob_ChartEvalaution')}} </a>
                                        </li>  
                                        <li>
                                            
                                            <a class="{{ Request::is('admin/showdeparteval') ? 'active' : '' }}"
                                                href="{{ route('showdeparteval',$subdomain) }}"> {{__('trans.showdeparteval')}} </a>
                                        </li>  
                                        <li>
                                            
                                            <a class="{{ Request::is('admin/showbrancheval') ? 'active' : '' }}"
                                                href="{{ route('showbrancheval',$subdomain) }}"> {{__('trans.showbrancheval')}} </a>
                                        </li>  
        
                                       @endif
                                      
                                    </ul>
                            
        
                            </ul>
                        </li>
                    
                           @endif


                     <li class="submenu">
                            <a href="#" class="noti-dot"><i class="la la-retweet"></i> <span>{{__('trans.Leaves (Admin)')}}</span> <span class="menu-arrow"></span></a>
                                <ul style="display:none;">
                                    <li>
                                        <a class="{{ Request::is('admin/leaves') ? 'active' : '' }}"
                                            href="{{ route('leaves',$subdomain) }}">{{__('trans.Leaves (Admin)')}}</a>
                                    </li>
                                </ul>
                     </li>
                    @endif
                    

                    @if($roles['name']=="admin"||$roles['name']=="manger" ||(Session::has('company')))
                    <li class="submenu">
                            <a href="#" class="noti-dot"><i class="la la-list-ul"></i> <span>{{__('trans.Task (Admin)')}}</span> <span class="menu-arrow"></span></a>
                                <ul style="display:none;">
                                <li>
                                    <a class="{{ Request::is('admin/task') ? 'active' : '' }}"
                                        href="{{ route('task',$subdomain) }}">{{__('trans.Task (Admin)')}}</a>
                                </li>
                                </ul>
                      </li>
                        <li class="submenu">
                            <a href="#" class="noti-dot"><i class="la la-dashboard"></i> <span>{{__('trans.Attendance (Admin)')}}</span> <span class="menu-arrow"></span></a>
                                <ul style="display:none;">
                                   @if($roles['name']!="manger")
                                        <li>
                                            <a class="{{ Request::is('admin/workflow') ? 'active' : '' }}"
                                                href="{{route('workflow',$subdomain) }}">{{__('trans.Workflow')}}</a>
                                        </li>
                                    @endif
                                    <li>
                                        <a class="{{ Request::is('admin/attendance') ? 'active' : '' }}"
                                            href="{{ route('attendance',$subdomain) }}">{{__('trans.Attendance (Admin)')}}</a>
                                    </li>
                                 
                                </ul>
                         </li>
                      
    
                        <li class="submenu">
                            <a href="#" class="noti-dot"><i class="la la-pie-chart"></i> <span>{{__('trans.Reports')}}</span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display:none;">
    
                                <li>
                                    <a class="{{ Request::is('admin/report-department') ? 'active' : '' }}"
                                        href="{{ route('report-department',$subdomain) }}">{{__('trans.Department Report')}}</a>
                                </li>
                                
                                <li>
                                    <a class="{{ Request::is('admin/report-dialy') ? 'active' : '' }}"
                                        href="{{ url('/admin/report-dialy'.'/present') }}">{{__('trans.Present Dialy Report')}}</a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('admin/report-dialy') ? 'active' : '' }}"
                                        href="{{ url('/admin/report-dialy'.'/absent') }}">{{__('trans.Absent Dialy Report')}}</a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('report-dialy') ? 'active' : '' }}"
                                        href="{{ url('/admin/report-dialy').'/late' }}">{{__('trans.Late Dialy Report')}}</a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('admin/report-dialy') ? 'active' : '' }}"
                                        href="{{ url('/admin/report-dialy').'/early' }}">{{__('trans.Early Dialy Report')}}</a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('admin/report-dialy') ? 'active' : '' }}"
                                        href="{{ url('/admin/report-dialy').'/total' }}">{{__('trans.Total Dialy Report')}}</a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('admin/month-report') ? 'active' : '' }}"
                                        href="{{ route('month-report',$subdomain) }}">{{__('trans.Monthly Report')}}</a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('admin/visitReport') ? 'active' : '' }}"
                                        href="{{ route('visitReport',$subdomain) }}">{{__('trans.Visit Report')}}</a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('admin/visitTypeReport') ? 'active' : '' }}"
                                        href="{{ route('visitTypeReport',$subdomain) }}">{{__('trans.Visit Type Report')}}</a>
                                </li>
                                 <li>
                                    <a class="{{ Request::is('admin/Evaluation_Report') ? 'active' : '' }}"
                                        href="{{ route('evaluation_report',$subdomain) }}">{{__('trans.evaluation_report')}}</a>
                                </li>
    
                            </ul>
                        </li>
                    
                    
                     @if($roles['name']=="developer"||$roles['name']=="accountant"||$roles['name']=="super_admin")
                        <li class="submenu">
                            <a href="#"><i class="la la-rocket"></i> <span> {{__('trans.All Permissions')}}</span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                 @if($roles['name']!="manger"||$roles['name']=="support")
                                    <li>
                                        <a class="{{ Request::is('admin/permissions') ? 'active' : '' }}"
                                            href="{{ route('permission',$subdomain) }}">{{__('trans.All Permissions')}}</a>
                                    </li>
                                 @endif
                                    <li>
                                        <a class="{{ Request::is('admin/roles') ? 'active' : '' }}"
                                            href="{{ route('role',$subdomain) }}">{{__('trans.All roles')}}</a>
                                    </li>
    
    
                            </ul>
                        </li>  
                    @endif 
                    @if($roles['name']!="manger")                  
 
                    <li class="submenu">
                        <a href="#"><i class="la la-cube"></i> <span> {{__('trans.Application')}}</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                          @if($roles['name']=="developer"||$roles['name']=="accountant"||$roles['name']=="super_admin")
                            <li>
                                <a class="{{ Request::is('admin/view-logs') ? 'active' : '' }}"
                                    href="{{ route('view-logs',$subdomain) }}">{{__('trans.Failed_operations')}}</a>
                            </li>
                           @endif
                            <li>
                                <a class="{{ Request::is('admin/employee/track') ? 'active' : '' }}"
                                    href="{{ route('employee-track',$subdomain) }}">{{__('trans.employee_mobiles')}}</a>
                            </li>
                            <li>
                                <a class="{{ Request::is('admin/track') ? 'active' : '' }}" 
                                    href="{{ route('track',$subdomain) }}">{{__('trans.employee_track')}}</a>
                            </li>



                        </ul>
                    </li>
                    @endif
                  
                    @endif

                
                </ul>
            </div>
        </div>
    </div>
</div>
