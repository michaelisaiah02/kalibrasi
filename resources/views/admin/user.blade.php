@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row justify-content-between">
                    <div class="col-auto">
                        <h3 class="text-center">Daftar User</h3>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('register') }}" class="btn btn-primary float-right">Tambah User Baru</a>
                    </div>
                </div>
                <!-- Tampilkan data sesuai dengan kebutuhan -->
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
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
