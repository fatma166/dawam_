@extends('layout.mainlayout')

@section('content')

		<!-- Main Wrapper -->

       <div class="main-wrapper">



			<!-- Page Wrapper -->

            <div class="page-wrapper">

				<!-- Page Content -->

                <div class="content container-fluid">

					<!-- Page Header -->

					<div class="page-header">

						<div class="row">

							<div class="col-sm-12">

								<h3 class="page-title">{{__('trans.Welcome Admin!')}}</h3>

								<ul class="breadcrumb">

									<li class="breadcrumb-item active">{{__('trans.Dashboard')}}</li>

								</ul>

							</div>

						</div>

					</div>

					<!-- /Page Header -->

				

					<div class="row">

						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-2">

							<div class="card dash-widget">

								<div class="card-body">

									<span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>

									<div class="dash-widget-info">

										<h3>{{$company_report['total_company']}}</h3>

										<span>{{__('trans.Total Companies')}}</span>

									</div>

								</div>

							</div>

						</div>
                        
                        
                        
                         <div class="col-md-6 col-sm-6 col-lg-6 col-xl-2">

							<div class="card dash-widget">

								<div class="card-body">

									<span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>

									<div class="dash-widget-info">

										<h3>{{$company_report['total']}}</h3>

										<span>{{__('trans.Total Employees')}}</span>

									</div>

								</div>

							</div>

						</div>

						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-2">

							<div class="card dash-widget">

								<div class="card-body">

									<span class="dash-widget-icon"><i class="fa fa-usd"></i></span>

									<div class="dash-widget-info">

										<h3>{{$company_report['present']}}</h3>

										<span>{{__('trans.present today')}}</span>

									</div>

								</div>

							</div>

						</div>

					


					</div>

					


                </div>

				

				</div>

				<!-- /Page Content -->




            

            </div>    

			<!-- /Page Wrapper -->

			

     

		<!-- /Main Wrapper -->

		




		

		<!-- Custom JS -->

        		<!-- Chart JS -->

	

@endsection
@section('script')
		<script src="{{asset('plugins/morris/morris.min.js')}}"></script>

		<script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>

		<script src="{{asset('js/chart.js')}}"></script>	

@endsection