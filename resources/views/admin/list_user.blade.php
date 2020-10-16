@extends('layouts.app')

@section('content')
    <!-- hidden -->
    <input class="" type="hidden" name="api_token" value="{{ Auth::user()->api_token }}">

    <div class="container-fluid">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <span class="display-4">List Users</span>
            </div>
        </div>
        <div class="row">
            <div class="col-2" style="margin: 10px 0px 10px 0px">
                <a href="add_user" class="btn btn-primary">Create new User</a>
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
            <div class="col-10">
                <table id="mytable" class="table table-hover table-bordered table-striped display" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Job</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
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
                    Do you want to delete this user?
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
                <div id="messageBody" class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div id="detailBody" class="modal-body">                   
                </div>

                <div class="modal-footer">

                    <button type="button" data-dismiss="modal" class="btn btn-primary">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <script>
        var callback = null;
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                }
            });

            var table = $('#mytable').DataTable({
                "pageLength": 10,
                "pagingType": "simple_numbers",
                ajax: {
                    type: 'GET',
                    url: '/api/admin/list_user',
                    data: {
                        "api_token": $('[name="api_token"]').val(),
                    },
                    dataSrc: 'data'
                },
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "name",
                        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a id=\"detail\" href='#'>" +
                                oData.name + "</a>");
                        }
                    },
                    {
                        "data": "birthday",
                        "mRender": function(data, type, row) {
                            let birthYear = new Date(data).getFullYear();
                            age = new Date().getFullYear() - birthYear;
                            return age;
                        }
                    },
                    {
                        "data": "sex",
                        "mRender": function(data, type, row) {
                            if (data == 1) return "Male";
                            else return "Female";

                        }
                    },
                    {
                        "data": 'job_parsed',
                                  
                    },
                    {
                        "data": "phone"
                    },
                    {
                        "defaultContent": "<button class=\"btn btn-primary edit\">Edit</button> <button class=\"btn btn-danger delete\">Delete</button>"
                    },

                ],
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 6
                }],
                "order": [
                    [1, 'asc']
                ]
            });

            $('#mytable tbody ').on('click', '#detail', function() {
                var data = table.row($(this).parents('tr')).data();
                $.ajax({
                    type: 'GET',
                    url: '/api/admin/' + data['id'],
                    dataType: 'json',
                    data: {
                        "api_token": $('[name="api_token"]').val(),
                    },
                    success: function(data) {                       
                        let user = data['user'];
                        let hobby = data['hobby'];
                        $('#detailBody').html(data.html);                                             
                        $('#detailModal').modal('show');
                    }
                });

            });

            $('#mytable tbody ').on('click', '.edit', function() {

                var data = table.row($(this).parents('tr')).data();
                window.location.href = "/admin/edit_user/" + data['id']  + '?index=admin.list_user';
            });

            $('#mytable tbody ').on('click', '.delete', function() {
                var row = table.row($(this).parents('tr'));
                var data = row.data();
                $('#deleteModalLabel').html('Warning!');
                $('#deleteModal').modal('show');

                callback = function(result) {

                    if (result) {
                        $.ajax({
                            type: 'DELETE',
                            url: '/api/admin/' + data['id'],
                            data: {
                                "api_token": $('[name="api_token"]').val(),
                            },
                            success: function(data) {
                                var re = row
                                    .remove().draw(true);

                                $('#messageModalLabel').html('Success');
                                $('#messageBody').html('User ' + '<i>' + data['user']['name'] + '</i>' + ' is deleted successfully!');
                                $('#messageModal').modal('show');
                            }
                        });
                    }
                };

            });
            $('#deleteModal').on('click', '.btn', function() {

                if ($(this).hasClass("delete-accecpt")) 
                    callback(true);
                else 
                    callback(false);
            });

            setTimeout(function() {
                $("div.alert").remove();
            }, 2000);

        });

    </script>
@endpush
