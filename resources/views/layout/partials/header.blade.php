
<div class="header">

			

            <!-- Logo -->

            <div class="header-left">

                <a href="{{ url('/admin/dashboard') }}" class="logo">

                    <img src="{{asset('img/logo.png')}}" width="110" height="50" alt="">

                </a>


            </div>

            <!-- /Logo -->

            

            <a id="toggle_btn" href="javascript:void(0);">

                <span class="bar-icon">

                    <span></span>

                    <span></span>

                    <span></span>

                </span>

            </a>

            

            <!-- Header Title -->

          

            <!-- /Header Title -->

            

            <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

            

            <!-- Header Menu -->

            <ul class="nav user-menu">

            

                <!-- Search -->

             
                @if(Session::has('company'))
                     <li><button   class="goAllCompanyAdmin" onclick="goAllCompanyAdmin()">{{__('trans.go allcompany admin')}}</button></li>
                @endif
                <!-- /Search -->

            


               <!-- LANG-->
               <li class="nav-item dropdown has-arrow flag-nav">
              
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                        
							<img src="assets/img/flags/us.png" alt="" height="20"> <span>@if(session()->get('lang')=='AR'){{'AR'}}@elseif(session()->get('lang')=='EN'){{'EN'}}@endif</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="javascript:void(0);" onclick="change_lang('EN')" class="dropdown-item">
								<img src="assets/img/flags/us.png" alt="" height="16"> EN
							</a>
							<a href="javascript:void(0);" onclick="change_lang('AR')"class="dropdown-item">
								<img src="assets/img/flags/fr.png" alt="" height="16"> AR
							</a>
				
						</div>
				</li>
            

                <!-- Notifications -->

                <span id="ajax_notfy"></span>

                <li class="nav-item dropdown notfy">

                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">

                        <i class="fa fa-bell-o"></i> <span class="badge badge-pill">{{count($notfys)}}</span>

                    </a>

                    <div class="dropdown-menu notifications">

                        <div class="topnav-dropdown-header">

                            <span class="notification-title">{{__('trans.Notifications')}}</span>

                            <a href="javascript:void(0)" class="clear-noti"> {{__('trans.Clear All')}} </a>

                        </div>

                        <div class="noti-content">

                            <ul class="notification-list">

                            @if($notfys)

                               @foreach($notfys as $notfy)

                                    <li class="notification-message">



                                    <?php if($notfy->type=="task_end") {$url_n=route('/')."/outdoor/outdoor_search?employee_name=".$notfy->name; }else{$url_n="#";}?>

                                        <a href="{{$url_n}}">

                                            <div class="media">

                                               <!-- <span class="avatar">

                                                    <img alt="" src="{{asset('uploads').'/'.$notfy->avatar}}">

                                                </span>-->

                                                <div class="media-body">

                                                    <p class="noti-details"><span class="noti-title">{{$notfy->name}}</span> <span class="noti-title">{{$notfy->title}}</span></p>

                                                    <?php 

                                                                $date1 =$notfy->created_at;

                                                                $date2= Carbon\Carbon::now();

                                                                $difference = $date1->diff($date2);

                                                             // print_r($difference);

                                                                $diffInSeconds = $difference->s; //45

                                                                $diffInMinutes = $difference->i; //23

                                                                $diffInHours   = $difference->h; //8

                                                                $diffInDays    = $difference->d; //21

                                                                $diffInMonths  = $difference->m; //4

                                                                $diffInYears   = $difference->y; //1



                                                    ?>

                                                    

                                                    

                                                    <p class="noti-time"><span class="notification-time">@if($diffInMinutes>0){{$diffInMinutes}}{{"min"}}@endif @if($diffInHours>0){{$diffInHours}}{{"hours"}}@endif @if($diffInDays>0) {{$diffInDays}} {{"days"}}@endif @if($diffInMonths>0) {{$diffInMonths}} {{"month"}}@endif @if($diffInYears>0) {{$diffInYears}} {{"years"}}@endif ago</span></p>

                                                </div>

                                            </div>

                                        </a>

                                    </li>

                                @endforeach

                            @endif

                            </ul>

                        </div>

                        <div class="topnav-dropdown-footer">

                            <a href="activities">{{__('trans.View all Notifications')}}</a>

                        </div>

                    </div>

                </li>

                <!-- /Notifications -->

                





                <li class="nav-item dropdown has-arrow main-drop">

                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">

                        <span class="user-img"><img src="https://thiqah-eg.com/wp-content/uploads/2022/01/team-4-270x315.png" alt="">

                        <span class="status online"></span></span> 

                        <span>{{ Auth::user()->name}}</span>

                    </a> 

                    <div class="dropdown-menu">

                       
                    <a class="dropdown-item" href="{{ route('logout',$subdomain) }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="bx bx-log-out"></i>
                        {{__('trans.Logout')}}
                       
                    </a>
                    <form id="logout-form" action="{{ route('logout',$subdomain) }}" style="display: none;">
                        @csrf
                    </form>

                    </div>

                </li>

            </ul>

            <!-- /Header Menu -->

            

            <!-- Mobile Menu -->

            <div class="dropdown mobile-user-menu">

                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>

                <div class="dropdown-menu dropdown-menu-right">

                    <a class="dropdown-item" href="profile">My Profile</a>

                    <a class="dropdown-item" href="settings">Settings</a>

                    <a class="dropdown-item" href="route('logout')">Logout</a>

                </div>

            </div>

            <!-- /Mobile Menu -->

            

        </div>

