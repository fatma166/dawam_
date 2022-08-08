@extends('layout.mainlayout')

@section('title')
    {{__('trans.evaluation')}}
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
                                <h3 class="page-title">{{ __('trans.elements-evaluation') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">{{ __('trans.Dashboard') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('trans.evaluation') }}</li>
                                </ul>
                            </div>
                            
                            <div class="col-auto float-right ml-auto">
                               
                                
                                <button class="btn add-btn" id="evlauation_val" data-toggle="modal" data-target="#add_evaluation" 
                                 class="add_evaluation"><i class="fa fa-plus"></i> {{ __('trans.Add evaluationelement') }}</button>  
                                
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
        
      
           
              
          
        <!-- /Page Content -->

         <div class="row">
    
                <div class="col-sm-12">
    
                    @if(Session::has('success'))
    
                        <p class="alert alert-danger">{{ Session::get('success') }}</p>
    
                    @endif
    
                </div>
    
            </div>
            
   

        <!-- /Table List -->
        
              <!-- table -->
           
						<div class="col-lg-12 col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table" id="table_search">
											<thead>
												<tr>
							    	                 <th>{{__('trans.evaluation_element')}}</th>
                                                      <th>{{ __('trans.Action') }}</th>
												</tr>
											</thead>
											<tbody>
                                                @foreach($evaluation as $evaluation)
    												<tr>
    													
                                                        <td>
                                                            <a class="dropdown-item" href="{{ url('admin/edit-evaluation/'.$evaluation->id) }}"
                                                               data-href="{{ url('admin/edit-evaluation/'.$evaluation->id) }}" evaluation-id="{{$evaluation->id}}" data-toggle="modal" data-target="#edit_evaluation"
                                                               ><span>@if (isset($evaluation->title)) {{ $evaluation->title }} @endif</span>
                                                            </a>
                                                       </td>
    												
    												    <!--<td class="text-right">-->
                    <!--                                        <a class="btn btn-outline-success" href="#" data-href="{{ url('admin/edit-evaluation/'.$evaluation->id)}}" evaluation-id="{{$evaluation->id}}" data-toggle="modal" data-target="#edit_evaluation"><i class="fa fa-pencil m-r-5"></i> {{__('trans.Edit')}}</a>-->
                                                            <!-- <a class="btn btn-outline-danger" href="#" data-toggle="modal" data-target="#delete_evaluation" delete-id="{{$evaluation->id}}"><i class="fa fa-trash-o m-r-5"></i> {{__('trans.Delete')}}</a>-->
                    <!--                                    </td>-->
                                                        <td class="text-right">
                                                           @if($evaluation->status==0)
                                                            <a class="btn btn-outline-success" href="#" data-href="{{ url('admin/edit-evaluation/'.$evaluation->id)}}" evaluation-id="{{$evaluation->id}}" data-toggle="modal" data-target="#edit_evaluation"><i class="fa fa-pencil m-r-5"></i> {{__('trans.Edit')}}</a>
                                                            <!-- <a class="btn btn-outline-danger" href="#" data-toggle="modal" data-target="#delete_evaluation" delete-id="{{$evaluation->id}}"><i class="fa fa-trash-o m-r-5"></i> {{__('trans.Delete')}}</a>-->
                                                            @endif
                                                        </td>
                                                        
    												</tr>
                                               @endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
                            <h5 class="note_title" hidden>{{ __('trans.Evaluation_Notification') }}</h5>
                            
                   
					</div>
                 
           
 <!-- /Table Grid -->
           
						</div>
     	           
			   
				
           
 <!-- /Table Grid -->
            <!-- table -->
            </div>
               
          <!-- /End Table List -->



  <!-- Add Branch Modal -->
        <div id="add_evaluation" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('trans.Add evaluationelement')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form method="post" action="{{route('store-Evaluation',$subdomain)}}">
                         @csrf
                            <div class="row">
                              
                            
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.evaluation_element')}} <span class="text-danger" >*</span></label>
                                        <input class="form-control" type="text" name="title" />
                                        @error('title')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
									    @enderror
                                    </div>
                                </div>
                              

                            </div>
                           
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn evaluationelement-btn" type="add">{{__('trans.Submit')}}</button> <!--onclick="masterAdd('#add_branch','{{route('store-branch',$subdomain)}}')"-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<!-- Add Branch Modal -->        

 <!-- Edit representative Modal -->
        <div id="edit_evaluation" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('trans.Edit_evaluationelement')}}</h5>
                       
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                         </div>
                        <form method="post">
                        @csrf
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.evaluation_element')}}<span class="text-danger">*</span></label>
                                        <input class="form-control" name="title" type="text" />
                                         @error('title')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
									    @enderror
                                    </div>
                                </div>

                            </div>
                            
                            
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn evaluation-update" type="edit">{{__('trans.Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit representative Modal -->  




            </div>
        </div>





      
     
         
      
        </div>
        <!-- /Add Branch Modal -->
      <!-- Delete representative Modal -->
        <div class="modal custom-modal fade" id="delete_evaluation" role="dialog">
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

 

				<!-- /Edit Client Modal -->
   <!-- /Add job - -Evaulation -->
