@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">

                    <!-- Breadcrumb -->
                    <div class="col">
                        <h3 class="page-title">{{__('trans.category')}}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">{{__('trans.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{__('trans.category')}}</li>
                        </ul>
                    </div>
                     <!-- Breadcrumb -->
                    
                     <!-- Add Button -->
                  <div class="col-auto float-right ml-auto">
                       
                        <a class="btn add-btn" data-toggle="modal" data-target="#add_category"><i class="fa fa-plus"></i>{{__('trans.add')}}</a>
                           
                        <div class="view-icons">
                            <a href="" class="grid-view btn btn-link"><i
                                    class="fa fa-th"></i></a>
                            <a href="category-list" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>
                        </div>
                  </div>
                    <!-- Add Button -->
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
    
                <div class="col-sm-12">
    
                    @if(Session::has('success'))
    
                        <p class="alert alert-danger">{{ Session::get('success') }}</p>
    
                    @endif
    
                </div>
    
            </div>
               <!-- table -->
            <div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped mb-0"  id="table_search">
											<thead>
												<tr>
													<th>{{__('trans.title')}}</th>
            	                                    <th>{{__('trans.status')}}</th>
													<th>{{__('trans.edit')}}/{{__('trans.delete')}}</th>
												</tr>
											</thead>
											<tbody>
                                                @foreach($category as $cat)
    												<tr>
    													<td>{{$cat->title}}</td>
                                                        <td class="text-center">
                                                            <div class="dropdown action-label">
                                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-dot-circle-o @if($cat->status==0){{'text-danger'}}@else {{'text-success'}} @endif">@if($cat->status==0){{__('trans.NotActive')}}@else{{__('trans.Active')}}@endif</i> 
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_category" status="1" category_id="{{$cat->id}}"><i class="fa fa-dot-circle-o text-success"></i> {{__('trans.Active')}}</a>
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_category" status="0" category_id="{{$cat->id}}"><i class="fa fa-dot-circle-o text-danger"></i>{{__('trans.NotActive')}}</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                         <td class="text-right">
                                                            <!--<div class="dropdown dropdown-action">
                                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">-->
                                                                    <a class="dropdown-item" href="#" data-href="{{ url('admin/category-edit/'.$cat->id) }}" category-id="{{$cat->id}}" data-toggle="modal" data-target="#edit_category"><i class="fa fa-pencil m-r-5"></i> {{__('trans.Edit')}}</a>
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_category" delete-id="{{$cat->id}}"><i class="fa fa-trash-o m-r-5"></i> {{__('trans.Delete')}}</a>
                                                                <!--</div>-->
                                                            <!--</div>-->
                                                        </td>
    												</tr>
                                               @endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
            <!-- table -->
            </div>
        </div>
        <!-- /Page Content -->
   
        <!-- Add representative Modal -->
        <div id="add_category" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('trans.add_method')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form method="post" action="{{route('store-category',$subdomain)}}">
                            <div class="row">


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.name')}}<span class="text-danger">*</span></label>
                                        <input class="form-control " name="title" type="text">
                                    </div>
                                </div>
                            
                               <div class="col-sm-12">
                                    <div class="form-group">
                                            <span class="cat_status">{{__('trans.status')}}</span>
                                            <label class="switch">
                                                <input type="checkbox" class="category-status" value="0"/>
                                                <span class="slider round"></span>
                                            </label>
    								</div>
                              </div>
                              @include('category.permission.cat_permission')
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn" type="add">{{__('trans.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

     <!-- Edit representative Modal -->
        <div id="edit_category" class="modal custom-modal fade" role="dialog">
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

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label">{{__('trans.name')}}<span class="text-danger">*</span></label>
                                    <input class="form-control" name="title" type="text">
                                    <input type="hidden" name="cat_id"/>
                                </div>
                            </div>
                              <div class="col-sm-12">
                                    <div class="form-group">
                                            <span class="cat_status">{{__('trans.status')}}</span>
                                            <label class="switch">
                                                <input type="checkbox" class="category-status" value="0"/>
                                                <span class="slider round"></span>
                                            </label>
    								</div>

                                </div>
                            @include('category.permission.cat_permission')
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn" type="edit">{{__('trans.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit representative Modal -->  
        
       <!-- Delete representative Modal -->
        <div class="modal custom-modal fade" id="delete_category" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>{{__('trans.Delete category')}}</h3>
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
        <!-- /Delete representative Modal --> 
        
            <!-- Approve category Modal -->
            <div class="modal custom-modal fade" id="approve_category" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>{{__('trans.category Approve')}}</h3>
                                <p>{{__('trans.Are you sure want to approve for this category?')}}</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <span class="btn btn-primary continue-btn">{{__('trans.Approve')}}</span>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">{{__('trans.Decline')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Approve category Modal -->
