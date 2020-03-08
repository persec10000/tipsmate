<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>TIPSMATE</title>

    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/font-awesome.min.css')); ?>">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/header.css')); ?>">

    <link rel="icon" href="<?php echo e(asset('fireuikit/images/favicon.png')); ?>">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <script data-ad-client="ca-pub-8982024490473272" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <?php echo $__env->yieldContent('link'); ?>
</head>

<body class="container-fluid"  id = "how_to"  >


   <div class="row ml-3 hd">
        <div class="col-md-1">
        </div>
        <div class="col-md-2 logo">

        </div>
        <div class="col-md-6 logo">
            <div class="main-menu">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="inactive" href="/askme" id="askme">ASK ME</a>
                    </li>
                    <li class="nav-item">
                        <a class="active1" href="/howto" id="howto">HOW TO</a>
                    </li>
                    <?php if(!Auth::user()): ?>
                        <li class="nav-item">
                            <a class="inactive" href="/register" id="register">REGISTER</a>
                        </li>
                        <li class="nav-item">
                            <a class="inactive" href="/login" id="register">
                                <img src="<?php echo e(asset("fireuikit/images/user1.png")); ?>">&nbsp;&nbsp;LOGIN
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="inactive" href="/register" id="register">LOGOUT</a>
                        </li>
                        <li class="nav-item">
                            <a class="inactive" href="/profile" id="register">
                                <img id="userimg" src="<?php echo e(asset('fireuikit/images/users/'.Auth::user()->image)); ?>" style="width: 50px;height: 50px" class="rounded-circle">
                                <?php echo e(ucwords(Auth::user()->name)); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
        <div class="col-md-1 logo">
            <div class="date" style="background:url(<?php echo e(asset("fireuikit/images/calendr.png")); ?>) no-repeat center bottom">
                 <p id="date"><?php echo e(date("d")); ?></p>
            </div>
        </div>
    </div>
   <div class="row state">
       <div class="col-md-3">
           </div>
       <div class="col-md-5 sub-title">
           <?php echo $__env->yieldContent('search'); ?>
       </div>
       <div class="col-md-1 sub-title">
           <?php echo $__env->yieldContent('create'); ?>
       </div>
       <div class="col-md-3">
       </div>

   </div>
   <div class="row  sub-menu-container">
       <div class="col-md-1">
       </div>
       <div class="col-md-2 category-title">

       </div>
       <div class="col-md-6 sub-menu">
           <?php echo $__env->yieldContent('submenu'); ?>

       </div>



       <div class="col-md-2">

       </div>
   </div>
   <div class="row ml-3 space">
   </div>
   <div class="row ml-3 sub-menu">
       <div class="col-md-1">
       </div>
       <div class="col-md-2">
            <?php echo $__env->yieldContent('categories'); ?>
       </div>
       <div class="col-md-6 content">
           <?php echo $__env->yieldContent('content'); ?>
       </div>
       <div class="col-md-1">
           <div class="google_ads">
                 <img src="<?php echo e(asset("fireuikit/images/google_ads.jfif")); ?>">
           </div>
           <div class="google_ads">
               <img src="<?php echo e(asset("fireuikit/images/google_ads.jfif")); ?>">
           </div>
       </div>
       <div class="col-md-1">
       </div>

   </div>





</body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

    <script type="text/javascript">
         $(document).ready(function(){

         $('#userimg').popover({title: "<div class='m_dropdown_header'>" +
                "<div class='user_pic'><?php if(Auth::user()): ?><img src='<?php echo e(asset('fireuikit/images/user.png')); ?>'/></div><div class='details ml-2'><span class='username mb-2'> <?php echo e(ucwords(Auth::user()->name)); ?></span><br><p class='useremail'><?php echo e(ucwords(Auth::user()->email)); ?> <?php endif; ?></p></div></div>", content: "<div class='dropdown_content'><ul class='list-group list-group-flush'><li class='list-group-item'><i class='fa fa-user'></i><a href='' class='FC'>My profile</a></li><li class='list-group-item'><a href='logout' class='FC'>Logout</a></li></ul></div>", html: true, placement: "bottom"});
    });

    $('#userimg').popover({title: "<div class='m_dropdown_header'><div class='user_pic'><img src='<?php echo e(asset('fireuikit/images/user.png')); ?>'></div><div class='details'><span><?php if(Auth::user()): ?> <?php echo e(ucwords(Auth::user()->name)); ?></span><p><?php echo e(ucwords(Auth::user()->email)); ?> <?php endif; ?></p></div></div>", content: "<div class='dropdown_content'><a href='logout'>Logout</a></div>", html: true, placement: "bottom"});


    $('#userimg').popover({title: "<div class='m_dropdown_header'>" +
                "<div class='user_pic'><?php if(Auth::user()): ?><img src='<?php echo e(asset('fireuikit/images/user.png')); ?>'/></div><div class='details ml-2'><span class='username mb-2'> <?php echo e(ucwords(Auth::user()->name)); ?></span><br><p class='useremail'><?php echo e(ucwords(Auth::user()->email)); ?> <?php endif; ?></p></div></div>", content: "<div class='dropdown_content'><ul class='list-group list-group-flush'><li class='list-group-item'><i class='fa fa-user'></i><a href='' class='FC'>My profile</a></li><li class='list-group-item'><a href='logout' class='FC'>Logout</a></li></ul></div>", html: true, placement: "bottom"});



</script>
<?php echo $__env->yieldContent('js'); ?>
</html>
<?php /**PATH /home4/gordon2012/public_html/tipsmate/resources/views/layouts/basic1.blade.php ENDPATH**/ ?>