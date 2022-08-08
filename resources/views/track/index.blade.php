@extends('layout.mainlayout')

@section('title')
    {{__('trans.track')}}
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
                            <h3 class="page-title">{{__('trans.track')}}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                                <li class="breadcrumb-item active">{{__('trans.track')}}</li>
                            </ul>
                        </div>
             
                    </div>
                </div>
                <!-- /Page Header -->
                <!--search filter-->
                <form method="post">
                <div class="row filter-row" id="track">
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">  
                        <div class="form-group form-focus">
                          <select class="employee_name  form-control" name="employee_name"></select>
                            <!--<input type="text" class="form-control floating employee_name"  />-->
                            <label class="focus-label">{{__('trans.Employee Name')}}</label>
                        </div>
                   </div>

                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">  
                        <div class="form-group form-focus" >
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text" name="date">
                            </div>
                            <label class="focus-label">{{__('trans.date')}}</label>
                        </div>
                    </div>
        
                   <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">  
                        <a  class="btn btn-success btn-block" id="search_track"> {{__('trans.Search')}} </a>  
                   </div>     
                </div>
                </form>
                <!-- /Search Filter -->
                
                  @include('track.search')
                            
                



                        
    </div>
       
</div>
        <!-- /Page Wrapper -->
        
         @section('script')
         <script>
	
         </script>
         @endsection
         
<style>#mapCanvas {
    width: 100%;
    height: 650px;
}</style>
@endsection
