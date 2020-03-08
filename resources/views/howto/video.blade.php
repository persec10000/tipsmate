@extends('layouts.basic1', ['subMenu' => 'video'])

@section('link')
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/header.css')}}">
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/howto.css')}}">
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/rightside.css')}}">

@endsection
@section('submenu')
    <ul class="nav sub-menu">
        <li class="sub-menu article inactive">
            <a class="nav-link inactive"  href="/howto/article" >ARTICLES</a>
        </li>
        <li class="sub-menu video active1" >
            <a class="nav-link active1" href="/howto/video" >VIDEOS</a>
        </li>
    </ul>
@endsection


@section('content')

    <ul class="nav">
        @foreach($video as $row)

            <li class="VA-list" id="{{$row->data_id}}">
                <a href="{{url('/howto/video/'.$row->data_id)}}">
                    <div class="card">
                        <video controls >
                            <source src="{{asset('upload/'.$row->video_url)}}" type="video/mp4">
                        </video>
                        <div class="card-body">
                            <h4 class="card-title">{!! $row->title !!}</h4>
                            <p class="card-author">
                                <span>&nbsp;&nbsp;{!! $row->name!!}<br></span>
                                <Span>&nbsp;&nbsp;{!! $row->views!!}</Span> <Span>views</Span><br>
                                <Span ><img src="{{asset('fireuikit/images/up.png')}}">
                                {!! $row->like!!}</Span>
                                <Span>&nbsp;&nbsp;<img src="{{asset('fireuikit/images/down.png')}}">
                                {!! $row->unlike!!}</Span>
                                <Span>&nbsp;&nbsp;comment:&nbsp;({!! $row->comment!!})</Span>
                            </p>
                        </div>
                    </div>
                </a>
            </li>

        @endforeach
    </ul>

@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="{{asset('fireuikit/js/jquery.magnific-popup.js')}}"></script>

    <script src="{{asset('fireuikit/js/mediagallery.js')}}"></script>
    <script src="{{asset('fireuikit/js/video-content.js')}}"></script>
@endsection
