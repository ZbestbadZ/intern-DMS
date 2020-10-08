@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <img class="img-fluid" src="{{ url('storage/' . $item->path) }}" alt="">
            </div>
            <div class="col-6">
                <form id="form" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <!-- input -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" id="name" required placeholder="" value="{{ $item->name }}">


                        <div class="text-danger"><strong><span id="error_name"></span></strong></div>

                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input name="price" required type="number" id="price" value="{{ $item->price }}" placeholder="">



                        <div class="text-danger"><strong><span id="error_price"></span></strong></div>


                    </div>
                    <div class="form-group">
                        <label for="image">Image File</label>
                        <input name="image" class="form-control-file" type="file" id="image" placeholder="">


                        <div class="text-danger"><strong><span id="error_image"></span></strong></div>


                    </div>


                    <!-- end of input -->

                    <button type="" class="btn btn-primary btnsave">Save</button>
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
                    url: '/api/sticker/' + "{{ $item->id }}",
                    type: 'POST',
                    data: formData,
                    async: false,
                    dataType: "json",
                    enctype: 'multipart/form-data',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response['success']);
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
