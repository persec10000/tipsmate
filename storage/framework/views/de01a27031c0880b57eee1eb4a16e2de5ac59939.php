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
    <link rel="icon" href="<?php echo e(asset('fireuikit/images/favicon.ico')); ?>">
    <script data-ad-client="ca-pub-8982024490473272" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <style>
        a.morelink {
            text-decoration:none;
            outline: none;
        }
        .morecontent span {
            display: none;
        }
    </style>
    <?php echo $__env->yieldContent('link'); ?>
</head>
<body class="container-fluid">
    <div id='loader' style='display: none;position:absolute;top:50%'>
      <img src='<?php echo e(asset('fireuikit/images/ajax-loader.gif')); ?>' width='32px' height='32px'>
    </div>
    <header>
        <div class="row hd">
            <div class="col-md-2">
                <div class="logo ml-5 mt-4" style="width: 100%;height: 100%">
                    <img src="<?php echo e(asset("fireuikit/images/logo_img.png")); ?>">
                </div>
            </div>
            <div class="col-md-6" style="padding-right: 0">
                <div class="row">
                    <img src="<?php echo e(asset("fireuikit/images/picturemessage_wii4zy3x.omx.png")); ?>" style="width: 100%; padding-left:2%">
                </div>
                <div>
                    <ul class="nav mb-3">
                        <li class="nav-item" >
                            <a class="hvr-rectangle-out" <?php if(Request::path()=='askme'): ?> style="background: #000000" <?php endif; ?> href="askme" id="askme">ASK ME</a>
                        </li>
                        <li class="nav-item">
                            <a class="hvr-rectangle-out" href="howto" id="howto" <?php if(Request::path()=='howto'): ?> style="background: #000000" <?php endif; ?>>HOW TO</a>
                        </li>
                        <?php if(!Auth::user()): ?>
                            <li class="nav-item">
                                <a class="hvr-rectangle-out" href="register" id="register" <?php if(Request::path()=='register'): ?> style="background: #000000" <?php endif; ?>>Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="hvr-rectangle-out" href="login" id="login" <?php if(Request::path()=='login'): ?> style="background: #000000" <?php endif; ?>>Login</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-2">
                <div  style="position: absolute;bottom:10px;padding-left: 6%" class="ml-5">
                    <?php if(Auth::user()): ?>
                        <img id="userimg" src="<?php echo e(asset('fireuikit/images/users/'.auth()->user()->image)); ?>" style="width: 30px;height: 30px" class="rounded-circle">
                        <a><?php echo e(ucwords(Auth::user()->name)); ?></a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </header>

    <section>
        <div class="row">
            <div class="col-md-2 col-sm-2">
                <?php echo $__env->yieldContent('leftside'); ?>
            </div>
            <?php echo $__env->yieldContent('content'); ?>
            <?php echo $__env->yieldContent('rightside'); ?>

        </div>
    </section>
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
                "<div class='user_pic'><?php if(Auth::user()): ?><img src='<?php echo e(asset('fireuikit/images/user.png')); ?>'/></div><div class='details ml-2'><span class='username mb-2'> <?php echo e(ucwords(Auth::user()->name)); ?></span><br><p class='useremail'><?php echo e(ucwords(Auth::user()->email)); ?> <?php endif; ?></p></div></div>", content: "<div class='dropdown_content'><ul class='list-group list-group-flush'><li class='list-group-item'><i class='fa fa-user'></i><a href='/profile' class='FC'>My profile</a></li><li class='list-group-item'><a href='logout' class='FC'>Logout</a></li></ul></div>", html: true, placement: "bottom"});
        $('.summernote').summernote({
            height: '300px',
            
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
<?php echo $__env->yieldContent('js'); ?>
</html>
<?php /**PATH /home4/gordon2012/public_html/tipsmate/resources/views/layouts/basic.blade.php ENDPATH**/ ?>