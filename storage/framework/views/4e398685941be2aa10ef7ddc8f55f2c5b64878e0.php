<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>TIPSMATE</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/font-awesome.min.css')); ?>">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/footer.css')); ?>">

    <link rel="icon" href="<?php echo e(asset('fireuikit/images/favicon.ico')); ?>">
    <!--<script data-ad-client="ca-pub-8982024490473272" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>-->
    <?php echo $__env->yieldContent('link'); ?>
</head>
<body class="container-fluid">
<div id='loader' style='display: none;position:absolute;top:50%'>
    <img src='<?php echo e(asset('fireuikit/images/ajax-loader.gif')); ?>' width='32px' height='32px'>
</div>
<header>
    <div class="row hd">
        <div class="col-sm-1 col-md-1"></div>
        <div class="col-md-2">
            <div class="logo ml-5 mt-4" style="width: 100%;height: 100%">
                <img src="<?php echo e(asset("fireuikit/images/logo_img.png")); ?>">
            </div>
        </div>
        <div class="col-md-6">

            <div class="main-menu">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="active1" href="askme" id="askme">ASK ME</a>
                    </li>
                    <li class="nav-item">
                        <a class="inactive" href="howto" id="howto">HOW TO</a>
                    </li>
                    <?php if(auth()->guard()->guest()): ?>
                        <?php if(!Auth::user()): ?>
                            <?php if(Route::has('register')): ?>
                                <li class="nav-item">
                                    <a class="inactive" href="<?php echo e(route('register')); ?>" id="register">REGISTER</a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item" style="position: relative;bottom: 15px">
                                <a class="inactive" href="<?php echo e(route('login')); ?>">
                                    <img src="<?php echo e(asset("fireuikit/images/user1.png")); ?>">&nbsp;&nbsp;
                                    LOGIN
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="inactive" href="<?php echo e(route('logout')); ?>">LOGOUT</a>
                            </li>
                            <li class="nav-item">
                                <a class="inactive" href="<?php echo e(route('login')); ?>">
                                    <img id="userimg" src="<?php echo e(asset('fireuikit/images/users/'.Auth::user()->image)); ?>" style="width: 50px;height: 50px" class="rounded-circle">
                                    <?php echo e(ucwords(Auth::user()->name)); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="col-md-2">
            <div class="date d-flex justify-content-center align-items-center" style="background:url(<?php echo e(asset("fireuikit/images/calendr.png")); ?>) no-repeat bottom">
                <p id="date"><?php echo e(date("d")); ?></p>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-1 col-lg-1"></div>
        <div class="col-xl-10 col-lg-10">
            <div class="topnav" id="myHeader">
                <div class="topnav-centered">
                    <div class="input-group">
                        <input type="text" class="form-control" id="search" name="search">
                        <div class=" input-group-append">
                            <span class="fa fa-search input-group-text search-icon"></span>
                        </div>
                        <button id="answer_search" class="search_btn ml-5" >Search Answers</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-1 col-lg-1"></div>
    </div>
</header>

<section>
    <div class="row" style="height: 80px"></div>
    <div class="row">
        <div class="col-sm-1 col-md-1"></div>
        <div class="col-sm-2 col-md-2">
            <div class="row">
                <h3 class="ml-3 separator_title category_title">CATEGORIES</h3>
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="row separator_content">
                <div class="main-menu">
                    <ul class="nav">
                        <li class="nav-item">
                            <a id="find" href="javascript:void(0)" class="active1">Find Question</a>
                        </li>
                        <li class="nav-item">
                            <a id="answer" href="javascript:void(0)" class="inactive">Answer Questions</a>
                        </li>
                    </ul>
                </div>



            </div>
        </div>
        <div class="col-md-2 col-sm-2">
            <div  style="position: absolute;bottom:10px;padding-left: 6%">
                <?php if(Auth::user()): ?>
                    <img id="userimg" src="<?php echo e(asset('fireuikit/images/users/'.auth()->user()->image)); ?>" style="width: 30px;height: 30px" class="rounded-circle">
                    <a><?php echo e(ucwords(Auth::user()->name)); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row content">
        <div class="col-sm-1 col-md-1"></div>
        <div class="col-md-2 col-sm-2">
            <?php echo $__env->yieldContent('leftside'); ?>
        </div>
        <?php echo $__env->yieldContent('content'); ?>
        <?php echo $__env->yieldContent('rightside'); ?>

    </div>
