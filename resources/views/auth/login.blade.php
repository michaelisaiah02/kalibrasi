@extends('layouts.app')

@section('content')
    {{-- <style>
    body {
        background-image: url("image/coba.jpeg");
        background-size: 100%;
        background-repeat: no-repeat;
    }
</style> --}}
    <div class="container" style="margin-top: 30vh">
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="card p-3 bg-primary bg-opacity-50 shadow-sm border-0" style="width: 50rem;">
                    <div class="card-body">
                        <!-- Form login -->
                        <form action="{{ route('login') }}" method="POST" id="loginForm">
                            @csrf
                            <div class="form-floating mb-3 w-50 mx-auto">
                                <input type="text" class="form-control" placeholder="" id="idKaryawan" name="idKaryawan"
                                    value="{{ old('idKaryawan') }}" required autofocus>
                                <label for="idKaryawan">ID Karyawan</label>
                            </div>
                            <div class="form-floating mb-3 w-50 mx-auto">
                                <input type="password" class="form-control" placeholder="" id="password" name="password"
                                    required autocomplete="current-password">
                                <label for="password">Password</label>
                            </div>
                            <div class="row justify-content-center w-50 mx-auto">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary w-100 text-center mb-2 mx-auto">Login</button>
                                <h4 class="text-center fst-italic text-light">Jika gagal login hubungi (IT)</h4>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
