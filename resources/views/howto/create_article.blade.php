@extends('layouts.basic1', ['subMenu' => 'article'])
@section('link')

    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/header.css')}}">
    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/howto.css')}}">
    {{--    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/theme.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('fireuikit/css/assets/magnific-popup.css')}}">--}}

{{--    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">--}}
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>New Article</h4>
            </div>
            <div class="panel-body">
                <form action="{{url('/article/insert')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <div class="form-group">
                    <label for="title">Main image</label>
                    <input type="file" name="addimage" accept="image/*"/>
                    </div>
                    <div class="form-group">
                    <label for="title">Category</label>
                    <select class="mt-3 mb-3 form-control" id="sltitle" name="category">
                        <option selected>Select</option>
                        @foreach($categories as $row)
                            @if($row->id > 1)
                                 <option value="{{$row->id}}">{{$row->category}}</option>
                            @endif
                        @endforeach
                    </select>
                    </div>
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
        $('#summernote').summernote({
            height: '300px',
            maximumImageFileSize: 51200000,
            placeholder: "Input content here...",
            fontNames: ['Arial', 'Arial Black'],
            callbacks: {
                onImageUpload: function(files, editor, welEditable) {
                    sendFile(files[0], editor, welEditable);
                }
            }
        });


        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("_token","{{csrf_token()}}");
            data.append("id", "");
            data.append("file", file);
            console.log(file);
            $.ajax({
                data: data,
                type: "POST",
                url: "{{ route('image_upload')}}",
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    $('#summernote').summernote('insertImage', location.origin+'/'+url,  function ($image) {
                        $image.css('width', "100%");
                        $image.attr('data-filename', 'retriever');
                    });
                }
            });
        }
    });
    $(clear).on('click',function () {
            $(summernote).summernote('code',null);
    })

    </script>
@endsection
