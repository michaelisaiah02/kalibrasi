@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <label class="input-group-text bg-primary text-light" for="inputGroupSelect01">Nama Alat Ukur</label>
                    <select class="form-select" id="inputGroupSelect01">
                        <option selected>Pilih...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-primary text-light">No ID / SN</span>
                    <input type="text" aria-label="No ID" placeholder="No ID" class="form-control">
                    <input type="text" aria-label="No SN" placeholder="No SN" class="form-control">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-primary text-light" id="basic-addon3">Kapasitas</span>
                    <input type="text" class="form-control" placeholder="Kg / gram / ˚C / mm" id="basic-url"
                        aria-describedby="basic-addon3 basic-addon4">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-primary text-light">Ketelitian</span>
                    <input type="text" class="form-control" placeholder="± Kg / gram / ˚C / mm">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-primary text-light">Standar Ukuran</span>
                    <input type="text" class="form-control" placeholder="Kg / gram / ˚C / mm">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-primary text-light">Merk</span>
                    <input type="text" class="form-control">
                </div>

                {{-- <div class="card">
                    <h3 class="card-header text-center">INPUT NEW ALAT UKUR</h3>
                    <div class="card-body">
                        <!-- Form input new alat ukur -->
                        <form action="{{ route('input.new.alat.ukur') }}" method="POST" id="newAlatUkurForm">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_alat_ukur" class="form-label">Nama Alat Ukur</label>
                                    <input type="text" class="form-control @error('nama_alat_ukur') is-invalid @enderror"
                                        id="nama_alat_ukur" name="nama_alat_ukur" value="{{ old('nama_alat_ukur') }}"
                                        required autofocus>
                                    @error('nama_alat_ukur')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="pic_pengguna" class="form-label">PIC Pengguna</label>
                                    <input type="text" class="form-control @error('pic_pengguna') is-invalid @enderror"
                                        id="pic_pengguna" name="pic_pengguna" value="{{ old('pic_pengguna') }}" required>
                                    @error('pic_pengguna')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="nomor_id_sn" class="form-label">Nomor ID/SN</label>
                                    <input type="text" class="form-control @error('nomor_id_sn') is-invalid @enderror"
                                        id="nomor_id_sn" name="nomor_id_sn" value="{{ old('nomor_id_sn') }}" required>
                                    @error('nomor_id_sn')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="tgl_kalibrasi" class="form-label">Due Date Kalibrasi</label>
                                    <input type="date" class="form-control @error('tgl_kalibrasi') is-invalid @enderror"
                                        id="tgl_kalibrasi" name="tgl_kalibrasi" value="{{ old('tgl_kalibrasi') }}" required>
                                    @error('tgl_kalibrasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="kapasitas" class="form-label">Kapasitas</label>
                                    <input type="text" class="form-control @error('kapasitas') is-invalid @enderror"
                                        id="kapasitas" name="kapasitas" value="{{ old('kapasitas') }}" required>
                                    @error('kapasitas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="tipe_kalibrasi" class="form-label">Tipe Kalibrasi</label>
                                    <select name="tipe_kalibrasi" id="tipe_kalibrasi"
                                        class="form-select @error('tipe_kalibrasi') is-invalid @enderror" required>
                                        <option disabled selected>Pilih tipe kalibrasi</option>
                                        <option value="Internal"
                                            {{ old('tipe_kalibrasi') == 'Internal' ? 'selected' : '' }}>Internal</option>
                                        <option value="External"
                                            {{ old('tipe_kalibrasi') == 'External' ? 'selected' : '' }}>External</option>
                                    </select>
                                    @error('tipe_kalibrasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="ketelitian" class="form-label">Ketelitian</label>
                                    <input type="text" class="form-control @error('ketelitian') is-invalid @enderror"
                                        id="ketelitian" name="ketelitian" value="{{ old('ketelitian') }}" required>
                                    @error('ketelitian')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="merk" class="form-label">Merk</label>
                                    <input type="text" class="form-control @error('merk') is-invalid @enderror"
                                        id="merk" name="merk" value="{{ old('merk') }}" required>
                                    @error('merk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="freq_kalibrasi" class="form-label">Freq Kalibrasi</label>
                                    <select name="freq_kalibrasi" id="freq_kalibrasi"
                                        class="form-select @error('freq_kalibrasi') is-invalid @enderror" required>
                                        <option disabled selected>Pilih frekuensi kalibrasi</option>
                                        <option value="1x/thn" {{ old('freq_kalibrasi') == '1x/thn' ? 'selected' : '' }}>
                                            1x/thn</option>
                                        <option value="3x/thn" {{ old('freq_kalibrasi') == '3x/thn' ? 'selected' : '' }}>
                                            3x/thn</option>
                                    </select>
                                    @error('freq_kalibrasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                        id="location" name="location" value="{{ old('location') }}" required>
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div> --}}
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-primary text-light">Tanggal Kalibrasi</span>
                    <input type="date" id="tgl_kalibrasi" class="form-control" placeholder="dd/mm/yyyy">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-primary text-light">Tipe Kalibrasi</span>
                    <select type="text" class="form-select">
                        <option selected>Pilih...</option>
                        <option value="internal">Internal</option>
                        <option value="external">External</option>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-primary text-light">1st Used</span>
                    <input type="date" class="form-control">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-primary text-light">Rank</span>
                    <select type="text" class="form-select">
                        <option selected>Pilih...</option>
                        <option value="AA">AA</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </select>
                </div>
                <div class="input-group mb-5">
                    <span class="input-group-text bg-primary text-light">Freq kalibrasi</span>
                    <input type="number" class="form-control">
                    <span class="input-group-text bg-primary text-light">Tahun</span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-primary text-light">PIC Pengguna</span>
                    <input type="text" class="form-control">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-primary text-light">Location</span>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     flatpickr("#tgl_kalibrasi", {
        //         locale: "id",
        //         altInput: true,
        //         altFormat: "d/m/Y",
        //         dateFormat: "Y-m-d"
        //     });
        // });
    </script>
@endsection
