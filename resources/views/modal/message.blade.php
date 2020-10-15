
    <div><b>Name: {{ $user->name }}</b></div><br>
    <b>Gender:</b><span style="margin-left: 20px;"> {{ $user->sex_parsed }}</span><br>
    <b>Address: </b><span style="margin-left: 20px;">{{ $user->address }}</span><br>
    <b>Phone: </b><span style="margin-left: 20px;">{{ $user->phone }}</span><br>
    <b>Email: </b><span style="margin-left: 20px;">{{ $user->email }}</span><br>
    <b>About:</b> <span style="margin-left: 20px;">{{ $user->about }}</span><br>
    <b>About Title: </b><span style="margin-left: 20px;">{{ $user->about_title }}</span><br>
    <b>Birthday:</b> <span style="margin-left: 20px;">{{ $user->birthday }}</span><br>
    <b>Username:</b> <span style="margin-left: 20px;">{{ $user->username }}</span><br>
    <b>Aca Background: </b><span style="margin-left: 20px;">{{ $user->aca_parsed }}</span><br>
    <b>Job: </b><span style="margin-left: 20px;">{{ $user->job_parsed }}</span><br>
    <b>Anual Income:</b> <span style="margin-left: 20px;">{{ $user->anual_parsed }}</span><br>
    <b>Figure: </b><span style="margin-left: 20px;">{{ $user->figure_parsed }}</span><br>
    <b>Height:</b> <span style="margin-left: 20px;">{{ $user->height_parsed }}</span><br>
    <b>Tabaco: </b><span style="margin-left: 20px;">{{ $user->tabaco_parsed }}</span><br>
    <b>Alcohol: </b><span style="margin-left: 20px;">{{ $user->alcohol_parsed }}</span><br>
    <b>Holiday: </b><span style="margin-left: 20px;">{{ $user->holiday_parsed }}</span><br>
    <b>Birthplace: </b><span style="margin-left: 20px;">{{ $user->birthplace_parsed }}</span><br>
    <b>Matching Expect:</b><span style="margin-left: 20px;">{{ $user->expect_parsed }}</span><br>
    <b>Hobby: </b><br>
    @foreach ($user['hobbies'] as $hob) 
        <li style="margin-left: 50px;">{{ $hob->hobby_parsed}}</li>
    @endforeach
    
        




