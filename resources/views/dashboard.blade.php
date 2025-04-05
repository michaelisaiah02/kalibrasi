@extends('layouts.app')

@section('styles')
    <style>
        #title {
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.1s ease, transform 0.2s ease;
        }

        #title.show-title {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-around my-3">
            <div class="col-md-auto">
                <div class="card border-0" style="width: 30rem;">
                    <img src="{{ asset('icon/input.svg') }}" class="mx-auto my-4 icon menu-btn" alt="Input" width="96"
                        data-target="menu-input" id="img-input">
                    <div class="card-body mx-auto w-100" id="btn-input">
                        <button class="btn btn-primary py-3 px-5 w-100 rounded-4 menu-btn" style="font-size: 3.3rem"
                            data-target="menu-input">INPUT</button>
                    </div>
                    <div class="menu-input menu-section d-none">
                        <a class="btn btn-primary py-3 px-5 mb-5 w-100 rounded-4" style="font-size: 2.5rem"
                            href="{{ route('new-alat-ukur') }}">NEW ALAT
                            UKUR</a>
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
                    <img src="{{ asset('icon/report.svg') }}" class="mx-auto my-4 icon menu-btn" alt="Report"
                        width="96" data-target="menu-report" id="img-report">
                    <div class="card-body mx-auto w-100" id="btn-report">
                        <button class="btn btn-primary py-3 px-5 w-100 rounded-4 menu-btn" style="font-size: 3.3rem"
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
        <form id="btn-logout" action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-primary text-center rounded-3 px-5"
                style="font-size: 1.5rem; position: absolute; top: 85%;
  left: 50%; -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%);">LOG
                OUT</button>
        </form>
        <div id="btn-back" class="row justify-content-end d-none">
            <div class="col-auto">
                <button type="button" class="btn btn-primary text-decoration-underline shadow-lg menu-btn px-5"
                    style="position: absolute; bottom: 12px; right: 20px;">Back</button>
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

                    // Ubah judul
                    $("#title").text("INPUT").removeClass("d-none");
                    setTimeout(() => {
                        $("#title").addClass("show-title");
                    }, 5); // kasih delay sedikit supaya transisi bisa kebaca
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

                    // Ubah judul
                    $("#title").text("REPORT").removeClass("d-none");
                    setTimeout(() => {
                        $("#title").addClass("show-title");
                    }, 5); // kasih delay sedikit supaya transisi bisa kebaca
                } else {
                    // Tutup semua menu-section
                    $("#img-input").css("opacity", "1");
                    $("#img-report").css("opacity", "1");
                    $(".menu-section").addClass("d-none");
                    $("#btn-logout").removeClass("d-none");
                    $("#btn-back").addClass("d-none");
                    $("#btn-input").removeClass("d-none");
                    $("#btn-report").removeClass("d-none");

                    // Ubah judul
                    $("#title").removeClass("show-title");
                    setTimeout(() => {
                        $("#title").html("&nbsp;");
                    }, 200); // tunggu animasi selesai (sesuai transition duration CSS)
                }
            });
        });
    </script>
@endsection
