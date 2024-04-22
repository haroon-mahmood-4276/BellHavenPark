<div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
    <div class="w-px-400 mx-auto">
        <h3 class="mb-1 fw-bold">Welcome to {{ settings('app_name') }}! 👋</h3>
        <p class="mb-4">Please sign-in to your account and start the adventure</p>
        <form id="formAuthentication" class="mb-3" action="{{ route('login.post') }}" method="POST">

            @csrf

            {{ view('layout.alerts') }}

            <div class="mb-3">
                <label class="form-label" style="font-size: 15px" for="email">Email <span
                        class="text-danger">*</span></label>
                <input type="email" class="form-control @error('form.email') is-invalid @enderror" id="email"
                    name="email" placeholder="Email" value="{{ old('form.email') }}" wire:model.blur="form.email" />
                @error('form.email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter email.</small>
                    </p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" style="font-size: 15px" for="password">Password <span
                        class="text-danger">*</span></label>
                <input type="password" class="form-control @error('form.password') is-invalid @enderror" id="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    name="password" value="{{ old('form.password') }}" wire:model.blur="form.password" />
                @error('form.password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter password.</small>
                    </p>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input name="remember" type="hidden" value="0" />
                    <input class="form-check-input" type="checkbox" id="remember" name="remember"
                        wire:model.blur="form.remember" value="1">
                    <label class="form-check-label" for="remember">
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
