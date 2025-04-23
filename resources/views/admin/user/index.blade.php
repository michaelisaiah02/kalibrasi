@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-md-between justify-content-center align-items-center mb-3">
            <div class="col-auto">
                <h3 class="mb-0">Manajemen User</h3>
            </div>
            <div class="col-auto ms-md-auto my-2 my-md-0">
                <input type="search" class="form-control" placeholder="Cari Username" id="search-user">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal" id="btn-add-user">
                    Tambah User Baru
                </button>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-striped" id="user-table">
                <thead class="table-primary">
                    <tr class="text-center">
                        <th>ID Karyawan</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Registered</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="text-center">
                            <td>{{ $user->idKaryawan }}</td>
                            <td class="text-start">{{ $user->name }}</td>
                            <td>
                                @if ($user->role === 'admin')
                                    <i class="bi bi-person-gear"></i> Admin
                                @elseif ($user->role === 'user')
                                    <i class="bi bi-person"></i> User
                                @else
                                    <i class="bi bi-person-badge"></i> Guest
                                @endif
                            <td>{{ $user->created_at->format('j M Y H:i') }}</td>
                            {{-- <td>{{ $user->created_at->diffForHumans() }}</td> --}}
                            {{-- <td>{{ $user->created_at->diffInDays() }} hari yang lalu</td> --}}
                            <td class="text-center">
                                @if (Auth::user()->role === 'admin')
                                    <button class="btn btn-sm btn-primary btn-edit-user" data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}" data-idkaryawan="{{ $user->idKaryawan }}"
                                        data-role="{{ $user->role }}">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger btn-delete-user" data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}" data-bs-toggle="modal"
                                        data-bs-target="#deleteUserModal">
                                        Hapus
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($users->isEmpty())
            <div class="alert alert-info text-center" role="alert">
                Tidak ada data user.
            </div>
        @endif
        <div class="row justify-content-end mb-2">
            <div class="col-auto">
                <a href="{{ route('dashboard', ['key' => 'master-data']) }}" class="btn btn-primary">Close</a>
            </div>
            <div class="col-auto">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit User -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content needs-validation" method="POST" id="userForm" novalidate>
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="user-id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div class="invalid-feedback">Nama wajib diisi.</div>
                    </div>
                    <div class="mb-3">
                        <label for="idKaryawan" class="form-label">ID Karyawan</label>
                        <input type="text" class="form-control" id="idKaryawan" name="idKaryawan" minlength="5"
                            maxlength="5" required>
                        <div class="invalid-feedback">ID Karyawan harus 5 karakter.</div>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="" disabled selected>Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="guest">Guest</option>
                        </select>
                        <div class="invalid-feedback">Role wajib dipilih.</div>
                    </div>
                    <div class="mb-3" id="password-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" minlength="6">
                        <div class="invalid-feedback">Password minimal 6 karakter.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Hapus User -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="deleteUserForm" class="modal-content">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserModalLabel">Hapus User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus user <strong id="deleteUserName"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
    <x-toast />
@endsection

@section('scripts')
    <script type="module">
        $(document).ready(function() {
            // Tambah User
            $('#btn-add-user').click(function() {
                $('#userForm').trigger('reset');
                $('#userModalLabel').text('Tambah User');
                $('#userForm').attr('action', "{{ route('admin.users.store') }}");
                $('#password-group').show();
            });

            // Edit User
            $('.btn-edit-user').click(function() {
                const id = $(this).data('id');
                $('#user-id').val(id);
                $('#name').val($(this).data('name'));
                $('#idKaryawan').val($(this).data('idkaryawan'));
                $('#role').val($(this).data('role'));
                $('#password').val('');
                $('#userModalLabel').text('Edit User');
                $('#password-group').hide();
                $('#userForm').attr('action', `{{ url('admin/users/update-user') }}/${id}`);
                new bootstrap.Modal(document.getElementById('userModal')).show();
            });

            // Delete User
            $('.btn-delete-user').click(function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                $('#deleteUserForm').attr('action', `{{ url('admin/users/delete-user') }}/${id}`);
                $('#deleteUserName').text(name);
            });

            // Form Validation
            $('.needs-validation').on('submit', function(e) {
                if (!this.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                $(this).addClass('was-validated');
            });

            // Search Filter
            $('#search-user').on('keyup', function() {
                const value = $(this).val().toLowerCase();
                $('#user-table tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
@endsection
