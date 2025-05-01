@extends('layouts.app')

@section('styles')
    <style>
        /* #id-num::placeholder {
                                                                                                                                                                                                                                                color: white;
                                                                                                                                                                                                                                            } */
    </style>
@endsection

@section('content')
    <div class="container mt-1 mt-md-3">
        <form action="{{ route('store.repair.data') }}" method="POST">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">ID / SN Number</span>
                        <input type="text" aria-label="ID Num" placeholder="-"
                            class="form-control text-center @error('id_num') is-invalid @enderror {{ old('id_num') ? 'is-valid' : '' }}"
                            name="id_num" id="id-num" value="{{ old('id_num') }}" required>
                        <input type="text" aria-label="SN Num" placeholder="SN Num" class="form-control w-25 text-center"
                            id="sn-num" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text bg-primary text-light" for="equipment-name">Equipment Name</label>
                        <input type="text" aria-label="SN Num" placeholder="NEW ALAT UKUR"
                            class="form-control w-25 text-center" id="equipment-name" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Capacity</span>
                        <input type="text" class="form-control" placeholder="auto" id="capacity"
                            aria-describedby="capacity" disabled>
                        <span class="input-group-text bg-primary text-light" id="unit"></span>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Brand</span>
                        <input type="text" class="form-control" id="brand" placeholder="auto" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Problem Date</span>
                        <input type="date"
                            class="form-control @error('problem_date') is-invalid @enderror {{ old('problem_date') ? 'is-valid' : '' }}"
                            id="problem-date" name="problem_date" value="{{ old('problem_date') }}" required>
                        <span class="input-group-text bg-primary text-light">Repair Date</span>
                        <input type="text" class="form-control" id="repair-date" name="repair_date"
                            value="{{ now() }}" hidden>
                        <input type="text" class="form-control" id="repair-date-display"
                            value="{{ now()->isoFormat('D MMMM Y') }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">PIC</span>
                        <input type="text" class="form-control" id="pic" placeholder="Name" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Location</span>
                        <input type="text" class="form-control" id="location" placeholder="auto" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Problem</span>
                        <input type="text"
                            class="form-control @error('problem') is-invalid @enderror {{ old('problem') ? 'is-valid' : '' }}"
                            id="problem" name="problem" value="{{ old('problem') }}" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Countermeasure</span>
                        <input type="text"
                            class="form-control @error('countermeasure') is-invalid @enderror {{ old('countermeasure') ? 'is-valid' : '' }}"
                            id="countermeasure" name="countermeasure" value="{{ old('countermeasure') }}" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Judgement</span>
                        <select class="form-select" id="judgement" name="judgement" required>
                            <option disabled>OK / NG / Disposal</option>
                            <option value="OK">OK</option>
                            <option value="NG">NG</option>
                            <option value="Disposal">Disposal</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row table-responsive mb-1">
                <table class="table table-sm table-bordered align-middle text-nowrap">
                    <thead class="table-primary">
                        <tr class="align-middle text-center">
                            <th scope="col">No ID</th>
                            <th scope="col">Equipment Name</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Problem Date</th>
                            <th scope="col">Repair Date</th>
                            <th scope="col">Location</th>
                            <th scope="col">Problem</th>
                            <th scope="col">Countermeasure</th>
                            <th scope="col">Judgement</th>
                            <th scope="col">PIC Repair</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($repairs as $repair)
                            <tr>
                                <td>{{ $repair->id_num }}</td>
                                <td>{{ $repair->masterList->equipment->name }}</td>
                                <td>{{ $repair->masterList->brand }}</td>
                                <td>{{ $repair->problem_date }}</td>
                                <td>{{ $repair->repair_date->format('j M Y') }}</td>
                                <td>{{ $repair->masterList->location }}</td>
                                <td>{{ $repair->problem }}</td>
                                <td>{{ $repair->countermeasure }}</td>
                                <td>{{ $repair->judgement }}</td>
                                <td>{{ $repair->pic_repair }}</td>
                            </tr>
                        @endforeach
                        @if ($repairs->isEmpty())
                            <tr>
                                <td colspan="10" class="text-center">No data available</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="row justify-content-end">
                <div class="col-6 col-md-auto text-center mb-1 mb-md-0">
                    <a href="{{ route('dashboard', ['key' => 'menu-input']) }}" class="btn btn-primary">Close</a>
                </div>
                <div class="col-6 col-md-auto text-center mb-1 mb-md-0">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="col-6 col-md-auto text-center mb-1 mb-md-0">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#repairModal">Show All Data</button>
                </div>
                <div class="col-6 col-md-auto text-center mb-1 mb-md-0">
                    <button type="button" class="btn btn-primary">Print Report</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Repair Modal -->
    <div class="modal fade" id="repairModal" tabindex="-1" aria-labelledby="repairModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">All Calibration Data</h5>
                    <input type="text" class="form-control w-25 ms-3" placeholder="Cari..." id="search-table">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-0 m-0">
                    <table class="table table-sm table-bordered align-middle" id="modal-table">
                        <thead class="table-primary sticky-top">
                            <tr class="align-middle text-center">
                                <th scope="col">ID Num</th>
                                <th scope="col">Equipment Name</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Problem Date</th>
                                <th scope="col">Repair Date</th>
                                <th scope="col">Location</th>
                                <th scope="col">Problem</th>
                                <th scope="col">Countermeasure</th>
                                <th scope="col">Judgement</th>
                                <th scope="col">PIC Repair</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($repairs as $repair)
                                <tr>
                                    <td><button class="btn btn-primary btn-select-id" data-id="{{ $repair->id_num }}"
                                            data-bs-dismiss="modal">{{ $loop->iteration }}</button></td>
                                    <td>{{ $repair->calibration_date }}</td>
                                    <td>{{ $repair->id_num }} / {{ $repair->masterList->sn_num }}</td>
                                    <td>{{ $repair->masterList->equipment->name }}</td>
                                    <td>{{ $repair->masterList->capacity }} {{ $repair->masterList->unit->unit }}</td>
                                    <td>± {{ $repair->masterList->accuracy }} {{ $repair->masterList->unit->unit }}</td>
                                    <td>{{ $repair->masterList->brand }}</td>
                                    <td>{{ $repair->masterList->location }}</td>
                                    <td>{{ $repair->masterList->pic }}</td>
                                    <td>{{ $repair->masterList->calibration_type }}</td>
                                    <td>{{ $repair->masterList->rank }}</td>
                                    <td>{{ $repair->masterList->calibration_freq }}</td>
                                    <td>{{ $repair->masterList->acceptance_criteria }}</td>
                                    <td>{{ $repair->judgement }}</td>
                                    <td><button class="btn btn-primary">Show</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-toast />
