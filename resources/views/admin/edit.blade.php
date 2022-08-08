@extends('layout.mainlayout')
@section('title')
    {{__('trans.company')}}
@endsection
@section('content')
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{ __('trans.Companies') }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('trans.Companies') }}</li>
                        </ul>
                    </div>
                    

                </div>
            </div>
            <!-- /Page Header -->

      <div class="row">
            <div id="edit_employee">
                <div class="modal-content">
                   <div class="modal-header">
                        <h5 class="modal-title">{{__('trans.Edit Admin')}}</h5>
                      
                            
                       
                    </div>
                     <div class="modal-body">
                       <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form action="{{url('admin/employee-update/'.$admin_user->id)}}" method="post" enctype="multipart/form-data">
                           
                            <div class="row">
                                  

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Name')}}<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name" value="{{$admin_user->name}}">
                                        </div>
                                    </div>
                                       <input type="hidden" name="type" value="admin_edit" />
                                         <input type="hidden" name="type1" value="admin_edit" />
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Email')}} <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" name="email" value="{{$admin_user->email}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Password')}} </label>
                                            <input class="form-control" type="password" name="password"><small>{{__('trans.write only you want change')}}</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Confirm Password')}}</label>
                                            <input class="form-control" type="password" name="Confirm_Password">
                                        </div>
                                    </div>
                       
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Phone')}} </label>
                                            <input class="form-control" type="number" name="phone" value="{{$admin_user->phone}}">
                                        </div>
                                    </div>

                            
                               
                                    <div class="col-sm-12">
                                         <!-- end image -->
                                        <div class="submit-section">
                                            <button class="btn btn-primary submit-btn" type="edit">{{__('trans.Save')}}</button>
                                        </div>
                                    </div>

                        </form>
                    </div>
               <!-- </div>
            </div>
        </div>-->
        <!-- /Edit Employee Modal -->
        </div>
        </div>
    
   </div>
            
   </div>
        <!-- /Page Content -->

   </div>
        

       
</div>

@endsection
