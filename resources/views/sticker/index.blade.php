@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row d-flex justify-content-center ">
            <div><span class="display-4" >Stickers</span></div>
        </div>

        <div class="row d-flex justify-content-end">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif

        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <div class=" text-right text-decoration-none  float-right">
                    <a href="{{ url('/sticker/create') }}">Add a new sticker</a>
                </div><br>
                <table id="display" class="table table-bordered table-striped table-light" style="width:100%">
                    <thead class="thead-dark">
                        <th>id</th>
                        <th>name</th>
                        <th>price</th>
                        <th>option</th>
                    </thead>

                    <tfoot>
                        <tr>
                            <th></th>
                            <th><input type="text" placeholder="Search name" /></th>
                            <th><input type="number" placeholder="Search price" /></th>
                            <th></th>
                        </tr>
                    </tfoot>


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
                <div id="deleteBody" class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" data-dismiss="modal" class="delete-accecpt btn btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="messageBody" class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>

                </div>
            </div>
        </div>
    </div>
    <!-- hidden -->
    <input class="" type="hidden" name="api_token" value="{{ Auth::user()->api_token }}">
@endsection
@push('scripts')
    <script>
        var deleteCallback = null;
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    '_token': '<?php echo csrf_token(); ?>',
                }
            });
            var table = $('#display').DataTable({
                initComplete: function() {
                    this.api().columns().every(function() {
                        var that = this;

                        $('input', this.footer()).on('keyup change clear', function() {
                            if (that.search() !== this.value) {

                                that
                                    .search(this.value)
                                    .draw();
                            }
                        });

                    });
                },
                dom: 'rtip',
                "pageLength": 10,
                "serverSide": true,
                "processing": true,
                "bLengthChange": false,
                "pagingType": "simple_numbers",
                ajax: {
                    type: 'GET',
                    url: '/api/sticker',
                    data: {
                        "api_token": $('[name="api_token"]').val(),
                    },
                    dataSrc: 'data',
                },
                "columns": [{
                        "data": "id"
                    },

                    {
                        "data": "name",

                    },
                    {
                        "data": "price"
                    },
                    {
                        "defaultContent": "<button class=\"btn btn-primary edit\">Edit</button> <button class=\"btn btn-danger delete\">Delete</button>"
                    },


                ],
                "columnDefs": [{
                    "orderable": false,
                    "targets": 3,

                }, {
                    "searchable": false,
                    "targets": [0, 3],
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
                let itemName = data['name'];
                $('#deleteModalLabel').html('Warning!');
                $('#deleteBody').html('Item ' + data['name'] + ' will be permanently delete');
                $('#deleteModal').modal('show');

                deleteCallback = function(result) {

                    if (result) {
                        $.ajax({
                            type: 'DELETE',
                            url: '/api/sticker/' + data['id'],
                            data: {
                                "api_token": $('[name="api_token"]').val(),
                            },
                            success: function(data) {
                                var re = row
                                    .remove().draw(true);

                                $('#messageModalLabel').html('Success');
                                $('#messageBody').html('Deleted ' + data['item'][
                                    'name'
                                ]);
                                $('#messageModal').modal('show');
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                $('#messageModalLabel').html('ERORR');
                                $('#messageBody').html(
                                    'somthing went wrong can\'t  delete ' + itemName
                                );
                                $('#messageModal').modal('show');
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