@endsection

@section('scripts')
    <script type="module">
        const $input = $('#id-num');
        let debounceTimer;
        let currentAjax = null;

        function fetchMasterList(idNum) {
            // Cancel request sebelumnya kalau masih berjalan
            if (currentAjax) currentAjax.abort();

            currentAjax = $.ajax({
                url: `/get-masterlist/${idNum}`,
                method: 'GET',
                success: function(data) {
                    $('#sn-num').val(data.sn_num);
                    $('#equipment-name').val(data.equipment_name);
                    $('#capacity').val(data.capacity);
                    $('#unit').text(data.unit);
                    $('#brand').val(data.brand);
                    $('#location').val(data.location);
                    $('#pic').val(data.pic);
                },
                error: function(xhr) {
                    if (xhr.status !== 0) {
                        // tampilkan error hanya jika bukan karena abort
                        $('#sn-num').val('Data Tidak Ditemukan');
                        $('#equipment-name').val('');
                        $('#capacity').val('');
                        $('#unit').text('');
                        $('#brand').val('');
                        $('#pic').val('');
                        $('#location').val('');
                    }
                }
            });
        }

        $input.on('input', function() {
            const val = $(this).val().trim();
            clearTimeout(debounceTimer);

            // validasi minimal 5 karakter misalnya, atau harus ada dash kayak TIM-001
            if (val.length < 6) return;

            debounceTimer = setTimeout(() => {
                fetchMasterList(val);
            }, 500); // hanya tunggu setengah detik, cukup responsif dan aman
        });

        // Deteksi Enter atau blur sebagai final trigger juga
        $input.on('blur keydown', function(e) {
            if (e.type === 'blur' || e.key === 'Enter') {
                const val = $(this).val().trim();
                if (val.length >= 6) {
                    clearTimeout(debounceTimer);
                    fetchMasterList(val);
                }
            }
        });

        $(document).ready(function() {
            if ($input.val().trim().length === 7) {
                fetchMasterList($input.val().trim());
            }
        })

        $(document).on('click', '.btn-select-id', function() {
            const selectedId = $(this).data('id');

            // trigger autofill
            $('#id-num').val(selectedId).trigger('input');

            // highlight baris terpilih
            $('.table tbody tr').removeClass('selected-row'); // reset
            $(this).closest('tr').addClass('selected-row'); // tandai baris aktif
        });


        // Optional: search bar real-time di modal
        $('#search-table').on('input', function() {
            const keyword = $(this).val().toLowerCase();
            $('#modal-table tbody tr').each(function() {
                const rowText = $(this).text().toLowerCase();
                $(this).toggle(rowText.includes(keyword));
            });
        });
    </script>
@endsection
