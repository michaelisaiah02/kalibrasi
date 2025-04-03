@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-around my-3">
            <div class="col-md-auto">
                <div class="card border-0" style="width: 30rem;">
                    <img src="{{ asset('icon/input.svg') }}" class="mx-auto my-5 icon menu-btn" alt="Input" width="100"
                        data-target="menu-input" id="img-input">
                    <div class="card-body mx-auto w-100" id="btn-input">
                        <button class="btn btn-primary py-3 px-5 w-100 rounded-4 menu-btn" style="font-size: 3.5rem"
                            data-target="menu-input">INPUT</button>
                    </div>
                    <div class="menu-input menu-section d-none">
                        <button class="btn btn-primary py-3 px-5 mb-5 w-100 rounded-4" style="font-size: 2.5rem">NEW ALAT
                            UKUR</button>
                        <button class="btn btn-primary py-3 px-5 w-100 rounded-4" style="font-size: 2.5rem">DATA
                            PERBAIKAN</button>
                    </div>
                    <div class="menu-report menu-section d-none">
                        <button class="btn btn-primary py-3 px-5 mb-5 w-100 rounded-4"
                            style="font-size: 2.22rem">KEBERTERIMAAN & SERTIFIKAT</button>
                    </div>
                </div>
            </div>
            <div class="col-md-auto">
                <div class="card border-0" style="width: 30rem;">
                    <img src="{{ asset('icon/report.svg') }}" class="mx-auto my-5 icon menu-btn" alt="Report"
                        width="100" data-target="menu-report" id="img-report">
                    <div class="card-body mx-auto w-100" id="btn-report">
                        <button class="btn btn-primary py-3 px-5 w-100 rounded-4 menu-btn" style="font-size: 3.5rem"
                            data-target="menu-report">REPORT</button>
                    </div>
                    <div class="menu-input menu-section d-none">
                        <button class="btn btn-primary py-3 px-5 mb-5 w-100 rounded-4" style="font-size: 2.5rem">DATA
                            KALIBRASI</button>
                        <button class="btn btn-primary py-3 px-5 w-100 rounded-4" style="font-size: 1.25rem">MASTER STANDAR
                            KEBERTERIMAAN KALIBRASI</button>
                    </div>
                    <div class="menu-report menu-section d-none">
                        <button class="btn btn-primary py-3 px-5 mb-5 w-100 rounded-4" style="font-size: 2.22rem">SCHEDULE
                            KALIBRASI & MASTERLIS KALIBRASI</button>
                    </div>
                </div>
            </div>
        </div>
        <form id="btn-logout" action="{{ route('logout') }}" method="post" class="row justify-content-center">
            <div class="col-3">
                @csrf
                <button type="submit" class="btn btn-primary text-center mt-5 mx-auto fs-2 w-100">LOG OUT</button>
            </div>
        </form>
        <div id="btn-back" class="row justify-content-end d-none">
            <div class="col-auto">
                <button type="button"
                    class="btn btn-primary text-center mt-3 px-5 fs-5 w-100 text-decoration-underline border-1 border-light shadow-lg menu-btn">Back</button>
            </div>
        </div>
    </div>
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
                } else if (target === "menu-report") {
                    // Opacity gambar report 50%, hilangkan tombol report
                    $("#img-input").css("opacity", "0.5");
                    $("#img-report").css("opacity", "1");
                    $("#btn-input").addClass("d-none"); // Tampilkan tombol input
                    $("#btn-report").addClass("d-none"); // Sembunyikan tombol report
                    $("#btn-logout").addClass("d-none");
                    $("#btn-back").removeClass("d-none"); // Tampilkan tombol back
                    $(".menu-section").addClass("d-none"); // Sembunyikan semua menu-section
                    $("." + target).removeClass("d-none"); // Tampilkan yang dipilih
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
