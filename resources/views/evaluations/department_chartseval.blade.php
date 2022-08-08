@extends('layout.mainlayout')

@section('title')
    {{__('trans.showdeparteval')}}
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
                                <h3 class="page-title">{{ __('trans.showdeparteval') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('trans.showdeparteval') }}</li>
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
							<div class="form-group form-focus select-focus">
								<select class="select floating month" name="month"> 
									<option value="all">-</option>
									<option value="01">Jan</option>
									<option value="02">Feb</option>
									<option value="03">Mar</option>
									<option value="04">Apr</option>
									<option value="05">May</option>
									<option value="06">Jun</option>
									<option value="07">Jul</option>
									<option value="08">Aug</option>
									<option value="09">Sep</option>
									<option value="10">Oct</option>
									<option value="11">Nov</option>
									<option value="12">Dec</option>
								</select>
								<label class="focus-label">{{__('trans.Select Month')}}</label>
							</div>
						</div>  
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
    							<div class="form-group form-focus select-focus">
                                <select class="select departcharts" name="department">
                                    <option value="all">-</option>
                                   @foreach($departments as $depart) 
                                     <option value={{$depart->id}}>{{$depart->title}}</option>
                                   @endforeach
                                </select>
    							
    								<label class="focus-label">{{__('trans.department')}}</label>
    							</div>
                               
    						</div>
                              
                    
                       
     	            
					
						<div class="col-3">  
                            <a href="#" class="btn btn-danger btn-block" id="empeval_chart"
                            href="#"  
                             data-href="{{ url('admin/showjobcharts') }}"> 
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
                                       <h3 id="eval_month"></h3>
                                  </div>
                            </div>   
                        
                         <hr/>
                        
                         
                         <div id="line-chart">
                    
                         </div>
                         
                    </div>
                </div>
                   <!-- /End Table List -->   
              </div>
            
            
        
      
   
     
 
</div>
            
  
 </div>
     



  
@endsection
 @section('script')
 


 <script>


      
    //charts
    $("#empeval_chart").click(function(event)
    {
         var depart_id= $(".departcharts").val();
        
         if(depart_id=='all')
         {
            alert('Please Select department First');
            return;
            
         }
         else
         {
              
              
                let getHref=baseUrl+"showdepartmentscharts";
                
                var now=new Date();
              
                var year=$('.year').val();
                if(year=='all')
                {
                    year=now.getFullYear();
                }
               
                var month=$('.month').val();
                if(month=='all')(month="01")
              
              
              $("#eval_year").text(year);
               
              $("#eval_month").text(month);
              
              //addbootstrap class
              $("#eval_year").addClass('btn btn-outline-warning');
                $("#eval_month").addClass('btn btn-outline-warning');
                   //  $("#emp_name").text($(".employee_name").text());
                  //  $(".employee_name").empty();
                 
                  
                 
                	$.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					url:getHref,
                    data:{depart_id:depart_id,year:year,month:month},
					}).done(function(data) 
                    {
                      //console.log(data);
                     //   return;
                        $("#line-chart").empty();
                            Morris.Line({
                            element: 'line-chart',
                            data:data,
                            xkey: 'user_name',
                            ykeys: ['emp_degree'],
                        
                            //ykeys: ['emp_degree','evaluation_degree'],
                        // labels: ['Evaluation Degree','From Degree'],
                        // ykeys: ['Total'],
                            labels: ['job Evaluation Precent %'],
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
