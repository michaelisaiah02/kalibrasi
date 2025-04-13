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
    {{-- @dd($error) --}}
    <div class="container" id="dashboard">
        <div class="row justify-content-md-around justify-content-center my-3">
            <div class="col-md-5 main-menu">
                <div class="card border-0">
                    <img src="{{ asset('icon/input.svg') }}" class="mx-auto my-4 icon menu-btn" alt="Input"
                        data-target="menu-input" id="img-input">
                    <div class="card-body mx-auto" id="btn-input">
                        <button class="btn btn-primary py-3 px-5 rounded-4 menu-btn btn1"
                            data-target="menu-input">INPUT</button>
                    </div>
                    <div class="menu-input menu-section row d-none mx-1 mx-md-0">
                        <a class="btn btn-primary py-3 my-3 rounded-4 btn1" href="{{ route('input.new.equipment') }}">NEW
                            EQUIPMENT</a>
                        <a class="btn btn-primary py-3 rounded-4 btn1" href="{{ route('input.repair.data') }}">REPAIR
                            DATA</a>
                    </div>
                </div>
            </div>
            <div class="col-md-5 main-menu">
                <div class="card border-0">
                    <img src="{{ asset('icon/report.svg') }}" class="mx-auto my-4 icon menu-btn" alt="Report"
                        data-target="menu-report" id="img-report">
                    <div class="card-body mx-auto" id="btn-report">
                        <button class="btn btn-primary py-3 px-5 rounded-4 menu-btn btn1"
                            data-target="menu-report">REPORT</button>
                    </div>
                    <div class="menu-input menu-section row d-none mx-1 mx-md-0">
                        <a class="btn btn-primary py-3 my-3 rounded-4 btn1"
                            href="{{ route('input.calibration.data') }}">CALIBRATION DATA</a>
                        @if (auth()->user()->role === 'admin')
                            <button class="btn btn-primary py-3 rounded-4 menu-btn btn1" data-target="master-data">MASTER
                                DATA</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-5 d-grid row-gap-1 row-gap-md-3 text-center d-none master-data">
                <a class="btn btn-primary py-4 rounded-4 menu-btn btn2 align-content-center"
                    href="{{ route('admin.users') }}">Tabel User</a>
                <a class="btn btn-primary py-4 rounded-4 menu-btn btn2 align-content-center">Tabel Kode dan Jenis Alat
                    Ukur</a>
                <a class="btn btn-primary py-4 rounded-4 menu-btn btn2 align-content-center">Tambahkan Sesuai Tabel di
                    Database</a>
            </div>
            <div class="col-md-5 d-grid row-gap-1 row-gap-md-3 text-center d-none master-data">
                <a class="btn btn-primary py-4 rounded-4 menu-btn btn2 align-content-center">Tabel Satuan Ukuran</a>
                <a class="btn btn-primary py-4 rounded-4 menu-btn btn2 align-content-center">Tabel Masterlist Alat
                    Ukur</a>
                <a class="btn btn-primary py-4 rounded-4 menu-btn btn2 align-content-center"
                    href="{{ route('admin.std.keberterimaan') }}">Tabel Standar
                    Keberterimaan</a>
            </div>
        </div>
        <form id="btn-logout" action="{{ route('logout') }}" method="post" class="d-flex justify-content-center">
            @csrf
            <button type="submit" class="btn btn-primary text-center rounded-3 px-5 btn2">LOG
                OUT</button>
        </form>
        <div id="btn-back" class="row justify-content-end d-none">
            <div class="col-auto">
                <button type="button" class="btn btn-primary text-decoration-underline shadow-lg menu-btn px-5 btn2"
                    id="back" data-target="back">Back</button>
            </div>
        </div>
    </div>
    @if (session()->has('error'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="errorNotification" class="toast align-items-center text-bg-danger border-0" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="bi bi-x-square-fill text-danger me-1"></i>
                    <strong class="me-auto">{{ config('app.name') }} - Error</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session()->get('error') }}
                </div>
            </div>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="successNotification" class="toast align-items-center text-bg-success border-0" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="bi bi-check-square-fill text-success me-1"></i>
                    <strong class="me-auto">{{ config('app.name') }} - Berhasil</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session()->get('success') }}
                </div>
            </div>
        </div>
    @endif
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
                    $("#btn-report").addClass("d-none"); // Sembunyikan tombol report
                    $("#btn-logout").addClass("d-none");
                    $("#btn-back").removeClass("d-none"); // Tampilkan tombol back
                    $(".menu-section").addClass("d-none"); // Sembunyikan semua menu-section
                    $("#back").addClass("back-input");
                    $("#back").removeClass("back-master");
                    $("." + target).removeClass("d-none"); // Tampilkan yang dipilih

                    // Ubah judul
                    $("#title").text("INPUT").removeClass("d-none");
                    setTimeout(() => {
                        $("#title").addClass("show-title");
                    }, 5); // kasih delay sedikit supaya transisi bisa kebaca
                } else if (target === "menu-report") {
                    window.location.href = "/report"
                } else if (target === "back") {
                    if ($("#back").hasClass("back-input")) {
                        // Tutup semua menu-section
                        $("#img-input").css("opacity", "1");
                        $("#img-report").css("opacity", "1");
                        $(".menu-section").addClass("d-none");
                        $("#btn-logout").removeClass("d-none");
                        $("#btn-back").addClass("d-none");
                        $("#btn-input").removeClass("d-none");
                        $("#btn-report").removeClass("d-none");
                        $("#back").removeClass("back-input");

                        // Ubah judul
                        $("#title").removeClass("show-title");
                        setTimeout(() => {
                            $("#title").html("&nbsp;");
                        }, 200); // tunggu animasi selesai (sesuai transition duration CSS)
                    }
                    if ($("#back").hasClass("back-master")) {
                        $("#img-input").css("opacity", "1");
                        $("#img-report").css("opacity", "0.5");
                        $("#btn-input").addClass("d-none"); // Sembunyikan tombol input
                        $("#btn-report").addClass("d-none"); // Sembunyikan tombol report
                        $("#btn-logout").addClass("d-none");
                        $(".menu-section").removeClass("d-none"); // Sembunyikan semua menu-section
                        // Tutup semua menu-section
                        $("#dashboard").removeClass("mt-md-5");
                        $(".main-menu").removeClass("d-none");
                        $(".master-data").addClass("d-none"); // Tampilkan yang dipilih
                        $("#back").removeClass("back-master");
                        $("#back").addClass("back-input");

                        // Ubah judul
                        $("#title").text("INPUT").removeClass("d-none");
                        setTimeout(() => {
                            $("#title").addClass("show-title");
                        }, 5); // kasih delay sedikit supaya transisi bisa kebaca
                    }
                }
            });
        });
    </script>
    @if (auth()->user()->role === 'admin')
        <script type="module">
            $(document).ready(function() {
                $(".menu-btn").click(function() {
                    var target = $(this).data("target"); // Ambil target dari data-target button
                    if (target === "master-data") {
                        // Opacity gambar input 50%, hilangkan tombol input
                        $("#dashboard").addClass("mt-md-5");
                        $(".main-menu").addClass("d-none");
                        $("." + target).removeClass("d-none"); // Tampilkan yang dipilih
                        $("#btn-back").removeClass("d-none");
                        $("#back").addClass("back-master");
                        $("#back").removeClass("back-input");
                        $("#btn-logout").addClass("d-none");

                        // Ubah judul
                        $("#title").text("MASTER DATA INPUT").removeClass("d-none");
                        setTimeout(() => {
                            $("#title").addClass("show-title");
                        }, 5); // kasih delay sedikit supaya transisi bisa kebaca
                    }
                });
            })
        </script>
    @endif
    @session('error')
        <script type="module">
            const toastLiveExample = document.getElementById('errorNotification')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
            toastBootstrap.show();
        </script>
    @endsession
    @session('success')
        <script type="module">
            const toastLiveExample = document.getElementById('successNotification')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
            toastBootstrap.show();
            $(document).ready(function() {
                $('.menu-btn[data-target="{{ session()->get('key') }}"]').trigger('click');
            })
        </script>
    @endsession
    @if (!session()->has('success'))
        @session('key')
            <script type="module">
                $(document).ready(function() {
                    $('.menu-btn[data-target="{{ session()->get('key') }}"]').trigger('click');
                })
            </script>
        @endsession
    @endif
@endsection
