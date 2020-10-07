@extends('layouts.app')

@section('content')

    <div class="container-fluid">

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
            <div class="col-8">
                <table id="mytable" class="table table-hover table-bordered display" style="width:100%">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Birthday</th>
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
                    <!-- personal -->
                    <div class="name"></div>
                    <div class="gender"></div>
                    <div class="address"></div>
                    <div class="phone"></div>
                    <div class="email"></div>
                    <div class="birthday"></div>
                    <div class="about"></div>
                    <div class="about_title"></div>
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
                    <div class="hobby"></div>
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
                        "data": "name",
                        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a id=\"detail\" href='#'>" +
                                oData.name + "</a>");
                        }

                    },
                    {
                        "data": "birthday",
                        "mRender": function(data, type, row) {
                            return getFormattedDate(data);
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
                        "data": "job",
                        
                    
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
                    data: '_token = <?php echo csrf_token(); ?>',
                    success: function(data) {
                        let user = data['user'];
                        let userHob = data['userHob'];
                        var spanGen = function(content) {
                            return '<span style="margin-left: 50px;">' + content + '</span>';
                        }
                        $('#detailBody > .name').html(["<b>Name:</b>" ,spanGen(user['name'])]);
                        $('#detailBody > .gender').html(["<b>Gender:</b>" ,spanGen(user['sex'])]);
                        $('#detailBody > .address').html(["<b>Address: </b>" ,spanGen(user['address'])]);
                        $('#detailBody > .phone').html(["<b>Phone: </b>" ,spanGen(user['phone'])]);
                        $('#detailBody > .email').html(["<b>Email: </b>" ,spanGen(user['email'])]);
                        $('#detailBody > .birthday').html(["<b>Birthday: </b>" ,spanGen(user['birthday'])]);
                        $('#detailBody > .about').html(["<b>About: </b>" ,spanGen(user['about'])]);
                        $('#detailBody > .about_title').html(["<b>About Title: </b>" ,spanGen(user['about_title'])]);

                        $('#detailBody > .username').html(["<b>Username: </b>" ,spanGen(user['username'])]);
                        $('#detailBody > .aca_background').html(["<b>Aca Background: </b>" ,spanGen(user['aca_background'])]);
                        $('#detailBody > .job').html(["<b>Job: </b>" ,spanGen(user['job'])]);
                        $('#detailBody > .anual_income').html(["<b>Anual Income: </b>" ,spanGen(user['anual_income'])]);
                        $('#detailBody > .birthplace').html(["<b>Birthplace: </b>" ,spanGen(user['birthplace'])]);
                        $('#detailBody > .figure').html(["<b>Figure: </b>" ,spanGen(user['figure'])]);
                        $('#detailBody > .height').html(["<b>Height: </b>" ,spanGen(user['height'])]);
                        $('#detailBody > .tabaco').html(["<b>Tabaco: </b>" ,spanGen(user['tabaco'])]);
                        $('#detailBody > .alcohol').html(["<b>Alcohol: </b>" ,spanGen(user['alcohol'])]);
                        $('#detailBody > .holiday').html(["<b>Holiday: </b>" ,spanGen(user['holiday'])]);
                        $('#detailBody > .matching_expect').html(["<b>Matching Expect: </b>" ,spanGen(user['matching_expect'])]);
                        $('#detailModal').modal('show');

                        console.log(data);
                    }
                });

            });

            $('#mytable tbody ').on('click', '.edit', function() {

                var data = table.row($(this).parents('tr')).data();
                window.location.href = "/admin/" + data['id'] + "/edit";
            });

            $('#mytable tbody ').on('click', '.delete', function() {
                var row = table.row($(this).parents('tr'));
                var data = row.data();
                $('#deleteModalLabel').html('Warning!');
                $('#deleteBody').html('User ' + data['name'] + ' will be deleted');
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

                if ($(this).hasClass("delete-accecpt")) callback(true);
                else callback(false);
            });

            setTimeout(function() {
                $("div.alert").remove();
            }, 2000);

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
