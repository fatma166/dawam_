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
				
					
					<div class="account-box">
						<div class="account-wrapper">
                        <div class="container success-message-billing">
                        <div class="row">
                            <div class="col-lg-12">
                            <img src="https://mohamedabdelrahman.org/Thumbs-Up.gif" alt="<?php echo e(__('trans.DWAM')); ?>">

                                <div class="payment">
                                    <div class="content">
                                    <h1><?php echo e(__('trans.process seccuss')); ?></h1>
                                    <p><?php echo e(__('trans.thanks')); ?></p>
                                    </div>
                                    <div class="content">
                                        <a href="<?php echo e(route('login',$subdomain)); ?>"><?php echo e(__('trans.login')); ?></a>
                                     </div>
                                    
                                </div>
                            </div>
                        </div>
                        </div>
							<!-- /Account Form -->
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
        <script src="<?php echo e(asset('js/jquery-3.2.1.min.js')); ?>"></script>

		<!-- Bootstrap Core JS -->
        <script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
		
		<!-- Custom JS -->
		<script src="<?php echo e(asset('js/app.js')); ?>"></script>

    </body>
</html><?php /**PATH /home/dawam/public_html/manger/resources/views/moaz/test2.blade.php ENDPATH**/ ?>