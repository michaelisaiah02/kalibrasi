@extends('layouts.app')

@section('content')
    <div class="container mt-1 mt-md-3">
        <form action="{{ route('store.equipment') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center mb-2">
                <div class="col-md-6">
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text bg-primary text-light">ID / SN Number</span>
                        <input type="text" aria-label="No ID" placeholder="-" class="form-control text-center"
                            name="no_id" id="no-id" required>
                        <input type="text" aria-label="No SN" placeholder="No SN" class="form-control text-center w-25"
                            id="no-sn" disabled>
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <label class="input-group-text bg-primary text-light" for="nama-alat-ukur">Calibration Date</label>
                        <input type="text" aria-label="Date Now" placeholder="Date Now" class="form-control w-25"
                            id="calibration_date" disabled>
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text bg-primary text-light">Equipment Name</span>
                        <input type="text" class="form-control" placeholder="auto" id="equipment-name" disabled>
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text bg-primary text-light">Capacity</span>
                        <input type="number" class="form-control" placeholder="auto" id="capacity"
                            aria-describedby="capacity" disabled>
                        <span class="input-group-text bg-primary text-light">Accuracy</span>
                        <span class="input-group-text bg-primary text-light">±</span>
                        <input type="number" class="form-control" placeholder="auto" id="accuracy" disabled>
                        <span class="input-group-text bg-primary text-light w-25 satuan justify-content-center"></span>
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text bg-primary text-light">Merk</span>
                        <input type="text" class="form-control" id="merk" placeholder="auto" disabled>
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text bg-primary text-light">Location</span>
                        <input type="text" id="location" class="form-control" placeholder="auto" disabled>
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text bg-primary text-light">Calibration Type</span>
                        <input type="text" id="calibration_type" class="form-control" placeholder="Internal / External"
                            disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text bg-primary text-light">Standard Keberterimaan</span>
                        <input type="text" class="form-control" id="acceptance_criteria" placeholder="Kg / gr / °C / mm"
                            disabled>
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text bg-primary text-light">Calibrator Equipment</span>
                        <select type="text" class="form-select" id="calibrator-equipment" name="calibrator_equipment"
                            required>
                            <option selected>Pilih...</option>
                            <option value="AA">AA</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                        </select>
                    </div>
                    <div class="row g-1">
                        <div class="col">
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter 1</span>
                                <input type="number" class="form-control" id="std-1" placeholder="std" disabled>
                                <input type="number" class="form-control" id="param-1" name="param_1" required
                                    placeholder="act">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter 2</span>
                                <input type="number" class="form-control" id="std-2" placeholder="std" disabled>
                                <input type="number" class="form-control" id="param-2" name="param_2" required
                                    placeholder="act">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter 3</span>
                                <input type="number" class="form-control" id="std-3" placeholder="std" disabled>
                                <input type="number" class="form-control" id="param-3" name="param_3" required
                                    placeholder="act">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter 4</span>
                                <input type="number" class="form-control" id="std-4" placeholder="std" disabled>
                                <input type="number" class="form-control" id="param-4" name="param_4" required
                                    placeholder="act">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter 5</span>
                                <input type="number" class="form-control" id="std-5" placeholder="std" disabled>
                                <input type="number" class="form-control" id="param-5" name="param_5" required
                                    placeholder="act">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter &nbsp; 6</span>
                                <input type="number" class="form-control" id="std-6" placeholder="std" disabled>
                                <input type="number" class="form-control" id="param-6" name="param_6" required
                                    placeholder="act">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter &nbsp; 7</span>
                                <input type="number" class="form-control" id="std-7" placeholder="std" disabled>
                                <input type="number" class="form-control" id="param-7" name="param_7" required
                                    placeholder="act">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter &nbsp; 8</span>
                                <input type="number" class="form-control" id="std-8" placeholder="std" disabled>
                                <input type="number" class="form-control" id="param-8" name="param_8" required
                                    placeholder="act">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter &nbsp; 9</span>
                                <input type="number" class="form-control" id="std-9" placeholder="std" disabled>
                                <input type="number" class="form-control" id="param-9" name="param_9" required
                                    placeholder="act">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter 10</span>
                                <input type="number" class="form-control" id="std-10" placeholder="std" disabled>
                                <input type="number" class="form-control" id="param-10" name="param_10" required
                                    placeholder="act">
                            </div>
                        </div>
                        <div class="col-md-2 align-content-center">
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Judgement</span>
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <select class="form-select" id="judgement" name="judgement" required>
                                    <option value="" selected>Pilih...</option>
                                    <option value="OK">OK</option>
                                    <option value="NG">NG</option>
                                    <option value="Disposal">Disposal</option>
                                </select>
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Created By</span>
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    readonly value="{{ auth()->user()->idKaryawan }}">
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
                            <th scope="col">Calibration Date</th>
                            <th scope="col">Nomor ID/SN</th>
                            <th scope="col">Equipment Name</th>
                            <th scope="col">Capacity</th>
                            <th scope="col">Accuracy</th>
                            <th scope="col">Merk</th>
                            <th scope="col">Location</th>
                            <th scope="col">PIC Pengguna</th>
                            <th scope="col">Type Kalibrasi</th>
                            <th scope="col">Rank</th>
                            <th scope="col">Calibration Freq</th>
                            <th scope="col">Standar Keberterimaan</th>
                            <th scope="col">Parameter 1</th>
                            <th scope="col">Parameter 2</th>
                            <th scope="col">Parameter 3</th>
                            <th scope="col">Parameter dll</th>
                            <th scope="col">Judgement</th>
                            <th scope="col">Certificate</th>
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
                    <a href="{{ route('input.new.equipment') }}" class="btn btn-primary">New Data</a>
                </div>
                <div class="col-6 col-md-auto text-center mb-1 mb-md-0">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="col-6 col-md-auto text-center mb-1 mb-md-0">
                    <a href="{{ route('dashboard', ['key' => 'menu-input']) }}" class="btn btn-primary">Close</a>
                </div>
                <div class="col-6 col-md-auto text-center mb-1 mb-md-0">
                    <button type="button" class="btn btn-primary">Print Label</button>
                </div>
                <div class="col-12 col-md-auto text-center mb-1 mb-md-0">
                    <input class="form-control form-control-sm" id="certificate" name="certificate" type="file"
                        hidden>
                    <button type="button" class="btn btn-primary">Upload Calibration External Certificate</button>
                </div>
            </div>
        </form>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    </div>
@endsection
