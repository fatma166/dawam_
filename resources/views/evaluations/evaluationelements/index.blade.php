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
                                    data-target="#add_evaluation" class="add_evaluation"><i class="fa fa-plus"></i> {{ __('trans.Add evaluationelement') }}</a>
                                   
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
     

 



@endsection
 @section('script')
<script>
 /*evaluation  elements */
  
            
            $(".evaluationelement-btn,#edit_bank button").click(function(e){
                
              
        });
      
   		
	
</script>
@endsection
 