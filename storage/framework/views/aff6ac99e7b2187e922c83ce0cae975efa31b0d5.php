<?php $__env->startSection('link'); ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    

    <div class="container col-md-10 col-sm-10">

        <h1 class="">Welcome Tipsmate Administrator!!!</h1>
        <a class="button--primary admin_logout" href="/logout">
            <img src="<?php echo e(asset("fireuikit/images/logoutButton.gif")); ?>" width="64" height="19" border="0" >
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
        <div class="modal-dialog">
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
                            <label for="name" class="col-sm-2 control-label">Content</label>
                            <div class="col-sm-12">
                                <textarea  name="page_content" id="content" required="" placeholder="Enter Details" class="form-control" ></textarea>
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
                            <label for="name" class="col-sm-2 control-label">Content</label>
                            <div class="col-sm-12">

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
    

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

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

                    ajax: "<?php echo e(route('admin.PageContent.index')); ?>",
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
                $.get("<?php echo e(route('admin.PageContent.index')); ?>" +'/' + id +'/edit', function (data) {
                    $('#modelHeading').html("Edit Page");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#page_id').val(data.id);
                    $('#title').val(data.page_title)
                    $('#meta').val(data.meta_tags);
                    $('#key').val(data.keywords);
                    $('#content').val(data.page_content);
                })
            });

            $('body').on('click', '.ViewProduct', function () {
                var id = $(this).data('id');
                console.log(id);
                $.get("<?php echo e(route('admin.PageContent.index')); ?>" +'/' + id +'/edit', function (data) {
                    $('#modelHeading').html("View Page");
                    $('#saveBtn').val("edit-user");
                    $('#viewModel').modal('show');
                    $('#page_id').val(data.id);
                    $('#title_view').val(data.page_title)
                    $('#meta_view').val(data.meta_tags);
                    $('#key_view').val(data.keywords);
                    $('#content_view').html(data.page_content);
                })
            });


            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "<?php echo e(route('admin.PageContent.store')); ?>",
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
                    url: "<?php echo e(route('admin.PageContent.store')); ?>"+'/'+product_id,
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


<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.basic', ['activeMenu' => 'Page content'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\laravel\tipsmate\tipsmate\resources\views/admin/pageContent.blade.php ENDPATH**/ ?>