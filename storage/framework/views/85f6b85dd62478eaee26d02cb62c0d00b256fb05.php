<?php $__env->startSection('link'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/howto.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/rightside.css')); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('submenu'); ?>
    <ul class="nav sub-menu">
        <li class="sub-menu article inactive">
            <a class="nav-link inactive"  href="/howto/article" >ARTICLES</a>
        </li>
        <li class="sub-menu video active1" >
            <a class="nav-link active1" href="/howto/video" >VIDEOS</a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <ul class="nav">
        <?php $__currentLoopData = $video; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <li class="VA-list" id="<?php echo e($row->data_id); ?>">
                <a href="<?php echo e(url('/howto/video/'.$row->data_id)); ?>">
                    <div class="card">
                        <video controls >
                            <source src="<?php echo e(asset('upload/'.$row->video_url)); ?>" type="video/mp4">
                        </video>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $row->title; ?></h4>
                            <p class="card-author">
                                <span>&nbsp;&nbsp;<?php echo $row->name; ?><br></span>
                                <Span>&nbsp;&nbsp;<?php echo $row->views; ?></Span> <Span>views</Span><br>
                                <Span ><img src="<?php echo e(asset('fireuikit/images/up.png')); ?>">
                                <?php echo $row->like; ?></Span>
                                <Span>&nbsp;&nbsp;<img src="<?php echo e(asset('fireuikit/images/down.png')); ?>">
                                <?php echo $row->unlike; ?></Span>
                                <Span>&nbsp;&nbsp;comment:&nbsp;(<?php echo $row->comment; ?>)</Span>
                            </p>
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
    <script src="<?php echo e(asset('fireuikit/js/video-content.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.basic1', ['subMenu' => 'video'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\laravel\tipsmate\resources\views/howto/video.blade.php ENDPATH**/ ?>