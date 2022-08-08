@extends('layout.mainlayout')
@section('title')
    {{__('trans.roles')}}
@endsection
@section('content')
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">{{__('trans.role')}}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">{{__('trans.Dashboard')}}</a></li>
                                <li class="breadcrumb-item active">{{__('trans.role')}}</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_role"><i class="fa fa-plus"></i>{{__('trans.Add role')}} </a>
         
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <form action="search-role" method="post">
                @csrf
                <!-- Search Filter -->
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="name" id="name">
                            <label class="focus-label">{{__('trans.name')}}</label>
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
                            <table class="table table-striped custom-table " id="table_search" >
                                <thead>
                                    
                                        <th>{{__('trans.roleName')}}</th>
                                      
                                        <th class="text-right no-sort">{{__('trans.Action')}}</th>
                                 
                                </thead>
                                <tbody>
                                @if ($roles_)
                                @foreach($roles_ as $role)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                               
                                                <a class="" data-href="{{ url('admin/role-edit/'.$role->id) }}" data-toggle="modal" role-id="{{$role->id}}" data-target="#edit_role">{{$role->name}}</a>
                                            </h2>
                                        </td>
                                        
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" data-href="{{ url('admin/role-edit/'.$role->id) }}" data-toggle="modal" role-id="{{$role->id}}" data-target="#edit_role"><i class="fa fa-pencil m-r-5"></i>{{__('trans.Edit')}}</a>
                                                    <a class="dropdown-item" delete-id="{{$role->id}}"  data-toggle="modal" data-target="#delete_role"><i class="fa fa-trash-o m-r-5"></i> {{__('trans.Delete')}}</a>
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
            
            <!-- Add role Modal -->
            <div id="add_role" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Add role')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                               <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                            <form action="{{route('store-role',$subdomain)}}" method="post">
                            @CSRF

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Name')}}<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name">
                                        </div>
                                    </div>
                                <div class="col-sm-12">      
                                    <label for="permission">{{__('trans.permission')}}</label><br>
                                    <a href="#" class="permission-select-all">{{__('trans.all')}}</a> / <a href="#"  class="permission-deselect-all">{{__('trans.cancle')}}</a>
                                    <ul class="permissions checkbox">    
                                    @foreach($permissions as $key=>$permission)
                                            <li>
                                                <input type="checkbox" id="{{$key}}" class="permission-group">
                                                <label for="{{$key}}"><strong>{{$key}}</strong></label>
                                                <ul>
                                                      @foreach($permission as $perm)
                                                        <li>
                                                            <input type="checkbox" id="permission-1" name="permission[{{$perm->id}}]" class="the-permission" value="{{$perm->id}}" >
                                                            <label for="permission-1">{{$perm->key}}</label>
                                                        </li>  
                                                      @endforeach
                                                         
                                               </ul>
                                            </li>
                                    @endforeach
                                    </ul>
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
            <!-- /Add role Modal -->
            
            <!-- Edit role Modal -->
            <div id="edit_role" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{('trans.Edit role')}}</h5>
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
                                            <label class="col-form-label">{{__('trans.Name')}}<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name">
                                        </div>
                                    </div>

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
                                                            <input type="checkbox" id="permission-1" name="permission[{{$perm->id}}]"  key="{{$key}}" class="the-permission {{$key}} " value="{{$perm->id}}" >
                                                            <label for="permission-1">{{$perm->key}}</label>
                                                        </li>  
                                                      @endforeach
                                                         
                                               </ul>
                                            </li>
                                    @endforeach
                                    </ul>
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
            <!-- /Edit role Modal -->
            
            <!-- Delete role Modal -->
            <div class="modal custom-modal fade" id="delete_role" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>{{__('trans.Delete role')}}</h3>
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
            <!-- /Delete role Modal -->
            
        </div>
@endsection