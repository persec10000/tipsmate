@extends('layouts.layout', ['singlePage' => 'false'])

@section('link')
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/qa.css')}}">
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/rightside.css')}}">
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/jquery.rateyo.min.css')}}"/>
@endsection
@section('leftside')

    <div id="cat-all" roll="navigation" class="row" style="margin-left: 0;">
        <ul class="none FW-400 ml-3" id="categories">
            @foreach($categories as $row)
                <li class="FC_list" data-product-id="cat{{$row->id}}" id="{{$row->id}}">
                    <a href="#" class="bottom"> {{$row->category}} </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

@section('content')
    <div class="col-xl-7 col-lg-6 col-md-9 col-sm-12">
        <div id='loader' style='display: none;'>
            <img src='{{asset('fireuikit/images/ajax-loader.gif')}}' width='50px' height='50px'>
        </div>
        <div class="row">
            {{csrf_field()}}
            <p id="post_id" hidden>{{$post_id}}</p>
            <div id="cat_id" hidden>{{$cat_id}}</div>
            <p id="search_text" hidden>{{$search_text}}</p>
            <ul id="fq" style="width: 100%">
            </ul>
        </div>
    </div>
@endsection

@section('rightside')

    <div class="col-xl-2 col-lg-3 col-md-2 col-sm-2" >
        @if(Auth::user())
            <div class="ml-3">
                <p id="askbar-holder">

                <form id="ask_frm" method="post" action="{{route('addquestion')}}" enctype="multipart/form-data">
                    @csrf
                    <div
                        class="Bgc-t Bgr-n Va-m Fl-start shared-sprite ask-star-icon D-ib Mend-5 Wpx-25 Hpx-25 Fl-start"
                        id="ask_sprite">
                        <img src="{{asset('fireuikit/images/combo.png')}}">
                    </div>
                    <h2 class="D-ib Fz-18 Fw-300 Mt-neg-1">Ask a Question</h2>
                    <div class="Fw-300">
                        usually answered within minutes!
                    </div>
                    <div class="form-group mb-5">

                        <select class="mt-3 mb-3 form-control" id="sltitle" name="category">
                            <option selected>Select</option>
                            @foreach($categories as $row)
                                @if($row->id != 1)
                                    <option value="{{$row->id}}">{{$row->category}}</option>
                                @endif
                            @endforeach
                        </select>

                        <textarea class="form-control mb-3" name="title" placeholder="What's up" id="rtext"></textarea>
                        <div class="form-group">
                            <textarea id="summernote1" name="comment" class="form-control"></textarea>
                        </div>
                        <footer>
                            <ul>
                                <li>

                                    <input type="button" id="clear" class="btn btn_default" name="clear" value="Reset">
                                <li>
                                    <button id="send" type="submit" class="btn btn-primary">Send</button>
                                </li>
                            </ul>
                        </footer>
                    </div>
                </form>
            </div>
            <div class="google">
                <img src="{{asset('fireuikit/images/google_ads.png')}}" style="width: 100%">
            </div>
            <div class="mt-3">
                <h4 style="font-weight: bold">Recent Posts......</h4>
                <p>{{$questions[0]->title}}</p>
                <p>{{$questions[1]->title}}</p>
                <p>{{$questions[2]->title}}</p>
                <p>{{$questions[3]->title}}</p>
                <p>{{$questions[4]->title}}</p>
            </div>
        @endif
        <div  style="width: 100%; display: flex; justify-content: flex-end">
            <div style="width: fit-content">
            <img src="{{asset('fireuikit/images/advertise3.png')}}">
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="{{asset('fireuikit/js/ask-content.js')}}"></script>
@endsection
