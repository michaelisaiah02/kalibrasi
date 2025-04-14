@extends('layouts.app')

@section('styles')
    <style>
        body {
            background-image: url("image/bg.jpeg");
            background-size: 100%;
            background-repeat: no-repeat;
        }
    </style>
@endsection

@section('content')
    <div class="container" style="margin-top: 25vh">
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="card bg-primary bg-opacity-50 shadow-sm border-0 rounded-5">
                    <div class="card-body">
                        <!-- Form login -->
                        <form action="{{ route('login') }}" method="POST" id="loginForm">
                            @csrf
                            <div class="form-floating mb-3 mx-auto">
                                <input type="text" class="form-control text-center" placeholder="" id="idKaryawan"
                                    name="idKaryawan" value="{{ old('idKaryawan') }}" required autofocus>
                                <label for="idKaryawan">ID Karyawan</label>
                            </div>
                            <div class="form-floating mb-3 mx-auto">
                                <input type="password" class="form-control text-center" placeholder="" id="password"
                                    name="password" required autocomplete="current-password">
                                <label for="password">Password</label>
                            </div>
                            <div class="row justify-content-center mx-auto">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary text-center mb-2 mx-auto">Login</button>
                                <p class="text-center fst-italic text-light">Jika gagal login hubungi (IT)</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
