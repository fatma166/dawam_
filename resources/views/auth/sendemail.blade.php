
@extends('layout.mainlayout')
@section('title') {{__('trans.RESET PASSWORD')}} @endsection
@section('content')
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
			<!--	<a href="job-list" class="btn btn-primary apply-btn">Apply Job</a>-->
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="index"><img src="{{asset('img/logo.png')}}" alt="Dwam"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">{{__('trans.Login')}}</h3>
							<p class="account-subtitle">{{__('trans.Access to our dashboard')}}</p>
							
                            <div class="row">
                               @if(Session::has('success'))

                                    <div class="alert alert-success">
                
                                        {{ Session::get('success') }}
                
                                        @php
                
                                            Session::forget('success');
                
                                        @endphp
                
                                    </div>
                
                                @endif

                                <div class="col-sm-12">

                                    @if(Session::has('error'))

                                        <p class="alert alert-danger">{{ Session::get('error') }}</p>

                                    @endif

                                </div>

                            </div>
                  
                   <form method="POST" action="{{route('password.forget')}}">
                        @csrf
                          <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{__('trans.Email Address')}}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                   <div class="form-group row mb-0">
                         <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{__('trans.Send Password Reset Link')}}
                                </button>
                            </div>
                        </div>
                    </form>
                			
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