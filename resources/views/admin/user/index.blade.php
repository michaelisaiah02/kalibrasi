@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row justify-content-between">
                    <div class="col-auto">
                        <h3 class="text-center">Manajemen User</h3>
                    </div>
                    <div class="col-auto ms-auto">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Cari Username" aria-label="Username">
                        </div>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('admin.users.register') }}" class="btn btn-primary">Tambah User Baru</a>
                    </div>
                </div>
                <!-- Tampilkan data sesuai dengan kebutuhan -->
                <div class="row table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Karyawan</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->idKaryawan }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        @if (Auth::user()->role === 'admin')
                                            <a href="/edit-user/{{ $user->id }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="/delete-user/{{ $user->id }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary shadow-lg px-5" id="back"
                            data-target="back">Save</button>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('dashboard', ['key' => 'master-data']) }}"
                            class="btn btn-primary shadow-lg px-5">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