@endsection
 @section('script')
<script>
 /*evaluation  elements */
             //onshow add mdoula
        //for show and hide  add modula
        
            
          
            
            $(".evaluationelement-btn,.evaluation-update").click(function(e){
                
                e.preventDefault();
                var data;
    			var url="";     
    		    if($(this).attr('type')==="add"){
                    url=$('#add_evaluation form').attr('action');
                    var title= $("#add_evaluation form input[name='title']").val();	
                    data= {title:title};
        	          
                 }
    			if($(this).attr('type')==="edit"){
                           url=$('#edit_evaluation form').attr('action');
                            var title= $("#edit_evaluation form input[name='title']").val();	
                                        
    			            data= {title:title};
    		}
                $.ajax({
                    url:url,
                    method:'POST',
    			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:data,
                    success: function(data) {
                       
                       if(data.hasOwnProperty('success')){
    				
                           location.reload(true);
                        }else{
                         
                            printErrorMsg(data.error);
                        }
                    }
                
            });
        });
      
   		  //onshow 
   			$("#edit_evaluation").on('show.bs.modal', function(event) 
               {
                        
				var button = $(event.relatedTarget) //Button that triggered the modal
			
				var getHref = button.data('href'); //get button href
				
				var id = button.attr('evaluation-id'); 

				update_url=baseUrl+"update-evaluation/"+id;
				$('#edit_evaluation form').attr('action',update_url);
				$.ajax({
					url:getHref,
                    // data:{id:id},
				
					}).done(function(data) {
				    // console.log(data);
                      
                	/*$.each(data,function(index,method){
             	    });*/
				    //    console.log(data);
				        $("#edit_evaluation form input[name='title']").val(data.title);
				     

					
                    
	
				});
			});
            
          
             /* method DELETE */
			  
			$("#delete_evaluation").on('show.bs.modal', function(event) {
				var button = $(event.relatedTarget) //Button that triggered the modal
				var id = button.attr('delete-id');
				del_id=id;
				delete_url=baseUrl+"delete-evaluation";
                $("#delete_evaluation .continue-btn").click(function(){
                    	$.ajax({
    					url:delete_url,    
    					data:{id:del_id},
    					 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    					type:"post"
    					}).done(function(data) {
    					  // console.log(data);
                          // return;
    				     location.reload(true);
    	
    				});
                });
			
			});
            
 
      
       
           
           
            
          
          
          
            /* Evaluation job  
			
              
            $('#job_evaluation').on('show.bs.modal',function(event){
                 var url=baseUrl+'get-jobs';
                 	$.ajax({
					url:url,
                    
				
					}).done(function(data) {
				    // console.log(data[1]);
                    
                    //select loop
                       $('#job_evaluation select[name="job_evalutions"]').empty();
                        $('#job_evaluation select[name="job_evalutions"]').append('<option selected disabled>Choose</option>');
                        $.each(data[0], function(index, method) {
                            $('#job_evaluation select[name="job_evalutions"]').append('<option value="' + index + '">' + method + '</option>');
                        });
                
				     
                     //foreach loop
                     
                       
                        $('.custom-table tr').each(function () {
       
                         $(this).find('.evaluation_elements').each(function () {

            
                         });
    });
                     

					});
                    
	
				});
           */
            
          
	
</script>


@endsection
 