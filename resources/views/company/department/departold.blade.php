@extends('layout.mainlayout')
@section('title')
    {{__('trans.department')}}
@endsection
@section('content')
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{ __('trans.Departments') }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">{{ __('trans.Dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('trans.Department') }}</li>
                        </ul>
                    </div>
                    
                    <div class="col-auto float-right ml-auto">
                       
                        <a href=""{{ route('create-department') }}" class="btn add-btn" data-toggle="modal"
                            data-target="#add_department"><i class="fa fa-plus"></i> {{ __('trans.Add Department') }}</a>
                           
                        <div class="view-icons">
                            <a href="{{ route('department') }}" class="grid-view btn btn-link" title="{{__('trans.grid')}}"><i
                                     class="fa fa-th"></i></a>
                            <a href="department-list" class="list-view btn btn-link active" title="{{__('trans.list')}}"><i class="fa fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
           


            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table" id="table_search">
                            <thead>
                                <tr>
                                    <th>{{ __('trans.Title') }}</th>
                                    <th>{{ __('trans.company Title') }}</th>
                                    <th>{{ __('trans.Action') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                          
                                @if (isset($departments))
                                    @foreach($departments as $department)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                               
                                                <a href="profile">@if (isset($department->title)) {{ $department->title }} @endif</span></a>
                                            </h2>
                                        </td>
                                        @if(Auth::user()->role_id==2)
                                        <td>
                                            <h2 class="table-avatar">
                                               
                                                @if (isset($department->company_title)) {{ $department->company_title }} @endif
                                            </h2>
                                        </td>

                                        @endif
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" data-href="{{ url('admin/department-edit/'.$department->id) }}" dep-id="{{$department->id}}" data-toggle="modal" data-target="#edit_department"><i  class="fa fa-pencil m-r-5"></i> {{ __('trans.Edit') }}</a>
                                                  <!--  <a class="dropdown-item" href="{{ route('delete-department') }}"
                                                        data-toggle="modal" data-target="#delete_department"><i
                                                            class="fa fa-trash-o m-r-5"></i>
                                                        {{ __('trans.Delete') }} </a>-->
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
        <div id="add_department" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('trans.Add department')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form method="Post" action="{{route('store-department')}}">
                            @csrf
                            <div class="row">
                               @if(Auth::user()->role_id==2)
                               <div class="col-sm-6">
     
                                    <div class="form-group form-focus select-focus">
                                        <select class="select floating" name="company_id"> 
                                            @foreach($companies as $company)
                                                <option value="{{$company['id']}}">{{$company['title']}}</option>
                                            @endforeach
                                        </select>
                                        <label class="focus-label">{{__('trans.Company')}}</label>
                                    </div>
                                
                                </div>
                             
                                @endif
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.Title')}} <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="title"/>
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
        
        <!-- /Add Employee Modal -->
        
        <!-- Edit Employee Modal -->
        <div id="edit_department" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('trans.Edit department')}}</h5>
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
                                        <label class="col-form-label">{{__('trans.Title')}}<span class="text-danger">*</span></label>
                                        <input class="form-control" name="title" type="text">
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
        <!-- /Edit Employee Modal -->
       
        <!-- Delete Employee Modal -->
        <div class="modal custom-modal fade" id="delete_employee" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>{{__('trans.Delete depart')}}</h3>
                            <p>{{__('trans.Are you sure want to delete?')}}</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn">{{__('trans.Delete')}}</a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal"
                                        class="btn btn-primary cancel-btn">{{__('trans.Cancel')}}</a>
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
