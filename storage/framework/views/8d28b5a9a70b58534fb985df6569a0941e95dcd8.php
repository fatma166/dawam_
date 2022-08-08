<?php $__env->startSection('title'); ?> <?php echo e(__('trans.RESET PASSWORD')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
			<!--	<a href="job-list" class="btn btn-primary apply-btn">Apply Job</a>-->
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="index"><img src="<?php echo e(asset('img/logo.png')); ?>" alt="Dwam"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title"><?php echo e(__('trans.Login')); ?></h3>
							<p class="account-subtitle"><?php echo e(__('trans.Access to our dashboard')); ?></p>
							
                            <div class="row">
                               <?php if(Session::has('success')): ?>

                                    <div class="alert alert-success">
                
                                        <?php echo e(Session::get('success')); ?>

                
                                        <?php
                
                                            Session::forget('success');
                
                                        ?>
                
                                    </div>
                
                                <?php endif; ?>

                                <div class="col-sm-12">

                                    <?php if(Session::has('error')): ?>

                                        <p class="alert alert-danger"><?php echo e(Session::get('error')); ?></p>

                                    <?php endif; ?>

                                </div>

                            </div>
                  
                   <form method="POST" action="<?php echo e(route('password.forget')); ?>">
                        <?php echo csrf_field(); ?>
                          <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('trans.Email Address')); ?></label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" autocomplete="email" autofocus>

                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                   <div class="form-group row mb-0">
                         <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('trans.Send Password Reset Link')); ?>

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
        <script src="<?php echo e(asset('js/jquery-3.2.1.min.js')); ?>"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
		
		<!-- Custom JS -->
		<script src="<?php echo e(asset('js/app.js')); ?>"></script>
		
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dawam/public_html/manger/resources/views/auth/sendemail.blade.php ENDPATH**/ ?>