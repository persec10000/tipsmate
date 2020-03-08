<?php $__env->startSection('link'); ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <div class="container col-md-10 col-sm-10">

        <div style="height: 150px;">&nbsp;</div>
        <h1 class="">Change Password</h1>

        <a class="button--primary admin_logout" href="/logout">

            <img src="<?php echo e(asset("fireuikit/images/logoutButton.gif")); ?>" width="64" height="19" border="0">


        </a>

        <form id="productForm" name="productForm" class="form-horizontal" action="/admin/confirmpassword" method="post">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label class="col-sm-4 control-label"> Old Password</label>
                <div class="col-sm-12">
                    <input type="passowrd" class="form-control" id="oldPassword" name="oldpassword" placeholder="Enter old password" value="" maxlength="50" required="" style="width: 30%; cursor: none;    text-rendering: unset;">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label"> New Password</label>
                <div class="col-sm-12">
                    <input type="password" class="form-control" id="newPassword" name="newpassword" placeholder="Enter new passwod" value="" maxlength="50" required="" style="width: 30%">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label"> Confirm Password</label>
                <div class="col-sm-12">
                    <input type="password" class="form-control" id="confirmPassword" name="confirmpassword" placeholder="Confirm password" value="" maxlength="50" required="" style="width: 30%">
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="saveBtn" value="add">Save changes
                </button>
            </div>
            <?php if($alert): ?>
              <label class="col-sm-4 control-label"><?php echo e($alert); ?></label>
            <?php endif; ?>



        </form>









<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.basic', ['activeMenu' => 'Reset Password'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\laravel\tipsmate\tipsmate\resources\views/admin/ChangePassword.blade.php ENDPATH**/ ?>