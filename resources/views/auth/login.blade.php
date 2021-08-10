@extends('layouts.auth')

@section('content')
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Welcome back!</h1>
                            <p class="lead">
                                Sign in to your account to continue
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    {{--                                    <div class="text-center">--}}
                                    {{--                                        <img src="https://i.pravatar.cc/300"--}}
                                    {{--                                             class="img-fluid rounded-circle" width="132" height="132"/>--}}
                                    {{--                                    </div>--}}
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Email</label><input id="email" type="email"
                                                                                          class="form-control @error('email') is-invalid @enderror"
                                                                                          name="email"
                                                                                          value="{{ old('email') }}"
                                                                                          required autocomplete="email"
                                                                                          autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password"
                                                   required autocomplete="current-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
{{--                                            <small>--}}
{{--                                                @if (Route::has('password.request'))--}}
{{--                                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                                        {{ __('Forgot Your Password?') }}--}}
{{--                                                    </a>--}}
{{--                                                @endif--}}
{{--                                            </small>--}}
                                            <small>
                                                <a class="btn btn-link" href="{{ route('register') }}">
                                                    {{ __('Do you need an account?') }}
                                                </a>
                                            </small>
                                        </div>
                                        <div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                            <div class="text-center mt-3">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Login') }}
                                                </button>
                                                <!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
