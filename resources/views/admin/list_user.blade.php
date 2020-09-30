@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <a href="add_user" class="btn btn-primary" >Create new User</a>
            </div>
        </div>
        <div class="row d-flex justify-content-end">
            @if (session()->has('message'))
                <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <table id="mytable" class="mytable" style="width:100%">
                    <thead> 
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Sex</th>
                        <th>Birthday</th>
                        <th>Action</th>
                    </thead>
                </table>
            </div>

        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you want to delete this user?
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
        var callback = null;
        $(document).ready(function() {

            var table = $('#mytable').DataTable({
                "pageLength": 10,
                "pagingType": "simple_numbers",
                ajax: {
                    type: 'GET',
                    url: '/api/admin/list_user',
                    data: '_token = <?php echo csrf_token(); ?>',
                    dataSrc: 'data'
                },
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "sex"
                    },
                    {
                        "data": "birthday"
                    },
                    {
                      "defaultContent": "<button class=\"edit\">Edit</button> <button class=\"delete\">Delete</button>"
                    },


                ],
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 5
                }],
                "order": [
                    [1, 'asc']
                ]
            });

            $('#mytable tbody ').on('click', '.edit', function() {

                var data = table.row($(this).parents('tr')).data();
                window.location.href = "/admin/" + data['id'] + "/edit";
            });

            $('#mytable tbody ').on('click', '.delete', function() {
                var row = table.row($(this).parents('tr'));
                var data = row.data();
                $('#deleteModalLabel').html('Warning!')
                $('#deleteModal').modal('show');

                callback = function(result) {
                
                    if (result) {
                        $.ajax({
                            type: 'DELETE',
                            url: '/api/admin/' + data['id'],
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
             
                if($(this).hasClass("delete-accecpt"))callback(true);
                else callback(false);
            });
           
        });

    </script>
@endpush

