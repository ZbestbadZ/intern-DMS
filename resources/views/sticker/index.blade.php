@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <!--Bread Crumbs-->
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <table id="display" class="display" style="width:100%">
                    <thead>
                        <th>id</th>
                        <th>path</th>
                        <th>name</th>
                        <th>price</th>
                        <!-- <th>size</th> -->
                        <th>option</th>
                    </thead>



                </table>
            </div>

        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            var table = $('#display').DataTable({
                "pageLength": 10,
                "pagingType": "simple_numbers",
                ajax: {
                    type: 'GET',
                    url: '/api/sticker/index',
                    data: '_token = <?php echo csrf_token(); ?>',
                    dataSrc: 'data'
                },
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "image_path"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "item_price"
                    },
                    {
                        "defaultContent": "<button class=\"edit\">Edit</button> <button class=\"delete\">Delete</button>"
                    },


                ],
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 4,

                }],
                "order": [
                    [1, 'asc']
                ]
            });

            $('#display tbody ').on('click', '.edit', function() {

                var data = table.row($(this).parents('tr')).data();
                window.location.href = "/sticker/" + data['id'];
            });
            $('#display tbody ').on('click', '.delete', function() {

                var data = table.row($(this).parents('tr')).data();
                $('#myModalLabel').html('a')
                $('#myModal').modal('show');
                // $.ajax({
                //     type: 'DELETE',
                //     url: '/api/sticker/' + data['id'],
                //     data: '_token = <?php echo csrf_token(); ?>',
                //     success: function(data) {
                //         // var re = table.row($(this).parents('tr')).remove().draw(true);
                //         // table.ajax.reload();

                //     }
                // });
            });

        });

    </script>
@endpush
