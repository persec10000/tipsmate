<?php $__env->startSection('link'); ?>

    
    


    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/howto.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/rightside.css')); ?>">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">


    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="<?php echo e($article->title); ?>" />
    <meta name="twitter:description" content="<?php echo e($article->content_html); ?>" />
    <meta name="twitter:image" content="<?php echo e(asset('upload/'.$article->post_image)); ?>" />
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

<?php $__env->startSection('search'); ?>
    <div class=" search_how">
        <form id="frm" name="frm" action="<?php echo e(url('/howto/article/search')); ?>" method="get" enctype="multipart/form-data">
            <div class="input-group">
                <input type="text" class="form-control ml-6 " id="search" name="search">
                <input type="submit" class="btn-search " value="            " >
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('create'); ?>
    <div class="wrapper_create">
        <?php if(Auth::user()): ?>
            <div><a href="/howto/article/create"  class="btn btn-create" >Create</a></div>
        <?php endif; ?>
    </div>
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
    <div class="content-border">

        <div class="content-title">
            <h2><b><?php echo e($article->title); ?></b></h2>
        </div>

        <div class="content-detail">
            <h4>category:<?php echo $article->category; ?></h4>
        </div>


        <div class="content-detail">
            <h3><?php echo $article->name; ?></h3>
        </div>
        <div class="conent-media">
            <img class="detail-container" src="<?php echo e(asset('upload/'.$article->post_image)); ?>">
        </div>
        <div class="content-detail">
            <h3>description</h3>
            <?php echo $article->content_html; ?>

        </div>
        <div class="content-share">
            <a
                href="https://twitter.com/share?url=<?php echo e(url()->current()); ?>"
                class="twitter-share-button"
                data-show-count="false">
                Tweet
            </a>
        </div>


            <script
                async src="https://platform.twitter.com/widgets.js"
                charset="utf-8">
            </script>


        <form action="<?php echo e(url('/article/comment')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <h3>Add your comment</h3>
            <div class="form-group">
                <input type="hidden" name="article_id" id="article_id" value="<?php echo e($article->data_id); ?>">

                <textarea id="summernote" name="detail" class="form-control">
                </textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="send" id="send" class="btn btn-success">
                <input type="button" name="clear" id="clear" class="btn btn-danger pull-right" value="Clear">
            </div>
        </form>

        <?php $__currentLoopData = $comment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="comment">
                <div class="col-md-1 col-sm-1">
                    <img src="<?php echo e(asset("fireuikit/images/user1.png")); ?>">
                </div>
                <div class="col-md-11 col-sm-11 ">
                    <p><?php echo $row->content; ?></p>
                    <p><?php echo $row->name; ?></p>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="<?php echo e(asset('fireuikit/js/jquery.magnific-popup.js')); ?>"></script>

    <script src="<?php echo e(asset('fireuikit/js/mediagallery.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(summernote).summernote({
                height: '100px',
                placeholder: "Input content here...",
                fontNames: ['Arial', 'Arial Black'],
            })
        });
        $(clear).on('click',function () {
            $(summernote).summernote('code',null);
        })

    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.basic1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\laravel\tipsmate\tipsmate\resources\views/article_detail.blade.php ENDPATH**/ ?>