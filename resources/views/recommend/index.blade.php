@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-8">
            <table id="display" class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>email</th>
                        <th>DOB</th>
                        <th>options</th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>
</div>

@endsection

@push('script')

<script>

    

</script>

@endpush