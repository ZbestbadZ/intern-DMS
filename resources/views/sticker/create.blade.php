@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <form id="form" enctype="multipart/form-data">
                   
                    <!-- input -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" id="name" required placeholder="">

                        <div class="text-danger"><strong><span id="error_name"></span></strong></div>

                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input name="price" required type="number" id="price" placeholder="">

                        <div class="text-danger"><strong><span id="error_price"></span></strong></div>

                    </div>
                    <div class="form-group">
                        <label for="image">Image File</label>
                        <input name="image" class="form-control-file" type="file" id="image" required placeholder="">

                        <div class="text-danger"><strong><span id="error_image"></span></strong></div>

                    </div>
                    <!-- end of input -->

                    <button class="btn btn-primary btnsave" type="submit" name="create">Create</button>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'Authorization': 'Bearer ' + "{{ Auth::user()->api_token }}",

                }
            });
            $("#form").submit(function(evt) {
                evt.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: '/api/sticker',
                    type: 'POST',
                    data: formData,
                    async: false,
                    dataType: "json",
                    enctype: 'multipart/form-data',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        window.location.href = "{{ url('sticker?message=') }}" + response[
                            'success'];
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        switch (xhr.status) {
                            case 404: {
                                let message = "item not found";
                                Console.log(message);
                                break;
                            }
                            case 422: {
                                $(".text-danger strong span").html("");
                                var errors = $.parseJSON(xhr.responseText)['errors'];
                                $.each(errors, function(index, value) {
                                    let idErr = "#error_" + index;
                                    $(idErr).html(value[0]);
                                });
                                break;
                            }
                            case 500: {
                                let message = "some error on server side please try next time";
                                Console.log(message);
                                break;
                            }
                        }
                    },

                });
                return false;
            });
        });

    </script>
@endpush
