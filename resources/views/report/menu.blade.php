@extends('layouts.app')

@section('content')
    {{-- @dd($error) --}}
    <div class="container mt-md-3">
        <form action="{{ route('report.search') }}" method="POST">
            @csrf
            <div class="row justify-content-md-around justify-content-center my-3">
                <div class="col-md">
                    <div class="input-group mb-md-5 mb-1">
                        <span class="input-group-text bg-primary text-light">Date</span>
                        <input type="date" aria-label="Date" placeholder="Search" class="form-control text-center"
                            name="date" id="date" required>
                    </div>
                    <div class="input-group mb-md-5 mb-1">
                        <label class="input-group-text bg-primary text-light" for="Name-alat-ukur">Location</label>
                        <input type="text" aria-label="Location" placeholder="Search" class="form-control w-25"
                            name="no_sn" id="no-sn">
                    </div>
                </div>
                <div class="col-md">
                    <div class="input-group mb-md-5 mb-1">
                        <span class="input-group-text bg-primary text-light">Calibration Type</span>
                        <select class="form-select" id="calibration_type" name="calibration_type" required>
                            <option selected>Choose...</option>
                            <option value="Internal">Internal</option>
                            <option value="External">External</option>
                        </select>
                    </div>
                    <div class="input-group mb-md-5 mb-1">
                        <span class="input-group-text bg-primary text-light">Equipment Name</span>
                        <select class="form-select" id="equipment_name" name="type_id" required>
                            <option value="" selected>Choose...</option>
                            @foreach ($equipments as $equipment)
                                <option value="{{ $equipment->type_id }}">{{ $equipment->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-md-5 mb-1">
                        <span class="input-group-text bg-primary text-light">Judgement</span>
                        <select class="form-select" id="judgement" name="judgement" required>
                            <option value="" selected>OK / NG / Disposal</option>
                            <option value="OK">OK</option>
                            <option value="NG">NG</option>
                            <option value="Disposal">Disposal</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="input-group mb-md-5 mb-1">
                <button type="submit" class="btn btn-secondary me-0 me-md-4 rounded-1" value="masterlist"
                    name="report">Masterlist</button>
                <button type="submit" class="btn btn-secondary mx-1 mx-md-4 rounded-1" value="keberterimaan"
                    name="report">Keberterimaan</button>
                <button type="submit" class="btn btn-secondary mx-md-4 rounded-1" value="history" name="report">History
                    Perbaikan</button>
            </div>
        </form>
        <div id="btn-back" class="row justify-content-end">
            <div class="col-auto">
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <x-toast />
@endsection

@section('scripts')
    <script type="module">
        $(document).ready(function() {
            $(".menu-btn").click(function() {
                var target = $(this).data("target"); // Ambil target dari data-target button
                if (target === "menu-input") {
                    // Opacity gambar input 50%, hilangkan tombol input
                    $("#img-input").css("opacity", "1");
                    $("#img-report").css("opacity", "0.5");
                    $("#btn-input").addClass("d-none"); // Sembunyikan tombol input
                    $("#btn-report").addClass("d-none"); // Tampilkan tombol report
                    $("#btn-logout").addClass("d-none");
                    $("#btn-back").removeClass("d-none"); // Tampilkan tombol back
                    $(".menu-section").addClass("d-none"); // Sembunyikan semua menu-section
                    $("." + target).removeClass("d-none"); // Tampilkan yang dipilih

                    // Ubah judul
                    $("#title").text("INPUT").removeClass("d-none");
                    setTimeout(() => {
                        $("#title").addClass("show-title");
                    }, 5); // kasih delay sedikit supaya transisi bisa kebaca
                } else if (target === "menu-report") {
                    window.location.href = "/report"
                } else {
                    // Tutup semua menu-section
                    $("#img-input").css("opacity", "1");
                    $("#img-report").css("opacity", "1");
                    $(".menu-section").addClass("d-none");
                    $("#btn-logout").removeClass("d-none");
                    $("#btn-back").addClass("d-none");
                    $("#btn-input").removeClass("d-none");
                    $("#btn-report").removeClass("d-none");
                }
            });
        });
    </script>
@endsection
