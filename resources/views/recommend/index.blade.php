@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <span class="display-4">Recommend User</span>
            </div>
        </div>
        <div class="row d-flex justify-content-start">
            <div class="col">
                <div class="float-left pb-4">
                    <label for="genderFilter"><b>Gender:</b></label>
                    <select class="form-control " name="genderFilter" id="genderFilter">
                        <option value="">All</option>
                        <option value="1">Male</option>
                        <option value="0">Female</option>
                    </select>
                </div>
                <table id="display" class=" table table-bordered table-striped table-light">
                    <thead class="thead-dark">
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>age</th>
                            <th>phone</th>
                            <th>job</th>
                            <th>email</th>
                            <th>gender</th>
                            <th>birthday</th>
                            <th>options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th><input class="form-control" type="text" placeholder="Search name"></th>
                            <th><input class="form-control" type="text" placeholder="Search age"></th>
                            <th><input class="form-control" type="text" placeholder="Search phone"></th>
                            <th><select class="form-control" name="jobSearch" id="">
                                    <option value="-1">All</option>
                                </select></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->

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
    <!-- hidden -->
    <input class="" type="hidden" name="api_token" value="{{ Auth::user()->api_token }}">
@endsection

@push('scripts')
    <script>
        var deleteCallback = null;

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                },
            });

            $('select[name="genderFilter"]').change(function() {
                table.columns([6]).search($(this).val()).draw();
            });




            //datatable
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
                "pageLength": 10,
                "serverSide": true,
                "processing": true,
                "pagingType": "simple_numbers",
                searchPanes: {
                    layout: 'columns-1',

                },
                "searching": true,
                dom: 'rtip',

                ajax: {
                    type: 'GET',
                    url: '/api/recommend',
                    data: {
                        "api_token": $('[name="api_token"]').val(),
                    },
                    dataSrc: 'data'
                },
                "columns": [

                    {
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
                            return age

                        }
                    },
                    {
                        "data": "phone"
                    },
                    {
                        "data": "job_parsed"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "sex",
                        "mRender": function(data, type, row) {
                            if (data == 1) return "Male";
                            else return "Female";

                        }
                    },
                    {
                        "data": "birthday",
                        "mRender": function(data, type, row) {

                            return moment(data).format('DD/MM/YYYY');
                        }
                    },
                    {
                        "defaultContent": "<button class=\"btn btn-primary  edit\">Edit</button> <button class=\"btn btn-danger delete\">Delete</button>"
                    },


                ],
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 8,

                }, {
                    "searchable": false,
                    "targets": [0, 5, 7, 8],
                }, ],
                "order": [
                    [1, 'asc']
                ]
            });
            $.ajax({
                url: 'api/masterData/job',
                data: {
                    "api_token": $('input[name="api_token"]').val()
                },
                success: function(data) {
                    let jobSelectTag = $('select[name="jobSearch"]');
                    $.each(data, function(index, value) {

                        let optionTag = "<option value=\"" + value + "\">" +
                            value + "</option>";

                        jobSelectTag.append(optionTag);
                    });
                },
            });
            $('select[name="jobSearch"]').change(function() {
                table.columns(4).search($(this).val()).draw();
            });

            $('#display tbody ').on('click', '.edit', function() {

                var data = table.row($(this).parents('tr')).data();
                window.location.href = "/admin/edit_user/" + data['id'];
            });

            $('#display tbody ').on('click', '#detail', function() {
                var data = table.row($(this).parents('tr')).data();
                $.ajax({
                    type: 'GET',
                    url: '/api/admin/' + data['id'],
                    data: {
                        "api_token": $('[name="api_token"]').val(),
                    },
                    success: function(data) {             
                        $('#detailBody').html(data.html);                                             
                        $('#detailModal').modal('show');
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        $('#messageModalLabel').html('ERORR');
                        $('#messageBody').html(
                            'somthing went wrong can\'t  load ' + data['name']
                        );
                        $('#messageModal').modal('show');
                    }
                });

            });

            $('#display tbody ').on('click', '.delete', function() {
                var row = table.row($(this).parents('tr'));
                var data = row.data();
                $('#deleteModalLabel').html('Warning!');
                $('#deleteBody').html('User ' + data['name'] + ' will be delete');
                $('#deleteModal').modal('show');


                deleteCallback = function(result) {
                    if (result) {
                        $.ajax({
                            type: 'DELETE',
                            url: '/api/admin/' + data['id'],
                            data: {
                                "api_token": $('[name="api_token"]').val(),
                            },
                            success: function(data) {
                                var re = row.remove().draw(false);
                                $('#messageModalLabel').html('Success');
                                $('#messageBody').html('Deleted ' + data['user'][
                                    'name'
                                ]);
                                $('#messageModal').modal('show');
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                $('#messageModalLabel').html('ERORR');
                                $('#messageBody').html(
                                    'somthing went wrong can\'t  delete ' + data['name']
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
            $(window).resize(function() {
                table.draw(false);
            });
        });

    </script>
@endpush
