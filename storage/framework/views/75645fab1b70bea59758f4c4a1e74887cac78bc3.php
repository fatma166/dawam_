<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title><?php echo e(__('trans.Register')); ?> </title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('img/logo.png')); ?>">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.min.css')); ?>">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
		
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
						<a href=""><img src="<?php echo e(asset('img/logo.png')); ?>" alt="<?php echo e(__('trans.DWAM')); ?>"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title"><?php echo e(__('trans.Register')); ?></h3>
							<p class="account-subtitle"><?php echo e(__('trans.Access to our dashboard')); ?></p>
	
							<!-- Account Form -->
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
							<form  id="register"  method="post">
							    <?php echo csrf_field(); ?>
							    <div class="form-group">
									<label><?php echo e(__('trans.Name')); ?></label>
									<input class="form-control" name="name" type="text">
								</div>
								<div class="form-group">
									<label><?php echo e(__('trans.Email')); ?></label>
									<input class="form-control" name="email" type="text">
								</div>
								<div class="form-group">
									<label><?php echo e(__('trans.Password')); ?></label>
									<input id="password" name="password" class="form-control" type="password">
									
								</div>
								<div class="form-group">
									<label><?php echo e(__('trans.Repeat Password')); ?></label>
									<input id="confirm_password" name="confirm_password" class="form-control" type="password">
								     <span id="message"></span>
								</div>
								<div class="form-group">
									<label><?php echo e(__('trans.phone')); ?></label>
									<input name="phone" class="form-control" type="text">
								</div>
								<div class="form-group">
									<label><?php echo e(__('trans.company')); ?></label>
									<input name="company" class="form-control" type="text">
								</div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label><?php echo e(__('trans.category')); ?></label>
                                        <select class="form-control form-control-lg" name="category">
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category['id']); ?>"><?php echo e($category['title']); ?></option>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn register_button" type="submit" ><?php echo e(__('trans.Register')); ?></button>
								</div>
								<div class="account-footer">
									<p><?php echo e(__('trans.Already have an account')); ?> ? <a href="<?php echo e(route('login',$subdomain)); ?>" ><?php echo e(__('trans.Login')); ?></a></p>
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
        <script src="<?php echo e(asset('js/jquery-3.2.1.min.js')); ?>"></script>
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
                var category= $("#register select[name='category']").val();
                 $.ajax({
                url:"<?php echo e(route('userRegister',$subdomain)); ?>",
                type:'POST',
			    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{name:name, email:email ,password:password,confirm_password:confirm_password,phone:phone,company:company,category:category},
                success: function(data) {
                    
                    if(data.hasOwnProperty('success')){
				
                       window.location.href = "<?php echo e(route('login',$subdomain)); ?>";
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });
        });
        		function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
</script>
		<!-- Bootstrap Core JS -->
        <script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
		
		<!-- Custom JS -->
		<script src="<?php echo e(asset('js/app.js')); ?>"></script>

    </body>
</html><?php /**PATH /home/dawam/public_html/manger_subdomain/resources/views/register.blade.php ENDPATH**/ ?>