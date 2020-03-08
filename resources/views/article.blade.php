@extends('layouts.basic1', ['subMenu' => 'article'])

@section('link')
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/header.css')}}">
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/howto.css')}}">
    {{--    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/theme.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/magnific-popup.css')}}">--}}

@endsection

@section('content')
    <ul class="nav">
        @foreach($article as $row1)
            <li class="VA-list" id="{{$row1->data_id}}">
                <a href="{{url('/article/'.$row1->data_id)}}">
                    <div class="card">
                        <div class="card-image" style="background: url('{{asset("upload/".$row1->post_image)}}') no-repeat center center; background-size: contain">
                            {{--                             <img class="carousel-inner" src="{{asset('upload/'.$row1->post_image)}}">--}}
                        </div>
                        <div class="card-title">
                            <h5 id="card-title">{!!$row1->title!!}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{!! $row1->category!!}</p>
                            <p class="card-text">{!! $row1->name!!}</p>
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
{{--    <script src="{{asset('fireuikit/js/article-content.js')}}"></script>--}}
@endsection

