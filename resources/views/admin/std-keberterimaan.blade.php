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
                            <option value="" selected>Choose...</option>
                            {{-- @foreach ($equipments as $equipment)
                              <option value="{{ $equipment->type_id }}">{{ $equipment->name }}</option>
                          @endforeach --}}
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-light">Capacity</span>
                        <input type="number" class="form-control" placeholder="Kg / gram / ˚C / mm" id="capacity"
                            name="capacity" aria-describedby="capacity" required>
                        <span class="input-group-text bg-primary text-light" id="unit"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col col-md-5">
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter 1</span>
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter 2</span>
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter 3</span>
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter 4</span>
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter 5</span>
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                            </div>
                        </div>
                        <div class="col col-md-5">
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter &nbsp; 6</span>
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter &nbsp; 7</span>
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter &nbsp; 8</span>
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter &nbsp; 9</span>
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter 10</span>
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row table-responsive mb-3">
                <table class="table table-sm table-bordered align-middle">
                    <thead class="table-primary">
                        <tr class="align-middle text-center">
                            <th scope="col">No</th>
                            <th scope="col">Name Alat Ukur</th>
                            <th scope="col">Nomor ID</th>
                            <th scope="col">Kapasitas</th>
                            <th scope="col">Ketelitian</th>
                            <th scope="col">Parameter 1</th>
                            <th scope="col">Parameter 2</th>
                            <th scope="col">Parameter 3</th>
                            <th scope="col">Parameter 4</th>
                            <th scope="col">Parameter 5</th>
                            <th scope="col">Parameter 6</th>
                            <th scope="col">Parameter 7</th>
                            <th scope="col">Parameter 8</th>
                            <th scope="col">Parameter 9</th>
                            <th scope="col">Parameter 10</th>
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
            <div class="row justify-content-center">
                <div class="col-6 col-md-auto text-center mb-1 mb-md-0">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="col-12 col-md-auto text-center mb-1 mb-md-0">
                    <button type="button" class="btn btn-primary">Edit</button>
                </div>
                <div class="col-6 col-md-auto text-center mb-1 mb-md-0">
                    <a href="{{ route('dashboard', ['key' => 'master-data']) }}" class="btn btn-primary">Close</a>
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
