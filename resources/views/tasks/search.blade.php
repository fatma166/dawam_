                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 " >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('trans.Title')}}</th>
                                        <th>{{__('trans.Target user')}}</th>
                                        <th>{{__('trans.Description')}} </th>  
                                        <th>{{__('trans.Status')}} </th>
                                        <th>{{__('trans.Created_at')}}</th>
                                        <th>{{__('trans.Due Date')}}</th>
                                        <th class="text-right">{{__('trans.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{$task->id}}</td>
                                        <td>{{$task->title}}</td>
                                        <td>{{$task->username}}</td>
                                        <td style="font-family: monospace;width: 2ch;overflow: hidden;white-space: nowrap;">{{$task->description}}</td>
                                        <td>
                                        
                                            <div class="dropdown action-label">
                                                
                                              <i class="fa fa-dot-circle-o @if($task->status=='delivered'||$task->status=='done'){{'text-success'}}@else{{'text-danger'}}@endif "> @if($task->status=='delivered'){{__('trans.deliverd')}}@elseif($task->status=="pending"){{__('trans.pending')}}@elseif($task->status=="seen"){{__('trans.seen')}}@elseif($task->status=="in_progress"){{__('trans.in_progress')}}@elseif($task->status=="done"){{__('trans.done')}}@elseif($task->status=="late"){{__('trans.late')}}@else ($task->status=="late")@endif</i>
                        
                                            </div>
                                        </td>
                                        <td>{{$task->created_at}}</td>
                                        <td>{{$task->due_date}}</td>

                                        <td class="text-right">
                                            <a class="btn btn-outline-success" href="#" data-href="{{ url('admin/task-edit/'.$task->id) }}" task-id="{{$task->id}}"  data-toggle="modal" data-target="#edit_task"><i class="fa fa-pencil m-r-5"></i>{{__('trans.Edit')}}</a>
                                            <a class="btn btn-outline-danger" href="#" data-toggle="modal"  data-target="#delete_task" delete-id="{{$task->id}}"><i class="fa fa-trash-o m-r-5"></i> {{__('trans.Delete')}}</a>
                                        </td>
                                    </tr>
                                    
                                @endforeach 
                                @if(empty($tasks))
                                <tr>{{__('trans.no result')}}</tr>
                                
                                @endif 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 {{ $tasks->appends($_GET)->links() }}