</div>
@endsection
     
@section('script')


<script>

          /*category */
          var toggle= false;
          $('.switch').click(function() {
              
                $(".category-status").attr("checked",!toggle);
             
                toggle = !toggle;
                if(toggle==true)$(".category-status").val(1);
                
        
           });
            $("#add_category button,#edit_category button").click(function(e){
                
                e.preventDefault();
                var data;
    			var url="";     
    		    if($(this).attr('type')==="add"){
                    url=$('#add_category form').attr('action');
                    var title= $("#add_category form input[name='title']").val();                   
        			var status= $("#add_category .category-status").val();
          	       	var permission = new Array();
                    $("#check_permission input:checked").each(function() {
                            permission.push($(this).attr('value'));
                    });
    			    data= {title:title,status:status,permission:permission};
                 
                 
                 }
    			if($(this).attr('type')==="edit"){
    	
                           url=$('#edit_category form').attr('action');
                            var title= $("#edit_category form input[name='title']").val();	
                			var status= $("#edit_category .category-status").val();
                            var cat_id= $("#edit_category form input[name='cat_id']").val();		
                            var permission = new Array();
                            $("#check_permission input:checked").each(function() {
                                    permission.push($(this).attr('value'));
                            });
            			    data= {title:title,status:status,permission:permission,cat_id:cat_id};
                         
                 
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
      
      
      
      
            //onshow 
   			$("#edit_category").on('show.bs.modal', function(event) {
                        
				var button = $(event.relatedTarget) //Button that triggered the modal
			
				var getHref = button.data('href'); //get button href
				
				var id = button.attr('category-id'); 

				update_url=baseUrl+"category-update/"+id;
				$('#edit_category form').attr('action',update_url);
				$.ajax({
					url:getHref,
					data:{id:id},
					}).done(function(data) {
					$.each(data, function( index,category){
					
				        $("form input[name='title']").val(category.title);
                         $("form input[name='cat_id']").val(category.id);
						$("#edit_category .category-status").val(category.status);
                        if(category.status==1)
                        $("#edit_category .category-status").attr("checked",true);
					});
                     $.each(data, function(index,permission){
               
                         $('#edit_category form input[name="permission['+permission.permission_id+']"]').attr('checked','checked');
                       
					
			     	});
                                        
	
				});
			});
            
            
            
           /* category DELETE */
			  
			$("#delete_category").on('show.bs.modal', function(event) {
				var button = $(event.relatedTarget) //Button that triggered the modal
				var id = button.attr('delete-id');
				del_id=id;
				delete_url=baseUrl+"category-delete";
                
			
			});
			$("#delete_category .continue-btn").click(function(){
                  
    			$.ajax({
    					url:delete_url,    
    					data:{id:del_id},
    					 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    					type:"post"
    					}).done(function(data) {
    				     location.reload(true);
    	
    				});

			});
            /* end category*/
			   
			$("#approve_category").on('show.bs.modal', function(event) {
                   
				var button = $(event.relatedTarget) //Button that triggered the modal
	
				 status = button.attr('status');

			     pay_method_id=button.attr('category_id');
				
			});
			$("#approve_category .continue-btn").click(function(){
			
             
    			$.ajax({
    					url:"{{route('status-category',$subdomain)}}",    
    					data:{status:status,id:pay_method_id},
    					type:"get",
    					}).done(function(data) {
    				     location.reload(true);
    	
    				});

			});
</script>
@endsection
 


