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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/register.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/login.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/footer.css')); ?>">
    <link rel="icon" href="<?php echo e(asset('fireuikit/images/favicon.png')); ?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <script data-ad-client="ca-pub-8982024490473272" async
            src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <?php echo $__env->yieldContent('link'); ?>
</head>

<body class="container" id="how_to">


<header>
    <div class="row hd">

        <div class="col-xl-3 col-lg-3 col-md-2">
            <div class="logo" style="width: 100%;height: 100%; display: flex; align-items: flex-end">
                <div class="logo_block" style="width: fit-content; height: fit-content; display: block">
                    <img src="<?php echo e(asset("fireuikit/images/logo_img.png")); ?>">
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-8">
            <img src="<?php echo e(asset("fireuikit/images/adverse.png")); ?>" style="width: 100%; ">
            <div class=" align-items-center" style="width: 100%; height: 30%">

                <ul class="nav topmenu" style="width: 100%">
                    <li class="nav-item">
                        <a class="hvr-rectangle-out" <?php if(Request::path()=='askme'): ?> style="background: #272727"
                           <?php endif; ?> href="<?php echo e(url('askme')); ?>" id="askme">ASK&nbsp;ME</a>
                    </li>
                    <li class="nav-item">
                        <a class="hvr-rectangle-out" href="<?php echo e(url('howto')); ?>" id="howto"
                           <?php if(Request::path()=='howto'): ?> style="background: #272727" <?php endif; ?>>HOW&nbsp;TO</a>
                    </li>
                    <?php if(!Auth::user()): ?>
                        <li class="nav-item">
                            <a class="hvr-rectangle-out" href="<?php echo e(url('register')); ?>" id="register"
                               <?php if(Request::path()=='register'): ?> style="background: #000000" <?php endif; ?>>Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="hvr-rectangle-out" href="<?php echo e(url('login')); ?>" id="login"
                               <?php if(Request::path()=='login'): ?> style="background: #000000" <?php endif; ?>>Login</a>
                        </li>
                    <?php else: ?>

                        <li class="nav-item">
                            <a class="hvr-rectangle-out" href="<?php echo e(url('/profile')); ?>" id="register"
                               <?php if(Request::path()=='register'): ?> style="background: #000000" <?php endif; ?>>Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="hvr-rectangle-out" href="<?php echo e(url('logout')); ?>" id="logout"
                               <?php if(Request::path()=='logout'): ?> style="background: #000000" <?php endif; ?>>Logout</a>
                        </li>

                    <?php endif; ?>

                </ul>


            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-xl-12 col-lg-12 ">
            <div class="topnav row" id="myHeader">
                <div class="col-3">
                </div>
                <div class="col-9">
                    <div class="topnav-centered">
                        <form id="frm" name="frm"
                              action="<?php echo e($subMenu == 'article'? url('/howto/article/search') : url('/howto/video/search')); ?>"
                              method="get"
                              enctype="multipart/form-data">
                            <div class="input-group">
                                <input type="text" class="form-control" id="search" name="search"
                                       style="font-size: 20px">
                                <div class=" input-group-append">
                                </div>
                                <button id="search" href="#" class="hvr-rectangle-out ml-5"
                                        style="border: 1px solid; text-shadow: 1px 1px black; border-radius: 5px;">
                                    Search&nbsp;<?php echo e($subMenu); ?>

                                </button>
                                <?php if(Auth::user()): ?>
                                <a href="<?php echo e(url('/howto/'.$subMenu.'/create')); ?>" class="hvr-rectangle-out "
                                   style="border: 1px solid; text-shadow: 1px 1px black; border-radius: 5px; margin-left: 20px;">Create&nbsp;<?php echo e($subMenu); ?>

                                </a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>


