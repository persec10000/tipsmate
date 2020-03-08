<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TIPSMATE</title>

    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/font-awesome.min.css')}}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/header.css')}}">
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/register.css')}}">
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/login.css')}}">
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/footer.css')}}">
    <link rel="icon" href="{{asset('fireuikit/images/favicon.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <script data-ad-client="ca-pub-8982024490473272" async
            src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    @yield('link')
</head>

<body class="container" id="how_to">


<header>
    <div class="row hd">

        <div class="col-xl-3 col-lg-3 col-md-2">
            <div class="logo" style="width: 100%;height: 100%; display: flex; align-items: flex-end">
                <div class="logo_block" style="width: fit-content; height: fit-content; display: block">
                    <img src="{{asset("fireuikit/images/logo_img.png")}}">
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-8">
            <img src="{{asset("fireuikit/images/adverse.png")}}" style="width: 100%; ">
            <div class=" align-items-center" style="width: 100%; height: 30%">

                <ul class="nav topmenu" style="width: 100%">
                    <li class="nav-item">
                        <a class="hvr-rectangle-out" @if (Request::path()=='askme') style="background: #272727"
                           @endif href="{{url('askme')}}" id="askme">ASK&nbsp;ME</a>
                    </li>
                    <li class="nav-item">
                        <a class="hvr-rectangle-out" href="{{url('howto')}}" id="howto"
                           @if (Request::path()=='howto') style="background: #272727" @endif>HOW&nbsp;TO</a>
                    </li>
                    @if(!Auth::user())
                        <li class="nav-item">
                            <a class="hvr-rectangle-out" href="{{url('register')}}" id="register"
                               @if (Request::path()=='register') style="background: #000000" @endif>Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="hvr-rectangle-out" href="{{url('login')}}" id="login"
                               @if (Request::path()=='login') style="background: #000000" @endif>Login</a>
                        </li>
                    @else

                        <li class="nav-item">
                            <a class="hvr-rectangle-out" href="{{url('/profile')}}" id="register"
                               @if (Request::path()=='register') style="background: #000000" @endif>Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="hvr-rectangle-out" href="{{url('logout')}}" id="logout"
                               @if (Request::path()=='logout') style="background: #000000" @endif>Logout</a>
                        </li>

                    @endif

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
                              action="{{ $subMenu == 'article'? url('/howto/article/search') : url('/howto/video/search')}}"
                              method="get"
                              enctype="multipart/form-data">
                            <div class="input-group">
                                <input type="text" class="form-control" id="search" name="search"
                                       style="font-size: 20px">
                                <div class=" input-group-append">
                                </div>
                                <button id="search" href="#" class="hvr-rectangle-out ml-5"
                                        style="border: 1px solid; text-shadow: 1px 1px black; border-radius: 5px;">
                                    Search&nbsp;{{$subMenu}}
                                </button>
                                @if(Auth::user())
                                <a href="{{url('/howto/'.$subMenu.'/create')}}" class="hvr-rectangle-out "
                                   style="border: 1px solid; text-shadow: 1px 1px black; border-radius: 5px; margin-left: 20px;">Create&nbsp;{{$subMenu}}
                                </a>
                                @endif
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
                <a class="hvr-rectangle-out" href="{{url('/howto/article')}}"
                   style="{{$subMenu == 'article'? 'background:#000': '' }}">ARTICLES</a>
            </li>
            <li class="nav-item ">
                <a class="hvr-rectangle-out" href="{{url('/howto/video')}}"
                   style="{{$subMenu == 'article'? '': 'background:#000' }}">VIDEOS</a>
            </li>
        </ul>
    </div>
    {{--       @yield('search')--}}


    <div class="col-lg-1">

    </div>
</div>

<div class="row main_content">

    <div class="col-lg-3 col-md-4 col-sm-12">
        {{--      category section--}}
        <div id="cat-all" roll="navigation" class="row">
            <ul class="none FW-400 ml-3" id="categories">
                @foreach($categories as $row)
                    <li class="FC_list" id="{{$row->id}}">
                        <a href="{{url($subMenu.'_category/'.$row->id)}}" class="bottom"> {{$row->category}} </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-lg-7 col-md-8 content">
        @yield('content')
    </div>
    <div class="col-lg-2 ">
        <div class="google_ads" style="display: flex; justify-content: flex-end">
            <img src="{{asset("fireuikit/images/advertise3.png")}}">
        </div>

    </div>

</div>

@include('layouts.footer')

</body>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>--}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<script src="{{asset('fireuikit/js/jquery.rateyo.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

{{--<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>--}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="{{asset('fireuikit/js/summernote-bs4.js')}}"></script>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>--}}

<script type="text/javascript">
    $(document).ready(function () {

        $('#userimg').popover({
            title: "<div class='m_dropdown_header'>" +
                "<div class='user_pic'>@if(Auth::user())<img src='{{asset('fireuikit/images/user.png')}}'/></div><div class='details ml-2'><span class='username mb-2'> {{ucwords(Auth::user()->name)}}</span><br><p class='useremail'>{{ucwords(Auth::user()->email)}} @endif</p></div></div>",
            content: "<div class='dropdown_content'><ul class='list-group list-group-flush'><li class='list-group-item'><i class='fa fa-user'></i><a href='' class='FC'>My profile</a></li><li class='list-group-item'><a href='logout' class='FC'>Logout</a></li></ul></div>",
            html: true,
            placement: "bottom"
        });
    });

    $('#userimg').popover({
        title: "<div class='m_dropdown_header'><div class='user_pic'><img src='{{asset('fireuikit/images/user.png')}}'></div><div class='details'><span>@if(Auth::user()) {{ucwords(Auth::user()->name)}}</span><p>{{ucwords(Auth::user()->email)}} @endif</p></div></div>",
        content: "<div class='dropdown_content'><a href='logout'>Logout</a></div>",
        html: true,
        placement: "bottom"
    });


    $('#userimg').popover({
        title: "<div class='m_dropdown_header'>" +
            "<div class='user_pic'>@if(Auth::user())<img src='{{asset('fireuikit/images/user.png')}}'/></div><div class='details ml-2'><span class='username mb-2'> {{ucwords(Auth::user()->name)}}</span><br><p class='useremail'>{{ucwords(Auth::user()->email)}} @endif</p></div></div>",
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
@yield('js')
</html>
