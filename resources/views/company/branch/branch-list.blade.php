@extends('layout.mainlayout')

@section('title')
    {{__('trans.branch')}}
@endsection


@section('content')




				
///

         <!-- /Table Grid -->
            <div class="page-wrapper">
                <!-- Page Content -->
                <div class="content container-fluid">
                   <!-- Page Header -->
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">{{ __('trans.Branches') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('trans.Branch') }}</li>
                                </ul>
                            </div>
                            
                            <div class="col-auto float-right ml-auto">
                               
                                <a class="btn add-btn" data-toggle="modal"
                                    data-target="#add_branch" class="add_branch"><i class="fa fa-plus"></i> {{ __('trans.Add Branch') }}</a>
                                   
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
                    <!-- /Page Header -->
        
         <!-- /Table Grid -->
			   
					<div class="row staff-grid-row" style="display: none;">
                       @if (isset($branchs))
                            @foreach($branchs as $branch)
					  <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                      
							<div class="profile-widget">
								<div class="profile-img">
									<a data-href="{{ url('admin/branch-edit/'.$branch->id) }}" 
                                        branch-id="{{$branch->id}}" data-toggle="modal" data-target="#edit_branch" class="avatar"><img src="{{asset('img/profiles/avatar-02.jpg')}}" alt=""></a>
								</div>
								<div class="dropdown profile-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                 		<div class="dropdown-menu dropdown-menu-right">
									     <a class="dropdown-item" href="{{ url('admin/branch-edit/'.$branch->id) }}"
                                                       data-href="{{ url('admin/branch-edit/'.$branch->id) }}" branch-id="{{$branch->id}}" data-toggle="modal" data-target="#edit_branch"><i
                                                            class="fa fa-pencil m-r-5"></i> {{ __('trans.Edit') }}</a>
                                                    <a class="dropdown-item" delete-id="{{$branch->id}}" 
                                                        data-toggle="modal" data-target="#delete_branch"><i
                                                            class="fa fa-trash-o m-r-5"></i>
                                                        {{ __('trans.Delete') }} </a>
									</div>
                                  
								</div>
								 <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="#">@if (isset($branch->title)) {{ $branch->title }} @endif</a></h4>
                                 <div class="small text-muted">@if (isset($branch->adress)) {{ $branch-> adress }} @endif</div>
							       
                                </div>
                                
						</div>
                           @endforeach
                          @endif
					</div>
           
 <!-- /Table Grid -->
           
              
             <!-- /Table List -->
                <div class="col-md-12">
                    <div class="table-responsive">
                                       
                        <table class="table table-striped custom-table" id="table_search">
                            <thead>
                                <tr>
                                    <th>{{ __('trans.Title') }}</th>
                                    @if(Auth::user()->role_id==2)
                                         <th>{{ __('trans.Company Title') }}</th>
                                    @endif
                                    <th>{{ __('trans.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                          
                                @if (isset($branchs))
                                   @foreach($branchs as $branch)

                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                               <!-- <a href="profile" class="avatar"><img alt=""src="img/profiles/avatar-02.jpg"></a>-->
                                               <!-- <a href="profile">-->
                                               
                                             <!-- abdelkawy branchs link when click on branch  view Edit Mode -->   
                                           <a class="dropdown-item" href="{{ url('admin/branch-edit/'.$branch->id) }}"
                                                       data-href="{{ url('admin/branch-edit/'.$branch->id) }}" branch-id="{{$branch->id}}" data-toggle="modal" data-target="#edit_branch"
                                                       ><span>@if (isset($branch->title)) {{ $branch->title }} @endif</span></a>
                                            
                                            </h2>
                                        </td>
                                        @if(Auth::user()->role_id==2)
                                        <td>
                                            <h2 class="table-avatar">
                                               <!-- <a href="profile" class="avatar"><img alt=""src="img/profiles/avatar-02.jpg"></a>-->
                                               <!-- <a href="profile">--><span>@if (isset($branch->company_title)) {{ $branch-> company_title }} @endif</span><!--</a>-->
                                            </h2>
                                        </td>
                                        @endif

                                        <td class="text-right">
                                           
                                            <a type="button" class="btn btn-outline-success" href="{{ url('admin/branch-edit/'.$branch->id) }}"
                                                data-href="{{ url('admin/branch-edit/'.$branch->id) }}" branch-id="{{$branch->id}}" data-toggle="modal" data-target="#edit_branch">
                                                <i class="fa fa-pencil m-r-5"></i>{{ __('trans.Edit') }}
                                            </a>
                                            <a type="button" class="btn btn-outline-danger" delete-id="{{$branch->id}}"  data-toggle="modal" data-target="#delete_branch">
                                                <i class="fa fa-trash-o m-r-5"></i>{{ __('trans.Delete') }}
                                            </a>
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                      
                         
                         
                         
                    </div>
                </div>
                   <!-- /End Table List -->
            </div>
        </div>
        <!-- /Page Content -->

        <!-- Add Branch Modal -->
        <div id="add_branch" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('trans.Add Branch')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                       
                        <form method="post" action="{{route('store-branch',$subdomain)}}">
                         @csrf
                            <div class="row">

                               <div class="col-sm-6 col-md-6"> 
                                        <div class="form-group form-focus">
                                         <label class="col-form-label">{{__('trans.Zone')}} <span class="text-danger">*</span></label> 
                                          <select class="zone_id  form-control" name="zone_id"></select>                            
                                                                      
                                           
                                        </div>
            
            
                               </div>
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
                                        <label class="col-form-label">{{__('trans.Title')}} <span class="text-danger" >*</span></label>
                                        <input class="form-control" type="text" name="title">
                                        @error('title')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
									    @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.Adress')}} <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="adress">
                                        @error('adress')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
									    @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6" style="display: none;">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.lat')}} <span class="text-danger" >*</span></label>
                                        <input class="form-control add_lat" type="text" name="add_lat" readonly>
                                         @error('add_lat')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
									    @enderror
                                    </div>
                                </div>
                               <div class="col-sm-6" style="display: none;">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.lang')}} <span class="text-danger" >*</span></label>
                                        <input class="form-control add_lang" type="text" name="add_lang" readonly>
                                        @error('add_lang')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
									    @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div id="map" style="height:400px"></div>

                                </div>

                            </div>
                           
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn" type="add">{{__('trans.Submit')}}</button> <!--onclick="masterAdd('#add_branch','{{route('store-branch',$subdomain)}}')"-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
               
        <!-- Edit Branch Modal -->
        <div id="edit_branch" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('trans.Edit Branch')}}</h5>
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
                                    <!--<div class="form-group form-focus select-focus zone_id">-->
                                     <label class="focus-label">{{__('trans.Zone')}}</label>
                                    <select class="zone_id form-control" name="zone_id"></select>
                                        <!--<select class="select floating zone_id" name="zone_id"> 
                                            @foreach($zones as $zone)
                                                <option value="{{$zone->zone_id}}">{{$zone->zone_name}}</option>
                                            @endforeach
                                        </select>-->
                                      
                                       
                                    <!--</div>-->
                                    </div>
                                
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.Title')}}<span class="text-danger">*</span></label>
                                        <input class="form-control  branch_title" name="title" type="text">
                                    </div>
                                </div>
                              
                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('trans.Adress')}} <span class="text-danger">*</span></label>
                                            <input class="form-control branch_adress" type="text" name="adress">
                                        </div>
                                </div>
                                <div class="col-sm-6"  style="display: none;">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.lat')}} <span class="text-danger" >*</span></label>
                                        <input class="form-control edit_lat" type="text" name="edit_lat" readonly>
                                    </div>
                                </div>
                               <div class="col-sm-6"  style="display: none;">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.lang')}} <span class="text-danger" >*</span></label>
                                        <input class="form-control edit_lang" type="text" name="edit_lang" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div id="map_edit" style="height:400px"></div>

                                </div>
                            </div> 
                            <div class="submit-section">
                          
                                <button class="btn btn-primary submit-btn" type="edit">{{__('trans.Save')}}</button>
                           
                            </div>
                            <br/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Employee Modal -->
         
        <!-- Delete Employee Modal -->
        <div class="modal custom-modal fade" id="delete_branch" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>{{__('trans.Delete Branch')}}</h3>
                            <p>{{__('trans.Are you sure want to delete?')}}</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn" continue_del="">{{__('trans.Delete')}}</a>
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
        <!-- /Add Branch Modal -->
     

 


@include('./layout.partials.map_script2')

@endsection
 

