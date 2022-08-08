
<?php $__env->startSection('title'); ?> <?php echo e(__('trans.Login')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
			<!--	<a href="job-list" class="btn btn-primary apply-btn">Apply Job</a>-->
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="index"><img src="<?php echo e(asset('img/logo.png')); ?>" alt="Dreamguy's Technologies"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title"><?php echo e(__('trans.Login')); ?></h3>
							<p class="account-subtitle"><?php echo e(__('trans.Access to our dashboard')); ?></p>
							
                            <div class="row">

                                <div class="col-sm-12">

                                    <?php if(Session::has('error')): ?>

                                        <p class="alert alert-danger"><?php echo e(Session::get('error')); ?></p>

                                    <?php endif; ?>

                                </div>

                            </div>

							<!-- Account Form -->
							<form action="<?php echo e(route('postLogin',$subdomain)); ?>" method="post">
						<?php echo e(csrf_field()); ?>

								<div class="form-group">
									<label><?php echo e(__('trans.Email Address')); ?></label>
									<input class="form-control" type="text" name="email">
								
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<label><?php echo e(__('trans.Password')); ?></label>
										</div>
										<div class="col-auto">
											<a class="text-muted" href="<?php echo e(route('password.email',$subdomain)); ?>" >
												<?php echo e(__('trans.Forgot password?')); ?>

											</a>
										</div>
									</div>
									<input class="form-control" type="password" name="password">
								</div>
                                
                                <div class="form-group">
                                    <label><?php echo e(__('trans.LANG')); ?> <span class="text-danger">*</span></label>
                                    <div class="">
                                        <select class="select lang" name="lang">
                                           <option value="AR"><?php echo e(__('trans.AR')); ?></option>
                                           <option value="EN"><?php echo e(__('trans.EN')); ?></option>
                                        </select>
                                    </div>
                                </div>
                                
                                 <div class="form-group">
                                      <label for="remember"><input type="checkbox" name="remember" value="1" id="remember"><?php echo e(__('trans.Remember Me')); ?></label>          
                                 </div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit"><?php echo e(__('trans.Login')); ?></button>
								</div>
								<div class="account-footer">
									<p><?php echo e(__('trans.Don,t have an account yet?')); ?> <a href="<?php echo e(route('register',$subdomain)); ?>"><?php echo e(__('trans.Register')); ?></a></p>
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
		
		<!-- Bootstrap Core JS -->
        <script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
		
		<!-- Custom JS -->
		<script src="<?php echo e(asset('js/app.js')); ?>"></script>
		
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/login.blade.php ENDPATH**/ ?>