@extends('layout.mainlayout')

@section('title')
     {{__('trans.available')}}
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
                            <h3 class="page-title">{{__('trans.available')}}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">{{__('trans.Dashboard')}}</a></li>
                                <li class="breadcrumb-item active">{{__('trans.available')}}</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                          
                            <div class="view-icons">
                                <a href="employees" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                                <a href="employees-list" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <!-- Search Filter -->
                <form method="get" class="avaliable_search">
                <div class="row filter-row">

                    <div class="col-sm-3 col-md-3">  
                        <div class="form-group form-focus">
                            <select class="employee_name  form-control" name="employee_name"></select>
                            <label class="focus-label">{{__('trans.Employee')}}</label>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3"> 
                        <div class="form-group form-focus select-focus">
                            <select class="select floating client"> 
                             <option value="all">{{__('trans.all')}}</option>
                               @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->name}}</option>
                               @endforeach
      
                            </select>
                            <label class="focus-label">{{__('trans.clients')}}</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3"> 
                        <div class="form-group form-focus ">
                            <select class="select floating branch"> 
                                 <option value="all">{{__('trans.all')}}</option>
                                @foreach($branchs as $branch)
                                <option value="{{$branch->id}}">{{$branch->title}}</option>
                               @endforeach
                            </select>
                            <label class="focus-label">{{__('trans.Select Branch')}}</label>
                        </div>


                    </div>
                    <input  type="hidden" class="type" value="{{$type}}"/>
                    <div class="col-sm-3 col-md-3">  
                        <a href="#" class="btn btn-success btn-block" id="search_available"> {{__('trans.Search')}} </a>  
                    </div>
                </div>
                </form>
                <!-- Search Filter -->
               <div class="row staff-grid-row available_data">
                 @include('available_employee.search')
               </div>
            </div>
            <!-- /Page Content -->
            

            
</div>
<!-- /Page Wrapper -->
<style>
.more{display: none;}

</style>

@endsection