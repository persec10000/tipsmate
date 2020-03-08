<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>TIPSMATE</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/admin.css')); ?>">
    <script src="<?php echo e(asset('dashboard/js/font_awesome.js')); ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">



</head>

<body >

    <div class="wrapper">
    <div class="menu-container " roll="navigation" >
        <ul class="menu">
            <li class="menu-link  mb-3">
                <a href="<?php echo e(route('admin.category.index')); ?>" class="menu-icon " >
                    <div class="menu-context">
                        <div class="menu-context icon mb-3">
                            <i class="fas fas fa-list custom"></i><br>
                        </div>
                        <div class="menu-context text mb-3">
                            Manage Categories
                        </div>
                    </div>
                </a>
                <a href="<?php echo e(route('admin.user.index')); ?>" class="menu-icon" >
                    <div class="menu-context">
                        <div class="menu-context icon mb-3">
                            <i class="fas fas fa-user custom"></i>
                        </div>
                        <div class="menu-context text mb-3">
                            Manage users
                        </div>
                    </div>
                </a>
                <a href="<?php echo e(route('admin.question.index')); ?>" class="menu-icon" >
                    <div class="menu-context">
                        <div class="menu-context icon mb-3">
                            <i class="fas fa-question-circle custom"></i><br>
                        </div>
                        <div class="menu-context text mb-3">
                            Manage Question
                        </div>
                    </div>
                </a>
                <a href="<?php echo e(route('admin.answer.index')); ?>" class="menu-icon" >
                    <div class="menu-context">
                        <div class="menu-context icon mb-3">
                            <i class="fas fa-font custom"></i><br>
                        </div>
                        <div class="menu-context text mb-3">
                            Manage Answer
                        </div>
                    </div>
                </a>
                <a href="<?php echo e(route('admin.comment.index')); ?>" class="menu-icon" >
                    <div class="menu-context">
                        <div class="menu-context icon mb-3">
                            <i class="fas fa-comment-dots custom"></i><br>
                        </div>
                        <div class="menu-context text mb-3">
                            Comment to Answer
                        </div>
                    </div>
                </a>

                <a href="<?php echo e(route('admin.article.index')); ?>" class="menu-icon" >
                    <div class="menu-context">
                        <div class="menu-context icon mb-3">
                            <i class="fas fa-file-alt custom"></i><br>
                        </div>
                        <div class="menu-context text mb-3">
                            Manage Article
                        </div>
                    </div>
                </a>
                <a href="<?php echo e(route('admin.video.index')); ?>" class="menu-icon" >
                    <div class="menu-context">
                        <div class="menu-context icon mb-3">
                            <i class="fas fa-video custom"></i><br>
                        </div>
                        <div class="menu-context text mb-3">
                            Manage Video
                        </div>
                    </div>
                </a>
            </li>
            <a href="<?php echo e(route('admin.videocomment.index')); ?>" class="menu-icon" >
                <div class="menu-context">
                    <div class="menu-context icon mb-3">
                        <i class="fas fa-comment-dots custom"></i><br>
                    </div>
                    <div class="menu-context text mb-3">
                        Comment to Video
                    </div>
                </div>
            </a>

        </ul>
    </div>

      <div class=" container-fluid" style="background-color:darkseagreen" >
        <?php echo $__env->yieldContent('content'); ?>
      </div>
    </div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<?php echo $__env->yieldContent('js'); ?>
<script>
    $(document).ready(function(){
        $('#userimg').popover({title: "<div class='m_dropdown_header'>" +
                "<div class='user_pic'><?php if(Auth::user()): ?><img src='<?php echo e(asset('fireuikit/images/user.png')); ?>'/></div><div class='details ml-2'><span class='username mb-2'> <?php echo e(ucwords(Auth::user()->name)); ?></span><br><p class='useremail'><?php echo e(ucwords(Auth::user()->email)); ?> <?php endif; ?></p></div></div>", content: "<div class='dropdown_content'><ul class='list-group list-group-flush'><li class='list-group-item'><i class='fa fa-user'></i><a href='' class='FC'>My profile</a></li><li class='list-group-item'><a href='logout' class='FC'>Logout</a></li></ul></div>", html: true, placement: "bottom"});
    });

</script>

</html>
<?php /**PATH /home4/gordon2012/public_html/tipsmate/resources/views/admin/basic.blade.php ENDPATH**/ ?>