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


    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/footer.css')); ?>">
    <link rel="icon" href="<?php echo e(asset('fireuikit/images/favicon.png')); ?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <script data-ad-client="ca-pub-8982024490473272" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <?php echo $__env->yieldContent('link'); ?>
</head>

<body class="container-fluid"  id = "how_to"  >


<header>
    <div class="row hd">
        <div class="col-sm-1 col-md-1"></div>
        <div class="col-md-2">
            <div class="logo" style="width: 100%;height: 100%">
                <img src="<?php echo e(asset("fireuikit/images/logo_img.png")); ?>">
            </div>
        </div>
        <div class="col-md-6  ">
            <div class="row align-items-center" style="width: 100%; height: 100%">
                <div class=" col main-menu ">
                    <ul class="nav top-menu">
                        <li class="nav-item">
                            <a class="inactive" href="/askme" id="askme">ASK&nbsp;ME</a>
                        </li>
                        <li class="nav-item">
                            <a class="active1" href="/howto" id="howto">HOW&nbsp;TO</a>
                        </li>

                        <?php if(!Auth::user()): ?>
                            <?php if(Route::has('register')): ?>
                                <li class="nav-item">
                                    <a class="inactive" href="<?php echo e(route('register')); ?>"
                                    >REGISTER</a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="inactive" href="<?php echo e(route('logout')); ?>">LOGOUT</a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </div>
            </div>

        </div>
        <div class="col-md-2">
            <?php if(Auth::user()): ?>
                <a class="inactive" href="/profile" id="register">
                    <div class="date d-flex justify-content-center align-items-center">
                        <div>
                            <img id="userimg" src="<?php echo e(asset('fireuikit/images/users/'.Auth::user()->image)); ?>"
                                 style="width: 75px;height: 75px" class="rounded-circle">

                        </div>
                        <div class="profile_name"><?php echo e(ucwords(Auth::user()->name)); ?></div>

                    </div>
                </a>
            <?php else: ?>
                <a class="inactive" href="<?php echo e(route('login')); ?>" id="register">
                    <div class="date d-flex justify-content-center align-items-center">
                        <div>
                            <img id="userimg" src="<?php echo e(asset("fireuikit/images/user1.png")); ?>"
                                 style="width: 75px;height: 75px" class="rounded-circle">

                        </div>
                        <div class="profile_name">LOGIN</div>

                    </div>
                </a>

            <?php endif; ?>

        </div>

    </div>

</header>


   <div class="row state sticky" id="myHeader">
       <div class="col-xl-3 col-lg-2 ">
           </div>
       <div class="col-xl-5 col-lg-6 col-md-9 col-sm-9 col-8 sub-title">
           <?php echo $__env->yieldContent('search'); ?>
       </div>
       <div class="col-xl-1 col-lg-2 col-md-3 col-sm-3 col-4 sub-title">
           <?php echo $__env->yieldContent('create'); ?>
       </div>
       <div class="col-xl-3 col-lg-2 ">
       </div>

   </div>
   <div class="row  sub-menu-container">
       <div class="col-lg-1"></div>
       <div class="col-lg-2 col-md-4" style="display: flex">
           <div class="category_symbol">
               <p class="separator_title category_title">CATEGORIES</p>
           </div>
       </div>
       <div class="col-lg-6 col-md-8 sub-menu">
           <?php echo $__env->yieldContent('submenu'); ?>
       </div>



       <div class="col-md-2">

       </div>
   </div>
   <div class="row space">
   </div>
   <div class="row main_content">
       <div class="col-lg-1">
       </div>
       <div class="col-lg-2 col-md-4 col-sm-12">
            <?php echo $__env->yieldContent('categories'); ?>
       </div>
       <div class="col-lg-6 col-md-8 content">
           <?php echo $__env->yieldContent('content'); ?>
       </div>
       <div class="col-lg-1 ">
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

   <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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

<script>
    window.onscroll = function () {
        myFunction()
    };

    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;

    function myFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }
</script>
<?php echo $__env->yieldContent('js'); ?>
</html>
<?php /**PATH F:\laravel\tipsmate\tipsmate\resources\views/layouts/basic1.blade.php ENDPATH**/ ?>