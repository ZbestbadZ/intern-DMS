@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col">
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
                <table id="mytable" class="m-0 p-0 table table-light" style="width:100%">
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
                        "data": "birthday"
                    },
                    {
                        "data": "sex"
                    },
                    {
                        "data": "job"
                    },
                    {
                        "data": "phone"
                    },
                    {
                        "defaultContent": "<button class=\"edit\">Edit</button> <button class=\"delete\">Delete</button>"
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
                    data: '_token = <?php echo csrf_token(); ?>',
                    success: function(data) {
                        let user = data['user'];
                        var spanGen = function(content) {
                            return '<span>' + content + '</span>';
                        }
                        $('#detailBody > .name').html(spanGen(user['name']));
                        $('#detailBody > .gender').html(spanGen(user['sex']));
                        $('#detailBody > .address').html(spanGen(user['address']));
                        $('#detailBody > .phone').html(spanGen(user['phone']));
                        $('#detailBody > .email').html(spanGen(user['email']));
                        $('#detailBody > .birthday').html(spanGen(user['birthday']));
                        $('#detailBody > .about').html(spanGen(user['about']));
                        $('#detailBody > .about_title').html(spanGen(user['about_title']));

                        $('#detailBody > .username').html(spanGen(user['username']));
                        $('#detailBody > .aca_background').html(spanGen(user[
                        'aca_background']));
                        $('#detailBody > .job').html(spanGen(user['job']));
                        $('#detailBody > .anual_income').html(spanGen(user['anual_income']));
                        $('#detailBody > .birthplace').html(spanGen(user['birthplace']));
                        $('#detailBody > .figure').html(spanGen(user['figure']));
                        $('#detailBody > .height').html(spanGen(user['height']));
                        $('#detailBody > .tabaco').html(spanGen(user['tabaco']));
                        $('#detailBody > .alcohol').html(spanGen(user['alcohol']));
                        $('#detailBody > .holiday').html(spanGen(user['holiday']));
                        $('#detailBody > .matching_expect').html(spanGen(user[
                            'matching_expect']));
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

    </script>
@endpush
