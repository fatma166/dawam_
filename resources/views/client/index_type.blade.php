@extends('layout.mainlayout')
@section('title')
    {{__('trans.clients_type')}}
@endsection
@section('content')
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{ __('trans.Client types') }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('trans.Client types') }}</li>
                        </ul>
                    </div>

                    <div class="col-auto float-right ml-auto">

                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_client_type"><i
                                class="fa fa-plus"></i> {{ __('trans.Add Client Type') }}</a>

                        <div class="view-icons">
                           
                        <div class="view-icons">
                          
                             <button  class="grid-view btn btn-link" title="{{__('trans.grid')}}">
                                       <i class="fa fa-th"></i>
                                    </button>
                                   
                                    <button  class="list-view btn btn-link active" title="{{__('trans.list')}}">
                                       <i class="fa fa-bars"></i>
                            </button>    
                           
                        </div>
                       
                       
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->


       <!-- /Table Grid -->
                       
             	<div class="row staff-grid-row" style="display: none;">
                       @if (isset($client_types))
                        @foreach($client_types as $client_type)
    			     	<div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                                                 
                         <div class="profile-widget">
    								<div class="profile-img">
    									<a href="profile.html" class="avatar"><img src="assets/img/profiles/avatar-02.jpg" alt=""></a>
    								</div>
    								<div class="dropdown profile-action">
    									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
    								  <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            data-href="{{ url('admin/client_type-edit/' . $client_type->id) }}"
                                                            client_type-id="{{  $client_type->id }}" data-toggle="modal"
                                                            data-target="#edit_client_type"><i class="fa fa-pencil m-r-5"></i>
                                                            {{ __('trans.Edit') }}</a>
                                                      <!-- <a class="dropdown-item" href="#" client_type-id="{{ $client_type->id }}"
                                                            data-toggle="modal" delete-id="{{ $client_type->id }}"  data-target="#delete_client_type"><i
                                                                class="fa fa-trash-o m-r-5"></i>
                                                            {{ __('trans.Delete') }} </a>-->
                                                    </div>
                                  
    								</div>
    								<h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="profile.html">{{$client_type->name}}</a></h4>
    								
    							</div>
                            
                         </div>
                           @endforeach
                           @endif	
                </div>
                     
             <!-- /Table Grid -->



            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table" id="table_search">
                            <thead>
                                <tr>
                                    <th>{{ __('trans.Title') }}</th>
                                    <th>{{ __('trans.Edit') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                               
                                @if (!empty($client_types))
                                    @foreach ($client_types as $client_type)
                                        <tr>
                                            <td>
                                                
                                                     <a href="#" class="avatar"><img alt=""
                                                            src="img/profiles/avatar-02.jpg"> </a>
                                                     <h2 class="table-avatar"> 
                                   <!-- abdelkawy jobs link when click on client_type   view Edit Mode -->                         
                                                           <a class="dropdown-item"
                                                                data-href="{{ url('admin/client_type-edit/' . $client_type->id) }}"
                                                                client_type-id="{{  $client_type->id }}" data-toggle="modal"
                                                                data-target="#edit_client_type">
                                                              {{$client_type->name }}
                                                          </a>
                                                        </h2>    
                                                               
                                                        
                                                        
                                                  
                                               
                                            </td>



                                            <td class="text-right">
                                           
                                               <a class="btn btn-outline-success" href="#"
                                                    data-href="{{ url('admin/client_type-edit/' . $client_type->id) }}"
                                                    client_type-id="{{  $client_type->id }}" data-toggle="modal"
                                                    data-target="#edit_client_type"><i class="fa fa-pencil m-r-5"></i>
                                                    {{ __('trans.Edit') }}</a>
                                               <!-- <a class="btn btn-outline-danger" href="#" client_type-id="{{ $client_type->id }}"
                                                    data-toggle="modal" delete-id="{{ $client_type->id }}"  data-target="#delete_client_type"><i
                                                        class="fa fa-trash-o m-r-5"></i>
                                                    {{ __('trans.Delete') }} </a>-->
                                               
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

        <!-- Add client_type Modal -->
        <div id="add_client_type" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('trans.Add_Client_type') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <div class="alert alert-danger print-error-msg" style="display:none">
                         <ul></ul>
                        </div>
                        <form method="post" action="{{ route('store-client_type',$subdomain) }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{ __('trans.Title') }} <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="name">
                                    </div>
                                </div>


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
    <!-- /Add client_type Modal -->

    <!-- Edit client_type Modal -->
    <div id="edit_client_type" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('trans.Edit client type') }}</h5>
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">{{ __('trans.Title') }}<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="name" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="edit">{{ __('trans.Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit client_type Modal -->

    <!-- Delete client_type Modal -->
    <div class="modal custom-modal fade" id="delete_client_type" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>{{ __('trans.Delete_client_Type') }}</h3>
                            <p>{{ __('trans.Are you sure want to delete?') }}</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn client_type_continue_del" continue_del="">{{ __('trans.Delete') }}</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">{{ __('trans.Cancel') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete client_type Modal -->

    </div>
@endsection
