<style>
    td.bold {
        font-weight: bold;
    }
    td.italic {
       font-style: italic;
    }
</style>
<table class="table table-striped table-hover">
    <tbody>
        <tr>
            <td class="bold">Name</td>
            <td class="italic">{{ $user->name }}</td>         
        </tr>
        <tr>
            <td class="bold">Gender</td>
            <td class="italic">{{ $user->sex_parsed }}</td>         
        </tr>
        <tr>
            <td class="bold">Address</td>
            <td class="italic">{{ $user->address }}</td>         
        </tr>
        <tr>
            <td class="bold">Phone</td>
            <td class="italic">{{ $user->phone }}</td>         
        </tr>
        <tr>
            <td class="bold">Email</td>
            <td class="italic">{{ $user->email }}</td>         
        </tr>
        <tr>
            <td class="bold">About</td>
            <td class="italic">{{ $user->about }}</td>         
        </tr>
        <tr>
            <td class="bold">About Title</td>
            <td class="italic">{{ $user->about_title }}</td>         
        </tr>
        <tr>
            <td class="bold">Birthday</td>
            <td class="italic">{{ $user->birthday->format('d/m/Y') }}</td>         
        </tr>
        <tr>
            <td class="bold">Username</td>
            <td class="italic">{{ $user->username }}</td>         
        </tr>
        <tr>
            <td class="bold">Aca Background</td>
            <td class="italic">{{ $user->aca_parsed }}</td>         
        </tr>
        <tr>
            <td class="bold">Job</td>
            <td class="italic">{{ $user->job_parsed }}</td>         
        </tr>
        <tr>
            <td class="bold">Anual Income</td>
            <td class="italic">{{ $user->income_parsed }}</td>         
        </tr>
        <tr>
            <td class="bold">Figure</td>
            <td class="italic">{{ $user->figure_parsed }}</td>         
        </tr>
        <tr>
            <td class="bold">Height</td>
            <td class="italic">{{ $user->height_parsed }}</td>         
        </tr>
        <tr>
            <td class="bold">Tabaco</td>
            <td class="italic">{{ $user->tabaco_parsed }}</td>         
        </tr>
        <tr>
            <td class="bold">Alcohol</td>
            <td class="italic">{{ $user->alcohol_parsed }}</td>         
        </tr>
        <tr>
            <td class="bold">Holiday</td>
            <td class="italic">{{ $user->holiday_parsed }}</td>         
        </tr>
        <tr>
            <td class="bold">Birthplace</td>
            <td class="italic">{{ $user->birthplace_parsed }}</td>         
        </tr>
        <tr>
            <td class="bold">Matching Expect</td>
            <td class="italic">{{ $user->expect_parsed }}</td>         
        </tr>
        <tr>
            <td class="bold">Hobby</td>
            <td class="italic">@foreach ($user['hobbies'] as $hob) 
                <li>{{ $hob->hobby_parsed}}</li>
            @endforeach</td>         
        </tr>

    </tbody>
</table>
    
        




