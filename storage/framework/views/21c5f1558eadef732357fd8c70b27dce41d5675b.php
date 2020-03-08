<?php $__env->startSection('link'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/register.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/login.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('leftsidebar'); ?>
    <div class="col-md-2 col-sm-2"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-8 login_body mt-lg-5">
        <h2>Login</h2>
        
        
        
        
        
        
        <?php if(Session::has('success')): ?>
            <div class="row">
                <div class="invalid_box">
                    <div class="right_img"><img alt="" src="<?php echo e(asset('fireuikit/images/right.png')); ?>"></div>
                    <span><?php echo e(Session::get('success')); ?></span>
                </div>
            </div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="row">
                <div class="invalid_box">
                    <div class="right_img"><img alt="" src="<?php echo e(asset('fireuikit/images/cross_img.png')); ?>"></div>
                    <span>Email Id or Password are Invalid</span>
                </div>
            </div>
        <?php endif; ?>


        <div class="row login_box">
            <div class="col-xs-12 col-sm-6 social-login-mobile-body">
                <div class="text-center social-btn">
                    <form method="post" class="facebook_login_form" action="/register">
                        <span for="btn_cta" class="btn-icon">
                             <span class="left-panel"></span>
                             <input type="submit" name="facebook-login" class="btn btn-primary btn-block" value="Register with Facebook"/>
                        </span>
                    </form>
                    <form method="post" class="google_login_form" action="/redirect">
                        <span for="btn_cta" class="btn-icon">
                            <span class="left-panel"></span>
                            <input type="submit" name="google-login" class="btn btn-danger btn-block" value="Register with Google&nbsp;&nbsp;&nbsp;&nbsp;"/>
                        </span>
                    </form>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <form name="frm" id="frm" method="post" action="<?php echo e(route('login')); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <div class="form-group">
                        <input type="text" placeholder="Email Address" name="email" id="email" class="form-control border-radius">
                        <span class="errorContainer"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Password" name="password" id="password" class="form-control border-radius">
                        <span class="errorContainer"></span>
                    </div>
                    <div class="form-group mb-5">
                        <?php if(Route::has('password.request')): ?>
                            <a href="<?php echo e(route('password.request')); ?>" style="float: right;    color: #008cba;text-decoration: none;">Forgot your password?</a>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LfMfpoUAAAAAFg52lKzJaUEvi0bmV0N4gwh6VQ1"></div>
                        <span style="color: #ef3333"></span>
                    </div>
                    <div class="form-group">

                        <input id="btnSubmit" name="btnSubmit" class="btn btn-primary full-width red-bg border-none border-radius3" type="submit" value="Sign In"/>
                    </div>
                    <div class="form-group" style="text-align: center">
                        <span style="color: #353535">Don't you have an account? <a href="register" class="c-login-link">Register Now</a></span>
                    </div>
                </form>
            </div>
            <div class="col-xs-12 col-sm-6 pl-lg social-login-desktop-body">
                <div class="text-center social-btn">
                    <form method="get" class="facebook_login_form" action="<?php echo e(url('/auth/facebook')); ?>">

                        <span for="btn_cta" class="btn-icon">
                            <span class="left-panel"></span>

                            <input type="submit" name="facebook-login" class="btn btn-primary btn-block f-btn" value="Login with Facebook"/>
                        </span>
                    </form>
                    <form method="get" class="google_login_form" action="auth/google">

                        <span for="btn_cta" class="btn-icon">
                            <span class="left-panel"></span>
                            <input type="submit" name="google-login" class="btn btn-danger btn-block" value="Login with Google&nbsp;&nbsp;&nbsp;&nbsp;"/>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.basic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\laravel\tipsmate\resources\views/auth/login.blade.php ENDPATH**/ ?>