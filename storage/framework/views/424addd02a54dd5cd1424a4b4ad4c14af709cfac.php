<?php $__env->startSection('link'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/howto.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/rightside.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <ul class="nav">
        <?php $__currentLoopData = $article; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="VA-list" id="<?php echo e($row1->data_id); ?>">
                <a href="/article/<?php echo e($row1->data_id); ?>">
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
            <?php $__currentLoopData = $video; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <li class="VA-list" id="<?php echo e($row->data_id); ?>">
                    <a href="/howto/video/<?php echo e($row->data_id); ?>">
                        <div class="card">
                            <video controls >
                                <source src="<?php echo e(asset('upload/'.$row->video_url)); ?>" type="video/mp4">
                            </video>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $row->title; ?></h4>
                                <p class="card-author">
                                    <span>&nbsp;&nbsp;<?php echo $row->name; ?><br></span>
                                    <Span>&nbsp;&nbsp;<?php echo $row->views; ?></Span> <Span>views</Span><br>
                                    <Span>&nbsp;&nbsp; <img src="<?php echo e(asset('fireuikit/images/up.png')); ?>">
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
    <script src="<?php echo e(asset('fireuikit/js/ask-content.js')); ?>"></script>
    <script src="<?php echo e(asset('fireuikit/js/mediagallery.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.basic1', ['subMenu' => 'article'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\laravel\tipsmate\resources\views/howto.blade.php ENDPATH**/ ?>