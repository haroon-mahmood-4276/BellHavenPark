@extends('auth.layout')

@section('content')
    <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
        <div class="w-px-400 mx-auto">
            <h3 class="mb-1 fw-bold">Welcome to {{ settings('app_name') }}! 👋</h3>
            <p class="mb-4">Please sign-in to your account and start the adventure</p>
            <form id="formAuthentication" class="mb-3" action="{{ route('login.post') }}" method="POST">

                @csrf

                {{ view('layout.alerts') }}

                <div class="mb-3">
                    <label for="email" class="form-label">Email or Username</label>
                    <input type="text" class="form-control" id="email" name="email"
                        placeholder="Enter your email or username" autofocus>
                </div>
                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">Password</label>
                    </div>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input id="remember" name="remember" type="hidden" value="0" />
                        <input class="form-check-input" type="checkbox" id="remember-me" name="remember" value="1">
                        <label class="form-check-label" for="remember-me">
                            Remember Me
                        </label>
                    </div>
                </div>
                <button class="btn btn-primary d-grid w-100">
                    Sign in
                </button>
            </form>
        </div>
    </div>
@endsection
