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
                        <h3 class="page-title">المناديب</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">لوحة التحكم</a></li>
                            <li class="breadcrumb-item active">المناديب</li>
                        </ul>
                    </div>
                     <!-- Breadcrumb -->
                    
                    
                     <!-- Add Button -->
                  <div class="col-auto float-right ml-auto">
                       
                        <a class="btn add-btn" data-toggle="modal"
                            data-target="#add_representative"><i class="fa fa-plus"></i>إضافة مندوب</a>
                           
                        <div class="view-icons">
                            <a href="{{ route('branch') }}" class="grid-view btn btn-link" title="{{__('trans.grid')}}"><i
                                    class="fa fa-th"></i></a>
                            <a href="branch-list" class="list-view btn btn-link active" title="{{__('trans.list')}}"><i class="fa fa-bars"></i></a>
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
													<th>{{__('trans.repersentive')}}</th>
													<th>{{__('trans.enroll')}}</th>
                                                    <th>{{__('trans.description')}}</th>
													<th>{{__('trans.balance')}}</th>
                                                    <th>{{__('trans.collect')}}</th>
													<th>{{__('trans.edit')}}/{{__('trans.delete')}}</th>
												</tr>
											</thead>
											<tbody>
                                            @if(isset($representatives))
                                            @foreach($representatives as $representative)
												<tr>
													<td>{{$representative->name}}</td>
													<td>{{$representative->enroll_date}}</td>
													<td>{{$representative->description}}</td>
                                                    <td>{{$representative->balance}}</td>
                                                    <td><button onclick="clearRep('{{$representative->id}}')">{{__('trans.collect')}}</button>{{$representative->collect}}</td>
                                                    <td> <a  delete-id="{{$representative->id}}"  data-toggle="modal" data-target="#delete_representative"><i class="fa fa-trash-o m-r-5"></i> {{__('trans.Delete')}}</a>
                                                        
                                                         / 
                                                         <span class="first-off"><a href="javascript:void(0);" data-toggle="modal" representative-id="{{$representative->id}}" data-href="{{ url('admin/representative-edit/'.$representative->id) }}"   data-target="#edit_representative">{{__('trans.Edit')}}</a></span>
                                                    </td>
												</tr>
                                              @endforeach
                                             @endif
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
        <div id="add_representative" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('trans.add repersenative')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form method="post" action="{{route('store-representative')}}">
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.name')}}<span class="text-danger">*</span></label>
                                        <input class="form-control " name="name" type="text">
                                    </div>
                                </div>
                               <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.enroll')}}<span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input class="form-control floating datetimepicker" type="text" name="enroll">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.balance')}}<span class="text-danger">*</span></label>
                                        <input class="form-control" name="balance" type="number">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.description')}}<span class="text-danger">*</span></label>
                                        <textarea  class="form-control"  name="description"></textarea>
                                    </div>
                                </div>
                           
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
        <div id="edit_representative" class="modal custom-modal fade" role="dialog">
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
                        <form  method="POST">
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.name')}}<span class="text-danger">*</span></label>
                                        <input class="form-control"  name="name" type="text"/>
                                    </div>
                                </div>
                               <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.enroll')}}<span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input class="form-control floating datetimepicker" type="text" name="enroll"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.balance')}}<span class="text-danger">*</span></label>
                                        <input class="form-control" name="balance" type="number"/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{__('trans.description')}}<span class="text-danger">*</span></label>
                                        <textarea  class="form-control"  name="description"></textarea>
                                    </div>
                                </div>
                           
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
        <div class="modal custom-modal fade" id="delete_representative" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>{{__('trans.Delete Branch')}}</h3>
                            <p>{{__('Are you sure want to delete?')}}</p>
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
        

</div>
@endsection
     
@section('script')


<script>
function clearRep(id){
            var url=baseUrl+"repersenrive-blance-set/"+id; 
            $.ajax({
                url:url,
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               // data: {title:title, nearest_branch:nearest_branch , distance:distance, is_fake:is_fake,target_location_check:target_location_check,company_logo:company_logo},
                success: function(data) {
                    
                    if(data.hasOwnProperty('success')){
				
                       location.reload(true);
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });
}


</script>
@endsection
 


