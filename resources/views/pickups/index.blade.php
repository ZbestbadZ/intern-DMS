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

@endsection

@push('scripts')
    <script>
        var  deleteCallback = null;
        $(document).ready(function() {

            var table = $('#display').DataTable({
                "pageLength": 10,
                "pagingType": "simple_numbers",
                searchPanes:{
            layout: 'columns-1',
        },
                dom: 'Prtip',

                ajax: {
                    type: 'GET',
                    url: '/api/pickup',
                    dataSrc: 'data'
                },
                "columns": [

                    {
                        "data": "id"
                    },

                    {
                        "data": "name",
                        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a href='/api/recommend/" + oData.id + "'>" + oData
                                .name + "</a>");
                        }
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
                    "targets": 5,

                }, {
                    searchPanes: {
                    show: true,
                    controls: false,
                    orthogonal:'sp',
                    dtOpts:{
                        searching:false,
                        dom:"rt",
                        info: false,
                    }
                },
                targets: [3],
                }],
                "order": [
                    [1, 'asc']
                ]
            });

            $('#display tbody ').on('click', '.edit', function() {

                var data = table.row($(this).parents('tr')).data();
                window.location.href = "/user/" + data['id'] + "/edit";
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
