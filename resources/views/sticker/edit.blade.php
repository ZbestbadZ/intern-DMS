@extends('layouts.app')

@section('content')
    <div class="container">
         
        <div class="row d-flex justify-content-center">
            <div class="col-6">
            <img class="img-fluid" src="{{url('storage/'.$item->path)}}" alt="">
            </div>
            <div class="col-6">
            <form method="POST" enctype="multipart/form-data" action="{{url('sticker/'.$item->id)}}">
                    @csrf
                    @method('PATCH')
                    <!-- input -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" id="name" required placeholder=""
                    value="{{$item->name}}"
                        >
                        @error('name')

                        <div class="text-danger"><strong>{{ $message }}</strong></div>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input name="price" required type="number" id="price" 
                        value="{{$item->price}}" placeholder="">
                        
                        @error('price')

                        <div class="text-danger"><strong>{{ $message }}</strong></div>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Image File</label>
                        <input name="image" class="form-control-file" type="file" id="image"  placeholder="">
                        @error('image')

                        <div class="text-danger"><strong>{{ $message }}</strong></div>

                        @enderror
                    </div>
                    <!-- end of input -->

                    <button class="btn btn-primary" type="submit" name="save">Save</button>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
