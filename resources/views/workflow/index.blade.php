@extends('layout.mainlayout')
@section('title')
    {{__('trans.workflow')}}
@endsection

@section('content')
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">{{__('trans.workflow')}}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                                <li class="breadcrumb-item active">{{__('trans.workflow')}}</li>
                            </ul>
                        </div>
                  
                       
                            <div class="col-auto float-right ml-auto">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_workflow"><i class="fa fa-plus"></i> {{__('trans.Add Workflow')}}</a>
                            </div>
                       
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                          @if(Session::has('success'))

                                <div class="alert alert-success">

                                    {{ Session::get('success') }}

                                    @php

                                        Session::forget('success');

                                    @endphp

                                </div>

                            @endif

   

                            <div class="row">

                                <div class="col-sm-12">

                                    @if (Session::has('error'))

                                        <p class="alert alert-danger">{{ Session::get('error') }}</p>

                                    @endif

                                </div>
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                                            
                                        <th>{{__('trans.workflow')}}</th>
                                        <th>{{__('trans.show description')}}</th>
                                        <th>{{__('trans.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                               
                                @if((isset($workflows)))
                                      <?php $i=0;?>
                                    @foreach($workflows as $workflow)
                                    @if(!empty($workflow[0]))
                                        <tr class="holiday-completed">
                                        <td>{{__('trans.workflow_setting')}} {{$i+1}}</td>
                                        <td> <a class="btn add-btn" data-toggle="modal" data-href="{{ url('admin/workflow-edit/'.$workflow[0]->shift_id) }}" data-target="#view_workflow_shift" data-number="{{$i}}"> {{__('trans.view')}}</a></td>
                                        
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                      <!-- <a class="dropdown-item"  data-href="{{ url('/admin/workflow-edit/'.$workflow[0]->shift_id) }}" work_flow-id="{{$workflow[0]->shift_id}}"  data-toggle="modal" data-target="#edit_workflow"><i class="fa fa-pencil m-r-5"></i> {{__('trans.Edit')}}</a>-->
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#delete_workflow_shift" delete-id="{{$workflow[0]->shift_id}}"><i class="fa fa-trash-o m-r-5"></i> {{__('trans.Delete')}}</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    <?php $i++; ?>
                                @endforeach
                                @endif
                                   
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
            
            <!-- Add workflow Modal -->
            <div class="modal custom-modal fade" id="add_workflow" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Add Workflow')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('store-workflow',$subdomain)}}" method="get">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="col-form-label">{{__('trans.shift')}} <span class="text-danger">*</span></label>
                                        <select class="form-control" name="shift_id">
                                            @foreach($shifts as $shift)
                                                 <option value="{{$shift->id}}">{{$shift->description}}-{{$shift->time_from}}-{{$shift->time_to}} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="overflow"  class=" col-sm-12 col-lg-12 col-md-12">
                                    <div class=" col-sm-12 col-lg-12 col-md-12" style="border:1px solid">
                                            <div class="col-sm-6 col-lg-6 col-md-6">
                                                <label class="col-form-label">{{__('trans.type')}} <span class="text-danger">*</span></label>
                                                <select class="form-control" name="type[]">
                                                    <option value="overtime">{{__('trans.overtime')}} </option>
                                                    <option value="before_leave">{{__('trans.beforetime')}} </option>
                                                    <option value="late">{{__('trans.late')}} </option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 col-lg-6 col-md-6">
                                                <label class="col-form-label">{{__('trans.mints')}} <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number" name="mints[]">
                                            </div>
                                            <div class="col-sm-6 col-lg-6 col-md-6">
                                                <label class="col-form-label">{{__('trans.hours')}} <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number" name="hours[]">
                                            </div>
                                            <div class="col-sm-6 col-lg-6 col-md-6">
                                                <label class="col-form-label">{{__('trans.desc')}} <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="desc[]">
                                            </div>
                                            
                                    </div>
                                    
                                    </div>
                                    <span id="insertAfterBtn" onclick="add_flow();"><i class="fa fa-th">{{__('trans.Add')}}</i></span>  
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">{{__('trans.Submit')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Holiday Modal -->
            
            <!-- Edit Holiday Modal -->
            <div class="modal custom-modal fade" id="edit_workflow" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Workflow</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form  method="post">
                            @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="col-form-label">{{__('trans.shift')}} <span class="text-danger">*</span></label>
                                        <select class="form-control" name="shift_id">
                                            @foreach($shifts as $shift)
                                                 <option value="{{$shift->id}}">{{$shift->description}}-{{$shift->time_from}}-{{$shift->time_to}} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="overflow"  class=" col-sm-12 col-lg-12 col-md-12">
                                    <div class="edit_workflow_append">
                                            
                                    </div>
                                    
                                    </div>
                                    <span id="insertAfterBtn" onclick="add_flow();"><i class="fa fa-th">{{__('trans.Add')}}</i></span>  
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">{{__('trans.Submit')}}</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit workflow Modal -->
            	<!-- view_workflow Modal -->

                <div class="modal custom-modal fade" id="view_workflow_shift" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        		<div class="modal-header">
    								<h5 class="modal-title" style="text-align: center;">{{__('trans.view workflow')}}</h5>
    								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    									<span aria-hidden="true">&times;</span>
    								</button>
    							</div>
    							<div class="modal-body">
    								<div class="row">
    									
    										<div class="punch-status col-md-12 col-sm-12">
                                               <div class="view_workflow_append"></div>
    						
    										</div>
    								</div>
    							</div>
                        </div>
                    </div>
            </div>
				<!-- /view_workflow Modal -->
            <!-- Delete workflow Modal -->
            <div class="modal custom-modal fade" id="delete_workflow_shift" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>{{__('trans.Delete workflow shift')}}</h3>
                                <p>{{__('trans.Are you sure want to delete?')}}</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary workflow-continue-btn" continue_del="">{{__('trans.Delete')}}</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">{{__('trans.Cancel')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Delete workflow Modal -->

        </div>
        <!-- /Page Wrapper -->
@endsection