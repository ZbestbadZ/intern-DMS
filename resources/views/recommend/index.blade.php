@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <a href=""></a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <table id="display" class="m-0 p-0  table table-light">
                    <thead class="thead-light">
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
                <div id="detail_body" class="modal-body">
                    <!-- personal -->
                    <div class="name"></div>
                    <div class="gender"></div>
                    <div class="address"></div>
                    <div class="phone"></div>
                    <div class="email"></div>
                    <div class="birthday"></div>
                    <!-- /.personal -->
                    <!-- account -->
                    <div class="username"></div>
                    <div class="aca_background"></div>
                    <div class="job"></div>
                    <div class="anual_income"></div>
                    <div class="birthplace"></div>
                    <div class="figure"></div>
                    <div class="height"></div>

                    <div class="tabaco"></div>
                    <div class="alcohol"></div>
                    <div class="holiday"></div>

                    <div class="matching_expect"></div>
                    <!-- /.account -->
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
        var deleteCallback = null;
        $(document).ready(function() {

            var table = $('#display').DataTable({
                "pageLength": 10,
                "pagingType": "simple_numbers",
                searchPanes: {
                    layout: 'columns-1',

                },
                "searching": true,
                dom: 'Pfrtip',

                ajax: {
                    type: 'GET',
                    url: '/api/recommend',
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
                        "data": "job"
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

                            return getFormattedDate(data);
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
                    "targets": [0, 5, 6,7,8],
                }, {
                    searchPanes: {
                        show: true,
                        controls: false,
                        orthogonal: 'sp',
                        dtOpts: {
                            searching: false,
                            dom: "rt",
                            info: false,
                        }
                    },
                    targets: [6],
                }],
                "order": [
                    [1, 'asc']
                ]
            });

            $('#display tbody ').on('click', '.edit', function() {

                var data = table.row($(this).parents('tr')).data();
                window.location.href = "/admin/" + data['id'] + "/edit";
            });

            $('#display tbody ').on('click', '#detail', function() {
                var data = table.row($(this).parents('tr')).data();
                $.ajax({
                    type: 'GET',
                    url: '/api/admin/' + data['id'],
                    data: '_token = <?php echo csrf_token(); ?>',
                    success: function(data) {
                        let user = data['user'];
                        var spanGen = function(content) {
                            return '<span>' + content + '</span>';
                        }
                        $.each(user,function(index,value) {
                            let idRow = "#" + "detail_body" + " > "+ "." + index;
                            $(idRow).html(spanGen(value));
                        });
                        
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
                            data: '_token = <?php echo csrf_token(); ?>',
                            success: function(data) {
                                var re = row.remove().draw(false);
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

        function getFormattedDate(input) {
            var date = new Date(input);
            var year = date.getFullYear();

            var month = (1 + date.getMonth()).toString();
            month = month.length > 1 ? month : '0' + month;

            var day = date.getDate().toString();
            day = day.length > 1 ? day : '0' + day;

            return day + '/' + month + '/' + year;
        }

    </script>
@endpush
