@extends('layout.mainlayout')
@section('title') {{__('trans.Login')}} @endsection
@section('content')
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
			<!--	<a href="job-list" class="btn btn-primary apply-btn">Apply Job</a>-->
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="index"><img src="{{asset('img/logo.png')}}" alt="Dreamguy's Technologies"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">{{__('trans.Login')}}</h3>
							<p class="account-subtitle">{{__('trans.Access to our dashboard')}}</p>
							
                            <div class="row">

                                <div class="col-sm-12">

                                    @if(Session::has('error'))

                                        <p class="alert alert-danger">{{ Session::get('error') }}</p>

                                    @endif

                                </div>

                            </div>

							<!-- Account Form -->
							<form action="{{route('postLogin',$subdomain)}}" method="post">
						{{ csrf_field() }}
								<div class="form-group">
									<label>{{__('trans.Email Address')}}</label>
									<input class="form-control" type="text" name="email">
								
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<label>{{__('trans.Password')}}</label>
										</div>
										<div class="col-auto">
											<a class="text-muted" href="{{route('password.email',$subdomain)}}" >
												{{__('trans.Forgot password?')}}
											</a>
										</div>
									</div>
									<input class="form-control" type="password" name="password">
								</div>
                                
                                <div class="form-group">
                                    <label>{{__('trans.LANG')}} <span class="text-danger">*</span></label>
                                    <div class="">
                                        <select class="select lang" name="lang">
                                           <option value="AR">{{__('trans.AR')}}</option>
                                           <option value="EN">{{__('trans.EN')}}</option>
                                        </select>
                                    </div>
                                </div>
                                
                                 <div class="form-group">
                                      <label for="remember"><input type="checkbox" name="remember" value="1" id="remember">{{__('trans.Remember Me')}}</label>          
                                 </div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit">{{__('trans.Login')}}</button>
								</div>
								<div class="account-footer">
									<p>{{__('trans.Don,t have an account yet?')}} <a href="{{route('register',$subdomain)}}">{{__('trans.Register')}}</a></p>
								</div>
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('js/app.js')}}"></script>
		
@endsection