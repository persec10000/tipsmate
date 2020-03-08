@extends('layouts.basic1', ['subMenu' => 'video'])

@section('link')


    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/header.css')}}">
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/howto.css')}}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">


    <meta name="twitter:card" content="player"/>
    <meta name="twitter:title" content="{{$video->title}}"/>
    <meta name="twitter:description" content="{{$video->description}}"/>
    <meta name="twitter:player" content="{{asset('upload/'.$video->video_url)}}"/>
    <meta name="twitter:image" content="{{asset('fireuikit/images/'.$video->image)}}"/>
    <meta name="twitter:player:width" content="300"/>
    <meta name="twitter:player:height" content="200"/>

@endsection


@section('content')
    <div class="content-border">
        <div class="content-detail">
            <h5>{!! $video->category !!}</h5>
        </div>
        <div class="content-title">
            <h2><b>{{$video->title}}</b></h2>
        </div>

        <div class="content-detail">
            <h4>{!! $video->name !!}</h4>
        </div>
        <div class="conent-media">
            <video class="detail-view" controls>
                <source src="{{asset('upload/'.$video->video_url)}}" type="video/mp4">
            </video>
        </div>
        <div class="content-detail">
            {!! $video->description!!}<br>
            {{--            <Span><br>{!! $video->views!!}</Span> <Span>views</Span>--}}
            {{--            <Span>&nbsp;&nbsp; <img src="{{asset('fireuikit/images/up.png')}}">--}}
            {{--                                {!! $video->like!!}</Span>--}}

            {{--            <Span>&nbsp;&nbsp;<img src="{{asset('fireuikit/images/down.png')}}">--}}
            {{--                                {!! $video->unlike!!}</Span>--}}
            {{--            <Span>&nbsp;&nbsp;comment:&nbsp;({!! $video->comment!!})</Span>--}}
        </div>
        <div class="content-share">
            <div class="col-md-6">
                <Span>{!! $video->views!!}</Span> <Span>views</Span>
                <Span class="up" id="{{$video->data_id}}">&nbsp;&nbsp; <img src="{{asset('fireuikit/images/up.png')}}">
                </Span>
                <Span id="like">{!! $video->like!!}</Span>

                <Span class="down"  id="{{$video->data_id}}">    <img src="{{asset('fireuikit/images/down.png')}}">
                </Span>
                <Span id="unlike">  {!! $video->unlike!!}</Span>
                <Span>&nbsp;&nbsp;comment:&nbsp;({!! $video->comment!!})</Span>
            </div>
            <div class="col-md-1">
                <a
                    href="https://twitter.com/share?url={{url()->current()}}"
                    class="twitter-share-button"
                    data-show-count="false">
                    Tweet
                </a>
            </div>
            <div class="fb-share-button col-md-1" data-href="https://developers.facebook.com/docs/plugins/"
                 data-layout="button_count" data-size="small">
                <a target="_blank"
                   href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                   class="fb-xfbml-parse-ignore">Share</a>
            </div>
        </div>
    </div>
    <script
        async src="https://platform.twitter.com/widgets.js"
        charset="utf-8">
    </script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0"></script>
    <form action="{{url('/video/comment')}}" method="post" enctype="multipart/form-data">
        @csrf
        <h3 style="margin-top:20px;">Add your comment</h3>
        <div class="form-group">
            <input type="hidden" name="article_id" id="article_id" value="{{$video->data_id}}">

            <textarea id="summernote" name="detail" class="form-control">
                </textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="send" id="send" class="btn btn-success">
            <input type="button" name="clear" id="clear" class="btn btn-danger pull-right" value="Clear">
        </div>
    </form>

    @foreach($comment as $row)
        <div class="comment">
            <div class="col-md-1 col-sm-1">
                <img id="userimg" src="{{asset('fireuikit/images/users/'.Auth::user()->image)}}"
                     style="width: 50px;height: 50px" class="rounded-circle">
            </div>
            <div class="col-md-11 col-sm-11  comment-content">
                <p>
                    <span>{!! $row->content !!}</span>
                    <span><br></span>
                    <span><b>{!! $row->name !!}</b></span>
                </p>

            </div>
        </div>
    @endforeach
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="{{asset('fireuikit/js/jquery.magnific-popup.js')}}"></script>
    <script src="{{asset('fireuikit/js/mediagallery.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(summernote).summernote({
                height: '300px',
                placeholder: "Write here...",
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                ],
                fontNames: ['Arial', 'Arial Black'],
            })

        });
        $(clear).on('click', function () {
            $(summernote).summernote('code', null);
        })

    </script>
    <script src="{{asset('fireuikit/js/video_content.js')}}"></script>
@endsection

