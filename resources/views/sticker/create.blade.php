@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row d-flex justify-content-center pt-4 pb-5">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title d-flex align-items-center"><span class=""><b>Add new Item</b></span></h5>
                   
                    </div>
                    <div class="card-body">
                        <form id="form" enctype="multipart/form-data">
                            <!-- hidden -->
                        
                            <input class="" type="hidden" name="api_token" value="{{ Auth::user()->api_token }}">
                            <!-- input -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" name="name" type="text" id="name" required placeholder="">
        
                                <div class="text-danger"><strong><span id="error_name"></span></strong></div>
        
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input class="form-control" name="price" required type="number" id="price" placeholder="">
        
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
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $("#form").submit(function(evt) {
                evt.preventDefault();
                var formData = new FormData($(this)[0]);
                formData.set("api_token",$('[name="api_token"]').val());
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
                                console.log(message);
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
                                console.log(message);
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
