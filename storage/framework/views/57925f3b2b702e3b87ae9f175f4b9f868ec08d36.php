<?php $__env->startSection('link'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/howto.css')); ?>">
    
    

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <ul class="nav">
        <?php $__currentLoopData = $article; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="VA-list" id="<?php echo e($row1->data_id); ?>">
                <a href="<?php echo e(url('/article/'.$row1->data_id)); ?>">
                    <div class="card">
                        <div class="card-image" style="background: url('<?php echo e(asset("upload/".$row1->post_image)); ?>') no-repeat center center; background-size: contain">
                            
                        </div>
                        <div class="card-title">
                            <h5 id="card-title"><?php echo $row1->title; ?></h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?php echo $row1->category; ?></p>
                            <p class="card-text"><?php echo $row1->name; ?></p>
                        </div>
                    </div>
                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="<?php echo e(asset('fireuikit/js/jquery.magnific-popup.js')); ?>"></script>
    <script src="<?php echo e(asset('fireuikit/js/mediagallery.js')); ?>"></script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.basic1', ['subMenu' => 'article'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\laravel\tipsmate\resources\views/article.blade.php ENDPATH**/ ?>