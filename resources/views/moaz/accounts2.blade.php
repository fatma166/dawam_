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
                        <h3 class="page-title">الأرباح</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">{{__('trans.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">الأرباح</li>
                        </ul>
                    </div>
                     <!-- Breadcrumb -->
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
            <div class="container">
               <div class="row">
                                 <!--search filter-->

           <form action="" class="profit-filter">
               <div class="col-lg-3 profit-print">
               <button class="btn btn-primary hidden-print"><span class="fa fa-print" aria-hidden="true"></span> طباعة</button>
               <button class="btn btn-success hidden-print"><span class="fa fa-print" aria-hidden="true"></span> اكسيل</button>

               </div>
           <div class="col-lg-4">
                    <div class="form-group form-focus" >
                        <div class="cal-icon">
                            <input class="form-control floating datetimepicker" type="text" name="date">
                        </div>
                        <label class="focus-label">{{__('trans.date')}}</label>
                    </div>
               </div>
               <div class="col-lg-4">
                  <div class="form-group form-focus" >
                        <input class="form-control" type="text" name="search" placeholder="ابحث ..">
                  </div>
               </div>
               <div class="col-lg-1">
                  <a  class="btn btn-success btn-block" id="search_outdoor"> {{__('trans.Search')}} </a>  
               </div>

           </form>

<!-- /Search Filter -->
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
                                                    <th>الشهر</th>
													<th>الإيرادات</th>
													<th>المصروفات</th>
													<th>الأرباح</th>
												</tr>
											</thead>
											<tbody>
												<tr>
                                                    <td>نوفمبر</td>
													<td>2000 جنية</td>
													<td>1000 جنية</td>
													<td>1000 جنية</td>
												</tr>
                                                <tr>
                                                    <td>ديسمبر</td>
													<td>2000 جنية</td>
													<td>1000 جنية</td>
													<td>1000 جنية</td>
												</tr>
                                                <tr>
                                                    <td>يناير</td>
													<td>2000 جنية</td>
													<td>1000 جنية</td>
													<td>1000 جنية</td>
												</tr>
                                                <tr>
                                                    <td>فبراير</td>
													<td>2000 جنية</td>
													<td>1000 جنية</td>
													<td>1000 جنية</td>
												</tr>
											</tbody>
                                            <tfoot>
                                                <tr>
                                                    <td>الإجمالى</td>
                                                    <td>20,000 جنية</td>
                                                    <td>10,000 جنية</td>
                                                    <td>10,000 جنية</td>
                                                </tr>
                                            </tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
            <!-- table -->
            </div>
        </div>
        <!-- /Page Content -->

     <!-- Edit representative Modal -->
        <div id="edit_income" class="modal custom-modal fade" role="dialog">
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
                                        <label class="col-form-label">العميل<span class="text-danger">*</span></label>
                                        <select class="form-control form-control-lg">
                                            <option>فاطمة</option>
                                            <option>فاطمة</option>
                                            <option>فاطمة</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">طريقة الدفع<span class="text-danger">*</span></label>
                                        <select class="form-control form-control-lg">
                                            <option>فيزا ماستر</option>
                                            <option>البريد المصرى</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">الرصيد<span class="text-danger">*</span></label>
                                        <input class="form-control" name="amount" type="number">
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
        <div class="modal custom-modal fade" id="delete_income" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>{{__('trans.Delete income')}}</h3>
                            <p>هل تريد حذف الإيراد</p>
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
 


