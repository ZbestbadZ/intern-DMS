@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-7">
                <h2 style="text-align:center; margin-top:10px;">CREATE NEW USER</h2>
                <form id="form" enctype="multipart/form-data">
                    <!-- hidden -->
                    <input class="" type="hidden" name="api_token" value="{{ Auth::user()->api_token }}">

                    <div class="form-group">
                        
                        <label for="name">Name(*) </label>
                        <input class="form-control" type="text" name="name" id="name" value="" autofocus>

                    </div>
                    <div class="form-group">
                        <label for="username">Username(*) </label>
                        <input class="form-control" type="text" name="username" id="username" value="">
                    </div>

                    <div class="form-group">
                        <label for="email">Email(*)</label>
                        <input class="form-control" type="email" name="email" id="email" value="">
                    </div>

                    <div class="form-group">
                        <label for="sex">Sex(*) </label>
                        <input type="radio" class="click1" id="male" name="sex" checked="checked" value="1">
                            <label for="male">Male</label>
                        <input type="radio" class="click2" id="female" name="sex" value="0">
                            <label for="female">Female</label>  

                    </div>

                    <div class="form-group">
                        <label for="birthday">Birthday(*)</label>
                        <input type="date" name="birthday" id="birthday" value="">
                    </div>

                    <div class="form-group">
                        <label for="height">Height:</label>      
                        <select name="height">
                            @foreach($height  as  $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>

                        <label for="figure">Figure:</label>
                        <select name="figure">
                            @foreach($figure  as  $key1 => $value1)
                                <option value="{{$key1}}">{{$value1}}</option>
                            @endforeach
                        </select>
                        <label for="job">Job:</label>
                        <select name="job">
                            @foreach($job  as  $key3 => $value3)
                                <option value="{{$key3}}">{{$value3['1']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="matching_expect">Matching Expect:</label>
                        <select name="matching_expect">
                            @foreach($matching_expect  as  $key2 => $value2)
                                <option value="{{$key2}}">{{$value2}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="anual_income">Anual Income:</label>
                        <select name="anual_income">
                            @foreach($anual_income as  $key4 => $value4)
                                <option value="{{$key4}}">{{$value4['1']}}</option>
                            @endforeach
                        </select>
                        <label for="holiday">Holiday:</label>
                        <select name="holiday">
                            @foreach($holiday as  $key5 => $value5)
                                <option value="{{$key5}}">{{$value5['1']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="aca_background">Aca Background:</label>
                        <select name="aca_background">
                            @foreach($aca_background  as  $key6 => $value6)
                                <option value="{{$key6}}">{{$value6['1']}}</option>
                            @endforeach
                        </select>
                        <label for="alcohol">Alcohol:</label>
                        <select name="alcohol">
                            @foreach($alcohol as  $key7 => $value7)
                                <option value="{{$key7}}">{{$value7['1']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        
                        <label for="tabaco">Tabaco:</label>
                        <select name="tabaco">
                            @foreach($tabaco as  $key8 => $value8)
                                <option value="{{$key8}}">{{$value8['1']}}</option>
                            @endforeach
                        </select>
                        <label for="housemate">Housemate:</label>
                        <select name="housemate">
                            @foreach($housemate  as  $key9 => $value9)
                                <option value="{{$key9}}">{{$value9['1']}}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="form-group">  
                        <label for="birthplace">Birthplace:</label>
                        <select name="birthplace">
                            @foreach($birthplace as  $key10 => $value10)
                                <option value="{{$key10}}">{{$value10}}</option>
                            @endforeach
                        </select>

                        <label for="hobby">Hobby:
                        
                            @foreach($hobby as  $key11 => $value11)
                            <input type="checkbox" name="hobby[]" id="hobby" value="{{$key11}}"/>
                                {{$value11}}
                            @endforeach
                        
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input class="form-control" type="number" name="phone" id="phone" value="">

                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input class="form-control" type="text" name="address" id="address" value="">

                    </div>

                    <div class="form-group">
                        <label for="about">About(*)</label>
                        <input class="form-control" type="text" name="about" id="about" value="">

                    </div>

                    <div class="form-group">
                        <label for="about_title">About Title(*)</label>
                        <input class="form-control" type="text" name="about_title" id="about_title" value="">

                    </div>

                    <div class="form-group">
                        <label for="password">Password(*) </label>
                        <input class="form-control"  type="password" name="password" id="password" required autocomplete="new-password">
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Password Confirm(*)</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                     
                    <button class="btn btn-primary" type="submit" name="create" data-url="{{ route('admin.list_user')}}">Create</button>
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

        $("#form").submit(function(event) {
            event.preventDefault();
            let url = $('[name="create"]').data('url');
            var formData = new FormData($(this)[0]);
            formData.set("api_token",$('[name="api_token"]').val());
            $.ajax({
                url: "/api/admin/add_user",
                type: "POST",
                data: formData,
                async: false,
                dataType: "json",
                enctype: 'multipart/form-data',
                contentType: false,
                processData: false,
                success: function(response) {
                    window.location.href = url;
                },
                error:function(error){
                    console.log(error);
                }
            });
        });
    });    

</script>

@endpush
