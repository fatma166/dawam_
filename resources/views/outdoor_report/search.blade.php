               
                <div class="row" >
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 " id="table_search">
                                <thead>
                                    <tr>
                                        <th>{{__('trans.Visit Title')}}</th>
                                        <th>{{__('trans.Employee')}}</th>
                                         <th>{{__('trans.Client')}}</th>
                                        <!-- <th>{{__('trans.Client Address')}}</th>-->
                                       
                                        <th>{{__('trans.visit_type')}}</th>
                                        <th>{{__('trans.Client Contact Phone')}}</th>
                                       <!-- <th>{{__('trans.Created Date')}}</th>-->
                                        <th>{{__('trans.time_in')}}</th>
                                        <th>{{__('trans.time_out')}}</th>
                                     
                                        <th>{{__('trans.Visit Date')}}</th>
                                        <th>{{__('trans.Status')}}</th>
                                        <th>{{__('trans.is_registered')}}</th>
                                        <th>{{__('trans.Show Details')}}</th>
                                        <th>{{ __('trans.department') }}</th> 
                                        <th>{{ __('trans.branch') }}</th>
                                        <th>{{__('trans.Rate')}}</th>
                                        <th>{{ __('trans.Add Edit Client') }}</th>  

                                    </tr>
                                </thead>
                                <tbody>
                                 <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

                                 @foreach($outdoors as $outdoor)
                                    <tr>
                                   
                                        <td>
                                            <strong>{{$outdoor->title}}</strong>
                                        </td>
                                        <td> <a href="profile" class="avatar avatar-xs">
                                                <img src="img/profiles/avatar-04.jpg" alt="">
                                             </a>
                                             <h2><a href="profile">{{$outdoor->name}}</a></h2>
                                        </td>
                                        <td>
                                              {{$outdoor->client_name}}
                                        </td>
                                        <td ><!--style="overflow:hidden; display: inline-block;text-overflow: ellipsis;white-space: nowrap;width:200px;"-->
                                              {{$outdoor->visit_type_name}}
                                        </td>
                                        <td>
                                              {{$outdoor->contact_phone}}
                                        </td>
                                        <td>
                                              {{$outdoor->time_in}}
                                        </td>
                                        <td>
                                              {{$outdoor->time_out}}
                                        </td>
                                        <td>
                                              {{$outdoor->visit_date}}
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown action-label">
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                    <i class='fa fa-dot-circle-o @if($outdoor->status=="pending") {{'text-danger'}} @elseif($outdoor->status=="done"){{'text-success'}}@endif'></i> {{$outdoor->status}}
                                                </a>

                                            </div>
                                        </td>
                                       <td class="text-center">
                                            @if($outdoor->is_registered==1){{__('trans.done')}}@else {{__('trans.No')}}@endif
                                            
                                        </td>
                                        <td> 
                                        	
											<span class="first-off"><a href="javascript:void(0);" data-toggle="modal" visit_id="{{$outdoor->id}}" user_id="{{$outdoor->user_id}}" data-target="#visit_info"><i class="fa fa-check text-success"></i></a></span> 
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
                                       <td>
                                            <h2 class="table-avatar">
                                                
                                             @if (isset($outdoor->rate)) {{$outdoor->rate}} @endif  %
                                           
                                            </h2>
                                      </td>
                                      <td>
                                               <div class="col-auto float-right ml-auto">
                                                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_edit_client" outdoor_id="{{$outdoor->id}}" data-href="{{ url('admin/outdoor-edit-client/'.$outdoor->id) }}"><i class="fa fa-plus"></i>{{__('trans.Add Edit Client')}} </a>
                                        
                                                </div>
                                       
                                       </td> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{ $outdoors->appends($search)->links() }}