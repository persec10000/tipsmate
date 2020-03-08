<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TIPSMATE</title>

    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/font-awesome.min.css')}}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/header.css')}}">

    <link rel="icon" href="{{asset('fireuikit/images/favicon.png')}}">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    @yield('link')
</head>

<body class="container-fluid">
    <header>
        <div class="row ml-3 hd">
            <div class="col-md-2">
                <div class="logo">
                    <img src="{{asset("fireuikit/images/Logo.png")}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mt-2">
                    <img src="{{asset("fireuikit/images/Picture1.png")}}">
                </div>
                <div>
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="askme" id="askme">ASK ME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="howto" id="howto">HOW TO</a>
                        </li>
                        @if(!Auth::user())

                            <li class="nav-item">
                                <a class="nav-link" href="register" id="register">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login" id="login">Login</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <div  style="position: absolute;bottom:10px; left:16%">
                    @if(Auth::user())
                        <img id="userimg" src="{{asset('fireuikit/images/profile1.png')}}" >
                        <a>{{ucwords(Auth::user()->name)}}</a>

                    @endif
                </div>
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



</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('#userimg').popover({title: "<div class='m_dropdown_header'>" +
                "<div class='user_pic'>@if(Auth::user())<img src='{{asset('fireuikit/images/user.png')}}'/></div><div class='details ml-2'><span class='username mb-2'> {{ucwords(Auth::user()->name)}}</span><br><p class='useremail'>{{ucwords(Auth::user()->email)}} @endif</p></div></div>", content: "<div class='dropdown_content'><ul class='list-group list-group-flush'><li class='list-group-item'><i class='fa fa-user'></i><a href='' class='FC'>My profile</a></li><li class='list-group-item'><a href='logout' class='FC'>Logout</a></li></ul></div>", html: true, placement: "bottom"});
     });

</script>
@yield('js')
</html>
