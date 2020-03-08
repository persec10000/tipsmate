<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TIPSMATE</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/font-awesome.min.css')}}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/header.css')}}">
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/footer.css')}}">
    <link rel="icon" href="{{asset('fireuikit/images/favicon.ico')}}">
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
    @yield('link')
</head>
<body class="container-fluid">
    <div id='loader' style='display: none;position:absolute;top:50%'>
      <img src='{{asset('fireuikit/images/ajax-loader.gif')}}' width='32px' height='32px'>
    </div>
    <header>
        <div class="row hd">
            <div class="col-md-3">

            </div>
            <div class="col-md-2 mt-5">
                <div class="logo" style="width: 60%;height: 60%">
                    <img src="{{asset("fireuikit/images/logo_img.png")}}" style="width:200px">
                </div>
            </div>
            <div class="col-md-6 " style="padding-right: 0; margin-top:65px">

                <div>
                    <ul class="nav mb-3">
                        <li class="nav-item" >
                            <a class="hvr-rectangle-out" @if (Request::path()=='askme') style="background: #000000" @endif href="/askme" id="askme">ASK ME</a>
                        </li>
                        <li class="nav-item">
                            <a class="hvr-rectangle-out" href="/howto" id="howto" @if (Request::path()=='howto') style="background: #000000" @endif>HOW TO</a>
                        </li>
                        @if(!Auth::user())
                            <li class="nav-item">
                                <a class="hvr-rectangle-out" href="register" id="register" @if (Request::path()=='register') style="background: #000000" @endif>Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="hvr-rectangle-out" href="login" id="login" @if (Request::path()=='login') style="background: #000000" @endif>Login</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="col-md-2">

            </div>
        </div>
    </header>

    <section>
        <div class="row">
            <div class="col-md-2 col-sm-2">
                @yield('leftside')
            </div>
            @yield('content')
            @yield('rightside')

        </div>
    </section>
{{--    @include('layouts.footer')--}}
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="{{asset('fireuikit/js/jquery.rateyo.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="{{asset('fireuikit/js/summernote-bs4.js')}}"></script>
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
                "<div class='user_pic'>@if(Auth::user())<img src='{{asset('fireuikit/images/user.png')}}'/></div><div class='details ml-2'><span class='username mb-2'> {{ucwords(Auth::user()->name)}}</span><br><p class='useremail'>{{ucwords(Auth::user()->email)}} @endif</p></div></div>", content: "<div class='dropdown_content'><ul class='list-group list-group-flush'><li class='list-group-item'><i class='fa fa-user'></i><a href='/profile' class='FC'>My profile</a></li><li class='list-group-item'><a href='logout' class='FC'>Logout</a></li></ul></div>", html: true, placement: "bottom"});
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
@yield('js')
</html>
