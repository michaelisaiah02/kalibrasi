@extends('layouts.app')

@section('content')
{{-- <style>
    body {
        background-image: url("image/coba.jpeg");
        background-size: 100%;
        background-repeat: no-repeat;
    }
</style> --}}
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h3 class="card-header text-center">LOGIN</h3>
                <div class="card-body">
                    <!-- Form login -->
                    <form action="{{ route('login') }}" method="POST" id="loginForm">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        axios.post('/login', { email, password })
            .then(response => {
                console.log('Login berhasil:', response.data);
                window.location.href = '/'; // Redirect ke halaman dashboard atau home
            })
            .catch(error => {
                console.error('Login gagal:', error.response.data.errors);
                const errors = error.response.data.errors;
                if (errors.email) {
                    document.getElementById('email').classList.add('is-invalid');
                    document.querySelector('#email ~ .invalid-feedback').textContent = errors.email[0];
                }
                if (errors.password) {
                    document.getElementById('password').classList.add('is-invalid');
                    document.querySelector('#password ~ .invalid-feedback').textContent = errors.password[0];
                }
            });
    });
</script>
@endsection
