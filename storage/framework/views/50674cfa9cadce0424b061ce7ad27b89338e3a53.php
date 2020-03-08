<?php $__env->startSection('link'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/howto.css')); ?>">
    
    


    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">

<?php $__env->stopSection(); ?>


<?php $__env->startSection('submenu'); ?>
    <ul class="nav sub-menu">
        <li class="sub-menu article active1">
            <a class="nav-link active1"  href="/howto/article" >ARTICLES</a>
        </li>
        <li class="sub-menu video inactive" >
            <a class="nav-link inactive" href="/howto/video" >VIDEOS</a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('categories'); ?>
    <div id="cat-all" roll="navigation" class="row">
        <ul class="none FW-400 MY-0 ml-3" id="categories">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <li class="FC_list" id="<?php echo e($row->id); ?>">
                    <a href="/article_category/<?php echo e($row->id); ?>" id="bottom"> <?php echo e($row->category); ?> </a>
                </li>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <div class="container1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>New Article</h4>
            </div>
            <div class="panel-body">
                <form action="<?php echo e(url('howto/video/insert')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <label for="title">Main video</label>
                    <input type="file" name="addvideo" accept="video/mp4"/>
                    <label for="title">Category</label>
                    <select class="mt-3 mb-3 form-control" id="sltitle" name="category">
                        <option selected>Select</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($row->id > 1): ?>
                                <option value="<?php echo e($row->id); ?>"><?php echo e($row->category); ?></option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="form-group">
                        <textarea id="summernote" name="detail" class="form-control">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="send" id="send" class="btn btn-success">
                        <input type="button" name="clear" id="clear" class="btn btn-danger pull-right" value="Clear">
                    </div>


                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script type="text/javascript">
    $(document).ready(function() {
        $(summernote).summernote({
            height: '300px',
            placeholder: "Input content here...",
            fontNames: ['Arial', 'Arial Black'],
        })
    });
    $(clear).on('click',function () {
            $(summernote).summernote('code',null);
    })

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.basic1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\laravel\tipsmate\tipsmate\resources\views/howto/create_video.blade.php ENDPATH**/ ?>