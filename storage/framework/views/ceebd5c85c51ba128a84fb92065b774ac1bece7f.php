<?php $__env->startSection('link'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/qa.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/rightside.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/jquery.rateyo.min.css')); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('leftside'); ?>

    <div id="cat-all" roll="navigation" class="row" style="margin-left: 0;">
        <ul class="none FW-400 ml-3" id="categories">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="FC_list" data-product-id="cat<?php echo e($row->id); ?>" id="<?php echo e($row->id); ?>">
                    <a href="#" class="bottom"> <?php echo e($row->category); ?> </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-xl-7 col-lg-6 col-md-9 col-sm-12">
        <div id='loader' style='display: none;'>
            <img src='<?php echo e(asset('fireuikit/images/ajax-loader.gif')); ?>' width='50px' height='50px'>
        </div>
        <div class="row">
            <?php echo e(csrf_field()); ?>

            <p id="post_id" hidden><?php echo e($post_id); ?></p>
            <div id="cat_id" hidden><?php echo e($cat_id); ?></div>
            <p id="search_text" hidden><?php echo e($search_text); ?></p>
            <ul id="fq" style="width: 100%">
            </ul>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('rightside'); ?>

    <div class="col-xl-2 col-lg-3 col-md-2 col-sm-2" >
        <?php if(Auth::user()): ?>
            <div class="ml-3">
                <p id="askbar-holder">

                <form id="ask_frm" method="post" action="<?php echo e(route('addquestion')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div
                        class="Bgc-t Bgr-n Va-m Fl-start shared-sprite ask-star-icon D-ib Mend-5 Wpx-25 Hpx-25 Fl-start"
                        id="ask_sprite">
                        <img src="<?php echo e(asset('fireuikit/images/combo.png')); ?>">
                    </div>
                    <h2 class="D-ib Fz-18 Fw-300 Mt-neg-1">Ask a Question</h2>
                    <div class="Fw-300">
                        usually answered within minutes!
                    </div>
                    <div class="form-group mb-5">

                        <select class="mt-3 mb-3 form-control" id="sltitle" name="category">
                            <option selected>Select</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($row->id != 1): ?>
                                    <option value="<?php echo e($row->id); ?>"><?php echo e($row->category); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <textarea class="form-control mb-3" name="title" placeholder="What's up" id="rtext"></textarea>
                        <div class="form-group">
                            <textarea id="summernote1" name="comment" class="form-control"></textarea>
                        </div>
                        <footer>
                            <ul>
                                <li>

                                    <input type="button" id="clear" class="btn btn_default" name="clear" value="Reset">
                                <li>
                                    <button id="send" type="submit" class="btn btn-primary">Send</button>
                                </li>
                            </ul>
                        </footer>
                    </div>
                </form>
            </div>
            <div class="google">
                <img src="<?php echo e(asset('fireuikit/images/google_ads.png')); ?>" style="width: 100%">
            </div>
            <div class="mt-3">
                <h4 style="font-weight: bold">Recent Posts......</h4>
                <p><?php echo e($questions[0]->title); ?></p>
                <p><?php echo e($questions[1]->title); ?></p>
                <p><?php echo e($questions[2]->title); ?></p>
                <p><?php echo e($questions[3]->title); ?></p>
                <p><?php echo e($questions[4]->title); ?></p>
            </div>
        <?php endif; ?>
        <div  style="width: 100%; display: flex; justify-content: flex-end">
            <div style="width: fit-content">
            <img src="<?php echo e(asset('fireuikit/images/advertise3.png')); ?>">
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('fireuikit/js/ask-content.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', ['singlePage' => 'false'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\laravel\tipsmate\resources\views/home.blade.php ENDPATH**/ ?>