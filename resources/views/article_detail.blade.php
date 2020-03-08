@extends('layouts.basic1', ['subMenu' => 'article'])

@section('link')

    {{--    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/theme.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/magnific-popup.css')}}">--}}


    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/header.css')}}">
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/howto.css')}}">
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/rightside.css')}}">

{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">




    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{$article->title}}" />
    <meta name="twitter:description" content="{{$article->content_html}}" />
    <meta name="twitter:image" content="{{asset('upload/'.$article->post_image)}}" />
@endsection
@section('submenu')
    <ul class="nav sub-menu">
        <li class="sub-menu article active1">
            <a class="nav-link active1"  href="/howto/article" >ARTICLES</a>
        </li>
        <li class="sub-menu video inactive" >
            <a class="nav-link inactive" href="/howto/video" >VIDEOS</a>
        </li>
    </ul>
@endsection

@section('search')
    <div class=" search_how">
        <form id="frm" name="frm" action="{{url('/howto/article/search')}}" method="get" enctype="multipart/form-data">
            <div class="input-group">
                <input type="text" class="form-control ml-6 " id="search" name="search">
                <input type="submit" class="btn-search " value="            " >
            </div>
        </form>
    </div>
@endsection
@section('create')
    <div class="wrapper_create">
        @if(Auth::user())
            <div><a href="/howto/article/create"  class="btn btn-create" >Create</a></div>
        @endif
    </div>
@endsection

@section('categories')
    <div id="cat-all" roll="navigation" class="row">
        <ul class="none FW-400 MY-0 ml-3" id="categories">
            @foreach($categories as $row)
                    <li class="FC_list" id="{{$row->id}}">
                        <a href="/article_category/{{$row->id}}" id="bottom"> {{$row->category}} </a>
                    </li>
            @endforeach
        </ul>
    </div>
@endsection

@section('content')
    <div class="content-border">

        <div class="content-title">
            <h2><b>{{$article->title}}</b></h2>
        </div>

        <div class="content-detail">
            <h4>category:{!! $article->category !!}</h4>
        </div>


        <div class="content-detail">
            <h3>{!! $article->name !!}</h3>
        </div>
        <div class="conent-media">
            <img class="detail-container" src="{{asset('upload/'.$article->post_image)}}">
        </div>
        <div class="content-detail">
            <h3>description</h3>
            {!! $article->content_html !!}
        </div>
        <div class="content-share">
            <a
                href="https://twitter.com/share?url={{url()->current()}}"
                class="twitter-share-button"
                data-show-count="false">
                Tweet
            </a>
        </div>


            <script
                async src="https://platform.twitter.com/widgets.js"
                charset="utf-8">
            </script>


        <form action="{{url('/article/comment')}}" method="post" enctype="multipart/form-data">
            @csrf
            <h3 style="margin-top:20px;">Add your comment</h3>
            <div class="form-group">
                <input type="hidden" name="article_id" id="article_id" value="{{$article->data_id}}">

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
                    <img src="{{asset("fireuikit/images/user1.png")}}">
                </div>
                <div class="col-md-11 col-sm-11 ">
                    <p>{!! $row->content !!}</p>
                    <p>{!! $row->name !!}</p>
                </div>
            </div>
        @endforeach
    </div>



@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="{{asset('fireuikit/js/jquery.magnific-popup.js')}}"></script>
    <script src="{{asset('fireuikit/js/mediagallery.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(summernote).summernote({

                placeholder: "Input content here...",
                fontNames: ['Arial', 'Arial Black'],
            })
        });
        $(clear).on('click',function () {
            $(summernote).summernote('code',null);
        })

    </script>
@endsection

