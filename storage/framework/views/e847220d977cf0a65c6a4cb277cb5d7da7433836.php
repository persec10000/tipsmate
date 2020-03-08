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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/register.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/login.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/footer.css')); ?>">

    <link rel="icon" href="<?php echo e(asset('fireuikit/images/favicon.ico')); ?>">
    <!--<script data-ad-client="ca-pub-8982024490473272" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>-->
    <?php echo $__env->yieldContent('link'); ?>
</head>
<body class="container">
<div id='loader' style='display: none;position:absolute;top:50%'>
    <img src='<?php echo e(asset('fireuikit/images/ajax-loader.gif')); ?>' width='32px' height='32px'>
</div>
<header>
    <div class="row hd">

        <div class="col-lg-3 col-md-3">
            <div class="logo" style="width: 100%;height: 100%; display: flex; align-items: flex-end">
                <div class="logo_block" style="width: fit-content; height: fit-content; display: block">
                    <img src="<?php echo e(asset("fireuikit/images/logo_img.png")); ?>">
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9">
            <img src="<?php echo e(asset("fireuikit/images/adverse.png")); ?>" style="width: 100%; ">
            <div class=" align-items-center" style="width: 100%; height: 30%">

                <ul class="nav" style="width: 100%">
                    <li class="nav-item">
                        <a class="hvr-rectangle-out" <?php if(Request::path()=='askme'): ?> style="background: #272727"
                           <?php endif; ?> href="<?php echo e(route('ask_me')); ?>" id="askme">ASK ME</a>
                    </li>
                    <li class="nav-item">
                        <a class="hvr-rectangle-out" href="<?php echo e(url('howto')); ?>" id="howto"
                           <?php if(Request::path()=='howto'): ?> style="background: #000000" <?php endif; ?>>HOW TO</a>
                    </li>
                    <?php if(!Auth::user()): ?>
                        <li class="nav-item">
                            <a class="hvr-rectangle-out" href="<?php echo e(route('register')); ?>" id="register"
                               <?php if(Request::path()=='register'): ?> style="background: #000000" <?php endif; ?>>REGISTER</a>
                        </li>
                        <li class="nav-item">
                            <a class="hvr-rectangle-out" href="<?php echo e(url('login')); ?>" id="login"
                               <?php if(Request::path()=='login'): ?> style="background: #000000" <?php endif; ?>>LOGIN</a>
                        </li>
                    <?php else: ?>

                        <li class="nav-item">
                            <a class="hvr-rectangle-out" href="<?php echo e(url('/profile')); ?>" id="register"
                               <?php if(Request::path()=='register'): ?> style="background: #000000" <?php endif; ?>>PROFILE</a>
                        </li>
                        <li class="nav-item">
                            <a class="hvr-rectangle-out" href="<?php echo e(url('logout')); ?>" id="login"
                               <?php if(Request::path()=='login'): ?> style="background: #000000" <?php endif; ?>>LOGOUT</a>
                        </li>

                    <?php endif; ?>

                </ul>


            </div>

        </div>

    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 ">
            <div class="topnav row" id="myHeader">
                <div class="col-3 space">
                </div>
                  <div class="col-lg-9 col-md-12" >
                    <div class="topnav-centered">
                        <div class="input-group">
                            <input type="text" class="form-control" id="search" name="search" style="font-size: 20px">
                            <div class=" input-group-append">
                                
                            </div>
                            <button id="answer_search" class="hvr-rectangle-out search_btn ml-5">Search Answers</button>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>


</header>

<section>

    <?php if($singlePage !== 'ture'): ?>
        <div class="row">

            <div class=" col-lg-3 col-md-3" style="display: flex">
                <div class="category_symbol">
                    <p class="separator_title category_title">CATEGORIES</p>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12  ">
                <div class="separator_content">
                    <div class="main-menu">
                        <ul class="nav">
                            <li class=" nav-item">
                                <a id="find" href="javascript:void(0)" class="hvr-rectangle-out" style="width: 250px">Find&nbsp;Question</a>
                            </li>
                            <li class=" nav-item">
                                <a id="answer" href="javascript:void(0)" class="hvr-rectangle-out" style="width: 250px">Answer&nbsp;Questions</a>
                            </li>
                        </ul>
                    </div>

                    
                    
                </div>
            </div>
            <div class="col-lg-1">
                
                
                
                
                
                
            </div>
        </div>
    <?php endif; ?>
    <div class="row content">

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
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
    $(document).ready(function () {
        $('.more').each(function () {
            $(this).click(function () {
                var id = this.id;
                var x = $('#edit_content' + id + '').html();
                $('#com' + id + '').html(x);
                $('.ques_content').off('click').on('click', function () {
                    $(this).click(function () {
                        $.ajax({
                            url: "/viewanswer",
                            method: 'post',
                            data: {
                                id: id
                            },
                            success: function (data) {
                                $('#fq').html(data);
                                console.log("123");
                                window.history.pushState(document.documentElement.outerHTML, null, "askme/" + id);
                                $('#post_id').html('undefined');
                                $('#answer').on('click', function () {
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
                                        onPaste: true
                                    });
                                    $('.summer_reset').each(function () {
                                        $(this).click(function () {
                                            var id = this.id;
                                            // alert(id);
                                            $('#summer' + id + '').summernote('reset');
                                        })
                                    })
                                });
                            }
                        })
                    })
                });
            })
        });
        
        
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
                var id = this.id;
                // alert(id);
                $('#summer' + id + '').summernote('reset');
            })
        })
        //Right Side
        $(summernote1).summernote({
            height: '300px',
            maximumImageFileSize: 51200000,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']],
            ],
            fontNames: ['Arial', 'Arial Black'],
            onPaste: true,
            callbacks: {
                onImageUpload: function (files, editor, welEditable) {

                    sendFile(files[0], editor, welEditable);
                }
            }
        });

        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("_token", "<?php echo e(csrf_token()); ?>");
            data.append("id", "");
            data.append("file", file);
            console.log(file);
            $.ajax({
                data: data,
                type: "POST",
                url: "<?php echo e(route('image_upload')); ?>",
                cache: false,
                contentType: false,
                processData: false,
                success: function (url) {
                    $('#summernote1').summernote('insertImage', location.origin + '/' + url, function ($image) {
                        $image.css('width', "100%");
                        $image.attr('data-filename', 'retriever');
                    });
                }
            });
        }

        $(clear).on('click', function () {
            $(summernote1).summernote('reset');
        })

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
<?php /**PATH F:\laravel\tipsmate\resources\views/layouts/layout.blade.php ENDPATH**/ ?>