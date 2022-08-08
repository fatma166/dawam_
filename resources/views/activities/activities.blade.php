@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content">
                
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">{{__('trans.Activities')}}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">{{__('trans.Dashboard')}}</a></li>
                                <li class="breadcrumb-item active">{{__('tran.Activities')}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="activity">
                            <div class="activity-box">
                                <ul class="activity-list">
                                
                                      @foreach($activities as $activity)
                                    
                                           @php 
                                               
                                                    if($activity->type=="change_mac"|| $activity->type=="access_by_new_mac")$href="activities"; elseif($activity->type=="add_client") $href="client"; elseif($activity->type=="make_leave")$href="leaves";
                                                              elseif($activity->type=="add_outdoor"||$activity->type=="end_outdoor")$href="outdoor"; elseif($activity->type=="end_task"||$activity->type=="add_task")$href="task";  
                                                                $date1 =$activity->created_at;
                                                                $date2= Carbon\Carbon::now();
                                                                $difference = $date1->diff($date2);
                                                             // print_r($difference);
                                                                $diffInSeconds = $difference->s; //45
                                                                $diffInMinutes = $difference->i; //23
                                                                $diffInHours   = $difference->h; //8
                                                                $diffInDays    = $difference->d; //21
                                                                $diffInMonths  = $difference->m; //4
                                                                $diffInYears   = $difference->y; //1

                                           
                                           
                                           
                                           
                                            @endphp
                                            <li>
                                                <div class="activity-user">
                                                    <a href="profile" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                                        <img src="img/profiles/avatar-01.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="activity-content">
                                                    <div class="timeline-content">
                                                        <a href="{{$href}}" class="name">{{$activity->name}}</a>  <a href="#">{{$activity->type}}</a>
                                                        <span class="time">@if($diffInMinutes>0){{$diffInMinutes}}{{"min"}}@endif @if($diffInHours>0){{$diffInHours}}{{"hours"}}@endif @if($diffInDays>0) {{$diffInDays}} {{"days"}}@endif @if($diffInMonths>0) {{$diffInMonths}} {{"month"}}@endif @if($diffInYears>0) {{$diffInYears}} {{"years"}}@endif {{__('trans.ago')}}</span>
                                                    </div>
                                                </div>
                                                 @if($activity->type=="change_mac" )  
                                                       <div><form action="{{route('mac_check',$subdomain)}}" method="get"><input type="hidden"  name="notify_id" value="{{$activity->data_id}}" /><input type="hidden"  name="status" value="accept" /><input type="hidden"  name="addtion_data" value="{{$activity->addtion_data}}" /><input type="hidden"  name="id" value="{{$activity->id}}" /><button onclick="change_status_notification({{$activity->id}})">{{__('trans.add')}}</button></form></div>
                                                       <div><form action="{{route('mac_check',$subdomain)}}" method="get"><input type="hidden"  name="notify_id" value="{{$activity->data_id}}" /><input type="hidden"  name="status" value="refused" /><input type="hidden"  name="id" value="{{$activity->id}}" /><button onclick="change_status_notification({{$activity->id}})">{{__('trans.refuse')}}</button></form></div>
                                                 @else
                                                    
                                                     <div><form action="{{route($href,$subdomain)}}" method="get"><input type="hidden"  name="notify__id" value="{{$activity->data_id}}" /><button onclick="change_status_notification({{$activity->id}})">{{__('trans.view')}}</button></form></div>
                                                 @endif
                                            </li>
                                        @endforeach
                          
                                       
                                </ul>
                                {{ $activities->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->

        </div>
        <!-- /Page Wrapper -->
@endsection
@section('script')
     		<script>
       function change_status_notification(notfy_id){
    
           $.ajax({
                    url:"{{route('change_status_notification',$subdomain)}}",
                    type:'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{notfy_id:notfy_id},
                    success: function(data) {
                        
                       if(data.hasOwnProperty('success')){
                
                         //  location.reload(true);
                        }else{
                
                          //  printErrorMsg(data.error);
                        }
                    }
            });
        }
</script>
@endsection('script')