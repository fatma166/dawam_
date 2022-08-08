@extends('layout.mainlayout')
@section('title')
    {{__('trans.permissions')}}
@endsection
@section('content')
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">{{__('trans.Permission')}}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">{{__('trans.Dashboard')}}</a></li>
                                <li class="breadcrumb-item active">{{__('trans.Permission')}}</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_permission"><i class="fa fa-plus"></i>{{__('trans.Add Permission')}} </a>
         
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <form action="search-permission" method="post">
                @csrf
                <!-- Search Filter -->
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="name" id="employee_name">
                            <label class="focus-label">{{__('trans.tablename')}}</label>
                        </div>
                    </div>
  
                </div>
                <!-- /Search Filter -->
                
                </form>
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
                            <table class="table table-striped custom-table " id="table_search">
                                <thead>
                                    <tr>
                                        <th>{{__('trans.TableName')}}</th>
                                        <th>{{__('trans.key')}}</th>
                                        <th class="text-right no-sort">{{__('trans.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if ($permissions)
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                               
                                                <a class="" data-href="{{ url('admin/permission-edit/'.$permission->id) }}" data-toggle="modal" permission-id="{{$permission->id}}" data-target="#edit_permission">{{$permission->table_name}}</a>
                                            </h2>
                                        </td>
                                        <td>{{$permission->key}}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" data-href="{{ url('admin/permission-edit/'.$permission->id) }}" data-toggle="modal" permission-id="{{$permission->id}}" data-target="#edit_permission"><i class="fa fa-pencil m-r-5"></i>{{__('trans.Edit')}}</a>
                                                    <a class="dropdown-item" delete-id="{{$permission->id}}"  data-toggle="modal" data-target="#delete_permission"><i class="fa fa-trash-o m-r-5"></i> {{__('trans.Delete')}}</a>
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
            
            <!-- Add Employee Modal -->
            <div id="add_permission" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Add Permission')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                               <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                            <form action="{{route('store-permission',$subdomain)}}" method="post">
                            @CSRF

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.TableName')}}<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="table_name">
                                        </div>
                                    </div>
                               
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Key')}} <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="key">
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
            </div>
            <!-- /Add Employee Modal -->
            
            <!-- Edit Employee Modal -->
            <div id="edit_permission" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{('trans.Edit Permission')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                        <form action="" method="POST">
                        @CSRF
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.TableName')}}<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="table_name">
                                        </div>
                                    </div>
                              
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Key')}} <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="key">
                                        </div>
                                    </div>

                                </div>
                       
        
                    
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="edit">{{__('trans.Submit')}}</button>
                                </div>
                         </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Employee Modal -->
            
            <!-- Delete Employee Modal -->
            <div class="modal custom-modal fade" id="delete_permission" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>{{__('trans.Delete permission')}}</h3>
                                <p>{{__('trans.Are you sure want to delete?')}}</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn" continue_del="">{{__('trans.Delete')}}</a>
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
            <!-- /Delete Employee Modal -->
            
        </div>
@endsection