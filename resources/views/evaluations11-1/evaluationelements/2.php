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
                                <h3 class="page-title">{{ __('trans.evaluation') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">{{ __('trans.Dashboard') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('trans.evaluation') }}</li>
                                </ul>
                            </div>
                            
                            <div class="col-auto float-right ml-auto">
                               
                                
                                <button class="btn add-btn" id="evlauation_val" data-toggle="modal" data-target="#add_evaluation" 
                                 class="add_evaluation" disabled="true"><i class="fa fa-plus"></i> {{ __('trans.Add evaluationelement') }}</button>   
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
										<table class="table table-striped mb-0"  id="table_search">
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
                                                               data-href="{{ url('admin/edit-evaluation/'.$evaluation->id) }}" evaluation-id="{{$evaluation->id}}" data-toggle="modal" data-target=""
                                                               ><span>@if (isset($evaluation->title)) {{ $evaluation->title }} @endif</span>
                                                            </a>
                                                       </td>
    												
    												    <td class="text-right">
                                                            <div class="dropdown dropdown-action">
                                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" href="#" data-href="{{ url('admin/edit-evaluation/'.$evaluation->id)}}" evaluation-id="{{$evaluation->id}}" data-toggle="modal" data-target="#edit_evaluation"><i class="fa fa-pencil m-r-5"></i> {{__('trans.Edit')}}</a>
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_evaluation" delete-id="{{$evaluation->id}}"><i class="fa fa-trash-o m-r-5"></i> {{__('trans.Delete')}}</a>
                                                                </div>
                                                            </div>
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
                        <form method="post" action="{{route('store-Evaluation')}}">
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
                              
                             
                             
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                      
                                        <label class="col-form-label">{{__('trans.Total_evaluation_element')}} : </label>
                                        <label class="col-form-label" name="get_total_evaluation"></label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                       
                                        <label class="col-form-label">{{__('trans.Remnider_evaluation_element')}}</label>
                                        <label class="col-form-label" name="reminder_evaluation"></label>
                                    </div>
                                </div>

                            </div>
                           
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn evaluationelement-btn" type="add">{{__('trans.Submit')}}</button> <!--onclick="masterAdd('#add_branch','{{route('store-branch')}}')"-->
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
                        <h5 class="modal-title">{{__('trans.Edit')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form method="post">
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.evaluation_element')}}<span class="text-danger">*</span></label>
                                        <input class="form-control " name="title" type="text">
                                    </div>
                                </div>

                              
                              
                            </div>
                              <hr />
                             <div class="row">
                             
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      
                                        <label class="col-form-label">{{__('trans.Total_evaluation_element')}} : </label>
                                        <label class="col-form-label" name="total_evaluation_element"></label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                       
                                        <label class="col-form-label">{{__('trans.Remnider_evaluation_element')}}</label>
                                        <label class="col-form-label" name="reminder_evaluation_element"></label>
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

 
 
 
 

@endsection
 @section('script')
<script>
 /*evaluation  elements */
             //onshow add mdoula
        //for show and hide  add modula
         $(document).ready(function(){
             $.ajax
                ({
                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                 
                 url:"get-totalEvaluation",
                  success: function(data)
                   {
                      if(data>=100)
                      {
                         $('#evlauation_val').prop('disabled', true);
                         $('.note_title').attr('hidden',false);
                      }
                     
                     else
                     {
                        $('#evlauation_val').prop('disabled', false);
                        $('.note_title').attr('hidden',true);
                     }
                     
                      
                    }
              
    
                });    
         });    
            
             
   			$("#add_evaluation").on('show.bs.modal', function(event) 
              {
                
               
                $.ajax
                ({
                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                 url:"get-totalEvaluation",
                  success: function(data) {
                       
                     
                      $("#add_evaluation form label[name='get_total_evaluation']").text(data);
                      $("#add_evaluation form label[name='reminder_evaluation']").text(100- data);
                      
                      
                    }
              
    
                });    
			         
	    	  });
            
            $(".evaluationelement-btn,.evaluation-update").click(function(e){
                
                e.preventDefault();
                var data;
    			var url="";     
    		    if($(this).attr('type')==="add"){
                    url=$('#add_evaluation form').attr('action');
                    var title= $("#add_evaluation form input[name='title']").val();	
        			var degree= $("#add_evaluation form input[name='degree']").val();
                   
        		    var reminderevaluation= $("#add_evaluation form label[name='reminder_evaluation']").text();
                    
                   if(degree<reminderevaluation)
                   {
                    data= {title:title,degree:degree};
                   }
                   else
                   {
                      alert('Entered Element_Dgree greater than reminder');
                      window.location.reload();
                   }	                                                     
    			    
                                  
                 }
    			if($(this).attr('type')==="edit"){
                           url=$('#edit_evaluation form').attr('action');
                            var title= $("#edit_evaluation form input[name='title']").val();	
        		        	var degree= $("#edit_evaluation form input[name='degree']").val();                           
    			            data= {title:title,degree:degree};
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
                      
                	$.each(data,function(index,method){
				    //    console.log(data);
				        $("#edit_evaluation form input[name='title']").val(method.title);
				     	$("#edit_evaluation form input[name='degree']").val(method.degree);
                        $("#edit_evaluation form label[name='total_evaluation_element']").text(method.total_eval);
                        
                        $("#edit_evaluation form label[name='reminder_evaluation_element']").text(100 - (method.total_eval));
                       

					});
                    
	
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
    				     location.reload(true);
    	
    				});
                });
			
			});
          
	
</script>
@endsection
 