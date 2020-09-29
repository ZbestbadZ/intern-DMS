@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center " style="padding-top: 10%">
        <div class="col-md-8">
            <div class="card border-0" style="border: 0px; background-color: transparent ">
                
                <div style="background-color: transparent; border: none;"  class="card-header d-flex justify-content-center">
                    <span>Login here</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        @if ($errors)
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                          </div>
                        @endif
                        <div class="form-group row d-flex justify-content-center">
                            
                            
                            <div class=" col-md-6  d-flex justify-content-center  ">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1"><i  class="fas fa-envelope"></i></span>
                                    </div>
                                    <input id="username" placeholder="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"  autocomplete="username" autofocus aria-describedby="basic-addon1">
                                </div>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row d-flex justify-content-center">
                            
                            <div class="col-md-6 d-inline">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1"><i  class="fas fa-envelope"></i></span>
                                    </div>
                                    <input id="password" placeholder="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password aria-describedby="basic-addon1">
                                </div>
                            
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 d-flex justify-content-center">
                            <div class="col-md-8  d-flex justify-content-end">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link pr-0" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0 d-flex justify-content-center">
                            <div class="col-md-8 d-flex justify-content-center">
                                <button type="submit" style="background-color: transparent; color: red; border: solid 5px white" class="rounded btn btn-primary">
                                    SA
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
