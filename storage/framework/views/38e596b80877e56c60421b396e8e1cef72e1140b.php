<?php $__env->startSection('content'); ?>

    <div class="container col-md-10 col-sm-10">
        <h1 class="admin">Welcome Tipsmate Administrator!!!</h1>
        <table class="table table-bordered data-table">
            <thead>
            <tr>
                <th>No</th>
                <th>Comment</th>
                <th>Answer</th>
                <th>User</th>
                <th width="280px">Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
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

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "<?php echo e(route('admin.comment.index')); ?>",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'comment', name: 'comment'},
                    {data: 'answer', name: 'answer'},
                    {data: 'user', name: 'user'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });


            $('body').on('click', '.deleteProduct', function () {

                var product_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "<?php echo e(route('admin.comment.store')); ?>"+'/'+product_id,
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


<?php echo $__env->make('admin.basic', ['activeMenu' => 'Comment/Answer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\laravel\tipsmate\tipsmate\resources\views/admin/comment.blade.php ENDPATH**/ ?>