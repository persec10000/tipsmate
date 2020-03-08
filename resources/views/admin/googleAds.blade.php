@extends('admin.basic', ['activeMenu' => 'Google Ads'])
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

        <h1 class="">Welcome Tipsmate Administrator!</h1>

        <a class="button--primary admin_logout" href="/logout">

            <img src="{{asset("fireuikit/images/logoutButton.gif")}}" width="64" height="19" border="0">

        </a>

        <a class="btn btn-success" href="javascript:void(0)" id="add_categories"> Add Advertise </a>

       <table class="table table-bordered" id="example" style="width:100%">
            <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Type</th>
                <th>Advertise</th>
                <th>Status</th>
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
                    <h4 class="modal-title" id="modelHeading"> Edit Advertise </h4>
                </div>
                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal">
                        <input type="hidden" name="ads_id" id="page_id">
                        <div class="form-group">
                            <label class="col-sm-4 control-label"> Advertise Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="title" name="ads_name" placeholder="Enter Name" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-sm-4 control-label">Advertise Type</label>
                            <div class="col-sm-12">
                                <input type="radio" name="ads_type" id="ads_type" value="Banner" class="required"><label>Advertise Image</label>
                                <input type="radio" name="ads_type" id="ads_type1" value="Google" class="required"><label>Advertise Google Codes</label>
                            </div>
                        </div>

                        <div class="visible " id="frm_advertise_img">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Advertise Image</label>
                                <div class="col-sm-12">
                                <input type="file" name="ads_banner" id="ads_banner" class= " form-control form-control-file ">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-5 control-label">Advertise Image url</label>
                                <div class="col-sm-12">
                                <input type="text" name="ads_banner_url" id="ads_banner_url" class=" required valid form-control" value="http://gopiko8.cfl814.hop.clickbank.net/">
                                </div>
                            </div>
                        </div>




                        <div class="hidden form-group " id="frm_google_code">
                            <LABEL class="col-sm-4 control-label">Google codes</LABEL>
                            <div class="col-sm-12">
                            <textarea name="ads_google" id="ads_google"  class=" required form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-4 control-label">Advertise Status</label>
                            <div class="col-sm-12">
                                <input type="radio" name="status"  value="Active" id="status_active" class="required"><label>Active</label>
                                <input type="radio" name="status"  value="Inactive" id="status_inactive" class="required"><label>Inactive</label>
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
                    ajax: "{{ route('admin.googleAds.index') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'ads_name', name: 'ads_name'},
                        {data: 'ads_type', name: 'ads_type'},
                        {data: 'advertise', name: 'advertise'},
                        {data: 'ads_status', name: 'ads_status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                }
            );

            $('#add_categories').click(function () {
                $('#saveBtn').val("create-product");
                $('#page_id').val('');
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Add Advertise");
                $('#ajaxModel').modal('show');
            });

            $('body').on('click', '.editProduct', function () {
                var id = $(this).data('id');

                $.get("{{ route('admin.googleAds.index') }}" +'/' + id +'/edit', function (data) {

                    $('#modelHeading').html("Edit Page");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#page_id').val(data.id);
                    $('#title').val(data.ads_name)
                    $('#ads_banner').val(data.ads_banner);
                    $('#ads_banner_url').val(data.ads_banner_url);
                    $('#ads_google').val(data.ads_google);
                    console.log(data.ads_type);
                    if(data.ads_type == "Banner"){
                        document.getElementById('ads_type').checked = true;
                    }
                    else{
                        document.getElementById('ads_type1').checked = true;
                    }

                    if(data.status == "Active"){
                        document.getElementById('status_active').checked = true;
                    }
                    else{
                        document.getElementById('status_inactive').checked = true;
                    }

                })
            });

            $('#ads_type').on('click', function () {
                console.log($(this).val());
                $('#frm_advertise_img').removeClass('hidden');
                $('#frm_advertise_img').addClass('visible');
                $('#frm_google_code').removeClass('visible');
                $('#frm_google_code').addClass('hidden');

            })
            $('#ads_type1').on('click', function () {
                console.log($(this).val());
                $('#frm_advertise_img').removeClass('visible');
                $('#frm_advertise_img').addClass('hidden');
                $('#frm_google_code').removeClass('hidden');
                $('#frm_google_code').addClass('visible');

            })



            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');
                $send_data = $('#productForm').serialize();
                console.log($send_data);

                $.ajax({
                    data: $send_data,
                    url: "{{ route('admin.googleAds.store') }}",
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
                    url: "{{ route('admin.googleAds.store') }}"+'/'+product_id,
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

