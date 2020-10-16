@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex align-items-stretch justify-content-center pt-5 pb-5">
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title d-flex align-items-center"><span class="">EDIT USER
                            <i>{{$user->name}}</i></span></h5>
                </div>
                <div class="card-body">
                    <form id="form" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">

                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}"
                                autofocus>
                            <div class="text-danger"><strong><span id="error_name"></span></strong></div>
                        </div>

                        <div class="form-group">
                            <label for="username">Username: </label>
                            <input class="form-control" type="text" name="username" id="username"
                                value="{{$user->username}}">
                            <div class="text-danger"><strong><span id="error_username"></span></strong></div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input class="form-control" type="email" name="email" id="email" value="{{$user->email}}">
                            <div class="text-danger"><strong><span id="error_email"></span></strong></div>
                        </div>

                        <div class="form-group">
                            <label for="sex">Sex: </label>
                            <input type="radio" id="male" name="sex" @if ($user->sex == 1) checked=checked @endif
                            value="1">
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="sex" @if ($user->sex == 0) checked=checked @endif
                            value="0">
                            <label for="female">Female</label>

                        </div>

                        <div class="form-group">
                            <label for="birthday">Birthday:</label>
                            <input type="date" name="birthday" id="birthday"
                                value="{{ $user->birthday->format('Y-m-d') }}"><br>
                            <div class="text-danger"><strong><span id="error_birthday"></span></strong></div>

                        </div>

                        <div class="form-group">
                            <label for="height">Height:</label>
                            <select name="height">
                                @foreach($height as $key => $value)
                                <option value="{{$key}}" @if($user->height == $key) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>

                            <label for="figure">Figure:</label>
                            <select name="figure">
                                @foreach($figure as $key => $value)
                                <option value="{{$key}}" @if($user->figure == $key) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>

                            <label for="job">Job:</label>
                            <select name="job">
                                @foreach($job as $key => $value)
                                <option value="{{$key}}" @if($user->job == $key) selected @endif>{{$value['1']}}
                                </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="matching_expect">Matching Expect:</label>
                            <select name="matching_expect">

                                @foreach($matching_expect as $key => $value)
                                <option value="{{$key}}" @if($user->matching_expect == $key) selected @endif>{{$value}}
                                </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="anual_income">Anual Income:</label>
                            <select name="anual_income">

                                @foreach($anual_income as $key => $value)
                                <option value="{{$key}}" @if($user->anual_income == $key) selected
                                    @endif>{{$value['1']}}
                                </option>
                                @endforeach
                            </select>

                            <label for="holiday">Holiday:</label>
                            <select name="holiday">

                                @foreach($holiday as $key => $value)
                                <option value="{{$key}}" @if($user->holiday == $key) selected @endif>{{$value['1']}}
                                </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="aca_background">Aca Background:</label>
                            <select name="aca_background">

                                @foreach($aca_background as $key => $value)
                                <option value="{{$key}}" @if($user->aca_background == $key) selected
                                    @endif>{{$value['1']}}
                                </option>
                                @endforeach
                            </select>

                            <label for="alcohol">Alcohol:</label>
                            <select name="alcohol">

                                @foreach($alcohol as $key => $value)
                                <option value="{{$key}}" @if($user->alcohol == $key) selected @endif>{{$value['1']}}
                                </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">

                            <label for="tabaco">Tabaco:</label>
                            <select name="tabaco">

                                @foreach($tabaco as $key => $value)
                                <option value="{{$key}}" @if($user->tabaco == $key) selected @endif>{{$value['1']}}
                                </option>
                                @endforeach
                            </select>

                            <label for="housemate">Housemate:</label>
                            <select name="housemate">

                                @foreach($housemate as $key => $value)
                                <option value="{{$key}}" @if($user->housemate == $key) selected @endif>{{$value['1']}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="birthplace">Birthplace:</label>
                            <select name="birthplace">

                                @foreach($birthplace as $key => $value)
                                <option value="{{$key}}" @if($user->birthplace == $key) selected @endif>{{$value}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hobby">Hobby:</label>

                            @foreach($hobby as $key => $value)
                            <input type="checkbox" value="{{$key}}" name="hobby[]" id="hobby" @foreach ($userHobby as
                                $hob) @if ($hob->hobby == $key) checked="checked"
                            @endif @endforeach />
                            {{$value}}

                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input class="form-control" type="number" name="phone" id="phone" value="{{$user->phone}}">
                            <div class="text-danger"><strong><span id="error_phone"></span></strong></div>
                        </div>

                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input class="form-control" type="text" name="address" id="address"
                                value="{{$user->address}}">
                            <div class="text-danger"><strong><span id="error_address"></span></strong></div>

                        </div>

                        <div class="form-group">
                            <label for="about">About:</label>
                            <input class="form-control" type="text" name="about" id="about"
                                value="{{$user->about}}"><br>
                            <div class="text-danger"><strong><span id="error_about"></span></strong></div>
                        </div>

                        <div class="form-group">
                            <label for="about_title">About Title:</label>
                            <input class="form-control" type="text" name="about_title" id="about_title"
                                value="{{$user->about_title}}"><br>
                            <div class="text-danger"><strong><span id="error_about_title"></span></strong></div>
                        </div>

                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input class="form-control" type="password" name="password" id="password"
                                value="{{$user->password}}">
                            <div class="text-danger"><strong><span id="error_password"></span></strong></div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirm">Password Confirm</label>
                            <input id="password_confirm" type="password" class="form-control"
                                name="password_confirmation" value="{{$user->password}}" required
                                autocomplete="new-password">
                            <div class="text-danger"><strong><span id="error_password-confirm"></span></strong>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit" name="update"
                            data-url="{{ route($index)}}">Update</button>
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

    $("#form").on('submit', function(event) {
        event.preventDefault();
        var user_id = $('#user_id').val();
        let url = $('[name="update"]').data('url');
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "/api/admin/edit_user/" + user_id,
            type: "POST",
            data: formData,
            async: false,
            dataType: "json",
            enctype: 'multipart/form-data',
            contentType: false,
            processData: false,
            success: function(response) {
                window.location.href = url + "?message=" + response['success'];
            },
            error: function(xhr, textStatus, errorThrown) {
                switch (xhr.status) {
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
                        let message = "Some errors on server side please try next time";
                        console.log(message);
                        break;
                    }
                }
            },
        });

    });
});
</script>
@endpush