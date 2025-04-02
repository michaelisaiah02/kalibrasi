@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h3 class="card-header text-center">DAFTAR USER BARU</h3>
                    <div class="card-body">
                        <!-- Form register -->
                        <form action="{{ route('register') }}" method="POST" id="registerForm">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Peran</label>
                                <select name="role" id="role"
                                    class="form-select @error('role') is-invalid @enderror" required>
                                    <option disabled selected>Pilih peran</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="guest" {{ old('role') == 'guest' ? 'selected' : '' }}>Tamu</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center align-content-end" style="height: 30vh">
        <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('dashboard') }}">Kembali Ke Dashboard</a>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const role = document.getElementById('role').value;

            axios.post('/register', {
                    name,
                    email,
                    password,
                    role
                })
                .then(response => {
                    console.log('Daftar berhasil:', response.data);
                    window.location.href = '/dashboard'; // Redirect ke halaman dashboard atau home
                })
                .catch(error => {
                    console.error('Daftar gagal:', error.response.data.errors);
                    const errors = error.response.data.errors;
                    if (errors.name) {
                        document.getElementById('name').classList.add('is-invalid');
                        document.querySelector('#name ~ .invalid-feedback').textContent = errors.name[0];
                    }
                    if (errors.email) {
                        document.getElementById('email').classList.add('is-invalid');
                        document.querySelector('#email ~ .invalid-feedback').textContent = errors.email[0];
                    }
                    if (errors.password) {
                        document.getElementById('password').classList.add('is-invalid');
                        document.querySelector('#password ~ .invalid-feedback').textContent = errors.password[
                            0];
                    }
                    if (errors.role) {
                        document.getElementById('role').classList.add('is-invalid');
                        document.querySelector('#role ~ .invalid-feedback').textContent = errors.role[0];
                    }
                });
        });
    </script>
@endsection
