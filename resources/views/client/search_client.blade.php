                
                    <div class="col-md-12 clients_result">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table">
                                <thead>
                                    <tr>
                                        
                                        <th>{{__('trans.Name')}}</th>
                                         <th>{{__('trans.Address')}}</th>
                                        <th>{{__('trans.Contact Person')}}</th>
                                        <th class="text-right">{{__('trans.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(!empty($clients))
                                @foreach($clients as $client)
                                    <tr>
                                        <td>    
                                            
                                            <a href="{{url('/admin/client-profile/'.$client->id)}}" class="avatar"></a>
                                                                                             
                                            <h2 class="table-avatar">    
                                                 <!-- <a class="dropdown-item" href="#" data-href="{{ url('admin/client-edit/'.$client->id) }}" client-id="{{$client->id}}"
                                                           data-toggle="modal" data-target="#edit_client">{{$client->name}}</a>-->
                                                 <a  href="{{url('/admin/client-profile/'.$client->id)}}">{{$client->name}}</a>
                                              
                                            </h2>
                                        </td>
                                        <td style="overflow:hidden; display: inline-block;text-overflow: ellipsis;white-space: nowrap;width:200px;}">{{$client->address}}</td>
                                        <td>{{$client->phone}}</td>
                                        <td class="text-right">
                                            <a class="btn btn-outline-success" href="#" data-href="{{ url('admin/client-edit/'.$client->id) }}" client-id="{{$client->id}}" data-toggle="modal" data-target="#edit_client"><i class="fa fa-pencil m-r-5"></i> {{__('trans.Edit')}}</a>
                                           <!-- <a class="btn btn-outline-danger" href="#" data-toggle="modal" data-target="#delete_client" delete-id="{{$client->id}}"><i class="fa fa-trash-o m-r-5"></i> {{__('trans.Delete')}}</a>-->
                                        </td>
                                    </tr>
                                @endforeach
                                @endif 
                                </tbody>
                            </table>
                        </div>
                    </div>
               
                 {{ $clients->appends($_GET)->links() }}                