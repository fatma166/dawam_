
<thead>
    <tr>
    <th>{{__('trans.Employee ID')}}</th>

        <th>{{ __('trans.Empolyee') }}</th>
        <th>{{__('trans.Mobile')}}</th>
        <th>{{__('trans.Branch')}}</th>
        <th>{{ __('trans.LastLogin') }}</th>
        <th>معلومات الجهاز</th>
        <th>
    </tr>
</thead>
<tbody>
   @foreach($tracking as $data)

        <tr>
            
        <td>
              {{$data->user_id}}
            </td>
            <td>
                <h2 class="table-avatar">
                    <a class="avatar"><img alt="" src="{{asset($data->avatar)}}"></a>
                    <a>{{$data->username}} <span>{{$data->job_title}}</span></a>
                </h2>
            </td>
    

          
            <td>
              {{ $data->phone}}
            </td>
          
            <td>
              {{$data->branch_title}}
            </td>
            <td>
              {{$data->last_login}}
            </td>
            @php
            $list=json_decode($data->device_info);
            @endphp
            @if($list)
           
            <td>{{$list->brand.'~'.$list->app_ver.'~'.$list->os_ver}}</td>
           

           @else
           <td></td> 
           
          @endif

          <td>
              @parse($data->last_login)
            </td>



        
           
      
        </tr>
 @endforeach
 
        

</tbody>


