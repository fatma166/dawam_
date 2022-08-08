@extends('layout.mainlayout')
@section('title')
    {{__('trans.trakingpage')}}
@endsection
@section('content')
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{ __('trans.employee_track') }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">{{ __('trans.Dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('trans.employee_track') }}</li>
                        </ul>
                    </div>


                </div>
            </div>
            <!-- /Page Header -->
       <!-- Search Filter -->
       <form>
                    <div class="row filter-row">

                        <div class="col"> 
                            <div class="form-group form-focus ">
                              <select class="employee_name  form-control" name="emp_name"></select>                                                        
                                <label class="focus-label">{{__('trans.Select Employee')}}</label>
                            </div>
                        </div>

                        <div class="col"> 
                            <div class="form-group form-focus ">
                                <select class="select floating branch" name="branch"> 
                                     <option value="">{{__('trans.all')}}</option>
                                    @foreach($branches as $branch)
                                    <option value="{{$branch->id}}">{{$branch->title}}</option>
                                   @endforeach
                                </select>
                                <label class="focus-label">{{__('trans.Select Branch')}}</label>
                            </div>
                        </div>

                        <div class="col">                           
                            <div class="form-group form-focus ">                                    
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_from"></div>
                                    <label class="focus-label">{{__('trans.Select Date From')}}</label>
                            </div>
                        </div>

                        <div class="col"> 
                                 <?php // $min=(now()->year)-3;?>              
                                <div class="form-group form-focus">
                                   
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_to"></div>
                                    <label class="focus-label">{{__('trans.Select Date To')}}</label>
                                </div>                               
                        </div>
                      
                        
                      
                        <div class="col">  
                            <a  class="btn btn-success btn-block" id="search"> {{__('trans.Search')}} </a>  
                        </div> 

                    </div>
                </form>


            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">

                        {!! $dataTable->table() !!}

                      
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

  


    </div>


@endsection
@section('script')
<script>
              
$(document).ready(function(){
    
$("#search").click(function () {
    LaravelDataTables["employee_track-table"].draw();
});

LaravelDataTables["employee_track-table"].on("preXhr",function ( e, settings, data ) {
        data.branch=$("form select[name='branch']").val();
        data.emp_name=$("form select[name='emp_name']").val();
        data.date_from=$("form input[name='date_from']").val();
        data.date_to=$("form input[name='date_to']").val();
        console.log(data);
 });

  




});
    	


</script>
@endsection
@prepend('footer')

{!! $dataTable->scripts() !!}

@endprepend