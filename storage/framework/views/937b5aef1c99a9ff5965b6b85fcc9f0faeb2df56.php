<?php $__env->startSection('link'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/howto.css')); ?>">
    
    
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">

    <meta name="twitter:card" content="player"/>
    <meta name="twitter:title" content="<?php echo e($video->title); ?>"/>
    <meta name="twitter:description" content="<?php echo e($video->description); ?>"/>
    <meta name="twitter:player" content="<?php echo e(asset('upload/'.$video->video_url)); ?>"/>
    <meta name="twitter:image" content="<?php echo e(asset('fireuikit/images/'.$video->image)); ?>"/>
    <meta name="twitter:player:width" content="300"/>
    <meta name="twitter:player:height" content="200"/>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('submenu'); ?>
    <ul class="nav">
        <li class="nav-item article inactive" id="sub-menu">
            <a class="nav-link inactive"  href="/howto/article" >ARTICLES</a>
        </li>
        <li class="nav-item video active1" id="sub-menu">
            <a class="nav-link active1" href="/howto/video" >VIDEOS</a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('categories'); ?>
    <div id="cat-all" roll="navigation" class="row">
        <ul class="none FW-400 MY-0 ml-3" id="categories">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="none FW-400 MY-0 ml-3 categories" href="#">
                    <li class="FC_list" id="<?php echo e($row->id); ?>">
                        <?php echo e($row->category); ?>

                    </li>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-border">
        <div class="content-detail">
            <h5><?php echo $video->category; ?></h5>
        </div>
        <div class="content-title">
            <h2><b><?php echo e($video->title); ?></b></h2>
        </div>

        <div class="content-detail">
            <h4><?php echo $video->name; ?></h4>
        </div>
        <div class="conent-media">
            <video class="detail-view" controls>
                <source src="<?php echo e(asset('upload/'.$video->video_url)); ?>" type="video/mp4">
            </video>
        </div>
        <div class="content-detail">
            <?php echo $video->description; ?><br>
            
            
            

            
            
            
        </div>
        <div class="content-share">
            <div class="col-md-6">
                <Span><?php echo $video->views; ?></Span> <Span>views</Span>
                <Span class="up" id="<?php echo e($video->data_id); ?>">&nbsp;&nbsp; <img src="<?php echo e(asset('fireuikit/images/up.png')); ?>">
                </Span>
                <Span id="like"><?php echo $video->like; ?></Span>

                <Span class="down"  id="<?php echo e($video->data_id); ?>">    <img src="<?php echo e(asset('fireuikit/images/down.png')); ?>">
                </Span>
                <Span id="unlike">  <?php echo $video->unlike; ?></Span>
                <Span>&nbsp;&nbsp;comment:&nbsp;(<?php echo $video->comment; ?>)</Span>
            </div>
            <div class="col-md-1">
                <a
                    href="https://twitter.com/share?url=<?php echo e(url()->current()); ?>"
                    class="twitter-share-button"
                    data-show-count="false">
                    Tweet
                </a>
            </div>
            <div class="fb-share-button col-md-1" data-href="https://developers.facebook.com/docs/plugins/"
                 data-layout="button_count" data-size="small">
                <a target="_blank"
                   href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                   class="fb-xfbml-parse-ignore">Share</a>
            </div>
        </div>
    </div>
    <script
        async src="https://platform.twitter.com/widgets.js"
        charset="utf-8">
    </script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0"></script>
    <form action="<?php echo e(url('/video/comment')); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <h3>Add your comment</h3>
        <div class="form-group">
            <input type="hidden" name="article_id" id="article_id" value="<?php echo e($video->data_id); ?>">

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
                <img id="userimg" src="<?php echo e(asset('fireuikit/images/users/'.Auth::user()->image)); ?>"
                     style="width: 50px;height: 50px" class="rounded-circle">
            </div>
            <div class="col-md-11 col-sm-11  comment-content">
                <p>
                    <span><?php echo $row->content; ?></span>
                    <span><br></span>
                    <span><b><?php echo $row->name; ?></b></span>
                </p>

            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="<?php echo e(asset('fireuikit/js/jquery.magnific-popup.js')); ?>"></script>
    <script src="<?php echo e(asset('fireuikit/js/mediagallery.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(summernote).summernote({
                height: '300px',
                placeholder: "Write here...",
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                ],
                fontNames: ['Arial', 'Arial Black'],
            })

        });
        $(clear).on('click', function () {
            $(summernote).summernote('code', null);
        })

    </script>
    <script src="<?php echo e(asset('fireuikit/js/video_content.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.basic1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gordon2012/public_html/tipsmate/resources/views/howto/video_detail.blade.php ENDPATH**/ ?>