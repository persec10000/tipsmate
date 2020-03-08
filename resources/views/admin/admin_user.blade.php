@extends('admin.basic', ['activeMenu' => 'Users'])

@section('content')

    <div class="container">
        <h1 class="admin">Welcome Tipsmate Administrator!!!</h1>
        <table class="table table-bordered data-table">
            <thead>
            <tr>
                <th>No</th>
                <th>Aavatar</th>
                <th>Name</th>
                <th>Email</th>
                <th>Ask/Answer</th>
                <th>Video/Article</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>


@endsection

@section('js')
    <script type="text/javascript">
        $(function () {
            console.log("start");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.user.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'avatar', name: 'avatar'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'ask', name: 'ask'},
                    {data: 'post', name: 'post'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $('body').on('click', '.img_ask1', function () {
                var id = $(this).data("id");
                console.log(id);
                var send_data = 'id='+id+'&ask=1' ;
                console.log(send_data);
                ajaxsend(send_data);
            });
            $('body').on('click', '.img_ask', function () {
                var id = $(this).data("id");
                console.log(id);
                var send_data = 'id='+id+'&ask=0' ;
                console.log(send_data);
                ajaxsend(send_data);
            });
            $('body').on('click', '.img_post', function () {
                var id = $(this).data("id");
                console.log(id);
                var send_data = 'id='+id+'&post=0' ;
                console.log(send_data);
                ajaxsend(send_data);
            });

            $('body').on('click', '.img_post1', function () {
                var id = $(this).data("id");
                console.log(id);
                var send_data = 'id='+id+'&post=1' ;
                console.log(send_data);
                ajaxsend(send_data);
            });

            function ajaxsend(send_data){
                $.ajax({
                    data: send_data,
                    url: "{{ route('admin.user.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {

                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            }

            $('body').on('click', '.deleteProduct', function () {

                var product_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.user.store') }}"+'/'+product_id,
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

