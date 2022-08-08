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
                            <li class="breadcrumb-item"><a href="index.html">{{ __('trans.Dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('trans.Companies') }}</li>
                        </ul>
                    </div>
                    
                    <div class="col-auto float-right ml-auto">
                        @if($check=="add")
                        <a href="{{ route('create-company') }}" class="btn add-btn" data-toggle="modal"
                            data-target="#add_company"><i class="fa fa-plus"></i> {{ __('trans.Add Company') }}</a>
                            @endif
                        <div class="view-icons">
                            
                           <!-- abdelkawy change href to button and call by jquery  -->
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
            <!-- /Page Header -->

   <!-- /Table Grid -->
			   
					<div class="row staff-grid-row" style="display: none;">
                       @if (isset($company->id))
                            
					  <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                      
							<div class="profile-widget">
								<div class="profile-img">
									<a href="profile.html" class="avatar"><img src="assets/img/profiles/avatar-02.jpg" alt=""></a>
								</div>
								<div class="dropdown profile-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                 		<div class="dropdown-menu dropdown-menu-right">
									     <a class="dropdown-item" data-href="{{ url('admin/company-edit/'.$company->id) }}"
                                                         data-id="{{$company->id}}" data-toggle="modal" data-target="#edit_company"><i
                                                            class="fa fa-pencil m-r-5"></i> {{ __('trans.Edit') }}</a>
       
        
									</div>
								</div>
								 <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="#">@if (isset($company->title)) {{ $company->title }} @endif</a></h4>
                                 <div class="small text-muted">@if (isset($company->title)) {{ $company->title }} @endif</div>
							</div>
						</div>
                          
                          @endif
					</div>


       



            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('trans.company_name') }}</th>
                                   
                                    @if($roles['name']=="developer"||$roles['name']=="accountant"||$roles['name']=="super_admin")
                                        <th>{{ __('trans.go_company') }}</th>
                                        <th>{{ __('trans.total_users') }}</th>
                                        <th>{{ __('trans.status') }}</th>
                                    @else
                                       <th>{{ __('trans.edit') }}</th>
                                    @endif
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                          
                                @if (isset($company->id))
                                   <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{url('admin/company/profile/'.$company->id)}}">@if (isset($company->title)) {{ $company->title }} @endif</span></a>
                                            </h2>
                                           
                                        </td>
                                        <td>
                                         <a class="btn add-btn" data-toggle="modal" data-href="{{ url('admin/company-edit/'.$company->id) }}"
                                                data-id="{{$company->id}}" style="cursor: pointer;"
                                              data-target="#edit_company"> {{ __('trans.Edit') }}</a>
                                        </td>
  


                                      
                                    </tr>       
                                
                                
                                
                                
                                @else
                                
                                @foreach($company as $company1)
                                   <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{url('admin/company/profile/'.$company1->id)}}">@if (isset($company1->title)) {{ $company1->title }} @endif</span></a>
                                            </h2>
                                        </td>



                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"   aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" data-href="{{ url('admin/company-edit/'.$company1->id) }}" data-id="{{$company1->id}}"
                                                        data-toggle="modal" data-target="#edit_company"><i
                                                     
                                                         class="fa fa-pencil m-r-5"></i> {{ __('trans.Edit') }}</a>
                                                  <!--  <a class="dropdown-item" href="{{ route('delete-company') }}"
                                                        data-toggle="modal" data-target="#delete_company"><i
                                                            class="fa fa-trash-o m-r-5"></i>
                                                        {{ __('trans.Delete') }} </a>-->
                                                </div>
                                            </div>
                                        </td>
                                        
                                        @if(Auth::user()->role_id==2)
                                        <td><button onclick="goCompany({{$company1->id}})" >{{__('go_to_company')}}</button></td>
                                        <td>{{$company1['total']}}</td>
                                 
                                        <td>@if($company1['status']==1){{__('trans.Yes')}}@else{{__('trans.No')}} @endif</td>
                                        @endif
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
        <div id="add_company" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('trans.Add Employee')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="get" action="{{route('store-company')}}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.Title')}} <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="title">
                                    </div>
                                </div>
                                 <div class="h3 card-title with-switch">
                                    <span class="subtitle">{{__('trans.Nearest Branch')}}</span>
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="onoffswitch" value="0" class="onoffswitch-checkbox" id="switch_paternity">
                                        <label class="onoffswitch-label" for="switch_paternity">
                                            <span class="onoffswitch-inner" ></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.Title')}} <span class="text-danger">*</span></label>
                                        <input class="form-control" type="number" name="distance" disabled>
                                    </div>
                                </div>
                                
                            </div>
                           
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">{{__('trans.Submit')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add company Modal -->
       
         @if(isset($company))
        <!-- Edit company Modal -->
        <div id="edit_company" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                   <div class="modal-header">
                        <h5 class="modal-title">{{__('trans.Edit Company')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form action=""  method="post" enctype="multipart/form-data">
                           
                            <div class="row">
                        
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.Company_Title')}}<span class="text-danger">*</span></label>
                                        <input class="form-control" name="title" type="text" required>
                                         <input class="form-control"  type="hidden"  id="company_logo" name="company_logo" />                                        
                                         @error('title')
                                         <span class="text-danger" role="alert">
                                             <strong>{{ $message }}</strong>
                                         </span>
                                     @enderror
                                    </div>
                                </div>
                                
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Distance')}} <span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" name="distance" >
                                        </div>
                                    </div>

                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.min_time_attend')}} <span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" name="min_time" />
                                        </div>
                                </div> 

                               <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.logout_time')}} <span class="text-danger">*</span></label>
                                            <input type="time" class="form-control" name="logout_time"  />
                                        </div>
                                </div> 
                             <!-- fake -->
                                <div class="col-sm-3">
                                    <div class="leave-left">
                                            <label class="d-block">{{__('trans.fake')}}</label> 
                                            <div class="leave-inline-form">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input is_fake" type="radio" name="is_fake" value="0"   >
                                                    <label class="form-check-label" for="carry_no">{{__('trans.No')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-inpu is_fake1" type="radio" name="is_fake" value="1" >
                                                    <label class="form-check-label" for="carry_yes">{{__('trans.Yes')}}</label>
                                                </div>
             
                                            </div>
                                    </div>

                               </div> 
                               <!--target location check -->
                                <div class="col-sm-3">
                                    <div class="leave-left">
                                            <label class="d-block">{{__('trans.in target')}}</label>
                                            <div class="leave-inline-form">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input target_location" type="radio" name="target_location_check" value="0"  >
                                                    <label class="form-check-label" for="carry_no">{{__('trans.No')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-inpu target_location1" type="radio" name="target_location_check" value="1">
                                                    <label class="form-check-label" for="carry_yes">{{__('trans.Yes')}}</label>
                                                </div>
             
                                            </div>
                                    </div>
  
                               </div> 
                                 <!--target location check -->
                                <div class="col-sm-3">
                                    <div class="leave-left">
                                            <label class="d-block">{{__('trans.mac check')}}</label>
                                            <div class="leave-inline-form">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input mac_check" type="radio" name="mac_check" value="0"  >
                                                    <label class="form-check-label" for="carry_no">{{__('trans.No')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-inpu mac_check1" type="radio" name="mac_check" value="1">
                                                    <label class="form-check-label" for="carry_yes">{{__('trans.Yes')}}</label>
                                                </div>
             
                                            </div>
                                    </div>
                                </div>    
                                <div class="col-sm-12">
                                <!-- image --->
                                    <div class='preview company-logo'>
                                        <img  id="img" width="100" height="100"> <span class="delete_img" company_id="">x</span>
                                    </div>
                                    <div >
                                        <input type="file" id="file" name="file"  class="but_upload"/>     
                                      
                                       <!-- <input type="button" class="button" value="Upload"  />-->
                                    </div>
                                    </div>
                            
                               
                        <div class="col-sm-12">
                             <!-- end image -->
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">{{__('trans.Save')}}</button>
                            </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Employee Modal -->
         @endif
        <!-- Delete Employee Modal -->
        <div class="modal custom-modal fade" id="delete_employee" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Employee</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal"
                                        class="btn btn-primary cancel-btn">Cancel</a>
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
