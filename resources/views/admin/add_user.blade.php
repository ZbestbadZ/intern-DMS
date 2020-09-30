@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <h2>Create new User</h2>
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.add_user') }}">
                    @csrf
                    <div class="form-group">
                        
                        <label for="name">Name(*) </label>
                        <input class="form-control" type="text" name="name" id="name" value="" autofocus>
                        @error('name')

                        <div class="text-danger" ><strong>{{ $message }}</strong></div>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Username(*) </label>
                        <input class="form-control" type="text" name="username" id="username" value="">
                        @error('username')

                        <div class="text-danger" ><strong>{{ $message }}</strong></div>

                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email(*)</label>
                        <input class="form-control" type="email" name="email" id="email" value="">
                        @error('email')

                        <div class="text-danger" ><strong>{{ $message }}</strong></div>

                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sex">Sex(*) </label>
                        <input type="radio" id="male" name="sex" value="1">
                            <label for="male">Male</label>
                        <input type="radio" id="female" name="sex" value="0">
                            <label for="female">Female</label>  
                        @error('sex')
                        <div class="text-danger" ><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="birthday">Birthday(*)</label>
                        <input type="date" name="birthday" id="birthday" value="">
                            @error ('birthday')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="height">Height:</label>
                        <input type="number" name="height" id="height" min="130" max="200">
                            @error ('height')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="figure">Figure:</label>
                        <input type="number" name="figure" id="figure" min="1" max="7">
                            @error ('figure')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="matching_expect">Matching Expect:</label>
                        <input type="number" name="matching_expect" id="matching_expect" min="1" max="5">
                            @error ('matching_expect')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="job">Job:</label>
                        <input type="number" name="job" id="job" min="1" max="47">
                            @error ('job')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="anual_income">Anual Income:</label>
                        <input type="number" name="anual_income" id="anual_income" min="1" max="8">
                            @error ('anual_income')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="holiday">Holiday:</label>
                        <input type="number" name="holiday" id="holiday" min="1" max="5">
                            @error ('holiday')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="aca_background">Aca Background:</label>
                        <input type="number" name="aca_background" id="aca_background" min="1" max="6">
                            @error ('aca_background')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="alcohol">Alcohol:</label>
                        <input type="number" name="alcohol" id="alcohol" min="1" max="4">
                            @error ('alcohol')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="tabaco">Tabaco:</label>
                        <input type="number" name="tabaco" id="tabaco" min="1" max="5">
                            @error ('tabaco')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="housemate">Housemate:</label>
                        <input type="number" name="housemate" id="housemate" min="1" max="6">
                            @error ('housemate')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="hobby">Hobby:</label>
                        <input type="number" name="hobby" id="hobby" min="1" max="7">
                            @error ('aca_bahobbyckground')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="birthplace">Birthplace:</label>
                        <input type="number" name="birthplace" id="birthplace" min="1" max="47">
                            @error ('birthplace')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input class="form-control" type="number" name="phone" id="phone" value="">
                            @error ('phone')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input class="form-control" type="text" name="address" id="address" value="">
                            @error ('address')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="about">About(*)</label>
                        <input class="form-control" type="text" name="about" id="about" value="">
                            @error ('about')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="about_title">About Title(*)</label>
                        <input class="form-control" type="text" name="about_title" id="about_title" value="">
                            @error ('about_title')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password(*) </label>
                        <input class="form-control"  type="password" name="password" id="password" required autocomplete="new-password">
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Password Confirm(*)</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                     
                    <button class="btn btn-primary" type="submit" name="create">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
