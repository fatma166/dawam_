                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 " id="table_search">
                                <thead>
                                    <tr>
                                        <th>{{__('trans.Employee')}}</th>
                                        <th>{{__('trans.Leave Type')}}</th>
                                        <th>{{__('trans.From')}}</th>
                                        <th>{{__('trans.To')}}</th>
                                        <th>{{__('trans.No of Days')}}</th>
                                        <th>{{__('trans.Reason')}}</th>
                                         <th>{{__('trans.reply')}}</th>
                                        <th class="text-center">{{__('trans.Status')}}</th>
                                        <th class="text-right">{{__('trans.Actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

                                 @foreach($leaves as $leave)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile" class="avatar"><img alt="" src="img/profiles/avatar-09.jpg"></a>
                                                <a href="#">{{$leave->user_name}} <span></span></a>
                                            </h2>
                                        </td>
                                        <td>{{$leave->name}}</td>
                                        <td>{{$leave->leave_from}}</td>
                                        <td>{{$leave->leave_to}}</td>
                                        <td>{{$leave->days}}</td>
                                        <td>{{$leave->leave_reson}}</td>
                                        <td>{{$leave->answer}}</td>
                                        <td class="text-center">
                                            <div class="dropdown action-label">
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-dot-circle-o @if($leave->status=='refused') {{'text-danger'}} @else {{'text-success'}}@endif">
                                                        <span>{{$leave->status}}</span>
                                                    </i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">

                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#stutas_leave" leave-id="{{$leave->id}}" status="accepted"><i class="fa fa-dot-circle-o text-success"><span> {{__('trans.Accepted')}}</span></i></a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#stutas_leave" status="refused" leave-id="{{$leave->id}}" ><i class="fa fa-dot-circle-o text-danger"><span></span>{{__('trans.Refused')}}</i></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-outline-success" href="#" data-href="{{ url('admin/leaves-edit/'.$leave->id) }}" leave-id="{{$leave->id}}" data-toggle="modal" data-target="#edit_leave">
                                                <i class="fa fa-pencil m-r-5"></i>{{__('trans.Edit')}}</a>
                                            <a class="btn btn-outline-danger" delete-id="{{$leave->id}}" href="#" data-toggle="modal"  data-target="#delete_leave">
                                                <i class="fa fa-trash-o m-r-5"></i>{{__('trans.Delete')}}
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                   
                                 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>