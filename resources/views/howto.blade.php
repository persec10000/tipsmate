@extends('layouts.basic1', ['subMenu' => 'article'])

@section('link')
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/howto.css')}}">
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/rightside.css')}}">
@endsection

@section('content')

    <ul class="nav">
        @foreach($article as $row1)
            <li class="VA-list" id="{{$row1->data_id}}">
                <a href="{{url('/article/'.$row1->data_id)}}">
                    <div class="card">
                        <div class="card-image" style="background: url('{{asset("upload/".$row1->post_image)}}') no-repeat center center; background-size: contain">
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
                                    <Span>&nbsp;&nbsp; <img src="{{asset('fireuikit/images/up.png')}}">
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
    <script src="{{asset('fireuikit/js/ask-content.js')}}"></script>
    <script src="{{asset('fireuikit/js/mediagallery.js')}}"></script>
@endsection
