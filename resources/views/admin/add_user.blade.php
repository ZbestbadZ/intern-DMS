@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-7">
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
                        <input type="radio" class="click1" id="male" name="sex" checked="checked" value="1">
                            <label for="male">Male</label>
                        <input type="radio" class="click2" id="female" name="sex" value="0">
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
                        <select name="height">
                            @foreach($height  as  $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                            @error ('height')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="figure">Figure:</label>
                        <select name="figure">
                            @foreach($figure  as  $key1 => $value1)
                                <option value="{{$key1}}">{{$value1}}</option>
                            @endforeach
                        </select>
                            @error ('figure')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="job">Job:</label>
                        <select name="job">
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
                            @foreach($anual_income as  $key4 => $value4)
                                <option value="{{$key4}}">{{$value4['1']}}</option>
                            @endforeach
                        </select>
                            @error ('anual_income')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="holiday">Holiday:</label>
                        <select name="holiday">
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
                            @foreach($aca_background  as  $key6 => $value6)
                                <option value="{{$key6}}">{{$value6['1']}}</option>
                            @endforeach
                        </select>
                            @error ('aca_background')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="alcohol">Alcohol:</label>
                        <select name="alcohol">
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
                            @foreach($tabaco as  $key8 => $value8)
                                <option value="{{$key8}}">{{$value8['1']}}</option>
                            @endforeach
                        </select>
                            @error ('tabaco')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="housemate">Housemate:</label>
                        <select name="housemate">
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
                            @foreach($birthplace as  $key10 => $value10)
                                <option value="{{$key10}}">{{$value10}}</option>
                            @endforeach
                        </select>
                            @error ('birthplace')
                            <div class="text-danger" ><strong>{{ $message }}</strong></div>
                            @enderror
                        <label for="hobby">Hobby:
                        <select name="hobby">
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
