                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                             <table class="table table-striped custom-table mb-0 " id="table_search">
                                <thead>
                                    <tr>
                                        <th >#</th>
                                         <th>{{__('trans.Title')}}</th>
                                        <th>{{__('trans.Target user')}}</th>
                                        <th>{{__('trans.client')}} </th>
                                         <th>{{__('trans.visit_type')}}</th>
                                         <th>{{__('trans.Created_at')}}</th>
                                         <th>{{__('trans.date')}} </th>
                                         <th>{{__('trans.Status')}} </th>
                                        
                                        <!--<th>{{__('trans.Address')}}</th>-->
                                         <th>{{ __('trans.department') }}</th> 
                                         <th>{{ __('trans.branch') }}</th>
                                        
                                       
                                       
                                        <th class="text-right">{{__('trans.Action')}}</th>
                                
                                        <th>{{ __('trans.Add Edit Client') }}</th> 
                                         <th>{{ __('trans.Add Rate') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

                                @foreach($outdoors as $outdoor)
                                    <tr>
                                        <td>{{$outdoor->id}}</td>
                                        <td>{{$outdoor->title}}</td>
                                        <td>{{$outdoor->username}}</td>
                                        <td>{{$outdoor->client_name}}</td>
                                        <td ><!--style="overflow:hidden; display: inline-block;text-overflow: ellipsis;white-space: nowrap;width:200px;"-->
                                              {{$outdoor->visit_type_name}}
                                        </td>
                                       
                                        <td>{{$outdoor->created_at}}</td>
                                        <td>{{$outdoor->date}}</td>
                                        <td>
                                        
                                            <div class="dropdown action-label">
                                                <a class="btn btn-white btn-sm btn-rounded" href="#" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-dot-circle-o @if($outdoor->status=='deliverd'){{'text-purple'}}@elseif($outdoor->status=='pending'){{'text-warning'}}@elseif($outdoor->status=='start'){{'text-success'}}@elseif($outdoor->status=='inprogress'){{'text-warning'}}@elseif($outdoor->status=='done'){{'text-success'}}@else ($outdoor->status=='late'){{'text-danger'}}@endif">@if($outdoor->status=="deliverd")<span>{{__('trans.deliverd')}}</span>@elseif($outdoor->status=="pending")<span>{{__('trans.pending')}}</span>@elseif($outdoor->status=="seen")<span>{{__('trans.seen')}}</span>@elseif($outdoor->status=="inprogress")<span>{{__('trans.in_progress')}}</span>@elseif($outdoor->status=="done")<span>{{__('trans.done')}}</span>@elseif($outdoor->status=="late")<span>{{__('trans.late')}}@endif</span></i>
                                                </a>
                                               <!-- <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"><span>{{__('trans.deliverd')}}</span></i></a>
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"><span> {{__('trans.seen')}}</span></i></a>
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"><span> {{__('trans.in_progress')}}</span></i></a>
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"><span> {{__('trans.done')}}</span></i></a>
                                                    <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"><span>{{__('trans.late')}}</span></i></a>
                                                   
                                                </div>-->
                                            </div>
                                        </td>
                                         
                                       <td>
                                            <h2 class="table-avatar">
                                                
                                             @if (isset($outdoor->dep_title)) {{$outdoor->dep_title}} @endif
                                           
                                            </h2>
                                        </td>  
                                        <td>
                                            <h2 class="table-avatar">
                                                
                                             @if (isset($outdoor->branch_title)) {{$outdoor->branch_title }} @endif
                                           
                                            </h2>
                                       </td>
                                        
                                        <td class="text-right">
                                            <a class="btn btn-outline-success" href="#" data-href="{{ url('admin/outdoor-edit/'.$outdoor->id) }}" outdoor-id="{{$outdoor->id}}"  data-toggle="modal" data-target="#edit_outdoor"><i class="fa fa-pencil m-r-5"></i>{{__('trans.Edit')}}</a>
                                            <a class="btn btn-outline-danger" href="#" data-toggle="modal"  data-target="#delete_outdoor" delete-id="{{$outdoor->id}}"><i class="fa fa-trash-o m-r-5"></i> {{__('trans.Delete')}}</a>
                                        </td>
                                        
                                        <td>
                                               <div class="col-auto float-right ml-auto">
                                                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_edit_client" outdoor_id="{{$outdoor->id}}" data-href="{{ url('admin/outdoor-edit-client/'.$outdoor->id) }}"><i class="fa fa-plus"></i>{{__('trans.Add Edit Client')}} </a>
                                        
                                                </div>
                                       
                                       </td>
                                       <td>
                                               <div class="col-auto float-right ml-auto">
                                                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_edit_rate" outdoor_id="{{$outdoor->id}}" data-href="{{ url('admin/outdoor-edit-client/'.$outdoor->id) }}"><i class="fa fa-plus"></i>{{__('trans.Add Rate')}} </a>
                                        
                                                </div>
                                       
                                       </td>
              
                                    </tr>
                                @endforeach  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{ $outdoors->appends($_GET)->links() }}
                   