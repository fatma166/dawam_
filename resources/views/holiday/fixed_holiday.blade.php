@extends('layout.mainlayout')
@section('title')
    {{__('trans.FixedHolidays')}}
@endsection
@section('content')
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">{{__('trans.Fixed Holiday')}}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                                <li class="breadcrumb-item active">{{__('trans.Fixed Holiday')}}</li>
                            </ul>
                        </div>
                        @if($fixed_exist==0)
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_holiday"><i class="fa fa-plus"></i> {{__('trans.Add Holiday')}}</a>
                        </div>
                        @endif
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>                       
                                        <th>{{__('trans.Day')}}</th>
                                        <th class="text-right">{{__('trans.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(isset($fixed_holiday))
                               
                                    <tr class="holiday-completed">
                                       <td>{{$fixed_holiday->id}}</td>
                                        <td>{{$day_str}}</td>
                                       
                                     
                                        <td class="text-right">
                                            <a class="btn btn-outline-success" href="#"  data-href="{{ url('admin/fixed-holidays-edit/'.$fixed_holiday->id) }}" fix_holiday-id="{{$fixed_holiday->id}}"  data-toggle="modal" data-target="#edit_fix_holiday"><i class="fa fa-pencil m-r-5"></i>{{__('trans.Edit')}}</a>
                                            <a class="btn btn-outline-danger" href="#" data-toggle="modal" data-target="#delete_fix_holiday" delete-id="{{$fixed_holiday->id}}"><i class="fa fa-trash-o m-r-5"></i>{{__('trans.Delete')}}</a>
                                        </td>
                                    </tr>
                        
                                @endif
                                   
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
            
            <!-- Add Holiday Modal -->
            <div class="modal custom-modal fade" id="add_holiday" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Add Holiday')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                          <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                            <form action="{{route('store-fixed-holidays',$subdomain)}}" method="post">
                           
                                   <div class="table-responsive m-t-15">
                                    <table class="table table-striped custom-table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">{{__('trans.saturday')}}</th>
                                                <th class="text-center">{{__('trans.sunday')}}</th>
                                                <th class="text-center">{{__('trans.monday')}}</th>
                                                <th class="text-center">{{__('trans.tuesday')}}</th>
                                                <th class="text-center">{{__('trans.wednsday')}}</th>                
                                                <th class="text-center">{{__('trans.thursday')}}</th>
                                                <th class="text-center">{{__('trans.friday')}}</th>
                                               

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                               
                                                <td class="text-center">
                                                    <input  type="checkbox"  class="day_add" name="day[saturday]">
                                                </td>
                            
                                                
                                                <td class="text-center">
                                                    <input  type="checkbox" class="day_add" name="day[sunday]">
                                                </td>
                                      
                                                <td class="text-center">
                                                    <input  type="checkbox" class="day_add" name="day[monday]">
                                                </td>
                                            
                                                <td class="text-center">
                                                    <input  type="checkbox" class="day_add" name="day[tuesday]">
                                                </td>
                                           
                                                <td class="text-center">
                                                    <input  type="checkbox" class="day_add" name="day[wednsday]">
                                                </td>
                                                <td class="text-center">
                                                    <input  type="checkbox" class="day_add" name="day[thursday]">
                                                </td>
    
                                                <td class="text-center">
                                                    <input  type="checkbox" class="day_add" name="day[friday]">
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="add">{{__('trans.Submit')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Holiday Modal -->
            
            <!-- Edit Holiday Modal -->
            <div class="modal custom-modal fade" id="edit_fix_holiday" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('trans.Edit Holiday')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                         <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                            <form  method="post">
                            @csrf
                                   <div class="table-responsive m-t-15">
                                    <table class="table table-striped custom-table">
                                        <thead>
                                            <tr>
                               <th class="text-center">{{__('trans.saturday')}}</th>
                                                <th class="text-center">{{__('trans.sunday')}}</th>
                                                <th class="text-center">{{__('trans.monday')}}</th>
                                                <th class="text-center">{{__('trans.tuesday')}}</th>
                                                <th class="text-center">{{__('trans.wednsday')}}</th>                
                                                <th class="text-center">{{__('trans.thursday')}}</th>
                                                <th class="text-center">{{__('trans.friday')}}</th>
                                               

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">
                                                    <input  type="checkbox" name="day[saturday]">
                                                </td>
                            
                                                
                                                <td class="text-center">
                                                    <input  type="checkbox" name="day[sunday]">
                                                </td>
                                      
                                                <td class="text-center">
                                                    <input  type="checkbox" name="day[monday]">
                                                </td>
                                            
                                                <td class="text-center">
                                                    <input  type="checkbox" name="day[tuesday]">
                                                </td>
                                           
                                                <td class="text-center">
                                                    <input  type="checkbox" name="day[wednsday]">
                                                </td>
                                                <td class="text-center">
                                                    <input  type="checkbox"  name="day[thursday]">
                                                </td>
    
                                                <td class="text-center">
                                                    <input  type="checkbox" name="day[friday]">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="edit">{{__('trans.Submit')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Holiday Modal -->

            <!-- Delete Holiday Modal -->
            <div class="modal custom-modal fade" id="delete_fix_holiday" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>{{__('trans.Delete Holiday')}}</h3>
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
            <!-- /Delete Holiday Modal -->
            
        </div>
        <!-- /Page Wrapper -->
@endsection