@extends('auth.layout')

@section('content')
    <div class="app-content content ">

        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>

        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <div class="auth-wrapper auth-basic px-2">
                    <div class="auth-inner my-2">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="javascript:void(0);" class="brand-logo">
                                    <h2 class="brand-text text-primary ms-1">{{ getSettings('site_name') }}</h2>
                                </a>

                                <h4 class="card-title mb-1">Welcome to {{ getSettings('site_name') }}! 👋</h4>
                                <p class="card-text mb-2">Please sign-in to your account.</p>

                                <form class="auth-login-form mt-2" action="{{ route('auth.login') }}" method="POST">
                                    @csrf
                                    <div class="mb-1">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="john@example.com" aria-describedby="email"
                                            tabindex="1" autofocus />

                                        @error('email')
                                            <span class="ml-25 invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="password">Password</label>
                                            {{-- <a href="{{ route('admin.auth.password.request') }}">--}}
                                            {{--     <small>Forgot Password?</small>--}}
                                            {{-- </a>--}}
                                        </div>

                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" tabindex="2"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" />
                                        @error('password')
                                            <div class="ml-25 invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-1"> &nbsp;
{{--                                        <div class="form-check">--}}
{{--                                            <input class="form-check-input" type="checkbox" id="remember" name="remember" tabindex="3" />--}}
{{--                                            <label class="form-check-label" for="remember"> Remember Me </label>--}}
{{--                                        </div>--}}
                                    </div>
                                    <button class="btn btn-primary w-100" type="submit" tabindex="4">Sign in</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
