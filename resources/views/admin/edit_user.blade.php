@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-7">
                <h2 style="text-align:center; margin-top:10px;">EDIT USER</h2>
                <form id="form" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">

                    <div class="form-group">                      
                        <label for="name">Name: </label>
                        <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}" autofocus>
                    </div>

                    <div class="form-group">
                        <label for="username">Username: </label>
                        <input class="form-control" type="text" name="username" id="username" value="{{$user->username}}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input class="form-control" type="email" name="email" id="email" value="{{$user->email}}" >

                    </div>

                    <div class="form-group">
                        <label for="sex">Sex: </label>
                        <input type="radio" id="male" name="sex" @if ($user->sex == 1) checked=checked @endif value="1">
                            <label for="male">Male</label>
                        <input type="radio" id="female" name="sex" @if ($user->sex == 0) checked=checked @endif value="0">
                            <label for="female">Female</label>  

                    </div>

                    <div class="form-group">
                        <label for="birthday">Birthday:</label>
                        <input type="date" name="birthday" id="birthday" value="{{ $user->birthday->format('Y-m-d') }}"><br>
 
                    </div>

                    <div class="form-group">
                        <label for="height">Height:</label>      
                        <select name="height">
                            <option value="{{$user->height}}" >{{ $height[($user->height)] }}</option>
                            @foreach($height  as  $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
 
                        <label for="figure">Figure:</label>
                        <select name="figure">
                            <option value="{{$user->figure}}" >{{ $figure[($user->figure)] }}</option>
                            @foreach($figure  as  $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>

                        <label for="job">Job:</label>
                        <select name="job">
                            <option value="{{$user->job}}" >{{ $job[($user->job)]['1'] }}</option>
                            @foreach($job as $key => $value)
                                <option value="{{$key}}">{{$value['1']}}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="form-group">
                        <label for="matching_expect">Matching Expect:</label>
                        <select name="matching_expect">
                            <option value="{{$user->matching_expect}}" >{{ $matching_expect[($user->matching_expect)] }}</option>
                            @foreach($matching_expect  as  $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="form-group">
                        <label for="anual_income">Anual Income:</label>
                        <select name="anual_income">
                            <option value="{{$user->anual_income}}" >{{ $anual_income[($user->anual_income)]['1'] }}</option>
                            @foreach($anual_income as  $key => $value)
                                <option value="{{$key}}">{{$value['1']}}</option>
                            @endforeach
                        </select>
 
                        <label for="holiday">Holiday:</label>
                        <select name="holiday">
                            <option value="{{$user->holiday}}" >{{ $holiday[($user->holiday)]['1'] }}</option>
                            @foreach($holiday as  $key => $value)
                                <option value="{{$key}}">{{$value['1']}}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="form-group">
                        <label for="aca_background">Aca Background:</label>
                        <select name="aca_background">
                            <option value="{{$user->aca_background}}" >{{ $aca_background[($user->aca_background)]['1'] }}</option>
                            @foreach($aca_background  as  $key => $value)
                                <option value="{{$key}}">{{$value['1']}}</option>
                            @endforeach
                        </select>

                        <label for="alcohol">Alcohol:</label>
                        <select name="alcohol">
                            <option value="{{$user->alcohol}}" >{{ $alcohol[($user->alcohol)]['1'] }}</option>
                            @foreach($alcohol as  $key => $value)
                                <option value="{{$key}}">{{$value['1']}}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="form-group">
                        
                        <label for="tabaco">Tabaco:</label>
                        <select name="tabaco">
                            <option value="{{$user->tabaco}}" >{{ $tabaco[($user->tabaco)]['1'] }}</option>
                            @foreach($tabaco as  $key => $value)
                                <option value="{{$key}}">{{$value['1']}}</option>
                            @endforeach
                        </select>

                        <label for="housemate">Housemate:</label>
                        <select name="housemate">
                            <option value="{{$user->housemate}}" >{{ $housemate[($user->housemate)]['1'] }}</option>
                            @foreach($housemate  as  $key => $value)
                                <option value="{{$key}}">{{$value['1']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">  
                        <label for="birthplace">Birthplace:</label>
                        <select name="birthplace">
                            <option value="{{$user->birthplace}}" >{{ $birthplace[($user->birthplace)] }}</option>
                            @foreach($birthplace as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                        <label for="hobby">Hobby:
                        
                            @foreach($hobby as  $key => $value)
                                    <input type="checkbox" value="{{$key}}" name="hobby[]" id="hobby"
                                            @foreach ($userHobby as $hob)
                                            @if ($hob->hobby == $key) checked="checked" 
                                            @endif @endforeach />
                                    {{$value}}
                                
                            @endforeach  
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input class="form-control" type="number" name="phone" id="phone" value="{{$user->phone}}">
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input class="form-control" type="text" name="address" id="address" value="{{$user->address}}">

                    </div>

                    <div class="form-group">
                        <label for="about">About:</label>
                        <input class="form-control" type="text" name="about" id="about" value="{{$user->about}}"><br>
                    </div>

                    <div class="form-group">
                        <label for="about_title">About Title:</label>
                        <input class="form-control" type="text" name="about_title" id="about_title" value="{{$user->about_title}}"><br>

                    </div>

                    <div class="form-group">
                        <label for="password">Password: </label>
                        <input class="form-control"  type="password" name="password" id="password" value="{{$user->password}}">
                            
                    </div>

                    <div class="form-group">
                        <label for="password_confirm">Password Confirm</label>
                        <input id="password_confirm" type="password" class="form-control" name="password_confirmation" value="{{$user->password}}" required autocomplete="new-password">
                    </div>
                     
                    <button class="btn btn-primary" type="submit" name="update" data-url="{{ route('admin.list_user')}}">Update</button>
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
                error:function(error){
                    console.log(error);
                }
            });
            
        });
    });    

</script>
@endpush