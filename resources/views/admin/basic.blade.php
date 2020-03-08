<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TIPSMATE</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/admin.css')}}">
    <script src="{{asset('dashboard/js/font_awesome.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">

{{--    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">--}}

</head>

<body >

    <div class="wrapper">
    <div class="menu-container " roll="navigation" >
        <ul class="menu">
           @foreach($menus as $row)

                @if($row->type == 'class')
                    <li class="menu-link  mb-1">
                        <a href="{{route($row->link)}}" class="menu-icon " >
                            <div class="menu-context
                            @if($activeMenu === $row->context)
                                activeMenu
                            @endif
                            ">
                                <div class=" icon mb-1">
                                    <i class="{{$row->icon}} custom"></i><br>
                                </div>
                                <div class=" text mb-1">
                                    {{$row->context}}
                                </div>
                            </div>
                        </a>
                    </li>
                @else
                    <li class="menu-link  mb-1">
                        <a href="{{$row->link}}" class="menu-icon" >
                            <div class="menu-context
                                @if($activeMenu === $row->context)
                                activeMenu
@endif
                                ">
                                <div class=" icon mb-1">
                                    <i class="{{$row->icon}} custom"></i><br>
                                </div>
                                <div class=" text mb-1">
                                    {{$row->context}}
                                </div>
                            </div>
                        </a>
                    </li>
                @endif
            @endforeach

        </ul>
    </div>

      <div class=" container-fluid" style="background-color:darkseagreen" >
        @yield('content')
      </div>
    </div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@yield('js')
<script>
    $(document).ready(function(){
        $('#userimg').popover({title: "<div class='m_dropdown_header'>" +
                "<div class='user_pic'>@if(Auth::user())<img src='{{asset('fireuikit/images/user.png')}}'/></div><div class='details ml-2'><span class='username mb-2'> {{ucwords(Auth::user()->name)}}</span><br><p class='useremail'>{{ucwords(Auth::user()->email)}} @endif</p></div></div>", content: "<div class='dropdown_content'><ul class='list-group list-group-flush'><li class='list-group-item'><i class='fa fa-user'></i><a href='' class='FC'>My profile</a></li><li class='list-group-item'><a href='logout' class='FC'>Logout</a></li></ul></div>", html: true, placement: "bottom"});
    });

</script>

</html>
