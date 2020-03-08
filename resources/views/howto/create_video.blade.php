@extends('layouts.basic1', ['subMenu' => 'video'])
@section('link')
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/header.css')}}">
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/howto.css')}}">
    {{--    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/theme.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/magnific-popup.css')}}">--}}

{{--    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">

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
        <form id="frm" name="frm" action="{{url('/howto/video/search')}}" method="get" enctype="multipart/form-data">
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
            <div><a href="/howto/video/create"  class="btn btn-create" >Create</a></div>
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
    <div class="container1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>New Article</h4>
            </div>
            <div class="panel-body">
                <form action="{{url('howto/video/insert')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <label for="title">Main video</label>
                    <input type="file" name="addvideo" accept="video/mp4"/>
                    <label for="title">Category</label>
                    <select class="mt-3 mb-3 form-control" id="sltitle" name="category">
                        <option selected>Select</option>
                        @foreach($categories as $row)
                            @if($row->id > 1)
                                <option value="{{$row->id}}">{{$row->category}}</option>
                            @endif
                        @endforeach
                    </select>
                    <div class="form-group">
                        <textarea id="summernote" name="detail" class="form-control">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="send" id="send" class="btn btn-success">
                        <input type="button" name="clear" id="clear" class="btn btn-danger pull-right" value="Clear">
                    </div>


                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript">
    $(document).ready(function() {
        $(summernote).summernote({
            height: '300px',
            placeholder: "Input content here...",
            fontNames: ['Arial', 'Arial Black'],
        })
    });
    $(clear).on('click',function () {
            $(summernote).summernote('code',null);
    })

    </script>
@endsection
