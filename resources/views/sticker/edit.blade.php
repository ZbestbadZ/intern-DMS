@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <img class="img-fluid" src="{{ url('storage/' . $item->path) }}" alt="">
            </div>
            <div class="col-6">
                <form id="form" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PATCH') }}
                    <!-- input -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" id="name" required placeholder="" value="{{ $item->name }}">
                        @error('name')

                        <div class="text-danger"><strong>{{ $message }}</strong></div>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input name="price" required type="number" id="price" value="{{ $item->price }}" placeholder="">

                        @error('price')

                        <div class="text-danger"><strong>{{ $message }}</strong></div>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Image File</label>
                        <input name="image" class="form-control-file" type="file" id="image" placeholder="">
                        @error('image')

                        <div class="text-danger"><strong>{{ $message }}</strong></div>

                        @enderror
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
                    '_token' : '<?php echo csrf_token(); ?>',
                    
                    }
            });
            $("form").submit(function(evt) {
                evt.preventDefault();
                var formData = new FormData($(this)[0]);
                formData.set( 'api_token','{{ Auth::user()->api_token }}');
                $.ajax({
                    url: '/api/sticker/' + "{{ $item->id }}",
                    type: 'POST',
                    data:formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    
                    processData: false,
                    success: function(response) {
                        console.log(response['success']);
                        window.location.href = "{{ url('sticker?message=') }}" + response[
                            'success'];
                    }
                });
                return false;
            });


        });

    </script>
@endpush
