@extends('layout.mainlayout')

@section('title')
    {{__('trans.Show_Employe_Evaluation')}}
@endsection

@section('content')




         <!-- /Table Grid -->
            <div class="page-wrapper">
                <!-- Page Content -->
                <div class="content container-fluid">
                   <!-- Page Header -->
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">{{ __('trans.Show_Employe_Evaluation') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('trans.Show_Employe_Evaluation') }}</li>
                                </ul>
                            </div>
                            
                            <div class="col-auto float-right ml-auto">
                               
                                
                              
                                
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
        
             	<!-- Search Filter -->
				
					<div class="row filter-row">
                           
						<div class="col-3"> 
						<?php $min=(now()->year)-3;?>
							<div class="form-group form-focus select-focus">
								<select class="select floating year" name="year"> 
									<option value="all">-</option>
									
									@for($year=now()->year; $year>$min; $year--)
										<option value="{{$year}}">{{$year}}</option>
									@endfor
								</select>
								<label class="focus-label">{{__('trans.Select Year')}}</label>
							</div>
						</div>
                           
    					   	<div class="col-3">  
    							<div class="form-group form-focus">
                                <select class="employee_name  form-control" name="employee_name">
                                    
                                </select>
    							
    								<label class="focus-label">{{__('trans.Employee Name')}}</label>
    							</div>
                               
    						</div>
                              
                    
                       
     	            
					
						<div class="col-3">  
                            <a href="#" class="btn btn-danger btn-block" id="empeval_chart"
                            href="#"  
                             data-href="{{ url('admin/showemplopyechart') }}"> 
                            {{__('trans.EvaluationChart')}}
                         </a> 
                        
						</div>     

                    </div>
				
                    
                  <hr />
          
        <!-- /Page Content -->

         <div class="row">
    
                <div class="col-sm-12">
    
                    @if(Session::has('success'))
    
                        <p class="alert alert-danger">{{ Session::get('success') }}</p>
    
                    @endif
    
                </div>
    
          
            
            
          <!-- /Table List -->
                <div class="col-md-12">
                    
                    <div class="table-responsive evalaution_table">
                         	<div class="row filter-row">
                        
    					     	<div class="col-6">  
                                      <h3 id="eval_year"></h3>
                                 </div>
                                 	<div  class="col-6">  
                                       <h3 id="emp_name"></h3>
                                  </div>
                            </div>   
                        
                         <hr/>
                        
                         
                         <div id="line-chart">
                    
                         </div>
                         
                    </div>
                </div>
                   <!-- /End Table List -->   
              </div>
            
            
        
      
   
     
 {{-- ShowEvalautionChart   --}}

 {{-- <div id="ShowEvalautionChart" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="eval_year"></h3>
                <hr/>
                <h3 id="emp_name"></h3>
            </div>
            <div class="modal-body">
             
                  <div id="line-chart">
                    
                  </div>
                  
               

                    
            </div>
        </div>
    </div>
</div> --}}
  {{-- ShowEvalautionChart   --}}  
</div>
            
  
 </div>
     



  
@endsection
 @section('script')
 

<script>

    //charts
    $("#empeval_chart").click(function(event)
    {
         var employee_id= $(".employee_name").val();
         if(employee_id==null)
         {
            alert('Please Select Employe First');
            return;
            
         }
         else
         {
              
                let getHref=baseUrl+"showemplopyechart";
        
              
                var year=$('.year').val();
                var now=new Date();
               
                 
                   if(year=='all')
                   {
                    $("#eval_year").text(now.getFullYear());
                   }
                   else
                   {
                     $("#eval_year").text(year);
                   }
                     $("#emp_name").text($(".employee_name").text());
                    
                     $("#eval_year").addClass('btn btn-outline-warning');
                     $("#emp_name").addClass('btn btn-outline-warning');
                    //  $("#eval_year").css('display','block');
                    //  $("#emp_name").css('display','block');
                    $(".employee_name").empty();
                 
                	$.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					url:getHref,
                    data:{employee_id:employee_id,year:year},
					}).done(function(data) {
                        // console.log(data);
                        // return;
                      // console.log(data);
                      // return;
                        $("#line-chart").empty();
                      
                     
                                                                                                                                                                                                         
        		Morris.Line({
        		element: 'line-chart',
        		data:data,
        		xkey: 'month',
                ykeys: ['emp_degree'],
              
        	    //ykeys: ['emp_degree','evaluation_degree'],
               // labels: ['Evaluation Degree','From Degree'],
               // ykeys: ['Total'],
        		labels: ['Evaluation Precent %'],
        		lineColors: ['#1DB9C3'],
        		lineWidth: '4px',
        		resize: true,
        		redraw: true,
                parseTime: false
        	});

         

        	});
           
                  
         }
    });
    
		
</script>

<script src="{{asset('plugins/morris/morris.min.js')}}"></script>
 <script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>
 <script src="{{asset('js/chart.js')}}"></script>		


@endsection
