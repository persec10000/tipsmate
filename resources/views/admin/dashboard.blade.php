@extends('admin.basic', ['activeMenu' => 'Categories'])
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
            <a class="btn btn-success" href="javascript:void(0)" id="add_categories"> Add Categories</a>
            <table class="table table-bordered" id="example" style="width:100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="ajaxModel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                    </div>
                    <div class="modal-body">
                        <form id="productForm" name="productForm" class="form-horizontal">
                            <input type="hidden" name="category_id" id="category_id">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="category" name="category" placeholder="Enter Name" value="" maxlength="50" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">priority</label>
                                <div class="col-sm-12">
                                    <textarea id="priority" name="priority" required="" placeholder="Enter Details" class="form-control"></textarea>
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

                    ajax: "{{ route('admin.category.index') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'category', name: 'category'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                    }
                );

                $('#add_categories').click(function () {
                    $('#saveBtn').val("create-product");
                    $('#category_id').val('');
                    $('#productForm').trigger("reset");
                    $('#modelHeading').html("Add Categories");
                    $('#ajaxModel').modal('show');
                });

                $('body').on('click', '.editProduct', function () {
                    var id = $(this).data('id');
                    $.get("{{ route('admin.category.index') }}" +'/' + id +'/edit', function (data) {
                        $('#modelHeading').html("Edit Product");
                        $('#saveBtn').val("edit-user");
                        $('#ajaxModel').modal('show');
                        $('#category_id').val(data.id);
                        $('#category').val(data.category);
                        })
                });

                $('#saveBtn').click(function (e) {
                    e.preventDefault();
                    $(this).html('Sending..');

                    $.ajax({
                        data: $('#productForm').serialize(),
                        url: "{{ route('admin.category.store') }}",
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
                        url: "{{ route('admin.category.store') }}"+'/'+product_id,
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

