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
                        <h3 class="page-title">المصروفات</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">{{__('trans.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">المضروفات</li>
                        </ul>
                    </div>
                     <!-- Breadcrumb -->
                    
                     <!-- Add Button -->
                  <div class="col-auto float-right ml-auto">
                       
                        <a class="btn add-btn" data-toggle="modal"
                            data-target="#add_expenses"><i class="fa fa-plus"></i>إضافة مصروف</a>
                           
                        <div class="view-icons">
                            <a href="" class="grid-view btn btn-link"><i
                                    class="fa fa-th"></i></a>
                            <a href="branch-list" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>
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
													<th>التاريخ</th>
													<th>العنوان</th>
													<th>الوصف</th>
													<th>القسم</th>
                                                    <th>الضريبة</th>
                                                    <th>الرصيد</th>
                                                    <th>الأجمالى</th>
													<th>تعديل / حذف</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>22 / 3 / 1997</td>
													<td>مصروفات كهرباء</td>
													<td>مصروفات كهرباء لشركة استبشر العالمية</td>
                                                    <td>مصروفات ادارية</td>
													<td>1.5 EG</td>
													<td>255 EGP</td>
													<td>255 EGP</td>
                                                    <td> <a  data-toggle="modal" data-target="#delete_expenses"><i class="fa fa-trash-o m-r-5"></i> {{__('trans.Delete')}}</a>                                   
                                                         / 
                                                         <a href="javascript:void(0);" data-toggle="modal"  data-target="#edit_expenses">{{__('trans.Edit')}}</a></span>
                                                    </td>
												</tr>
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
        <div id="add_expenses" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">إضافة مصروف</h5>
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
                                        <label class="col-form-label">التاريخ : <span class="text-danger">*</span></label>
                                        <input class="form-control " name="date" type="date">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">العنوان<span class="text-danger">*</span></label>
                                        <input class="form-control" name="title" type="text">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">الوصف<span class="text-danger">*</span></label>
                                        <input class="form-control" name="description" type="text">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">القسم<span class="text-danger">*</span></label>
                                        <select class="form-control form-control-lg">
                                            <option>مصروفات ادارية</option>
                                            <option>مصروفات ادارية</option>
                                            <option>مصروفات ادارية</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">الضريبة<span class="text-danger">*</span></label>
                                        <input class="form-control" name="tax" type="number">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">الرصيد<span class="text-danger">*</span></label>
                                        <input class="form-control" name="amount" type="number">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">الإجمالى<span class="text-danger">*</span></label>
                                        <input class="form-control" name="total" type="number">
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
        <div id="edit_expenses" class="modal custom-modal fade" role="dialog">
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
                                        <label class="col-form-label">التاريخ : <span class="text-danger">*</span></label>
                                        <input class="form-control " name="date" type="date">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">العنوان<span class="text-danger">*</span></label>
                                        <input class="form-control" name="title" type="text">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">الوصف<span class="text-danger">*</span></label>
                                        <input class="form-control" name="description" type="text">
                                    </div>
                                </div>

                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">القسم<span class="text-danger">*</span></label>
                                        <select class="form-control form-control-lg">
                                            <option>مصروفات ادارية</option>
                                            <option>مصروفات ادارية</option>
                                            <option>مصروفات ادارية</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">الضريبة<span class="text-danger">*</span></label>
                                        <input class="form-control" name="tax" type="number">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">الرصيد<span class="text-danger">*</span></label>
                                        <input class="form-control" name="amount" type="number">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">الإجمالى<span class="text-danger">*</span></label>
                                        <input class="form-control" name="total" type="number">
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
        <div class="modal custom-modal fade" id="delete_expenses" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>{{__('trans.Delete expenses')}}</h3>
                            <p>هل تريد حذف المصروف</p>
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
 


