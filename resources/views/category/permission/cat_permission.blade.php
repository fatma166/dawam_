<div class="col-sm-12">      
    <label for="permission">{{__('trans.permission')}}</label><br>
    <a href="#" class="permission-select-all">{{__('trans.all')}}</a> / <a href="#"  class="permission-deselect-all">{{__('trans.cancle')}}</a>
    <ul class="permissions checkbox" id="check_permission">    
    @foreach($permissions as $key=>$permission)
            <li>
                <input type="checkbox" id="{{$key}}" class="permission-group">
                <label for="{{$key}}"><strong>{{$key}}</strong></label>
                <ul>
                      @foreach($permission as $perm)
                        <li>  
                            <input type="checkbox" id="permission-1" name="permission[{{$perm->id}}]"  key="{{$key}}" class="perm_class the-permission {{$key}} " value="{{$perm->id}}" >
                            <label for="permission-1">{{$perm->key}}</label>
                        </li>  
                      @endforeach
                         
               </ul>
            </li>
    @endforeach
    </ul>
</div>