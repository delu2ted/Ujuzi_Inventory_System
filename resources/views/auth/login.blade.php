<x-guest-layout>
<div class="row justify-content-center g-0">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header text-center">
                <h4>Login</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label>Email Address</label>
                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" required autofocus autocomplete="username" value="{{ old('email') }}">
                        @error('email') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                        @error('password') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Log in</button>
                    </div>
                    @if (Route::has('password.request'))
                        <div class="text-center mt-3">
                            <a class="btn btn-link text-decoration-none" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        </div>
                    @endif
                    @if (Route::has('register'))
                        <div class="text-center mt-2">
                            <a class="btn btn-link text-decoration-none" href="{{ route('register') }}">
                                Need an account? Register
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
</x-guest-layout>