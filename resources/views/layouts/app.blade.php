<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalibrasi</title>
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])
    @yield('styles')
</head>

<body>
    <nav
        class="navbar navbar-expand-lg navbar-light rounded-bottom-pill @if (request()->is('login')) bg-transparent px-3 @else mx-5 px-5 pb-5 bg-primary text-light @endif">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('image/logo-pt.png') }}" alt="Logo" width="96" height="96"
                    class="d-inline-block align-top">
            </a>
            <div class="row text-center">
                <h1>K A L I B R A S I</h1>
                <h2>PT. CATURINDO AGUNGJAYA RUBBER</h2>
                @if (!request()->is('login') && !request()->is('dashboard'))
                    <button id="title"></button>
                @endif
            </div>
            <a class="navbar-brand" href="#">
                <img src="{{ asset('image/logo-rice.png') }}" alt="Logo" width="96" height="96"
                    class="d-inline-block align-top">
            </a>
        </div>
    </nav>
    @yield('content')
    @yield('scripts')
</body>

</html>
