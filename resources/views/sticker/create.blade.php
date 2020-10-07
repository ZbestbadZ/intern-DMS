@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <form id="form" enctype="multipart/form-data" >
                    @csrf
                    <!-- input -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" id="name" required placeholder="">
                        @error('name')

                        <div class="text-danger"><strong>{{ $message }}</strong></div>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input name="price" required type="number" id="price" placeholder="">
                        @error('price')

                        <div class="text-danger"><strong>{{ $message }}</strong></div>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Image File</label>
                        <input name="image" class="form-control-file" type="file" id="image" required placeholder="">
                        @error('image')

                        <div class="text-danger"><strong>{{ $message }}</strong></div>

                        @enderror
                    </div>
                    <!-- end of input -->

                    <button class="btn btn-primary btnsave" type="submit"  name="create">Create</button>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $("#form").submit(function(evt) {
                evt.preventDefault();
                var formData = new FormData($(this)[0]);
               formData.set( 'api_token','{{ Auth::user()->api_token }}');
                $.ajax({
                    url: '/api/sticker',
                    type: 'POST',
                    data: 
                         formData,
                    
                    async: false,
                    cache: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    processData: false,
                    success: function(response) {
                        window.location.href = "{{ url('sticker?message=')}}" + response['success'];
                    }
                });
                return false;
            });
    });

</script>
@endpush
