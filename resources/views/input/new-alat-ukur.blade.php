@extends('layouts.app')

@section('styles')
    <style>
        #no-id::placeholder {
            color: white;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        <form action="{{ route('store.alat.ukur') }}" method="POST">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <label class="input-group-text bg-primary text-light" for="nama-alat-ukur">Nama Alat Ukur</label>
                        <select class="form-select" id="nama-alat-ukur" name="tipe_id" required>
                            <option value="" selected>Pilih...</option>
                            @foreach ($alat_ukurs as $alat_ukur)
                                <option value="{{ $alat_ukur->tipe_id }}">{{ $alat_ukur->nama_alat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">No ID / SN</span>
                        <input type="text" aria-label="No ID" placeholder="-"
                            class="form-control bg-primary text-light text-center" name="no_id" id="no-id" readonly
                            required>
                        <input type="text" aria-label="No SN" placeholder="No SN" class="form-control w-25"
                            name="no_sn" id="no-sn" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Standar Ukuran</span>
                        <input type="text" class="form-control" placeholder="Kg / gram / ˚C / mm" id="std_ukuran"
                            name="std_ukuran" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Kapasitas</span>
                        <input type="number" class="form-control" placeholder="Kg / gram / ˚C / mm" id="kapasitas"
                            name="kapasitas" aria-describedby="kapasitas" required>
                        <span class="input-group-text bg-primary text-light w-25 satuan justify-content-center"></span>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Ketelitian</span>
                        <span class="input-group-text bg-primary text-light">±</span>
                        <input type="number" class="form-control" placeholder="± Kg / gram / ˚C / mm" id="ketelitian"
                            name="ketelitian" required>
                        <span class="input-group-text bg-primary text-light w-25 satuan justify-content-center"></span>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Merk</span>
                        <input type="text" class="form-control" id="merk" name="merk" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Tanggal Kalibrasi</span>
                        <input type="date" id="tgl_kalibrasi" name="tgl_kalibrasi" class="form-control"
                            placeholder="dd/mm/yyyy" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Tipe Kalibrasi</span>
                        <select type="text" class="form-select" id="tipe_kalibrasi" name="tipe_kalibrasi" required>
                            <option selected>Pilih...</option>
                            <option value="Internal">Internal</option>
                            <option value="External">External</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">1st Used</span>
                        <input type="date" class="form-control" id="first_used" name="first_used" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Rank</span>
                        <select type="text" class="form-select" id="rank" name="rank" required>
                            <option selected>Pilih...</option>
                            <option value="AA">AA</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                        </select>
                    </div>
                    <div class="input-group mb-5">
                        <span class="input-group-text bg-primary text-light">Freq kalibrasi</span>
                        <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi" required>
                        <span class="input-group-text bg-primary text-light">Tahun</span>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">PIC Pengguna</span>
                        <input type="text" class="form-control" id="pic_pengguna" name="pic_pengguna" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Location</span>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-auto text-center">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Cancel</a>
                </div>
                <div class="col-auto text-center">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-primary">Save & Print</button>
                </div>
            </div>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script type="module">
        $(document).ready(function() {
            $('#nama-alat-ukur').change(function() {
                const tipeId = $(this).val();

                if (tipeId === "") {
                    $('#no_id').val('');
                    return;
                }

                // Ambil jumlah yang sudah ada untuk tipe ini
                $.get(`/count-alat/${tipeId}`, function(data) {
                    console.log(data)
                    const nextNumber = data.count + 1;
                    const paddedNumber = String(nextNumber).padStart(3, '0');
                    const noId = tipeId + '-' + paddedNumber;
                    console.log(noId)
                    $('#no-id').val(noId);
                });
            });
            $('#std_ukuran').on('input', function() {
                var value = $(this).val();
                $('.satuan').text(value);
            });
        });
    </script>
@endsection
