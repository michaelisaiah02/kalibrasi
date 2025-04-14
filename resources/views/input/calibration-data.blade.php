@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <form action="{{ route('store.equipment') }}" method="POST">
            @csrf
            <div class="row justify-content-center mb-3">
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
                        <input type="date" aria-label="Date Now" placeholder="Date Now" class="form-control w-25"
                            id="calibration_date" disabled>
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text bg-primary text-light">Equipment Name</span>
                        <input type="text" class="form-control" placeholder="auto" id="equipment-name" disabled>
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text bg-primary text-light">Capacity</span>
                        <input type="number" class="form-control" placeholder="auto" id="capacity" name="capacity"
                            aria-describedby="capacity" disabled>
                        <span class="input-group-text bg-primary text-light w-25 satuan justify-content-center"></span>
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text bg-primary text-light">Accuracy</span>
                        <span class="input-group-text bg-primary text-light">±</span>
                        <input type="number" class="form-control" placeholder="± Kg / gram / ˚C / mm" id="ketelitian"
                            name="ketelitian" required>
                        <span class="input-group-text bg-primary text-light w-25 satuan justify-content-center"></span>
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text bg-primary text-light">Merk</span>
                        <input type="text" class="form-control" id="merk" name="merk" required>
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text bg-primary text-light">Location</span>
                        <input type="date" id="tgl_kalibrasi" name="tgl_kalibrasi" class="form-control"
                            placeholder="dd/mm/yyyy" required>
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text bg-primary text-light">Calibration Type</span>
                        <select type="text" class="form-select" id="tipe_kalibrasi" name="tipe_kalibrasi" required>
                            <option selected>Pilih...</option>
                            <option value="Internal">Internal</option>
                            <option value="External">External</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text bg-primary text-light">Standard Keberterimaan</span>
                        <input type="date" class="form-control" id="first_used" name="first_used" required>
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text bg-primary text-light">Calibrator Equipment</span>
                        <select type="text" class="form-select" id="rank" name="rank" required>
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
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="act">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter 2</span>
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="act">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter 3</span>
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="act">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter 4</span>
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="act">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter 5</span>
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="act">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter &nbsp; 6</span>
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="act">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter &nbsp; 7</span>
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="act">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter &nbsp; 8</span>
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="act">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter &nbsp; 9</span>
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="act">
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Parameter 10</span>
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="std">
                                <input type="number" class="form-control" id="freq_kalibrasi" name="freq_kalibrasi"
                                    required placeholder="act">
                            </div>
                        </div>
                        <div class="col-md-2 align-content-center">
                            <div class="input-group input-group-sm mb-1">
                                <span class="input-group-text bg-primary text-light">Judgement</span>
                            </div>
                            <div class="input-group input-group-sm mb-1">
                                <select class="form-select" id="nama-alat-ukur" name="tipe_id" required>
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
                                    required placeholder="user">
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
                    <button type="button" class="btn btn-primary">Upload Calibration External Certificate</button>
                </div>
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
