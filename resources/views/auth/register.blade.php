<x-guest-layout>
<div class="row justify-content-center g-0">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header text-center">
                <h4>Register</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label>Name</label>
                        <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" required autofocus value="{{ old('name') }}">
                        @error('name') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Email Address</label>
                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" required autocomplete="username" value="{{ old('email') }}">
                        @error('email') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
                        @error('password') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required autocomplete="new-password">
                        @error('password_confirmation') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                    @if (Route::has('login'))
                        <div class="text-center mt-3">
                            <a class="btn btn-link text-decoration-none" href="{{ route('login') }}">
                                Already registered? Log in
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
</x-guest-layout>