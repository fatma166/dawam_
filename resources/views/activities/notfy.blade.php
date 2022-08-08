
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
                                                 <?php  
                                                    
                                                    
                                                                                                   
                                                             if($notfy->type=="change_mac" )$href="activities"; elseif($notfy->type=="access_by_new_mac")$href="activities"; elseif($notfy->type=="add_client") $href="client"; elseif($notfy->type=="make_leave")$href="leaves";
                                                              elseif($notfy->type=="add_outdoor"||$notfy->type=="end_outdoor")$href="outdoor"; elseif($notfy->type=="end_task")$href="task";  
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
                                    <li class="notification-message">
                                        <a href="{{$href}}">
                                            <div class="media">
                                                <!--<span class="avatar">
                                                    <img alt="" src="{{asset('img/profiles/avatar-02.jpg')}}">
                                                </span>-->
                                                <div class="media-body">
                                                    <p class="noti-details"><span class="noti-title">{{$notfy->name}}</span> <span class="noti-title">{{$notfy->title}}</span></p>
   
                                                    
                                                    
                                                    <p class="noti-time"><span class="notification-time">@if($diffInMinutes>0){{$diffInMinutes}}{{"min"}}@endif @if($diffInHours>0){{$diffInHours}}{{"hours"}}@endif @if($diffInDays>0) {{$diffInDays}} {{"days"}}@endif @if($diffInMonths>0) {{$diffInMonths}} {{"month"}}@endif @if($diffInYears>0) {{$diffInYears}} {{"years"}}@endif {{__('trans.ago')}}</span></p>
                                                    @if($notfy->type=="change_mac" )  
                                                       <div><form action="{{route('mac_check',$subdomain)}}" method="get"><input type="hidden"  name="notify_id" value="{{$notfy->data_id}}" /><input type="hidden"  name="status" value="accept" /><input type="hidden"  name="addtion_data" value="{{$notfy->addtion_data}}" /><input type="hidden"  name="id" value="{{$notfy->id}}" /><button onclick="change_status_notification({{$notfy->id}})">{{__('trans.add')}}</button></form></div>
                                                       <div><form action="{{route('mac_check',$subdomain)}}" method="get"><input type="hidden"  name="notify_id" value="{{$notfy->data_id}}" /><input type="hidden"  name="status" value="refused" /><input type="hidden"  name="id" value="{{$notfy->id}}" /><button onclick="change_status_notification({{$notfy->id}})">{{__('trans.refuse')}}</button></form></div>
                                                     @else
                                                        
                                                         <div><form action="{{route($href,$subdomain)}}" method="get"><input type="hidden"  name="notify__id" value="{{$notfy->data_id}}" /><button onclick="change_status_notification({{$notfy->id}})">{{__('trans.view')}}</button></form></div>
                                                     @endif
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="{{route('activities',$subdomain)}}">{{__('trans.View all Notifications')}}</a>
                        </div>
                    </div>
                