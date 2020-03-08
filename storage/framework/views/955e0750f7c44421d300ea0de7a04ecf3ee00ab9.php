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
    <style>
        .form-group.required label:after {
            content: " *";
            color: red;
            font-weight: bold;
        }
    </style>
    <?php echo $__env->yieldContent('link'); ?>
</head>

<body class="container-fluid">
    <div class="row" style="height: 40px;"></div>
    <hr>

    <div class="row">

        <div class="col-md-10">
            <div class="form-group row mt-3">
                <div class="media p3 ml-4 mr-3 p-3">
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
                    <div class="media-body ml-4">
                        <h4><?php echo e($user->name); ?></h4>
                        <p>Add profile credential</p>
                        <p>Write a description about yourself</p>
                        <p>
                            <?php if($followers): ?>
                                <?php echo e($followers->followers); ?>

                            <?php else: ?>
                                0
                            <?php endif; ?>
                            Followers</p>
                    </div>
                </div>
            </div>
            <div class="row border-top ml-4 mr-3 mt-3">
                <h5 class="mt-3">Profile</h5>
            </div>
            <div class="row border-top mt-2 ml-4 mr-3">
                    <div class="col-md-6 mt-4">
                        <ul style="padding-left: 0">
                            <li>Asked Questions(<?php echo e(count($questions)); ?>)</li>
                            <li>Answered Question(<?php echo e(count($answers)); ?>)</li>
                            <li>"How to" Articles & Video Posts</li>
                            <li>Followers(<?php echo e($following); ?>)</li>
                        </ul>
                    </div>
                    <div class="col-md-6 mt-4">
                        <h6>You can now do the following;</h6>
                        <ul style="padding-left: 0;list-style-type: none;color: #000099">
                            <li><i class="fa fa-check"></i> Answer a question</li>
                            <li><i class="fa fa-check"></i>Ask a question</li>
                            <li><i class="fa fa-check"></i>Post an How-to Article/Video</li>
                        </ul>
                    </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row border-bottom mr-2 mt-3">
                <h6>Credentials & Highlights &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil"></i></h6>
            </div>
            <div class="row mt-3" style="color: #276aac">
                <p><i class="fa fa-briefcase"></i>&nbsp;&nbsp;&nbsp;Add employment credential</p>
                <p><i class="fa fa-graduation-cap"></i>&nbsp;&nbsp;Add education credential</p>
                <p><i class="fa fa-map-marker fa-lg"></i>&nbsp;&nbsp;&nbsp;&nbsp;Add a location credential</p>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
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
<?php /**PATH /home4/gordon2012/public_html/tipsmate/resources/views/profile.blade.php ENDPATH**/ ?>