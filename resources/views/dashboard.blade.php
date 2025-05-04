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

        /* kosongkan animation-name default, nanti kita isi via JS */
        #warning-text {
            display: inline-block;
            white-space: nowrap;
            will-change: transform;
        }

        #danger-text {
            display: inline-block;
            white-space: nowrap;
            will-change: transform;
        }
    </style>
@endsection
@section('content')
    {{-- @dd($error) --}}
    <div class="container-fluid overflow-hidden m-0">
        <h5 class="text-center text-primary position-relative m-0" id="warning">
            <span class="bg-warning rounded-3 p-2 m-0" id="warning-text">&nbsp;</span>
        </h5>
    </div>
    <div class="container-fluid overflow-hidden m-0">
        <h5 class="text-center text-primary position-relative m-0" id="danger">
            <span class="bg-danger rounded-3 p-2 m-0" id="danger-text">&nbsp;</span>
        </h5>
    </div>
    <div class="container" id="dashboard">
        <div class="row justify-content-md-around justify-content-center mb-3">
            <div class="col-md-5 main-menu">
                <div class="card border-0">
                    <img src="{{ asset('icon/input.svg') }}" class="mx-auto mt-1 icon menu-btn" alt="Input"
                        data-target="menu-input" id="img-input">
                    <div class="card-body mx-auto" id="btn-input">
                        <button class="btn btn-primary py-2 px-5 rounded-4 menu-btn btn1"
                            data-target="menu-input">INPUT</button>
                    </div>
                    <div class="menu-input menu-section row d-none mx-1 mx-md-0">
                        <a class="btn btn-primary py-2 my-3 rounded-4 btn1" href="{{ route('input.new.equipment') }}">NEW
                            EQUIPMENT</a>
                        <a class="btn btn-primary py-2 rounded-4 btn1" href="{{ route('input.repair.data') }}">REPAIR
                            DATA</a>
                    </div>
                </div>
            </div>
            <div class="col-md-5 main-menu">
                <div class="card border-0">
                    <img src="{{ asset('icon/report.svg') }}" class="mx-auto mt-1 icon menu-btn" alt="Report"
                        data-target="menu-report" id="img-report">
                    <div class="card-body mx-auto" id="btn-report">
                        <button class="btn btn-primary py-2 px-5 rounded-4 menu-btn btn1"
                            data-target="menu-report">REPORT</button>
                    </div>
                    <div class="menu-input menu-section row d-none mx-1 mx-md-0">
                        <a class="btn btn-primary py-2 my-3 rounded-4 btn1"
                            href="{{ route('input.calibration.data') }}">CALIBRATION DATA</a>
                        @if (auth()->user()->role === 'admin')
                            <button class="btn btn-primary py-2 rounded-4 menu-btn btn1" data-target="master-data">MASTER
                                DATA</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-5 d-grid row-gap-1 row-gap-md-3 text-center d-none master-data mb-1 mb-md-0">
                <a class="btn btn-primary py-4 rounded-4 menu-btn btn2 align-content-center"
                    href="{{ route('admin.users.index') }}">Users</a>
                <a class="btn btn-primary py-4 rounded-4 menu-btn btn2 align-content-center">Tabel Kode dan Jenis Alat
                    Ukur</a>
                <a class="btn btn-primary py-4 rounded-4 menu-btn btn2 align-content-center">Tambahkan Sesuai Tabel di
                    Database</a>
            </div>
            <div class="col-md-5 d-grid row-gap-1 row-gap-md-3 text-center d-none master-data">
                <a class="btn btn-primary py-4 rounded-4 menu-btn btn2 align-content-center">Tabel Unit Ukuran</a>
                <a class="btn btn-primary py-4 rounded-4 menu-btn btn2 align-content-center">Tabel Masterlist Alat
                    Ukur</a>
                <a class="btn btn-primary py-4 rounded-4 menu-btn btn2 align-content-center"
                    href="{{ route('admin.standards.index') }}">Acceptance Criteria</a>
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
    <div class="toast-container position-fixed bottom-0 end-0 p-3 z-3"></div>
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
                        $("#dashboard").removeClass("mt-md-1");
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
                        $("#dashboard").addClass("mt-md-1");
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
    @session('success')
        <script type="module">
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
    {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            const warnings = @json($warnings); // e.g. ["Alat TIM-001 ...", "Alat XYZ ..."]
            const dangers = @json($dangers); // e.g. ["Alat ABC ...", ...]

            function initMarquee(messages, spanId, keyframeName) {
                if (!messages.length) return;

                // Gabungkan array string jadi satu teks panjang
                const text = messages.join('      ');

                const el = document.getElementById(spanId);
                el.textContent = text;

                requestAnimationFrame(() => {
                    const textW = el.offsetWidth;
                    const contW = el.parentElement.offsetWidth;
                    const distance = textW + contW;
                    const speed = 100; // px per detik, sesuaikan
                    const duration = distance / speed;

                    // Buat keyframes dinamis
                    const styleTag = document.createElement('style');
                    styleTag.textContent = `
        @keyframes ${keyframeName} {
          0%   { transform: translateX(${contW}px); }
          100% { transform: translateX(-${textW}px); }
        }`;
                    document.head.appendChild(styleTag);

                    // Terapkan animasi
                    el.style.animationName = keyframeName;
                    el.style.animationDuration = duration + 's';
                    el.style.animationTimingFunction = 'linear';
                    el.style.animationIterationCount = 'infinite';
                    // Pastikan span diawali di luar kanan
                    el.style.position = 'absolute';
                });
            }

            initMarquee(warnings, 'warning-text', 'marqueeWarning');
            initMarquee(dangers, 'danger-text', 'marqueeDanger');
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const warnings = @json($warnings);
            const dangers = @json($dangers);
            const speedPxPerSec = 100;

            if (warnings.length) {
                const el = document.getElementById('warning-text');
                el.textContent = warnings.join('      ');

                requestAnimationFrame(() => {
                    const textWidth = el.offsetWidth;
                    const containerWidth = el.parentElement.offsetWidth;
                    const distance = textWidth + containerWidth;
                    const durationSec = distance / speedPxPerSec;

                    const styleEl = document.createElement('style');
                    styleEl.textContent = `
            @keyframes marqueeDynamic {
                0%   { transform: translateX(${containerWidth}px); }
                100% { transform: translateX(-${textWidth}px); }
            }`;
                    document.head.appendChild(styleEl);

                    el.style.animationName = 'marqueeDynamic';
                    el.style.animationDuration = durationSec + 's';
                    el.style.animationTimingFunction = 'linear';
                    el.style.animationIterationCount = 'infinite';
                });
            }

            if (dangers.length) {
                const el2 = document.getElementById('danger-text');
                el2.textContent = dangers.join('      ');

                requestAnimationFrame(() => {
                    const textWidth2 = el2.offsetWidth;
                    const containerWidth2 = el2.parentElement.offsetWidth;
                    const distance2 = textWidth2 + containerWidth2;
                    const durationSec2 = distance2 / speedPxPerSec;

                    const styleEl2 = document.createElement('style');
                    styleEl2.textContent = `
            @keyframes marqueeDynamic2 {
                0%   { transform: translateX(${containerWidth2}px); }
                100% { transform: translateX(-${textWidth2}px); }
            }`;
                    document.head.appendChild(styleEl2);

                    el2.style.animationName = 'marqueeDynamic2';
                    el2.style.animationDuration = durationSec2 + 's';
                    el2.style.animationTimingFunction = 'linear';
                    el2.style.animationIterationCount = 'infinite';
                });
            }
        });
    </script>

@endsection
