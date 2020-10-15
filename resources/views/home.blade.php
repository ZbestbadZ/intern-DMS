@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center pt-5 pb-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">DMS management</div>

                <div class="card-body">
                    <div class="row d-block">
                    <div class="col"><span><a href="{{url('/admin/list_user')}}">Users</a></span></div>
                        <div class="col"><span><a href="{{url('/pickup')}}">Pickup Users</a></span></div>
                        <div class="col"><span><a href="{{url('/recommend')}}">Recomended Users</a></span></div>
                        <div class="col"><span><a href="{{url('/sticker')}}">Stickers</a></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
