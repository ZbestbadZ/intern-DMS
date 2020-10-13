@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <span class="display-4">PICK UP USERS</span>
                <a href=""></a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col">
                <table id="display" class="table   table-light">
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
                        <tr>
                            <th></th>
                            <th>name</th>
                            <th><input type="number" placeholder="Search age" /></th>
                            <th>phone</th>
                            <th><select name="jobSearch" id=""></select></th>
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
    <!-- hidden -->
    <input type="hidden" name="api_token" value="{{ Auth::user()->api_token }}">
@endsection

@push('scripts')
    <script>
        var deleteCallback = null;
        $(document).ready(function() {

            $('#display tfoot th').each(function(index, value) {
                searchbyTextColIndex = [1,  3];
                if ($.inArray(index, searchbyTextColIndex) != -1) {
                    var title = $(this).text();

                    $(this).html('<input type="text" placeholder="Search ' + title + '" />');
                }

                if (index === 4) {
                    let thisTag = $(this);
                      $.ajax({
                          url: 'api/masterData/job',
                          data: {
                              "api_token": $('input[name="api_token"]').val()
                          },
                          success: function(data)  {
                              $.each(data ,function(index, value) {
                                 
                                  let selectTag = "<option value=\""+index+"\">"+value+"</option>" ;
                                    
                                      $(thisTag).find("select").append(selectTag);
                                  });
                          },
                      });
                      
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
                "processing": true,
                "serverSide": true,
                "pagingType": "simple_numbers",
                "searching": true,
                dom: 'Pfrtip',

                ajax: {
                    url: '/api/pickup',
                    data: {
                        "api_token": $('input[name="api_token"]').val(),
                    }
                },

                "columns": [

                    {
                        "data": "id",
                        "name": "id",
                    },

                    {
                        "data": "name",
                        "name": "name",
                        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a id=\"detail\" href='#'>" +
                                oData.name + "</a>");
                        }
                    },
                    {
                        "data": "age",
                        "name": "age",

                    },
                    {
                        "data": "phone",
                        "name": "phone",
                    },
                    {
                        "data": "job",
                        "name": "job",
                    },
                    {
                        "data": "email",
                        "name": "email"
                    },
                    {
                        "data": "sex",
                        "name": "sex",
                        "mRender": function(data, type, row) {
                            if (data == 1) return "Male";
                            else return "Female";

                        }
                    },
                    {
                        "data": "birthday",
                        "name": "birthday",
                        "mRender": function(data, type, row) {

                            return moment(data).format("DD/MM/yyyy");
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
                        $('#detailBody').html(data.html);
                        $('#detailModal').modal('show');
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
            $(window).resize(function() {
                table.draw(false);
            });
        });

       

    </script>
@endpush
