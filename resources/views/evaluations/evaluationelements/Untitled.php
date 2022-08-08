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
                               
                                <a class="btn add-btn" data-toggle="modal"
                                    data-target="#add_evaluation" class="add_branch"><i class="fa fa-plus"></i> {{ __('trans.Add evaluationelement') }}</a>
                                   
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
        
      
           
              
          
            </div>
        </div>
        <!-- /Page Content -->

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
                                        <label class="col-form-label">{{__('trans.Title')}} <span class="text-danger" >*</span></label>
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
                                        <label class="col-form-label">{{__('trans.degree_evaluation')}} <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="degree" />
                                        @error('degree')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
									    @enderror
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
               
     
         
      
        </div>
        <!-- /Add Branch Modal -->
     

 


@include('./layout.partials.map_script')

@endsection
 @section('script')
<script>
 /*evaluation  elements */
  
            
            $("#add_bank button,#edit_bank button").click(function(e){
                
                e.preventDefault();
                var data;
    			var url="";     
    		    if($(this).attr('type')==="add"){
                    url=$('#add_evaluation form').attr('action');
                    var title= $("form input[name='title']").val();	
        			var degree= $("form input[name='degree']").val();
        		       		                                                     
    			    data= {title:title,degree:degree};
                 
                 
                 }
    			if($(this).attr('type')==="edit"){
                           url=$('#edit_bank form').attr('action');
                            var name= $("form input[name='name']").val();	
                			var account_number= $("form input[name='account_number']").val();
                			
                			var balance= $("form input[name='balance']").val();
                		
                                                             
            			    data= {name:name,account_number:account_number,balance:balance};
                 }
    		
                $.ajax({
                    url:url,
                    type:'POST',
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
      
   		
	
</script>
@endsection
 