@extends('admin.basic', ['activeMenu' => 'Page content'])
@section('link')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection
@section('content')
    {{--    <div class=" container">--}}

    <div class="container col-md-10 col-sm-10">

        <h1 class="">Welcome Tipsmate Administrator!!!</h1>
        <a class="button--primary admin_logout" href="/logout">
            <img src="{{asset("fireuikit/images/logoutButton.gif")}}" width="64" height="19" border="0" >
        </a>
        <a class="btn btn-success" href="javascript:void(0)" id="add_categories"> Add Page</a>
        <table class="table table-bordered" id="example" style="width:100%">
            <thead>
            <tr>
                <th>No</th>
                <th>Page Title</th>
                <th>meta_tag</th>
                <th>Keyword</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 750px !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal">
                        <input type="hidden" name="page_id" id="page_id">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Page title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="title" name="page_title" placeholder="Enter Name" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-sm-4 control-label">Meta tags</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="meta" name="meta_tags" placeholder="Enter Name" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Keywords</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="key" name="keywords" placeholder="Enter Name" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Page url</label>
                            <div class="col-sm-12">
                                <input  name="page_sc_name" id="page_sc_name" required="" placeholder="Enter Details" class="form-control"></input>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Content</label>
                            <div class="col-sm-12">
                                <textarea  name="page_content" id="content" required="" placeholder="Enter Details" class="form-control" style="height: 30vw"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="add">Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="viewModel" aria-hidden="true">
        <div class="modal-dialog" style="max-width:1200px">
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal">
                        <input type="hidden" name="page_id" id="page_id">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Page title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="title_view" name="page_title" placeholder="Enter Name" value="" maxlength="50" required="" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-sm-4 control-label">Meta tags</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="meta_view" name="meta_tags" placeholder="Enter Name" value="" maxlength="50" required="" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Keywords</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="key_view" name="keywords" placeholder="Enter Name" value="" maxlength="50" required="" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Page url</label>
                            <div class="col-sm-12">
                                <input  name="page_sc_name" id="page_sc_name_view" required="" placeholder="Enter Details" class="form-control" ></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Content</label>
                            <div class="col-sm-12">
{{--                                <textarea  name="page_content" id="content" required="" placeholder="Enter Details" class="form-control" ></textarea>--}}
                                <div id="content_view" ></div>
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="add">Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--    </div>--}}

@endsection

@section('js')

    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#example').DataTable(
                {
                    processing: true,
                    serverSide: true,

                    ajax: "{{ route('admin.PageContent.index') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'page_title', name: 'page_title'},
                        {data: 'meta_tags', name: 'meta_tags'},
                        {data: 'keywords', name: 'keywords'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                }
            );

            $('#add_categories').click(function () {
                $('#saveBtn').val("create-product");
                $('#page_id').val('');
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Add Page");
                $('#ajaxModel').modal('show');
            });

            $('body').on('click', '.editProduct', function () {
                var id = $(this).data('id');
               console.log(id);
                $.get("{{ route('admin.PageContent.index') }}" +'/' + id +'/edit', function (data) {
                    $('#modelHeading').html("Edit Page");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#page_id').val(data.id);
                    $('#title').val(data.page_title)
                    $('#meta').val(data.meta_tags);
                    $('#key').val(data.keywords);
                    $('#page_sc_name').val(data.page_sc_name);
                    $('#content').val(data.page_content);
                })
            });

            $('body').on('click', '.ViewProduct', function () {
                var id = $(this).data('id');
                console.log(id);
                $.get("{{ route('admin.PageContent.index') }}" +'/' + id +'/edit', function (data) {
                    $('#modelHeading').html("View Page");
                    $('#saveBtn').val("edit-user");
                    $('#viewModel').modal('show');
                    $('#page_id').val(data.id);
                    $('#title_view').val(data.page_title)
                    $('#meta_view').val(data.meta_tags);
                    $('#key_view').val(data.keywords);
                    $('#page_sc_name_view').val(data.data_sc_name);

                    $('#content_view').html(data.page_content);
                })
            });


            function hasWhiteSpace(s) {
                return s.indexOf(' ') >= 0;
            }

            $('#saveBtn').click(function (e) {
                var url = $('#page_sc_name').val();


                if(hasWhiteSpace(url)){
                   if(!window.confirm('Page url can not include space')){
                       return;

                   }
                }


                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ route('admin.PageContent.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#productForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.deleteProduct', function () {

                var product_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.PageContent.store') }}"+'/'+product_id,
                    success: function (data) {
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

        });
    </script>


@endsection

