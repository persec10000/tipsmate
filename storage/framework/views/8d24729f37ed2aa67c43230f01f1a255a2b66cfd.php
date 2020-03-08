<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>TIPSMATE</title>

    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/font-awesome.min.css')); ?>">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" href="<?php echo e(asset('fireuikit/images/favicon.png')); ?>">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/footer.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/qa.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/profile.css')); ?>">
    <style>
        .form-group.required label:after {
            content: " *";
            color: red;
            font-weight: bold;
        }
    </style>
    <?php echo $__env->yieldContent('link'); ?>
</head>

<body class="container">
<header>
    <div class="row hd">
        <div class="col-lg-3 col-md-3">
            <div class="logo" style="width: 100%;height: 100%; display: flex;align-items: flex-end">
                <div class="logo_block" style="width: fit-content; height: fit-content; display: block">
                    <img src="<?php echo e(asset("fireuikit/images/logo_img.png")); ?>">
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9">
            <img src="<?php echo e(asset("fireuikit/images/adverse.png")); ?>" style="width: 100%; ">
            <div class=" align-items-center" style="width: 100%; height: 30%">

                <ul class="nav" style="width: 100%" >
                    <li class="nav-item" >
                        <a class="hvr-rectangle-out" <?php if(Request::path()=='askme'): ?> style="background: #272727" <?php endif; ?> href="<?php echo e(route('ask_me')); ?>" id="askme">ASK ME</a>
                    </li>
                    <li class="nav-item">
                        <a class="hvr-rectangle-out" href="<?php echo e(url('howto')); ?>" id="howto" <?php if(Request::path()=='howto'): ?> style="background: #000000" <?php endif; ?>>HOW TO</a>
                    </li>
                    <?php if(!Auth::user()): ?>
                        <li class="nav-item">
                            <a class="hvr-rectangle-out" href="<?php echo e(route('register')); ?>" id="register" <?php if(Request::path()=='register'): ?> style="background: #000000" <?php endif; ?>>Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="hvr-rectangle-out" href="<?php echo e(url('login')); ?>" id="login" <?php if(Request::path()=='login'): ?> style="background: #000000" <?php endif; ?>>Login</a>
                        </li>
                    <?php else: ?>

                        <li class="nav-item">
                            <a class="hvr-rectangle-out" href="<?php echo e(url('/profile')); ?>" id="register" <?php if(Request::path()=='register'): ?> style="background: #000000" <?php endif; ?>>Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="hvr-rectangle-out" href="<?php echo e(url('logout')); ?>" id="login" <?php if(Request::path()=='login'): ?> style="background: #000000" <?php endif; ?>>Logout</a>
                        </li>

                    <?php endif; ?>

                </ul>


            </div>

        </div>
    </div>
</header>
    <div class="row" >

            <div class="col-12 m-3">
                <div class="form-group row">
                    <div class="col-3">
                        <form action="/editprofile" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div style="text-align: center">
                                <img id="preview" src="<?php echo e(asset('fireuikit/images/users/'.$user->image)); ?>" class="rounded-circle mb-2" style="width: 169px;height: 169px"><br>
                                <input type="file" id="image" name="image" class="form-control" style="display: none">
                                <a href="javascript:changeProfile();">Change</a>|
                                <a style="color:red" href="javascript:removeImage()">Remove</a>
                                <input type="hidden" style="display: none" value="0" name="remove" id="remove">
                            </div>
                            <button type="submit" class="btn btn-primary ml-5 mt-3">Save</button>
                        </form>
                    </div>
                    <div class="col-9">
                            <div class="row justify-content-between profile_top_section p-3">
                                <h4 class="col-2 profile_name"><?php echo e($user->name); ?></h4>
                                <button class="col-2 profile_edit" id="desc_edit">Edit Description</button>
                            </div>

                            <div class="profile_second_section">
                                <textarea name="description" id="profile_description" form="form_editDesc" readonly><?php echo e($user->description); ?></textarea>
                                <form action="/editDescription" class="row justify-content-between p-3 editDesc hidden" id="form_editDesc" method="post" enctype="multipart/form-data" >
                                    <?php echo csrf_field(); ?>
                                </form>
                                <div  class="row justify-content-between p-3 editDesc hidden" id="div_editDesc">
                                    <button class="col-2  profile_description_submit" value="Cancel" id="cancel_sub">Cancel</button>
                                    <button class="col-2  profile_description_submit" value="Submit" id="submit_pro">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row  border-top mt-2 ">
                    <div class="col-3"></div>
                    <div class="col-4 mt-4">
                        <ul style="padding-left: 0">
                            <li>Asked Questions(<?php echo e(count($questions)); ?>)</li>
                            <li>Answered Question(<?php echo e(count($answers)); ?>)</li>
                            <li>"How to" Articles & Video Posts(<?php echo e($article_video); ?>)</li>
                            <li>Followers(<?php echo e($following); ?>)</li>
                        </ul>
                    </div>
                    <div class="col-5 mt-4">
                        <h6>You can now do the following;</h6>
                        <ul style="padding-left: 0;list-style-type: none;color: #000099">
                            <li>
                            <?php if($user->enable_question): ?>
                                    <i class="fa fa-check"></i>
                                    <a href="/askme">Ask</a>/<a href="/askme">Answer</a> a question
                            <?php else: ?>
                                    <i class="fa fa-clock-o"></i>
                                    Ask/Answer a question
                            <?php endif; ?>
                            </li>

                            <li>
                            <?php if($user->enable_article): ?>
                               <i class="fa fa-check"></i>
                                    Post an How-to <a href="/howto/article/create">Article</a>/<a href="/howto/video/create"> Video </a>
                            <?php else: ?>
                                    <i class="fa fa-clock-o"></i>
                                 Post an How-to Article/Video <
                            <?php endif; ?>
                                 </li>
                        </ul>
                    </div>
                </div>
           </div>
        </div>
        <div class="col-1"></div>


    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {

        $('#desc_edit').click(function () {
            console.log("test");
            $('#form_editDesc').removeClass("hidden");
            $('#form_editDesc').addClass("visible");
            $('#div_editDesc').removeClass("hidden");
            $('#div_editDesc').addClass("visible");

            $('#profile_description').removeAttr("readonly");
        });
        $('#submit_pro').click(function () {
            console.log("clicked submit button");
            $('#form_editDesc').submit();
            $('#form_editDesc').removeClass("visible");
            $('#form_editDesc').addClass("hidden");
            $('#profile_description').attr("readonly",'readonly');
         })
        $('#cancel_sub').click(function () {
            console.log("clicked cancel button");
            window.location.reload(false);
        })

    })
    function changeProfile() {
        $('#image').click();
    }
    $('#image').change(function () {
        var imgPath = $(this)[0].value;
        var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
            readURL(this);
        else
            alert("Please select image file (jpg, jpeg, png).")
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
                $('#remove').val(0);
            }
        }
    }

    function removeImage() {
        $('#preview').attr('src', '<?php echo e(url('fireuikit/images/editprofile.png')); ?>');
        $('#remove').val(1);
    }
</script>
</html>
<?php /**PATH F:\laravel\tipsmate\resources\views/profile.blade.php ENDPATH**/ ?>