</section>
<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="<?php echo e(asset('fireuikit/js/jquery.rateyo.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="<?php echo e(asset('fireuikit/js/summernote-bs4.js')); ?>"></script>
<script>
    $(document).ready(function(){
        $('.more').each(function () {
            $(this).click(function () {
                var id = this.id;
                var x = $('#edit_content'+id+'').html();
                $('#com'+id+'').html(x);
                $('.ques_content').off('click').on('click',function () {
                    $(this).click(function () {
                        $.ajax({
                            url:"/viewanswer",
                            method: 'post',
                            data:{
                                id:id
                            },
                            success:function (data) {
                                $('#fq').html(data);
                                $('#answer').on('click',function () {
                                    var msg = $('.notify').text();
                                    alert(msg);
                                    $('.item_answer').hide();
                                    $('#item' + id + '').toggle();
                                    $('.summernote').summernote({
                                        height: '100px',
                                        maximumImageFileSize: 1572864,
                                        toolbar: [
                                            // [groupName, [list of button]]
                                            ['style', ['bold', 'italic', 'clear']],
                                            ['fontsize', ['fontsize']],
                                            ['color', ['color']],
                                            ['para', ['ul', 'ol', 'paragraph']],
                                            ['insert', ['link', 'picture', 'video']],
                                        ],
                                        fontNames: ['Arial', 'Arial Black'],
                                        onPaste:true
                                    });
                                    $('.summer_reset').each(function () {
                                        $(this).click(function () {
                                            var id=this.id;
                                            // alert(id);
                                            $('#summer'+id+'').summernote('reset');
                                        })
                                    })
                                });
                            }
                        })
                    })
                });
            })
        });
        $('#userimg').popover({title: "<div class='m_dropdown_header'>" +
                "<div class='user_pic'><?php if(Auth::user()): ?><img src='<?php echo e(asset('fireuikit/images/user.png')); ?>'/></div><div class='details ml-2'><span class='username mb-2'> <?php echo e(ucwords(Auth::user()->name)); ?></span><br><p class='useremail'><?php echo e(ucwords(Auth::user()->email)); ?> <?php endif; ?></p></div></div>", content: "<div class='dropdown_content'><ul class='list-group list-group-flush'><li class='list-group-item'><i class='fa fa-user'></i><a href='profile' class='FC'>My profile</a></li><li class='list-group-item'><a href='logout' class='FC'>Logout</a></li></ul></div>", html: true, placement: "bottom"});
        $('.summernote').summernote({
            height: '300px',
            maximumImageFileSize: 1572864,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']],
            ],
            fontNames: ['Arial', 'Arial Black'],
            onPaste: true
        })
        $('.summer_reset').each(function () {
            $(this).click(function () {
                var id=this.id;
                // alert(id);
                $('#summer'+id+'').summernote('reset');
            })
        })
        //Right Side
        $(summernote1).summernote({
            height: '300px',
            maximumImageFileSize: 1572864,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']],
            ],
            fontNames: ['Arial', 'Arial Black'],
            onPaste: true
        })
        $(clear).on('click',function () {
            $(summernote1).summernote('reset');
        })
        
    });
</script>
<script>
    window.onscroll = function() {myFunction()};

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
<?php /**PATH /home4/gordon2012/public_html/tipsmate/resources/views/layouts/layout.blade.php ENDPATH**/ ?>