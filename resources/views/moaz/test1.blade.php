<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>{{__('trans.Register')}} </title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/logo.png')}}">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body class="account-page">
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						<a href=""><img src="{{asset('img/logo.png')}}" alt="{{__('trans.DWAM')}}"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">اختار باقتك</h3>

							<!-- Account Form -->
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form id="regForm" method="post" action="{{route('subscribe-store-userplan')}}">
							    @csrf

                                <div class="form-group">
                                    <label class="col-form-label">{{ __('trans.currency') }} <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="currency">
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">{{__('trans.Number Users')}}</label>
                                    <input class="form-control" type="number" name="users">
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">{{__('trans.Type')}}</label>
                                        <select class="select" name="type">                                               
                                             <option value="month">{{__('trans.month')}}</option>
                                             <option value="year">{{__('trans.year')}}</option>                                              
                                        </select>
                               </div>
                                <div class="form-group">
                                    <label class="col-form-label">{{__('trans.duration')}}</label>
                                    <input class="form-control" type="number" name="duration">
                                 </div>

                                  <div class="form-group form-focus ">
                                        <label class="col-form-label">{{__('trans.Select Date From')}}</label>
                                        <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="date_from"></div>
                                 </div>


                                 <section id="our-stats">

		<div class="row text-center">
			<div class="col">
					<div class="counter">
						<i class="fa fa-user fa-2x"></i>
						<h2 class="timer count-title count-number">100</h2>
						<p class="count-text ">Users</p>
					</div>
			</div>
			<div class="col">
					<div class="counter">
						<i class="fa fa-calendar-o fa-2x"></i>
						<h2 class="timer count-title count-number">200</h2>
						<p class="count-text ">Duration</p>
					</div>
			</div>
			<div class="col">
					<div class="counter">
						<i class="fa fa-money fa-2x"></i>
						<h2 class="timer count-title count-number">900</h2>
						<p class="count-text ">Amount</p>
					</div>
			</div>

		</div>
	</section>
                                 <div class="form-group text-center">
                                    <a href="https://mohamedabdelrahman.org/Attendence-v1/admin/test_moaz" class="btn btn-dark">{{__('trans.Next')}}</a>
                                    <a href="https://mohamedabdelrahman.org/Attendence-v1/admin/register" class="btn btn-dark">{{__('trans.Previous')}}</a>
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
		<script type="text/javascript">
        
        $('#password, #confirm_password').on('keyup', function () {
        
        if ($('#password').val() == $('#confirm_password').val()) {
        
        	$('#message').html('Matching').css('color', 'green');
        
        } else 
        
        	$('#message').html('Not Matching').css('color', 'red');
        
        });    
        $("#register .register_button").click(function(e){
         
             e.preventDefault();
                var name= $("#register input[name='name']").val();
                var email= $("#register input[name='email']").val();
                var password= $("#register input[name='password']").val();
                var confirm_password= $("#register input[name='confirm_password']").val();
                var phone= $("#register input[name='phone']").val();
                var company= $("#register input[name='company']").val();
                 $.ajax({
                url:"{{route('userRegister')}}",
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{name:name, email:email ,password:password,confirm_password:confirm_password,phone:phone,company:company},
                success: function(data) {
                    
                    if(data.hasOwnProperty('success')){
				
                       window.location.href = "{{route('login')}}";
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });
        });
</script>
		<!-- Bootstrap Core JS -->
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('js/app.js')}}"></script>

    </body>
</html>