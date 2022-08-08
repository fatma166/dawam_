@if($type!="ajax")
@extends('layout.mainlayout')
@section('title')
    {{__('trans.evaluation_report')}}
@endsection
@section('content')
@endif
@if($type!="ajax")
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
                    

                </div>
            </div>
            <!-- /Page Header -->
         
                <!-- Search Filter -->
                <form>
                    <div class="row filter-row">

                        <div class="col-sm-6 col-md-3"> 
                            <!---<div class="form-group form-focus ">
                                <select class="select floating month"> 
                                
                                    <option value="1">Jan</option>
                                    <option value="2">Feb</option>
                                    <option value="3">Mar</option>
                                    <option value="4">Apr</option>
                                    <option value="5">May</option>
                                    <option value="6">Jun</option>
                                    <option value="7">Jul</option>
                                    <option value="8">Aug</option>
                                    <option value="9">Sep</option>
                                    <option value="10">Oct</option>
                                    <option value="11">Nov</option>
                                    <option value="12">Dec</option>
                                </select>
                                <label class="focus-label">{{__('trans.Select Month')}}</label>
                            </div>-->
                            <div class="form-group form-focus ">
                                    
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_from"></div>
                                    <label class="focus-label">{{__('trans.Select Date From')}}</label>
                            </div>

                        </div>
                        <div class="col-sm-6 col-md-3"> 
                                 <?php // $min=(now()->year)-3;?>
               
                                <div class="form-group form-focus">
                                   
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_to"></div>
                                    <label class="focus-label">{{__('trans.Select Date To')}}</label>
                                </div>
                                
                        </div>
                         <div class="col-sm-6 col-md-3"> 
                            <div class="form-group form-focus ">
                                <select class="select floating department" >    
                                 <option value="all">{{__('trans.all')}}</option>
                                    @foreach($departments as $dep)         
                                    <option value="{{$dep->id}}">{{$dep->title}}</option>
                                   @endforeach
                                </select>
                                <label class="focus-label">{{__('trans.Select Department')}}</label>
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
                        
                        <div class="col-sm-6 col-md-3"> 
                            <div class="form-group form-focus ">
                              <select class="employee_name  form-control" name="employee_name"></select>                            
                               <!-- <select class="select floating employee"> 
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                                   @endforeach
                                </select>-->
                                <label class="focus-label">{{__('trans.Select Employee')}}</label>
                            </div>


                        </div>
                        <div class="col-sm-6 col-md-3">  
                            <a  class="btn btn-success btn-block" id="evaluation_search"> {{__('trans.Search')}} </a>  
                        </div>     
                    </div>
                </form>
                <!-- /Search Filter -->
@endif


            <div class="row">
                <div class="col-2">
                    <a href="{{url('admin/monthlyPrint/evalaution')}}" class="btn btn-primary shift-continue-btn" id="month_printlink">{{__('trans.Print Month Report')}}</a>
                </div>
            </div>
            <div class="row" id="month_body">
                <div class="col-md-12 month_result" >
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable" id="table_search">
                             <thead>
                                
                                   <th>#</th>
                                   <th></th>
                                    <th>{{ __('trans.Title') }}</th>
                                    @if(Auth::user()->role_id==2)
                                         <th>{{ __('trans.Company Title') }}</th>
                                    @endif
                                    <th>{{ __('trans.evaluation_month') }}</th>
                                    <th>{{ __('trans.Evaluation_Year') }}</th>
                                    <th>{{ __('trans.employe_job') }}</th>
                                      <th>{{ __('trans.employe_department') }}</th>
                                    <th>{{ __('trans.Branch') }}</th>
                                    <th>{{ __('trans.Total_evalaution') }} </th>
                                   
                                 
                                   
                            </thead>
                            <tbody>
                           <div id="load" style="display:none">Please wait... <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" style="width:24px"/></div>

                              
                         <?php $i=0; ?>
                          @if($type!="ajax")
                          @foreach($monthly as $item)
                          @else
                          @foreach(month2 as $item)
                          @endif
                             <?php $i++; ?>                           
                                <tr>
                                    <td>{{$i}}</td>
                                    <td><input type="checkbox" checked="true" disabled="true" /></td>
                                      <td>
                                            <h2 class="table-avatar">
                                                  <a class="dropdown-item" href="{{ url('admin/branch-edit/') }}"
                                                       data-href="{{ url('admin/evaluationemplpye-edit/') }}" empevalution-id="" data-toggle="modal" data-target="#edit_empevalaution"
                                                       ><span>{{$item['user_name']}} </span></a>
                                          
                                            </h2> 
                                        </td>
                                         
                                        <td>
                                        {{date("M",mktime(0,0,0,$item['month']))}}
                                        <input type="hidden" value="{{$item['month']}}" name="month"/>
                                        
                                        </td>
                                        <td>
                                         {{$item['year']}}
                                           <input type="hidden" value="{{$item['year']}}" name="year"/>
                                         </td>
                                        
                                        <td>{{$item['job']}}</td> 
                                         <td>{{$item['department']}}</td>
                                          <td>{{$item['branch']}}</td>
                                          <td>
                                          @if(!empty($item['emp_degree']))
                                           <p><strong><small>{{round(($item['emp_degree']/$item['evaluation_degree'])*100,2)}} % </small></strong></p>
                                          
                                            <div class="progress">
												<div class="progress-bar bg-primary" role="progressbar" style="width:{{($item['emp_degree']/$item['evaluation_degree'])*100}}%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100">
                                                  
                                                </div>
											</div>
                                            
                                            @endif
                                          </td>
                                        
                                    </tr>
                          
                                @endforeach
                          

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
         
        </div>
        <!-- /Page Content -->
       @if($type!="ajax")


    </div>
   
@endsection
 @endif
 @section('scripts')
    <script>
        $(document).ready(function() {
            $('#quiztable').DataTable({
                dom: "Blfrtip",
                buttons: [
                    {
                        text: 'csv',
                        extend: 'csvHtml5',
                    },
                    {
                        text: 'excel',
                        extend: 'excelHtml5',
                    },
                    {
                        text: 'pdf',
                        extend: 'pdfHtml5',
                    },
                    {
                        text: 'print',
                        extend: 'print',
                    },  
                ],
                columnDefs: [{
                    orderable: false,
                    targets: -1
                }] 
            });
        });
        
        
    </script>
@endsection