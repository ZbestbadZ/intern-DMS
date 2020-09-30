@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <!--Bread Crumbs-->
            </div>
        </div>

        <div class="row d-flex justify-content-end">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="col-4 text-decoration-none  float-right">
                <a href="{{ url('/sticker/create') }}">Add a new sticker</a>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <table id="display" class="display" style="width:100%">
                    <thead>
                        <th>id</th>

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
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" data-dismiss="modal" class="delete-accecpt btn btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        var deleteCallback = null;
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
                        "data": "name",
                        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a href='#'>" + oData
                                .name + "</a>");
                        }
                    },
                    {
                        "data": "price"
                    },
                    {
                        "defaultContent": "<button class=\"edit\">Edit</button> <button class=\"delete\">Delete</button>"
                    },


                ],
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 3,

                }],
                "order": [
                    [1, 'asc']
                ]
            });

            $('#display tbody ').on('click', '.edit', function() {

                var data = table.row($(this).parents('tr')).data();
                window.location.href = "/sticker/" + data['id'] + "/edit";
            });

            $('#display tbody ').on('click', '.delete', function() {
                var row = table.row($(this).parents('tr'));
                var data = row.data();
                $('#deleteModalLabel').html('a')
                $('#deleteModal').modal('show');

                deleteCallback = function(result) {

                    if (result) {
                        $.ajax({
                            type: 'DELETE',
                            url: '/api/sticker/' + data['id'],
                            data: '_token = <?php echo csrf_token(); ?>',
                            success: function(data) {
                                var re = row
                                    .remove().draw(true);
                                table.ajax.reload();

                            }
                        });
                    }
                };


            });
            $('#deleteModal').on('click', '.btn', function() {

                if ($(this).hasClass("delete-accecpt")) deleteCallback(true);
                else deleteCallback(false);
            });

        });

    </script>
@endpush
