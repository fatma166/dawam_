
                 <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>
                       <div class="available col-md-12 col-sm-12 col-12 col-lg-12 col-xl-12"><h1 class="available_title">@if($type=="client"){{__('trans.client_attendance')}}@elseif($type=="branch"){{__('trans.branch_attendance')}}@else {{__('trans.none detected')}}@endif</h1></div>
                         
                        @foreach($attendances as $attendance)
                            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                                <div class="profile-widget">
                                    <div class="profile-img">
                                        <a href="profile" class="avatar"><img src="{{asset($attendance->attend_img)}}" alt=""></a>
                                    </div>
                                    <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="profile">{{$attendance->name}}</a></h4>
                                    <div class="small "> <h5 class="branch_title">{{__('trans.employeebranch')}}:</h5> {{$attendance->branch_title}}</div>
                                    <div class="small ">{{$attendance->time_in}}</div>
                                    <h5 class="branch_title">{{__('trans.attendbranch')}}</h5>
                                    @php  $arr_=json_decode($attendance->attendances_details);if(!empty($arr_))$count_=count((array)$arr_);else $count_=0; @endphp
                                    @php $i=0; $key_index=0;@endphp
                                   @foreach(json_decode($attendance->attendances_details) as $index =>$details)
                                         @if($i==2) <span  class="dots" id="dots_{{$index}}">...</span> <span class="more" id="more{{$index}}"> @php $key_index=$index;@endphp @endif
                                            @if($type=="client") 
                                                <a href="{{$details->client_id}}"> <div class="small">{{$details->client_name}}</div></a>
                                            @endif
                                          @if($type=="branch") 
                                        
                                               <a href="@if(isset($details->branch_id)){{$details->branch_id}}@endif"> <div class="small text-muted">@if(isset($details->branch_name)){{$details->branch_name}}@endif</div></a>
                                          @endif
                                      
                                        @if($count_==$i+1)</span> <button style="@if($i==1||$i==0)visibility:hidden;@endif " onclick="myFunction({{$key_index}})" id="myBtn_{{$key_index}}">{{__('trans.Read more')}}</button> @endif
                                       @php ++$i; @endphp 
                                   @endforeach
                                   @if($type=="not_dected") 
                                    
                                        <div class="small">@if(isset($attendance->address)){{$attendance->address}}@endif</div>
                                   @endif  
                                  
                                   
                                </div>
                            </div>
                          
                          @endforeach  
                   
                    <div class="paginate_available" style="clear: both; float: right;"> {{$attendances->appends($_GET)->links() }}</div> 
                    
                    
@section('script')
<script>

function myFunction(i) {
    
  var dots =document.getElementById("dots_"+i);
  var moreText = document.getElementById("more"+i);
  var btnText = document.getElementById("myBtn_"+i);
  
  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "{{__('trans.Read more')}}";
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "{{__('trans.Read less')}}";
    moreText.style.display = "inline";
  }
}
</script>
@endsection  