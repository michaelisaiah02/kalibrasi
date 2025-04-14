@extends('layouts.app')

@section('styles')
    <style>
        #id-num::placeholder {
            color: white;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-1 mt-md-3">
        <form action="{{ route('store.equipment') }}" method="POST">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">ID / SN Number</span>
                        <input type="text" aria-label="ID Num" placeholder="-" class="form-control text-light text-center"
                            name="id_num" id="id-num" required>
                        <input type="text" aria-label="SN Num" placeholder="SN Num" class="form-control w-25 text-center"
                            id="sn-num" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text bg-primary text-light" for="equipment_name">Equipment Name</label>
                        <input type="text" aria-label="SN Num" placeholder="NEW ALAT UKUR"
                            class="form-control w-25 text-center" id="equipment_name" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Capacity</span>
                        <input type="number" class="form-control" placeholder="auto" id="capacity"
                            aria-describedby="capacity" disabled>
                        <span class="input-group-text bg-primary text-light" id="unit"></span>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Merk</span>
                        <input type="text" class="form-control" id="merk" placeholder="auto" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Problem Date</span>
                        <input type="date" class="form-control" id="problem_date" name="problem_date" required>
                        <span class="input-group-text bg-primary text-light">Repair Date</span>
                        <input type="text" class="form-control" id="repair_date" name="repair_date"
                            value="{{ now()->isoFormat('D MMMM Y') }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">PIC</span>
                        <input type="text" class="form-control" id="pic" placeholder="Nama" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Location</span>
                        <input type="text" class="form-control" id="location" placeholder="auto" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Problem</span>
                        <input type="text" class="form-control" id="problem" name="problem" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Countermeasure</span>
                        <input type="text" class="form-control" id="countermeasure" name="countermeasure" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Judgement</span>
                        <select class="form-select" id="judgement" name="judgement" required>
                            <option selected disabled>OK / NG / Disposal</option>
                            <option value="OK">OK</option>
                            <option value="NG">NG</option>
                            <option value="Disposal">Disposal</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row table-responsive mb-1">
                <table class="table table-sm table-bordered align-middle">
                    <thead class="table-primary">
                        <tr class="align-middle text-center">
                            <th scope="col">No ID</th>
                            <th scope="col">Equipment Name</th>
                            <th scope="col">Capacity</th>
                            <th scope="col">Merk</th>
                            <th scope="col">Repair Date</th>
                            <th scope="col">PIC</th>
                            <th scope="col">Location</th>
                            <th scope="col">Problem</th>
                            <th scope="col">Countermeasure</th>
                            <th scope="col">Judgement</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row justify-content-end">
                <div class="col-6 col-md-auto text-center mb-1 mb-md-0">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="col-12 col-md-auto text-center mb-1 mb-md-0">
                    <button type="button" class="btn btn-primary">Edit</button>
                </div>
                <div class="col-6 col-md-auto text-center mb-1 mb-md-0">
                    <a href="{{ route('dashboard', ['key' => 'menu-input']) }}" class="btn btn-primary">Close</a>
                </div>
                <div class="col-6 col-md-auto text-center mb-1 mb-md-0">
                    <button type="button" class="btn btn-primary">Print Report</button>
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
