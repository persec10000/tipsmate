@extends('layouts.layout', ['singlePage' => 'ture'])

@section('link')
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/qa.css')}}">
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/rightside.css')}}">
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/jquery.rateyo.min.css')}}"/>
@endsection


@section('content')
    <div class="col-xl-7 col-lg-6 col-md-9 col-sm-12" style="padding:20px;">
       {!! $pageContent->page_content !!}
    </div>
@endsection


@section('js')
    {{--    <script src="{{asset('fireuikit/js/ask-content.js')}}"></script>--}}
@endsection