<div class="row  sub-menu-container">

    <div class="col-lg-3 col-md-4" style="display: flex">
        <div class="category_symbol">
            <p class="separator_title category_title">CATEGORIES</p>
        </div>
    </div>
    <div class="col-lg-7 col-md-8 sub-menu">
        <ul class="nav ">
            <li class="nav-item">
                <a class="hvr-rectangle-out" href="<?php echo e(url('/howto/article')); ?>"
                   style="<?php echo e($subMenu == 'article'? 'background:#000': ''); ?>">ARTICLES</a>
            </li>
            <li class="nav-item ">
                <a class="hvr-rectangle-out" href="<?php echo e(url('/howto/video')); ?>"
                   style="<?php echo e($subMenu == 'article'? '': 'background:#000'); ?>">VIDEOS</a>
            </li>
        </ul>
    </div>
    


    <div class="col-lg-1">

    </div>
</div>

<div class="row main_content">

    <div class="col-lg-3 col-md-4 col-sm-12">
        
        <div id="cat-all" roll="navigation" class="row">
            <ul class="none FW-400 ml-3" id="categories">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="FC_list" id="<?php echo e($row->id); ?>">
                        <a href="<?php echo e(url($subMenu.'_category/'.$row->id)); ?>" class="bottom"> <?php echo e($row->category); ?> </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
    <div class="col-lg-7 col-md-8 content">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <div class="col-lg-2 ">
        <div class="google_ads" style="display: flex; justify-content: flex-end">
            <img src="<?php echo e(asset("fireuikit/images/advertise3.png")); ?>">
        </div>

    </div>

</div>

<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<script src="<?php echo e(asset('fireuikit/js/jquery.rateyo.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="<?php echo e(asset('fireuikit/js/summernote-bs4.js')); ?>"></script>



<script type="text/javascript">
    $(document).ready(function () {

        $('#userimg').popover({
            title: "<div class='m_dropdown_header'>" +
                "<div class='user_pic'><?php if(Auth::user()): ?><img src='<?php echo e(asset('fireuikit/images/user.png')); ?>'/></div><div class='details ml-2'><span class='username mb-2'> <?php echo e(ucwords(Auth::user()->name)); ?></span><br><p class='useremail'><?php echo e(ucwords(Auth::user()->email)); ?> <?php endif; ?></p></div></div>",
            content: "<div class='dropdown_content'><ul class='list-group list-group-flush'><li class='list-group-item'><i class='fa fa-user'></i><a href='' class='FC'>My profile</a></li><li class='list-group-item'><a href='logout' class='FC'>Logout</a></li></ul></div>",
            html: true,
            placement: "bottom"
        });
    });

    $('#userimg').popover({
        title: "<div class='m_dropdown_header'><div class='user_pic'><img src='<?php echo e(asset('fireuikit/images/user.png')); ?>'></div><div class='details'><span><?php if(Auth::user()): ?> <?php echo e(ucwords(Auth::user()->name)); ?></span><p><?php echo e(ucwords(Auth::user()->email)); ?> <?php endif; ?></p></div></div>",
        content: "<div class='dropdown_content'><a href='logout'>Logout</a></div>",
        html: true,
        placement: "bottom"
    });


    $('#userimg').popover({
        title: "<div class='m_dropdown_header'>" +
            "<div class='user_pic'><?php if(Auth::user()): ?><img src='<?php echo e(asset('fireuikit/images/user.png')); ?>'/></div><div class='details ml-2'><span class='username mb-2'> <?php echo e(ucwords(Auth::user()->name)); ?></span><br><p class='useremail'><?php echo e(ucwords(Auth::user()->email)); ?> <?php endif; ?></p></div></div>",
        content: "<div class='dropdown_content'><ul class='list-group list-group-flush'><li class='list-group-item'><i class='fa fa-user'></i><a href='' class='FC'>My profile</a></li><li class='list-group-item'><a href='logout' class='FC'>Logout</a></li></ul></div>",
        html: true,
        placement: "bottom"
    });


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
<?php /**PATH F:\laravel\tipsmate\resources\views/layouts/basic1.blade.php ENDPATH**/ ?>