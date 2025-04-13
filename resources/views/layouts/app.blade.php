<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalibrasi</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])
    @yield('styles')
    @if (!request()->is('login'))
        <style>
            #navbar-kalibrasi {
                border-bottom-left-radius: 200px;
                border-bottom-right-radius: 200px;
            }

            #title-section {
                height: 11.2rem
            }
        </style>
    @endif
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light @if (request()->is('login')) bg-transparent px-3 @else mx-5 px-5 pb-3 bg-primary text-light @endif"
        id="navbar-kalibrasi">
        <div class="container-fluid justify-content-center">
            <a class="navbar-brand mx-0 mx-md-4" href="/">
                <img src="{{ asset('image/logo-pt.png') }}" alt="Logo" class="mt-0">
            </a>
            <div class="row text-center justify-content-center" id="title-section">
                <p class="fw-bold align-self-center" id="kalibrasi">CALIBRATION APP</p>
                <p class="align-self-center">PT. CATURINDO AGUNGJAYA RUBBER</p>
                @if (!request()->is('login'))
                    <button id="title" class="btn btn-lg btn-outline-light fw-medium p-0 my-auto sub-judul"
                        disabled>
                        @if (!request()->is('dashboard'))
                            {{ $title }}
                        @else
                            &nbsp;
                        @endif
                    </button>
                @endif
            </div>
            <a class="navbar-brand mx-0 mx-md-4" href="/">
                <img src="{{ asset('image/logo-rice.png') }}" alt="Logo" class="mt-0">
            </a>
        </div>
    </nav>
    <!-- Modal Auto Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Sesi Berakhir</h5>
                </div>
                <div class="modal-body">
                    Sesi berakhir, silahkan login kembali.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary"
                        onclick="localStorage.removeItem('forceLogout'); document.getElementById('auto-logout-form').submit();">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Logout -->
    <form id="auto-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @yield('content')
    @yield('scripts')
    @auth
        <script type="module">
            let idleTime = 0;
            const maxIdleTime = 5 * 60 * 1000;
            const idleStartDelay = 5 * 1000;

            let idleTimeout;
            let idleInterval;

            function resetIdleTimer() {
                // Kalau sebelumnya sudah ditandai harus logout, jangan izinkan reset
                if (localStorage.getItem('forceLogout') === 'true') return;

                clearTimeout(idleTimeout);
                clearInterval(idleInterval);
                idleTime = 0;

                idleTimeout = setTimeout(startIdleCounter, idleStartDelay);
            }

            function startIdleCounter() {
                idleInterval = setInterval(() => {
                    idleTime += 1000;
                    console.log(`Idle time: ${idleTime / 1000}s`);

                    if (idleTime >= maxIdleTime) {
                        localStorage.setItem('forceLogout', 'true');
                        showLogoutModal();
                    }
                }, 1000);
            }

            function showLogoutModal() {
                // Hentikan semua timer
                clearInterval(idleInterval);
                clearTimeout(idleTimeout);
                if (document.getElementById('logoutModal').classList.contains('show')) return;
                const logoutModal = new bootstrap.Modal(document.getElementById('logoutModal'));
                logoutModal.show();

                setTimeout(() => {
                    localStorage.removeItem('forceLogout');
                    document.getElementById('auto-logout-form').submit();
                }, 30 * 1000); // kasih delay 5 detik biar user tahu
            }

            // Cek saat halaman diload
            window.addEventListener('load', () => {
                if (localStorage.getItem('forceLogout') === 'true') {
                    showLogoutModal();
                } else {
                    idleTimeout = setTimeout(startIdleCounter, idleStartDelay);
                }
            });

            // Reset idle kalau user aktif
            ['mousemove', 'keydown', 'click', 'scroll'].forEach(event => {
                document.addEventListener(event, resetIdleTimer);
            });
        </script>
    @endauth
</body>

</html>
