@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-7">
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
                        <select name="height">
                            <option value="{{$user->height}}" >{{ $height[($user->height)] }}</option>
                            @foreach($height  as  $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                            @error ('height')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="figure">Figure:</label>
                        <select name="figure">
                            <option value="{{$user->figure}}" >{{ $figure[($user->figure)] }}</option>
                            @foreach($figure  as  $key1 => $value1)
                                <option value="{{$key1}}">{{$value1}}</option>
                            @endforeach
                        </select>
                            @error ('figure')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="job">Job:</label>
                        <select name="job">
                            <option value="{{$user->job}}" >{{ $job[($user->job)]['1'] }}</option>
                            @foreach($job  as  $key3 => $value3)
                                <option value="{{$key3}}">{{$value3['1']}}</option>
                            @endforeach
                        </select>
                            @error ('job')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="matching_expect">Matching Expect:</label>
                        <select name="matching_expect">
                            <option value="{{$user->matching_expect}}" >{{ $matching_expect[($user->matching_expect)] }}</option>
                            @foreach($matching_expect  as  $key2 => $value2)
                                <option value="{{$key2}}">{{$value2}}</option>
                            @endforeach
                        </select>
                            @error ('matching_expect')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror

                    </div>

                    <div class="form-group">
                        <label for="anual_income">Anual Income:</label>
                        <select name="anual_income">
                            <option value="{{$user->anual_income}}" >{{ $anual_income[($user->anual_income)]['1'] }}</option>
                            @foreach($anual_income as  $key4 => $value4)
                                <option value="{{$key4}}">{{$value4['1']}}</option>
                            @endforeach
                        </select>
                            @error ('anual_income')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="holiday">Holiday:</label>
                        <select name="holiday">
                            <option value="{{$user->holiday}}" >{{ $holiday[($user->holiday)]['1'] }}</option>
                            @foreach($holiday as  $key5 => $value5)
                                <option value="{{$key5}}">{{$value5['1']}}</option>
                            @endforeach
                        </select>
                            @error ('holiday')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="aca_background">Aca Background:</label>
                        <select name="aca_background">
                            <option value="{{$user->aca_background}}" >{{ $aca_background[($user->aca_background)]['1'] }}</option>
                            @foreach($aca_background  as  $key6 => $value6)
                                <option value="{{$key6}}">{{$value6['1']}}</option>
                            @endforeach
                        </select>
                            @error ('aca_background')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="alcohol">Alcohol:</label>
                        <select name="alcohol">
                            <option value="{{$user->alcohol}}" >{{ $alcohol[($user->alcohol)]['1'] }}</option>
                            @foreach($alcohol as  $key7 => $value7)
                                <option value="{{$key7}}">{{$value7['1']}}</option>
                            @endforeach
                        </select>
                            @error ('alcohol')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">
                        
                        <label for="tabaco">Tabaco:</label>
                        <select name="tabaco">
                            <option value="{{$user->tabaco}}" >{{ $tabaco[($user->tabaco)]['1'] }}</option>
                            @foreach($tabaco as  $key8 => $value8)
                                <option value="{{$key8}}">{{$value8['1']}}</option>
                            @endforeach
                        </select>
                            @error ('tabaco')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="housemate">Housemate:</label>
                        <select name="housemate">
                            <option value="{{$user->housemate}}" >{{ $housemate[($user->housemate)]['1'] }}</option>
                            @foreach($housemate  as  $key9 => $value9)
                                <option value="{{$key9}}">{{$value9['1']}}</option>
                            @endforeach
                        </select>
                            @error ('housemate')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                    </div>

                    <div class="form-group">  
                        <label for="birthplace">Birthplace:</label>
                        <select name="birthplace">
                            <option value="{{$user->birthplace}}" >{{ $birthplace[($user->birthplace)] }}</option>
                            @foreach($birthplace as  $key10 => $value10)
                                <option value="{{$key10}}">{{$value10}}</option>
                            @endforeach
                        </select>
                            @error ('birthplace')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="hobby">Hobby:
                        <select id="hobby" name="hobby">
                            @foreach ($user_hobby as $hob)
                                <option value="{{$hob->hobby}}" style="color:yellow;" >{{ $hobby[($hob->hobby)] }}</option>
                            @endforeach
                            @foreach($hobby as  $key11 => $value11)
                            <input type="checkbox" name="hobby[]" id="hobby" value="{{$key11}}"/>
                                {{$value11}}
                            @endforeach
                        </select>
                            @error ('hobby')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        </label>
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