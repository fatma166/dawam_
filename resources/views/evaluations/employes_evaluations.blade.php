@extends('layout.mainlayout')

@section('title')
    {{__('trans.evaluation_employes')}}
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
                                <h3 class="page-title">{{ __('trans.evaluation_jobs') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('trans.evaluation') }}</li>
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
					 <form method="get">
					<div class="row filter-row" id="evalua_emp">
                        <div class="col-2"> 
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
						<div class="col-2"> 
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
                           
    					   	<div class="col-2">  
    							<div class="form-group form-focus">
                                <select class="employee_name  form-control" name="employee_name">
                                    
                                </select>
    							
    								<label class="focus-label">{{__('trans.Employee Name')}}</label>
    							</div>
                               
    						</div>
                              
                      <div class="col-2"> 
                            <div class="form-group form-focus ">
                                <select class="select floating department" name="department">    
                                 <option value="all">{{__('trans.all')}}</option>
                                    @foreach($departments as $dep)         
                                    <option value="{{$dep->id}}">{{$dep->title}}</option>
                                   @endforeach
                                </select>
                                <label class="focus-label">{{__('trans.Select Department')}}</label>
                            </div>


                        </div>
                        <div class="col-2"> 
                            <div class="form-group form-focus ">
                                <select class="select floating branch" name="branch"> 
                                     <option value="all">{{__('trans.all')}}</option>
                                    @foreach($branchs as $branch)
                                    <option value="{{$branch->id}}">{{$branch->title}}</option>
                                   @endforeach
                                </select>
                                <label class="focus-label">{{__('trans.Select Branch')}}</label>
                            </div>


                        </div>
                      
     	            
					
						<div class="col-2">  
							<a class="btn btn-success btn-block" id="search_empeval"> {{__('trans.Search')}} </a> 
						</div>  
                        
                      

                    </div>
					</form>
                      <!-- /Search Filter -->
                  <div id="search_data">
                    @include('evaluations.evaluationsearch')
                  </div>
                  
     @section('script')
         <script type="text/javascript">
             $(window).on('hashchange', function() {
           if (window.location.hash) {
                  var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                   }else{
                    getData(page);
                   }
                 }
         });
      //
    $(document).ready(function()
    {
       // $('#search_data').hide();
        $(document).on('click', '#search_data .pagination a',function(event)
        {
           
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            $('#search_empeval').append('<img style="position: absolute; left: 0; top: 0; z-index: 10000;" src="https://i.imgur.com/v3KWF05.gif />');
            var myurl = $(this).attr('href');
            // alert(myurl);
            var page=$(this).attr('href').split('page=')[1];
  
            getData(page);
        });
  
    });
    function getData(page)
    {
      
        var today = new Date();
            var employee_name= $("#evalua_emp .employee_name").val();
            var department=$("#evalua_emp .department").val();
            var month=$("#evalua_emp .month").val();
            if(month=='all')
            {
                month=((today.getMonth()+1) <= 9 ? '0': '') + (today.getMonth()+1) ;
            }

            var year=$('#evalua_emp .year').val();
            if(year=='all')
            {
                year=(today.getFullYear()) ;
            }
            var branch=$("#evalua_emp .branch").val();
            data={employee_name:employee_name,department:department,branch:branch,month:month,year:year};
       
        $.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"get",
			    url: '?page=' + page,
			 	data:data,
                beforeSend: function() { $("#search_data #load").show(); },
				}).done(function(data) {

                        history.pushState('', '',"{{url('admin/evaluation_employes')}}"+"?employee_name="+employee_name+"&department="+department +"&branch="+branch+"&month="+month+"&year="+year+"&page="+page);
			
                    
                    $("#search_data #load").hide();
					$("#search_data").empty();
					$("#search_data").append(data);
                  // $('#search_data').find('#table_search').DataTable({"scrollX": true});
                 //  $('#search_data').find('.dataTables_scrollBody').css({"overflow-x":" scroll","max-width": "110%","display": "block"});
			});
    }
    
    

</script>
@endsection
         <div class="row">
    
                <div class="col-sm-12">
    
                    @if(Session::has('success'))
    
                        <p class="alert alert-danger">{{ Session::get('success') }}</p>
    
                    @endif
    
                </div>
    
          
            
            
  
         </div>
            
            
        <!-- Edit job_evaluation Modal -->
        <div id="edit_evaluationemp" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                       
                          <h4>{{__('trans.Edit_EmployeEvaluation')}}
                           <label class="modal-title" style="color: red;"></label>
                           </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form method="POST">
                           @csrf
                           
							     
                                  <div id="edit_employeevaluation">
                                        
                                        
                                        
                                  </div>			
					     
                              
                              <button class="btn btn-primary" type="edit">{{__('trans.Save')}}</button> 
                           
                           
                           
                           
                            
                                 
                               
                           
                           
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
       <!-- Edit job_evaluation Modal -->
            
            
                <div id="employes_evaluation" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">{{__('trans.add_employe_evaluation')}}</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
                             
								<form method="post" action="{{route('store_employeevaluation',$subdomain)}}">
                                 @csrf
                                 
									<div class="row filter-row">
									
                                     <div class="col-sm-6 col-md-3"> 

                                      </div>		
  
                                    </div>
                                    <div id="eva_element">
                                         
                                    </div>

								</form>
       
							</div>
						</div>
					</div>
          </div>
   <!-- /Add job - -Evaulation -->
   
     <!-- Delete representative Modal -->
        <div class="modal custom-modal fade" id="delete_empevaluation" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>{{__('trans.Delete evaluation')}}</h3>
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
 <!-- Delete representative Modal -->
     
 {{-- ShowEvalautionChart   --}}

 <div id="ShowEvalautionChart" class="modal custom-modal fade" role="dialog">
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
</div>
  {{-- ShowEvalautionChart   --}}  
</div>
            
  
 </div>
    
@endsection
 @section('script')
 

<script>
 


 $('#emp_evaljob').on('change',(event) =>
  {
        var user_id=event.target.value
         //alert(user_id);
        $(".month").prop("disabled",false);
        var gethref=baseUrl+"getemployejob_id/"+user_id;
    	$.ajax
            ({
			     url:gethref
              				
			}).done(function(data) {
			       
                   console.log(data);
                   if(data)
                     {
                   
                         $('#eva_element').empty();
                        $('#eva_element').append(data);
                        // $("#evaluation_emptable").css('display','block');
                     }
                     
                     });
                    
    
 });
 

		
</script>



@endsection
