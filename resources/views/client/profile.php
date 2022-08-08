@extends('layout.mainlayout')


@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Clients</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Clients</li>
                            </ul>
                        </div>

                    </div>
                </div>
                <!-- /Page Header -->
                <div class="card mb-0">
                    <div class="card-body" style="padding-bottom: 6rem !important;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-view">
             
                                    <div class="profile-basic">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div id="map" style="height:400px"></div>
            
                                            </div>
                                            <div class="col-md-6">
                                          
                                                <h3 class="user-name m-t-0 mb-0">{{__('trans.Name')}}</h3>
                                                <div class="small doj text-muted">{{$profile->name}}</div>   
                          
                                            </div>
                                            <div class="col-md-6">
                                               <h3 class="user-name m-t-0 mb-0">{{__('trans.phone')}}</h3>
                                                <div class="small doj text-muted">{{$profile->phone}}</div>  
                                            </div>
                                            <div class="col-md-6">
                                                <h3 class="user-name m-t-0 mb-0">{{__('trans.email')}}</h3>
                                                <div class="small doj text-muted">{{$profile->email}}</div>  
                                            </div>
        
                                            <div class="col-md-6">
                                                <h3 class="user-name m-t-0 mb-0">{{__('trans.contact_person')}}</h3>
                                                <div class="small doj text-muted">{{$profile->contact_person}}</div>  
                                            </div>
                                            <div class="col-md-6">
                                                <h3 class="user-name m-t-0 mb-0">{{__('trans.client_type_id')}}</h3>
                                                <div class="small doj text-muted">{{$profile->client_name}}</div> 
                                            </div>
                                             <div class="col-md-6">
                                                <h3 class="user-name m-t-0 mb-0">{{__('trans.address')}}</h3>
                                                <div class="small doj text-muted">{{$profile->address}}</div> 
                                            </div>
                                            <div class="col-md-2">
                                                <h3 class="user-name m-t-0 mb-0">{{__('trans.start_time')}}</h3>
                                                <div class="small doj text-muted">{{$profile->start_time}}</div>
                                            </div>
                                            <div class="col-md-2">
                                                <h3 class="user-name m-t-0 mb-0">{{__('trans.end_time')}}</h3>
                                                <div class="small doj text-muted">{{$profile->end_time}}</div>
                                            </div>
                                       
                                    </div>
                              

                          
                                </div>
                            </div>
                        </div>
                    </div>
            <!-- /Add Client Modal -->             

            </div>
            <!-- /Page Content -->
           </div>
            

    </div>
            
</div>
        <!-- /Page Wrapper -->
         @include('./layout.partials.map_script')
@endsection
