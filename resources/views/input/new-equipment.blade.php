@extends('layouts.app')

@section('styles')
    <style>
        #id-num::placeholder {
            color: white;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        <form action="{{ route('store.equipment') }}" method="POST">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <label class="input-group-text bg-primary text-light" for="equipment_name">Equipment Name</label>
                        <select class="form-select" id="equipment_name" name="type_id" required>
                            <option value="" selected>Pilih...</option>
                            @foreach ($equipments as $equipment)
                                <option value="{{ $equipment->type_id }}">{{ $equipment->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">ID / SN Number</span>
                        <input type="text" aria-label="ID Num" placeholder="-"
                            class="form-control bg-primary text-light text-center" name="id_num" id="id-num" readonly
                            required>
                        <input type="text" aria-label="SN Num" placeholder="SN Num" class="form-control w-25"
                            name="sn_num" id="sn-num" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-primary text-light">Capacity</span>
                                <input type="number" class="form-control" placeholder="Kg / gram / ˚C / mm" id="capacity"
                                    name="capacity" aria-describedby="capacity" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-primary text-light">Accuracy</span>
                                <span class="input-group-text bg-primary text-light">±</span>
                                <input type="number" class="form-control" placeholder="± Kg / gram / ˚C / mm"
                                    id="accuracy" name="accuracy" required>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="input-group mb-3 h-100 pb-3">
                                <select class="form-select" id="unit" name="unit" required>
                                    <option value="" selected>Satuan</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Merk</span>
                        <input type="text" class="form-control" id="merk" name="merk" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Calibration Type</span>
                        <select class="form-select" id="calibration_type" name="calibration_type" required>
                            <option selected>Pilih...</option>
                            <option value="Internal">Internal</option>
                            <option value="External">External</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">1st Used</span>
                        <input type="date" class="form-control" id="first_used" name="first_used" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Rank</span>
                        <select class="form-select" id="rank" name="rank" required>
                            <option selected>AA, A, B, C</option>
                            <option value="AA">AA</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Calibration Freq</span>
                        <input type="number" class="form-control" id="calibration_freq" name="calibration_freq" required>
                        <span class="input-group-text bg-primary text-light">Month</span>
                    </div>
                    <div class="input-group mb-5">
                        <span class="input-group-text bg-primary text-light">Standard Keberterimaan</span>
                        <input type="text" class="form-control" id="acceptance_criteria" name="acceptance_criteria"
                            required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">PIC</span>
                        <input type="text" class="form-control" id="pic" name="pic" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Location</span>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-auto text-center">
                    <a href="{{ route('dashboard', ['key' => 'menu-input']) }}" class="btn btn-primary">Cancel</a>
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
            $('#equipment_name').change(function() {
                const tipeId = $(this).val();

                if (tipeId === "") {
                    $('#id_num').val('');
                    return;
                }

                // Ambil jumlah yang sudah ada untuk tipe ini
                $.get(`/count-alat/${tipeId}`, function(data) {
                    const nextNumber = data.count + 1;
                    const paddedNumber = String(nextNumber).padStart(3, '0');
                    const noId = tipeId + '-' + paddedNumber;
                    $('#id-num').val(noId);
                });
            });
        });
    </script>
@endsection
