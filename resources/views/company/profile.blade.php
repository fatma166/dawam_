@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">{{__('trans.Profile')}}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">{{__('trans.Dashboard')}}</a></li>
                                <li class="breadcrumb-item active">{{__('trans.Profile')}}</li>
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
                                  <!--  <div class="profile-img-wrap">
                                        <div class="profile-img">
                                            <a href="#"><img alt="" src="img/profiles/avatar-02.jpg"></a>
                                        </div>
                                    </div>-->
                                    <div class="profile-basic">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="profile-info-left">
                                                    <h3 class="user-name m-t-0 mb-0">{{$company_data->title}}</h3>
                                                    <div class="small doj text-muted">{{__('trans.Date of Join')}} :{{$company_data->created_at}}</div>   
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <ul class="personal-info">
                                                    <li>
                                                        <div class="title">{{('trans.Count Employee')}}:</div>
                                                        <div class="text">{{$count}}</div>
                                                    </li>
                                                   
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pro-edit"><a  href="{{ url('admin/edit-company/'.$company_data->id) }}" data-toggle="modal" data-target="#edit_company" class="edit-icon" ><i class="fa fa-pencil"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- /Page Content -->
           <!-- Edit Employee Modal -->
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
                        <form action="{{route('update-company',['id'=>$company_data->id])}}"  method="Post">
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
                                <button class="btn btn-primary submit-btn">{{__('trans.Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Employee Modal -->
        </div>
        <!-- /Page Wrapper -->
@endsection