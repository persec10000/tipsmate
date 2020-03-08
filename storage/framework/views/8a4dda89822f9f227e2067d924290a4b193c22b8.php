<?php $__env->startSection('link'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/qa.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/rightside.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/jquery.rateyo.min.css')); ?>"/>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="col-xl-7 col-lg-6 col-md-9 col-sm-12" style="padding:20px;">
       <?php echo $pageContent->page_content; ?>

    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', ['singlePage' => 'ture'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\laravel\tipsmate\resources\views/page.blade.php ENDPATH**/ ?>