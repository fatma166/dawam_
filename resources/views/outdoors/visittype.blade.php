@extends('layout.mainlayout')
@section('title')
    {{__('trans.outdoor-type')}}
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
                            <h3 class="page-title">{{__('trans.visit_type')}}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                                <li class="breadcrumb-item active">{{__('trans.visit_type')}}</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_outdoor_type"><i class="fa fa-plus"></i>{{__('trans.Add Visittype')}}</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 " id="table_search">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">#</th>
                                        <th>{{__('trans.name')}}</th>
                                        <th>{{__('trans.Created_at')}}</th>
                                        <th class="text-right">{{__('trans.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($visit_types as $visit_type)
                                    <tr>
                                        <td>{{$visit_type->id}}</td>
                                        <td>{{$visit_type->name}}</td>
                                      
                                        <td>{{$visit_type->created_at}}</td>
                                        
                                        <td class="text-right">
                                            <a class="btn btn-outline-success" href="#" data-href="{{ url('admin/outdoor-type-edit/'.$visit_type->id) }}" outdoor-type-id="{{$visit_type->id}}"  data-toggle="modal" data-target="#edit_outdoor_type">
                                                <i class="fa fa-pencil m-r-5"></i>{{__('trans.Edit')}}
                                            </a>
                                            <a class="btn btn-outline-danger" href="#" data-toggle="modal"  data-target="#delete_outdoor_type" delete-id="{{$visit_type->id}}">
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
            </div>
            <!-- /Page Content -->

            <!-- Add outdoor Modal -->
            <div id="add_outdoor_type" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Add Visit Type')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form method="post" action="{{route('store-outdoor-type',$subdomain)}}">
                                @csrf
                                <div class="row">
                                   
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.name')}} <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name">
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
            <!-- /Add Task -->
            
            <!-- Edit Task -->
            <div id="edit_outdoor_type" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Edit Visit')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <form method="post">
                             @csrf
                                <div class="row">
  
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Name')}} <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name">
                                        </div>
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
            <!-- /Edit task -->
            
            <!-- Delete task -->
            <div class="modal custom-modal fade" id="delete_outdoor_type" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>{{__('trans.Delete visit type' )}}</h3>
                                <p>{{__('trans.Are you sure want to delete?')}}</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary outdoor-type-continue-btn">{{__('trans.Delete')}}</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">{{__('trans.Cancel')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>php 
                </div>
            </div>
            <!-- /Delete task -->
        
        </div>
        <!-- /Page Wrapper -->
@endsection