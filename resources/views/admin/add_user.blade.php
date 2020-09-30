@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class=" col-5">
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.add_user') }}">
                    @csrf
                    <div class="form-group">
                        
                        <label for="name">Name: </label>
                        <input class="form-control" type="text" name="name" id="name" value="" autofocus>
                        @error('name')

                        <div class="text-danger" ><strong>{{ $message }}</strong></div>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Username: </label>
                        <input class="form-control" type="text" name="username" id="username" value="">
                        @error('username')

                        <div class="text-danger" ><strong>{{ $message }}</strong></div>

                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input class="form-control" type="email" name="email" id="email" value="">
                        @error('email')

                        <div class="text-danger" ><strong>{{ $message }}</strong></div>

                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sex">Sex: </label>
                        <input type="radio" id="male" name="sex" value="1">
                            <label for="male">Male</label>
                        <input type="radio" id="female" name="sex" value="0">
                            <label for="female">Female</label>  
                        @error('sex')
                        <div class="text-danger" ><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="birthday">Birthday:</label>
                        <input type="date" name="birthday" id="birthday" value=""><br>
                            @error ('birthday')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="about">About:</label>
                        <input class="form-control" type="text" name="about" id="about" value=""><br>
                            @error ('about')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="about_title">About Title:</label>
                        <input class="form-control" type="text" name="about_title" id="about_title" value=""><br>
                            @error ('about_title')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password: </label>
                        <input class="form-control"  type="password" name="password" id="password">
                    </div>
                     
                    <button class="btn btn-primary" type="submit" name="create">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
