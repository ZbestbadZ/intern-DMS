@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <h2>Edit User</h2>
                <form method="POST" enctype="multipart/form-data" action="/admin/edit_user/{{$user->id}}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="form-group">
                        
                        <label for="name">Name: </label>
                        <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}" autofocus>
                        @error('name')

                        <div class="text-danger" ><strong>{{ $message }}</strong></div>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Username: </label>
                        <input class="form-control" type="text" name="username" id="username" value="{{$user->username}}">
                        @error('username')

                        <div class="text-danger" ><strong>{{ $message }}</strong></div>

                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input class="form-control" type="email" name="email" id="email" value="{{$user->email}}" >
                        @error('email')

                        <div class="text-danger" ><strong>{{ $message }}</strong></div>

                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sex">Sex: </label>
                        <input type="radio" id="male" name="sex" @if ($user->sex == 1) checked=checked @endif value="1">
                            <label for="male">Male</label>
                        <input type="radio" id="female" name="sex" @if ($user->sex == 0) checked=checked @endif value="0">
                            <label for="female">Female</label>  
                        @error('sex')
                        <div class="text-danger" ><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="birthday">Birthday:</label>
                        <input type="date" name="birthday" id="birthday" value="{{ $user->birthday->format('Y-m-d') }}"><br>
                            @error ('birthday')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="height">Height:</label>
                        <input type="number" name="height" id="height" min="130" max="200" value="{{ $user->height }}">
                            @error ('height')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="figure">Figure:</label>
                        <input type="number" name="figure" id="figure" min="1" max="7" value="{{ $user->figure }}">
                            @error ('figure')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="matching_expect">Matching Expect:</label>
                        <input type="number" name="matching_expect" id="matching_expect" min="1" max="5" value="{{ $user->matching_expect }}">
                            @error ('matching_expect')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="job">Job:</label>
                        <input type="number" name="job" id="job" min="1" max="47" value="{{ $user->job }}">
                            @error ('job')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="anual_income">Anual Income:</label>
                        <input type="number" name="anual_income" id="anual_income" min="1" max="8" value="{{ $user->anual_income }}">
                            @error ('anual_income')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="holiday">Holiday:</label>
                        <input type="number" name="holiday" id="holiday" min="1" max="5" value="{{ $user->holiday }}">
                            @error ('holiday')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="aca_background">Aca Background:</label>
                        <input type="number" name="aca_background" id="aca_background" min="1" max="6" value="{{ $user->aca_background }}">
                            @error ('aca_background')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="alcohol">Alcohol:</label>
                        <input type="number" name="alcohol" id="alcohol" min="1" max="4" value="{{ $user->alcohol }}">
                            @error ('alcohol')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="tabaco">Tabaco:</label>
                        <input type="number" name="tabaco" id="tabaco" min="1" max="5" value="{{ $user->tabaco }}">
                            @error ('tabaco')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="housemate">Housemate:</label>
                        <input type="number" name="housemate" id="housemate" min="1" max="6" value="{{ $user->housemate }}">
                            @error ('housemate')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="hobby">Hobby:</label>
                        <input type="number" name="hobby" id="hobby" min="1" max="7" value="{{ $user->hobby }}">
                            @error ('aca_bahobbyckground')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="birthplace">Birthplace:</label>
                        <input type="number" name="birthplace" id="birthplace" min="1" max="47" value="{{ $user->birthplace }}">
                            @error ('birthplace')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input class="form-control" type="number" name="phone" id="phone" value="{{$user->phone}}">
                            @error ('phone')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input class="form-control" type="text" name="address" id="address" value="{{$user->address}}">
                            @error ('address')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="about">About:</label>
                        <input class="form-control" type="text" name="about" id="about" value="{{$user->about}}"><br>
                            @error ('about')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="about_title">About Title:</label>
                        <input class="form-control" type="text" name="about_title" id="about_title" value="{{$user->about_title}}"><br>
                            @error ('about_title')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password: </label>
                        <input class="form-control"  type="password" name="password" id="password" value="{{$user->password}}">
                            <label for="change" class="click"><a class="btn btn-primary">Change</a></label>
                    </div>

                    <div class="form-group">
                        <label for="password_confirm">Password Confirm</label>
                        <input id="password_confirm" type="password" class="form-control" name="password_confirmation" value="{{$user->password}}" required autocomplete="new-password">
                    </div>
                     
                    <button class="btn btn-primary" type="submit" name="update">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $(password).attr('disabled', 'disabled');
        $(password_confirm).attr('disabled', 'disabled');

        $('.click').click(function() {
            if ($(password).attr('disabled')) $(password).removeAttr('disabled');
            else $(password).attr('disabled', 'disabled');
        });
        $('.click').click(function() {
            if ($(password_confirm).attr('disabled')) $(password_confirm).removeAttr('disabled');
            else $(password_confirm).attr('disabled', 'disabled');
        });
    });

</script>
@endpush