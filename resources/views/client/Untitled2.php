@extends('layout.mainlayout')
@section('title')
    {{__('trans.clients')}}
@endsection

@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">{{__('trans.Clients')}}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">{{__('trans.Dashboard')}}</a></li>
                                <li class="breadcrumb-item active">{{__('trans.Clients')}}</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_client"><i class="fa fa-plus"></i> {{__('trans.Add Client')}}</a>
                            <div class="view-icons">
                                <a href="clients" class="grid-view btn btn-link" title="{{__('trans.grid')}}"><i class="fa fa-th"></i></a>
                                <a href="clients-list" class="list-view btn btn-link active" title="{{__('trans.list')}}"><i class="fa fa-bars"></i></a>
                            
                            
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                

                @if(Session::has('success'))

                    <div class="alert alert-success">

                        {{ Session::get('success') }}

                        @php

                            Session::forget('success');

                        @endphp

                    </div>

                @endif


                @if(Session::has('error'))

                    <div class="alert alert-success">

                        {{ Session::get('error') }}
                    </div>

                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table datatable" id="table_search">
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
                                            <h2 class="table-avatar">
                                                <a href="{{url('/admin/client-profile/'.$client->id)}}" class="avatar"></a>
                                                <a href="{{url('/admin/client-profile/'.$client->id)}}">{{$client->name}}</a>
                                            </h2>
                                        </td>
                                        <td>{{$client->address}}</td>
                                        <td>{{$client->phone}}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#" data-href="{{ url('admin/client-edit/'.$client->id) }}" client-id="{{$client->id}}" data-toggle="modal" data-target="#edit_client"><i class="fa fa-pencil m-r-5"></i> {{__('trans.Edit')}}</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_client" delete-id="{{$client->id}}"><i class="fa fa-trash-o m-r-5"></i> {{__('trans.Delete')}}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
        
            <!-- Add Client Modal -->
            <div id="add_client" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Add Client')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form action="{{route('store-client')}}" >
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Name')}} <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.phone')}}</label>
                                            <input class="form-control" type="text" name="phone">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                            <input class="form-control floating" type="email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Contact_person')}}</label>
                                            <input class="form-control" name="contact_person" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Contactphone')}}</label>
                                            <input class="form-control" name="contact_phone" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('trans.client_type')}} <span class="text-danger">*</span></label>
                                            
                                            <select class="select" name="client_type_id">
                                                @if(isset($client_types)) 
                                                    @foreach($client_types as $client_type)
                                                        <option value="{{$client_type->id}}">{{$client_type->name}}</option>
                                                    @endforeach
                                                 @endif;
                                            </select>
                                           
                                        </div>
                                    </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{__('trans.From')}} <span class="text-danger">*</span></label>
                                        
                                        <div class="input-group time timepicker">
										   <!-- <input class="form-control" name=""><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
									        <input type="time" class="form-control" name="start_time"/>
                                        </div>
                                     </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('trans.To')}}<span class="text-danger">*</span></label>
                
                                   	<div class="input-group time timepicker">
										<!--<input class="form-control" name=""><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>-->
							         	<input type="time" class="form-control" name="end_time"/>
                                	</div>
                                </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.Adress')}} <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="address">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.lat')}} <span class="text-danger" >*</span></label>
                                        <input class="form-control add_lat" type="text" name="add_lat" >
                                    </div>
                                </div>
                               <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.lang')}} <span class="text-danger" >*</span></label>
                                        <input class="form-control add_lang" type="text" name="add_lang" >
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div id="map" style="height:400px"></div>

                                </div>
                                  
                                   
                                </div>
                              
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="add">{{__('trans.Submit')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Client Modal -->
            
            <!-- Edit Client Modal -->
            <div id="edit_client" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Edit Client')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                           <form action="" method="POST">
                           @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Name')}} <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.phone')}}</label>
                                            <input class="form-control" type="text" name="phone">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                            <input class="form-control floating" type="email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Contact_person')}}</label>
                                            <input class="form-control" name="contact_person" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Contactphone')}}</label>
                                            <input class="form-control" name="contact_phone" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('trans.client_type')}} <span class="text-danger">*</span></label>
                                            
                                            <select class="select" name="client_type_id">
                                                @if(isset($client_types)) 
                                                    @foreach($client_types as $client_type)
                                                        <option value="{{$client_type->id}}">{{$client_type->name}}</option>
                                                    @endforeach
                                                 @endif;
                                            </select>
                                           
                                        </div>
                                    </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{__('trans.From')}} <span class="text-danger">*</span></label>
                                        
                                        <div class="input-group time timepicker">
										    <input class="form-control" name="start_time"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
									    </div>
                                     </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('trans.To')}}<span class="text-danger">*</span></label>
                
                                   	<div class="input-group time timepicker">
										<input class="form-control" name="end_time"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
									</div>
                                </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.Adress')}} <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="address">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.lat')}} <span class="text-danger" >*</span></label>
                                        <input class="form-control edit_lat" type="text" name="add_lat" >
                                    </div>
                                </div>
                               <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.lang')}} <span class="text-danger" >*</span></label>
                                        <input class="form-control edit_lang" type="text" name="add_lang" >
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div id="map_edit" style="height:400px"></div>

                                </div>
                                  
                                   
                                </div>
                              
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="edit">{{__('trans.Save')}}</button>
                                </div>
                            </form>

                    </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Client Modal -->
            
            <!-- Delete Client Modal -->
            <div class="modal custom-modal fade" id="delete_client" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>{{__('trans.Delete Client')}}</h3>
                                <p>{{__('trans.Are you sure want to delete?')}}</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn">{{__('trans.Delete')}}</a>
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
            <!-- /Delete Client Modal -->
            
        </div>
        <!-- /Page Wrapper -->
         @include('./layout.partials.map_script')
@endsection
