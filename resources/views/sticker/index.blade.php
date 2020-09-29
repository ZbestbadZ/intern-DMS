@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <!--Bread Crumbs-->
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <table id="display" class="display" style="width:100%">
                    <thead>
                        <th>id</th>
                        <th>path</th>
                        <th>name</th>
                        <th>price</th>
                        <!-- <th>size</th> -->
                        <th>option</th>
                    </thead>



                </table>
            </div>

        </div>

    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            var table = $('#display').DataTable({
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
                        "data": "image_path"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "item_price"
                    },
                    {
                        "defaultContent": "<button id=\"edit\">Edit</button> <button id=\"delete\">Delete</button>"
                    },
                    

                ],
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0,

                }],
                "order": [
                    [1, 'asc']
                ]
            });

            $('#display tbody ').on('click', '#edit', function() {
                
                var data = table.row($(this).parents('tr')).data();
                $.ajax({
                    type: 'GET',
                    url: '/api/sticker/'+ data['id'],
                    data: '_token = <?php echo csrf_token(); ?>',
                    success: function(data) {
                        console.log(data);
                    }
                });
            });
            $('#display tbody ').on('click', '#delete', function() {
                
                var data = table.row($(this).parents('tr')).data();
                $.ajax({
                    type: 'DELETE',
                    url: '/api/sticker/'+ data['id'],
                    data: '_token = <?php echo csrf_token(); ?>',
                    success: function(data) {
                        console.log(data);
                    }
                });
            });
            
        });

    </script>
@endpush
